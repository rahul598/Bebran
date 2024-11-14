<?php
namespace App\Http\Controllers;
use Redirect;
use Auth;
use Session;
use Illuminate\Http\Request;
use URL;
use Illuminate\Support\Facades\Validator;

use App\Models\Category;

use Illuminate\Support\Facades\DB;



class CategoryController extends Controller
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
		$sorting_array = array();

		$orderby = Request()->orderby;
		$order = Request()->order;

		if(!$orderby && !$order)
		{
			$orderby = 'rank';
			$order = 'asc';
		}

		$column_array = array('id' => 'Id', 'name' => 'Name', 'rank' => 'Order', 'status' => 'Status', 'created_at' => 'Created At');

		$search = Request()->search;

		$where = "id>0 ";

		if($search)
		{
			$search_column_array = array('id' => 'Id', 'name' => 'Name', 'parent_id' => 'Parent', 'rank' => 'Order', 'status' => 'Status', 'created_at' => 'Created At');

			$where .= " and (";
			$i=1;
			foreach($column_array as $key=>$val)
			{
				if($i>1)
				{
					$where .= " or ";
				}

				$where .= $key." like '%".$search."%'";
				$i++;
			}
			$where .= ")";
		}

		$item_display_per_page = config('admin.pagination');
		$lists = Category::whereRaw($where)
		->orderBy($orderby, $order)
		->paginate($item_display_per_page);

		foreach($column_array as $key => $value)
		{
			$sorting_class = 'sorting';
			$sorting_url_orderby = $key;
			$sorting_url_order = 'asc';

			if($orderby==$key)
			{
				$sorting_class = ( $order=='asc' ? 'sorting_asc' : 'sorting_desc' );

				$sorting_url_order = ( $order=='asc' ? 'desc' : 'asc' );
			}

			$sorting_url = 'category?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.category.index', compact('lists','column_array','sorting_array','search'));
	}

	public function add()
	{
		return view('admin.category.add');
	}

	public function insert(Request $request)
	{
		$data = $request->all();

		$rules = array(
			'name' => 'required|string|max:255',
			'slug' => 'required|string|max:255|unique:category',
			'rank' => 'required|int',
			'status' => 'required|int'
		);
		if($request->hasfile('image'))
		{
			$rules['image'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
		}

		$validator = Validator::make($data , $rules);

		if ($validator->fails())
		{
			return Redirect::to('category/add')->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
			$name = $request->name;
			$slug = $request->slug;
			$status = $request->status;
			$parent_id = $request->parent_id>0?$request->parent_id:0;

			$obj = new Category();
			$obj->name = $name;
			$obj->slug = $slug;
			$obj->status = $status;
			$obj->rank = $request->rank;
			if($request->hasfile('image'))
			{
				$image = $request->file('image');
				$filename = $image->getClientOriginalName();
				$filename = str_replace("&", "and", $filename);
				$filename = str_replace(" ", "_", $filename);
				$filename = time().$filename;
				$image->move(public_path().'/uploads/', $filename);
				$obj->image = $filename;
			}
			$obj->parent_id = $parent_id;
			$obj->save();

			return redirect()->back()->with('success', 'Category has been added successfully.');

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}

		}


	}

	public function edit($id)
	{
		$list = Category::where('id',$id)->first();
		if (!$list) {
			return redirect()->to('category')->with('error', 'Opps!! sorry!! problem occurred.Please try again!');
		}
		return view('admin.category.edit', compact('list'));
	}

	public function update(Request $request)
	{
		$id = $request->id;
		$name = $request->name;
		$slug = $request->slug;
		$status = $request->status;

		$rules = array(
			'name' => 'required|string|max:255',
			'slug' => 'required|string|max:255|unique:category,slug,'.$id,
			'rank' => 'required|int',
			'status' => 'required|int',
		);
		if($request->hasfile('image'))
		{
			$rules['image'] = 'mimes:jpeg,png,jpg,gif,svg|max:2048';
		}

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to('category/edit/'.$id)->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
			$parent_id = $request->parent_id>0?$request->parent_id:0;

			$obj = Category::find($id); 
			$obj->name = $name;
			$obj->slug = $slug;
			$obj->rank = $request->rank;
			$obj->status = $status;
			$obj->parent_id = $parent_id;
			if($request->hasfile('image'))
			{
				if($obj->image!='' && file_exists(public_path().'/uploads/'.$obj->image))
				{
					unlink(public_path().'/uploads/'.$obj->image);
				}
				$image = $request->file('image');
				$filename = $image->getClientOriginalName();
				$filename = str_replace("&", "and", $filename);
				$filename = str_replace(" ", "_", $filename);
				$filename = time().$filename;
				$image->move(public_path().'/uploads/', $filename);
				$obj->image = $filename;
			}
			$obj->save();

			return redirect()->back()->with('success', 'Category has been updated successfully.');

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput(Request()->all());
			}
		}
	}

	public function delete($id)
	{
		$obj = Category::find($id); 
		if($obj->image!='' && file_exists(public_path().'/uploads/'.$obj->image))
		{
			unlink(public_path().'/uploads/'.$obj->image);
		}
		Category::destroy($id);
		return redirect()->back()->with('success', 'Category has been deleted successfully.');
	}

    public function file_destroy($id)
    {
		$obj = Category::find($id);
		if($obj->image!='' && file_exists(public_path().'/uploads/'.$obj->image))
		{
			unlink(public_path().'/uploads/'.$obj->image);
		}
		$obj->image='';
		$obj->save();
		$msg = 'Image deleted successfully.';
        return redirect()->back()->with('success', $msg);
    }

	public function status($id,$status)
	{
		if ($status==1) {
			$status = '0';
		}else{
			$status = '1';
		}
		$update_array = array('status' => $status);
		Category::where('id', $id)
		->update($update_array);
		return redirect()->back()->with('success', 'Status has been updated successfully.');
	}
}