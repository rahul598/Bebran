<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use Auth;
use Session;
use URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class VideoTestimonials extends Controller
{
    public function __construct()
	{
		// $this->middleware(['auth','verified']);
		$this->middleware(['auth']);
	    $this->middleware(function ($request, $next) {
	        $this->user= Auth::user();
	        if ($this->user->role_id!='1') {
	        	return redirect()->route('login');
			}
	        return $next($request);
	    });
	} 
    public function index()
        {
            $orderby = Request()->get('orderby', 'id');
            $order = Request()->get('order', 'asc');
            $search = Request()->get('search', '');
        
            $validColumns = ['id', 'video_img', 'status', 'created_at'];
            $columnArray = ['video_img' => 'Video', 'status' => 'Status', 'created_at' => 'Created At'];
        
            // Ensure valid columns for ordering
            if (!in_array($orderby, $validColumns)) {
                $orderby = 'id';
            }
        
            if (!in_array($order, ['asc', 'desc'])) {
                $order = 'asc';
            }
        
            $query = DB::table('video_tutorails');
    
        
            if ($search) {
                $query->where(function($q) use ($search, $validColumns) {
                    foreach ($validColumns as $column) {
                        $q->orWhere($column, 'like', '%' . $search . '%');
                    }
                });
            }
            $query->where('type', 25);
            $lists = $query->orderBy($orderby, $order)
                ->paginate(config('admin.pagination'));
        
            $sortingArray = $this->getSortingArray($orderby, $order, $search, $columnArray);
            $component_content = DB::table('video_tutorails')->where('type', '24')->first();
            return view('admin.widgets.video_tutorials.index', compact('lists', 'columnArray', 'sortingArray', 'search', 'component_content'));
        }
     private function getSortingArray($orderby, $order, $search, $columnArray)
        {
            $sortingArray = [];
        
            foreach ($columnArray as $key => $value) {
                $sortingClass = 'sorting';
                $sortingUrlOrder = 'asc';
        
                if ($orderby == $key) {
                    $sortingClass = ($order == 'asc') ? 'sorting_asc' : 'sorting_desc';
                    $sortingUrlOrder = ($order == 'asc') ? 'desc' : 'asc';
                }
        
                $sortingUrl = 'portfolio_category?' . ($search ? 'search=' . $search . '&' : '') . 'orderby=' . $key . '&order=' . $sortingUrlOrder;
                $sortingArray[$key] = ['sorting_class' => $sortingClass, 'sorting_url' => $sortingUrl];
            }
        
            return $sortingArray;
        }
        
        public function edit($id){ 
            $tools = DB::table('video_tutorails')->where('id', $id)->first(); 
            return view('admin.widgets.video_tutorials.edit', compact('tools'));
            
        }
        
        // -----------------------//  insert data -----------------------
        public function storeFormDataVideo(Request $request)
        {
            // Validate the incoming request
            $validated = $request->validate([
                'title' => 'nullable|string|max:255',
                // 'image_url' => 'nullable|string|max:255',
                'menu_image' => 'nullable|image|mimes:webp|max:2048',
                'video_image' => 'nullable|image|mimes:webp|max:2048',
                'video_url' => 'nullable|string|max:255',
                'content_body' => 'nullable|string',
                'order_display' => 'nullable|integer',
            ]);
        
            // Prepare the data to be inserted
            $data = [
                'type' => 25,
                'title' => $request->input('title'),
                // 'btn_url' => $request->input('image_url'),
                'video_url' => $request->input('video_url'),
                'body' => $request->input('content_body'),
                'order_display' => $request->input('order_display'),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        
            // Handle menu image upload
            if ($request->hasFile('menu_image')) {
                $menuImage = $request->file('menu_image');
                $menuImageName = time() . '_menu.' . $menuImage->getClientOriginalExtension();
                $menuImage->move(public_path('uploads'), $menuImageName);
                $data['image'] = $menuImageName;
            }
        
            // Handle video image upload
            if ($request->hasFile('video_image')) {
                $videoImage = $request->file('video_image');
                $videoImageName = time() . '_video.' . $videoImage->getClientOriginalExtension();
                $videoImage->move(public_path('uploads'), $videoImageName);
                $data['video_img'] = $videoImageName;
            } 
            // Insert the data into the database
            DB::table('video_tutorails')->insert($data);
        
            // Redirect back with a success message
            return redirect()->back()->with('success', 'Data added successfully');
        }
        
        public function storeFormDataVideo_old(Request $request)
        {
            dd($request->file('menu_image'));
            
            $request->validate([
                'image_url' => 'required|string|max:255',
                'menu_image' => 'nullable|image|mimes:webp|max:2048', 
                'order_display' => 'required|integer',
            ]);
    
            $image_url = $request->input('image_url');
            // $subtitle = $request->input('subtitle');
            $order_display = $request->input('order_display');
            $image = null;
    
            if ($request->hasFile('menu_image')) {
                $file = $request->file('menu_image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
    
                $file->move(public_path('uploads'), $filename);
                $image = $filename;
            }
            $data = [
                'btn_url' => $image_url,
                'type'=> 22,
                'image' => $image,
                // 'sub_title' => $subtitle,
                'order_display' => $order_display,
                'created_at' => now(),
                'updated_at' => now(),
            ]; 
            if(empty($data)){
                 return redirect()->back()->with('error', 'Data not saved successfully');
            }
            DB::table('video_tutorails')->insert($data);
    
            return redirect()->back()->with('success', 'Data saved successfully');
        }
        
        
        // line update row--------------------------------------------
        // public function updateDeleteToggleVideo(Request $request, $id)
        // { 
            
        //     $action = $request->input('action'); 
            
        //     if ($action === 'update') { 
        //         $data = [
        //             'title' => $request->input('title'),
        //             'sub_title' => $request->input('subtitle'),
        //             'order_display' => $request->input('order_display'),
        //         ];
    
        //         if ($request->hasFile('menu_image')) {
        //             // Retrieve the existing image path
        //             $existingImage = DB::table('tools_we_use')->where('id', $id)->value('image');
    
        //             // Delete the existing image file if it exists
        //             if ($existingImage && File::exists(public_path('uploads/' . $existingImage))) {
        //                 File::delete(public_path('uploads/' . $existingImage));
        //             }
    
        //             // Upload the new image
        //             $file = $request->file('menu_image');
        //             $filename = time() . '.' . $file->getClientOriginalExtension();
        //             $file->move(public_path('uploads'), $filename);
        //             $data['image'] = $filename;
        //         }
    
        //         DB::table('video_tutorails')
        //             ->where('id', $id)
        //             ->update($data);
    
        //         return redirect()->back()->with('success', 'Item updated successfully');
        //     }
    
        //     if ($action === 'delete') {
        //         // Retrieve the existing image path
        //         $existingImage = DB::table('video_tutorails')->where('id', $id)->value('image');
    
        //         // Delete the existing image file if it exists
        //         if ($existingImage && File::exists(public_path('uploads/' . $existingImage))) {
        //             File::delete(public_path('uploads/' . $existingImage));
        //         }
    
        //         DB::table('video_tutorails')
        //             ->where('id', $id)
        //             ->delete();
    
        //         return redirect()->back()->with('success', 'Item deleted successfully');
        //     }
    
        //     if ($action === 'toggle') {
        //         $currentStatus = DB::table('video_tutorails')
        //             ->where('id', $id)
        //             ->value('status');
        //         // $newStatus = ($currentStatus === 'Active') ? 'Inactive' : 'Active';
                
        //         DB::table('video_tutorails')
        //             ->where('id', $id)
        //             ->update(['status' => !$currentStatus]);
    
        //         return redirect()->back()->with('success', 'Status updated successfully');
        //     }
    
        //     return redirect()->back()->with('error', 'Invalid action');
        // }
        
        public function updateDeleteToggleVideo(Request $request, $id)
        {
            
            // Get the action from the request
            $action = $request->input('action');
        
            if ($action === 'update') { 
                // dd($request['content_body']);
                $request->validate([
                    'title' => 'required|string|max:255',
                    'menu_image' => 'nullable|image|mimes:webp|max:2048',
                    'video_image' => 'nullable|image|mimes:webp|max:2048',
                    'video_url' => 'nullable|string|max:255',
                    'content_body' => 'nullable|string',
                    'order_display' => 'required|integer',
                ]);
        
                // Get the existing item
                $item = DB::table('video_tutorails')->where('id', $id)->first();
                if (!$item) {
                    return redirect()->back()->with('error', 'Item not found');
                }
        
                // Prepare the data to update
                $data = [
                    'title' => $request->input('title'),
                    'video_url' => $request->input('video_url'),
                    'body' => $request['content_body'],
                    'order_display' => $request->input('order_display'),
                    'updated_at' => now(),
                ];
        
                // Handle menu image upload
                if ($request->hasFile('menu_image')) {
                    // Delete old image if it exists
                    if ($item->image && File::exists(public_path('uploads/' . $item->image))) {
                        File::delete(public_path('uploads/' . $item->image));
                    }
        
                    $menuImage = $request->file('menu_image');
                    $menuImageName = time() . '_menu.' . $menuImage->getClientOriginalExtension();
                    $menuImage->move(public_path('uploads'), $menuImageName);
                    $data['image'] = $menuImageName;
                }
        
                // Handle video image upload
                if ($request->hasFile('video_image')) {
                    // Delete old video image if it exists
                    if ($item->video_img && File::exists(public_path('uploads/' . $item->video_img))) {
                        File::delete(public_path('uploads/' . $item->video_img));
                    }
        
                    $videoImage = $request->file('video_image');
                    $videoImageName = time() . '_video.' . $videoImage->getClientOriginalExtension();
                    $videoImage->move(public_path('uploads'), $videoImageName);
                    $data['video_img'] = $videoImageName;
                }
        
                // Update the item in the database
                DB::table('video_tutorails')->where('id', $id)->update($data);
        
                return redirect()->back()->with('success', 'Item updated successfully');
            }
        
            if ($action === 'delete') {
                // Get the existing item
                $item = DB::table('video_tutorails')->where('id', $id)->first();
                if (!$item) {
                    return redirect()->back()->with('error', 'Item not found');
                }
        
                // Delete the images if they exist
                if (!empty($item->image)  && File::exists(public_path('uploads/' . $item->image))) {
                    File::delete(public_path('uploads/' . $item->image));
                }
                if (!empty($item->video_img) && File::exists(public_path('uploads/' . $item->video_img))) {
                    File::delete(public_path('uploads/' . $item->video_img));
                }
        
                // Delete the item from the database
                DB::table('video_tutorails')->where('id', $id)->delete();
        
                return redirect()->back()->with('success', 'Item deleted successfully');
            }
        
            if ($action === 'toggle') {
                // Get the current status
                $currentStatus = DB::table('video_tutorails')->where('id', $id)->value('status');
        
                // Toggle the status
                DB::table('video_tutorails')->where('id', $id)->update(['status' => $currentStatus == 1 ? 0 : 1]);
        
                return redirect()->back()->with('success', 'Status updated successfully');
            }
        
            return redirect()->back()->with('error', 'Invalid action');
        }
        
        //  ------------- update title ------------------------
        public function updateTitleVideo(Request $request, $id){  
            $ids = DB::table('video_tutorails')->find($id); 
            if($ids){  
                $result = DB::table('video_tutorails')->where('id', $id)->update([
                'title'=> $request->title,
                'body'=> $request->content_body
                ]);
                if($result){
                    return back()->with('success', 'Data saved successfully');
                }
            } 
        }
}
