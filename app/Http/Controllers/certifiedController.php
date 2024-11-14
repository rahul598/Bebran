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

class certifiedController extends Controller
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
        
            // Ensure valid columns for ordering
            if (!in_array($orderby, $validColumns)) {
                $orderby = 'id';
            }
        
            if (!in_array($order, ['asc', 'desc'])) {
                $order = 'asc';
            }
        
            $query = DB::table('certificate_digital');
    
        
            if ($search) {
                $query->where(function($q) use ($search, $validColumns) {
                    foreach ($validColumns as $column) {
                        $q->orWhere($column, 'like', '%' . $search . '%');
                    }
                });
            }
            $query->where('type', 8);
            $lists = $query->orderBy($orderby, $order)
                ->paginate(config('admin.pagination'));
         
            $component_content = DB::table('certificate_digital')->where('type', '7')->first();
            
            return view('admin.widgets.certificate.index', compact('lists',  'search', 'component_content'));
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
            $tools = DB::table('certificate_digital')->where('id', $id)->first(); 
            return view('admin.widgets.tool.edit', compact('tools'));
            
        }
        
        public function updateTitleContent(Request $request, $id){
            
            $ids = DB::table('certificate_digital')->find($id); 
            if($ids){  
                $result = DB::table('certificate_digital')->where('id', $id)->update([
                'title'=> $request->title,
                'body'=> $request->content_body
                ]);
                if($result){
                    return back()->with('success', 'Data saved successfully');
                }
            } 
        }
        
        
        public function updateDeleteToggleCertified(Request $request, $id)
        { 
            // dd($request->all());
            $action = $request->input('action'); 
            
            if ($action === 'update') { 
                $data = [
                    'title' => $request->input('title'),
                    'btn_url' => $request->input('image_url'),
                    'order_display' => $request->input('order_display'),
                    'embaded_code' => $request->input('embaded_code'),
                ];
    
                if ($request->hasFile('menu_image')) {
                    // Retrieve the existing image path
                    $existingImage = DB::table('certificate_digital')->where('id', $id)->value('image');
    
                    // Delete the existing image file if it exists
                    if ($existingImage && File::exists(public_path('uploads/' . $existingImage))) {
                        File::delete(public_path('uploads/' . $existingImage));
                    }
    
                    // Upload the new image
                    $file = $request->file('menu_image');
                    $filename = time() . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('uploads'), $filename);
                    $data['image'] = $filename;
                }
    
                DB::table('certificate_digital')
                    ->where('id', $id)
                    ->update($data);
    
                return redirect()->back()->with('success', 'Item updated successfully');
            }
    
            if ($action === 'delete') {
                // Retrieve the existing image path
                $existingImage = DB::table('certificate_digital')->where('id', $id)->value('image');
    
                // Delete the existing image file if it exists
                if ($existingImage && File::exists(public_path('uploads/' . $existingImage))) {
                    File::delete(public_path('uploads/' . $existingImage));
                }
    
                DB::table('certificate_digital')
                    ->where('id', $id)
                    ->delete();
    
                return redirect()->back()->with('success', 'Item deleted successfully');
            }
    
            if ($action === 'toggle') {
                $currentStatus = DB::table('certificate_digital')
                    ->where('id', $id)
                    ->value('status');
                // $newStatus = ($currentStatus === 'Active') ? 'Inactive' : 'Active';
                
                DB::table('certificate_digital')
                    ->where('id', $id)
                    ->update(['status' => !$currentStatus]);
    
                return redirect()->back()->with('success', 'Status updated successfully');
            }
    
            return redirect()->back()->with('error', 'Invalid action');
        }
        
        
        //  insert data
        public function storeFormDataCertified (Request $request)
        {
            // dd($request->file('menu_image'));
            
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
                'type'=> 8,
                'image' => $image,
                'embaded_code' => $request->input('embaded_code'),
                // 'sub_title' => $subtitle,
                'order_display' => $order_display,
                'created_at' => now(),
                'updated_at' => now(),
            ];
             
            if(empty($data)){
                 return redirect()->back()->with('error', 'Data not saved successfully');
            }
            DB::table('certificate_digital')->insert($data);
    
            return redirect()->back()->with('success', 'Data saved successfully');
        }
        
}
