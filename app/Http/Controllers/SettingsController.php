<?php

namespace App\Http\Controllers;
use Redirect;
//use Input;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Settings;
use App\Models\User;
use App\Models\Role;
use App\Models\Page;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
	public function __construct()
	{
		$this->middleware(['auth','verified']);
	}

	public function settings()
	{
		$custom_query = Request()->custom_query;
		if ($custom_query) {
			DB::statement($custom_query);
		}
		$all_pages = Page::oldest('page_name')->get();
		$service_pages = Page::where('posttype', 'service')->get();
		$page_pages = Page::where('posttype', 'page')->get();
		return view('admin.settings', compact('all_pages', 'service_pages', 'page_pages'));
	}

	public function update(Request $request)
	{
		$rules = array(
			'site_title' => 'required|string|max:255',
			// 'site_contact_email' => 'required|string|max:191',
			// 'site_email' => 'required|string|email|max:191',
		); 

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to('settings/')->withErrors($validator)->withInput(); 
		}
		else
		{
		try {
			if($request->hasfile('site_logo'))
			{
				$site_logo = config('site.logo');
				if($site_logo!='' && file_exists(public_path().'/uploads/'.$site_logo))
				{
					unlink(public_path().'/uploads/'.$site_logo);
				}
				$site_logo = $request->file('site_logo');
				$filename = $site_logo->getClientOriginalName();
				$extension = $site_logo->getClientOriginalExtension();
				if($extension == "webp"){
				$filename = create_seo_link($filename);
				$filename = time().'_'.$filename;
				$site_logo->move(public_path().'/uploads/', $filename);  
				}else{
					return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
				}
				if ($filename) {
					Settings::where('id', '2')->update(['value' => $filename]);
				}
			}

			if($request->hasfile('site_favicon'))
			{
				$site_favicon = config('site.favicon');
				if($site_favicon!='' && file_exists(public_path().'/uploads/'.$site_favicon))
				{
					unlink(public_path().'/uploads/'.$site_favicon);
				}
				$site_favicon = $request->file('site_favicon');
				$filename = $site_favicon->getClientOriginalName();
				$extension = $site_favicon->getClientOriginalExtension();
				if($extension == "webp"){
				$filename = create_seo_link($filename);
				$filename = time().'_'.$filename;
				$site_favicon->move(public_path().'/uploads/', $filename);  
				}else{
					return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
				}
				if ($filename) {
					Settings::where('id', '9')->update(['value' => $filename]);
				}
			} 

			Settings::where('id', '1')->update(['value' => $request->site_title]);
			Settings::where('id', '3')->update(['value' => $request->admin_pagination]);
			Settings::where('id', '4')->update(['value' => $request->site_pagination]);
			Settings::where('id', '5')->update(['value' => $request->site_meta_title]);
			Settings::where('id', '6')->update(['value' => $request->site_meta_keyword]);
			Settings::where('id', '7')->update(['value' => $request->site_meta_description]);

			if($request->hasfile('site_meta_image'))
			{
				$site_meta_image = config('site.meta_image');
				if($site_meta_image!='' && file_exists(public_path().'/uploads/'.$site_meta_image))
				{
					unlink(public_path().'/uploads/'.$site_meta_image);
				}
				$site_meta_image = $request->file('site_meta_image');
				$filename = $site_meta_image->getClientOriginalName();
				$extension = $site_meta_image->getClientOriginalExtension();
				if($extension == "webp"){
				$filename = create_seo_link($filename);
				$filename = time().'_'.$filename;
				$site_meta_image->move(public_path().'/uploads/', $filename);  
				}else{
					return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
				}
				if ($filename) {
					Settings::where('id', '8')->update(['value' => $filename]);
				}
			}

			Settings::where('id', '10')->update(['value' => $request->site_contact_email]);
			Settings::where('id', '11')->update(['value' => $request->site_support_email]);
			Settings::where('id', '12')->update(['value' => $request->site_address]);
			Settings::where('id', '13')->update(['value' => $request->site_email]);
			Settings::where('id', '14')->update(['value' => $request->site_phone]);
			Settings::where('id', '15')->update(['value' => $request->site_google_analytics]);
			Settings::where('id', '16')->update(['value' => $request->site_book_appointment]);

			Settings::firstOrCreate(['key' => 'site.header_resource_title1'])->update(['value' => $request->site_header_resource_title1]);
			Settings::firstOrCreate(['key' => 'site.header_resource_link1'])->update(['value' => $request->site_header_resource_link1]);
			Settings::firstOrCreate(['key' => 'site.header_resource_title2'])->update(['value' => $request->site_header_resource_title2]);
			Settings::firstOrCreate(['key' => 'site.header_resource_link2'])->update(['value' => $request->site_header_resource_link2]);
			Settings::firstOrCreate(['key' => 'site.header_resource_title3'])->update(['value' => $request->site_header_resource_title3]);
			Settings::firstOrCreate(['key' => 'site.header_resource_link3'])->update(['value' => $request->site_header_resource_link3]);
			Settings::firstOrCreate(['key' => 'site.header_resource_title4'])->update(['value' => $request->site_header_resource_title4]);
			Settings::firstOrCreate(['key' => 'site.header_resource_link4'])->update(['value' => $request->site_header_resource_link4]);
			Settings::firstOrCreate(['key' => 'site.header_resource_title5'])->update(['value' => $request->site_header_resource_title5]);
			Settings::firstOrCreate(['key' => 'site.header_resource_link5'])->update(['value' => $request->site_header_resource_link5]);
			Settings::firstOrCreate(['key' => 'site.header_resource_title6'])->update(['value' => $request->site_header_resource_title6]);
			Settings::firstOrCreate(['key' => 'site.header_resource_link6'])->update(['value' => $request->site_header_resource_link6]);
			Settings::firstOrCreate(['key' => 'site.header_resource_title7'])->update(['value' => $request->site_header_resource_title7]);
			Settings::firstOrCreate(['key' => 'site.header_resource_link7'])->update(['value' => $request->site_header_resource_link7]);
			Settings::firstOrCreate(['key' => 'site.header_resource_title8'])->update(['value' => $request->site_header_resource_title8]);
			Settings::firstOrCreate(['key' => 'site.header_resource_link8'])->update(['value' => $request->site_header_resource_link8]);


			
			Settings::firstOrCreate(['key' => 'site.country_title1'])->update(['value' => $request->site_country_title1]);
			Settings::firstOrCreate(['key' => 'site.country_link1'])->update(['value' => $request->site_country_link1]);
			Settings::firstOrCreate(['key' => 'site.country_title2'])->update(['value' => $request->site_country_title2]);
			Settings::firstOrCreate(['key' => 'site.country_link2'])->update(['value' => $request->site_country_link2]);
			Settings::firstOrCreate(['key' => 'site.country_title3'])->update(['value' => $request->site_country_title3]);
			Settings::firstOrCreate(['key' => 'site.country_link3'])->update(['value' => $request->site_country_link3]);
			Settings::firstOrCreate(['key' => 'site.country_title4'])->update(['value' => $request->site_country_title4]);
			Settings::firstOrCreate(['key' => 'site.country_link4'])->update(['value' => $request->site_country_link4]);
			Settings::firstOrCreate(['key' => 'site.country_title5'])->update(['value' => $request->site_country_title5]);
			Settings::firstOrCreate(['key' => 'site.country_link5'])->update(['value' => $request->site_country_link5]);
			Settings::firstOrCreate(['key' => 'site.country_title6'])->update(['value' => $request->site_country_title6]);
			Settings::firstOrCreate(['key' => 'site.country_link6'])->update(['value' => $request->site_country_link6]);
			Settings::firstOrCreate(['key' => 'site.country_title7'])->update(['value' => $request->site_country_title7]);
			Settings::firstOrCreate(['key' => 'site.country_link7'])->update(['value' => $request->site_country_link7]);
			Settings::firstOrCreate(['key' => 'site.country_title8'])->update(['value' => $request->site_country_title8]);
			Settings::firstOrCreate(['key' => 'site.country_link8'])->update(['value' => $request->site_country_link8]);
			Settings::firstOrCreate(['key' => 'site.country_title9'])->update(['value' => $request->site_country_title9]);
			Settings::firstOrCreate(['key' => 'site.country_link9'])->update(['value' => $request->site_country_link9]);
			Settings::firstOrCreate(['key' => 'site.country_title10'])->update(['value' => $request->site_country_title10]);
			Settings::firstOrCreate(['key' => 'site.country_link10'])->update(['value' => $request->site_country_link10]);

			if($request->hasfile('site_footer_logo'))
			{
				$site_footer_logo = config('site.footer_logo');
				if($site_footer_logo!='' && file_exists(public_path().'/uploads/'.$site_footer_logo))
				{
					unlink(public_path().'/uploads/'.$site_footer_logo);
				}
				$site_footer_logo = $request->file('site_footer_logo');
				$filename = $site_footer_logo->getClientOriginalName();
				$extension = $site_footer_logo->getClientOriginalExtension();

				if($extension == "webp"){
				$filename = create_seo_link($filename);
				$filename = time().'_'.$filename;
				$site_footer_logo->move(public_path().'/uploads/', $filename);
				}else{
					return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
				}
				if ($filename) {
					Settings::firstOrCreate(['key' => 'site.footer_logo'])->update(['value' => $filename]);
				}

			}
			if($request->hasfile('site_mobilelogo'))
			{
				$site_mobilelogo = config('site.mobilelogo');
				if($site_mobilelogo!='' && file_exists(public_path().'/uploads/'.$site_mobilelogo))
				{
					unlink(public_path().'/uploads/'.$site_mobilelogo);
				}
				$site_mobilelogo = $request->file('site_mobilelogo');
				$filename = $site_mobilelogo->getClientOriginalName();
				$extension = $site_mobilelogo->getClientOriginalExtension();

				if($extension == "webp"){
					$filename = create_seo_link($filename);
					$filename = time().'_'.$filename;
					$site_mobilelogo->move(public_path().'/uploads/', $filename);
				}else{
					return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
				}
				if ($filename) {
					Settings::firstOrCreate(['key' => 'site.mobilelogo'])->update(['value' => $filename]);
				}
			}
			Settings::firstOrCreate(['key' => 'site.whatsapp'])->update(['value' => $request->site_whatsapp]);
			return redirect()->back()->with('success', 'Data has been updated successfully.');

		} catch (\Exception $e) {
			DB::rollback();
			return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
		}

		}

	}

	public function delete($key)
	{
		if ($key=='site_logo') {
			$site_logo = Settings::where('id',2)->first();
			if($site_logo->value!='' && file_exists(public_path().'/uploads/'.$site_logo->value))
			{
				unlink(public_path().'/uploads/'.$site_logo->value);
			}
			Settings::where('id', '2')->update(['value' => '']);
		}elseif ($key=='site_meta_image') {
			$site_meta_image = Settings::where('id',8)->first();

			if($site_meta_image->value!='' && file_exists(public_path().'/uploads/'.$site_meta_image->value))
			{
				unlink(public_path().'/uploads/'.$site_meta_image->value);
			}
			Settings::where('id', '8')->update(['value' => '']);
		}
		return redirect()->back()->with('success', 'File has been deleted successfully.');
	}

	public function profile()
	{
		$list = currentUserDetails();
		return view('admin.profile', compact('list'));
	}

	/* Update Profile Post*/
	public function profileUpdate(Request $request)
	{
		$id = $request->id;
		$fname = $request->fname;
		$lname = $request->lname;
		$name = trim($fname.' '.$lname);
		$email = $request->email;
		// $username = $request->username;
		$phone_number = $request->phone_number;
		$password = $request->password;

		$user = currentUserDetails();
		if ($id != $user->id) {
			\Session::flash('message', 'Sorry, Profile is not updated! Please try again.');
			return redirect()->back();
		}

		$rules = array(
			'fname' => 'required|string|max:191',
			'email' => 'required|string|email|max:191|unique:users,email,' . $id,
			// 'phone_number' => 'required|int|min:10',
			//'password' => 'required',
		);

		if ($request->hasfile('avatar')) {
			$rules['avatar'] = 'mimes:webp|max:2048';
		}

		if($password)
		{
			$rules['password'] = 'min:8|confirmed|regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/';
		}

		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails()) {
			return redirect()->back()->withErrors($validator)->withInput(request()->except('password'));
		} else {
			$user = User::where('id',$user->id)->first();
			if ($request->hasfile('avatar')) {
				if ($user->avatar != '' && file_exists(public_path() . '/uploads/' . $user->avatar)) {
					unlink(public_path() . '/uploads/' . $user->avatar);
				}
				$avatar = $request->file('avatar');
				$filename = $avatar->getClientOriginalName();
				$extension = $avatar->getClientOriginalExtension();
				if($extension == "webp"){
				$filename = create_seo_link($filename);
				$filename = time().'_'.$filename;
				$avatar->move(public_path() . '/uploads/', $filename);
				//$update_array['avatar'] = $filename;
				$user->avatar = $filename;
				}else{
					return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
				}
			}

			$user->fname = $fname;
			$user->lname = $lname;
			$user->name = $name;
			// $user->email = $email;
			$user->phone_number = $phone_number;
			if($password)
			{
				$user->password = Hash::make($password);
			}
			$user->save();

			//$msg = 'Your account has been updated successfully.';
			return redirect()->back()->with('success', 'Data has been updated successfully.');
		}
	}

	// Header Settings
	public function headerSettings(){
		return view('admin.header_settings');
	}
	public function footerSettings(){
		$all_pages = Page::oldest('page_name')->get();
		$service_pages = Page::where('posttype', 'service')->get();
		$page_pages = Page::where('posttype', 'page')->get();
		return view('admin.footer_settings', compact('all_pages', 'service_pages', 'page_pages'));

	}

	//header settings update
	public function headerSettingsUpdate(Request $request)
	{
		$rules = array(
			'site_meta_title' => 'required|string|max:255',
		); 

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to(Admin_Prefix.'header-settings/')->withErrors($validator)->withInput(); 
		}
		else
		{
		try {
			Settings::where('id', '5')->update(['value' => $request->site_meta_title]);
			Settings::where('id', '6')->update(['value' => $request->site_meta_keyword]);
			Settings::where('id', '7')->update(['value' => $request->site_meta_description]);
			Settings::where('id', '15')->update(['value' => $request->site_google_analytics]);
			if($request->hasfile('site_meta_image'))
			{
				$site_meta_image = config('site.meta_image');
				if($site_meta_image!='' && file_exists(public_path().'/uploads/'.$site_meta_image))
				{
					unlink(public_path().'/uploads/'.$site_meta_image);
				}
				$site_meta_image = $request->file('site_meta_image');
				$filename = $site_meta_image->getClientOriginalName();
				$extension = $site_meta_image->getClientOriginalExtension();
				if($extension == "webp"){
				$filename = create_seo_link($filename);
				$filename = time().'_'.$filename;
				$site_meta_image->move(public_path().'/uploads/', $filename);  
				}else{
					return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
				}
				if ($filename) {
					Settings::where('id', '8')->update(['value' => $filename]);
				}
			}
			Settings::firstOrCreate(['key' => 'site.meta_tag'])->update(['value' => $request->site_meta_tag]);
			Settings::firstOrCreate(['key' => 'site.language_meta_tag'])->update(['value' => $request->site_language_meta_tag]);
			// Settings::firstOrCreate(['key' => 'site.charset_tag'])->update(['value' => $request->site_charset_tag]);
			// Settings::firstOrCreate(['key' => 'site.view_port_tag'])->update(['value' => $request->site_view_port_tag]);
			Settings::firstOrCreate(['key' => 'site.index_tag'])->update(['value' => $request->site_index_tag]);
			Settings::firstOrCreate(['key' => 'site.author_tag'])->update(['value' => $request->site_author_tag]);

			Settings::firstOrCreate(['key' => 'site.copyright_tag'])->update(['value' => $request->site_copyright_tag]);
			Settings::firstOrCreate(['key' => 'site.revisit_after_tag'])->update(['value' => $request->site_revisit_after_tag]);
			Settings::firstOrCreate(['key' => 'site.rating_tag'])->update(['value' => $request->site_rating_tag]);
			Settings::firstOrCreate(['key' => 'site.canonical_tag'])->update(['value' => $request->site_canonical_tag]);

			Settings::firstOrCreate(['key' => 'site.open_graph_title_tag'])->update(['value' => $request->site_open_graph_title_tag]);
			Settings::firstOrCreate(['key' => 'site.open_graph_description_tag'])->update(['value' => $request->site_open_graph_description_tag]);
			Settings::firstOrCreate(['key' => 'site.open_graph_image'])->update(['value' => $request->site_open_graph_image]);
			
			Settings::firstOrCreate(['key' => 'site.open_graph_url_tag'])->update(['value' => $request->site_open_graph_url_tag]);			
			Settings::firstOrCreate(['key' => 'site.open_graph_type_tag'])->update(['value' => $request->site_open_graph_type_tag]);			
			Settings::firstOrCreate(['key' => 'site.open_graph_site_name_tag'])->update(['value' => $request->site_open_graph_site_name_tag]);

			Settings::firstOrCreate(['key' => 'site.twitter_card_tag'])->update(['value' => $request->site_twitter_card_tag]);			
			Settings::firstOrCreate(['key' => 'site.twitter_site_tag'])->update(['value' => $request->site_twitter_site_tag]);			
			Settings::firstOrCreate(['key' => 'site.twitter_title_tag'])->update(['value' => $request->site_twitter_title_tag]);			
			Settings::firstOrCreate(['key' => 'site.twitter_description_tag'])->update(['value' => $request->site_twitter_description_tag]);		
			Settings::firstOrCreate(['key' => 'site.twitter_image'])->update(['value' => $request->site_twitter_image]);		
			
			Settings::firstOrCreate(['key' => 'site.geo_graphic_region_tag'])->update(['value' => $request->site_geo_graphic_region_tag]);
			Settings::firstOrCreate(['key' => 'site.geo_graphic_position_tag'])->update(['value' => $request->site_geo_graphic_position_tag]);
			Settings::firstOrCreate(['key' => 'site.geo_graphic_placename_tag'])->update(['value' => $request->site_geo_graphic_placename_tag]);

			Settings::firstOrCreate(['key' => 'site.facebook_title_tag'])->update(['value' => $request->site_facebook_title_tag]);
			Settings::firstOrCreate(['key' => 'site.facebook_description_tag'])->update(['value' => $request->site_facebook_description_tag]);
			Settings::firstOrCreate(['key' => 'site.facebook_image'])->update(['value' => $request->site_facebook_image]);
			
			Settings::firstOrCreate(['key' => 'site.facebook_url_tag'])->update(['value' => $request->site_facebook_url_tag]);
			Settings::firstOrCreate(['key' => 'site.facebook_type_tag'])->update(['value' => $request->site_facebook_type_tag]);

			// Settings::firstOrCreate(['key' => 'site.twitter_card_tag'])->update(['value' => $request->site_twitter_card_tag]);
			// Settings::firstOrCreate(['key' => 'site.twitter_site_tag'])->update(['value' => $request->site_twitter_site_tag]);
			// Settings::firstOrCreate(['key' => 'site.twitter_title_tag'])->update(['value' => $request->site_twitter_title_tag]);
			// Settings::firstOrCreate(['key' => 'site.twitter_description_tag'])->update(['value' => $request->site_twitter_description_tag]);
			// Settings::firstOrCreate(['key' => 'site.twitter_image'])->update(['value' => $request->site_twitter_image]);

			Settings::firstOrCreate(['key' => 'site.linkedIn_title_tag'])->update(['value' => $request->site_linkedIn_title_tag]);
			Settings::firstOrCreate(['key' => 'site.linkedIn_description_tag'])->update(['value' => $request->site_linkedIn_description_tag]);
			Settings::firstOrCreate(['key' => 'site.linkedIn_image'])->update(['value' => $request->site_linkedIn_image]);
			
			Settings::firstOrCreate(['key' => 'site.linkedIn_url_tag'])->update(['value' => $request->site_linkedIn_url_tag]);
			Settings::firstOrCreate(['key' => 'site.linkedIn_type_tag'])->update(['value' => $request->site_linkedIn_type_tag]);


			Settings::firstOrCreate(['key' => 'site.instagram_title_tag'])->update(['value' => $request->site_instagram_title_tag]);
			Settings::firstOrCreate(['key' => 'site.instagram_description_tag'])->update(['value' => $request->site_instagram_description_tag]);
			Settings::firstOrCreate(['key' => 'site.instagram_image'])->update(['value' => $request->site_instagram_image]);
			
			Settings::firstOrCreate(['key' => 'site.instagram_url_tag'])->update(['value' => $request->site_instagram_url_tag]);
			Settings::firstOrCreate(['key' => 'site.instagram_type_tag'])->update(['value' => $request->site_instagram_type_tag]);

			Settings::firstOrCreate(['key' => 'site.verification_tag_1'])->update(['value' => $request->site_verification_tag_1]);
			Settings::firstOrCreate(['key' => 'site.verification_tag_2'])->update(['value' => $request->site_verification_tag_2]);
			Settings::firstOrCreate(['key' => 'site.verification_tag_3'])->update(['value' => $request->site_verification_tag_3]);
			Settings::firstOrCreate(['key' => 'site.verification_tag_4'])->update(['value' => $request->site_verification_tag_4]);

			Settings::firstOrCreate(['key' => 'site.custom_code_in_head_section_1'])->update(['value' => $request->site_custom_code_in_head_section_1]);
			Settings::firstOrCreate(['key' => 'site.custom_code_in_head_section_2'])->update(['value' => $request->site_custom_code_in_head_section_2]);
			Settings::firstOrCreate(['key' => 'site.custom_code_in_head_section_3'])->update(['value' => $request->site_custom_code_in_head_section_3]);
			Settings::firstOrCreate(['key' => 'site.custom_code_in_head_section_4'])->update(['value' => $request->site_custom_code_in_head_section_4]);

			Settings::firstOrCreate(['key' => 'site.header_nav_title1'])->update(['value' => $request->site_header_nav_title1]);
			Settings::firstOrCreate(['key' => 'site.header_nav_title2'])->update(['value' => $request->site_header_nav_title2]);
			Settings::firstOrCreate(['key' => 'site.header_nav_title3'])->update(['value' => $request->site_header_nav_title3]);
			Settings::firstOrCreate(['key' => 'site.header_nav_title4'])->update(['value' => $request->site_header_nav_title4]);
			Settings::firstOrCreate(['key' => 'site.header_nav_title5'])->update(['value' => $request->site_header_nav_title5]);

			Settings::firstOrCreate(['key' => 'site.header_nav_link1'])->update(['value' => $request->site_header_nav_link1]);
			Settings::firstOrCreate(['key' => 'site.header_nav_link2'])->update(['value' => $request->site_header_nav_link2]);
			Settings::firstOrCreate(['key' => 'site.header_nav_link3'])->update(['value' => $request->site_header_nav_link3]);
			Settings::firstOrCreate(['key' => 'site.header_nav_link4'])->update(['value' => $request->site_header_nav_link4]);
			Settings::firstOrCreate(['key' => 'site.header_nav_link5'])->update(['value' => $request->site_header_nav_link5]);

			Settings::firstOrCreate(['key' => 'site.header_nav_button_title1'])->update(['value' => $request->site_header_nav_button_title1]);
			Settings::firstOrCreate(['key' => 'site.header_nav_button_link1'])->update(['value' => $request->site_header_nav_button_link1]);

			return redirect()->back()->with('success', 'Data has been updated successfully.');

		} catch (\Exception $e) {
			DB::rollback();
			return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
		}

		}

	}
	public function footerSettingsUpdate(Request $request)
	{
		$rules = array(
		); 

		$validator = Validator::make($request->all() , $rules);

		if ($validator->fails())
		{
			return Redirect::to('header-settings/')->withErrors($validator)->withInput(); 
		}
		else
		{
		try {
			Settings::firstOrCreate(['key' => 'site.facebook_link'])->update(['value' => $request->site_facebook_link]);
			Settings::firstOrCreate(['key' => 'site.twitter_link'])->update(['value' => $request->site_twitter_link]);
			Settings::firstOrCreate(['key' => 'site.instagram_link'])->update(['value' => $request->site_instagram_link]);
			Settings::firstOrCreate(['key' => 'site.linkedin_link'])->update(['value' => $request->site_linkedin_link]);
			Settings::firstOrCreate(['key' => 'site.pinterest_link'])->update(['value' => $request->site_pinterest_link]);
			Settings::firstOrCreate(['key' => 'site.youtube_link'])->update(['value' => $request->site_youtube_link]);
			// Settings::firstOrCreate(['key' => 'site.copyright'])->update(['value' => $request->site_copyright]);
			// Settings::firstOrCreate(['key' => 'site.url'])->update(['value' => $request->site_url]);
			Settings::firstOrCreate(['key' => 'site.skype_link'])->update(['value' => $request->site_skype_link]);
			Settings::firstOrCreate(['key' => 'site.community_link'])->update(['value' => $request->site_community_link]);

			Settings::firstOrCreate(['key' => 'site.footer1_title'])->update(['value' => $request->site_footer1_title]);

			Settings::firstOrCreate(['key' => 'site.footer2_title'])->update(['value' => $request->site_footer2_title]);
			Settings::firstOrCreate(['key' => 'site.footer2_title1'])->update(['value' => $request->site_footer2_title1]);
			Settings::firstOrCreate(['key' => 'site.footer2_title6'])->update(['value' => $request->site_footer2_title6]);
			Settings::firstOrCreate(['key' => 'site.footer2_title7'])->update(['value' => $request->site_footer2_title7]);
			Settings::firstOrCreate(['key' => 'site.footer2_title8'])->update(['value' => $request->site_footer2_title8]);
			Settings::firstOrCreate(['key' => 'site.footer2_title2'])->update(['value' => $request->site_footer2_title2]);
			Settings::firstOrCreate(['key' => 'site.footer2_title3'])->update(['value' => $request->site_footer2_title3]);
			Settings::firstOrCreate(['key' => 'site.footer2_title4'])->update(['value' => $request->site_footer2_title4]);
			Settings::firstOrCreate(['key' => 'site.footer2_title5'])->update(['value' => $request->site_footer2_title5]);

			Settings::firstOrCreate(['key' => 'site.footer3_title'])->update(['value' => $request->site_footer3_title]);
			Settings::firstOrCreate(['key' => 'site.footer3_title1'])->update(['value' => $request->site_footer3_title1]);
			Settings::firstOrCreate(['key' => 'site.footer3_title2'])->update(['value' => $request->site_footer3_title2]);
			Settings::firstOrCreate(['key' => 'site.footer3_title3'])->update(['value' => $request->site_footer3_title3]);
			Settings::firstOrCreate(['key' => 'site.footer3_title4'])->update(['value' => $request->site_footer3_title4]);
			Settings::firstOrCreate(['key' => 'site.footer3_title5'])->update(['value' => $request->site_footer3_title5]);
			Settings::firstOrCreate(['key' => 'site.footer3_title6'])->update(['value' => $request->site_footer3_title6]);
			Settings::firstOrCreate(['key' => 'site.footer3_title7'])->update(['value' => $request->site_footer3_title7]);
			Settings::firstOrCreate(['key' => 'site.footer3_title8'])->update(['value' => $request->site_footer3_title8]);

			Settings::firstOrCreate(['key' => 'site.footer4_title'])->update(['value' => $request->site_footer4_title]);
			Settings::firstOrCreate(['key' => 'site.resource_title1'])->update(['value' => $request->site_resource_title1]);
			Settings::firstOrCreate(['key' => 'site.resource_link1'])->update(['value' => $request->site_resource_link1]);
			Settings::firstOrCreate(['key' => 'site.resource_title2'])->update(['value' => $request->site_resource_title2]);
			Settings::firstOrCreate(['key' => 'site.resource_link2'])->update(['value' => $request->site_resource_link2]);
			Settings::firstOrCreate(['key' => 'site.resource_title3'])->update(['value' => $request->site_resource_title3]);
			Settings::firstOrCreate(['key' => 'site.resource_link3'])->update(['value' => $request->site_resource_link3]);
			Settings::firstOrCreate(['key' => 'site.resource_title4'])->update(['value' => $request->site_resource_title4]);
			Settings::firstOrCreate(['key' => 'site.resource_link4'])->update(['value' => $request->site_resource_link4]);
			Settings::firstOrCreate(['key' => 'site.resource_title5'])->update(['value' => $request->site_resource_title5]);
			Settings::firstOrCreate(['key' => 'site.resource_link5'])->update(['value' => $request->site_resource_link5]);
			Settings::firstOrCreate(['key' => 'site.resource_title6'])->update(['value' => $request->site_resource_title6]);
			Settings::firstOrCreate(['key' => 'site.resource_link6'])->update(['value' => $request->site_resource_link6]);
			Settings::firstOrCreate(['key' => 'site.resource_title7'])->update(['value' => $request->site_resource_title7]);
			Settings::firstOrCreate(['key' => 'site.resource_link7'])->update(['value' => $request->site_resource_link7]);
			Settings::firstOrCreate(['key' => 'site.resource_title8'])->update(['value' => $request->site_resource_title8]);
			Settings::firstOrCreate(['key' => 'site.resource_link8'])->update(['value' => $request->site_resource_link8]);

			Settings::firstOrCreate(['key' => 'site.footer5_title'])->update(['value' => $request->site_footer5_title]);
			// Settings::firstOrCreate(['key' => 'site.meta_tag'])->update(['value' => $request->site_meta_tag]);

			$exclude_stuctured_data = '';
			if ($request->exclude_stuctured_data) {
				$exclude_stuctured_data = implode(',', $request->exclude_stuctured_data);
			}
			Settings::firstOrCreate(['key' => 'site.exclude_stuctured_data'])->update(['value' => $exclude_stuctured_data]);

			Settings::firstOrCreate(['key' => 'site.important_links1'])->update(['value' => $request->site_important_links1]);
			Settings::firstOrCreate(['key' => 'site.important_links2'])->update(['value' => $request->site_important_links2]);
			Settings::firstOrCreate(['key' => 'site.important_links3'])->update(['value' => $request->site_important_links3]);
			Settings::firstOrCreate(['key' => 'site.important_links4'])->update(['value' => $request->site_important_links4]);
			Settings::firstOrCreate(['key' => 'site.important_links5'])->update(['value' => $request->site_important_links5]);
			Settings::firstOrCreate(['key' => 'site.important_links6'])->update(['value' => $request->site_important_links6]);
			Settings::firstOrCreate(['key' => 'site.important_links7'])->update(['value' => $request->site_important_links7]);
			Settings::firstOrCreate(['key' => 'site.important_links8'])->update(['value' => $request->site_important_links8]);
			Settings::firstOrCreate(['key' => 'site.important_links9'])->update(['value' => $request->site_important_links9]);
			Settings::firstOrCreate(['key' => 'site.important_links10'])->update(['value' => $request->site_important_links10]);
			Settings::firstOrCreate(['key' => 'site.important_links11'])->update(['value' => $request->site_important_links11]);
			if($request->hasfile('site_payment_methods'))
			{
				$site_payment_methods = config('site.payment_methods');
				if($site_payment_methods!='' && file_exists(public_path().'/uploads/'.$site_payment_methods))
				{
					unlink(public_path().'/uploads/'.$site_payment_methods);
				}
				$site_payment_methods = $request->file('site_payment_methods');
				$filename = $site_payment_methods->getClientOriginalName();
				$extension = $site_payment_methods->getClientOriginalExtension();
				if($extension == "webp"){
				$filename = create_seo_link($filename);
				$filename = time().'_'.$filename;
				$site_payment_methods->move(public_path().'/uploads/', $filename);  
				}else{
					return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
				}
				if ($filename) {
					Settings::firstOrCreate(['key' => 'site.payment_methods'])->update(['value' => $filename]);
				}
			}

			if($request->hasfile('site_buy_with_confidence'))
			{
				$site_buy_with_confidence = config('site.buy_with_confidence');
				if($site_buy_with_confidence!='' && file_exists(public_path().'/uploads/'.$site_buy_with_confidence))
				{
					unlink(public_path().'/uploads/'.$site_buy_with_confidence);
				}
				$site_buy_with_confidence = $request->file('site_buy_with_confidence');
				$filename = $site_buy_with_confidence->getClientOriginalName();
				$extension = $site_buy_with_confidence->getClientOriginalExtension();
				if($extension == "webp"){
				$filename = create_seo_link($filename);
				$filename = time().'_'.$filename;
				$site_buy_with_confidence->move(public_path().'/uploads/', $filename);  
				}else{
					return Redirect::back()->withErrors(['default' => "Images must be .webp, please check extension"])->withInput();
				}
				if ($filename) {
					Settings::firstOrCreate(['key' => 'site.buy_with_confidence'])->update(['value' => $filename]);
				}
			}				

			Settings::firstOrCreate(['key' => 'site.copyright'])->update(['value' => $request->site_copyright]);

			return redirect()->back()->with('success', 'Data has been updated successfully.');

		} catch (\Exception $e) {
			DB::rollback();
			return Redirect::back()->withErrors(array('errordetailsd' => $e->getMessage()))->withInput($request->all());
		}

		}

	}



}