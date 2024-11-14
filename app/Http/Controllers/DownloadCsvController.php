<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Page;

class DownloadCsvController extends Controller
{
    public function downloadSampleFile()
    {
        return downloadFile('priceUpload.csv');
    }
    public function index(){
        $list = DB::table('digital_service_price_widget')->select('service_type')->groupBy('service_type')->get(); 
        $lists = OBR($list); 
        $data = [];
        
        foreach($lists as $value){
            $pageName = DB::table('pages')->where('id', $value['service_type'])->first();
            $data[] = [
                'Service Name'=> $pageName->page_name,
                'Service Id'=> $pageName->id
                ];
        }
        return outputCsv('Pricing-Id-List.csv',$data); 
    }
    public function uploadPage(){
        return view('admin.price_widget.uploadCsv'); 
    }
     
    public function price_data_download(Request $request, $id){
        $list = DB::table('digital_service_price_widget')->where('service_type',$id)->get(); 
        $lists = OBR($list); 
        $data = [];
        if(!empty($lists)){
          foreach($lists as $value){ 
            $data[] = [ 
                    'service_id'=> $value['service_type'], 
                    'plan_name'=> $value['plan_name'],
                    'plan_duration'=> $value['plan_duration'],
                    'main_price'=> $value['main_price'],
                    'discount'=> $value['percentage'], 
                    'most_popular'=> $value['most_popular'] 
                ];
        }  
        }else{
            $formattedData = [
                ['111', 'lite', 'Monthly', 100000, 50, 0],
                ['111', 'standard', 'rahuk', 100000, 25, 1],
                ['111', 'advance', 'Monthly', 125000, 20, 0],
                ['111', 'enterprise', 'Monthly', 250000, 20, 0],
                ['111', 'lite', 'Quarterly', 200000, 25, 0],
                ['111', 'standard', 'Quarterly', 100000, 25, 1],
                ['111', 'advance', 'Quarterly', 125000, 20, 0],
                ['111', 'enterprise', 'Quarterly', 250000, 20, 0],
                ['111', 'lite', 'Half Yearly', 100000, 50, 0],
                ['111', 'standard', 'Half Yearly', 100000, 25, 1],
                ['111', 'advance', 'Half Yearly', 125000, 20, 0],
                ['111', 'enterprise', 'Half Yearly', 250000, 20, 0],
                ['111', 'lite', 'Yearly', 100000, 50, 0],
                ['111', 'standard', 'Yearly', 100000, 25, 1],
                ['111', 'advance', 'Yearly', 125000, 20, 0],
                ['111', 'enterprise', 'Yearly', 250000, 20, 0]
            ];
            
            foreach ($formattedData as $value) {
                $data[] = [
                    'service_id' => $id,
                    'plan_name' => $value[1],
                    'plan_duration' => $value[2],
                    'main_price' => $value[3],
                    'discount' => $value[4],
                    'most_popular' => $value[5]
                ];
            }
             
        } 
        return outputCsv('Pricing-Data-Download.csv',$data); 
    }
    
