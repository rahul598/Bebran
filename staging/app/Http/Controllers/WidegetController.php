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

class WidegetController extends Controller
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
	
    // Our strength
    public function index()
        {
            $orderby = Request()->get('orderby', 'id');
            $order = Request()->get('order', 'asc');
            $search = Request()->get('search', '');
        
            $validColumns = ['id', 'title', 'image',  'sub_title', 'status', 'created_at']; 
        
            // Ensure valid columns for ordering
            if (!in_array($orderby, $validColumns)) {
                $orderby = 'id';
            }
        
            if (!in_array($order, ['asc', 'desc'])) {
                $order = 'asc';
            }
        
            $query = DB::table('our_strength');
    
        
            if ($search) {
                $query->where(function($q) use ($search, $validColumns) {
                    foreach ($validColumns as $column) {
                        $q->orWhere($column, 'like', '%' . $search . '%');
                    }
                });
            }
        
            $lists = $query->orderBy($orderby, $order)
                ->paginate(config('admin.pagination'));
         
        
            return view('admin.widgets.index', compact('lists',   'search'));
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
            $our_strength = DB::table('our_strength')->where('id', $id)->first(); 
            return view('admin.widgets.edit', compact('our_strength'));
            
        }
        
        // Our strength
         public function updateDeleteToggle(Request $request, $id)
        {
            $action = $request->input('action'); 
            
            if ($action === 'update') {
                $data = [
                    'title' => $request->input('title'),
                    'sub_title' => $request->input('subtitle'),
                    'order_display' => $request->input('order_display'),
                ];
    
                if ($request->hasFile('menu_image')) {
                    // Retrieve the existing image path
                    $existingImage = DB::table('our_strength')->where('id', $id)->value('image');
    
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
    
                DB::table('our_strength')
                    ->where('id', $id)
                    ->update($data);
    
                return redirect()->back()->with('success', 'Item updated successfully');
            }
    
            if ($action === 'delete') {
                // Retrieve the existing image path
                $existingImage = DB::table('our_strength')->where('id', $id)->value('image');
    
                // Delete the existing image file if it exists
                if ($existingImage && File::exists(public_path('uploads/' . $existingImage))) {
                    File::delete(public_path('uploads/' . $existingImage));
                }
    
                DB::table('our_strength')
                    ->where('id', $id)
                    ->delete();
    
                return redirect()->back()->with('success', 'Item deleted successfully');
            }
    
            if ($action === 'toggle') {
                $currentStatus = DB::table('our_strength')
                    ->where('id', $id)
                    ->value('status');
                $newStatus = ($currentStatus === 'Active') ? 'Inactive' : 'Active';
                
                DB::table('our_strength')
                    ->where('id', $id)
                    ->update(['status' => $newStatus]);
    
                return redirect()->back()->with('success', 'Status updated successfully');
            }
    
            return redirect()->back()->with('error', 'Invalid action');
        }
        
        
        public function storeFormData(Request $request)
        {
            // dd($request->file('menu_image'));
            
            $request->validate([
                'title1' => 'required|string|max:255',
                'menu_image' => 'nullable|image|mimes:webp|max:2048',
                'subtitle' => 'required|string|max:255',
                'order_display' => 'required|integer',
            ]);
    
            $title1 = $request->input('title1');
            $subtitle = $request->input('subtitle');
            $order_display = $request->input('order_display');
            $image = null;
    
            if ($request->hasFile('menu_image')) {
                $file = $request->file('menu_image');
                $filename = time() . '.' . $file->getClientOriginalExtension();
    
                $file->move(public_path('uploads'), $filename);
                $image = $filename;
            }
    
            DB::table('our_strength')->insert([
                'title' => $title1,
                'image' => $image,
                'sub_title' => $subtitle,
                'order_display' => $order_display,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
    
            return redirect()->back()->with('success', 'Data saved successfully');
        }
        
}
