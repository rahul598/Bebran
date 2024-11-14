<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Page;
use App\Models\PriceWidgetFeatures;
use Illuminate\Support\Facades\Session;

class PriceWidgetController extends Controller
{   
    public function index(){
        $list = DB::table('digital_service_price_widget')->select('service_type')->groupBy('service_type')->get(); 
        $lists = OBR($list); 
        
        return view('admin.price_widget.index', compact('lists')); 
    }
    
    public function price_widget_edit(Request $request, $id){
        
        $service = DB::table('digital_service_price_widget')->select('service_type')->where('service_type', $id)->groupBy('service_type')->get();
        $duration_id = DB::table('digital_service_price_widget')->select('duration_id')->where('service_type', $id)->groupBy('duration_id')->get();
        
        $list = DB::table('digital_service_price_widget')->where('service_type', $id)->get();
        $descriptions = DB::table('plan_description_price_widget')->where('service_type', $id)->get();
        
        $description  = json_decode(json_encode($descriptions), true);
        $duration_list  = json_decode(json_encode($duration_id), true);
        $list_new = json_decode(json_encode($list), true);
        
        $lists = $most_populars =  []; 
        
        $plans = ['Lite', 'Standard', 'Advance', 'Enterprise'];
        
        foreach($list_new as $key => $val) {
            $service_id = $val['service_type'];
            $most_populars[ucfirst($val['plan_name'])] = $val['most_popular'];
            $plan_name = ucfirst($val['plan_name']); // Ensures 'Enterprise' matches correctly
            if(in_array($plan_name, $plans)) {
                $lists[$plan_name][] = [
                    'price_id' => $val['id'],
                    'plan_name' => ucfirst($val['plan_name']),
                    'plan_duration' => $val['plan_duration'], 
                    'main_price' => $val['main_price'],
                    'discount_price' => $val['discount_price'],
                    'percentage' => $val['percentage']
                ];
            }
        }

        $services = json_decode(json_encode($service), true);
        $most_popular = $most_populars;
        
        // echo "<pre>"; print_r($lists); die;
        
        // return view('admin.price_widget.edit', compact('lists', 'services', 'duration_list'));
        return view('admin.price_widget.new_price_edit', compact('lists', 'services', 'duration_list', 'description', 'most_popular', 'service_id'));
    }
    
    public function price_widget_update(Request $request, $id, $id2)
    {
        // echo "<pre>";print_r($request->all()); die;
        // Start a transaction
        DB::beginTransaction();
    
        try {
            if (isset($request['service_id'])) {
                foreach ($request['service_id'] as $serviceKey => $serviceVal) {
                    // Reset all most_popular values to 0 for the current service_type
                    DB::table('digital_service_price_widget')
                        ->where('service_type', $serviceKey)
                        ->update(['most_popular' => 0]);
        
                    // Set the specific record's most_popular to 1
                    foreach ($serviceVal as $key1 => $val1) { 
                            DB::table('digital_service_price_widget')
                                ->where('service_type', $serviceKey)
                                ->where('plan_name', $key1)
                                ->update(['most_popular' => 1]); 
                    }
                }
            }
    
            if (!empty($request['plans'])) {
                foreach ($request['plans'] as $key => $val) {
                    
                    $most_popular = isset($val['most_popular']) ? 1 : 0;
                    
                    $mainValue = $val['main_price'];
                    $discountPercentage = $val['percentage'];
                            
                    // Calculate the discount amount
                    $discountAmounts = ($discountPercentage / 100) * $mainValue;
                    $discountAmount = $mainValue - $discountAmounts; 
                    
                    DB::table('digital_service_price_widget')
                        ->where('id', $key) // Assuming 'id' is the primary key of your 'plans' table
                        ->update([
                            // 'most_popular' => $most_popular,
                            'main_price' => $mainValue,
                            'discount_price' => $discountAmount,
                            'percentage' => $val['percentage']
                        ]);
                }
            }
    
            // Commit the transaction
            DB::commit();
    
            // Flash a success message to the session
            Session::flash('success', 'Prices updated successfully');
    
            // Redirect back to the view page
            return redirect()->back();
        } catch (\Exception $e) {
            // Rollback the transaction
            DB::rollBack();
    
            // Flash an error message to the session
            Session::flash('error', 'An error occurred while updating prices: ' . $e->getMessage());
    
            // Redirect back to the view page
            return redirect()->back();
        }
    }

    
    public function price_widget_update_description(Request $request){
        // echo "<pre>"; print_r($request->all());  die;
        
        $plans = $request->input('plans', []);

        if (empty($plans)) {
            return back()->with('error', 'No plans data provided for update!');
        }
    
        try {
            DB::transaction(function () use ($plans) {
                foreach ($plans as $id => $planData) {
                    // Ensure the ID is numeric and the planData is an array
                    if (is_numeric($id) && is_array($planData)) {
                        DB::table('plan_description_price_widget')
                            ->where('id', $id)
                            ->update([
                                'small_description' => $planData['small_des'] ?? null,
                                'small_features' => json_encode($planData['small_features'] ?? []),
                                'button_text' => $planData['button_text'] ?? null,
                                'updated_at' => now(),
                            ]);
                    }
                }
            });
    
            return back()->with('success', 'Plan description data updated successfully!');
        } catch (\Exception $e) {
            // Log the error for debugging purposes
            Log::error('Error updating plan description data: ' . $e->getMessage());
    
            return back()->with('error', 'An error occurred while updating the plan description data.');
        }
    }
    