        public function upload(Request $request)
        {    
            $request->validate([
                'file' => 'required|mimes:csv,txt|max:2048'
            ]);
            
            $serviceType = $request->input('service_type');
        
            $list = DB::table('digital_service_price_widget')
                      ->where('service_type', $serviceType)
                      ->get(); 
            $lists = OBR($list); 
            $csvData = $ids = []; 
            
            if ($request->hasFile('file')) {
                $file = $request->file('file');
                $data = parse_csv_file($file);
                 
                if (empty($lists)) {
                    // If no matching records in DB, insert new data
                    foreach ($data as $key => $value) {
                        // Check if the service ID already exists in the database
                        $service_id_check = DB::table('digital_service_price_widget')
                                              ->where('service_type', $value['service_id'])
                                              ->get(); 
                        $service_id_check = OBR($service_id_check);
        
                        if (!empty($service_id_check)) {
                            return response()->json(['status' => 0, 'message'=> 'This Service Price Already exists in our database', 'data'=> $value['service_id']]);
                        }
        
                        // Calculate the discount amount
                        $duration_id = $this->getDurationId($value['plan_duration']);
                        $discountAmount = $this->calculateDiscount($value['main_price'], $value['discount']);
                        
                        $csvData[] = [
                            'duration_id' => $duration_id,
                            'plan_name' => $value['plan_name'],
                            'plan_duration' => $value['plan_duration'], 
                            'main_price' => $value['main_price'], 
                            'discount_price' => $discountAmount, 
                            'most_popular' => $value['most_popular'], 
                            'percentage' => $value['discount'], 
                            'service_type' => $value['service_id'], 
                        ];
                    }
        
                    if (!empty($csvData)) {
                        $result = DB::table('digital_service_price_widget')->insert($csvData);
                        if ($result) {
                            return response()->json(['status' => 1, 'message'=> 'Pricing Data inserted successfully!']);
                        } else {
                            return response()->json(['status' => 0, 'message'=> 'Pricing Data was not inserted successfully!']);
                        }
                    }
                } else { 
                    foreach ($data as $key => $value) {
                        if ($value['service_id'] !== $serviceType) {
                            return response()->json(['status' => 0, 'message' => 'Service Type Mismatch', 'data' => $value['service_id']]);
                        }
                    } 
                    
                    foreach ($data as $key => $value) {
                        $duration_id = $this->getDurationId($value['plan_duration']);
                        $discountAmount = $this->calculateDiscount($value['main_price'], $value['discount']);
        
                        $csvData[] = [
                            'duration_id' => $duration_id,
                            'plan_name' => $value['plan_name'],
                            'plan_duration' => $value['plan_duration'], 
                            'main_price' => $value['main_price'], 
                            'discount_price' => $discountAmount, 
                            'most_popular' => $value['most_popular'], 
                            'percentage' => $value['discount'], 
                            'service_type' => $value['service_id'], 
                        ];
                    } 
                    if (!empty($csvData)) {
                        foreach ($lists as $key => $valId) {
                            $ids[] = $valId['id'];
                        }  
                        foreach ($csvData as $key => $updateData) { 
                            $id = $ids[$key] ?? null;
        
                            DB::table('digital_service_price_widget')
                            ->where('service_type', $updateData['service_type'])
                            ->where('duration_id', $updateData['duration_id'])
                            ->where('plan_name', $updateData['plan_name'])
                            ->update([
                                'plan_duration' => $updateData['plan_duration'], 
                                'main_price' => $updateData['main_price'],
                                'discount_price' => $updateData['discount_price'],
                                'most_popular' => $updateData['most_popular'],
                                'percentage' => $updateData['percentage']
                            ]);

                        }
        
                        return response()->json(['status' => 1, 'message' => 'Pricing Data updated successfully!']);
                    } else {
                        return response()->json(['status' => 0, 'message'=> 'Pricing Data was not updated successfully!']);
                    }
                }
            } else {
                return response()->json(['status' => 0, 'message'=> 'No file was uploaded']);
            }
        }
        
