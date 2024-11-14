<?php
namespace App\Http\Controllers;
use Redirect;
use Session;
use Auth;
use Illuminate\Http\Request;
use voku\helper\AntiXSS;
use Illuminate\Support\Facades\Validator;


use App\Models\Page;
use App\Models\PageExtra;
use App\Models\User;
use App\Models\Settings;
use App\Models\Category;
use App\Models\NewsCategory;
use App\Models\Country;
use App\Models\Cities;
use App\Models\Contact_us;
use App\Models\Business;
use App\Models\GuestPost;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\CaseStudies;
use App\Models\MediaCoverage;
use App\Models\Portfolio;
use App\Models\Sample;
use App\Models\caseStudiesLanding;
use App\Models\MediaLibrary;
use App\Models\Enquiry;
use App\Models\ServiceCategory;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ContactUsImport;
use App\Imports\KeywordImport;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

use App\{
        Helpers\helpers
};

use File;

class PageController extends Controller
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

	/* Admin Manage Page Get*/
	public function index()
	{
		$sorting_array = array();

		$orderby = Request()->orderby;
		$order = Request()->order;

		if(!$orderby && !$order)
		{
			$orderby = 'menu_order';
			$order = 'asc';
		}

		$column_array = array('id' => 'Id', 'page_name' => 'Page Name', 'status' => 'Status', 'menu_order' => 'Order');
		$search = Request()->search;
		$where = "posttype='page' ";

		if($search)
		{
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
		$excludedIds = [167, 187, 388, 389,398];

		$pages = Page::select('pages.*')
			->whereNotIn('id', $excludedIds)
			->whereRaw($where)
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

			$sorting_url = 'page?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.page.index', compact('pages','column_array','sorting_array','search'));
	}


	/* Admin Add Page Get*/
	public function add()
	{
		$all_pages = Page::all();


		return view('admin.page.add', compact('all_pages'));
	}

	/* Admin insert Page Post*/
	public function insert(Request $request)
	{
	    $antiXSS = new AntiXSS();
		$id = $request->id;
		$rules = array(
			'page_name' => 'required|string|max:255',
			'slug' => 'required|string|max:255|unique:pages',
			// 'display_in' => 'required|integer',
			// 'parent_id' => 'required|integer',
			// 'category_id' => 'required',
		);
		if($request->hasfile('menu_image'))
		{
			$rules['menu_image'] = 'mimes:webp|max:2048';
		}
		if($request->hasfile('image2'))
		{
			$rules['image2'] = 'mimes:webp|max:2048';
		}

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return redirect()->back()->withErrors($validator)->withInput($request->all());
			
		}
		else
		{
			try {
                $slug             = $request->slug;
                $price_widget     = $request->price_widget;
                $page_name        = $request->page_name;
                $page_title       = $request->page_title;
                $bannertext       = $request->bannertext;
                $body             = $request->body;
                $posttype         = $request->posttype;
            
                $meta_title       = $request->meta_title;
                $meta_keyword     = $request->meta_keyword;
                $meta_description = $request->meta_description;
                $meta_tag 		  = $request->meta_tag;
                $parent_id        = $request->parent_id>0?$request->parent_id:0;
                $display_in       = $request->display_in>0?$request->display_in:0;
                $menu_order       = $request->menu_order>0?$request->menu_order:0;
                $service_order    = $request->service_order>0?$request->service_order:0;
                $menu_link        = $request->menu_link;
                $page_template    = $request->page_template>0?$request->page_template:0;
                $status           = $request->status=='0'?0:1;
                $author_name      = $request->author_name?$request->author_name:$page_title;
                $author_desg      = $request->author_desg;
                $author_url       = $request->author_url;
                $service_id       = $request->service_id;


				$update_array = array('price_widget'=>$price_widget, 'page_name' => $page_name, 'page_title' => $page_title, 'bannertext' => $bannertext, 'body' => $body,'meta_tag' => $meta_tag, 'posttype' => $posttype, 'meta_title' => $meta_title, 'meta_keyword' => $meta_keyword, 'meta_description' => $meta_description, 'display_in' => $display_in, 'menu_order' => $menu_order,'service_order' => $service_order, 'status' => $status, 'parent_id' => $parent_id,'page_title' => $author_name,'author_url' => $author_url,'bannertext' => $author_desg,'service_id' => $service_id);
             

				if($request->hasfile('author_image'))
				{
					$author_image = $request->file('author_image');
					$filename = $author_image->getClientOriginalName();
					$extension = $author_image->getClientOriginalExtension();
					if($extension == "webp"){
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$author_image->move(public_path().'/uploads/', $filename);
					$author_image = $filename;
					$update_array['author_image'] = $author_image;

					}else{
						return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
					}
				}

				if($request->hasfile('bannerimage'))
				{
					$bannerimage = $request->file('bannerimage');
					$filename = $bannerimage->getClientOriginalName();
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$bannerimage->move(public_path().'/uploads/', $filename);
					$update_array['bannerimage'] = $filename;
				}
				/*if($request->hasfile('menu_image'))
				{
					$menu_image = $request->file('menu_image');
					$filename = $menu_image->getClientOriginalName();
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$menu_image->move(public_path().'/uploads/', $filename);
					$update_array['menu_image'] = $filename;
				}*/
				if($request->hasfile('image2'))
				{
					$image2 = $request->file('image2');
					$filename = $image2->getClientOriginalName();
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$image2->move(public_path().'/uploads/', $filename);
					$update_array['image2'] = $filename;
				}

				if ($slug) {
					$update_array['slug'] = $slug;
				}

				$update_array['page_template'] = $page_template;
				$page_id = DB::table('pages')->insertGetId($update_array);
				$page = Page::where('id',$page_id)->first();
				if ($page->posttype == 'blog') {
					$page->category()->attach($request->category_id);
				}elseif($page->posttype == 'news'){
					$page->news_category = $request->category_id;
					$page->save();
				}elseif($page->posttype == 'case-study'){
    			    $page->case_study_category = $request->category_id;
    				$page->save();
    			}elseif($page->posttype == 'portfolio'){
    			    $page->portfolio_category = $request->category_id;
    				$page->save();
    			}
				// print_r($page_id);exit();

				if ( isset($request->section_type) && count($request->section_type)>0) {
						$section_type = $request->section_type;
					for ($i=0; $i < count($request->section_type); $i++) {
						$cur_section_type = $section_type[$i];
						if ($cur_section_type=='1') {
							$type=1;
						}else{
							$type=$i + 1;
						}

						$max_rank = get_fields_value_where('pages_extra',"page_id='".$page_id."' and type='".$type."'",'rank','desc');
						$rank = ($max_rank && count($max_rank)>0) ? $max_rank[0]->rank + 1 : 1 ;

						$a ='section_new_t';
						$section_new_t = $request->$a;
						$b ='section_new_st';
						$section_new_st = $request->$b;
						$c ='section_new_c';
						$section_new_c = $request->$c;
						$d ='section_new_btn_text';
						$section_new_btn_text = $request->$d;
						$e ='section_new_btn_url';
						$section_new_btn_url = $request->$e;

						$section_new_img = $request->section_new_img;
						$section_new_img2 = $request->section_new_img2;

						@$title = $section_new_t[$i];
						@$sub_title = $section_new_st[$i];
						@$body = $section_new_c[$i];
						@$btn_text = $section_new_btn_text[$i];
						@$btn_url = $section_new_btn_url[$i];
						$image = '';
						$image2 = '';

						$obj = new PageExtra;
						$obj->page_id = $page_id;
						$obj->type = $type;
						$obj->section_type = $cur_section_type;
						if ( isset($section_new_img) && count($section_new_img)>0) {
							if($request->hasfile('section_new_img'))
							{
								$cur_img_count = 0;
								foreach($request->file('section_new_img') as $file){
									if ($cur_img_count==$i) {
										$filename = $file->getClientOriginalName();
										$extension = $file->getClientOriginalExtension();
										if($extension == "webp"){
										$filename = create_seo_link($filename);
                                		$filename = time()."_".$filename;
										$file->move(public_path().'/uploads/', $filename);
										$image = $filename;
										}else{
											return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
										}
									}
									$cur_img_count++;
								}
							}
						}
						if ( isset($section_new_img2) && count($section_new_img2)>0) {
							if($request->hasfile('section_new_img2'))
							{
								$cur_img_count = 0;
								foreach($request->file('section_new_img2') as $file){
									if ($cur_img_count==$i) {
										$filename = $file->getClientOriginalName();
										$extension = $file->getClientOriginalExtension();
										if($extension == "webp"){
										$filename = create_seo_link($filename);
                                		$filename = time()."_".$filename;
										$file->move(public_path().'/uploads/', $filename);
										$image2 = $filename;
										}else{
											return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
										}
									}
									$cur_img_count++;
								}
							}
						}/**/

						$obj->title = $title;
						$obj->sub_title = $sub_title;
						$obj->body = $body;
						$obj->btn_text = $btn_text;
						$obj->btn_url = $btn_url;
						$obj->image = $image;
						$obj->image2 = $image2;
						$obj->rank = $rank;
						$obj->save();
					}
				}

				if ($page->posttype=='service') {
					$extra = PageExtra::where(['page_id'=> Service_Page_ID])->get();
					foreach($extra as $val){
						$obj = new PageExtra;
						$obj->page_id = $page_id;
						$obj->type = $val->type;
						$obj->section_type = $val->section_type;
						$obj->title = $val->title;
						$obj->image2 = $val->image2;
						$obj->sub_title = $val->sub_title;
						$obj->btn_text = $val->btn_text;
						$obj->btn_url = $val->btn_url;
						$obj->image = $val->image;
						$obj->body = $val->body;
						$obj->rank = $val->rank;
						$obj->status = $val->status;
						$obj->save();
					}
				}

				if ($page->posttype=='pricing') {
					$extra = PageExtra::where(['page_id'=> Pricing_Page_ID])->get();
					foreach($extra as $val){
						$obj = new PageExtra;
						$obj->page_id = $page_id;
						$obj->type = $val->type;
						$obj->section_type = $val->section_type;
						$obj->title = $val->title;
						$obj->image2 = $val->image2;
						$obj->sub_title = $val->sub_title;
						$obj->btn_text = $val->btn_text;
						$obj->btn_url = $val->btn_url;
						$obj->image = $val->image;
						$obj->body = $val->body;
						$obj->rank = $val->rank;
						$obj->status = $val->status;
						$obj->save();
					}
				}
				if ($page->posttype=='portfolio') {
					$extra = PageExtra::where(['page_id'=> Portfolio_Page_ID])->get();
					foreach($extra as $val){
						$obj = new PageExtra;
						$obj->page_id = $page_id;
						$obj->type = $val->type;
						$obj->section_type = $val->section_type;
						$obj->title = $val->title;
						$obj->image2 = $val->image2;
						$obj->sub_title = $val->sub_title;
						$obj->btn_text = $val->btn_text;
						$obj->btn_url = $val->btn_url;
						$obj->image = $val->image;
						$obj->body = $val->body;
						$obj->rank = $val->rank;
						$obj->status = $val->status;
						$obj->save();
					}
				}
				if ($page->posttype=='case-study') {
					$extra = PageExtra::where(['page_id'=> CaseStudy_Page_ID])->get();
					foreach($extra as $val){
						$obj = new PageExtra;
						$obj->page_id = $page_id;
						$obj->type = $val->type;
						$obj->section_type = $val->section_type;
						$obj->title = $val->title;
						$obj->image2 = $val->image2;
						$obj->sub_title = $val->sub_title;
						$obj->btn_text = $val->btn_text;
						$obj->btn_url = $val->btn_url;
						$obj->image = $val->image;
						$obj->body = $val->body;
						$obj->rank = $val->rank;
						$obj->status = $val->status;
						$obj->save();
					}
				}

				//return redirect()->back()->with('success', true);
				return Redirect::to(Admin_Prefix.$posttype.'/edit/'.$page_id)->with('success', 'Page has been added successfully.');

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}

		}
	}

	/* Admin Update Page Get*/
	public function edit($id)
	{
		$all_pages = Page::where('id','!=',$id)->get();
		$page = Page::where('id',$id)->where('posttype','page')->first();
// 		echo "<pre>";
// 		print_r($page);exit;
		if (!$page)
		{
			return redirect()->back();
		}
		$page_extra = PageExtra::where('page_id',$id)->orderBy('status_show', 'asc')->orderBy('type', 'asc')->orderBy('rank', 'asc')->get();//

		$redirect_page = DB::table('pages')
		->select('id','page_name')
		->where('id', '!=', $id)
		->get();
		// echo "<pre>";
		// print_r($page);exit;

		return view('admin.page.edit', compact('page','page_extra','all_pages','redirect_page'));
	}

	/* Admin Update Page Post*/
	public function update(Request $request)
	{   $antiXSS = new AntiXSS();
	   // echo "<pre>";print_r($request->all()); die; 
		$id = $request->id;
		$page_extra = PageExtra::where('page_id',$id)->orderBy('type', 'asc')->get();//where('type', '!=', '1')->

        $slug             = $request->slug;
        $price_widget             = $request->price_widget;
        $page_name        = $request->page_name;
        $page_title       = $request->page_title;
        $bannertext       = $request->bannertext;
        $body             = $request->body;
        $posttype         = $request->posttype;
        $meta_tag         = $request->meta_tag;
        $redirect_to      = ($request->redirect_to != '' && $request->redirect_to != 'No Redirection')?$request->redirect_to:'';
        $meta_title       = $request->meta_title;
        $meta_keyword     = $request->meta_keyword;
        $meta_description = $request->meta_description;
        $parent_id        = $request->parent_id>0?$request->parent_id:0;
        $display_in       = $request->display_in>0?$request->display_in:0;
        $menu_order       = $request->menu_order>0?$request->menu_order:0;
        $service_order    = $request->service_order>0?$request->service_order:0;
        $menu_link        = $request->menu_link;
        $page_template    = $request->page_template>0?$request->page_template:0;
        $status           = $request->status=='0'?0:1;
        $author_name      = $request->author_name?$request->author_name:$page_title;
        $author_desg      = $request->author_desg;
        $author_url       = $request->author_url;
        $service_id       = $request->service_id;

			
		if($request->hasfile('author_image'))
		{
			$author_image = $request->file('author_image');
			$filename = $author_image->getClientOriginalName();
			$extension = $author_image->getClientOriginalExtension();
			if($extension == "webp"){
			$filename = create_seo_link($filename);
			$filename = time()."_".$filename;
			$author_image->move(public_path().'/uploads/', $filename);
			$author_image = $filename;
			}else{
				return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
			}
		}else{
			$author_image       = $request->old_author_name;
		}

				
		if ($id==1) {
			$status = 1;
		}
		if ($id==Category_Default_Page_ID) {
			$parent_id = 0;
		}

		$rules = array(
			'page_name' => 'required|string|max:255',
			'slug' => 'required|string|max:255|unique:pages,slug,'.$id,
			//'display_in' => 'required|integer',
			// 'category_id' => 'required',
		);

		if($request->hasfile('bannerimage'))
		{
			$rules['bannerimage'] = 'mimes:webp|max:2048';
		}
		if($request->hasfile('menu_image'))
		{
			$rules['menu_image'] = 'mimes:webp|max:2048';
		}
		if($request->hasfile('image2'))
		{
			$rules['image2'] = 'mimes:webp|max:2048';
		}

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to(''.$posttype.'/edit/'.$id)->withErrors($validator)->withInput();
		}
		else
		{	
			foreach ($page_extra as $val) {
				
				$ax ='section_package_type_'.$val->id;
				$section_package_type = !empty($request->$ax) ? $request->$ax : '0';
				$ay ='section_title1_'.$val->id;
				$section_title1 = !empty($request->$ay) ? $request->$ay : '';
				$az ='section_sub_title1_'.$val->id;
				$section_sub_title1 = !empty($request->$az) ? $request->$az : '';
				$aa ='section_body_title_'.$val->id;
				$section_body_title = !empty($request->$aa) ? $request->$aa : '';

				$x ='section_title_'.$val->id;
				$page_extra_title = $request->$x;
				$y ='section_sub_title_'.$val->id;
				$page_extra_sub_title = $request->$y;
				$z ='section_body_'.$val->id;
				$page_extra_body = $request->$z;
				$a ='section_btn_text_'.$val->id;
				$page_extra_btn_text = $request->$a;
				$b ='section_btn_url_'.$val->id;
				$page_extra_btn_url = $request->$b;
				$c ='section_rank_'.$val->id;
				$page_extra_rank = $request->$c;

				$d ='section_video_url'.$val->id;
				$page_extra_video_url = $request->$d;

				$d ='section_fk_parent_id_'.$val->id;
				$page_extra_fk_parent_id = $request->$d;


				// echo "<pre>";
				// print_r($page_extra_fk_parent_id);exit;
				$page_extra_status = $request->{'section_status_'.$val->id};
				$page_extra_status = ($page_extra_status>0) ? 1 : 0 ;
				$update_array1 = array('title' => $page_extra_title,'body' => $antiXSS->xss_clean($page_extra_body),'sub_title' => $page_extra_sub_title,'btn_text' => $page_extra_btn_text,'btn_url' => $page_extra_btn_url,'blog_parent' => $page_extra_fk_parent_id,'video_url' => $page_extra_video_url, 'package_type_id' => $section_package_type, 'title1' => $section_title1, 'sub_title1' => $section_sub_title1, 'body_title' => $section_body_title);
				
				if ($page_extra_rank>0) {
					$update_array1['rank'] = $page_extra_rank;
				}
					$update_array1['status'] = $page_extra_status;

				if($request->hasfile('section_file_'.$val->id))
				{
					if($val->image!='' && file_exists(public_path().'/uploads/'.$val->image))
					{
						unlink(public_path().'/uploads/'.$val->image);
					}
					$file = $request->file('section_file_'.$val->id);
					$filename = $file->getClientOriginalName();
					$extension = $file->getClientOriginalExtension();
					if($extension =="webp"){
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$file->move(public_path().'/uploads/', $filename);
					$update_array1['image'] = $filename;
					}else{
						return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
					}
				}
				if($request->hasfile('section_video_img'.$val->id))
				{
					if($val->video_img!='' && file_exists(public_path().'/uploads/'.$val->video_img))
					{
						unlink(public_path().'/uploads/'.$val->video_img);
					}
					$file = $request->file('section_video_img'.$val->id);
					$filename = $file->getClientOriginalName();
					$extension = $file->getClientOriginalExtension();
					if($extension =="webp"){
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$file->move(public_path().'/uploads/', $filename);
					$update_array1['video_img'] = $filename;
					}else{
						return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
					}
				}
				// if($request->hasfile('section_video_file_'.$val->id))
				// {
				// 	if($val->video!='' && file_exists(public_path().'/uploads/'.$val->video))
				// 	{
				// 		unlink(public_path().'/uploads/'.$val->video);
				// 	}
				// 	$file = $request->file('section_video_file_'.$val->id);
				// 	$filename = $file->getClientOriginalName();
				// 	$extension = $file->getClientOriginalExtension();
				// 	if($extension =="mp4"){
				// 	$filename = create_seo_link($filename);
                //     $filename = time()."_".$filename;
				// 	$file->move(public_path().'/uploads/', $filename);
				// 	$update_array1['video'] = $filename;
				// 	}else{
				// 		return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
				// 	}
				// }


				if($request->hasfile('section_file2_'.$val->id))
				{
					if($val->image2!='' && file_exists(public_path().'/uploads/'.$val->image2))
					{
						unlink(public_path().'/uploads/'.$val->image2);
					}
					$file = $request->file('section_file2_'.$val->id);
					$filename = $file->getClientOriginalName();
					$extension = $file->getClientOriginalExtension();
					if($extension =="webp"){
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$file->move(public_path().'/uploads/', $filename);
					$update_array1['image2'] = $filename;
					}else{
						return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
					}
				}
				// echo "<pre>";print_r($update_array1); die;
				DB::table('pages_extra')->where('id', $val->id)->update($update_array1);
				
			}

			$update_array = array('price_widget'=>$price_widget,'page_name' => $page_name, 'page_title' => $page_title, 'bannertext' => $bannertext, 'body' => $body, 'posttype' => $posttype, 'meta_title' => $meta_title, 'meta_keyword' => $meta_keyword,'meta_description' => $meta_description,'meta_tag' => $meta_tag,'redirect_to'=>$redirect_to, 'display_in' => $display_in, 'menu_order' => $menu_order,'service_order' => $service_order,'status' => $status,'page_title' => $author_name,'bannertext' => $author_desg,'author_url' => $author_url,'service_id' => $service_id,'author_image' => $author_image);

				$update_array['page_template'] = $page_template;
			if ($slug && $id!='1') {
				$update_array['slug'] = $slug;
			}

			if($request->hasfile('bannerimage'))
			{
				$page = Page::where('id',$id)->first();
				if($page->bannerimage!='' && file_exists(public_path().'/uploads/'.$page->bannerimage))
				{
					unlink(public_path().'/uploads/'.$page->bannerimage);
				}

				$bannerimage = $request->file('bannerimage');
				$filename = $bannerimage->getClientOriginalName();
				$extension = $bannerimage->getClientOriginalExtension();
				if($extension == "webp"){
				$filename = create_seo_link($filename);
                $filename = time()."_".$filename;
				$bannerimage->move(public_path().'/uploads/', $filename);
				$update_array['bannerimage'] = $filename;
				}else{
					return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
				}
			}
			if($request->hasfile('menu_image'))
			{
				$page = Page::where('id',$id)->first();
				if($page->menu_image!='' && file_exists(public_path().'/uploads/'.$page->menu_image))
				{
					unlink(public_path().'/uploads/'.$page->menu_image);
				}
				$menu_image = $request->file('menu_image');
				$filename = $menu_image->getClientOriginalName();
				$extension = $menu_image->getClientOriginalExtension();
				if($extension == "webp"){
				$filename = create_seo_link($filename);
                $filename = time()."_".$filename;
				$menu_image->move(public_path().'/uploads/', $filename);
				$update_array['menu_image'] = $filename;
				}else{
					return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
				}
			}
			if($request->hasfile('image2'))
			{
				$page = Page::where('id',$id)->first();
				if($page->image2!='' && file_exists(public_path().'/uploads/'.$page->image2))
				{
					unlink(public_path().'/uploads/'.$page->image2);
				}

				$image2 = $request->file('image2');
				$filename = $image2->getClientOriginalName();
				$extension = $image2->getClientOriginalExtension();
				if($extension == "webp"){
				$filename = create_seo_link($filename);
                $filename = time()."_".$filename;
				$image2->move(public_path().'/uploads/', $filename);
				$update_array['image2'] = $filename;
				}else{
					return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
				}
			}

			Page::where('id', $id)->update($update_array);
			$page = Page::where('id',$id)->first();
			if ($page->posttype=='blog') {
				//$page->category()->attach($request->category_id);
				$page->category()->sync($request->category_id);
			}elseif($page->posttype=='news'){
				$page->news_category = $request->category_id;
				$page->save();
			}elseif($page->posttype == 'case-study'){
			    $page->case_study_category = $request->category_id;
				$page->save();
			}elseif($page->posttype == 'portfolio'){
    			    $page->portfolio_category = $request->category_id;
    				$page->save();
    		}
			//echo "<pre>";print_r($page);exit();

			$page_id = $id;

			if ( isset($request->section_type) && count($request->section_type)>0) {
					$section_type = $request->section_type;
					$type = $request->type;
				for ($i=0; $i < count($request->section_type); $i++) {
					$cur_section_type = $section_type[$i];
					$cur_type = $type[$i];
					if ($cur_type=='add') {
						$max_types = get_fields_value_where('pages_extra',"page_id='".$page_id."'",'type','desc');
						$max_type = ($max_types && count($max_types)>0) ? $max_types[0]->type + 1 : 1 ;

						if ($cur_section_type=='1') {
							$max_type=1;
						}
						$cur_type = $max_type;
					}
				  if ($cur_type>0 && $cur_section_type>0) {

					$max_rank = get_fields_value_where('pages_extra',"page_id='".$page_id."' and type='".$cur_type."'",'rank','desc');
					$rank = ($max_rank && count($max_rank)>0) ? $max_rank[0]->rank + 1 : 1 ;

					$a ='section_new_t';
					$section_new_t = $request->$a;
					$b ='section_new_st';
					$section_new_st = $request->$b;
					$m ='section_new_t1';
					$section_new_t1 = !empty($request->$m) ? $request->$m : '';
					$j ='section_new_st1';
					$section_new_st1 = !empty($request->$j) ? $request->$j : '';
					$k ='package_type_id';
					$package_type_id = !empty($request->$k) ? $request->$k : '0';
					$l ='section_new_c_t';
					$section_new_c_t = !empty($request->$l) ? $request->$l : '';
					$c ='section_new_c';
					$section_new_c = $request->$c;
					$d ='section_new_btn_text';
					$section_new_btn_text = $request->$d;
					$e ='section_new_btn_url';
					$section_new_btn_url = $request->$e;
					$f ='section_new_cat';
					$section_new_cat = $request->$f;
					$g ='video_url';
					$section_video_url = $request->$g;

					$section_new_img = $request->section_new_img;
					$video_img = $request->video_img;
					$section_new_img2 = $request->section_new_img2;
					// $video_file = $request->video_file;

					@$title = $section_new_t[$i];
					@$title1 = $section_new_t1[$i];
					@$sub_title = $section_new_st[$i];
					@$sub_title1 = $section_new_st1[$i];
					@$package_type_id = $package_type_id[$i];
					@$body_title = $section_new_c_t[$i];
					@$blog_parent = $section_new_cat[$i];
					@$video_url = $section_video_url[$i];
					@$body = $section_new_c[$i];
					@$btn_text = $section_new_btn_text[$i];
					@$btn_url = $section_new_btn_url[$i];
					$image = '';
					$image2 = '';


					$obj = new PageExtra;
					$obj->page_id = $page_id;
					$obj->type = $cur_type;
					$obj->section_type = $cur_section_type;
					// if ( isset($video_file) && count($video_file)>0) {
					// 	if($request->hasfile('video_file'))
					// 	{
					// 		$cur_img_count = 0;
					// 		foreach($request->file('video_file') as $file){
					// 			if ($cur_img_count==$i) {
					// 				$filename = $file->getClientOriginalName();
					// 				$extension = $file->getClientOriginalExtension();
					// 				if($extension == "mp4"){
					// 				$filename = create_seo_link($filename);
                    //             	$filename = time()."_".$filename;
					// 				$file->move(public_path().'/uploads/', $filename);
					// 				$video_file = $filename;
					// 				}else{
					// 					return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
					// 				}
					// 			}
					// 			$cur_img_count++;
					// 		}
					// 	}
					// }
					if ( isset($video_img) && count($video_img)>0) {
						if($request->hasfile('video_img'))
						{
							$cur_img_count = 0;
							foreach($request->file('video_img') as $file){
								if ($cur_img_count==$i) {
									$filename = $file->getClientOriginalName();
									$extension = $file->getClientOriginalExtension();
									if($extension == "webp"){
									$filename = create_seo_link($filename);
                                	$filename = time()."_".$filename;
									$file->move(public_path().'/uploads/', $filename);
									$video_img = $filename;
									}else{
										return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
									}
								}
								$cur_img_count++;
							}
						}
					}
					if ( isset($section_new_img) && count($section_new_img)>0) {
						if($request->hasfile('section_new_img'))
						{
							$cur_img_count = 0;
							foreach($request->file('section_new_img') as $file){
								if ($cur_img_count==$i) {
									$filename = $file->getClientOriginalName();
									$extension = $file->getClientOriginalExtension();
									if($extension == "webp"){
									$filename = create_seo_link($filename);
                                	$filename = time()."_".$filename;
									$file->move(public_path().'/uploads/', $filename);
									$image = $filename;
									}else{
										return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
									}
								}
								$cur_img_count++;
							}
						}
					}
					if ( isset($section_new_img2) && count($section_new_img2)>0) {
						if($request->hasfile('section_new_img2'))
						{
							$cur_img_count = 0;
							foreach($request->file('section_new_img2') as $file){
								if ($cur_img_count==$i) {
									$filename = $file->getClientOriginalName();
									$extension = $file->getClientOriginalExtension();
									if($extension == "webp"){
									$filename = create_seo_link($filename);
                                	$filename = time()."_".$filename;
									$file->move(public_path().'/uploads/', $filename);
									$image2 = $filename;
									}else{
										return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
									}
								}
								$cur_img_count++;
							}
						}
					}/**/

					$obj->title = $title;
					$obj->title1 = $title1;
					$obj->sub_title = $sub_title;
					$obj->sub_title1 = $sub_title1;
					$obj->package_type_id = $package_type_id;
					$obj->body_title = $body_title;
					$obj->blog_parent = $blog_parent;
					$obj->video_url = $video_url;
					$obj->body = $body;
					$obj->btn_text = $btn_text;
					$obj->btn_url = $btn_url;
					$obj->image = $image;
					// $obj->video = $video_file;
					$obj->video_img = $video_img;
					$obj->image2 = $image2;
					$obj->rank = $rank;
					$obj->save();

				  }
				}
			}
			return redirect()->back()->with('success', 'Page has been updated successfully.');
		}
	}

	/* Page Extra Fields Remove Image Get*/

	public function page_extra_remove_image($key, $id)
	{
		$pages_extra = PageExtra::where('id',$id)->first();
		$msg = 'Opps!! sorry!! problem occurred.Please try again!';
		if (Auth()->user()->role_id == 1) {
			if ($key=='image' && $pages_extra && $pages_extra->image!='' && file_exists(public_path().'/uploads/'.$pages_extra->image)) {
				unlink(public_path().'/uploads/'.$pages_extra->image);
				$pages_extra->image = '';
			}elseif ($key=='image2' && $pages_extra && $pages_extra->image2!='' && file_exists(public_path().'/uploads/'.$pages_extra->image2)) {
				unlink(public_path().'/uploads/'.$pages_extra->image2);
				$pages_extra->image2 = '';
			}

			$page = Page::where('id',$id)->first();
			if($key=='bannerimage' && $page->bannerimage!='' && file_exists(public_path().'/uploads/'.$page->bannerimage))
			{
				unlink(public_path().'/uploads/'.$page->bannerimage);
				$page->bannerimage = '';
			}
			if($key=='menu_image' && $page->menu_image!='' && file_exists(public_path().'/uploads/'.$page->menu_image))
			{
				unlink(public_path().'/uploads/'.$page->menu_image);
				$page->menu_image = '';
			}
			if($key=='bannervideo' && $page->image2!='' && file_exists(public_path().'/uploads/'.$page->image2))
			{
				unlink(public_path().'/uploads/'.$page->image2);
				$page->image2 = '';
			}

			if (isset($pages_extra) && $pages_extra->save()) {
				$msg = 'Image has been removed successfully.';
			}

			if (isset($page) && $page->save()) {
				$msg = 'Image has been removed successfully.';
			}
		}
		return redirect()->back()->with('success', $msg);
	}

	/* Page Extra Fields Remove Image Get*/

	public function page_extra_remove($id)
	{
		$msg = 'Opps!! sorry!! problem occurred.Please try again!';
		$pages_extra = PageExtra::where('id',$id)->first();
		if ($pages_extra && Auth()->user()->role_id == 1) {
			// if($pages_extra->image!='' && file_exists(public_path().'/uploads/'.$pages_extra->image))
			// {
			// 	unlink(public_path().'/uploads/'.$pages_extra->image);
			// }
			// if($pages_extra->image2!='' && file_exists(public_path().'/uploads/'.$pages_extra->image2))
			// {
			// 	unlink(public_path().'/uploads/'.$pages_extra->image2);
			// }
			PageExtra::destroy($id);
			$msg = 'Section data removed successfully.';
		}
		return redirect()->back()->with('success', $msg);
	}

	public function delete($id)
	{
		$msg = 'Opps!! sorry!! problem occurred.Please try again!';
		if ($id>10 && Auth()->user()->role_id == 1 && !in_array($id, Not_Deletable_Page_ID)) {
			$page = Page::where('id',$id)->first();
			// if($page->bannerimage!='' && file_exists(public_path().'/uploads/'.$page->bannerimage))
			// {
			// 	unlink(public_path().'/uploads/'.$page->bannerimage);
			// }
			// if($page->menu_image!='' && file_exists(public_path().'/uploads/'.$page->menu_image))
			// {
			// 	unlink(public_path().'/uploads/'.$page->menu_image);
			// }
			$pages_extra = PageExtra::where('page_id',$id)->get();
			foreach ($pages_extra as $key => $value) {
				// if($value->image!='' && file_exists(public_path().'/uploads/'.$value->image))
				// {
				// 	unlink(public_path().'/uploads/'.$value->image);
				// }
				// if($value->image2!='' && file_exists(public_path().'/uploads/'.$value->image2))
				// {
				// 	unlink(public_path().'/uploads/'.$value->image2);
				// }
			}
			PageExtra::where('page_id',$id)->delete();
			Page::destroy($id);
			$msg = 'Page has been deleted successfully.';
			return redirect()->back()->with('success', $msg);
		}
		return redirect()->back()->with('error', $msg);
	}

	public function status($id,$status)
	{
		$msg = 'Opps!! sorry!! problem occurred.Please try again!';
		if ($id>3 && Auth()->user()->role_id == 1) {
			if ($status==1) {
				$status = '0';
			}else{
				$status = '1';
			}
			$update_array = array('status' => $status);
			Page::where('id', $id)->update($update_array);
			return redirect()->back()->with('success', 'Status is updated successfully.');
		}
		return redirect()->back()->with('error', $msg);
	}

	/* Admin Manage blog Get*/
	public function blog()
	{
		$sorting_array = array();

		$orderby = Request()->orderby;
		$order = Request()->order;

		if(!$orderby && !$order)
		{
			$orderby = 'menu_order';
			$order = 'asc';
		}

		$column_array = array('id' => 'Id', 'page_name' => 'Title', 'status' => 'Status', 'created_at' => 'Created At');
		$search = Request()->search;
		$where = "posttype='blog' ";

		if($search)
		{
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
		$pages = Page::select('pages.*')->whereRaw($where)->orderBy($orderby, $order)->paginate($item_display_per_page);

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

			$sorting_url = 'blog?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.blog.index', compact('pages','column_array','sorting_array','search'));
	}

	/* Admin Add Page Get*/
	public function blog_add()
	{
		$redirect_page = DB::table('pages')
		->select('id','page_name')
		->get();
		$categories = Category::where('status',1)->orderBy('rank','asc')->get();
		$serviceData = Page::where('status',1)->where('posttype','service')->get();
		return view('admin.blog.add', compact('categories','redirect_page','serviceData'));
	}

	/* Admin Update Page Get*/
	public function blog_edit($id)
	{
		$page = Page::where('id',$id)->where('posttype','blog')->first(); 
		if (!$page)
		{
			return redirect()->back()->with('error', 'Opps!! sorry!! problem occurred.Please try again!');
		}
		$blog_parent = PageExtra::select('blog_parent')->where('status','1')->where('page_id', $id)->get();
		$serviceData = Page::where('status',1)->where('posttype','service')->get();
 
		$redirect_page = DB::table('pages')
		->select('id','page_name')
		->where('id', '!=', $id)
		->get(); 

		$page_extra = PageExtra::where('page_id', $id)->orderBy('type', 'asc')->orderBy('rank', 'asc')->get();
        
		$parent_extra = PageExtra::where('page_id', $id)->whereNull('blog_parent')->get();
 

		$categories = Category::where('status',1)->orderBy('rank','asc')->get();

		return view('admin.blog.edit', compact('page','page_extra','categories','redirect_page','blog_parent','parent_extra','serviceData'));
	}
	
