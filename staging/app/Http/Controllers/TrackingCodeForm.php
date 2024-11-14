<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB; 

class TrackingCodeForm extends Controller
{
    public function index(Request $request){
	    $lists  = DB::table('tracking_code_form')->get();  
	    return view('admin.enquiry.tracking_code.index', compact('lists'));
	}
	
	public function updateDeleteToggleTrack(Request $request, $id)
        { 
            // dd($request->all());
            $action = $request->input('action'); 
            
            if ($action === 'update') { 
                $data = [
                    'tracking_code' => $request->input('tracking_code'),
                    'placement' => $request->input('placement'), 
                    'page_placement' => $request->input('page_placement'), 
                ]; 
                
                DB::table('tracking_code_form')
                    ->where('id', $id)
                    ->update($data);
    
                return redirect()->back()->with('success', 'Item updated successfully');
            }
    
            if ($action === 'delete') { 
                DB::table('tracking_code_form')
                    ->where('id', $id)
                    ->delete();
    
                return redirect()->back()->with('success', 'Item deleted successfully');
            }
    
            if ($action === 'toggle') { 
                $currentStatus = DB::table('tracking_code_form')
                    ->where('id', $id)
                    ->value('status');
                // $newStatus = ($currentStatus === 'Active') ? 'Inactive' : 'Active';
                
                DB::table('tracking_code_form')
                    ->where('id', $id)
                    ->update(['status' => DB::raw("IF(status = '1', '0', '1')")]);
    
                return redirect()->back()->with('success', 'Status updated successfully');
            }
    
            return redirect()->back()->with('error', 'Invalid action');
        }
        
        
        //  insert data
        public function storeFormDataTrack (Request $request)
        {
            // dd($request->file('menu_image'));
            
            $request->validate([
                'tracking_code' => 'required',  
                'placement' => 'required|string', 
                'page_placement' => 'required|string', 
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
                'tracking_code' => $request->tracking_code, 
                'placement' => $request->placement, 
                'page_placement' => $request->page_placement, 
                'created_at' => now(),
                'updated_at' => now(),
            ];
             
            if(empty($data)){
                 return redirect()->back()->with('error', 'Data not saved successfully');
            }
            DB::table('tracking_code_form')->insert($data);
    
            return redirect()->back()->with('success', 'Data saved successfully');
        }
}