    public function price_widget_delete($id){ 
        
        $obj = DB::table('digital_service_price_widget')->where('service_type', $id)->get(); 
        $ids = [];
        foreach($obj as $key => $val){
            $ids[] = $val->id;
        }  
        if($obj->isEmpty()) {
         
            return redirect()->back()->with('error', 'Price widget data does not exist.');
        }
        DB::table('digital_service_price_widget')->where('service_type', $id)->whereIn('id', $ids)->delete();
     
        return redirect()->back()->with('success', 'Price widget has been deleted successfully.');
    }
        
    public function add_plan(Request $request){
        // $service = DB::table()->where()->get()->toArray();
        $all_pages 	= Page::where('posttype', 'pricing')->where('parent_id', '92')->get();
        // return view('admin.price_widget.add_plan' ,compact('all_pages'));
        return view('admin.price_widget.new_add_plan' ,compact('all_pages'));
    }
    
    // public function add_plan_data_old(Request $request){
    //     // echo "<pre>";print_r($request->all()); die;
    //     $arr = [];
    //     // $ducation_id = 0; 
    //     // if(ucfirst($request['plan_duration']) == 'Monthly'){
    //     //     $ducation_id = 1;
    //     // }
    //     // elseif(ucfirst($request['plan_duration']) == 'Quarterly'){
    //     //     $ducation_id = 2;
    //     // }
    //     // elseif(ucfirst($request['plan_duration']) == 'Yearly'){
    //     //     $ducation_id = 4;
    //     // }
    //     // else{
    //     //     $ducation_id = 3;
    //     // }
        
    //     if(!empty($request->all())){
    //         // foreach($request['plans'] as $key => $value){
    //         //   $most_popular = isset($val['most_popular']) ? $val['most_popular'] : 0;
    //         //     // foreach($value['small_features'] as $key1 => $value1){
                    
    //         //         $arr[] = [
                    
    //         //             'duration_id'=>$ducation_id,
    //         //             'service_type'=>$request['package_id'],
    //         //             'plan_name'=>$value['name'],
    //         //             'plan_duration'=>$request['plan_duration'],
    //         //             'most_popular'=>$most_popular,
    //         //             'main_price'=>$value['main_price'],
    //         //             'discount_price'=>$value['discount_price'],
    //         //             'small_description'=>$value['small_des'],
    //         //             'small_features'=>json_encode($value['small_features']),
    //         //             'button_text'=>$value['button_text'] 
                    
