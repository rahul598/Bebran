<?php
namespace App\Http\Controllers;
use Redirect;
use Auth;
use Session;
use Illuminate\Http\Request;
use URL;
use Illuminate\Support\Facades\Validator;

use App\Models\SampleCategory;
use App\Models\Sample;

use Illuminate\Support\Facades\DB;



class SampleController extends Controller
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
			$orderby = 'id';
			$order = 'asc';
		}

		$column_array = array('id' => 'Id', 'name' => 'Name', 'status' => 'Status', 'created_at' => 'Created At');

		$search = Request()->search;

		$where = "id>0 ";

		if($search)
		{
			$search_column_array = array('id' => 'Id', 'name' => 'Name', 'status' => 'Status', 'created_at' => 'Created At');

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
		$lists = SampleCategory::whereRaw($where)
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

			$sorting_url = 'sample_category?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.sample_category.index', compact('lists','column_array','sorting_array','search'));
	}

	public function add()
	{
		return view('admin.sample_category.add');
	}

	public function insert(Request $request)
	{
		$data = $request->all();

		$rules = array(
			'name' => 'required|string|max:255',
			'slug' => 'required|string|max:255|unique:sample_category',
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
			$name = $request->name;
			$slug = $request->slug;
			$status = $request->status;

			$obj = new SampleCategory();
			$obj->name = $name;
			$obj->slug = $slug;
			$obj->status = $status;
			$obj->save();

			return redirect()->back()->with('success', 'Sample Category has been added successfully.');

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}

		}


	}

	public function edit($id)
	{
		$list = SampleCategory::where('id',$id)->first();
		if (!$list) {
			return redirect()->to('sampleCategory')->with('error', 'Opps!! sorry!! problem occurred.Please try again!');
		}
		return view('admin.sample_category.edit', compact('list'));
	}

	public function update(Request $request)
	{
		$id = $request->id;
		$name = $request->name;
		$slug = $request->slug;
		$status = $request->status;
		$rules = array(
			'name' => 'required|string|max:255',
			'slug' => 'required|string|max:255|unique:sample_category,slug,'.$id,
			'status' => 'required|int',
		);
		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to(Admin_Prefix.'sampleCategory/edit/'.$id)->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
			$obj = SampleCategory::find($id); 
			$obj->name = $name;
			$obj->slug = $slug;
			$obj->status = $status;
			$obj->save();

			return redirect()->back()->with('success', 'Sample Category has been updated successfully.');

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput(Request()->all());
			}
		}
	}

	public function delete($id)
	{
		$obj = SampleCategory::find($id); 
		SampleCategory::destroy($id);
		return redirect()->back()->with('success', 'Sample Category has been deleted successfully.');
	}

	public function status($id,$status)
	{
		if ($status==1) {
			$status = '0';
		}else{
			$status = '1';
		}
		$update_array = array('status' => $status);
		SampleCategory::where('id', $id)
		->update($update_array);
		return redirect()->back()->with('success', 'Status has been updated successfully.');
	}

    public function sample()
	{
		$sorting_array = array();

		$orderby = Request()->orderby;
		$order = Request()->order;

		if(!$orderby && !$order)
		{
			$orderby = 'id';
			$order = 'asc';
		}

		$column_array = array('id' => 'Id', 'category_id' => 'Category Id', 'title' => 'Title', 'status' => 'Status', 'created_at' => 'Created At');

		$search = Request()->search;

		$where = "id>0 ";

		if($search)
		{
			$search_column_array = array('id' => 'Id', 'category_id' => 'Category Id', 'title' => 'Title', 'status' => 'Status', 'created_at' => 'Created At');

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
		$lists = Sample::whereRaw($where)
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

			$sorting_url = 'sample?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.sample.index', compact('lists','column_array','sorting_array','search'));
	}

	public function sample_add()
	{
		$sample_categories = SampleCategory::where('status',1)->orderBy('id','asc')->get();
		return view('admin.sample.add', compact('sample_categories'));
	}

    public function sample_insert(Request $request){
        $data = $request->all();
		$rules = array(
            'category_id'   => 'required|int',
			'title'         => 'required|string|max:255',
			'body'          => 'required|string|max:255',
			'btn_text'      => 'required|string|max:255',
			'btn_url'       => 'required|string|max:255',
			'status'        => 'required|int'
			
		);
        if($request->hasfile('image'))
		{
			$rules['image'] = 'mimes:webp,jpeg,png,jpg,gif,svg|max:2048';
		}
        if($request->hasfile('image2'))
		{
			$rules['image2'] = 'mimes:webp,jpeg,png,jpg,gif,svg|max:2048';
		}

		$validator = Validator::make($data , $rules);

		if ($validator->fails())
		{
			return Redirect::to(Admin_Prefix.'sample/add')->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
			$obj = new Sample();
			$obj->category_id   = $request->category_id;
			$obj->title         = $request->title;
			$obj->body          = $request->body;
			$obj->btn_text      = $request->btn_text;
			$obj->btn_url       = $request->btn_url;
			$obj->status        = $request->status;
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
            if($request->hasfile('image2'))
			{
				$image = $request->file('image2');
				$filename = $image->getClientOriginalName();
				$filename = str_replace("&", "and", $filename);
				$filename = str_replace(" ", "_", $filename);
				$filename = time().$filename;
				$image->move(public_path().'/uploads/', $filename);
				$obj->image2 = $filename;
			}
			$obj->save();

			return redirect()->back()->with('success', 'Sample has been added successfully.');

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}

		}
    }

	public function sample_edit($id)
	{
		$list = Sample::where('id',$id)->first();
		$sample_categories = SampleCategory::where('status', '1')->get();
		if (!$list) {
			return redirect()->to(Admin_Prefix.'sample')->with('error', 'Opps!! sorry!! problem occurred.Please try again!');
		}
		return view('admin.sample.edit', compact('list', 'sample_categories'));
	}

	public function sample_update(Request $request)
	{
		$id = $request->id;
		$rules = array(
			'category_id'   => 'required|int',
			'title'         => 'required|string|max:255',
			'body'          => 'required|string|max:255',
			'btn_text'      => 'required|string|max:255',
			'btn_url'       => 'required|string|max:255',
			'status'        => 'required|int'
		);
		if($request->hasfile('image'))
		{
			$rules['image'] = 'mimes:webp,jpeg,png,jpg,gif,svg|max:2048';
		}
        if($request->hasfile('image2'))
		{
			$rules['image2'] = 'mimes:webp,jpeg,png,jpg,gif,svg|max:2048';
		}
		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to(Admin_Prefix.'sample/edit/'.$id)->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
			$obj = Sample::find($id); 
			$obj->category_id   = $request->category_id;
			$obj->title         = $request->title;
			$obj->body          = $request->body;
			$obj->btn_text      = $request->btn_text;
			$obj->btn_url       = $request->btn_url;
			$obj->status        = $request->status;
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
			if($request->hasfile('image2'))
			{
				if($obj->image2!='' && file_exists(public_path().'/uploads/'.$obj->image2))
				{
					unlink(public_path().'/uploads/'.$obj->image2);
				}
				$image2 = $request->file('image2');
				$filename = $image2->getClientOriginalName();
				$filename = str_replace("&", "and", $filename);
				$filename = str_replace(" ", "_", $filename);
				$filename = time().$filename;
				$image2->move(public_path().'/uploads/', $filename);
				$obj->image2 = $filename;
			}
			$obj->save();

			return redirect()->back()->with('success', 'Sample has been updated successfully.');

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput(Request()->all());
			}
		}
	}

    public function sample_delete($id)
	{
		$obj = Sample::find($id); 
		Sample::destroy($id);
		return redirect()->back()->with('success', 'Sample has been deleted successfully.');
	}

	public function sample_status($id,$status)
	{
		if ($status==1) {
			$status = '0';
		}else{
			$status = '1';
		}
		$update_array = array('status' => $status);
		Sample::where('id', $id)
		->update($update_array);
		return redirect()->back()->with('success', 'Status has been updated successfully.');
	}


}