// 	 blog image upload work 
    public function uploadMedia(Request $request)
    {  
        $request->validate([
            'upload' => 'required|file|mimes:webp'
        ]);

        if ($request->hasFile('upload')) {
            $file = $request->file('upload');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $filename);

            $url = asset('uploads/' . $filename);

            return response()->json([
                'uploaded' => true,
                'url' => $url
            ]);
        }

        return response()->json(['uploaded' => false]);
    }

public function uploadFile(Request $request)
{
    pre($request->all());
    if ($request->hasFile('upload')) {
        $file = $request->file('upload');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $path = $file->storeAs('public/uploads/files', $filename); // Store the file
        $url = Storage::url($path); // Get the public URL

        return response()->json([
            'uploaded' => 1,
            'fileName' => $filename,
            'url' => $url
        ]);
    }

    return response()->json(['uploaded' => 0, 'error' => ['message' => 'File upload failed.']]);
}

	/* Admin Manage News Get*/
	public function news()
	{
		$sorting_array = array();

		$orderby = Request()->orderby;
		$order = Request()->order;

		if(!$orderby && !$order)
		{
			$orderby = 'menu_order';
			$order = 'asc';
		}

		$column_array = array('id' => 'Id', 'page_name' => 'Title', 'status' => 'Status', 'created_at' => 'Created At');
		$search = Request()->search;
		$where = "posttype='news' ";

		if($search)
		{
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
		$pages = Page::select('pages.*')->whereRaw($where)->orderBy($orderby, $order)->paginate($item_display_per_page);

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

			$sorting_url = 'news?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.news.index', compact('pages','column_array','sorting_array','search'));
	}

	/* Admin Add Page Get*/
	public function news_add()
	{
		$redirect_page = DB::table('pages')
		->select('id','page_name')
		->get();
		$categories = NewsCategory::where('status',1)->orderBy('rank','asc')->get();
		return view('admin.news.add', compact('categories','redirect_page'));
	}

	/* Admin Update Page Get*/
	public function news_edit($id)
	{
		$page = Page::where('id',$id)->where('posttype','news')->first();
		// echo "<pre>";
		// print_r($page);exit;
		if (!$page)
		{
			return redirect()->back()->with('error', 'Opps!! sorry!! problem occurred.Please try again!');
		}
		$news_parent = PageExtra::select('news_parent')->where('status','1')->where('page_id', $id)->get();

		// echo "<pre>";
		// print_r($blog_parent);exit;
		$redirect_page = DB::table('pages')
		->select('id','page_name')
		->where('id', '!=', $id)
		->get();
		// echo "<pre>";
		// print_r($redirect_page);exit;

		$page_extra = PageExtra::where('page_id', $id)->orderBy('type', 'asc')->orderBy('rank', 'asc')->get();

		$parent_extra = PageExtra::where('page_id', $id)->whereNull('news_parent')->get();

		// echo "<pre>";
		// print_r($parent_extra);exit;

		$categories = NewsCategory::where('status',1)->orderBy('rank','asc')->get();

		return view('admin.news.edit', compact('page','page_extra','categories','redirect_page','news_parent','parent_extra'));
	}


	/* Admin Manage service Get*/
	public function service()
	{
		$sorting_array = array();

		$orderby = Request()->orderby;
		$order = Request()->order;

		if(!$orderby && !$order)
		{
			$orderby = 'menu_order';
			$order = 'asc';
		}

		$column_array = array('id' => 'Id', 'page_name' => 'Title', 'status' => 'Status', 'created_at' => 'Created At');
		$search = Request()->search;
		$where = "posttype='service' ";

		if($search)
		{
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
		$pages = Page::select('pages.*')->whereRaw($where)->orderBy($orderby, $order)->paginate($item_display_per_page);

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

			$sorting_url = 'service?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.service.index', compact('pages','column_array','sorting_array','search'));
	}

	/* Admin Add Page Get*/
	public function service_add()
	{

		// $categories = Category::where('status',1)->orderBy('rank','asc')->get();, compact('categories')
		$data['redirect_page'] = DB::table('pages')
		->select('id','page_name')
		->get();
		$data['all_pages'] = Page::where('posttype','service')->orderBy('menu_order','asc')->get();
		$data['price_widget'] = DB::table('digital_service_price_widget')
            ->select('service_type')
            ->groupBy('service_type')
            ->get();
		return view('admin.service.add', $data);
	}

	/* Admin Update Page Get*/
	public function service_edit($id)
	{
		$data['all_pages'] = Page::where('posttype','service')->where('id', '!=',$id)->orderBy('menu_order','asc')->get();
		$data['page'] = Page::where('id',$id)->where('posttype','service')->first();

		if (!$data['page'])
		{
			return redirect()->back()->with('error', 'Opps!! sorry!! problem occurred.Please try again!');
		}
		$data['redirect_page'] = DB::table('pages')
		->select('id','page_name')
		->where('id', '!=', $id)
		->get();

		$data['page_extra'] = PageExtra::where('page_id',$id)->orderBy('type', 'asc')->orderBy('rank', 'asc')->get();
		$data['categories'] = Category::where('status',1)->orderBy('rank','asc')->get();
        $data['price_widget'] = DB::table('digital_service_price_widget')
            ->select('service_type')
            ->groupBy('service_type')
            ->get();
		return view('admin.service.edit', $data);
	}

	public function resource()
	{
		$sorting_array = array();

		$orderby = Request()->orderby;
		$order = Request()->order;

		if(!$orderby && !$order)
		{
			$orderby = 'menu_order';
			$order = 'asc';
		}

		$column_array = array('id' => 'Id', 'page_name' => 'Title', 'status' => 'Status', 'created_at' => 'Created At');
		$search = Request()->search;
		$where = "posttype='resource'";

		if($search)
		{
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
		$pages = Page::select('pages.*')->whereRaw($where)->orderBy($orderby, $order)->paginate($item_display_per_page);

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

			$sorting_url = 'resource?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.resource.index', compact('pages','column_array','sorting_array','search'));
	}

	/* Admin Add Page Get*/
	public function resource_add()
	{
		// $categories = Category::where('status',1)->orderBy('rank','asc')->get();, compact('categories')
		$data['redirect_page'] = DB::table('pages')
		->select('id','page_name')
		->get();
		$data['all_pages'] = Page::where('posttype','resource')->orderBy('menu_order','asc')->get();
		return view('admin.resource.add', $data);
	}

	/* Admin Update Page Get*/
	public function resource_edit($id)
	{
		$data['all_pages'] = Page::where('posttype','resource')->where('id', '!=',$id)->orderBy('menu_order','asc')->get();
		$data['page'] = Page::where('id',$id)->where('posttype','resource')->first();

		if (!$data['page'])
		{
			return redirect()->back()->with('error', 'Opps!! sorry!! problem occurred.Please try again!');
		}

		$data['redirect_page'] = DB::table('pages')
		->select('id','page_name')
		->where('id', '!=', $id)
		->get();

		$data['page_extra'] = PageExtra::where('page_id',$id)->orderBy('type', 'asc')->orderBy('rank', 'asc')->get();
		$data['categories'] = Category::where('status',1)->orderBy('rank','asc')->get();

		return view('admin.resource.edit', $data);
	}
	public function seoLanding()
	{
		$sorting_array = array();

		$orderby = Request()->orderby;
		$order = Request()->order;

		if(!$orderby && !$order)
		{
			$orderby = 'menu_order';
			$order = 'asc';
		}

		$column_array = array('id' => 'Id', 'page_name' => 'Title', 'display_on_off' => 'Display', 'created_at' => 'Created At');
		$search = Request()->search;
		$where = "posttype='seo'";

		if($search)
		{
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
		$pages = Page::select('pages.*')->whereRaw($where)->orderBy($orderby, $order)->paginate($item_display_per_page);

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

			$sorting_url = 'seo?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.seo.index', compact('pages','column_array','sorting_array','search'));
	}

	/* Admin Add Page Get*/
	public function addSeolanding()
	{

		// $categories = Category::where('status',1)->orderBy('rank','asc')->get();, compact('categories')
		$data['redirect_page'] = DB::table('pages')
		->select('id','page_name')
		->get();
		$data['all_pages'] = Page::where('posttype','seo')->orderBy('menu_order','asc')->get();
		$seo_category = DB::table('seoResultCategory')->get();
		
		return view('admin.seo.add', $data, compact('seo_category'));
	}

	/* Admin Update Page Get*/
    public function editSeolanding($id)
	{
		$data['all_pages'] = Page::where('posttype','seo')->where('id', '!=',$id)->orderBy('menu_order','asc')->get();
// 		$query = Page::where('posttype', 'seo')
//              ->where('id', '!=', $id)
//              ->orderBy('menu_order', 'asc');
// 		// Get the SQL query as a string
//         $sql = $query->toSql();
        
//         // Get the query bindings
//         $bindings = $query->getBindings();
        
//         // Replace the placeholders with bindings to get the complete query
//         foreach ($bindings as $binding) {
//             $sql = preg_replace('/\?/', is_numeric($binding) ? $binding : "'{$binding}'", $sql, 1);
//         }
        
        // Output the raw SQL query
        // echo $sql;
        // die;
		$data['page'] = Page::where('id',$id)->where('posttype','seo')->first();
		$seo_category = DB::table('seoResultCategory')->get();

		if (!$data['page'])
		{
			return redirect()->back()->with('error', 'Opps!! sorry!! problem occurred.Please try again!');
		}

		$data['redirect_page'] = DB::table('pages')
		->select('id','page_name')
		->where('id', '!=', $id)
		->get();

		$data['page_extra'] = PageExtra::where('page_id',$id)->orderBy('type', 'asc')->orderBy('rank', 'asc')->get();

		// echo "<pre>";
		// print_r($data['page_extra']);exit;

		$data['categories'] = Category::where('status',1)->orderBy('rank','asc')->get();

		return view('admin.seo.edit', $data, compact('seo_category'));
	}

	public function insertSeoLanding(Request $request)
	{
		$id = $request->id; 
		$rules = array(
			'page_name' => 'required|string|max:255',
			'slug' => 'required|string|max:255|unique:pages',
			// 'display_in' => 'required|integer',
			// 'parent_id' => 'required|integer',
		);
		
		if($request->hasfile('menu_image'))
		{
			$rules['menu_image'] = 'mimes:webp|max:2048';
		}
		if($request->hasfile('image2'))
		{
			$rules['image2'] = 'mimes:webp|max:2048';
		}

		$validator = Validator::make($request->all() , $rules);
        
		if ($validator->fails())
		{
			return redirect()->back()->withErrors($validator)->withInput($request->all());
		}
		else
		{
		    
			try {

				$pageData = Page::where(['id'=> Seo_Page_ID])->first(); 
                $slug             = $request->slug;
                $page_name        = $request->page_name;
                $page_title       = $request->page_title;
                $bannertext       = $pageData->bannertext;
                $seo_category     = json_encode($request->seo_category);
                $body             = $pageData->body;
                $posttype         = $request->posttype;
                $meta_title       = $request->meta_title;
                $meta_keyword     = $request->meta_keyword;
                $meta_description = $request->meta_description;
                $meta_tag 		  = $request->meta_tag;
                $parent_id        = $request->parent_id>0?$request->parent_id:0;
                $display_in       = $request->display_in>0?$request->display_in:0;
                $menu_order       = $request->menu_order>0?$request->menu_order:0;
                $service_order    = $request->service_order>0?$request->service_order:0;
                $menu_link        = $request->menu_link;
                $page_template    = $request->page_template>0?$request->page_template:0;
                $status           = $request->status=='0'?0:1;
                $author_name      = $request->author_name?$request->author_name:$page_title;
                $author_desg      = $request->author_desg;
                $author_url       = $pageData->author_url;
                $bannerimage      = $pageData->bannerimage;
                $image2      	  = $pageData->image2;

				$update_array = array('business_category'=>$seo_category,'page_name' => $page_name, 'page_title' => $page_title, 'bannertext' => $bannertext, 'body' => $body, 'posttype' => $posttype, 'meta_title' => $meta_title, 'meta_keyword' => $meta_keyword, 'meta_description' => $meta_description, 'display_in' => $display_in, 'menu_order' => $menu_order,'service_order' => $service_order, 'status' => $status, 'parent_id' => $parent_id,'page_title' => $author_name,'author_url' => $author_url,'bannerimage' => $bannerimage,'image2' => $image2);//, 'menu_link' => $menu_link
                 
				// if($request->hasfile('bannerimage'))
				// {
				// 	$bannerimage = $request->file('bannerimage');
				// 	$filename = $bannerimage->getClientOriginalName();
				// 	$filename = create_seo_link($filename);
                //     $filename = time()."_".$filename;
				// 	$bannerimage->move(public_path().'/uploads/', $filename);
				// 	$update_array['bannerimage'] = $filename;
				// }
				/*if($request->hasfile('menu_image'))
				{
					$menu_image = $request->file('menu_image');
					$filename = $menu_image->getClientOriginalName();
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$menu_image->move(public_path().'/uploads/', $filename);
					$update_array['menu_image'] = $filename;
				}*/
				// if($request->hasfile('image2'))
				// {
				// 	$image2 = $request->file('image2');
				// 	$filename = $image2->getClientOriginalName();
				// 	$filename = create_seo_link($filename);
                //     $filename = time()."_".$filename;
				// 	$image2->move(public_path().'/uploads/', $filename);
				// 	$update_array['image2'] = $filename;
				// }

				if ($slug) {
					$update_array['slug'] = $slug;
				}

				$update_array['page_template'] = $page_template;
				$page_id = DB::table('pages')->insertGetId($update_array);
				$page = Page::where('id',$page_id)->first();
				if ($page->posttype=='blog') {
					$page->category()->attach($request->category_id);
				}
				// print_r($page_id);exit();

				if ( isset($request->section_type) && count($request->section_type)>0) {
						$section_type = $request->section_type;
					for ($i=0; $i < count($request->section_type); $i++) {
						$cur_section_type = $section_type[$i];
						if ($cur_section_type=='1') {
							$type=1;
						}else{
							$type=$i + 1;
						}

						$max_rank = get_fields_value_where('pages_extra',"page_id='".$page_id."' and type='".$type."'",'rank','desc');
						$rank = ($max_rank && count($max_rank)>0) ? $max_rank[0]->rank + 1 : 1 ;

						$a ='section_new_t';
						$section_new_t = $request->$a;
						$b ='section_new_st';
						$section_new_st = $request->$b;
						$c ='section_new_c';
						$section_new_c = $request->$c;
						$d ='section_new_btn_text';
						$section_new_btn_text = $request->$d;
						$e ='section_new_btn_url';
						$section_new_btn_url = $request->$e;

						$section_new_img = $request->section_new_img;
						$section_new_img2 = $request->section_new_img2;

						@$title = $section_new_t[$i];
						@$sub_title = $section_new_st[$i];
						@$body = $section_new_c[$i];
						@$btn_text = $section_new_btn_text[$i];
						@$btn_url = $section_new_btn_url[$i];
						$image = '';
						$image2 = '';

						$obj = new PageExtra;
						$obj->page_id = $page_id;
						$obj->type = $type;
						$obj->section_type = $cur_section_type;
						if ( isset($section_new_img) && count($section_new_img)>0) {
							if($request->hasfile('section_new_img'))
							{
								$cur_img_count = 0;
								foreach($request->file('section_new_img') as $file){
									if ($cur_img_count==$i) {
										$filename = $file->getClientOriginalName();
										$extension = $file->getClientOriginalExtension();
										if($extension == "webp"){
										$filename = create_seo_link($filename);
                                		$filename = time()."_".$filename;
										$file->move(public_path().'/uploads/', $filename);
										$image = $filename;
										}else{
											return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
										}
									}
									$cur_img_count++;
								}
							}
						}
						if ( isset($section_new_img2) && count($section_new_img2)>0) {
							if($request->hasfile('section_new_img2'))
							{
								$cur_img_count = 0;
								foreach($request->file('section_new_img2') as $file){
									if ($cur_img_count==$i) {
										$filename = $file->getClientOriginalName();
										$extension = $file->getClientOriginalExtension();
										if($extension == "webp"){
										$filename = create_seo_link($filename);
                                		$filename = time()."_".$filename;
										$file->move(public_path().'/uploads/', $filename);
										$image2 = $filename;
										}else{
											return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
										}
									}
									$cur_img_count++;
								}
							}
						}/**/

						$obj->title = $title;
						$obj->sub_title = $sub_title;
						$obj->body = $body;
						$obj->btn_text = $btn_text;
						$obj->btn_url = $btn_url;
						$obj->image = $image;
						$obj->image2 = $image2;
						$obj->rank = $rank;
						$obj->save();
					}
				}

				if ($page->posttype=='seo') {
					$extra = PageExtra::where(['page_id'=> Seo_Page_ID])->get();


					foreach($extra as $val){
						$obj = new PageExtra;
						$obj->page_id = $page_id;
						$obj->type = $val->type;
						$obj->section_type = $val->section_type;
						$obj->title = $val->title;
						$obj->image2 = $val->image2;
						$obj->sub_title = $val->sub_title;
						$obj->btn_text = $val->btn_text;
						$obj->btn_url = $val->btn_url;
						$obj->image = $val->image;
						$obj->body = $val->body;
						$obj->rank = $val->rank;
						$obj->link = $val->link;
						$obj->founder = $val->founder;
						$obj->business_category = $val->business_category;
						$obj->competition = $val->competition;
						$obj->seo_package = $val->seo_package;
						$obj->news_parent = $val->news_parent;
						$obj->save();
					}
				}

				//return redirect()->back()->with('success', true);
				return Redirect::to(Admin_Prefix.'seo-landing'.'/edit/'.$page_id)->with('success', 'Page has been added successfully.');

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}

		}
	}
	public function deleteSeoLanding($id)
	{
		$msg = 'Opps!! sorry!! problem occurred.Please try again!';
		if ($id>10 && Auth()->user()->role_id == 1 && !in_array($id, Not_Deletable_Page_ID)) {
			$page = Page::where('id',$id)->first();
			// if($page->bannerimage!='' && file_exists(public_path().'/uploads/'.$page->bannerimage))
			// {
			// 	unlink(public_path().'/uploads/'.$page->bannerimage);
			// }
			// if($page->menu_image!='' && file_exists(public_path().'/uploads/'.$page->menu_image))
			// {
			// 	unlink(public_path().'/uploads/'.$page->menu_image);
			// }
			$pages_extra = PageExtra::where('page_id',$id)->get();
			foreach ($pages_extra as $key => $value) {
				if($value->image!='' && file_exists(public_path().'/uploads/'.$value->image))
				{
					unlink(public_path().'/uploads/'.$value->image);
				}
				if($value->image2!='' && file_exists(public_path().'/uploads/'.$value->image2))
				{
					unlink(public_path().'/uploads/'.$value->image2);
				}
			}
			PageExtra::where('page_id',$id)->delete();
			Page::destroy($id);
			$msg = 'Page has been deleted successfully.';
			return redirect()->back()->with('success', $msg);
		}
		return redirect()->back()->with('error', $msg);
	}
	public function updateSeoLanding(Request $request)
	{    
	    ini_set('memory_limit', '512M'); // Increase memory limit if necessary
        ini_set('max_execution_time', '300'); // Increase execution time limit if necessary
 
        
		$id = $request->id;
		$page_extra = PageExtra::where('page_id',$id)->orderBy('type', 'asc')->get();//where('type', '!=', '1')->

		$slug = $request->slug;
		$page_name = $request->page_name;
		$seo_category = json_encode($request->seo_category);
		$page_title = $request->page_title;
		$banner_text_value = $request->banner_text_value;
		$body = $request->body;
		$posttype = $request->posttype;
		$meta_tag = $request->meta_tag;
		$redirect_to = $request->redirect_to;
		$meta_title = $request->meta_title;
		$meta_keyword = $request->meta_keyword;
		$meta_description = $request->meta_description;
		$parent_id = $request->parent_id>0?$request->parent_id:0;
		$display_in = $request->display_in>0?$request->display_in:0;
		$menu_order = $request->menu_order>0?$request->menu_order:0;
		$service_order = $request->service_order>0?$request->service_order:0;
		$menu_link = $request->menu_link;
		$page_template = $request->page_template>0?$request->page_template:0;
		$status = $request->status=='0'?0:1;
		$author_name      = $request->author_name?$request->author_name:$page_title;
		$author_desg = $request->author_desg;
		$author_url = $request->author_url;

		if ($id==1) {
			$status = 1;
		}
		if ($id==Category_Default_Page_ID) {
			$parent_id = 0;
		}

		$rules = array(
			'page_name' => 'required|string|max:255',
			'slug' => 'required|string|max:255|unique:pages,slug,'.$id,
			//'display_in' => 'required|integer',
			//'parent_id' => 'required|integer',
		);

		if($request->hasfile('bannerimage'))
		{
			$rules['bannerimage'] = 'mimes:webp|max:2048';
		}
		if($request->hasfile('menu_image'))
		{
			$rules['menu_image'] = 'mimes:webp|max:2048';
		}
		if($request->hasfile('image2'))
		{
			$rules['image2'] = 'mimes:webp|max:2048';
		}

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to(''.'seo-landing'.'/edit/'.$id)->withErrors($validator)->withInput();
		}
		else
		{ 
		    foreach ($page_extra as $val) {
				
				$ax ='section_package_type_'.$val->id;
				$section_package_type = !empty($request->$ax) ? $request->$ax : '0';
				$ay ='section_title1_'.$val->id;
				$section_title1 = !empty($request->$ay) ? $request->$ay : '';
				$az ='section_sub_title1_'.$val->id;
				$section_sub_title1 = !empty($request->$az) ? $request->$az : '';
				$aa ='section_body_title_'.$val->id;
				$section_body_title = !empty($request->$aa) ? $request->$aa : '';

				$x ='section_title_'.$val->id;
				$page_extra_title = $request->$x;
				$y ='section_sub_title_'.$val->id;
				$page_extra_sub_title = $request->$y;
				$z ='section_body_'.$val->id;
				$page_extra_body = $request->$z;
				$a ='section_btn_text_'.$val->id;
				$page_extra_btn_text = $request->$a;
				$b ='section_btn_url_'.$val->id;
				$page_extra_btn_url = $request->$b;
				$c ='section_rank_'.$val->id;
				$page_extra_rank = $request->$c;

				$d ='section_video_url'.$val->id;
				$page_extra_video_url = $request->$d;
				
				// new section edit function -----------------------------------
				$section_link ='section_link_'.$val->id;
				$Slink = $request->$section_link;
				
				$section_founder ='section_founder_'.$val->id;
				$founder = $request->$section_founder;
				
				$section_business_category ='section_business_category_'.$val->id;
				$busCat = $request->$section_business_category;
				
				$section_competition ='section_competition_'.$val->id;
				$SecCompe = $request->$section_competition;
				
				$section_seo_package ='section_seo_package_'.$val->id;
				$SecPackage = $request->$section_seo_package;
				
                // new section edit function -----------------------------------
                
				$d ='section_fk_parent_id_'.$val->id;
				$page_extra_fk_parent_id = $request->$d;

 
				$page_extra_status = $request->{'section_status_'.$val->id};
				$page_extra_status = ($page_extra_status>0) ? 1 : 0 ;
				$update_array1 = array('title' => $page_extra_title,'body' => $page_extra_body,'sub_title' => $page_extra_sub_title,'btn_text' => $page_extra_btn_text,'btn_url' => $page_extra_btn_url,'blog_parent' => $page_extra_fk_parent_id,'video_url' => $page_extra_video_url, 'package_type_id' => $section_package_type, 'title1' => $section_title1, 'sub_title1' => $section_sub_title1, 'body_title' => $section_body_title, 'link'=>$Slink, 'founder'=>$founder, 'business_category'=>$busCat, 'competition'=>$SecCompe, 'seo_package'=>$SecPackage);
				
				if ($page_extra_rank>0) {
					$update_array1['rank'] = $page_extra_rank;
				}
					$update_array1['status'] = $page_extra_status;

				if($request->hasfile('section_file_'.$val->id))
				{
				    
					if($val->image !='' && file_exists(public_path().'/uploads/'.$val->image))
					{
						unlink(public_path().'/uploads/'.$val->image);
					}
					$file = $request->file('section_file_'.$val->id); 
					$filename = $file->getClientOriginalName();
					$extension = $file->getClientOriginalExtension();
					if($extension =="webp"){
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$file->move(public_path().'/uploads/', $filename);
					$update_array1['image'] = $filename;
					
					}else{
						return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
					}
				}
				if($request->hasfile('section_video_img'.$val->id))
				{
					if($val->video_img!='' && file_exists(public_path().'/uploads/'.$val->video_img))
					{
						unlink(public_path().'/uploads/'.$val->video_img);
					}
					$file = $request->file('section_video_img'.$val->id);
					$filename = $file->getClientOriginalName();
					$extension = $file->getClientOriginalExtension();
					if($extension =="webp"){
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$file->move(public_path().'/uploads/', $filename);
					$update_array1['video_img'] = $filename;
					}else{
						return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
					}
				}  
				if($request->hasfile('section_file2_'.$val->id))
				{
					if($val->image2!='' && file_exists(public_path().'/uploads/'.$val->image2))
					{
						unlink(public_path().'/uploads/'.$val->image2);
					}
					$file = $request->file('section_file2_'.$val->id);
					$filename = $file->getClientOriginalName();
					$extension = $file->getClientOriginalExtension();
					if($extension =="webp"){
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$file->move(public_path().'/uploads/', $filename);
					$update_array1['image2'] = $filename;
					}else{
						return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
					}
				}
				DB::table('pages_extra')->where('id', $val->id)->update($update_array1);
				
			}
			$update_array = array('business_category'=>$seo_category, 'page_name' => $page_name, 'page_title' => $page_title, 'bannertext' => $banner_text_value, 'body' => $body, 'posttype' => $posttype, 'meta_title' => $meta_title, 'meta_keyword' => $meta_keyword,'meta_description' => $meta_description,'meta_tag' => $meta_tag,'redirect_to'=>$redirect_to, 'display_in' => $display_in, 'menu_order' => $menu_order,'service_order' => $service_order,'status' => $status,'page_title' => $author_name,'author_url' => $author_url);//, 'menu_link' => $menu_link
			 
			$update_array['page_template'] = $page_template;
			if ($slug && $id!='1') {
				$update_array['slug'] = $slug;
			}

			if($request->hasfile('bannerimage'))
			{
				$page = Page::where('id',$id)->first();
				if($page->bannerimage!='' && file_exists(public_path().'/uploads/'.$page->bannerimage))
				{
					unlink(public_path().'/uploads/'.$page->bannerimage);
				}

				$bannerimage = $request->file('bannerimage');
				$filename = $bannerimage->getClientOriginalName();
				$extension = $bannerimage->getClientOriginalExtension();
				if($extension == "webp"){
				$filename = create_seo_link($filename);
                $filename = time()."_".$filename;
				$bannerimage->move(public_path().'/uploads/', $filename);
				$update_array['bannerimage'] = $filename;
				}else{
					return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
				}
			}
			if($request->hasfile('menu_image'))
			{
				$page = Page::where('id',$id)->first();
				if($page->menu_image!='' && file_exists(public_path().'/uploads/'.$page->menu_image))
				{
					unlink(public_path().'/uploads/'.$page->menu_image);
				}
				$menu_image = $request->file('menu_image');
				$filename = $menu_image->getClientOriginalName();
				$extension = $menu_image->getClientOriginalExtension();
				if($extension == "webp"){
				$filename = create_seo_link($filename);
                $filename = time()."_".$filename;
				$menu_image->move(public_path().'/uploads/', $filename);
				$update_array['menu_image'] = $filename;
				}else{
					return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
				}
			}
			if($request->hasfile('image2'))
			{
				$page = Page::where('id',$id)->first();
				if($page->image2!='' && file_exists(public_path().'/uploads/'.$page->image2))
				{
					unlink(public_path().'/uploads/'.$page->image2);
				}

				$image2 = $request->file('image2');
				$filename = $image2->getClientOriginalName();
				$extension = $image2->getClientOriginalExtension();
				if($extension == "webp"){
				$filename = create_seo_link($filename);
                $filename = time()."_".$filename;
				$image2->move(public_path().'/uploads/', $filename);
				$update_array['image2'] = $filename;
				}else{
					return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
				}
			}  
			
            if($request->hasfile('result_overview')){
                // Import the data from the Excel file 
                $csv = parse_csv_file($request->file('result_overview'));
                $filtered_csv = array_filter($csv, function($row) {
                    // Check if all values in the row are not empty
                    return array_filter($row);
                });
                // Reindex the array to maintain numerical keys in order
                $filtered_csv = array_values($filtered_csv);
                $update_array['result_overview_csv'] = json_encode($filtered_csv);
            }
            if($request->hasfile('keyword_csv')){ 
		        
                $csv = parse_csv_file($request->file('keyword_csv')); 
                $filtered_csvs = array_filter($csv, function($row) {  
                    return array_filter($row);
                }); 
                
                $filtered_csv_new = array_values($filtered_csvs);
                
                $data_new = $this->utf8ize($filtered_csv_new);
                $update_array['keywords_csv'] = json_encode($data_new, JSON_PRETTY_PRINT);
            }
            
            
            // if (json_last_error() !== JSON_ERROR_NONE) {
            //     echo 'JSON encoding error: ' . json_last_error_msg();
            // } else {
            //     // Display or save the JSON data
            //     // For demonstration, we'll just display the length of the JSON string
            //     echo 'JSON data length: ' . strlen($json_data);
            
            //     // Optionally, save the JSON data to a file
            //     file_put_contents('large_data.json', $json_data);
            // }
            // echo "<pre>";print_r($json_data); die;
            // die;
            
            if($request->hasfile('keyword_growth_csv')){
                // Import the data from the Excel file 
                $csv = parse_csv_file($request->file('keyword_growth_csv'));
                $filtered_csv = array_filter($csv, function($row) {
                    // Check if all values in the row are not empty
                    return array_filter($row);
                });
                // Reindex the array to maintain numerical keys in order
                $filtered_csv = array_values($filtered_csv);
                $update_array['keyword_growth_csv'] = json_encode($filtered_csv);
            }
            
            // Debug line moved outside the if block
            // echo "<pre>"; print_r($update_array['keywords_csv']); die;
            
            Page::where('id', $id)->update($update_array);
            $page = Page::where('id', $id)->first();
			
			if ($page->posttype=='blog') {
				//$page->category()->attach($request->category_id);
				$page->category()->sync($request->category_id);
			} 

			$page_id = $id;

			if ( isset($request->section_type) && count($request->section_type)>0) {
					$section_type = $request->section_type;
					$type = $request->type;
				for ($i=0; $i < count($request->section_type); $i++) {
					$cur_section_type = $section_type[$i];
					$cur_type = $type[$i];
					if ($cur_type=='add') {
						$max_types = get_fields_value_where('pages_extra',"page_id='".$page_id."'",'type','desc');
						$max_type = ($max_types && count($max_types)>0) ? $max_types[0]->type + 1 : 1 ;

						if ($cur_section_type=='1') {
							$max_type=1;
						}
						$cur_type = $max_type;
					}
				  if ($cur_type>0 && $cur_section_type>0) {

					$max_rank = get_fields_value_where('pages_extra',"page_id='".$page_id."' and type='".$cur_type."'",'rank','desc');
					$rank = ($max_rank && count($max_rank)>0) ? $max_rank[0]->rank + 1 : 1 ;

					$a ='section_new_t';
					$section_new_t = $request->$a;
					$b ='section_new_st';
					$section_new_st = $request->$b;
					$c ='section_new_c';
					$section_new_c = $request->$c;
					$d ='section_new_btn_text';
					$section_new_btn_text = $request->$d;
					$e ='section_new_btn_url';
					$section_new_btn_url = $request->$e;
					$f ='section_new_cat';
					$section_new_cat = $request->$f;
					$g ='video_url';
					$section_video_url = $request->$g;




					// $h ='new_link';
					// $section_new_link = $request->$h;
					// $i ='new_founder';
					// $section_new_founder = $request->$i;
					// $j ='business_category';
					// $section_business_category = $request->$j;
					// $k ='competition';
					// $section_competition = $request->$k;
					// $l ='seo_package';
					// $section_seo_package = $request->$l;

					$section_new_img = $request->section_new_img;

					$video_img = $request->video_img;
					$section_new_img2 = $request->section_new_img2;
					// $video_file = $request->video_file;

					@$title = $section_new_t[$i];
					@$sub_title = $section_new_st[$i];
					@$blog_parent = $section_new_cat[$i];
					@$video_url = $section_video_url[$i];

					@$new_link = $section_new_link[$i];

					@$new_founder = $section_new_founder[$i];
					@$business_category = $section_business_category[$i];
					@$competition = $section_competition[$i];
					@$seo_package = $section_seo_package[$i];

					@$body = $section_new_c[$i];
					@$btn_text = $section_new_btn_text[$i];
					@$btn_url = $section_new_btn_url[$i];
					$image = '';
					$image2 = '';

					$obj = new PageExtra;
					$obj->page_id = $page_id;
					$obj->type = $cur_type;
					$obj->section_type = $cur_section_type;
					// if ( isset($video_file) && count($video_file)>0) {
					// 	if($request->hasfile('video_file'))
					// 	{
					// 		$cur_img_count = 0;
					// 		foreach($request->file('video_file') as $file){
					// 			if ($cur_img_count==$i) {
					// 				$filename = $file->getClientOriginalName();
					// 				$extension = $file->getClientOriginalExtension();
					// 				if($extension == "mp4"){
					// 				$filename = create_seo_link($filename);
                    //             	$filename = time()."_".$filename;
					// 				$file->move(public_path().'/uploads/', $filename);
					// 				$video_file = $filename;
					// 				}else{
					// 					return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
					// 				}
					// 			}
					// 			$cur_img_count++;
					// 		}
					// 	}
					// }
					if ( isset($video_img) && count($video_img)>0) {
						if($request->hasfile('video_img'))
						{
							$cur_img_count = 0;
							foreach($request->file('video_img') as $file){
								if ($cur_img_count==$i) {
									$filename = $file->getClientOriginalName();
									$extension = $file->getClientOriginalExtension();
									if($extension == "webp"){
									$filename = create_seo_link($filename);
                                	$filename = time()."_".$filename;
									$file->move(public_path().'/uploads/', $filename);
									$video_img = $filename;
									}else{
										return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
									}
								}
								$cur_img_count++;
							}
						}
					}
					if ( isset($section_new_img) && count($section_new_img)>0) {
						if($request->hasfile('section_new_img'))
						{
							$cur_img_count = 0;
							foreach($request->file('section_new_img') as $file){
								if ($cur_img_count==$i) {
									$filename = $file->getClientOriginalName();
									$extension = $file->getClientOriginalExtension();
									if($extension == "webp"){
									$filename = create_seo_link($filename);
                                	$filename = time()."_".$filename;
									$file->move(public_path().'/uploads/', $filename);
									$image = $filename;
									}else{
										return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
									}
								}
								$cur_img_count++;
							}
						}
					}

					if ( isset($new_excel) && count($new_excel)>0) {
						$file = $request->file('file');
						$request->validate([
							'file' => 'required|mimes:csv,txt',
						]);
					
						Excel::import(new KeywordImport, $file);
					}


					if ( isset($section_new_img2) && count($section_new_img2)>0) {
						if($request->hasfile('section_new_img2'))
						{
							$cur_img_count = 0;
							foreach($request->file('section_new_img2') as $file){
								if ($cur_img_count==$i) {
									$filename = $file->getClientOriginalName();
									$extension = $file->getClientOriginalExtension();
									if($extension == "webp"){
									$filename = create_seo_link($filename);
                                	$filename = time()."_".$filename;
									$file->move(public_path().'/uploads/', $filename);
									$image2 = $filename;
									}else{
										return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
									}
								}
								$cur_img_count++;
							}
						}
					}/**/

					$obj->title = $title;
					$obj->sub_title = $sub_title;
					$obj->blog_parent = $blog_parent;
					$obj->video_url = $video_url;

					// $obj->link = $new_link;
					// $obj->founder = $new_founder;
					// $obj->business_category = $business_category;
					// $obj->competition = $competition;
					// $obj->seo_package = $seo_package;

					$obj->body = $body;
					$obj->btn_text = $btn_text;
					$obj->btn_url = $btn_url;
					$obj->image = $image;
					// $obj->video = $video_file;
					$obj->video_img = $video_img;
					$obj->image2 = $image2;
					$obj->rank = $rank;

					// echo "<pre>";
					// print_r($obj);exit;
					$obj->save();

				  }
				}
			}
			return redirect()->back()->with('success', 'Page has been updated successfully.');
		}
	}
	
	function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = $this->utf8ize($v);
        }
    } else if (is_string($d)) {
        return mb_convert_encoding($d, 'UTF-8', 'UTF-8');
    }
    return $d;
}
    
    //  seo result on and off in frontend
       public function display_visible_seo_result($id) {
            $page = Page::find($id);
            if ($page) {
                $display = $page->display_on_off == 'Active' ? 'Inactive' : 'Active';
                
                $result = Page::where('id', $page->id)->update(['display_on_off' => $display]);
                
                if ($result) {
                    return back()->with('success', 'Result Visibility Changed Successfully!');
                } else {
                    return back()->with('error', 'Failed to Change Result Visibility.');
                }
            } else {
                return back()->with('error', 'Page not found.');
            }
        }


	public function countries()
	{
		$orderby = Request()->orderby;
		$order = Request()->order;

		if(!$orderby && !$order)
		{
			$orderby = 'id';
			$order = 'asc';
		}

		$sorting_array = array();

		$column_array = array('id' => 'Id','country_url'=>'Country Url','name' => 'Title','created_at' => 'Created At');
		$search = Request()->search;

		$where = "";
		if ($search) {
			$where .= "(";
			$i = 1;
			foreach ($column_array as $key => $val) {
				if ($i > 1) {
					$where .= " or ";
				}

				$where .= $key . " like '%" . $search . "%'";
				$i++;
			}
			$where .= ")";
		} else {
			$where = "1"; // A default condition to return all rows
		}

		$item_display_per_page = config('admin.pagination');
		$countries = Country::select('countries.*')->whereRaw($where)->orderBy($orderby, $order)->paginate($item_display_per_page);

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

			$sorting_url = 'countries?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}
		return view('admin.location.countries_list', compact('countries','column_array','sorting_array','search'));
	}

	/* Admin Add Page Get*/
	public function country_add(Request $request)
	{

		if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'country_name' => 'required',
            ]);

            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            }else{
                $country = new Country;
                $country->name = $request->input('country_name');
                $country->country_url = $request->input('country_url');
                if($country->save()){
                    return redirect()->route('countries');
                }
            }
        }

		return view('admin.location.country_add');
	}

	/* Admin Update Page Get*/
	public function country_edit(Request $request,$id)
	{
		if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
				'country_name' => 'required',
            ]);

            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            }else{
                $country = Country::find($id);

                $country->name = $request->input('country_name');
                $country->country_url = $request->input('country_url');

                if($country->save()){
					return redirect()->route('countries');
                }
            }
        }
        $countryData = Country::find($id);
		return view('admin.location.country_edit',compact('countryData'));
	}
	public function delete_country($id)
	{
		$msg = 'Opps!! sorry!! problem occurred.Please try again!';
		if ($id) {
			$country = Country::where('id',$id)->first();

			Country::destroy($country->id);
			return redirect()->back()->with('success', 'Country has been deleted successfully.');
		}
		return redirect()->back()->with('error', $msg);
	}


	public function cities()
	{
		$orderby = Request()->orderby;
		$order = Request()->order;

		if(!$orderby && !$order)
		{
			$orderby = 'city_id';
			$order = 'asc';
		}

		$sorting_array = array();

		$column_array = array('city_id' => 'Id', 'city_name' => 'Title','created_at' => 'Created At');
		$search = Request()->search;

		$where = "";
		if ($search) {
			$where .= "(";
			$i = 1;
			foreach ($column_array as $key => $val) {
				if ($i > 1) {
					$where .= " or ";
				}

				$where .= $key . " like '%" . $search . "%'";
				$i++;
			}
			$where .= ")";
		} else {
			$where = "1"; // A default condition to return all rows
		}

		$item_display_per_page = config('admin.pagination');
		$cities = Cities::select('cities.*')->whereRaw($where)->orderBy($orderby, $order)->paginate($item_display_per_page);

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

			$sorting_url = 'cities?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}



		return view('admin.location.cities_list', compact('cities','column_array','sorting_array','search'));
	}

	/* Admin Add Page Get*/
	public function city_add(Request $request)
	{
		if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'city_name' => 'required',
        		'slug' => 'required|string|max:255|unique:cities',
            ]);

            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            }else{
                $city = new Cities;
                $city->city_name = $request->input('city_name');
                $city->slug = $request->input('slug');

                if($city->save()){
					return redirect()->route('cities')->with('success', 'City has been Addded successfully.');
                }
            }
        }
		$countries = Country::all();
		return view('admin.location.city_add',compact('countries'));
	}

	public function city_edit(Request $request,$id)
	{
		if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
				'city_name' => 'required',
				'slug' => 'required|string|max:255'
            ]);

            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            }else{
                $city = Cities::find($id);
				$city->city_name = $request->input('city_name');
                $city->slug = $request->input('slug');
                if($city->save()){
					return redirect()->route('cities')->with('success', 'City has been Edited successfully.');
                }
            }
        }
		$countryData = Cities::where('city_id',$id)->first();

		// echo "<pre>";
		// print_r($countryData);exit;
        $cityData = Cities::find($id);
		$countries = Country::all();

		return view('admin.location.city_edit',compact('countryData','countries'));
	}
	public function delete_city($id)
	{
		$msg = 'Opps!! sorry!! problem occurred.Please try again!';
		if ($id) {
			$city = Cities::where('city_id',$id)->first();

			Cities::destroy($city->city_id);
			return redirect()->back()->with('success', 'City has been deleted successfully.');
		}
		return redirect()->back()->with('error', $msg);
	}


	public function business()
	{
		$orderby = Request()->orderby;
		$order = Request()->order;

		if(!$orderby && !$order)
		{
			$orderby = 'id';
			$order = 'asc';
		}

		$sorting_array = array();

		$column_array = array('id' => 'Id', 'business_name' => 'Title','created_at' => 'Created At');
		$search = Request()->search;

		$where = "";
		if ($search) {
			$where .= "(";
			$i = 1;
			foreach ($column_array as $key => $val) {
				if ($i > 1) {
					$where .= " or ";
				}

				$where .= $key . " like '%" . $search . "%'";
				$i++;
			}
			$where .= ")";
		} else {
			$where = "1"; // A default condition to return all rows
		}

		$item_display_per_page = config('admin.pagination');
		$business = Business::select('business.*')->whereRaw($where)->orderBy($orderby, $order)->paginate($item_display_per_page);

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

			$sorting_url = 'business?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}



		return view('admin.location.business_list', compact('business','column_array','sorting_array','search'));
	}

	/* Admin Add Page Get*/
	public function business_add(Request $request)
	{
		if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
                'business_name' => 'required',
        		'slug' => 'required|string|max:255|unique:business',

            ]);

            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            }else{
                $business = new Business;
                $business->business_name = $request->input('business_name');
                $business->slug = $request->input('slug');
                if($business->save()){
					return redirect()->route('business')->with('success', 'Business has been Addded successfully.');
                }
            }
        }
		$countries = Country::all();

		return view('admin.location.business_add');
	}

	public function business_edit(Request $request,$id)
	{
		if ($request->isMethod('post')) {

            $validator = Validator::make($request->all(), [
				'business_name' => 'required',
				'slug' => 'required|string|max:255|unique:business,slug,'.$id,
            ]);

            if ($validator->fails()) {
                return Redirect::back()->withErrors($validator)->withInput();
            }else{
                $business = Business::find($id);
				$business->business_name = $request->input('business_name');
                $business->slug = $request->input('slug');
                if($business->save()){
					return redirect()->route('business')->with('success', 'Business has been Edited successfully.');
                }
            }
        }
		$businessData = Business::where('id',$id)->first();

		// echo "<pre>";
		// print_r($countryData);exit;
        $cityData = Business::find($id);
		$countries = Country::all();

		return view('admin.location.business_edit',compact('businessData','countries'));
	}
	public function delete_business($id)
	{
		$msg = 'Opps!! sorry!! problem occurred.Please try again!';
		if ($id) {
			$business = Business::where('id',$id)->first();

			Business::destroy($business->id);
			return redirect()->back()->with('success', 'Business has been deleted successfully.');
		}
		return redirect()->back()->with('error', $msg);
	}


	public function fetchFormData()
	{
		$sorting_array = array();
	
		$orderby = Request()->orderby;
		$order = Request()->order;
	
		if (!$orderby && !$order) {
			$orderby = 'created_at';
			$order = 'asc';
		}
	
		$column_array = array('id' => 'Id', 'first_name' => 'Name',  'budget' => 'Budget',  'phone' => 'Phone', 'website' => 'Website', 'message' => 'Message', 'service_name' => 'service_name', 'created_at' => 'created_at');
	
		$search = Request()->search;
		$from = Request()->from; // Get the 'from' date value
		$to = Request()->to; // Get the 'to' date value
		$where = "id != 0";
	
		if ($search) {
			$where .= " and (";
			$i = 1;
			foreach ($column_array as $key => $val) {
				if ($i > 1) {
					$where .= " or ";
				}
	
				$where .= $key . " like '%" . $search . "%'";
				$i++;
			}
			$where .= ")";
		}
	
		if ($from && $to) {
			// Convert 'from' and 'to' dates to the database format (YYYY-MM-DD)
			$fromDate = date('Y-m-d', strtotime($from));
			$toDate = date('Y-m-d', strtotime($to));
			$where .= " and DATE(created_at) >= '" . $fromDate . "' and DATE(created_at) <= '" . $toDate . "'";
		}
	
		$item_display_per_page = config('admin.pagination');
		$contact_us = Contact_us::select('*')
			->whereRaw($where)
			->orderBy($orderby, $order)
			->paginate($item_display_per_page);
	
		foreach ($column_array as $key => $value) {
			$sorting_class = 'sorting';
			$sorting_url_orderby = $key;
			$sorting_url_order = 'asc';
	
			if ($orderby == $key) {
				$sorting_class = ($order == 'asc' ? 'sorting_asc' : 'sorting_desc');
	
				$sorting_url_order = ($order == 'asc' ? 'desc' : 'asc');
			}
	
			$sorting_url = 'contact?' . ($search != "" ? 'search=' . $search . '&' : '') . 'orderby=' . $sorting_url_orderby . '&order=' . $sorting_url_order;
	
			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}
	
		// Check if $fromDate and $toDate are empty, and set them to null if they are
		$fromDate = $fromDate ?? null;
		$toDate = $toDate ?? null;
	
		return view('admin.enquiry.contact_form', compact('contact_us', 'search', 'column_array', 'sorting_array', 'fromDate', 'toDate'));
	}
	
	public function Contact_form_data(Request $request){
	    $contact_us = Contact_us::where('page_id', 7)->orderBy('id', 'DESC')->get(); 
	    return view('admin.enquiry.contact_new_form', compact('contact_us'));
	}
	
	public function blog_form_data(Request $request){
	    $contact_us = Contact_us::where('page_id', 30)->orderBy('id', 'DESC')->get(); 
	    return view('admin.enquiry.blog_form', compact('contact_us'));
	}
	
	public function body_form_data(Request $request){ 
	    $contact_us = Contact_us::where('form_identity', 'body_form')->whereNotIn('page_id', [7, 30])
                      ->orderBy('id', 'DESC')
                      ->get(); 
	    return view('admin.enquiry.body_form', compact('contact_us'));
	}
	
	public function slider_form_data(Request $request){ 
	    
	    $contact_us = Contact_us::where('form_identity', 'slider_form')->whereNotIn('page_id', [7, 30])->orderBy('id', 'DESC')->get();  
	    return view('admin.enquiry.slider_form', compact('contact_us'));
	}
	
	public function sign_up(Request $request){
	    $contact_us = DB::table('clients')->orderBy('id', 'DESC')->get(); 
	    return view('admin.enquiry.sign_up', compact('contact_us'));
	}
	
	public function purchase_data(Request $request){
	    $contact_us = DB::table('client_address')->orderBy('id', 'DESC')->get(); 
	    return view('admin.enquiry.purchase_data', compact('contact_us'));
	}
	
	
    //  check box data delete form database using 
    public function getSessionIds()
    {
        $sessionIds = Session::get('selected_ids', []);
        return response()->json($sessionIds);
    }
    public function addToSession(Request $request)
    {
        $ids = $request->input('ids', []);
        $sessionIds = Session::get('selected_ids', []);
        $sessionIds = array_unique(array_merge($sessionIds, $ids));
        Session::put('selected_ids', $sessionIds);
    
        return response()->json(['message' => 'IDs added to session']);
    }
    
    public function removeFromSession(Request $request)
    {
        $ids = $request->input('ids', []);
        $sessionIds = Session::get('selected_ids', []);
        $sessionIds = array_diff($sessionIds, $ids);
        Session::put('selected_ids', $sessionIds);
    
        return response()->json(['message' => 'IDs removed from session']);
    }
    
    public function deleteFromDatabase()
    {
        $ids = Session::get('selected_ids', []);
        Contact_us::whereIn('id', $ids)->delete();
        Session::forget('selected_ids');
    
        return response()->json(['message' => 'Selected records deleted from database']);
    }
    // select ids of guest
    public function getSessionIdsGuest()
    {
        $sessionIds = Session::get('guest_selected_ids', []);
        return response()->json($sessionIds);
    }
    public function addToSessionGuest(Request $request)
    {
        $ids = $request->input('ids', []);
        $sessionIds = Session::get('guest_selected_ids', []);
        $sessionIds = array_unique(array_merge($sessionIds, $ids));
        Session::put('guest_selected_ids', $sessionIds);
    
        return response()->json(['message' => 'IDs added to session']);
    }
    
    public function removeFromSessionGuest(Request $request)
    {
        $ids = $request->input('ids', []); 
        $sessionIds = Session::get('guest_selected_ids', []);
        $sessionIds = array_diff($sessionIds, $ids);
        Session::put('guest_selected_ids', $sessionIds);
    
        return response()->json(['message' => 'IDs removed from session']);
    }
    public function deleteFromDatabaseGuest()
    {
        $ids = Session::get('guest_selected_ids', []);
        GuestPost::whereIn('id', $ids)->delete();
        Session::forget('guest_selected_ids');
    
        return response()->json(['message' => 'Selected records deleted from database']);
    }
    // select ids of guest
    
    
    // select ids of client
    public function getSessionIdsClient()
    {
        $sessionIds = Session::get('client_selected_ids', []);
        return response()->json($sessionIds);
    }
    public function addToSessionClient(Request $request)
    {
        $ids = $request->input('ids', []);
        $sessionIds = Session::get('client_selected_ids', []);
        $sessionIds = array_unique(array_merge($sessionIds, $ids));
        Session::put('client_selected_ids', $sessionIds);
    
        return response()->json(['message' => 'IDs added to session']);
    }
    
    public function removeFromSessionClient(Request $request)
    {
        $ids = $request->input('ids', []); 
        $sessionIds = Session::get('client_selected_ids', []);
        $sessionIds = array_diff($sessionIds, $ids);
        Session::put('client_selected_ids', $sessionIds);
    
        return response()->json(['message' => 'IDs removed from session']);
    }
    public function deleteFromDatabaseClient()
    {
        $ids = Session::get('client_selected_ids', []);
        DB::table('clients')->whereIn('id', $ids)->delete();
        Session::forget('client_selected_ids');
    
        return response()->json(['message' => 'Selected records deleted from database']);
    }
    // select ids of client
    //  check box data delete form database using 	 
	
	 
	
	public function guestFormData()
	{
		$sorting_array = array();
	
		$orderby = Request()->orderby;
		$order = Request()->order;
	
		if (!$orderby && !$order) {
			$orderby = 'created_at';
			$order = 'asc';
		}
	
		$column_array = array('id' => 'Id', 'Post Title' => 'post_title', 'Author Name' => 'author_name', 'Email Address' => 'email_address', 'Content' => 'post_content');
	
		$search = Request()->search;
		$from = Request()->from; // Get the 'from' date value
		$to = Request()->to; // Get the 'to' date value
		$where = "id != 0";
	
		if ($search) {
			$where .= " and (";
			$i = 1;
			foreach ($column_array as $key => $val) {
				if ($i > 1) {
					$where .= " or ";
				}
	
				$where .= $key . " like '%" . $search . "%'";
				$i++;
			}
			$where .= ")";
		}
	
		if ($from && $to) {
			// Convert 'from' and 'to' dates to the database format (YYYY-MM-DD)
			$fromDate = date('Y-m-d', strtotime($from));
			$toDate = date('Y-m-d', strtotime($to));
			$where .= " and DATE(created_at) >= '" . $fromDate . "' and DATE(created_at) <= '" . $toDate . "'";
		}
	
		$item_display_per_page = config('admin.pagination');
		$guestPost = GuestPost::select('*')
			->whereRaw($where)
			->orderBy($orderby, $order)
			->paginate($item_display_per_page);
	
		foreach ($column_array as $key => $value) {
			$sorting_class = 'sorting';
			$sorting_url_orderby = $key;
			$sorting_url_order = 'asc';
	
			if ($orderby == $key) {
				$sorting_class = ($order == 'asc' ? 'sorting_asc' : 'sorting_desc');
	
				$sorting_url_order = ($order == 'asc' ? 'desc' : 'asc');
			}
	
			$sorting_url = 'contact?' . ($search != "" ? 'search=' . $search . '&' : '') . 'orderby=' . $sorting_url_orderby . '&order=' . $sorting_url_order;
	
			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}
	
		// Check if $fromDate and $toDate are empty, and set them to null if they are
		$fromDate = $fromDate ?? null;
		$toDate = $toDate ?? null;
	
		return view('admin.guest_post.guest_form', compact('guestPost', 'search', 'column_array', 'sorting_array', 'fromDate', 'toDate'));
	}
	


	public function pricing()
	{
		$sorting_array = array();

		$orderby = Request()->orderby;
		$order = Request()->order;

		if(!$orderby && !$order)
		{
			$orderby = 'menu_order';
			$order = 'asc';
		}

		$column_array = array('id' => 'Id', 'page_name' => 'Title', 'status' => 'Status', 'created_at' => 'Created At');
		$search = Request()->search;
		$where = "posttype='pricing' ";

		if($search)
		{
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
		$pages = Page::select('pages.*')->whereRaw($where)->orderBy($orderby, $order)->paginate($item_display_per_page);

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

			$sorting_url = 'pricing?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.pricing.index', compact('pages','column_array','sorting_array','search'));
	}

	/* Admin Add Page Get*/
	public function pricing_add()
	{

		// $categories = Category::where('status',1)->orderBy('rank','asc')->get();, compact('categories')
		$data['redirect_page'] = DB::table('pages')
		->select('id','page_name')
		->get();
		$data['all_pages'] = Page::where('posttype','pricing')->orderBy('menu_order','asc')->get();
		return view('admin.pricing.add', $data);
	}

	/* Admin Update Page Get*/
	public function pricing_edit($id)
	{
		$data['all_pages'] = Page::where('posttype','pricing')->where('id', '!=',$id)->orderBy('menu_order','asc')->get();
		$data['page'] = Page::where('id',$id)->where('posttype','pricing')->first();

		if (!$data['page'])
		{
			return redirect()->back()->with('error', 'Opps!! sorry!! problem occurred.Please try again!');
		}
		$data['redirect_page'] = DB::table('pages')
		->select('id','page_name')
		->where('id', '!=', $id)
		->get();

		$data['package_type'] = PageExtra::where('page_id',$id)->where('type', '4')->orderBy('id', 'asc')->get();

		$data['page_extra'] = PageExtra::where('page_id',$id)->orderBy('type', 'asc')->orderBy('rank', 'asc')->get();
		$data['categories'] = Category::where('status',1)->orderBy('rank','asc')->get();

		return view('admin.pricing.edit', $data);
	}

	public function exportTableData($type)
	{
	    $page_id = Page::whereIn('posttype', array('service', 'pricing', 'city-business-service', 'business-service', ''))->get(); 
	    $id = [];
	    foreach($page_id as $key => $val){
	        $id[] = $val->id;
	    } 
		$contactUsData = Contact_us::select('*');
		    if ($type == 'slider') {
                $contactUsData->whereIn('page_id', $id)->where('form_identity', 'slider_form');
            } elseif ($type == 'body') {
                $contactUsData->whereIn('page_id', $id)->where('form_identity', 'body_form');
            } elseif ($type == 'blog') {
                $contactUsData->where('page_id', 28);
            } elseif ($type == 'contact_page') {
                $contactUsData->where('page_id', 7);
            }
		    
		   $data_form =  $contactUsData->get();  
	$filename = "table_data.csv";
	$file = fopen($filename, 'w');

	// Add column headers to the CSV file
	$headers = [
		'Record No.', 'Source', 'Name', 'Last Name', 'Email', 'Phone', 'Location',
		'Service', 'Budget', 'Website Url', 'Skype', 'Whatsapp', 'Message', 'Date'
	];
	fputcsv($file, $headers);

	// Add data rows to the CSV file
	$i = 1;
	foreach ($data_form as $row) {

		$page = DB::table('pages')->select('page_name')->where('id', $row->page_id)->first();
		$page_name = $page->page_name ?? '';
		
		$service = DB::table('pages')->where('id', $row->service_name)->whereIn('posttype', ['service', 'pricing'])->first();
		$service_name = $service ? $service->page_name : '';
		$convertedDate = date_convert($row->created_at,8);
		$rowData = [
			$i, $page_name, $row->first_name, $row->last_name, $row->email, $row->phone,
			$row->location, $service_name, $row->budget, $row->website, $row->skype,
			$row->whatsapp, $row->message, $convertedDate
		];
		$i++;
		fputcsv($file, $rowData);

	}
	

	fclose($file);

	// Set headers for file download
	header('Content-Type: application/csv');
	header('Content-Disposition: attachment; filename="' . $filename . '";');

	// Read the file and output it directly to the browser
	readfile($filename);
	exit;
	}
	
	public function exportTableDataClient($type)
	{
	    
		$contactUsData = DB::table('clients')->select('*'); 
		    
		   $data_form =  $contactUsData->get();  
	$filename = "table_data.csv";
	$file = fopen($filename, 'w');

	// Add column headers to the CSV file
	$headers = [
		'Record No.', 'Source', 'Name', 'Last Name', 'Email', 'Phone', 'Location',
		'Service', 'Budget', 'Website Url', 'Skype', 'Whatsapp', 'Message', 'Date'
	];
	fputcsv($file, $headers);

	// Add data rows to the CSV file
	$i = 1;
	foreach ($data_form as $row) {

		$page = DB::table('pages')->select('page_name')->where('id', $row->page_id)->first();
		$page_name = $page->page_name ?? '';
		
		$service = DB::table('pages')->where('id', $row->service_name)->whereIn('posttype', ['service', 'pricing'])->first();
		$service_name = $service ? $service->page_name : '';
		$convertedDate = date_convert($row->created_at,8);
		$rowData = [
			$i, $page_name, $row->first_name, $row->last_name, $row->email, $row->phone,
			$row->location, $service_name, $row->budget, $row->website, $row->skype,
			$row->whatsapp, $row->message, $convertedDate
		];
		$i++;
		fputcsv($file, $rowData);

	}
	

	fclose($file);

	// Set headers for file download
	header('Content-Type: application/csv');
	header('Content-Disposition: attachment; filename="' . $filename . '";');

	// Read the file and output it directly to the browser
	readfile($filename);
	exit;
	}
	
	public function importData(Request $request)
	{
		$file = $request->file('file');
		// Validate the uploaded file
		$request->validate([
            'file' => 'required|mimes:csv,txt',
        ]);
	
		// Import the data from the Excel file
		Excel::import(new ContactUsImport, $file);
		
	
		// Redirect or return a response after the import is completed
		return redirect()->back()->with('success', 'Data imported successfully.');
	}

	public function sampleFile()
	{
		$filePath = 'sample_file.csv'; // Update the file path according to your sample file's location
		if (file_exists($filePath) && in_array(pathinfo($filePath, PATHINFO_EXTENSION), ['xlsx', 'xls', 'csv', 'pdf'])) {
			// Allow downloading of files with xlsx, xls, csv, and pdf extensions
			return Response::download($filePath, 'sample_file.csv');
		}
		abort(404, 'Sample file not found');
	}

	public function mediaLibrary(Request $request)
	{
        $method = $request->method();
        if ($request->isMethod('post')) {
            $imageName = $request->input('searchImage');
	
			if ($imageName) {
				$directory = public_path('uploads');
				$imagePath = $directory . DIRECTORY_SEPARATOR . $imageName ;
				if (File::exists($imagePath)) {
					return view('admin.media_library.index', compact('imageName'));
				}

			}
        }
		
		return view('admin.media_library.index',['imageName' => []]);
	}

	public function addMediaLibrary(){
		return view('admin.media_library.add_media');
	}

	public function insertMediaLibrary(Request $request){
		$data = $request->all();
		$rules = array();
		if($request->hasfile('image'))
		{	
				$rules['image'] = 'mimes:webp|max:2048';
		}

		if($request->hasfile('icon_image'))
		{	
				$rules['icon_image'] = 'mimes:webp|max:2048';
		}

		if($request->hasfile('pdf'))
		{	
				$rules['pdf'] = 'mimes:pdf|max:2048';
		}

		$validator = Validator::make($data , $rules);
		if ($validator->fails())
		{
			return Redirect::back()->withErrors($validator)->withInput(); 
		}
		else
		{
			try {
				$obj = new MediaLibrary();
				if($request->hasfile('image'))
				{	
						$image = $request->file('image');
						$filename = $image->getClientOriginalName();
						$extension = $image->getClientOriginalExtension();
										if($extension == "webp"){
						$filename = str_replace("&", "and", $filename);
						$filename = str_replace(" ", "_", $filename);
						$filename = time().$filename;
						$image->move(public_path().'/uploads/', $filename);
						$obj->image = $filename;
						}else{
							return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
						}
				}
				if($request->hasfile('icon_image'))
				{	
						$icon_image = $request->file('icon_image');
						$filename = $icon_image->getClientOriginalName();
						$extension = $icon_image->getClientOriginalExtension();
										if($extension == "webp"){
						$filename = str_replace("&", "and", $filename);
						$filename = str_replace(" ", "_", $filename);
						$filename = time().$filename;
						$icon_image->move(public_path().'/uploads/', $filename);
						$obj->icon_image = $filename;
						}else{
							return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
						}
				}
				if($request->hasfile('pdf'))
				{	
						$pdf = $request->file('pdf');
						$filename = $pdf->getClientOriginalName();
						$extension = $pdf->getClientOriginalExtension();
										if($extension == "pdf"){
						$filename = str_replace("&", "and", $filename);
						$filename = str_replace(" ", "_", $filename);
						$filename = time().$filename;
						$pdf->move(public_path().'/uploads/', $filename);
						$obj->pdf = $filename;
						}else{
							return Redirect::back()->withErrors(['default' => "Pdf must be .pdf, please check extension"])->withInput();
						}
				}
				$obj->save();

				return redirect()->back()->with('success', 'Media Library Image has been added successfully.');

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}

		}
	}

	public function deleteMediaLibrary($id){
		$obj = MediaLibrary::find($id); 
		if($obj->image!='' && file_exists(public_path().'/uploads/'.$obj->image))
		{
			unlink(public_path().'/uploads/'.$obj->image);
		}
		MediaLibrary::destroy($id);
		return redirect()->back()->with('success', 'Image has been deleted successfully.');
	}

	public function cityService()
	{
		$sorting_array = array();

		$orderby = Request()->orderby;
		$order = Request()->order;

		if(!$orderby && !$order)
		{
			$orderby = 'menu_order';
			$order = 'asc';
		}

		$column_array = array('id' => 'Id', 'page_name' => 'Title', 'status' => 'Status', 'created_at' => 'Created At');
		$search = Request()->search;
		$where = "posttype='city-service' ";

		if($search)
		{
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
		$pages = Page::select('pages.*')->whereRaw($where)->orderBy($orderby, $order)->paginate($item_display_per_page);

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

			$sorting_url = 'service?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.dynamic_city.index', compact('pages','column_array','sorting_array','search'));
	}

	/* Admin Add Page Get*/
	public function cityServiceAdd()
	{

		// $categories = Category::where('status',1)->orderBy('rank','asc')->get();, compact('categories')
		$data['redirect_page'] = DB::table('pages')
		->select('id','page_name')
		->get();
		$data['all_pages'] = Page::where('posttype','service')->orderBy('menu_order','asc')->get();
		$data['price_widget'] = DB::table('digital_service_price_widget')
            ->select('service_type')
            ->groupBy('service_type')
            ->get();
		return view('admin.dynamic_city.add', $data);
	}

	/* Admin Update Page Get*/
	public function cityServiceEdit($id)
	{

		$data['all_pages'] = Page::where('posttype','service')->where('id', '!=',$id)->orderBy('menu_order','asc')->get();
		$data['page'] = Page::where('id',$id)->where('posttype','city-service')->first();

		if (!$data['page'])
		{
			return redirect()->back()->with('error', 'Opps!! sorry!! problem occurred.Please try again!');
		}
		$data['redirect_page'] = DB::table('pages')
		->select('id','page_name')
		->where('id', '!=', $id)
		->get();

		$data['page_extra'] = PageExtra::where('page_id',$id)->orderBy('type', 'asc')->orderBy('rank', 'asc')->get();
		$data['categories'] = Category::where('status',1)->orderBy('rank','asc')->get();
        $data['price_widget'] = DB::table('digital_service_price_widget')
            ->select('service_type')
            ->groupBy('service_type')
            ->get();
        
		return view('admin.dynamic_city.edit', $data);
	}

	public function dynamicCityServiceInsert(Request $request)
	{
		// echo 1111;exit;
		$id = $request->id;

		$rules = array(
			'page_name' => 'required|string|max:255',
			// 'slug' => 'required|string|max:255|unique:pages',
			// 'display_in' => 'required|integer',
			// 'parent_id' => 'required|integer',
		);
		if($request->hasfile('menu_image'))
		{
			$rules['menu_image'] = 'mimes:webp|max:2048';
		}
		if($request->hasfile('image2'))
		{
			$rules['image2'] = 'mimes:webp|max:2048';
		}

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return redirect()->back()->withErrors($validator)->withInput($request->all());
		}
		else
		{

			try {
                // $slug             	= $request->slug;
                $page_name        	= $request->page_name;
                $price_widget        	= $request->price_widget;
                $page_title       	= $request->page_title;
                $bannertext       	= $request->bannertext;
                $body             	= $request->body;
                $posttype         	= $request->posttype;
                $meta_title       	= $request->meta_title;
                $meta_keyword     	= $request->meta_keyword;
                $meta_description 	= $request->meta_description;
                $meta_tag 			= $request->meta_tag;
                $service_parent_id  = $request->service_parent_id>0?$request->service_parent_id:0;
                $display_in       	= $request->display_in>0?$request->display_in:0;
                $menu_order       	= $request->menu_order>0?$request->menu_order:0;
                $service_order    	= $request->service_order>0?$request->service_order:0;
                $menu_link        	= $request->menu_link;
                $page_template    	= $request->page_template>0?$request->page_template:0;
                $status           	= $request->status=='0'?0:1;
                $author_name      	= $request->author_name?$request->author_name:$page_title;
                $author_desg      	= $request->author_desg;
                $author_url      	= $request->author_url;

				$update_array = array('price_widget'=>$price_widget,'page_name' => $page_name, 'page_title' => $page_title, 'bannertext' => $bannertext, 'body' => $body, 'posttype' => $posttype, 'meta_title' => $meta_title, 'meta_keyword' => $meta_keyword, 'meta_description' => $meta_description, 'display_in' => $display_in, 'menu_order' => $menu_order,'service_order' => $service_order, 'status' => $status, 'service_parent_id' => $service_parent_id,'page_title' => $author_name,'author_url' => $author_url,'bannertext' => $author_desg);//, 'menu_link' => $menu_link

				if($request->hasfile('bannerimage'))
				{
					$bannerimage = $request->file('bannerimage');
					$filename = $bannerimage->getClientOriginalName();
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$bannerimage->move(public_path().'/uploads/', $filename);
					$update_array['bannerimage'] = $filename;
				}
				/*if($request->hasfile('menu_image'))
				{
					$menu_image = $request->file('menu_image');
					$filename = $menu_image->getClientOriginalName();
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$menu_image->move(public_path().'/uploads/', $filename);
					$update_array['menu_image'] = $filename;
				}*/
				if($request->hasfile('image2'))
				{
					$image2 = $request->file('image2');
					$filename = $image2->getClientOriginalName();
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$image2->move(public_path().'/uploads/', $filename);
					$update_array['image2'] = $filename;
				}

				// if ($slug) {
				// 	$update_array['slug'] = $slug;
				// }

				$update_array['page_template'] = $page_template;
				$page_id = DB::table('pages')->insertGetId($update_array);
				$page = Page::where('id',$page_id)->first();
				if ($page->posttype=='blog') {
					$page->category()->attach($request->category_id);
				}
				// print_r($page_id);exit();

				if ( isset($request->section_type) && count($request->section_type)>0) {
						$section_type = $request->section_type;
					for ($i=0; $i < count($request->section_type); $i++) {
						$cur_section_type = $section_type[$i];
						if ($cur_section_type=='1') {
							$type=1;
						}else{
							$type=$i + 1;
						}

						$max_rank = get_fields_value_where('pages_extra',"page_id='".$page_id."' and type='".$type."'",'rank','desc');
						$rank = ($max_rank && count($max_rank)>0) ? $max_rank[0]->rank + 1 : 1 ;

						$a ='section_new_t';
						$section_new_t = $request->$a;
						$b ='section_new_st';
						$section_new_st = $request->$b;
						$c ='section_new_c';
						$section_new_c = $request->$c;
						$d ='section_new_btn_text';
						$section_new_btn_text = $request->$d;
						$e ='section_new_btn_url';
						$section_new_btn_url = $request->$e;

						$section_new_img = $request->section_new_img;
						$section_new_img2 = $request->section_new_img2;

						@$title = $section_new_t[$i];
						@$sub_title = $section_new_st[$i];
						@$body = $section_new_c[$i];
						@$btn_text = $section_new_btn_text[$i];
						@$btn_url = $section_new_btn_url[$i];
						$image = '';
						$image2 = '';

						$obj = new PageExtra;
						$obj->page_id = $page_id;
						$obj->type = $type;
						$obj->section_type = $cur_section_type;
						if ( isset($section_new_img) && count($section_new_img)>0) {
							if($request->hasfile('section_new_img'))
							{
								$cur_img_count = 0;
								foreach($request->file('section_new_img') as $file){
									if ($cur_img_count==$i) {
										$filename = $file->getClientOriginalName();
										$extension = $file->getClientOriginalExtension();
										if($extension == "webp"){
										$filename = create_seo_link($filename);
                                		$filename = time()."_".$filename;
										$file->move(public_path().'/uploads/', $filename);
										$image = $filename;
										}else{
											return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
										}
									}
									$cur_img_count++;
								}
							}
						}
						if ( isset($section_new_img2) && count($section_new_img2)>0) {
							if($request->hasfile('section_new_img2'))
							{
								$cur_img_count = 0;
								foreach($request->file('section_new_img2') as $file){
									if ($cur_img_count==$i) {
										$filename = $file->getClientOriginalName();
										$extension = $file->getClientOriginalExtension();
										if($extension == "webp"){
										$filename = create_seo_link($filename);
                                		$filename = time()."_".$filename;
										$file->move(public_path().'/uploads/', $filename);
										$image2 = $filename;
										}else{
											return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
										}
									}
									$cur_img_count++;
								}
							}
						}/**/

						$obj->title = $title;
						$obj->sub_title = $sub_title;
						$obj->body = $body;
						$obj->btn_text = $btn_text;
						$obj->btn_url = $btn_url;
						$obj->image = $image;
						$obj->image2 = $image2;
						$obj->rank = $rank;
						$obj->save();
					}
				}

				// if ($page->posttype=='service') {
				// 	$extra = PageExtra::where(['page_id'=> Service_Page_ID])->get();
				// 	// echo "<pre>";
				// // print_r($extra);exit;
				// 	foreach($extra as $val){
				// 		$obj = new PageExtra;
				// 		$obj->page_id = $page_id;
				// 		$obj->type = $val->type;
				// 		$obj->section_type = $val->section_type;
				// 		$obj->title = $val->title;
				// 		$obj->image2 = $val->image2;
				// 		$obj->sub_title = $val->sub_title;
				// 		$obj->btn_text = $val->btn_text;
				// 		$obj->btn_url = $val->btn_url;
				// 		$obj->image = $val->image;
				// 		$obj->body = $val->body;
				// 		$obj->rank = $val->rank;
				// 		$obj->status = $val->status;
				// 		$obj->save();
				// 	}
				// }

				//return redirect()->back()->with('success', true);
				return Redirect::to(Admin_Prefix.$posttype.'/edit/'.$page_id)->with('success', 'Page has been added successfully.');

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}

		}
	}

	public function dynamicCityServiceUpdate(Request $request)
	{
	    
		$id = $request->id;
		$page_extra = PageExtra::where('page_id',$id)->orderBy('type', 'asc')->get();//where('type', '!=', '1')->

		// $slug = $request->slug;
		$page_name = $request->page_name;
		$price_widget        	= $request->price_widget;
		$page_title = $request->page_title;
		$bannertext = $request->bannertext;
		$body = $request->body;
		$posttype = $request->posttype;
		$meta_tag = $request->meta_tag;
		// $redirect_to = $request->redirect_to;
		$meta_title = $request->meta_title;
		$meta_keyword = $request->meta_keyword;
		$meta_description = $request->meta_description;
		$service_parent_id = $request->service_parent_id>0?$request->service_parent_id:0;
		$display_in = $request->display_in>0?$request->display_in:0;
		$menu_order = $request->menu_order>0?$request->menu_order:0;
		$service_order = $request->service_order>0?$request->service_order:0;
		$menu_link = $request->menu_link;
		$page_template = $request->page_template>0?$request->page_template:0;
		$status = $request->status=='0'?0:1;
		$author_name      = $request->author_name?$request->author_name:$page_title;
		$author_desg = $request->author_desg;
		$author_url = $request->author_url;

		if ($id==1) {
			$status = 1;
		}
		if ($id==Category_Default_Page_ID) {
			$parent_id = 0;
		}

		$rules = array(
			'page_name' => 'required|string|max:255',
			// 'slug' => 'required|string|max:255|unique:pages,slug,'.$id,
			//'display_in' => 'required|integer',
			//'parent_id' => 'required|integer',
		);

		if($request->hasfile('bannerimage'))
		{
			$rules['bannerimage'] = 'mimes:webp|max:2048';
		}
		if($request->hasfile('menu_image'))
		{
			$rules['menu_image'] = 'mimes:webp|max:2048';
		}
		if($request->hasfile('image2'))
		{
			$rules['image2'] = 'mimes:webp|max:2048';
		}

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to(Admin_Prefix.$posttype.'/edit/'.$id)->withErrors($validator)->withInput();
		}
		else
		{
			foreach ($page_extra as $val) {
				$x ='section_title_'.$val->id;
				$page_extra_title = $request->$x;
				$y ='section_sub_title_'.$val->id;
				$page_extra_sub_title = $request->$y;
				$z ='section_body_'.$val->id;
				$page_extra_body = $request->$z;
				$a ='section_btn_text_'.$val->id;
				$page_extra_btn_text = $request->$a;
				$b ='section_btn_url_'.$val->id;
				$page_extra_btn_url = $request->$b;
				$c ='section_rank_'.$val->id;
				$page_extra_rank = $request->$c;

				$d ='section_video_url'.$val->id;
				$page_extra_video_url = $request->$d;

				$d ='section_fk_parent_id_'.$val->id;
				$page_extra_fk_parent_id = $request->$d;
				// echo "<pre>";
				// print_r($page_extra_fk_parent_id);exit;
				$page_extra_status = $request->{'section_status_'.$val->id};
				$page_extra_status = ($page_extra_status>0) ? 1 : 0 ;
				$update_array1 = array('title' => $page_extra_title,'body' => $page_extra_body,'sub_title' => $page_extra_sub_title,'btn_text' => $page_extra_btn_text,'btn_url' => $page_extra_btn_url,'blog_parent' => $page_extra_fk_parent_id,'video_url' => $page_extra_video_url);

				if ($page_extra_rank>0) {
					$update_array1['rank'] = $page_extra_rank;
				}
					$update_array1['status'] = $page_extra_status;

				if($request->hasfile('section_file_'.$val->id))
				{
					if($val->image!='' && file_exists(public_path().'/uploads/'.$val->image))
					{
						unlink(public_path().'/uploads/'.$val->image);
					}
					$file = $request->file('section_file_'.$val->id);
					$filename = $file->getClientOriginalName();
					$extension = $file->getClientOriginalExtension();
					if($extension =="webp"){
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$file->move(public_path().'/uploads/', $filename);
					$update_array1['image'] = $filename;
					}else{
						return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
					}
				}
				if($request->hasfile('section_video_img'.$val->id))
				{
					if($val->video_img!='' && file_exists(public_path().'/uploads/'.$val->video_img))
					{
						unlink(public_path().'/uploads/'.$val->video_img);
					}
					$file = $request->file('section_video_img'.$val->id);
					$filename = $file->getClientOriginalName();
					$extension = $file->getClientOriginalExtension();
					if($extension =="webp"){
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$file->move(public_path().'/uploads/', $filename);
					$update_array1['video_img'] = $filename;
					}else{
						return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
					}
				}
				// if($request->hasfile('section_video_file_'.$val->id))
				// {
				// 	if($val->video!='' && file_exists(public_path().'/uploads/'.$val->video))
				// 	{
				// 		unlink(public_path().'/uploads/'.$val->video);
				// 	}
				// 	$file = $request->file('section_video_file_'.$val->id);
				// 	$filename = $file->getClientOriginalName();
				// 	$extension = $file->getClientOriginalExtension();
				// 	if($extension =="mp4"){
				// 	$filename = create_seo_link($filename);
                //     $filename = time()."_".$filename;
				// 	$file->move(public_path().'/uploads/', $filename);
				// 	$update_array1['video'] = $filename;
				// 	}else{
				// 		return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
				// 	}
				// }


				if($request->hasfile('section_file2_'.$val->id))
				{
					if($val->image2!='' && file_exists(public_path().'/uploads/'.$val->image2))
					{
						unlink(public_path().'/uploads/'.$val->image2);
					}
					$file = $request->file('section_file2_'.$val->id);
					$filename = $file->getClientOriginalName();
					$extension = $file->getClientOriginalExtension();
					if($extension =="webp"){
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$file->move(public_path().'/uploads/', $filename);
					$update_array1['image2'] = $filename;
					}else{
						return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
					}
				}
				// echo "<pre>"; print_r($update_array1); die;
				DB::table('pages_extra')->where('id', $val->id)->update($update_array1);
			}

			$update_array = array('price_widget'=>$price_widget,'page_name' => $page_name, 'page_title' => $page_title, 'bannertext' => $bannertext, 'body' => $body, 'posttype' => $posttype, 'meta_title' => $meta_title, 'meta_keyword' => $meta_keyword,'meta_description' => $meta_description,'meta_tag' => $meta_tag, 'display_in' => $display_in, 'menu_order' => $menu_order,'service_order' => $service_order,'status' => $status,'page_title' => $author_name,'bannertext' => $author_desg,'author_url' => $author_url,'service_parent_id'=>$service_parent_id);//, 'menu_link' => $menu_link

				$update_array['page_template'] = $page_template;

			// if ($slug && $id!='1') {
			// 	$update_array['slug'] = $slug;
			// }

			if($request->hasfile('bannerimage'))
			{
				$page = Page::where('id',$id)->first();
				if($page->bannerimage!='' && file_exists(public_path().'/uploads/'.$page->bannerimage))
				{
					unlink(public_path().'/uploads/'.$page->bannerimage);
				}

				$bannerimage = $request->file('bannerimage');
				$filename = $bannerimage->getClientOriginalName();
				$extension = $bannerimage->getClientOriginalExtension();
				if($extension == "webp"){
				$filename = create_seo_link($filename);
                $filename = time()."_".$filename;
				$bannerimage->move(public_path().'/uploads/', $filename);
				$update_array['bannerimage'] = $filename;
				}else{
					return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
				}
			}
			if($request->hasfile('menu_image'))
			{
				$page = Page::where('id',$id)->first();
				if($page->menu_image!='' && file_exists(public_path().'/uploads/'.$page->menu_image))
				{
					unlink(public_path().'/uploads/'.$page->menu_image);
				}
				$menu_image = $request->file('menu_image');
				$filename = $menu_image->getClientOriginalName();
				$extension = $menu_image->getClientOriginalExtension();
				if($extension == "webp"){
				$filename = create_seo_link($filename);
                $filename = time()."_".$filename;
				$menu_image->move(public_path().'/uploads/', $filename);
				$update_array['menu_image'] = $filename;
				}else{
					return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
				}
			}
			if($request->hasfile('image2'))
			{
				$page = Page::where('id',$id)->first();
				if($page->image2!='' && file_exists(public_path().'/uploads/'.$page->image2))
				{
					unlink(public_path().'/uploads/'.$page->image2);
				}

				$image2 = $request->file('image2');
				$filename = $image2->getClientOriginalName();
				$extension = $image2->getClientOriginalExtension();
				if($extension == "webp"){
				$filename = create_seo_link($filename);
                $filename = time()."_".$filename;
				$image2->move(public_path().'/uploads/', $filename);
				$update_array['image2'] = $filename;
				}else{
					return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
				}
			}

			Page::where('id', $id)->update($update_array);
			$page = Page::where('id',$id)->first();
			if ($page->posttype=='blog') {
				//$page->category()->attach($request->category_id);
				$page->category()->sync($request->category_id);
			}
			//echo "<pre>";print_r($page);exit();

			$page_id = $id;

			if ( isset($request->section_type) && count($request->section_type)>0) {
					$section_type = $request->section_type;
					$type = $request->type;
				for ($i=0; $i < count($request->section_type); $i++) {
					$cur_section_type = $section_type[$i];
					$cur_type = $type[$i];
					if ($cur_type=='add') {
						$max_types = get_fields_value_where('pages_extra',"page_id='".$page_id."'",'type','desc');
						$max_type = ($max_types && count($max_types)>0) ? $max_types[0]->type + 1 : 1 ;

						if ($cur_section_type=='1') {
							$max_type=1;
						}
						$cur_type = $max_type;
					}
				  if ($cur_type>0 && $cur_section_type>0) {

					$max_rank = get_fields_value_where('pages_extra',"page_id='".$page_id."' and type='".$cur_type."'",'rank','desc');
					$rank = ($max_rank && count($max_rank)>0) ? $max_rank[0]->rank + 1 : 1 ;

					$a ='section_new_t';
					$section_new_t = $request->$a;
					$b ='section_new_st';
					$section_new_st = $request->$b;
					$c ='section_new_c';
					$section_new_c = $request->$c;
					$d ='section_new_btn_text';
					$section_new_btn_text = $request->$d;
					$e ='section_new_btn_url';
					$section_new_btn_url = $request->$e;
					$f ='section_new_cat';
					$section_new_cat = $request->$f;
					$g ='video_url';
					$section_video_url = $request->$g;

					$section_new_img = $request->section_new_img;
					$video_img = $request->video_img;
					$section_new_img2 = $request->section_new_img2;
					// $video_file = $request->video_file;

					@$title = $section_new_t[$i];
					@$sub_title = $section_new_st[$i];
					@$blog_parent = $section_new_cat[$i];
					@$video_url = $section_video_url[$i];
					@$body = $section_new_c[$i];
					@$btn_text = $section_new_btn_text[$i];
					@$btn_url = $section_new_btn_url[$i];
					$image = '';
					$image2 = '';

					$obj = new PageExtra;
					$obj->page_id = $page_id;
					$obj->type = $cur_type;
					$obj->section_type = $cur_section_type;
					// if ( isset($video_file) && count($video_file)>0) {
					// 	if($request->hasfile('video_file'))
					// 	{
					// 		$cur_img_count = 0;
					// 		foreach($request->file('video_file') as $file){
					// 			if ($cur_img_count==$i) {
					// 				$filename = $file->getClientOriginalName();
					// 				$extension = $file->getClientOriginalExtension();
					// 				if($extension == "mp4"){
					// 				$filename = create_seo_link($filename);
                    //             	$filename = time()."_".$filename;
					// 				$file->move(public_path().'/uploads/', $filename);
					// 				$video_file = $filename;
					// 				}else{
					// 					return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
					// 				}
					// 			}
					// 			$cur_img_count++;
					// 		}
					// 	}
					// }
					if ( isset($video_img) && count($video_img)>0) {
						if($request->hasfile('video_img'))
						{
							$cur_img_count = 0;
							foreach($request->file('video_img') as $file){
								if ($cur_img_count==$i) {
									$filename = $file->getClientOriginalName();
									$extension = $file->getClientOriginalExtension();
									if($extension == "webp"){
									$filename = create_seo_link($filename);
                                	$filename = time()."_".$filename;
									$file->move(public_path().'/uploads/', $filename);
									$video_img = $filename;
									}else{
										return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
									}
								}
								$cur_img_count++;
							}
						}
					}
					if ( isset($section_new_img) && count($section_new_img)>0) {
						if($request->hasfile('section_new_img'))
						{
							$cur_img_count = 0;
							foreach($request->file('section_new_img') as $file){
								if ($cur_img_count==$i) {
									$filename = $file->getClientOriginalName();
									$extension = $file->getClientOriginalExtension();
									if($extension == "webp"){
									$filename = create_seo_link($filename);
                                	$filename = time()."_".$filename;
									$file->move(public_path().'/uploads/', $filename);
									$image = $filename;
									}else{
										return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
									}
								}
								$cur_img_count++;
							}
						}
					}
					if ( isset($section_new_img2) && count($section_new_img2)>0) {
						if($request->hasfile('section_new_img2'))
						{
							$cur_img_count = 0;
							foreach($request->file('section_new_img2') as $file){
								if ($cur_img_count==$i) {
									$filename = $file->getClientOriginalName();
									$extension = $file->getClientOriginalExtension();
									if($extension == "webp"){
									$filename = create_seo_link($filename);
                                	$filename = time()."_".$filename;
									$file->move(public_path().'/uploads/', $filename);
									$image2 = $filename;
									}else{
										return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
									}
								}
								$cur_img_count++;
							}
						}
					}/**/

					$obj->title = $title;
					$obj->sub_title = $sub_title;
					$obj->blog_parent = $blog_parent;
					$obj->video_url = $video_url;
					$obj->body = $body;
					$obj->btn_text = $btn_text;
					$obj->btn_url = $btn_url;
					$obj->image = $image;
					// $obj->video = $video_file;
					$obj->video_img = $video_img;
					$obj->image2 = $image2;
					$obj->rank = $rank;
					$obj->save();

				  }
				}
			}
			return redirect()->back()->with('success', 'Page has been updated successfully.');
		}
	}
	public function businessService()
	{
		$sorting_array = array();

		$orderby = Request()->orderby;
		$order = Request()->order;

		if(!$orderby && !$order)
		{
			$orderby = 'menu_order';
			$order = 'asc';
		}

		$column_array = array('id' => 'Id', 'page_name' => 'Title', 'status' => 'Status', 'created_at' => 'Created At');
		$search = Request()->search;
		$where = "posttype='business-service' ";

		if($search)
		{
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
		$pages = Page::select('pages.*')->whereRaw($where)->orderBy($orderby, $order)->paginate($item_display_per_page);

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

			$sorting_url = 'service?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.dynamic_business.index', compact('pages','column_array','sorting_array','search'));
	}

	/* Admin Add Page Get*/
	public function businessServiceAdd()
	{

		// $categories = Category::where('status',1)->orderBy('rank','asc')->get();, compact('categories')
		$data['redirect_page'] = DB::table('pages')
		->select('id','page_name')
		->get();
		$data['all_pages'] = Page::where('posttype','service')->orderBy('menu_order','asc')->get();
		$data['price_widget'] = DB::table('digital_service_price_widget')
            ->select('service_type')
            ->groupBy('service_type')
            ->get();
		return view('admin.dynamic_business.add', $data);
	}

	/* Admin Update Page Get*/
	public function businessServiceEdit($id)
	{

		$data['all_pages'] = Page::where('posttype','service')->where('id', '!=',$id)->orderBy('menu_order','asc')->get();
		$data['page'] = Page::where('id',$id)->where('posttype','business-service')->first();

		if (!$data['page'])
		{
			return redirect()->back()->with('error', 'Opps!! sorry!! problem occurred.Please try again!');
		}
		$data['redirect_page'] = DB::table('pages')
		->select('id','page_name')
		->where('id', '!=', $id)
		->get();
        $data['price_widget'] = DB::table('digital_service_price_widget')
            ->select('service_type')
            ->groupBy('service_type')
            ->get();
		$data['page_extra'] = PageExtra::where('page_id',$id)->orderBy('type', 'asc')->orderBy('rank', 'asc')->get();
		$data['categories'] = Category::where('status',1)->orderBy('rank','asc')->get();

		return view('admin.dynamic_business.edit', $data);
	}

	public function dynamicBusinessServiceInsert(Request $request)
	{
		// echo 1111;exit;
		$id = $request->id;

		$rules = array(
			'page_name' => 'required|string|max:255',
			// 'slug' => 'required|string|max:255|unique:pages',
			// 'display_in' => 'required|integer',
			// 'parent_id' => 'required|integer',
		);
		if($request->hasfile('menu_image'))
		{
			$rules['menu_image'] = 'mimes:webp|max:2048';
		}
		if($request->hasfile('image2'))
		{
			$rules['image2'] = 'mimes:webp|max:2048';
		}

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return redirect()->back()->withErrors($validator)->withInput($request->all());
		}
		else
		{

			try {
                // $slug             	= $request->slug;
                $page_name        	= $request->page_name;
                $price_widget        	= $request->price_widget;
                $page_title       	= $request->page_title;
                $bannertext       	= $request->bannertext;
                $body             	= $request->body;
                $posttype         	= $request->posttype;
                $meta_title       	= $request->meta_title;
                $meta_keyword     	= $request->meta_keyword;
                $meta_description 	= $request->meta_description;
                $meta_tag 			= $request->meta_tag;
                $service_parent_id  = $request->service_parent_id>0?$request->service_parent_id:0;
                $display_in       	= $request->display_in>0?$request->display_in:0;
                $menu_order       	= $request->menu_order>0?$request->menu_order:0;
                $service_order    	= $request->service_order>0?$request->service_order:0;
                $menu_link        	= $request->menu_link;
                $page_template    	= $request->page_template>0?$request->page_template:0;
                $status           	= $request->status=='0'?0:1;
                $author_name      	= $request->author_name?$request->author_name:$page_title;
                $author_desg      	= $request->author_desg;
                $author_url      	= $request->author_url;

				$update_array = array('price_widget'=>$price_widget, 'page_name' => $page_name, 'page_title' => $page_title, 'bannertext' => $bannertext, 'body' => $body, 'posttype' => $posttype, 'meta_title' => $meta_title, 'meta_keyword' => $meta_keyword, 'meta_description' => $meta_description, 'display_in' => $display_in, 'menu_order' => $menu_order,'service_order' => $service_order, 'status' => $status, 'service_parent_id' => $service_parent_id,'page_title' => $author_name,'author_url' => $author_url,'bannertext' => $author_desg);//, 'menu_link' => $menu_link

				if($request->hasfile('bannerimage'))
				{
					$bannerimage = $request->file('bannerimage');
					$filename = $bannerimage->getClientOriginalName();
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$bannerimage->move(public_path().'/uploads/', $filename);
					$update_array['bannerimage'] = $filename;
				}
				/*if($request->hasfile('menu_image'))
				{
					$menu_image = $request->file('menu_image');
					$filename = $menu_image->getClientOriginalName();
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$menu_image->move(public_path().'/uploads/', $filename);
					$update_array['menu_image'] = $filename;
				}*/
				if($request->hasfile('image2'))
				{
					$image2 = $request->file('image2');
					$filename = $image2->getClientOriginalName();
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$image2->move(public_path().'/uploads/', $filename);
					$update_array['image2'] = $filename;
				}

				// if ($slug) {
				// 	$update_array['slug'] = $slug;
				// }

				$update_array['page_template'] = $page_template;
				$page_id = DB::table('pages')->insertGetId($update_array);
				$page = Page::where('id',$page_id)->first();
				if ($page->posttype=='blog') {
					$page->category()->attach($request->category_id);
				}
				// print_r($page_id);exit();

				if ( isset($request->section_type) && count($request->section_type)>0) {
						$section_type = $request->section_type;
					for ($i=0; $i < count($request->section_type); $i++) {
						$cur_section_type = $section_type[$i];
						if ($cur_section_type=='1') {
							$type=1;
						}else{
							$type=$i + 1;
						}

						$max_rank = get_fields_value_where('pages_extra',"page_id='".$page_id."' and type='".$type."'",'rank','desc');
						$rank = ($max_rank && count($max_rank)>0) ? $max_rank[0]->rank + 1 : 1 ;

						$a ='section_new_t';
						$section_new_t = $request->$a;
						$b ='section_new_st';
						$section_new_st = $request->$b;
						$c ='section_new_c';
						$section_new_c = $request->$c;
						$d ='section_new_btn_text';
						$section_new_btn_text = $request->$d;
						$e ='section_new_btn_url';
						$section_new_btn_url = $request->$e;

						$section_new_img = $request->section_new_img;
						$section_new_img2 = $request->section_new_img2;

						@$title = $section_new_t[$i];
						@$sub_title = $section_new_st[$i];
						@$body = $section_new_c[$i];
						@$btn_text = $section_new_btn_text[$i];
						@$btn_url = $section_new_btn_url[$i];
						$image = '';
						$image2 = '';

						$obj = new PageExtra;
						$obj->page_id = $page_id;
						$obj->type = $type;
						$obj->section_type = $cur_section_type;
						if ( isset($section_new_img) && count($section_new_img)>0) {
							if($request->hasfile('section_new_img'))
							{
								$cur_img_count = 0;
								foreach($request->file('section_new_img') as $file){
									if ($cur_img_count==$i) {
										$filename = $file->getClientOriginalName();
										$extension = $file->getClientOriginalExtension();
										if($extension == "webp"){
										$filename = create_seo_link($filename);
                                		$filename = time()."_".$filename;
										$file->move(public_path().'/uploads/', $filename);
										$image = $filename;
										}else{
											return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
										}
									}
									$cur_img_count++;
								}
							}
						}
						if ( isset($section_new_img2) && count($section_new_img2)>0) {
							if($request->hasfile('section_new_img2'))
							{
								$cur_img_count = 0;
								foreach($request->file('section_new_img2') as $file){
									if ($cur_img_count==$i) {
										$filename = $file->getClientOriginalName();
										$extension = $file->getClientOriginalExtension();
										if($extension == "webp"){
										$filename = create_seo_link($filename);
                                		$filename = time()."_".$filename;
										$file->move(public_path().'/uploads/', $filename);
										$image2 = $filename;
										}else{
											return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
										}
									}
									$cur_img_count++;
								}
							}
						}/**/

						$obj->title = $title;
						$obj->sub_title = $sub_title;
						$obj->body = $body;
						$obj->btn_text = $btn_text;
						$obj->btn_url = $btn_url;
						$obj->image = $image;
						$obj->image2 = $image2;
						$obj->rank = $rank;
						$obj->save();
					}
				}

				// if ($page->posttype=='service') {
				// 	$extra = PageExtra::where(['page_id'=> Service_Page_ID])->get();
				// 	// echo "<pre>";
				// // print_r($extra);exit;
				// 	foreach($extra as $val){
				// 		$obj = new PageExtra;
				// 		$obj->page_id = $page_id;
				// 		$obj->type = $val->type;
				// 		$obj->section_type = $val->section_type;
				// 		$obj->title = $val->title;
				// 		$obj->image2 = $val->image2;
				// 		$obj->sub_title = $val->sub_title;
				// 		$obj->btn_text = $val->btn_text;
				// 		$obj->btn_url = $val->btn_url;
				// 		$obj->image = $val->image;
				// 		$obj->body = $val->body;
				// 		$obj->rank = $val->rank;
				// 		$obj->status = $val->status;
				// 		$obj->save();
				// 	}
				// }

				//return redirect()->back()->with('success', true);
				return Redirect::to(Admin_Prefix.$posttype.'/edit/'.$page_id)->with('success', 'Page has been added successfully.');

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}

		}
	}

	public function dynamicBusinessServiceUpdate(Request $request)
	{
		$id = $request->id;
		$page_extra = PageExtra::where('page_id',$id)->orderBy('type', 'asc')->get();//where('type', '!=', '1')->

		// $slug = $request->slug;
		$page_name = $request->page_name;
		$price_widget        	= $request->price_widget;
		$page_title = $request->page_title;
		$bannertext = $request->bannertext;
		$body = $request->body;
		$posttype = $request->posttype;
		$meta_tag = $request->meta_tag;
		// $redirect_to = $request->redirect_to;
		$meta_title = $request->meta_title;
		$meta_keyword = $request->meta_keyword;
		$meta_description = $request->meta_description;
		$service_parent_id = $request->service_parent_id>0?$request->service_parent_id:0;
		$display_in = $request->display_in>0?$request->display_in:0;
		$menu_order = $request->menu_order>0?$request->menu_order:0;
		$service_order = $request->service_order>0?$request->service_order:0;
		$menu_link = $request->menu_link;
		$page_template = $request->page_template>0?$request->page_template:0;
		$status = $request->status=='0'?0:1;
		$author_name      = $request->author_name?$request->author_name:$page_title;
		$author_desg = $request->author_desg;
		$author_url = $request->author_url;

		if ($id==1) {
			$status = 1;
		}
		if ($id==Category_Default_Page_ID) {
			$parent_id = 0;
		}

		$rules = array(
			'page_name' => 'required|string|max:255',
			// 'slug' => 'required|string|max:255|unique:pages,slug,'.$id,
			//'display_in' => 'required|integer',
			//'parent_id' => 'required|integer',
		);

		if($request->hasfile('bannerimage'))
		{
			$rules['bannerimage'] = 'mimes:webp|max:2048';
		}
		if($request->hasfile('menu_image'))
		{
			$rules['menu_image'] = 'mimes:webp|max:2048';
		}
		if($request->hasfile('image2'))
		{
			$rules['image2'] = 'mimes:webp|max:2048';
		}

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to(Admin_Prefix.$posttype.'/edit/'.$id)->withErrors($validator)->withInput();
		}
		else
		{
			foreach ($page_extra as $val) {
				$x ='section_title_'.$val->id;
				$page_extra_title = $request->$x;
				$y ='section_sub_title_'.$val->id;
				$page_extra_sub_title = $request->$y;
				$z ='section_body_'.$val->id;
				$page_extra_body = $request->$z;
				$a ='section_btn_text_'.$val->id;
				$page_extra_btn_text = $request->$a;
				$b ='section_btn_url_'.$val->id;
				$page_extra_btn_url = $request->$b;
				$c ='section_rank_'.$val->id;
				$page_extra_rank = $request->$c;

				$d ='section_video_url'.$val->id;
				$page_extra_video_url = $request->$d;

				$d ='section_fk_parent_id_'.$val->id;
				$page_extra_fk_parent_id = $request->$d;
				// echo "<pre>";
				// print_r($page_extra_fk_parent_id);exit;
				$page_extra_status = $request->{'section_status_'.$val->id};
				$page_extra_status = ($page_extra_status>0) ? 1 : 0 ;
				$update_array1 = array('title' => $page_extra_title,'body' => $page_extra_body,'sub_title' => $page_extra_sub_title,'btn_text' => $page_extra_btn_text,'btn_url' => $page_extra_btn_url,'blog_parent' => $page_extra_fk_parent_id,'video_url' => $page_extra_video_url);

				if ($page_extra_rank>0) {
					$update_array1['rank'] = $page_extra_rank;
				}
					$update_array1['status'] = $page_extra_status;

				if($request->hasfile('section_file_'.$val->id))
				{
					if($val->image!='' && file_exists(public_path().'/uploads/'.$val->image))
					{
						unlink(public_path().'/uploads/'.$val->image);
					}
					$file = $request->file('section_file_'.$val->id);
					$filename = $file->getClientOriginalName();
					$extension = $file->getClientOriginalExtension();
					if($extension =="webp"){
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$file->move(public_path().'/uploads/', $filename);
					$update_array1['image'] = $filename;
					}else{
						return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
					}
				}
				if($request->hasfile('section_video_img'.$val->id))
				{
					if($val->video_img!='' && file_exists(public_path().'/uploads/'.$val->video_img))
					{
						unlink(public_path().'/uploads/'.$val->video_img);
					}
					$file = $request->file('section_video_img'.$val->id);
					$filename = $file->getClientOriginalName();
					$extension = $file->getClientOriginalExtension();
					if($extension =="webp"){
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$file->move(public_path().'/uploads/', $filename);
					$update_array1['video_img'] = $filename;
					}else{
						return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
					}
				}
				// if($request->hasfile('section_video_file_'.$val->id))
				// {
				// 	if($val->video!='' && file_exists(public_path().'/uploads/'.$val->video))
				// 	{
				// 		unlink(public_path().'/uploads/'.$val->video);
				// 	}
				// 	$file = $request->file('section_video_file_'.$val->id);
				// 	$filename = $file->getClientOriginalName();
				// 	$extension = $file->getClientOriginalExtension();
				// 	if($extension =="mp4"){
				// 	$filename = create_seo_link($filename);
                //     $filename = time()."_".$filename;
				// 	$file->move(public_path().'/uploads/', $filename);
				// 	$update_array1['video'] = $filename;
				// 	}else{
				// 		return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
				// 	}
				// }


				if($request->hasfile('section_file2_'.$val->id))
				{
					if($val->image2!='' && file_exists(public_path().'/uploads/'.$val->image2))
					{
						unlink(public_path().'/uploads/'.$val->image2);
					}
					$file = $request->file('section_file2_'.$val->id);
					$filename = $file->getClientOriginalName();
					$extension = $file->getClientOriginalExtension();
					if($extension =="webp"){
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$file->move(public_path().'/uploads/', $filename);
					$update_array1['image2'] = $filename;
					}else{
						return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
					}
				}
				DB::table('pages_extra')->where('id', $val->id)->update($update_array1);
			}

			$update_array = array('price_widget'=>$price_widget,'page_name' => $page_name, 'page_title' => $page_title, 'bannertext' => $bannertext, 'body' => $body, 'posttype' => $posttype, 'meta_title' => $meta_title, 'meta_keyword' => $meta_keyword,'meta_description' => $meta_description,'meta_tag' => $meta_tag, 'display_in' => $display_in, 'menu_order' => $menu_order,'service_order' => $service_order,'status' => $status,'page_title' => $author_name,'bannertext' => $author_desg,'author_url' => $author_url,'service_parent_id'=>$service_parent_id);//, 'menu_link' => $menu_link

				$update_array['page_template'] = $page_template;

			// if ($slug && $id!='1') {
			// 	$update_array['slug'] = $slug;
			// }

			if($request->hasfile('bannerimage'))
			{
				$page = Page::where('id',$id)->first();
				if($page->bannerimage!='' && file_exists(public_path().'/uploads/'.$page->bannerimage))
				{
					unlink(public_path().'/uploads/'.$page->bannerimage);
				}

				$bannerimage = $request->file('bannerimage');
				$filename = $bannerimage->getClientOriginalName();
				$extension = $bannerimage->getClientOriginalExtension();
				if($extension == "webp"){
				$filename = create_seo_link($filename);
                $filename = time()."_".$filename;
				$bannerimage->move(public_path().'/uploads/', $filename);
				$update_array['bannerimage'] = $filename;
				}else{
					return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
				}
			}
			if($request->hasfile('menu_image'))
			{
				$page = Page::where('id',$id)->first();
				if($page->menu_image!='' && file_exists(public_path().'/uploads/'.$page->menu_image))
				{
					unlink(public_path().'/uploads/'.$page->menu_image);
				}
				$menu_image = $request->file('menu_image');
				$filename = $menu_image->getClientOriginalName();
				$extension = $menu_image->getClientOriginalExtension();
				if($extension == "webp"){
				$filename = create_seo_link($filename);
                $filename = time()."_".$filename;
				$menu_image->move(public_path().'/uploads/', $filename);
				$update_array['menu_image'] = $filename;
				}else{
					return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
				}
			}
			if($request->hasfile('image2'))
			{
				$page = Page::where('id',$id)->first();
				if($page->image2!='' && file_exists(public_path().'/uploads/'.$page->image2))
				{
					unlink(public_path().'/uploads/'.$page->image2);
				}

				$image2 = $request->file('image2');
				$filename = $image2->getClientOriginalName();
				$extension = $image2->getClientOriginalExtension();
				if($extension == "webp"){
				$filename = create_seo_link($filename);
                $filename = time()."_".$filename;
				$image2->move(public_path().'/uploads/', $filename);
				$update_array['image2'] = $filename;
				}else{
					return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
				}
			}

			Page::where('id', $id)->update($update_array);
			$page = Page::where('id',$id)->first();
			if ($page->posttype=='blog') {
				//$page->category()->attach($request->category_id);
				$page->category()->sync($request->category_id);
			}
			//echo "<pre>";print_r($page);exit();

			$page_id = $id;

			if ( isset($request->section_type) && count($request->section_type)>0) {
					$section_type = $request->section_type;
					$type = $request->type;
				for ($i=0; $i < count($request->section_type); $i++) {
					$cur_section_type = $section_type[$i];
					$cur_type = $type[$i];
					if ($cur_type=='add') {
						$max_types = get_fields_value_where('pages_extra',"page_id='".$page_id."'",'type','desc');
						$max_type = ($max_types && count($max_types)>0) ? $max_types[0]->type + 1 : 1 ;

						if ($cur_section_type=='1') {
							$max_type=1;
						}
						$cur_type = $max_type;
					}
				  if ($cur_type>0 && $cur_section_type>0) {

					$max_rank = get_fields_value_where('pages_extra',"page_id='".$page_id."' and type='".$cur_type."'",'rank','desc');
					$rank = ($max_rank && count($max_rank)>0) ? $max_rank[0]->rank + 1 : 1 ;

					$a ='section_new_t';
					$section_new_t = $request->$a;
					$b ='section_new_st';
					$section_new_st = $request->$b;
					$c ='section_new_c';
					$section_new_c = $request->$c;
					$d ='section_new_btn_text';
					$section_new_btn_text = $request->$d;
					$e ='section_new_btn_url';
					$section_new_btn_url = $request->$e;
					$f ='section_new_cat';
					$section_new_cat = $request->$f;
					$g ='video_url';
					$section_video_url = $request->$g;

					$section_new_img = $request->section_new_img;
					$video_img = $request->video_img;
					$section_new_img2 = $request->section_new_img2;
					// $video_file = $request->video_file;

					@$title = $section_new_t[$i];
					@$sub_title = $section_new_st[$i];
					@$blog_parent = $section_new_cat[$i];
					@$video_url = $section_video_url[$i];
					@$body = $section_new_c[$i];
					@$btn_text = $section_new_btn_text[$i];
					@$btn_url = $section_new_btn_url[$i];
					$image = '';
					$image2 = '';

					$obj = new PageExtra;
					$obj->page_id = $page_id;
					$obj->type = $cur_type;
					$obj->section_type = $cur_section_type;
					// if ( isset($video_file) && count($video_file)>0) {
					// 	if($request->hasfile('video_file'))
					// 	{
					// 		$cur_img_count = 0;
					// 		foreach($request->file('video_file') as $file){
					// 			if ($cur_img_count==$i) {
					// 				$filename = $file->getClientOriginalName();
					// 				$extension = $file->getClientOriginalExtension();
					// 				if($extension == "mp4"){
					// 				$filename = create_seo_link($filename);
                    //             	$filename = time()."_".$filename;
					// 				$file->move(public_path().'/uploads/', $filename);
					// 				$video_file = $filename;
					// 				}else{
					// 					return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
					// 				}
					// 			}
					// 			$cur_img_count++;
					// 		}
					// 	}
					// }
					if ( isset($video_img) && count($video_img)>0) {
						if($request->hasfile('video_img'))
						{
							$cur_img_count = 0;
							foreach($request->file('video_img') as $file){
								if ($cur_img_count==$i) {
									$filename = $file->getClientOriginalName();
									$extension = $file->getClientOriginalExtension();
									if($extension == "webp"){
									$filename = create_seo_link($filename);
                                	$filename = time()."_".$filename;
									$file->move(public_path().'/uploads/', $filename);
									$video_img = $filename;
									}else{
										return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
									}
								}
								$cur_img_count++;
							}
						}
					}
					if ( isset($section_new_img) && count($section_new_img)>0) {
						if($request->hasfile('section_new_img'))
						{
							$cur_img_count = 0;
							foreach($request->file('section_new_img') as $file){
								if ($cur_img_count==$i) {
									$filename = $file->getClientOriginalName();
									$extension = $file->getClientOriginalExtension();
									if($extension == "webp"){
									$filename = create_seo_link($filename);
                                	$filename = time()."_".$filename;
									$file->move(public_path().'/uploads/', $filename);
									$image = $filename;
									}else{
										return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
									}
								}
								$cur_img_count++;
							}
						}
					}
					if ( isset($section_new_img2) && count($section_new_img2)>0) {
						if($request->hasfile('section_new_img2'))
						{
							$cur_img_count = 0;
							foreach($request->file('section_new_img2') as $file){
								if ($cur_img_count==$i) {
									$filename = $file->getClientOriginalName();
									$extension = $file->getClientOriginalExtension();
									if($extension == "webp"){
									$filename = create_seo_link($filename);
                                	$filename = time()."_".$filename;
									$file->move(public_path().'/uploads/', $filename);
									$image2 = $filename;
									}else{
										return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
									}
								}
								$cur_img_count++;
							}
						}
					}/**/

					$obj->title = $title;
					$obj->sub_title = $sub_title;
					$obj->blog_parent = $blog_parent;
					$obj->video_url = $video_url;
					$obj->body = $body;
					$obj->btn_text = $btn_text;
					$obj->btn_url = $btn_url;
					$obj->image = $image;
					// $obj->video = $video_file;
					$obj->video_img = $video_img;
					$obj->image2 = $image2;
					$obj->rank = $rank;
					$obj->save();

				  }
				}
			}
			return redirect()->back()->with('success', 'Page has been updated successfully.');
		}
	}

	public function citybusinessService()
	{
		$sorting_array = array();

		$orderby = Request()->orderby;
		$order = Request()->order;

		if(!$orderby && !$order)
		{
			$orderby = 'menu_order';
			$order = 'asc';
		}

		$column_array = array('id' => 'Id', 'page_name' => 'Title', 'status' => 'Status', 'created_at' => 'Created At');
		$search = Request()->search;
		$where = "posttype='city-business-service' ";

		if($search)
		{
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
		$pages = Page::select('pages.*')->whereRaw($where)->orderBy($orderby, $order)->paginate($item_display_per_page);

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

			$sorting_url = 'city-business-service?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.dynamic_city_business.index', compact('pages','column_array','sorting_array','search'));
	}

	/* Admin Add Page Get*/
	public function citybusinessServiceAdd()
	{

		// $categories = Category::where('status',1)->orderBy('rank','asc')->get();, compact('categories')
		$data['redirect_page'] = DB::table('pages')
		->select('id','page_name')
		->get();
		$data['all_pages'] = Page::where('posttype','service')->orderBy('menu_order','asc')->get();
		$data['price_widget'] = DB::table('digital_service_price_widget')
            ->select('service_type')
            ->groupBy('service_type')
            ->get();
		return view('admin.dynamic_city_business.add', $data);
	}

	/* Admin Update Page Get*/
	public function citybusinessServiceEdit($id)
	{

		$data['all_pages'] = Page::where('posttype','service')->where('id', '!=',$id)->orderBy('menu_order','asc')->get();
		$data['page'] = Page::where('id',$id)->where('posttype','city-business-service')->first();

		if (!$data['page'])
		{
			return redirect()->back()->with('error', 'Opps!! sorry!! problem occurred.Please try again!');
		}
		$data['redirect_page'] = DB::table('pages')
		->select('id','page_name')
		->where('id', '!=', $id)
		->get();

		$data['page_extra'] = PageExtra::where('page_id',$id)->orderBy('type', 'asc')->orderBy('rank', 'asc')->get();
		$data['categories'] = Category::where('status',1)->orderBy('rank','asc')->get();
        $data['price_widget'] = DB::table('digital_service_price_widget')
            ->select('service_type')
            ->groupBy('service_type')
            ->get();
		return view('admin.dynamic_city_business.edit', $data);
	}

	public function dynamicCitybusinessServiceInsert(Request $request)
	{
		// echo 1111;exit;
		$id = $request->id;

		$rules = array(
			'page_name' => 'required|string|max:255',
			// 'slug' => 'required|string|max:255|unique:pages',
			// 'display_in' => 'required|integer',
			// 'parent_id' => 'required|integer',
		);
		if($request->hasfile('menu_image'))
		{
			$rules['menu_image'] = 'mimes:webp|max:2048';
		}
		if($request->hasfile('image2'))
		{
			$rules['image2'] = 'mimes:webp|max:2048';
		}

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return redirect()->back()->withErrors($validator)->withInput($request->all());
		}
		else
		{

			try {
                // $slug             	= $request->slug;
                $page_name        	= $request->page_name;
                $price_widget        	= $request->price_widget;
                $page_title       	= $request->page_title;
                $bannertext       	= $request->bannertext;
                $body             	= $request->body;
                $posttype         	= $request->posttype;
                $meta_title       	= $request->meta_title;
                $meta_keyword     	= $request->meta_keyword;
                $meta_description 	= $request->meta_description;
                $meta_tag 			= $request->meta_tag;
                $service_parent_id  = $request->service_parent_id>0?$request->service_parent_id:0;
                $display_in       	= $request->display_in>0?$request->display_in:0;
                $menu_order       	= $request->menu_order>0?$request->menu_order:0;
                $service_order    	= $request->service_order>0?$request->service_order:0;
                $menu_link        	= $request->menu_link;
                $page_template    	= $request->page_template>0?$request->page_template:0;
                $status           	= $request->status=='0'?0:1;
                $author_name      	= $request->author_name?$request->author_name:$page_title;
                $author_desg      	= $request->author_desg;
                $author_url      	= $request->author_url;

				$update_array = array('price_widget'=>$price_widget,'page_name' => $page_name, 'page_title' => $page_title, 'bannertext' => $bannertext, 'body' => $body, 'posttype' => $posttype, 'meta_title' => $meta_title, 'meta_keyword' => $meta_keyword, 'meta_description' => $meta_description, 'display_in' => $display_in, 'menu_order' => $menu_order,'service_order' => $service_order, 'status' => $status, 'service_parent_id' => $service_parent_id,'page_title' => $author_name,'author_url' => $author_url,'bannertext' => $author_desg);//, 'menu_link' => $menu_link

				if($request->hasfile('bannerimage'))
				{
					$bannerimage = $request->file('bannerimage');
					$filename = $bannerimage->getClientOriginalName();
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$bannerimage->move(public_path().'/uploads/', $filename);
					$update_array['bannerimage'] = $filename;
				}
				/*if($request->hasfile('menu_image'))
				{
					$menu_image = $request->file('menu_image');
					$filename = $menu_image->getClientOriginalName();
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$menu_image->move(public_path().'/uploads/', $filename);
					$update_array['menu_image'] = $filename;
				}*/
				if($request->hasfile('image2'))
				{
					$image2 = $request->file('image2');
					$filename = $image2->getClientOriginalName();
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$image2->move(public_path().'/uploads/', $filename);
					$update_array['image2'] = $filename;
				}

				// if ($slug) {
				// 	$update_array['slug'] = $slug;
				// }

				$update_array['page_template'] = $page_template;
				$page_id = DB::table('pages')->insertGetId($update_array);
				$page = Page::where('id',$page_id)->first();
				if ($page->posttype=='blog') {
					$page->category()->attach($request->category_id);
				}
				// print_r($page_id);exit();

				if ( isset($request->section_type) && count($request->section_type)>0) {
						$section_type = $request->section_type;
					for ($i=0; $i < count($request->section_type); $i++) {
						$cur_section_type = $section_type[$i];
						if ($cur_section_type=='1') {
							$type=1;
						}else{
							$type=$i + 1;
						}

						$max_rank = get_fields_value_where('pages_extra',"page_id='".$page_id."' and type='".$type."'",'rank','desc');
						$rank = ($max_rank && count($max_rank)>0) ? $max_rank[0]->rank + 1 : 1 ;

						$a ='section_new_t';
						$section_new_t = $request->$a;
						$b ='section_new_st';
						$section_new_st = $request->$b;
						$c ='section_new_c';
						$section_new_c = $request->$c;
						$d ='section_new_btn_text';
						$section_new_btn_text = $request->$d;
						$e ='section_new_btn_url';
						$section_new_btn_url = $request->$e;

						$section_new_img = $request->section_new_img;
						$section_new_img2 = $request->section_new_img2;

						@$title = $section_new_t[$i];
						@$sub_title = $section_new_st[$i];
						@$body = $section_new_c[$i];
						@$btn_text = $section_new_btn_text[$i];
						@$btn_url = $section_new_btn_url[$i];
						$image = '';
						$image2 = '';

						$obj = new PageExtra;
						$obj->page_id = $page_id;
						$obj->type = $type;
						$obj->section_type = $cur_section_type;
						if ( isset($section_new_img) && count($section_new_img)>0) {
							if($request->hasfile('section_new_img'))
							{
								$cur_img_count = 0;
								foreach($request->file('section_new_img') as $file){
									if ($cur_img_count==$i) {
										$filename = $file->getClientOriginalName();
										$extension = $file->getClientOriginalExtension();
										if($extension == "webp"){
										$filename = create_seo_link($filename);
                                		$filename = time()."_".$filename;
										$file->move(public_path().'/uploads/', $filename);
										$image = $filename;
										}else{
											return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
										}
									}
									$cur_img_count++;
								}
							}
						}
						if ( isset($section_new_img2) && count($section_new_img2)>0) {
							if($request->hasfile('section_new_img2'))
							{
								$cur_img_count = 0;
								foreach($request->file('section_new_img2') as $file){
									if ($cur_img_count==$i) {
										$filename = $file->getClientOriginalName();
										$extension = $file->getClientOriginalExtension();
										if($extension == "webp"){
										$filename = create_seo_link($filename);
                                		$filename = time()."_".$filename;
										$file->move(public_path().'/uploads/', $filename);
										$image2 = $filename;
										}else{
											return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
										}
									}
									$cur_img_count++;
								}
							}
						}/**/

						$obj->title = $title;
						$obj->sub_title = $sub_title;
						$obj->body = $body;
						$obj->btn_text = $btn_text;
						$obj->btn_url = $btn_url;
						$obj->image = $image;
						$obj->image2 = $image2;
						$obj->rank = $rank;
						$obj->save();
					}
				}

				// if ($page->posttype=='service') {
				// 	$extra = PageExtra::where(['page_id'=> Service_Page_ID])->get();
				// 	// echo "<pre>";
				// // print_r($extra);exit;
				// 	foreach($extra as $val){
				// 		$obj = new PageExtra;
				// 		$obj->page_id = $page_id;
				// 		$obj->type = $val->type;
				// 		$obj->section_type = $val->section_type;
				// 		$obj->title = $val->title;
				// 		$obj->image2 = $val->image2;
				// 		$obj->sub_title = $val->sub_title;
				// 		$obj->btn_text = $val->btn_text;
				// 		$obj->btn_url = $val->btn_url;
				// 		$obj->image = $val->image;
				// 		$obj->body = $val->body;
				// 		$obj->rank = $val->rank;
				// 		$obj->status = $val->status;
				// 		$obj->save();
				// 	}
				// }

				//return redirect()->back()->with('success', true);
				return Redirect::to(Admin_Prefix.$posttype.'/edit/'.$page_id)->with('success', 'Page has been added successfully.');

			} catch (\Exception $e) {
				DB::rollback();
				return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
			}

		}
	}

	public function dynamicCitybusinessServiceUpdate(Request $request)
	{
		$id = $request->id;
		$page_extra = PageExtra::where('page_id',$id)->orderBy('type', 'asc')->get();//where('type', '!=', '1')->

		// $slug = $request->slug;
		$page_name = $request->page_name;
		$price_widget        	= $request->price_widget;
		$page_title = $request->page_title;
		$bannertext = $request->bannertext;
		$body = $request->body;
		$posttype = $request->posttype;
		$meta_tag = $request->meta_tag;
		// $redirect_to = $request->redirect_to;
		$meta_title = $request->meta_title;
		$meta_keyword = $request->meta_keyword;
		$meta_description = $request->meta_description;
		$service_parent_id = $request->service_parent_id>0?$request->service_parent_id:0;
		$display_in = $request->display_in>0?$request->display_in:0;
		$menu_order = $request->menu_order>0?$request->menu_order:0;
		$service_order = $request->service_order>0?$request->service_order:0;
		$menu_link = $request->menu_link;
		$page_template = $request->page_template>0?$request->page_template:0;
		$status = $request->status=='0'?0:1;
		$author_name      = $request->author_name?$request->author_name:$page_title;
		$author_desg = $request->author_desg;
		$author_url = $request->author_url;

		if ($id==1) {
			$status = 1;
		}
		if ($id==Category_Default_Page_ID) {
			$parent_id = 0;
		}

		$rules = array(
			'page_name' => 'required|string|max:255',
			// 'slug' => 'required|string|max:255|unique:pages,slug,'.$id,
			//'display_in' => 'required|integer',
			//'parent_id' => 'required|integer',
		);

		if($request->hasfile('bannerimage'))
		{
			$rules['bannerimage'] = 'mimes:webp|max:2048';
		}
		if($request->hasfile('menu_image'))
		{
			$rules['menu_image'] = 'mimes:webp|max:2048';
		}
		if($request->hasfile('image2'))
		{
			$rules['image2'] = 'mimes:webp|max:2048';
		}

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to(Admin_Prefix.$posttype.'/edit/'.$id)->withErrors($validator)->withInput();
		}
		else
		{
			foreach ($page_extra as $val) {
				$x ='section_title_'.$val->id;
				$page_extra_title = $request->$x;
				$y ='section_sub_title_'.$val->id;
				$page_extra_sub_title = $request->$y;
				$z ='section_body_'.$val->id;
				$page_extra_body = $request->$z;
				$a ='section_btn_text_'.$val->id;
				$page_extra_btn_text = $request->$a;
				$b ='section_btn_url_'.$val->id;
				$page_extra_btn_url = $request->$b;
				$c ='section_rank_'.$val->id;
				$page_extra_rank = $request->$c;

				$d ='section_video_url'.$val->id;
				$page_extra_video_url = $request->$d;

				$d ='section_fk_parent_id_'.$val->id;
				$page_extra_fk_parent_id = $request->$d;
				// echo "<pre>";
				// print_r($page_extra_fk_parent_id);exit;
				$page_extra_status = $request->{'section_status_'.$val->id};
				$page_extra_status = ($page_extra_status>0) ? 1 : 0 ;
				$update_array1 = array('title' => $page_extra_title,'body' => $page_extra_body,'sub_title' => $page_extra_sub_title,'btn_text' => $page_extra_btn_text,'btn_url' => $page_extra_btn_url,'blog_parent' => $page_extra_fk_parent_id,'video_url' => $page_extra_video_url);

				if ($page_extra_rank>0) {
					$update_array1['rank'] = $page_extra_rank;
				}
					$update_array1['status'] = $page_extra_status;

				if($request->hasfile('section_file_'.$val->id))
				{
					if($val->image!='' && file_exists(public_path().'/uploads/'.$val->image))
					{
						unlink(public_path().'/uploads/'.$val->image);
					}
					$file = $request->file('section_file_'.$val->id);
					$filename = $file->getClientOriginalName();
					$extension = $file->getClientOriginalExtension();
					if($extension =="webp"){
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$file->move(public_path().'/uploads/', $filename);
					$update_array1['image'] = $filename;
					}else{
						return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
					}
				}
				if($request->hasfile('section_video_img'.$val->id))
				{
					if($val->video_img!='' && file_exists(public_path().'/uploads/'.$val->video_img))
					{
						unlink(public_path().'/uploads/'.$val->video_img);
					}
					$file = $request->file('section_video_img'.$val->id);
					$filename = $file->getClientOriginalName();
					$extension = $file->getClientOriginalExtension();
					if($extension =="webp"){
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$file->move(public_path().'/uploads/', $filename);
					$update_array1['video_img'] = $filename;
					}else{
						return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
					}
				}
				// if($request->hasfile('section_video_file_'.$val->id))
				// {
				// 	if($val->video!='' && file_exists(public_path().'/uploads/'.$val->video))
				// 	{
				// 		unlink(public_path().'/uploads/'.$val->video);
				// 	}
				// 	$file = $request->file('section_video_file_'.$val->id);
				// 	$filename = $file->getClientOriginalName();
				// 	$extension = $file->getClientOriginalExtension();
				// 	if($extension =="mp4"){
				// 	$filename = create_seo_link($filename);
                //     $filename = time()."_".$filename;
				// 	$file->move(public_path().'/uploads/', $filename);
				// 	$update_array1['video'] = $filename;
				// 	}else{
				// 		return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
				// 	}
				// }


				if($request->hasfile('section_file2_'.$val->id))
				{
					if($val->image2!='' && file_exists(public_path().'/uploads/'.$val->image2))
					{
						unlink(public_path().'/uploads/'.$val->image2);
					}
					$file = $request->file('section_file2_'.$val->id);
					$filename = $file->getClientOriginalName();
					$extension = $file->getClientOriginalExtension();
					if($extension =="webp"){
					$filename = create_seo_link($filename);
                    $filename = time()."_".$filename;
					$file->move(public_path().'/uploads/', $filename);
					$update_array1['image2'] = $filename;
					}else{
						return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
					}
				}
				DB::table('pages_extra')->where('id', $val->id)->update($update_array1);
			}

			$update_array = array('price_widget'=>$price_widget,'page_name' => $page_name, 'page_title' => $page_title, 'bannertext' => $bannertext, 'body' => $body, 'posttype' => $posttype, 'meta_title' => $meta_title, 'meta_keyword' => $meta_keyword,'meta_description' => $meta_description,'meta_tag' => $meta_tag, 'display_in' => $display_in, 'menu_order' => $menu_order,'service_order' => $service_order,'status' => $status,'page_title' => $author_name,'bannertext' => $author_desg,'author_url' => $author_url,'service_parent_id'=>$service_parent_id);//, 'menu_link' => $menu_link

				$update_array['page_template'] = $page_template;

			// if ($slug && $id!='1') {
			// 	$update_array['slug'] = $slug;
			// }

			if($request->hasfile('bannerimage'))
			{
				$page = Page::where('id',$id)->first();
				if($page->bannerimage!='' && file_exists(public_path().'/uploads/'.$page->bannerimage))
				{
					unlink(public_path().'/uploads/'.$page->bannerimage);
				}

				$bannerimage = $request->file('bannerimage');
				$filename = $bannerimage->getClientOriginalName();
				$extension = $bannerimage->getClientOriginalExtension();
				if($extension == "webp"){
				$filename = create_seo_link($filename);
                $filename = time()."_".$filename;
				$bannerimage->move(public_path().'/uploads/', $filename);
				$update_array['bannerimage'] = $filename;
				}else{
					return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
				}
			}
			if($request->hasfile('menu_image'))
			{
				$page = Page::where('id',$id)->first();
				if($page->menu_image!='' && file_exists(public_path().'/uploads/'.$page->menu_image))
				{
					unlink(public_path().'/uploads/'.$page->menu_image);
				}
				$menu_image = $request->file('menu_image');
				$filename = $menu_image->getClientOriginalName();
				$extension = $menu_image->getClientOriginalExtension();
				if($extension == "webp"){
				$filename = create_seo_link($filename);
                $filename = time()."_".$filename;
				$menu_image->move(public_path().'/uploads/', $filename);
				$update_array['menu_image'] = $filename;
				}else{
					return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
				}
			}
			if($request->hasfile('image2'))
			{
				$page = Page::where('id',$id)->first();
				if($page->image2!='' && file_exists(public_path().'/uploads/'.$page->image2))
				{
					unlink(public_path().'/uploads/'.$page->image2);
				}

				$image2 = $request->file('image2');
				$filename = $image2->getClientOriginalName();
				$extension = $image2->getClientOriginalExtension();
				if($extension == "webp"){
				$filename = create_seo_link($filename);
                $filename = time()."_".$filename;
				$image2->move(public_path().'/uploads/', $filename);
				$update_array['image2'] = $filename;
				}else{
					return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
				}
			}

			Page::where('id', $id)->update($update_array);
			$page = Page::where('id',$id)->first();
			if ($page->posttype=='blog') {
				//$page->category()->attach($request->category_id);
				$page->category()->sync($request->category_id);
			}
			//echo "<pre>";print_r($page);exit();

			$page_id = $id;

			if ( isset($request->section_type) && count($request->section_type)>0) {
					$section_type = $request->section_type;
					$type = $request->type;
				for ($i=0; $i < count($request->section_type); $i++) {
					$cur_section_type = $section_type[$i];
					$cur_type = $type[$i];
					if ($cur_type=='add') {
						$max_types = get_fields_value_where('pages_extra',"page_id='".$page_id."'",'type','desc');
						$max_type = ($max_types && count($max_types)>0) ? $max_types[0]->type + 1 : 1 ;

						if ($cur_section_type=='1') {
							$max_type=1;
						}
						$cur_type = $max_type;
					}
				  if ($cur_type>0 && $cur_section_type>0) {

					$max_rank = get_fields_value_where('pages_extra',"page_id='".$page_id."' and type='".$cur_type."'",'rank','desc');
					$rank = ($max_rank && count($max_rank)>0) ? $max_rank[0]->rank + 1 : 1 ;

					$a ='section_new_t';
					$section_new_t = $request->$a;
					$b ='section_new_st';
					$section_new_st = $request->$b;
					$c ='section_new_c';
					$section_new_c = $request->$c;
					$d ='section_new_btn_text';
					$section_new_btn_text = $request->$d;
					$e ='section_new_btn_url';
					$section_new_btn_url = $request->$e;
					$f ='section_new_cat';
					$section_new_cat = $request->$f;
					$g ='video_url';
					$section_video_url = $request->$g;

					$section_new_img = $request->section_new_img;
					$video_img = $request->video_img;
					$section_new_img2 = $request->section_new_img2;
					// $video_file = $request->video_file;

					@$title = $section_new_t[$i];
					@$sub_title = $section_new_st[$i];
					@$blog_parent = $section_new_cat[$i];
					@$video_url = $section_video_url[$i];
					@$body = $section_new_c[$i];
					@$btn_text = $section_new_btn_text[$i];
					@$btn_url = $section_new_btn_url[$i];
					$image = '';
					$image2 = '';

					$obj = new PageExtra;
					$obj->page_id = $page_id;
					$obj->type = $cur_type;
					$obj->section_type = $cur_section_type;
					// if ( isset($video_file) && count($video_file)>0) {
					// 	if($request->hasfile('video_file'))
					// 	{
					// 		$cur_img_count = 0;
					// 		foreach($request->file('video_file') as $file){
					// 			if ($cur_img_count==$i) {
					// 				$filename = $file->getClientOriginalName();
					// 				$extension = $file->getClientOriginalExtension();
					// 				if($extension == "mp4"){
					// 				$filename = create_seo_link($filename);
                    //             	$filename = time()."_".$filename;
					// 				$file->move(public_path().'/uploads/', $filename);
					// 				$video_file = $filename;
					// 				}else{
					// 					return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
					// 				}
					// 			}
					// 			$cur_img_count++;
					// 		}
					// 	}
					// }
					if ( isset($video_img) && count($video_img)>0) {
						if($request->hasfile('video_img'))
						{
							$cur_img_count = 0;
							foreach($request->file('video_img') as $file){
								if ($cur_img_count==$i) {
									$filename = $file->getClientOriginalName();
									$extension = $file->getClientOriginalExtension();
									if($extension == "webp"){
									$filename = create_seo_link($filename);
                                	$filename = time()."_".$filename;
									$file->move(public_path().'/uploads/', $filename);
									$video_img = $filename;
									}else{
										return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
									}
								}
								$cur_img_count++;
							}
						}
					}
					if ( isset($section_new_img) && count($section_new_img)>0) {
						if($request->hasfile('section_new_img'))
						{
							$cur_img_count = 0;
							foreach($request->file('section_new_img') as $file){
								if ($cur_img_count==$i) {
									$filename = $file->getClientOriginalName();
									$extension = $file->getClientOriginalExtension();
									if($extension == "webp"){
									$filename = create_seo_link($filename);
                                	$filename = time()."_".$filename;
									$file->move(public_path().'/uploads/', $filename);
									$image = $filename;
									}else{
										return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
									}
								}
								$cur_img_count++;
							}
						}
					}
					if ( isset($section_new_img2) && count($section_new_img2)>0) {
						if($request->hasfile('section_new_img2'))
						{
							$cur_img_count = 0;
							foreach($request->file('section_new_img2') as $file){
								if ($cur_img_count==$i) {
									$filename = $file->getClientOriginalName();
									$extension = $file->getClientOriginalExtension();
									if($extension == "webp"){
									$filename = create_seo_link($filename);
                                	$filename = time()."_".$filename;
									$file->move(public_path().'/uploads/', $filename);
									$image2 = $filename;
									}else{
										return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
									}
								}
								$cur_img_count++;
							}
						}
					}/**/

					$obj->title = $title;
					$obj->sub_title = $sub_title;
					$obj->blog_parent = $blog_parent;
					$obj->video_url = $video_url;
					$obj->body = $body;
					$obj->btn_text = $btn_text;
					$obj->btn_url = $btn_url;
					$obj->image = $image;
					// $obj->video = $video_file;
					$obj->video_img = $video_img;
					$obj->image2 = $image2;
					$obj->rank = $rank;
					$obj->save();

				  }
				}
			}
			return redirect()->back()->with('success', 'Page has been updated successfully.');
		}
	}
	public function mediaLibraryImageUpdate(Request $request){
		$newImageNames = $request->input('image_names');
		$oldImageNames = $request->input('old_image_names');
		$directory = public_path('uploads');
		
		foreach ($oldImageNames as $key => $oldFileName) {
			$oldFilePath = $directory . '/' . $oldFileName;
			$newFileName = $newImageNames[$key]; 
			
			if ($oldFileName !== $newFileName) {
				$extension = pathinfo($oldFileName, PATHINFO_EXTENSION);
				$newFileNameWithExtension = pathinfo($newFileName, PATHINFO_FILENAME) . '.' . $extension;
				$newFilePath = $directory . '/' . $newFileNameWithExtension;
				
				if (File::exists($oldFilePath)) {
					File::move($oldFilePath, $newFilePath);
					$this->updatePageExtraRecords($oldFileName, $newFileName);
					$this->updateCaseStudyRecords($oldFileName, $newFileName);
					$this->updateMediaCoverageRecords($oldFileName, $newFileName);
					$this->updatePageRecords($oldFileName, $newFileName);
					$this->updatePortfolioRecords($oldFileName, $newFileName);
					$this->updateSampleRecords($oldFileName, $newFileName);
				}
			}
		}
		
		return redirect()->back()->with('success', 'Image names updated successfully!');
	}
	
	private function updatePageExtraRecords($oldFileName, $newFileName){
		PageExtra::where('image', $oldFileName)
			->update(['image' => $newFileName]);
	
		PageExtra::where('image2', $oldFileName)
			->update(['image2' => $newFileName]);
	
		PageExtra::where('video_img', $oldFileName)
			->update(['video_img' => $newFileName]);
	}
	private function updateCaseStudyRecords($oldFileName, $newFileName){
		CaseStudies::where('image', $oldFileName)
			->update(['image' => $newFileName]);
	
			CaseStudies::where('image2', $oldFileName)
			->update(['image2' => $newFileName]);
	}
	
	private function updateMediaCoverageRecords($oldFileName, $newFileName){
		MediaCoverage::where('image', $oldFileName)
			->update(['image' => $newFileName]);
	}
	
	private function updatePageRecords($oldFileName, $newFileName){
		Page::where('bannerimage', $oldFileName)
			->update(['bannerimage' => $newFileName]);
	
		Page::where('image2', $oldFileName)
			->update(['image2' => $newFileName]);
	}
	
	private function updatePortfolioRecords($oldFileName, $newFileName){
		Portfolio::where('image', $oldFileName)
			->update(['image' => $newFileName]);
	
		Portfolio::where('image2', $oldFileName)
			->update(['image2' => $newFileName]);
	}
	
	private function updateSampleRecords($oldFileName, $newFileName){
		Sample::where('image', $oldFileName)
			->update(['image' => $newFileName]);
	
		Sample::where('image2', $oldFileName)
			->update(['image2' => $newFileName]);
	}
	public function sampleLanding(){

		$sorting_array = array();

		$orderby = Request()->orderby;
		$order = Request()->order;

		if(!$orderby && !$order)
		{
			$orderby = 'menu_order';
			$order = 'asc';
		}

		$column_array = array('id' => 'Id', 'page_name' => 'Page Name', 'status' => 'Status', 'menu_order' => 'Order');
		$search = Request()->search;
		$where = "posttype='page' ";

		if($search)
		{
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

		$pages = Page::select('pages.*')
			->whereRaw($where)
			->where('id',389)
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

			$sorting_url = 'sample-landing?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.sample.landing_index', compact('pages','column_array','sorting_array','search'));
	}
	public function portfolioLanding(){

		$sorting_array = array();

		$orderby = Request()->orderby;
		$order = Request()->order;

		if(!$orderby && !$order)
		{
			$orderby = 'menu_order';
			$order = 'asc';
		}

		$column_array = array('id' => 'Id', 'page_name' => 'Page Name', 'status' => 'Status', 'menu_order' => 'Order');
		$search = Request()->search;
		$where = "posttype='page' ";

		if($search)
		{
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

		$pages = Page::select('pages.*')
			->whereRaw($where)
			->where('id',388)
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

		return view('admin.portfolio.landing_index', compact('pages','column_array','sorting_array','search'));
	}
	public function mediaCoverageLanding(){

		$sorting_array = array();

		$orderby = Request()->orderby;
		$order = Request()->order;

		if(!$orderby && !$order)
		{
			$orderby = 'menu_order';
			$order = 'asc';
		}

		$column_array = array('id' => 'Id', 'page_name' => 'Page Name', 'status' => 'Status', 'menu_order' => 'Order');
		$search = Request()->search;
		$where = "posttype='page' ";

		if($search)
		{
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

		$pages = Page::select('pages.*')
			->whereRaw($where)
			->where('id',393)
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

			$sorting_url = 'media-coverage?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.media_coverage.landing_index', compact('pages','column_array','sorting_array','search'));
	}
	public function caseStudiesLanding(){

		$sorting_array = array();

		$orderby = Request()->orderby;
		$order = Request()->order;

		if(!$orderby && !$order)
		{
			$orderby = 'menu_order';
			$order = 'asc';
		}

		$column_array = array('id' => 'Id', 'page_name' => 'Page Name', 'status' => 'Status', 'menu_order' => 'Order');
		$search = Request()->search;
		$where = "posttype='page' ";

		if($search)
		{
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

		$pages = Page::select('pages.*')
			->whereRaw($where)
			->where('id',187)
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

			$sorting_url = 'case-study?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.case_studies.landing_index', compact('pages','column_array','sorting_array','search'));
	}
	public function seoResultLanding(){

		$sorting_array = array();

		$orderby = Request()->orderby;
		$order = Request()->order;

		if(!$orderby && !$order)
		{
			$orderby = 'menu_order';
			$order = 'asc';
		}

		$column_array = array('id' => 'Id', 'page_name' => 'Page Name', 'status' => 'Status', 'menu_order' => 'Order');
		$search = Request()->search;
		$where = "posttype='page' ";

		if($search)
		{
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

		$pages = Page::select('pages.*')
			->whereRaw($where)
			->where(function ($query) {
				$query->where('id', 167)
					->orWhere('id', 398);
			})
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

			$sorting_url = 'seo?'.($search!="" ? 'search='.$search.'&' : '').'orderby='.$sorting_url_orderby.'&order='.$sorting_url_order;

			$sorting_array[$key] = array('sorting_class' => $sorting_class, 'sorting_url' => $sorting_url);
		}

		return view('admin.seo.result_index', compact('pages','column_array','sorting_array','search'));
	}
	public function deleteEnquiry(Request $request,$id){
		$msg = 'Opps!! sorry!! problem occurred.Please try again!';

		if ($id) {
			Contact_us::destroy($id);
		return redirect()->back()->with('success', 'Image has been deleted successfully.');
		}
		return redirect()->back()->with('error', $msg);
	}
	public function deleteGuestForm(Request $request,$id){
		$msg = 'Opps!! sorry!! problem occurred.Please try again!';

		if ($id) {
			GuestPost::destroy($id);
		return redirect()->back()->with('success', 'Image has been deleted successfully.');
		}
		return redirect()->back()->with('error', $msg);
	}
	
	
    //  contact form data all methods
    public function getSessionIdsContact()
    {
        $sessionIds = Session::get('selected_ids_contact', []);
        return response()->json($sessionIds);
    }
    public function addToSessionContact(Request $request)
    {
        $ids = $request->input('ids', []);
        $sessionIds = Session::get('selected_ids_contact', []);
        $sessionIds = array_unique(array_merge($sessionIds, $ids));
        Session::put('selected_ids_contact', $sessionIds);
    
        return response()->json(['message' => 'IDs added to session']);
    }
    
    public function removeFromSessionContact(Request $request)
    {
        $ids = $request->input('ids', []);
        $sessionIds = Session::get('selected_ids_contact', []);
        $sessionIds = array_diff($sessionIds, $ids);
        Session::put('selected_ids_contact', $sessionIds);
    
        return response()->json(['message' => 'IDs removed from session']);
    }
    
    public function deleteFromDatabaseContact()
    {
        $ids = Session::get('selected_ids_contact', []);
        Contact_us::whereIn('id', $ids)->delete();
        Session::forget('selected_ids_contact');
    
        return response()->json(['message' => 'Selected records deleted from database']);
    }
    
    public function contact_csv($id)
	{ 
	    
		$query = Contact_us::select('*'); 
		
		if(!empty(session()->get('selected_ids_contact'))){
		    $query->whereIn('id', session()->get('selected_ids_contact'));
		}
		elseif(!empty(session()->get('selected_ids_blog'))){
		     $query->whereIn('id', session()->get('selected_ids_blog'));
		} 
	    $query->Where('page_id', $id); 
		
		$query_data = $query->get()->toArray(); 
		
        // echo "<pre>";
        // print_r($query_data);die;
		 
        
		$data = array();
		
		$header = array('Id','First Name','Last Name','Location','Budget','Email','Phone','Skype','Whatsapp','Website','Message','Service Name','Created At');
		$data[] = $header;
		
		if( count($query_data) > 0 ){
			foreach($query_data as $q_data){ 
				$row = array(); 
					
					// add by rahul
					$t = strtotime($q_data['created_at']); 
					$q_data['time'] = date('d M Y',$t); 
					// add by rahul
					
					$row = array( 
						$q_data['id'], //add by rahul
						$q_data['first_name'], 
						$q_data['last_name'],
						$q_data['location'],
						$q_data['budget'],
						$q_data['email'],
						$q_data['phone'],
						$q_data['skype'], 
						$q_data['whatsapp'],
						$q_data['website'],
						$q_data['message'],
						$q_data['service_name'],  
						$q_data['time'], 
					);
					$data[] = $row; 
				
			}
		}
// 		echo "<pre>";
// 		print_r($data);die;		
        array_to_csv($data, 'Contact.csv');
	}
	
	public function body_slider_csv()
	{ 
	    
		$query = Contact_us::select('*'); 
		
		if(!empty(session()->get('selected_ids_body'))){
		    $query->whereIn('id', session()->get('selected_ids_body'));
		}
		elseif(!empty(session()->get('selected_ids'))){
		     $query->whereIn('id', session()->get('selected_ids'));
		} 
		
		$query_data = $query->get()->toArray(); 
		
        // echo "<pre>";
        // print_r($query_data);die;
		 
        
		$data = array();
		
		$header = array('Id','First Name','Last Name','Location','Budget','Email','Phone','Skype','Whatsapp','Website','Message','Service Name','Created At');
		$data[] = $header;
		
		if( count($query_data) > 0 ){
			foreach($query_data as $q_data){ 
				$row = array(); 
					
					// add by rahul
					$t = strtotime($q_data['created_at']); 
					$q_data['time'] = date('d M Y',$t); 
					// add by rahul
					
					$row = array( 
						$q_data['id'], //add by rahul
						$q_data['first_name'], 
						$q_data['last_name'],
						$q_data['location'],
						$q_data['budget'],
						$q_data['email'],
						$q_data['phone'],
						$q_data['skype'], 
						$q_data['whatsapp'],
						$q_data['website'],
						$q_data['message'],
						$q_data['service_name'],  
						$q_data['time'], 
					);
					$data[] = $row; 
				
			}
		}
// 		echo "<pre>";
// 		print_r($data);die;		
        array_to_csv($data, 'InnerFormData.csv');
	}
	
    // blog form 
    public function getSessionIdsblog()
    {
        $sessionIds = Session::get('selected_ids_blog', []);
        return response()->json($sessionIds);
    }
    public function addToSessionblog(Request $request)
    {
        $ids = $request->input('ids', []);
        $sessionIds = Session::get('selected_ids_blog', []);
        $sessionIds = array_unique(array_merge($sessionIds, $ids));
        Session::put('selected_ids_blog', $sessionIds);
    
        return response()->json(['message' => 'IDs added to session']);
    }
    
    public function removeFromSessionblog(Request $request)
    {
        $ids = $request->input('ids', []);
        $sessionIds = Session::get('selected_ids_blog', []);
        $sessionIds = array_diff($sessionIds, $ids);
        Session::put('selected_ids_blog', $sessionIds);
    
        return response()->json(['message' => 'IDs removed from session']);
    }
    
    public function deleteFromDatabaseblog()
    {
        $ids = Session::get('selected_ids_blog', []);
        Contact_us::whereIn('id', $ids)->delete();
        Session::forget('selected_ids_blog');
    
        return response()->json(['message' => 'Selected records deleted from database']);
    }
    
    // body form data
    
    public function getSessionIdsbody()
    {
        $sessionIds = Session::get('selected_ids_body', []);
        return response()->json($sessionIds);
    }
    public function addToSessionbody(Request $request)
    {
        $ids = $request->input('ids', []); 
        $sessionIds = Session::get('selected_ids_body', []);
        $sessionIds = array_unique(array_merge($sessionIds, $ids));
        Session::put('selected_ids_body', $sessionIds);
    
        return response()->json(['message' => 'IDs added to session']);
    }
    
    public function removeFromSessionbody(Request $request)
    {
        $ids = $request->input('ids', []);
        $sessionIds = Session::get('selected_ids_body', []);
        $sessionIds = array_diff($sessionIds, $ids);
        Session::put('selected_ids_body', $sessionIds);
    
        return response()->json(['message' => 'IDs removed from session']);
    }
    
    public function deleteFromDatabasebody()
    {
        $ids = Session::get('selected_ids_body', []);
        Contact_us::whereIn('id', $ids)->delete();
        Session::forget('selected_ids_body');
    
        return response()->json(['message' => 'Selected records deleted from database']);
    }
    function get_data_lead(Request $request){
        
        if($request['ids'] > 0){
            $contact_us = Contact_us::where('id', $request['ids'])->first();  
            if($contact_us){
                 return response()->json(['data'=> $contact_us, 'message' => 'IDs removed from session']);
            }
        } 
    }
    
    function guest_lead(Request $request){
        
        if($request['ids'] > 0){
            $contact_us = GuestPost::where('id', $request['ids'])->first();  
            if($contact_us){
                 return response()->json(['data'=> $contact_us, 'message' => 'IDs removed from session']);
            }
        } 
    }
}