    //         //         ]; 
    //         //     // } 
    //         // }
            
    //         foreach($request['plans'] as $plan_name => $plan_durations) {
    //             foreach($plan_durations as $duration => $price_details) {
    //                 if (is_array($price_details)) {
    //                     $most_popular = isset($plan_durations['most_popular']) ? $plan_durations['most_popular'] : 0;
                        
    //                     $duration_id = 3; // Default value for 'Other' durations
                        
    //                     // Determine duration_id based on plan duration
    //                     switch(ucfirst($duration)) {
    //                         case 'Monthly':
    //                             $duration_id = 1;
    //                             break;
    //                         case 'Quarterly':
    //                             $duration_id = 2;
    //                             break;
    //                         case 'Yearly':
    //                             $duration_id = 4;
    //                             break;
    //                     }
                        
    //                     $arr[] = [
    //                         'service_type' => $request['package_id'],
    //                         'plan_name' => $plan_name,
    //                         'plan_duration' => $duration,
    //                         'duration_id' => $duration_id, // Adding duration_id parameter
    //                         'most_popular' => $most_popular,
    //                         'main_price' => $price_details['main_price'],
    //                         'discount_price' => $price_details['discount_price']
    //                     ];
    //                 }
    //             }
    //         } 
            
    //         $result = DB::table('digital_service_price_widget')->insert($arr);
    //         if($result){
    //             return back()->with('success', 'price widget create successfully!');
    //         }
    //         else{
    //             return back()->with('error', 'price widget not created!');
    //         }
    //     }
    // } 
    
