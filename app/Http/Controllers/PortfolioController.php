<?php
namespace App\Http\Controllers;
use Redirect;
use Auth;
use Session;
use Illuminate\Http\Request;
use URL;
use Illuminate\Support\Facades\Validator;

use App\Models\PortfolioCategory;
use App\Models\Portfolio;
use App\Models\Page;
use App\Models\PageExtra;

use Illuminate\Support\Facades\DB;



class PortfolioController extends Controller
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
		$lists = PortfolioCategory::whereRaw($where)
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

			$sorting_url = 'portfolio_category?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.portfolio_category.index', compact('lists','column_array','sorting_array','search'));
	}

	public function add()
	{
		return view('admin.portfolio_category.add');
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
			$name = $request->name;
			$slug = $request->slug;
			$status = $request->status;

			$obj = new PortfolioCategory();
			$obj->name = $name;
			$obj->slug = $slug;
			$obj->status = $status;
			$obj->save();

			return redirect()->back()->with('success', 'Portfolio Category has been added successfully.');

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}

		}


	}

	public function edit($id)
	{
		$list = PortfolioCategory::where('id',$id)->first();
		if (!$list) {
			return redirect()->to('portfolioCategory')->with('error', 'Opps!! sorry!! problem occurred.Please try again!');
		}
		return view('admin.portfolio_category.edit', compact('list'));
	}

	public function update(Request $request)
	{
		$id = $request->id;
		$name = $request->name;
		$slug = $request->slug;
		$status = $request->status;
		$rules = array(
			'name' => 'required|string|max:255',
			'slug' => 'required|string|max:255|unique:portfolio_category,slug,'.$id,
			'status' => 'required|int',
		);
		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to(Admin_Prefix.'portfolioCategory/edit/'.$id)->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
			$obj = PortfolioCategory::find($id); 
			$obj->name = $name;
			$obj->slug = $slug;
			$obj->status = $status;
			$obj->save();

			return redirect()->back()->with('success', 'Portfolio Category has been updated successfully.');

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput(Request()->all());
			}
		}
	}

	public function delete($id)
	{
		$obj = PortfolioCategory::find($id); 
		PortfolioCategory::destroy($id);
		return redirect()->back()->with('success', 'Portfolio Category has been deleted successfully.');
	}

	public function status($id,$status)
	{
		if ($status==1) {
			$status = '0';
		}else{
			$status = '1';
		}
		$update_array = array('status' => $status);
		PortfolioCategory::where('id', $id)
		->update($update_array);
		return redirect()->back()->with('success', 'Status has been updated successfully.');
	}

    public function portfolio()
	{
		$sorting_array = array();

		$orderby = Request()->orderby;
		$order = Request()->order;

		if(!$orderby && !$order)
		{
			$orderby = 'id';
			$order = 'asc';
		}

		$column_array = array('id' => 'Id', 'page_name' => 'Title', 'status' => 'Status', 'created_at' => 'Created At');
		$search = Request()->search;
	    $where = "posttype='portfolio'";

		if($search)
		{
			$search_column_array = array('id' => 'Id', 'page_name' => 'Title', 'status' => 'Status', 'created_at' => 'Created At');
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
		$lists = Page::whereRaw($where)
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

			$sorting_url = 'portfolio?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}
		// echo '<pre>';
		// print_r($lists);die;
		return view('admin.portfolio.index', compact('lists','column_array','sorting_array','search'));
	}

	public function portfolio_add()
	{
		$portfolio_categories = PortfolioCategory::where('status',1)->orderBy('id','asc')->get();
		return view('admin.portfolio.add', compact('portfolio_categories'));
	}

    public function portfolio_insert(Request $request){
        $data = $request->all();
		$rules = array(
            'category_id'   => 'required|int',
			'title'         => 'required|string|max:255',
			'body'          => 'required|string|max:255',
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
			return Redirect::to(Admin_Prefix.'portfolio/add')->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
			$obj = new Portfolio();
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

			return redirect()->back()->with('success', 'Portfolio has been added successfully.');

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}
		}
    }

	public function portfolio_edit($id)
	{
		$page = Page::where('id',$id)->where('posttype','portfolio')->first();
		if (!$page)
		{
			return redirect()->back()->with('error', 'Opps!! sorry!! problem occurred.Please try again!');
		}
		$page_extra = PageExtra::where('page_id', $id)->orderBy('type', 'asc')->orderBy('rank', 'asc')->get();
		$portfolio_categories = PortfolioCategory::where('status', '1')->get();
		return view('admin.portfolio.edit', compact('page', 'portfolio_categories','page_extra'));
	}

	public function portfolio_update(Request $request)
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
			return Redirect::to(Admin_Prefix.'portfolio/edit/'.$id)->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
			$obj = Portfolio::find($id); 
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

			return redirect()->back()->with('success', 'Portfolio has been updated successfully.');

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput(Request()->all());
			}
		}
	}

    public function portfolio_delete($id)
	{
		$obj = Portfolio::find($id); 
		Portfolio::destroy($id);
		return redirect()->back()->with('success', 'Portfolio has been deleted successfully.');
	}

	public function portfolio_status($id,$status)
	{
		if ($status==1) {
			$status = '0';
		}else{
			$status = '1';
		}
		$update_array = array('status' => $status);
		Portfolio::where('id', $id)
		->update($update_array);
		return redirect()->back()->with('success', 'Status has been updated successfully.');
	}


}