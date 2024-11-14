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

class ToolUseController extends Controller
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
        
            $validColumns = ['id', 'image',  'status', 'created_at'];
            $columnArray = ['image' => 'Image', 'status' => 'Status', 'created_at' => 'Created At'];
        
            // Ensure valid columns for ordering
            if (!in_array($orderby, $validColumns)) {
                $orderby = 'id';
            }
        
            if (!in_array($order, ['asc', 'desc'])) {
                $order = 'asc';
            }
        
            $query = DB::table('tools_we_use');
    
        
            if ($search) {
                $query->where(function($q) use ($search, $validColumns) {
                    foreach ($validColumns as $column) {
                        $q->orWhere($column, 'like', '%' . $search . '%');
                    }
                });
            }
            $query->where('type', 12);
            $lists = $query->orderBy($orderby, $order)
                ->paginate(config('admin.pagination'));
        
            $sortingArray = $this->getSortingArray($orderby, $order, $search, $columnArray);
            $component_content = DB::table('tools_we_use')->where('type', '11')->first();
            return view('admin.widgets.tool.index', compact('lists', 'columnArray', 'sortingArray', 'search', 'component_content'));
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
            $tools = DB::table('tools_we_use')->where('id', $id)->first(); 
            return view('admin.widgets.tool.edit', compact('tools'));
            
        }
        
        public function updateTitleTools(Request $request, $id){ 
            
            $ids = DB::table('tools_we_use')->find($id); 
            if($ids){  
                $result = DB::table('tools_we_use')->where('id', $id)->update([
                'title'=> $request->title,
                'body'=> $request->content_body
                ]);
                if($result){
                    return back()->with('success', 'Data saved successfully');
                }
            } 
        }
        // line update row
        public function updateDeleteToggleTools(Request $request, $id)
        { 
            
            $action = $request->input('action'); 
            
            if ($action == 'update') { 
                $data = [
                    'btn_url' => $request->input('image_url'),
                    // 'sub_title' => $request->input('subtitle'),
                    'order_display' => $request->input('order_display'),
                ];
    
                if ($request->hasFile('menu_image')) { 
                    $existingImage = DB::table('tools_we_use')->where('id', $id)->value('image');
     
                    if ($existingImage && File::exists(public_path('uploads/' . $existingImage))) {
                        File::delete(public_path('uploads/' . $existingImage));
                    }
     
                    $file = $request->file('menu_image');
                    $filename = time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads'), $filename);
                    $data['image'] = $filename;
                } 
                DB::table('tools_we_use')
                    ->where('id', $id)
                    ->update($data);
    
                return redirect()->back()->with('success', 'Item updated successfully');
            }
    
            if ($action === 'delete') {
                // Retrieve the existing image path
                $existingImage = DB::table('tools_we_use')->where('id', $id)->value('image');
    
                // Delete the existing image file if it exists
                if ($existingImage && File::exists(public_path('uploads/' . $existingImage))) {
                    File::delete(public_path('uploads/' . $existingImage));
                }
    
                DB::table('tools_we_use')
                    ->where('id', $id)
                    ->delete();
    
                return redirect()->back()->with('success', 'Item deleted successfully');
            }
    
            if ($action === 'toggle') {
                $currentStatus = DB::table('tools_we_use')
                    ->where('id', $id)
                    ->value('status');
                // $newStatus = ($currentStatus === 'Active') ? 'Inactive' : 'Active';
                
                DB::table('tools_we_use')
                    ->where('id', $id)
                    ->update(['status' => !$currentStatus]);
    
                return redirect()->back()->with('success', 'Status updated successfully');
            }
    
            return redirect()->back()->with('error', 'Invalid action');
        }
        
        //  insert data
        public function storeFormDataTools(Request $request)
        { 
            
            $request->validate([
                'image_url' => 'required|string|max:255',
                'menu_image' => 'nullable|image|mimes:webp|max:2048' 
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
                'type'=> 12,
                'image' => $image,
                // 'sub_title' => $subtitle,
                'order_display' => $order_display,
                'created_at' => now(),
                'updated_at' => now(),
            ];  
            if(empty($data)){
                 return redirect()->back()->with('error', 'Data not saved successfully');
            } 
            DB::table('tools_we_use')->insert($data);
    
            return redirect()->back()->with('success', 'Data saved successfully');
        }
}