        // Helper function to get duration_id based on plan_duration
        // private function getDurationId($plan_duration)
        // {
        //     switch (ucfirst($plan_duration)) {
        //         case 'Monthly':
        //             return 1;
        //         case 'Quarterly':
        //             return 2;
        //         case 'Yearly':
        //             return 4;
        //         case 'Half Yearly':
        //             return 3;
        //         default:
        //             return null;
        //     }
        // }
        private function getDurationId($plan_duration)
        {
            // Normalize the input by converting to lowercase and replacing underscores with spaces
            $normalized_duration = str_replace('_', ' ', strtolower($plan_duration));
        
            switch ($normalized_duration) {
                case 'monthly':
                    return 1;
                case 'quarterly':
                    return 2;
                case 'half yearly':
                    return 3;
                case 'yearly':
                    return 4;
                default:
                    return null;
            }
        }

        
        // Helper function to calculate the discount amount
        private function calculateDiscount($mainValue, $discountPercentage)
        {
            // Debugging output
            // echo "Main Value: $mainValue, Discount Percentage: $discountPercentage\n";
            
            // Check if the discount percentage is 0
            if ($discountPercentage == 0) {
                // echo "No discount applied, returning original value: $mainValue\n";
                return $mainValue;
            }
            
            // Calculate the discount amount
            $discountAmount = ($discountPercentage / 100) * $mainValue;
            // echo "Discount Amount: $discountAmount\n";
            
            // Return the main value after applying the discount
            $finalValue = $mainValue - $discountAmount;
            // echo "Final Value after discount: $finalValue\n";
            return $finalValue;        
        }


    
    //  for features csv
    function featureCsvSample(){
        return downloadFile('feature_data_new.csv');
    }
    public function featureExistData(Request $request) {
        $list = DB::table('service_price_widgets')->where('service_page_id', 121)->get(); 
        $data = [];
    
        foreach ($list as $value) {
            $pageName = DB::table('pages')->where('id', $value->service_page_id)->first();
    
            $subheadings = json_decode($value->subheading, true);
            $lite = json_decode($value->lite, true);
            $standard = json_decode($value->standard, true);
            $advance = json_decode($value->advance, true);
            $enterprise = json_decode($value->enterprise, true);
    
            foreach ($subheadings as $index => $subheading) {
                $data[] = [
                    'Service Name' => $pageName->page_name,
                    'Service Id' => $value->service_page_id,
                    'Heading' => $value->heading,
                    'Sub heading' => $subheading,
                    'Lite' => $lite[$index] ?? '',
                    'Standard' => $standard[$index] ?? '',
                    'Advance' => $advance[$index] ?? '',
                    'Enterprise' => $enterprise[$index] ?? '',
                ];
            }
        }
    
        return outputCsv('FeatureList.csv', $data);
    }
 