    //  check duplicate data ----------------------------------------------
    public function  add_plan_data(Request $request)
    {
        
        $arr = [];
        
        if (!empty($request->all())) {
            foreach ($request['plans'] as $plan_name => $plan_durations) {
               
                foreach ($plan_durations as $duration => $price_details) {
                    if (is_array($price_details)) {
                         
                        $most_popular = isset($plan_durations['most_popular']) ? $plan_durations['most_popular'] : 0;
                        
                        $duration_id = 3; // Default value for 'Other' durations
                        
                        // Determine duration_id based on plan duration
                        switch (ucfirst($duration)) {
                            case 'Monthly':
                                $duration_id = 1;
                                break;
                            case 'Quarterly':
                                $duration_id = 2;
                                break;
                            case 'Yearly':
                                $duration_id = 4;
                                break;
                        }
                        
                        // Check if the entry already exists
                        $exists = DB::table('digital_service_price_widget')
                            ->where('plan_name', $plan_name)
                            ->where('plan_duration', $duration)
                            ->where('service_type', $request['package_id'])
                            ->exists();    
                        if ($exists != true) { 
                            
                            $mainValue = $price_details['main_price'];
                            $discountPercentage = $price_details['discount_price'];
                            
                            // Calculate the discount amount
                            $discountAmounts = ($discountPercentage / 100) * $mainValue;
                            $discountAmount = $mainValue - $discountAmounts; 
                            
                            $arr[] = [
                                'service_type' => $request['package_id'],
                                'plan_name' => $plan_name,
                                'plan_duration' => $duration,
                                'duration_id' => $duration_id, // Adding duration_id parameter
                                'most_popular' => $most_popular,
                                'main_price' => $price_details['main_price'],
                                'discount_price' => $discountAmount,
                                'percentage' => $price_details['discount_price']
                            ];
                        }
                    }
                }
            } 
            if (!empty($arr)) {
                $result = DB::table('digital_service_price_widget')->insert($arr);
                
                if ($result) {
                    return response()->json(['status'=>1, 'message'=>'price widget create successfully!']);
                } else {
                    return response()->json(['status'=>0, 'message'=>'price widget not created!']);
                }
            } else { 
                return response()->json(['status'=>0, 'message'=>'No new data to insert!']);
            }
        }
    }
    public function add_retainer_plan_data(Request $request)
    {
    $arr = [];
    
    if (!empty($request->all())) { 
        foreach ($request['plans'] as $plan_name => $plan_durations) {  
            foreach ($plan_durations as $duration => $price_details) {
                if (is_array($price_details) && isset($price_details['main_price']) && !empty($price_details['main_price'])) { 
                    $most_popular = isset($plan_durations['most_popular']) ? $plan_durations['most_popular'] : 0; 
                     
                    $formatted_duration = ucwords(str_replace('_', ' ', $duration));

                     $duration_id = 3;
                    switch ($formatted_duration) {
                        case 'Monthly':
                            $duration_id = 1;
                            break;
                        case 'Quarterly':
                            $duration_id = 2;
                            break; 
                        case 'Yearly':
                            $duration_id = 4;
                            break;
                        case 'Second':
                            $duration_id = 5;
                            break;
                        case 'Third':
                            $duration_id = 6;
                            break; 
                    }

                    $main_price = $price_details['main_price'];
                    $discount_percentage = isset($price_details['discount_price']) ? $price_details['discount_price'] : 0;

                    // Calculate discount amount
                    $discount_amount = $main_price - (($discount_percentage / 100) * $main_price);
                    $rate = $plan_durations['price'];
                    $service_type = $request['package_id'];
                    $type_one_retainer = $request['type_Value'];
                    // Add entry to the array
                    $arr[] = [
                        'rate' => $rate,
                        'service_type' => $service_type,
                        'type_one_retainer' => $type_one_retainer,
                        'plan_name' => $plan_name,
                        'plan_duration' => $formatted_duration,
                        'duration_id' => $duration_id,
                        'most_popular' =>$most_popular,
                        'main_price' => $main_price,
                        'discount_price' => $discount_amount,
                        'percentage' => $discount_percentage
                    ];
                }
            }
        }  
        if (!empty($arr)) {
            $result = DB::table('digital_service_price_widget')->insert($arr);
            if ($result) {
                return response()->json(['status'=>1, 'message'=>'Price widget created successfully!']);
            } else {
                return response()->json(['status'=>0, 'message'=>'Price widget not created!']);
            }
        } else {
            return response()->json(['status'=>0, 'message'=>'No valid data to insert!']);
        }
    }
}


    //  check duplicate data ----------------------------------------------
    
    public function add_plan_description_data(Request $request){ 
        // Validate the request
        $request->validate([
            'package_id' => [
                    'required',
                    function ($attribute, $value, $fail) {
                        if (DB::table('plan_description_price_widget')->where('service_type', $value)->exists()) {
                            $fail('This service already exists');
                        }
                    },
                ],
            'plans' => 'required|array',
            'plans.*.small_des' => 'required|string',
            'plans.*.small_features' => 'required|array'
        ], [
            'package_id.required' => 'Service not selected',
            'plans.required' => 'Plans are required',
            'plans.*.small_des.required' => 'Small description is required for each plan',
            'plans.*.small_features.required' => 'Small features are required for each plan'
        ]);
    
        $arr = [];
        if(!empty($request->all())){
            foreach($request['plans'] as $key => $value){  
                 
                $arr[] = [ 
                    'plan_name' => $key, 
                    'service_type' => $request['package_id'], 
                    'small_description' => $value['small_des'],
                    'small_features' => json_encode($value['small_features']),  
                    'button_text' => $value['button_text'],  
                ];   
            }  
            $result = DB::table('plan_description_price_widget')->insert($arr); 
            if($result){
                return response()->json(['status'=>1, 'message'=>'Price widget created successfully!']);
            } else { 
                return response()->json(['status'=>0, 'message'=>'Price widget not created!']);
            }
        }
    } 
    
