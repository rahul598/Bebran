<?php
namespace App\Http\Controllers;
use Redirect;
use Auth;
use Session;
use Illuminate\Http\Request;
use URL;
use Illuminate\Support\Facades\Validator;

use App\Models\PackageCategory;
use App\Models\PackageType;
use App\Models\Page;
use App\Models\PackageFeatureTitle;
use App\Models\PackageFeatureSubTitle;
use App\Models\PackagePlan;

use Illuminate\Support\Facades\DB;



class PackageController extends Controller
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

    public function package_category(){
        $sorting_array = array();
		$orderby = Request()->orderby;
		$order = Request()->order;
		if(!$orderby && !$order)
		{
			$orderby = 'id';
			$order = 'asc';
		}
		$column_array = array('id' => 'Id', 'title' => 'Title', 'sub_title' => 'Sub Title', 'rank' => 'Rank',  'status' => 'Status', 'created_at' => 'Created At');
		$search = Request()->search;
		$where = "id>0 ";
		if($search)
		{
			// $search_column_array = array('id' => 'Id', 'title' => 'Title', 'sub_title' => 'Sub Title',  'rank' => 'Rank', 'status' => 'Status', 'created_at' => 'Created At');
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
		$lists = PackageCategory::whereRaw($where)
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
			$sorting_url = 'package-category?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;
			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.packages.category.index', compact('lists','column_array','sorting_array','search') );
    }

    public function package_category_add(){
        return view('admin.packages.category.add');
    }

    public function package_category_insert(Request $request){
        $data = $request->all();
		$rules = array(
			'title' => 'required|string|max:255',
			'slug' => 'required|string|max:255|unique:package_category',
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
			$obj = new PackageCategory();
			$obj->title = $request->title;
			$obj->slug = $request->slug;
			$obj->sub_title = $request->sub_title;
			$obj->rank = $request->rank > 0 ? $request->rank : 0;
			$obj->status = $request->status;
			$obj->save();

			return redirect()->back()->with('success', 'Package Category has been added successfully.');

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}
		}
    }

    public function package_category_edit($id){
        $list = PackageCategory::where('id',$id)->first();
		if (!$list) {
			return redirect()->to('package-category')->with('error', 'Opps!! sorry!! problem occurred.Please try again!');
		}
		return view('admin.packages.category.edit', compact('list'));
    }

    public function package_category_update(Request $request){
        $id = $request->id;
		$title = $request->title;
		$slug = $request->slug;
		$sub_title = $request->sub_title;
		$rank = $request->rank > 0 ? $request->rank : '';
		$status = $request->status;
		$rules = array(
			'title' => 'required|string|max:255',
			'slug' => 'required|string|max:255|unique:package_category,slug,'.$id,
			'status' => 'required|int',
		);
		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to(Admin_Prefix.'package-category/edit/'.$id)->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
			$obj = PackageCategory::find($id); 
			$obj->title = $title;
			$obj->slug = $slug;
			$obj->sub_title = $sub_title;
			$obj->rank = $rank;
			$obj->status = $status;
			$obj->save();

			return redirect()->back()->with('success', 'Package Category has been updated successfully.');

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput(Request()->all());
			}
		}
    }

    public function package_category_status($id,$status){
        if ($status==1) {
			$status = '0';
		}else{
			$status = '1';
		}
		$update_array = array('status' => $status);
		PackageCategory::where('id', $id)
		->update($update_array);
		return redirect()->back()->with('success', 'Status has been updated successfully.');
    }

    public function package_category_delete($id){
        $obj = PackageCategory::find($id); 
		PackageCategory::destroy($id);
		return redirect()->back()->with('success', 'Package Category has been deleted successfully.');
    }

    public function package_type(){
        $sorting_array = array();
		$orderby = Request()->orderby;
		$order = Request()->order;
		if(!$orderby && !$order)
		{
			$orderby = 'id';
			$order = 'asc';
		}
		$column_array = array('id' => 'Id', 'page_id' => 'Page Name', 'category_id' => 'Category', 'title' => 'Title', 'price' => 'Price', 'rank' => 'Rank',  'status' => 'Status', 'created_at' => 'Created At');
		$search = Request()->search;
		$page_id = Request()->page_id;
		$category_id = Request()->category_id;
		$where = "id>0 ";
		if($page_id > 0){
			$where .= " and page_id like '%".$page_id."%' ";
		}
		if($category_id > 0){
			$where .= " and category_id like '%".$category_id."%' ";
		}
		if($search)
		{
			// $search_column_array = array('id' => 'Id', 'page_id' => 'Page Name', 'category_id' => 'Category', 'title' => 'Title', 'price' => 'Price',  'rank' => 'Rank', 'status' => 'Status', 'created_at' => 'Created At');
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
		$lists = PackageType::whereRaw($where)
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
			$sorting_url = 'package-type?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;
			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		$all_pages = Page::where('posttype', 'pricing')->get();
		$package_category	= PackageCategory::where('status', '1')->orderby('rank', 'asc')->get();

		return view('admin.packages.type.index', compact('lists','column_array','sorting_array','search', 'all_pages', 'package_category', 'page_id', 'category_id') ); //
    }

    public function package_type_add(){
		$all_pages  = Page::where('posttype', 'pricing')->get();
		$package_category	= PackageCategory::where('status', '1')->orderby('rank', 'asc')->get();
        return view('admin.packages.type.add', compact('all_pages', 'package_category'));
    }

    public function package_type_insert(Request $request){
        $data = $request->all();
		$rules = array(
			'page_id'		=> 'required|int',
			'category_id'	=> 'required|int',
			'title' 		=> 'required|string|max:255',
			// 'slug' 			=> 'required|string|max:255|unique:package_type',
            'price' 		=> 'required|string|max:255',
			'status' 		=> 'required|int'
		);
		$validator = Validator::make($data , $rules);
		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
			$obj = new PackageType();
			$obj->page_id               = $request->page_id;
			$obj->category_id           = $request->category_id;
			$obj->title                 = $request->title;
			// $obj->slug                  = $request->slug;
			$obj->discount_title        = $request->discount_title;
			$obj->discount_sub_title    = $request->discount_sub_title;
			$obj->price                 = $request->price;
			$obj->button_txt            = $request->button_txt;
			$obj->button_url            = $request->button_url;
			$obj->rank                  = $request->rank > 0 ? $request->rank : 0;
			$obj->status                = $request->status;
			$obj->save();

			return redirect()->back()->with('success', 'Package Type has been added successfully.');

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}
		}
    }

    public function package_type_edit($id){
		$all_pages = Page::where('posttype', 'pricing')->get();
		$package_category	= PackageCategory::where('status', '1')->orderby('rank', 'asc')->get();
        $list = PackageType::where('id',$id)->first();
		if (!$list) {
			return redirect()->to('package-type')->with('error', 'Opps!! sorry!! problem occurred.Please try again!');
		}
		return view('admin.packages.type.edit', compact('list', 'all_pages', 'package_category'));
    }

    public function package_type_update(Request $request){
        $id = $request->id;
		$rules = array(
			'page_id'		=> 'required|int',
			'category_id'	=> 'required|int',
			'title' => 'required|string|max:255',
			// 'slug' => 'required|string|max:255|unique:package_type,slug,'.$id,
			'status' => 'required|int',
		);
		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to(Admin_Prefix.'package-type/edit/'.$id)->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
			$obj = PackageType::find($id); 
			$obj->page_id = $request->page_id;
			$obj->category_id = $request->category_id;
			$obj->title = $request->title;
			$obj->slug = $request->slug;
			$obj->discount_title = $request->discount_title;
			$obj->discount_sub_title = $request->discount_sub_title;
			$obj->price = $request->price;
			$obj->button_txt = $request->button_txt;
			$obj->button_url = $request->button_url;
			$obj->rank = $request->rank > 0 ? $request->rank : '';
			$obj->status = $request->status;
			$obj->save();
			return redirect()->back()->with('success', 'Package Type has been updated successfully.');
			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput(Request()->all());
			}
		}
    }

    public function package_type_status($id,$status){
        if ($status==1) {
			$status = '0';
		}else{
			$status = '1';
		}
		$update_array = array('status' => $status);
		PackageType::where('id', $id)
		->update($update_array);
		return redirect()->back()->with('success', 'Status has been updated successfully.');
    }

    public function package_type_delete($id){
        $obj = PackageType::find($id); 
		PackageType::destroy($id);
		return redirect()->back()->with('success', 'Package Type has been deleted successfully.');
    }

	public function package_plan(){
		$sorting_array = array();
		$orderby = Request()->orderby;
		$order = Request()->order;
		if(!$orderby && !$order)
		{
			$orderby = 'id';
			$order = 'asc';
		}
		$column_array = array('id' => 'Id', 'page_id' => 'Page Name', 'category_id' => 'Category Name',  'title' => 'Title', 'rank' => 'Rank',  'status' => 'Status', 'created_at' => 'Created At');
		$search = Request()->search;
		$page_id = Request()->page_id;
		$category_id = Request()->category_id;
		$where = "id>0 ";
		if($page_id > 0){
			$where .= " and page_id like '%".$page_id."%' ";
		}
		if($category_id > 0){
			$where .= " and category_id like '%".$category_id."%' ";
		}
		if($search)
		{
			// $search_column_array = array('id' => 'Id', 'page_id' => 'Page Name', 'category_id' => 'Category Name',  'title' => 'Title', 'rank' => 'Rank', 'status' => 'Status', 'created_at' => 'Created At');
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
		$lists = PackagePlan::whereRaw($where)
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
			$sorting_url = 'package-plan?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;
			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}
		$all_pages = Page::where('posttype', 'pricing')->get();
		$package_category	= PackageCategory::where('status', '1')->orderby('rank', 'asc')->get();

		return view('admin.packages.plan.index', compact('lists','column_array','sorting_array','search', 'all_pages', 'package_category', 'page_id', 'category_id')); // , compact('lists','column_array','sorting_array','search')
	}

	public function package_plan_add(){
		$all_pages 			= Page::where('posttype', 'pricing')->get();
		$package_category 	= PackageCategory::where('status', '1')->orderby('rank', 'asc')->get();
		return view('admin.packages.plan.add', compact('all_pages', 'package_category'));
	}

	public function package_plan_insert(Request $request){
		$data = $request->all();
		$rules = array(
			'page_id' 			=> 'required|int',
			'category_id' 		=> 'required|int',
			'title' 			=> 'required|string|max:255',
			'rank' 				=> 'required|int',
			'status' 			=> 'required|int'
		);
		$validator = Validator::make($data , $rules);
		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
			$obj = new PackagePlan();
			$obj->page_id                 	= $request->page_id;
			$obj->category_id               = $request->category_id;
			$obj->title                 	= $request->title;
			$obj->sub_title                 = $request->sub_title;
			$obj->price                 	= $request->price;
			$obj->discount_price            = $request->discount_price;
			$obj->discount_percentage       = $request->discount_percentage;
			$obj->content_title             = $request->content_title;
			$obj->content                 	= $request->content;
			$obj->button_text               = $request->button_text;
			$obj->rank                  	= $request->rank > 0 ? $request->rank : 0;
			$obj->status                	= $request->status;
			$obj->save();

			return redirect()->back()->with('success', 'Package Plan has been added successfully.');

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}
		}
	}

	public function package_plan_edit($id){
		$list = PackagePlan::where('id',$id)->first();
		if (!$list) {
			return redirect()->to('package-type')->with('error', 'Opps!! sorry!! problem occurred.Please try again!');
		}
		$all_pages = Page::where('posttype', 'pricing')->get();
		$package_category 	= PackageCategory::where('status', '1')->orderby('rank', 'asc')->get();
		return view('admin.packages.plan.edit', compact('list', 'all_pages', 'package_category'));
	}

	public function package_plan_update(Request $request){
		$id = $request->id;
		$rules = array(
			'page_id' 			=> 'required|int',
			'category_id' 		=> 'required|int',
			'title' 			=> 'required|string|max:255',
			'rank' 				=> 'required|int',
			'status' 			=> 'required|int'
		);
		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to(Admin_Prefix.'package-plan/edit/'.$id)->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
			$obj = PackagePlan::find($id); 
			$obj->page_id                 	= $request->page_id;
			$obj->category_id               = $request->category_id;
			$obj->title                 	= $request->title;
			$obj->sub_title                 = $request->sub_title;
			$obj->price                 	= $request->price;
			$obj->discount_price            = $request->discount_price;
			$obj->discount_percentage       = $request->discount_percentage;
			$obj->content_title             = $request->content_title;
			$obj->content                 	= $request->content;
			$obj->button_text               = $request->button_text;
			$obj->rank                  	= $request->rank > 0 ? $request->rank : 0;
			$obj->status                	= $request->status;
			$obj->save();

			return redirect()->back()->with('success', 'Package Plan has been updated successfully.');

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput(Request()->all());
			}
		}
	}

	public function package_plan_status($id, $status){
		if ($status==1) {
			$status = '0';
		}else{
			$status = '1';
		}
		$update_array = array('status' => $status);
		PackagePlan::where('id', $id)
		->update($update_array);
		return redirect()->back()->with('success', 'Status has been updated successfully.');
	}

	public function package_plan_delete($id){
		$obj = PackagePlan::find($id); 
		PackagePlan::destroy($id);
		return redirect()->back()->with('success', 'Package Plan has been deleted successfully.');
	}

	public function feature_title(){
		$sorting_array = array();
		$orderby = Request()->orderby;
		$order = Request()->order;
		if(!$orderby && !$order)
		{
			$orderby = 'id';
			$order = 'asc';
		}
		$column_array = array('id' => 'Id', 'title' => 'Title', 'rank' => 'Rank',  'status' => 'Status', 'created_at' => 'Created At');
		$search = Request()->search;
		$where = "id>0 ";
		if($search)
		{
			$search_column_array = array('id' => 'Id', 'title' => 'Title', 'rank' => 'Rank', 'status' => 'Status', 'created_at' => 'Created At');
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
		$lists = PackageFeatureTitle::whereRaw($where)
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
			$sorting_url = 'feature-title?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;
			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.packages.feature.title.index', compact('lists','column_array','sorting_array','search')); // 
	}

	public function feature_title_add(){
		return view('admin.packages.feature.title.add');
	}

	public function feature_title_insert(Request $request){
		$data = $request->all();
		$rules = array(
			'title' => 'required|string|max:255',
			'slug' => 'required|string|max:255|unique:package_feature_title',
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
			$obj = new PackageFeatureTitle();
			$obj->title                 = $request->title;
			$obj->slug                  = $request->slug;
			$obj->rank                  = $request->rank > 0 ? $request->rank : 0;
			$obj->status                = $request->status;
			$obj->save();

			return redirect()->back()->with('success', 'Package Feature Title has been added successfully.');

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}
		}
	}

	public function feature_title_edit($id){
		$list = PackageFeatureTitle::where('id',$id)->first();
		if (!$list) {
			return redirect()->to('package-type')->with('error', 'Opps!! sorry!! problem occurred.Please try again!');
		}
		return view('admin.packages.feature.title.edit', compact('list'));
	}

	public function feature_title_update(Request $request){
		$id = $request->id;
		$title = $request->title;
		$slug = $request->slug;
		$rank = $request->rank > 0 ? $request->rank : '';
		$status = $request->status;
		$rules = array(
			'title' => 'required|string|max:255',
			'slug' => 'required|string|max:255|unique:package_feature_title,slug,'.$id,
			'status' => 'required|int',
		);
		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to(Admin_Prefix.'feature-title/edit/'.$id)->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
			$obj = PackageFeatureTitle::find($id); 
			$obj->title = $title;
			$obj->slug = $slug;
			$obj->rank = $rank;
			$obj->status = $status;
			$obj->save();

			return redirect()->back()->with('success', 'Package Feature title has been updated successfully.');

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput(Request()->all());
			}
		}
	}

	public function feature_title_status($id, $status){
		if ($status==1) {
			$status = '0';
		}else{
			$status = '1';
		}
		$update_array = array('status' => $status);
		PackageFeatureTitle::where('id', $id)
		->update($update_array);
		return redirect()->back()->with('success', 'Status has been updated successfully.');
	}

	public function feature_title_delete($id){
		$obj = PackageFeatureTitle::find($id); 
		PackageFeatureTitle::destroy($id);
		return redirect()->back()->with('success', 'Package Feature Title has been deleted successfully.');
	}

	public function feature_sub_title(){
		$sorting_array = array();
		$orderby = Request()->orderby;
		$order = Request()->order;
		if(!$orderby && !$order)
		{
			$orderby = 'id';
			$order = 'asc';
		}
		$column_array = array('id' => 'Id', 'page_id' => 'Page Name', 'category_id' => 'Category', 'title_id' => 'Title', 'sub_title' => 'Sub Title', 'rank' => 'Rank',  'status' => 'Status', 'created_at' => 'Created At');
		$search = Request()->search;
		$page_id = Request()->page_id;
		$category_id = Request()->category_id;
		$where = "id>0 ";
		if($page_id > 0){
			$where .= " and page_id like '%".$page_id."%' ";
		}
		if($category_id > 0){
			$where .= " and category_id like '%".$category_id."%' ";
		}
		if($search)
		{
			// $search_column_array = array('id' => 'Id', 'page_id' => 'Page Name',  'category_id' => 'Category', 'title_id' => 'Title', 'sub_title' => 'Sub Title', 'rank' => 'Rank', 'status' => 'Status', 'created_at' => 'Created At');
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
		$lists = PackageFeatureSubTitle::whereRaw($where)
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
			$sorting_url = 'feature-sub-title?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;
			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}
		$all_pages = Page::where('posttype', 'pricing')->get();
		$package_category	= PackageCategory::where('status', '1')->orderby('rank', 'asc')->get();
		return view('admin.packages.feature.subtitle.index', compact('lists','column_array','sorting_array','search', 'all_pages', 'package_category', 'page_id', 'category_id')); // 
	}

	public function feature_sub_title_add(){
		$all_pages = Page::where('posttype', 'pricing')->get();
		$package_category	= PackageCategory::where('status', '1')->orderby('rank', 'asc')->get();
		$title = PackageFeatureTitle::where('status', '1')->orderby('rank', 'asc')->get();
		return view('admin.packages.feature.subtitle.add', compact('title', 'all_pages', 'package_category'));
	}

	public function feature_sub_title_insert(Request $request){
		$data = $request->all();
		$rules = array(
			'page_id' 			=> 'required|int',
			'title_id' 		=> 'required|int',
			'category_id'	=> 'required|int',
			'sub_title' 	=> 'required|string|max:255',
			'status' 		=> 'required|int'
		);
		$validator = Validator::make($data , $rules);
		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
			$obj = new PackageFeatureSubTitle();
			$obj->page_id                 = $request->page_id;
			$obj->title_id                 = $request->title_id;
			$obj->category_id           = $request->category_id;
			$obj->sub_title                 = $request->sub_title;
			$obj->rank                  = $request->rank > 0 ? $request->rank : 0;
			$obj->status                = $request->status;
			$obj->save();

			return redirect()->back()->with('success', 'Package Feature Sub Title has been added successfully.');

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}
		}
	}

	public function feature_sub_title_edit($id){
		$list = PackageFeatureSubTitle::where('id',$id)->first();
		if (!$list) {
			return redirect()->to('package-type')->with('error', 'Opps!! sorry!! problem occurred.Please try again!');
		}
		$all_pages = Page::where('posttype', 'pricing')->get();
		$package_category	= PackageCategory::where('status', '1')->orderby('rank', 'asc')->get();
		$title = PackageFeatureTitle::where('status', '1')->orderby('rank', 'asc')->get();
		return view('admin.packages.feature.subtitle.edit', compact('list', 'all_pages', 'title', 'package_category'));
	}

	public function feature_sub_title_update(Request $request){
		$id = $request->id;
		$rules = array(
			'page_id' => 'required|int',
			'title_id' => 'required|int',
			'category_id'	=> 'required|int',
			'sub_title' => 'required|string|max:255',
			'status' => 'required|int',
		);
		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to(Admin_Prefix.'feature-sub-title/edit/'.$id)->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
			$obj = PackageFeatureSubTitle::find($id); 
			$obj->page_id = $request->page_id;
			$obj->category_id           = $request->category_id;
			$obj->title_id = $request->title_id;
			$obj->sub_title = $request->sub_title;
			$obj->rank = $request->rank > 0 ? $request->rank : '';
			$obj->status = $request->status;
			$obj->save();

			return redirect()->back()->with('success', 'Package Feature Sub Title has been updated successfully.');

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput(Request()->all());
			}
		}
	}

	public function feature_sub_title_status($id, $status){
		if ($status==1) {
			$status = '0';
		}else{
			$status = '1';
		}
		$update_array = array('status' => $status);
		PackageFeatureSubTitle::where('id', $id)
		->update($update_array);
		return redirect()->back()->with('success', 'Status has been updated successfully.');
	}

	public function feature_sub_title_delete($id){
		$obj = PackageFeatureSubTitle::find($id); 
		PackageFeatureSubTitle::destroy($id);
		return redirect()->back()->with('success', 'Package Feature Sub Title has been deleted successfully.');
	}

	public function feature_add(){
		$all_pages 			= Page::where('posttype', 'pricing')->get();
		$package_category 	= PackageCategory::where('status', '1')->orderby('rank', 'asc')->get();
		return view('admin.packages.feature.add', compact('all_pages', 'package_category'));
	}

	public function get_data_feature(Request $request){
		$page_id 		= $request->page_id;
		$category_id 	= $request->category_id;
		$package_type 	= PackageType::where('page_id', $page_id)
							->where('category_id', $category_id)
							->where('status', '1')
							->orderby('rank', 'asc')
							->get();
		
		$titleDataWithSubTitles = [];
		$titleData = PackageFeatureTitle::where('status', '1')
			->orderby('rank', 'asc')
			->get();
		
		if (!$titleData->isEmpty()) {
			foreach ($titleData as $key => $value) {
				$subTitleData = PackageFeatureSubTitle::where('page_id', $page_id)
					->where('category_id', $category_id)
					->where('title_id', $value->id)
					->where('status', '1')
					->orderby('rank', 'asc')
					->get();
		
				if (!$subTitleData->isEmpty()) {
					$titleDataWithSubTitles[] = [
						'title' => $value,
						'subTitles' => $subTitleData->toArray(),
					];
				}
			}
		}
		$html = '';		
		$html .= '<div class="col-lg-12 col-md-12">';
		$html .= '<div class="row">';		
		$html .= '<div class="col-lg-5 col-md-5">';
		$html .= '</div>';	
		$html .= '<div class="col-lg-7 col-md-7">';	
		$html .= '<div class="row">';
		foreach($package_type as $types){
			$html .= '<div class="col-lg-3 col-md-3">';
            $html .= ' <h3>'. $types->title .'</h3>';
            $html .= '</div>';	
		}
		$html .= '</div>';
		$html .= '</div>';
		$html .= '</div>';
		$html .= '<div class="col-lg-12 col-md-12">';
		foreach($titleDataWithSubTitles as $titlesubtitle){		
			$html .= '<div class="card addCard">';	
			$html .= '<h4 class="text-start">'.$titlesubtitle['title']['title'].'</h4>';	
			foreach($titlesubtitle['subTitles'] as $subtitle){
				$html .= '<div class="row">';
				$html .= '<div class="col-lg-5 col-md-5">';
				$html .= '<h5 class="text-start">'.$subtitle['sub_title'].'</h5>
						<input type="hidden" name="subtitle_id[]" value="'.$subtitle['id'].'">';
				$html .= '</div>';
				$html .= '<div class="col-lg-7 col-md-7">';	
				$html .= '<div class="row">';
				$typess = !empty($subtitle['types']) ? explode(',',$subtitle['types']) : 0;
				$switch = explode(',',$subtitle['switch']);
				foreach($package_type as $key => $types){
					if($typess != 0){
						foreach($typess as $key => $oneType){
							if($oneType == $types['id']){
								if($switch[$key] == 1){
									$html .= '<div class="col-lg-3 col-md-3">';
									$html .= '<div class="switchbox">
												<label class="switch switch_checked">
													<input class="switch" type="checkbox" name="switch_'.$subtitle['id'].'_'. $key .'" id="switch_'.$subtitle['id'].'_'. $key .'" value="1" onchange="changeVal('.$subtitle['id'].','.$key.')" checked/><div></div>
												</label>
											</div>
											<input type="hidden" name="type_id_'.$subtitle['id'].'[]" value="'.$types['id'].'">';
									$html .= '</div>';
								}else{
									$html .= '<div class="col-lg-3 col-md-3">';
									$html .= '<div class="switchbox">
												<label class="switch">
													<input class="switch" type="checkbox" name="switch_'.$subtitle['id'].'_'. $key .'" id="switch_'.$subtitle['id'].'_'. $key .'" value="0" onchange="changeVal('.$subtitle['id'].','.$key.')"/><div></div>
												</label>
											</div>
											<input type="hidden" name="type_id_'.$subtitle['id'].'[]" value="'.$types['id'].'">';
									$html .= '</div>';
								}	
							}
						}
					}else{
						$html .= '<div class="col-lg-3 col-md-3">';
						$html .= '<div class="switchbox">
									<label class="switch">
										<input class="switch" type="checkbox" name="switch_'.$subtitle['id'].'_'. $key .'" id="switch_'.$subtitle['id'].'_'. $key .'" value="0" onchange="changeVal('.$subtitle['id'].','.$key.')"/><div></div>
									</label>
								</div>
								<input type="hidden" name="type_id_'.$subtitle['id'].'[]" value="'.$types['id'].'">';
						$html .= '</div>';
					}
				}
				$html .= '</div>';
				$html .= '</div>';
				$html .= '</div>';
			}	
			$html .= '</div>';				
		}
		$html .= '</div>';		
		$html .= '</div>';		
		$html .= '</div>';
					
		return response()->json(['html' => $html]);
	}

	public function feature_insert(Request $request){
		// $data = $request->all();
	
		$rules = array(
			'page_id' 			=> 'required|int',
			'category_id' 		=> 'required|int',
		);
		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
				$page_id = $request->page_id;
				$category_id = $request->category_id;
				$subtitle_id = $request->subtitle_id;
				// $type_id = [];
				foreach($subtitle_id as $key => $subtitle){
					$type_id =  $request->has('type_id_'.$subtitle) ? $request->{'type_id_'.$subtitle} : 0;
					$switch = [];
					foreach($type_id as $key => $types){
						$switch[] = $request->has('switch_'.$subtitle.'_'.$key) ? $request->{'switch_'.$subtitle.'_'.$key} : 0;
					}
					$switch_data = implode(',',$switch);
					$type_id_data = implode(',',$type_id);

					$obj 			= PackageFeatureSubTitle::find($subtitle);
					$obj->switch  	= $switch_data;
					$obj->types  	= $type_id_data;
					$obj->save();
				}
				return redirect()->back()->with('success', 'Feature has been updated successfully.');

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput(Request()->all());
			}
		}
		
	}

}