    public function featureUploadPage(){
        return view('admin.price_widget.featureCsvUploder'); 
    }
    public function featureUpload(Request $request){ 
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048', // Allow only CSV and TXT files up to 2MB
        ]);
        $csvData = $heading = $subheading = $service_page_id = $lite = $standard = $advance = $enterprise = [];
        
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $data = parse_csv_file($file);   
            
            $groupedData = [];

                    foreach ($data as $value) {
                        $heading = $value['heading'];
                     
                        if (!isset($groupedData[$heading])) {
                            $groupedData[$heading] = [
                                'service_page_id' => $value['service_id'],
                                'heading' => $heading,
                                'subheading' => [],
                                'lite' => [],
                                'standard' => [],
                                'advance' => [],
                                'enterprise' => [],
                                'subheading_high' => []
                            ];
                        }
                     
                        $groupedData[$heading]['subheading'] = array_merge(
                            $groupedData[$heading]['subheading'],
                            (array)$value['subheading']
                        );
                        
                        $groupedData[$heading]['subheading_high'] = array_merge($groupedData[$heading]['subheading_high'], (array)$value['subheading_highlight']
                        );
                    
                        // Handle the "check" conditions
                        $groupedData[$heading]['lite'][] = ($value['lite'] == 'check') ? 'active' : $value['lite'];
                        $groupedData[$heading]['standard'][] = ($value['standard'] == 'check') ? 'active' : $value['standard'];
                        $groupedData[$heading]['advance'][] = ($value['advance'] == 'check') ? 'active' : $value['advance'];
                        $groupedData[$heading]['enterprise'][] = ($value['enterprise'] == 'check') ? 'active' : $value['enterprise'];
                    } 
                    $arr = []; 
                    foreach ($groupedData as $group) {
                        $arr[] = [
                            'service_page_id' => $group['service_page_id'],
                            'heading' => $group['heading'],
                            'subheading' => json_encode($group['subheading']),
                            'lite' => json_encode($group['lite']),
                            'standard' => json_encode($group['standard']),
                            'advance' => json_encode($group['advance']),
                            'enterprise' => json_encode($group['enterprise']),
                            'subheading_high' => json_encode($group['subheading_high'])
                        ];
                    }
          try { 
                DB::beginTransaction(); 
                if (!empty($arr)) {
                    // Insert the data into the table
                    $result = DB::table('service_price_widgets')->insert($arr);
            
                    // Check the insertion result
                    if ($result) {
                        // Commit the transaction if successful
                        DB::commit();
                        return response()->json(['status' => 1, 'message'=> 'Feature Data inserted successfully!']);
                    } else {
                        // Rollback the transaction if insertion fails
                        DB::rollBack();
                        return response()->json(['status' => 0, 'message'=> 'Feature Data insertion failed!']);
                    }
                } else {
                    // Rollback the transaction if the array is empty
                    DB::rollBack();
                    return response()->json(['status' => 0, 'message'=> 'No data to insert!']);
                }
            
            } catch (\Exception $e) {
                // Rollback the transaction in case of any exception
                DB::rollBack();
            
                // Log the error for debugging purposes
                // Log::error('Error inserting feature data: ' . $e->getMessage());
            
                // Return a JSON response with an error message
                return response()->json(['status' => 0, 'message'=> 'An error occurred: ' . $e->getMessage()]);
            }
        }
    }
    
    
    public function price_data_download_features(Request $request, $id){
        $list = DB::table('service_price_widgets')->where('service_page_id',$id)->get(); 
        $pageName = DB::table('pages')->where('id', $id)->first(); 
        $lists = OBR($list); 
        $data = [];
        if(!empty($lists)){
            foreach ($lists as $value) { 
                
                $subheadings = json_decode($value['subheading'], true); 
                $lite = json_decode($value['lite'], true);
                $standard = json_decode($value['standard'], true);
                $advance = json_decode($value['advance'], true);
                $enterprise = json_decode($value['enterprise'], true);
                $subheading_high = json_decode($value['subheading_high'], true);
        
                foreach ($subheadings as $index => $subheading) {
                    $data[] = [ 
                        'service_id' => $value['service_page_id'],
                        'heading' => $value['heading'],
                        'subheading' => $subheading,
                        'lite' => $lite[$index] ?? '',
                        'standard' => $standard[$index] ?? '',
                        'advance' => $advance[$index] ?? '',
                        'enterprise' => $enterprise[$index] ?? '',
                        'subheading_highlight' => $subheading_high[$index] ?? '',
                    ];
                }
            } 
        }else{
            $formattedData = [
                    ['Resources', 'Dedicated Resources', 1, 2, 2, 2],
                    ['Resources', 'SEO Executive', 1, 1, 1, 1],
                    ['Resources', 'Asst. SEO Executive', 0, 1, 1, 1],
                    ['Resources', 'Shared Resources', 2, 2, 3, 4],
                    ['Resources', 'SEO Manager', 1, 1, 1, 1],
                    ['Resources', 'Project Manager', '', '', 1],
                    ['Resources', 'Graphic Designer', '', 1, 1],
                    ['Resources', 'Content Writer', 1, 1, 1, 1],
                    ['Initial Setup & Analysis', 'WhatsApp Group Creation - Team Collaboration', 'Active', 'Active', 'Active', 'Active'],
                    ['Initial Setup & Analysis', '0 Day Report for MOM Growth Comparison', 'Active', 'Active', 'Active', 'Active'],
                    ['Initial Setup & Analysis', 'GMB - Setup and Review', 'Active', 'Active', 'Active', 'Active'],
                    ['Initial Setup & Analysis', 'Business Brief Meeting', 'Active', 'Active', 'Active', 'Active']
                ];

            
            foreach ($formattedData as $value) {
                $data[] = [
                        'Service Name' => $pageName->page_name,
                        'Service Id' => $id,
                        'Heading' => $formattedData[0],
                        'Sub heading' => $formattedData[1],
                        'Lite' => $formattedData[2] ?? '',
                        'Standard' => $formattedData[3] ?? '',
                        'Advance' => $formattedData[4] ?? '',
                        'Enterprise' => $formattedData[5] ?? '',
                    ];
            }
             
        }
        
        return outputCsv('Pricing-Data-Download-Features.csv',$data); 
    }
    
    public function features_list_upload(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048', // Allow only CSV and TXT files up to 2MB
        ]);
    
        $list = DB::table('service_price_widgets')->where('service_page_id', $request['service_type'])->get(); 
        $lists = OBR($list);
        $arr = $csvData = $heading = $subheading = $service_page_id = $lite = $standard = $advance = $enterprise = $ids = $highlight = []; 
        if (!empty($lists)) {
            
            
            
                if ($request->hasFile('file')) { 
                
                    $file = $request['file']; 
                    $data = parse_csv_file($file); 
                    foreach ($data as $key => $value) {
                        if ($value['service_id'] !== $request['service_type']) {
                            return response()->json(['status' => 0, 'message' => 'Service Type Mismatch', 'data' => $value['service_id']]);
                        }
                    } 
                    $delete = DB::table('service_price_widgets')->where('service_page_id', $request['service_type'])->delete(); 
                    if($delete){
                    $groupedData = [];

                    foreach ($data as $value) {
                        $heading = $value['heading'];
                     
                        if (!isset($groupedData[$heading])) {
                            $groupedData[$heading] = [
                                'service_page_id' => $value['service_id'],
                                'heading' => $heading,
                                'subheading' => [],
                                'lite' => [],
                                'standard' => [],
                                'advance' => [],
                                'enterprise' => [],
                                'subheading_high' => []
                            ];
                        }
                     
                        $groupedData[$heading]['subheading'] = array_merge(
                            $groupedData[$heading]['subheading'],
                            (array)$value['subheading']
                        );
                        
                        $groupedData[$heading]['subheading_high'] = array_merge(
                            $groupedData[$heading]['subheading_high'],
                            (array)$value['subheading_highlight']
                        );
                    
                        // Handle the "check" conditions
                        $groupedData[$heading]['lite'][] = ($value['lite'] == 'check') ? 'active' : $value['lite'];
                        $groupedData[$heading]['standard'][] = ($value['standard'] == 'check') ? 'active' : $value['standard'];
                        $groupedData[$heading]['advance'][] = ($value['advance'] == 'check') ? 'active' : $value['advance'];
                        $groupedData[$heading]['enterprise'][] = ($value['enterprise'] == 'check') ? 'active' : $value['enterprise'];
                    }
                     
                    $arr = []; 
                    foreach ($groupedData as $group) {
                        $arr[] = [
                            'service_page_id' => $group['service_page_id'],
                            'heading' => $group['heading'],
                            'subheading' => json_encode($group['subheading']),
                            'lite' => json_encode($group['lite']),
                            'standard' => json_encode($group['standard']),
                            'advance' => json_encode($group['advance']),
                            'enterprise' => json_encode($group['enterprise']),
                            'subheading_high' => json_encode($group['subheading_high'])
                        ];
                    }
                    // pre($arr);
                    try { 
                        DB::beginTransaction();
                        
                        if (!empty($arr)) {
                            // Insert the data into the table
                            $result = DB::table('service_price_widgets')->insert($arr);
                    
                            // Check the insertion result
                            if ($result) {
                                // Commit the transaction if successful
                                DB::commit();
                                return response()->json(['status' => 1, 'message'=> 'Feature Data inserted successfully!']);
                            } else {
                                // Rollback the transaction if insertion fails
                                DB::rollBack();
                                return response()->json(['status' => 0, 'message'=> 'Feature Data insertion failed!']);
                            }
                        } else {
                            // Rollback the transaction if the array is empty
                            DB::rollBack();
                            return response()->json(['status' => 0, 'message'=> 'No data to insert!']);
                        }
                    
                    } catch (\Exception $e) {
                        // Rollback the transaction in case of any exception
                        DB::rollBack();
                    
                        // Log the error for debugging purposes
                        // Log::error('Error inserting feature data: ' . $e->getMessage());
                    
                        // Return a JSON response with an error message
                        return response()->json(['status' => 0, 'message'=> 'An error occurred: ' . $e->getMessage()]);
                    }
                }
            }
            
        } else {
            return response()->json(['error' => 'No data found in service_price_widgets for the selected service type.']);
        }
    }
 
    
    // result csv currect data download
        public function result_overview($id){
            $page = Page::where('id', $id)->first();
            
            $csvs = json_decode($page->result_overview_csv);
            $csv = OBR($csvs);
            
            return outputCsv('Result-Overview.csv', $csv);
        }
        public function keyword_data_csv($id){
            $page = Page::where('id', $id)->first(); 
            $csvs = json_decode($page->keywords_csv);
            $csv = OBR($csvs);
            
            return outputCsv('Keyword-data.csv', $csv);
        }
        public function keyword_growth_csv($id){
            $page = Page::where('id', $id)->first(); 
            $csvs = json_decode($page->keyword_growth_csv);
            $csv = OBR($csvs);
            
            return outputCsv('Keyword-growth.csv', $csv);
        }
}