    public function price_feature(Request $request){ 
        $all_pages 	= Page::where('posttype', 'pricing')->where('parent_id', '92')->get();
        return view('admin.price_widget.features' ,compact('all_pages'));
    }
    public function price_feature_add(Request $request){ 
        $data = [];
        // echo "<pre>"; print_r($request->all()); die;
        if($request->has('heading_price_widget')) {
            foreach($request->heading_price_widget as $index => $heading) {
                // Access other arrays using the same index
                $subheading = $request->subheading_price_widget[$index];
                $lite = $request->lite[$index];
                $standard = $request->standard[$index];
                $advance = $request->advance[$index];
                $enterprise = $request->enterprise[$index];
        
        
                $data[] = [
                    'service_page_id' => $request['package_id'],
                    'heading' => $heading,
                    'subheading' => json_encode($subheading), // Convert to JSON if necessary
                    'lite' => json_encode($lite), // Convert to JSON if necessary
                    'standard' => json_encode($standard), // Convert to JSON if necessary
                    'advance' => json_encode($advance), // Convert to JSON if necessary
                    'enterprise' => json_encode($enterprise) // Convert to JSON if necessary
                ];
                
               
                // Save data into the database
               
            }
            //  echo "<pre>"; print_r($data); die;
             if(!empty($data)){
                 $result = DB::table('service_price_widgets')->insert($data);
                 if($result){
                    // Return a success message
                    return redirect()->back()->with('success', 'Data has been successfully inserted.'); 
                 }
             }
             
        }
        
        

    }
    
    public function feature_list(){
        $list = DB::table('service_price_widgets')->select('service_page_id')->groupBy('service_page_id')->get();
        $lists = json_decode(json_encode($list), true); 
        // echo "<pre>";print_r($lists); die;
        return view('admin.price_widget.features_list', compact('lists'));
        
    }
    public function feature_list_edit(Request $request, $id){
        $service = DB::table('service_price_widgets')->select('service_page_id')->where('service_page_id', $id)->groupBy('service_page_id')->get(); 
        
        $list = DB::table('service_price_widgets')->where('service_page_id', $id)->get(); 
        $lists = json_decode(json_encode($list), true);
        $services = json_decode(json_encode($service), true); 
        return view('admin.price_widget.feature_edit', compact('lists', 'services'));
        
    }
    public function feature_list_update(Request $request, $id){
        //  echo "<pre>"; print_r($request->all()); die;
        $service = DB::table('service_price_widgets')->select('service_page_id')->where('service_page_id', $id)->get(); 
        
        if ($request->has('heading_price_widget')) {
            foreach ($request->heading_price_widget as $key => $heading) {
                // Update the database using the query builder
                DB::table('service_price_widgets')
                    ->where('id', $key)
                    ->update([
                        'heading' => $heading,
                        'subheading' => json_encode($request->subheading_price_widget[$key]),
                        'lite' => json_encode($request->lite[$key]),
                        'standard' => json_encode($request->standard[$key]),
                        'advance' => json_encode($request->advance[$key]),
                        'enterprise' => json_encode($request->enterprise[$key]),
                    ]);
            }
        }
         
         
        return redirect()->back()->with('success', 'Data has been successfully Updated.');
        
    }
    
    public function feature_list_delete($id){ 
        
        $obj = DB::table('service_price_widgets')->where('service_page_id', $id)->get();
        $ids = [];
        foreach($obj as $key => $val){
            $ids[] = $val->id;
        } 
        if($obj->isEmpty()) {
         
            return redirect()->back()->with('error', 'Price widget features data does not exist.');
        }
        $main= DB::table('service_price_widgets')->where('service_page_id', $id)->whereIn('id', $ids)->delete();
         
        return redirect()->back()->with('success', 'Price widget features has been deleted successfully.');
    }
    
    public function same_service_feature(Request $request, $id){
         $service = DB::table('pages')->where('id', $id)->first();
        return view('admin.price_widget.same_service_feature', compact('service'));
    }
    
