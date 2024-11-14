<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Redirect;
use Auth;
use Session;
use URL;
use Illuminate\Support\Facades\Validator;

class SeoResultController extends Controller
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
        
            $validColumns = ['id', 'name', 'status', 'created_at'];
            $columnArray = ['name' => 'Name', 'status' => 'Status', 'created_at' => 'Created At'];
        
            // Ensure valid columns for ordering
            if (!in_array($orderby, $validColumns)) {
                $orderby = 'id';
            }
        
            if (!in_array($order, ['asc', 'desc'])) {
                $order = 'asc';
            }
        
            $query = DB::table('seoResultCategory');

        
            if ($search) {
                $query->where(function($q) use ($search, $validColumns) {
                    foreach ($validColumns as $column) {
                        $q->orWhere($column, 'like', '%' . $search . '%');
                    }
                });
            }
        
            $lists = $query->orderBy($orderby, $order)
                ->paginate(config('admin.pagination'));
        
            $sortingArray = $this->getSortingArray($orderby, $order, $search, $columnArray);
        
            return view('admin.seoResultCategory.index', compact('lists', 'columnArray', 'sortingArray', 'search'));
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
        
    public function add()
	{
		return view('admin.seoResultCategory.add');
	}

	public function insert(Request $request)
	{
		$data = $request->all();

		$rules = array(
			'name' => 'required|string|max:255',
			'slug' => 'required|string|max:255|unique:portfolio_category',
			'status' => 'required|int'
		);

		$validator = Validator::make($data , $rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
                // Extracting request data
                $name = $request->name;
                $slug = $request->slug;
                $status = $request->status;
        
                // Inserting data using Query Builder
                DB::table('seoResultCategory')->insert([
                    'name' => $name,
                    'slug' => $slug,
                    'status' => $status,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
        
                // Redirecting back with success message
                return redirect()->back()->with('success', 'Portfolio Category has been added successfully.');
        
            } catch (\Exception $e) {
                // Handling exceptions and redirecting back with error message
                return Redirect::back()->withErrors(['errordetailsd' => $e->getMessage()])->withInput($request->all());
            }

		}


	}
	
	public function edit($id)
	{
		$list = DB::table('seoResultCategory')->where('id', $id)->first();
		if (!$list) {
			return redirect()->to('seoResultCategory')->with('error', 'Opps!! sorry!! problem occurred.Please try again!');
		}
		return view('admin.seoResultCategory.edit', compact('list'));
	}
    public function update(Request $request)
        {
            $id = $request->id;
            $name = $request->name;
            $slug = $request->slug;
            $status = $request->status;
        
            $rules = [
                'name' => 'required|string|max:255',
                'slug' => 'required|string|max:255|unique:seoResultCategory,slug,' . $id,
                'status' => 'required|int',
            ];
        
            $validator = Validator::make($request->all(), $rules);
        
            if ($validator->fails()) {
                return Redirect::to(Admin_Prefix . 'seoResultCategory/edit/' . $id)
                    ->withErrors($validator)
                    ->withInput();
            }
        
            try {
                // Update using Query Builder
                DB::table('seoResultCategory')
                    ->where('id', $id)
                    ->update([
                        'name' => $name,
                        'slug' => $slug,
                        'status' => $status,
                        'updated_at' => now(),
                    ]);
        
                return redirect()->back()->with('success', 'Seo Result Category has been updated successfully.');
            } catch (\Exception $e) {
                return Redirect::back()->withErrors(['errordetailsd' => $e->getMessage()])
                    ->withInput($request->all());
            }
        }

	public function delete($id)
    {
        try {
            DB::table('seoResultCategory')->where('id', $id)->delete();
            return redirect()->back()->with('success', 'Portfolio Category has been deleted successfully.');
        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['errordetailsd' => $e->getMessage()]);
        }
    }

	public function status($id, $status)
    {
        $newStatus = $status == 1 ? 0 : 1;
    
        try {
            DB::table('seoResultCategory')
                ->where('id', $id)
                ->update(['status' => $newStatus]);
    
            return redirect()->back()->with('success', 'Status has been updated successfully.');
        } catch (\Exception $e) {
            return Redirect::back()->withErrors(['errordetailsd' => $e->getMessage()]);
        }
    }
    
    public function updateDeleteToggleresult(Request $request, $id)
{
    // Get the action from the request
    $action = $request->input('action');

    if ($action === 'update') {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255'
        ]);

        // Get the existing item
        $item = DB::table('seoResultCategory')->where('id', $id)->first();
        if (!$item) {
            return redirect()->back()->with('error', 'Item not found');
        }

        // Prepare the data to update
        $data = [
            'name' => $request->input('name'),
            'slug' => $request->input('slug'),
            'updated_at' => now(),
        ];

        // Update the item in the database
        DB::table('seoResultCategory')->where('id', $id)->update($data);

        return redirect()->back()->with('success', 'Item updated successfully');
    }

    if ($action === 'delete') {
        // Get the existing item
        $item = DB::table('seoResultCategory')->where('id', $id)->first();
        if (!$item) {
            return redirect()->back()->with('error', 'Item not found');
        }

        // Delete the images if they exist
        if (!empty($item->image) && File::exists(public_path('uploads/' . $item->image))) {
            File::delete(public_path('uploads/' . $item->image));
        }
        if (!empty($item->video_img) && File::exists(public_path('uploads/' . $item->video_img))) {
            File::delete(public_path('uploads/' . $item->video_img));
        }

        // Delete the item from the database
        DB::table('seoResultCategory')->where('id', $id)->delete();

        return redirect()->back()->with('success', 'Item deleted successfully');
    }

    if ($action === 'toggle') {
        // Get the current status
        $currentStatus = DB::table('seoResultCategory')->where('id', $id)->value('status');

        // Toggle the status
        DB::table('seoResultCategory')->where('id', $id)->update(['status' => $currentStatus == 1 ? 0 : 1]);

        return redirect()->back()->with('success', 'Status updated successfully');
    }

    return redirect()->back()->with('error', 'Invalid action');
}
    public function order_display(Request $request){
        // echo "<pre>"; print_r($request->all()); die;
        
        $page = DB::table('pages')->find($request['id']); 
        if($page){
            $result = DB::table('pages')->where('id', $page->id)->update(['display_order'=>$request['val']]);
            if($result){
                return response()->json(['status'=>1, 'message'=>'Display Order updated successfully']);
            }else{
                return response()->json(['status'=>0, 'message'=>'Display Order not updated successfully']);
            }
        }
        
    }

}