    public function same_service_feature_add(Request $request, $id){ 
        $data = [];
        // echo "<pre>"; print_r($request->all()); die;
        if($request->has('heading_price_widget')) {
            foreach($request->heading_price_widget as $index => $heading) {
                // Access other arrays using the same index
                $subheading = $request->subheading_price_widget[$index];
                $lite = $request->lite[$index];
                $standard = $request->standard[$index];
                $advance = $request->advance[$index];
                $enterprise = $request->enterprise[$index];
        
        
                $data[] = [
                    'service_page_id' => $id,
                    'heading' => $heading,
                    'subheading' => json_encode($subheading), // Convert to JSON if necessary
                    'lite' => json_encode($lite), // Convert to JSON if necessary
                    'standard' => json_encode($standard), // Convert to JSON if necessary
                    'advance' => json_encode($advance), // Convert to JSON if necessary
                    'enterprise' => json_encode($enterprise) // Convert to JSON if necessary
                ];
                
               
                // Save data into the database
               
            }
            //  echo "<pre>"; print_r($data); die;
             if(!empty($data)){
                 $result = DB::table('service_price_widgets')->insert($data);
                 if($result){
                    // Return a success message
                    return redirect()->back()->with('success', 'Data has been successfully inserted.'); 
                 }
             }
             
        }
        
        

    }
    
    public function features_data_delete(Request $request){
        if($request['id'] > 0 && $request['id'] != ''){
            $find_id = DB::table('service_price_widgets')->where('id', $request['id'])->first();
            if($find_id){
               $delete = DB::table('service_price_widgets')->where('id', $request['id'])->delete();
               
               if($delete){
                   return response()->json(['status'=>1, 'message'=> 'Your Data delete Successfully!']);
               }
            }
        }
    }
    
    
    public function addon(){ 
        return view('admin.widgets.addon.addon');
    }
    public function addonIndex(){ 
        $addon = DB::table('addons')->orderBy('id', 'desc')->get();
        return view('admin.widgets.addon.index', compact('addon'));
    }
    public function addonAdd(Request $request){ 
        
        $request->validate([
            'addon.*' => 'required|string|max:255',
            'quantity.*' => 'required|integer',
            'text.*' => 'nullable|string|max:255',
            'price.*' => 'required|string|max:255',
            'type.*' => 'nullable|array',
        ]);
 
        for ($i = 0; $i < count($request->addon); $i++) {
            DB::table('addons')->insert([
                'addon_name' => $request->addon[$i],
                'quantity' => $request->quantity[$i],
                'text' => $request->text[$i],
                'price' => $request->price[$i],
                'type' => json_encode($request->type[$i]),  
                'status' => 1,  
                'created_at' => now(), 
                'updated_at' => now(), 
            ]);
        }
 
        return redirect()->back()->with('success', 'Data saved successfully!');
    
    }
    
     public function updateDeleteToggleAddon(Request $request, $id)
        { 
            $action = $request->input('action'); 
            
            if ($action === 'update') {
                
                $data = [
                    'addon_name' => $request->input('addon_name'),
                    'quantity' => $request->input('quantity'),
                    'text' => $request->input('text'),
                    'price' => $request->input('price'),
                    'type' => json_encode($request->input('type')), 
                ];  
                DB::table('addons')
                    ->where('id', $id)
                    ->update($data);
    
                return redirect()->back()->with('success', 'Item updated successfully');
            }
    
            if ($action === 'delete') {  
                
                DB::table('addons')
                    ->where('id', $id)
                    ->delete();
    
                return redirect()->back()->with('success', 'Addon deleted successfully');
            }
    
            if ($action === 'toggle') {
                $currentStatus = DB::table('addons')
                    ->where('id', $id)
                    ->value('status'); 
                
                DB::table('addons')
                    ->where('id', $id)
                    ->update(['status' => !$currentStatus]);
    
                return redirect()->back()->with('success', 'Status updated successfully');
            }
    
            return redirect()->back()->with('error', 'Invalid action');
        }
    
}
