<?php
// use Session;
// use Auth;
// use Redirect;
session_start();

use App\Models\User;
use App\Models\Role;
use App\Models\Page; 
use App\Models\PageExtra;
use App\Models\Settings;
use App\Models\Visitor;
use App\Models\Cities; 
use App\Models\Business;
use Illuminate\Support\Str;

$currency_with_code_array = array('usd' => 'USD');
$currency_with_icon_array = array('usd' => '$');
define("Currency_With_Code_Array", serialize($currency_with_code_array));
define("Currency_With_Icon_Array", serialize($currency_with_icon_array));

$_SESSION['currency'] = (isset($_SESSION['currency']) && in_array($_SESSION['currency'], $currency_with_code_array)) ? $_SESSION['currency'] : 'usd';
$_SESSION['session_id'] = (isset($_SESSION['session_id'])) ? $_SESSION['session_id'] : session_id();

define("Admin_Prefix", "admin/");
define("Short_Description_Length", "180");
define("Short_Title_Length", "20");
define("Blog_ID", 5);
define("Privacy_Policy_ID", 8);
define("Terms_Conditions_ID", 9);
define("Category_Prefix", "category/");
define("Tag_Prefix", "tag/");
define("Service_Page_ID", 33);
define("Seo_Page_ID", 431);
define("City_Service_Page_ID", 184);
define("Development_Page_ID", 89);
define("Pricing_Page_ID", 92);
define("Portfolio_Page_ID", 709);
define("CaseStudy_Page_ID", 670);
define("Development_Pricing_Page_ID", 93);
define("Category_Default_Page_ID", 0);
define("FAQ_Page_ID", 35);
define("Not_Deletable_Page_ID", [1,33,35,175,670,709]);
define("Not_viewable_Page_ID", [28,398]);

$page_display_in_array = array('0'=>'None', '1'=>'Main Menu', '2'=>'Mega Menu', '3'=>'Footer Services', '4'=>'Footer Resources', '5'=>'Footer', '6'=>'Main Menu & Footer', '9'=>'Main Menu & Resources', '8'=>'Mega Menu & Resources', '10'=>'Mega Menu & Services', '7'=>'All');

$header_display_in_array = array('0'=>'None', '1'=>'Main Menu', '2'=>'Mega Menu');

define("Page_Display_In_Array", serialize($page_display_in_array));
define("Header_Display_In_Array", serialize($header_display_in_array));

$user_status_array = array('0'=>'Inactive', '1'=>'Active');//, '2'=>'Delete'
define("User_Status_Array", serialize($user_status_array));

$status_array = array('0'=>'Inactive', '1'=>'Active');
define("Status_Array", serialize($status_array));

$job_status_array = array('0'=>'Pending','1'=>'Publish','2'=>'Contract','3'=>'Withdraw Contract','4'=>'Completed','5'=>'Rejected');
define("Job_Status_Array", serialize($job_status_array));

$proposal_status_array = array('0'=>'Pending','1'=>'Shortlisted/Save','2'=>'Hire','3'=>'Rejected','4'=>'Not fit');
define("Proposal_Status_Array", serialize($proposal_status_array));

$job_proposals_status_array = array('0'=>'Pending','1'=>'Shortlisted/Save','2'=>'Hire','3'=>'Rejected','4'=>'Not fit');
define("Job_Proposals_Status_Array", serialize($job_proposals_status_array));

$payment_status_array = array('1'=>'Paid', '3'=>'Free');//'0'=>'Unpaid', '2' => 'Failed',
define("Payment_Status_Array", serialize($payment_status_array));

$comment_status_array = array('0'=>'Pending','1'=>'Approved','2'=>'Rejected');
define("Comment_Status_Array", serialize($comment_status_array));

$page_template_array = array(
	'0'=>'None',
	'1'=>'Home',
	'2'=>'Category',
	'3'=>'About Us',
	'4'=>'Terms and Conditions',
	'5'=>'Blog',
	'6'=>'Blog Details',
	'7'=>'Project',
	'8'=>'Project Details',
	'9'=>'Contact Us',
	'11'=>'Services',
	'12'=>'Resources',
	'13'=>'Pricing',
	'14'=>'Seo Landing',
	'15'=>'Sitemap',
	'16'=>'City Service',
	'17'=>'Business Service',
	'18'=>'City Business Service',
	'19'=>'Case Studies',
	'20'=>'News',
	'21'=>'Media Coverage',
	'22'=>'News Details',
	'23'=>'Portfolio',
);//,'3'=>'','4'=>'','9'=>'New Address','10'=>'Update Address','11'=>'New Group','12'=>'Edit Group','13'=>'New Message','14'=>'Edit Message'
define("Page_Template_Array", serialize($page_template_array));

$page_section_array = array(
  '0'=>'None',
  '1'=>'1. Banner',
  '2'=>'2. Title',
  '3'=>'3. Image',
  '4'=>'4. Content',
  '5'=>'5. Button',
  '6'=>'6. Button Text Only',
  '7'=>'7. Title & Button',
  '8'=>'8. Title & Sub Title',
  '9'=>'9. Title, Sub Title & Image',
  '10'=>'10. Title, Sub Title, Image & Button',
  '11'=>'11. Title, Sub Title, Image & Image2',
  '12'=>'12. Title, Sub Title, Image, Image2 & Button',
  '13'=>'13. Title & Content',
  '14'=>'14. Title, Sub Title & Content',
  '15'=>'15. Title, Sub Title, Content & Button',
  '16'=>'16. Title, Sub Title, Image & Content',
  '17'=>'17. Title, Sub Title, Image, Content & Button',
  '18'=>'18. Title, Sub Title, Image, Image2 & Content',
  '19'=>'19. Title, Sub Title, Image, Image2, Content & Button',
  '20'=>'20. Title, Location, Phone & Email',
  '21'=>'21. Title, Image & Content',
  '22'=>'22. Title, Content & Button',
  '23'=>'23. Title, Content , Image, Image2 & Parent',
  '24'=>'24. Image, Video & Video Url',
  '25'=>'25. Seo Details',
  '26'=>'26. Excel',
  '27'=>'27. Dropdown, Title, Sub title, Title1, Subtitle, Content & Button',
);
define("Page_Section_Array", serialize($page_section_array));

$package_section_array = array(
	'0' => 'None',
	'1' => '1. Title, Sub title, Main Price, Discount Price, Discount Price Subtitle, Content & Button',
	'2' => '2. Heading',
	'3' => '3. Text'
  );
  define("Package_Section_Array", serialize($package_section_array));

  function Currency()
{
	$currency = '₹';
	return $currency;
}

function get_jobid()
{
	$return = uniqid();
	$checkApplication = HfJob::firstWhere(['job_number'  => $return]);
	if ($checkApplication) {
		$time = (int) microtime(true);
		$return = uniqid().$time;
	}
	$return = strtoupper($return);
	return $return;
}

if (!function_exists('get_fields_value')) {
	function get_fields_value_where($tbl_nm, $where, $orderby = "", $order = 'desc',$limit = "") {
		if(!$orderby)
		{
			$orderby = 'id';
		}
		if($limit){
			$data = DB::table($tbl_nm)->whereRaw($where)->orderBy($orderby, $order)->limit($limit)->get();
		}else{
			$data = DB::table($tbl_nm)->whereRaw($where)->orderBy($orderby, $order)->get();
		}
		return @$data;
	}
}


if (!function_exists('get_menu_display')) {
	function get_menu_display($tbl_nm, $where, $orderby = "", $order = 'desc',$limit = "",$status = '1') {
		if(!$orderby)
		{
			$orderby = 'id';
		}
		if($limit){
			$data = DB::table($tbl_nm)->whereRaw($where)->orderBy($orderby, $order)->where('status','1')->limit($limit)->get();
		}else{
			$data = DB::table($tbl_nm)->whereRaw($where)->orderBy($orderby, $order)->where('status','1')->get();
		}
		return @$data;
	}
}

if (!function_exists('get_field_value')) {
	function get_field_value($tbl_nm, $fld_nm, $search_fld, $row_id, $orderby = "", $order = 'desc',$limit = "") {
		$data = DB::table($tbl_nm)->where($search_fld, $row_id)->first();
		return @$data->$fld_nm;
	}
}

if (!function_exists('get_fields_value')) {
	function get_fields_value($tbl_nm, $search_fld, $row_id, $orderby = "", $order = 'desc',$limit = "") {
		if(!$orderby)
		{
			$orderby = 'id';
		}
		if($limit){
			$data = DB::table($tbl_nm)->where($search_fld, $row_id)->orderBy($orderby, $order)->limit($limit)->get();
		}else{
			$data = DB::table($tbl_nm)->where($search_fld, $row_id)->orderBy($orderby, $order)->get();
		}
		return @$data;
	}
}

if (!function_exists('get_page')) {
	function get_page($page_id) {
		$return = Page::where('id',$page_id)->where('status','1')->first();
		return $return;
	}
}

if (!function_exists('get_page_extra')) {
	function get_page_extra($page_id) {
		$return = false;
		$extra_data = PageExtra::where('page_id',$page_id)->orderBy('rank', 'asc')->get();
		if ($extra_data->count()>0) {
			$return = $extra_data;
		}
		return $return;
	}
}


if (!function_exists('defineOptions')) {
	function defineOptions() {
		$settings = Settings::all();
        foreach($settings as $setting)
        {
            config([$setting->key => $setting->value]);
            // define("$setting->key", $setting->value);

	        $currency_with_icon_array = unserialize(Currency_With_Icon_Array);
	        $currency = $currency_with_icon_array[$_SESSION['currency']];
	        config(['currency' => $currency]);
        }
	}
}

if (!function_exists('date_convert')) {
	function date_convert($date, $date_format=1){
	  $unx_stamp = strtotime($date);
	  $blank='';
	  if($date!=''){
	  	switch ($date_format) {
	  		case '1':
	  			$date_str = (date("d/m/Y", $unx_stamp));
	  			break;
	  		case '2':
	  			$date_str = (date("d/m/Y,  h:i A", $unx_stamp));
	  			break;
	  		case '3':
	  			$date_str = (date("F jS, Y", $unx_stamp));
	  			break;
	  		case '4':
	  			$date_str = (date("F jS, Y, h:i A", $unx_stamp));
	  			break;
	  		case '5':
	  			$date_str = (date("m/d/Y", $unx_stamp));
	  			break;
	  		case '6':
	  			if (date("Y", $unx_stamp)==date("Y")) {
	  				$date_str = (date("D, M d", $unx_stamp)); // Thu, Nov 05
	  			}else{
	  				$date_str = (date("D, M d, Y", $unx_stamp)); // Thu, Nov 05, 2021
	  			}
	  			break;
	  		case '7':
	  			$date_str = (date("M d, Y", $unx_stamp)); // Nov 05, 2021
	  			break;
	  		case '8':
	  			$date_str = (date("d M, Y", $unx_stamp)); // 05 Nov, 2021
	  			break;
	  		case '9':
	  			$date_str = (date("h:iA", $unx_stamp)); // 05 Nov, 2021
	  			break;
	  		case '10':
	  			$date_str = (date("Y-m-d", $unx_stamp)); // 05 Nov, 2021
	  			break;
	  		case '11':
	  			$date_str = (date("Y-m-d H:i:s", $unx_stamp)); // 05 Nov, 2021
	  			break;
	  		default:
	  			$date_str = (date("d-m-Y", $unx_stamp));
	  			break;
	  	}
	   return $date_str;
	  }else{
	    return $blank;
	  }
	}
}
//->with('avg_rating')
if (!function_exists('userDetails')) {
	function userDetails($id) {
		$user = User::select('users.*','roles.display_name as role_name')
				->join('roles', 'users.role_id', '=', 'roles.id')
				->whereRaw("users.status!='2' and users.id='".$id."'")
				->orderBy('users.id', 'desc')
				// ->limit(1)
				->first();
		if (isset($user) && $user->count()>0) {
			$avatar_url = ( $user->avatar && File::exists(public_path('uploads/'.$user->avatar)) ) ? asset('/uploads/'.$user->avatar) : asset('/frontend/images/Group2094.png');
			$user->avatar_url = $avatar_url;
			//$user->average_rating = round($user->ratings()->avg('rating'),1);
			//$user->total_review = $user->ratings()->avg('rating');
			$retVal = $user;
		}else{
			$retVal = array();
		}
		return $retVal;
	}
}

if (!function_exists('currentUserDetails')) {
	function currentUserDetails() {
		if (Auth::check()){
			$user = Auth::user();
			// $userDetails = ($user->role_id!='1') ? userDetails($user->id) : $user ;
			$userDetails = userDetails($user->id);
		}else{
			$userDetails = array();
		}
		return $userDetails;
	}
}

if (!function_exists('random_strings')) {
	function random_strings($length_of_string=8)
	{
	    $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
	    return substr(str_shuffle($str_result), 0, $length_of_string);
	}
}

if (!function_exists('description_show')) {
	function description_show($description, $Short_Description_Length = Short_Description_Length)
	{
		$description = strip_tags($description);
	    $str_length = strlen($description);
	    if ($Short_Description_Length<$str_length) {
	    	$return = ''.substr($description, 0, $Short_Description_Length).'...';
	    	//$return .= '<div class="longDesc">'.$description.'</div>';<div class="shortDesc"></div>
	    }else{
	    	$return = ''.$description.'';//<div class="shortDesc"></div>
	    }
	    return $return;
	}
}

if (!function_exists('get_short_name')) {
	function get_short_name($name, $Short_Title_Length = Short_Title_Length)
	{
		$return = $name;
		$return = Str::limit($return, $Short_Title_Length);
	    return $return;
	}
}

if (!function_exists('create_seo_link')) {
	function create_seo_link($text) {
		$text = str_replace("(", "-", $text);
		$text = str_replace(")", "-", $text);
		$text = str_replace("'", "-", $text);
		$text = str_replace("`", "-", $text);
		$text = str_replace(" ", "-", $text);
		$text = str_replace('"', "-", $text);
		//$text = str_replace(".", "-", $text);
		$text = str_replace("/", "-", $text);
		$text = str_replace(",", "-", $text);
		$text = str_replace("=", "-", $text);
		$text = str_replace("+", "-", $text);
		$text = str_replace("$", "-", $text);
		$text = str_replace("&", "and", $text);
		$text = str_replace("#", "-", $text);
		$text = str_replace("%", "-", $text);
		$text = str_replace(" ", "-", $text);
		$text = str_replace(":", "-", $text);
		$text = str_replace("--", "-", $text);
		$text=str_replace("|","-",$text);
		$text = str_replace("\andquot;", "-", $text);
		$text = str_replace(";", "-", $text);
		$text = strtolower($text);
		return $text;
	}
}

if (!function_exists('addVisitor')) {
	function addVisitor()
	{
		$ip_address = request()->ip();
		$visit = Visitor::firstOrNew(['ip_address' => $ip_address]);
		$no_of_visit = (isset($visit->no_of_visit) && $visit->no_of_visit>0) ? $visit->no_of_visit+1 : 1 ;
		$visit->no_of_visit = $no_of_visit;
		$visit->save();
		$return = ['visit'=>$visit, 'total_visit'=>Visitor::whereNotNull('ip_address')->count()];
	    return $return;
	}
}

if (!function_exists('getVisitor')) {
	function getVisitor()
	{
		$ip_address = request()->ip();
		$visit = Visitor::firstOrNew(['ip_address' => $ip_address]);
		// $no_of_visit = (isset($visit->no_of_visit) && $visit->no_of_visit>0) ? $visit->no_of_visit+1 : 1 ;
		// $visit->no_of_visit = $no_of_visit;
		// $visit->save();
		$return = ['visit'=>$visit, 'total_visit'=>Visitor::whereNotNull('ip_address')->count()];
	    return $return;
	}
}
//++++++++++++++++++++++++++++++++++++++++++++++++
function get_blog($limit=3) {
	$return = Page::where('status','1')->where('posttype','blog')->latest()->limit($limit)->get();
	return $return;
}

// function get_live_visitor_data($tag='')
// {
//     $visitor_currency_code = '';
//     $visitor_country_code  = '';

//     $visitor_ip = request()->ip();
//     if ($visitor_ip != session('visitor_ip')) {
//         session()->forget('visitor_ip_data_arr');
//     }

// 	$user = currentUserDetails();
// 	if (session()->has('visitor_ip_data_arr')) {
//         $ip_data               = session('visitor_ip_data_arr');
//         $visitor_currency_code = $ip_data->geoplugin_currencyCode;
//         $visitor_country_code  = $ip_data->geoplugin_countryCode;
// 	}elseif ($user && isset($user->country)) {
// 		$visitor_currency_code = $user->country->currency;
// 		$visitor_country_code  = $user->country->iso2;
// 	}else {
//         $curl = curl_init();
//         curl_setopt_array($curl, array(
//             CURLOPT_URL            => 'http://www.geoplugin.net/json.gp?ip=' . $visitor_ip,
//             CURLOPT_RETURNTRANSFER => true,
//             CURLOPT_ENCODING       => '',
//             CURLOPT_MAXREDIRS      => 10,
//             CURLOPT_TIMEOUT        => 0,
//             CURLOPT_FOLLOWLOCATION => true,
//             CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
//             CURLOPT_CUSTOMREQUEST  => 'GET',
//         ));
//         $response = curl_exec($curl);
//         curl_close($curl);
//         session()->put('visitor_ip_data_arr', json_decode($response));
//         $ip_data               = session('visitor_ip_data_arr');
//         $visitor_currency_code = $ip_data->geoplugin_currencyCode;
//         $visitor_country_code  = $ip_data->geoplugin_countryCode;
// 	}
//     session()->put('visitor_ip', $visitor_ip);
//     session()->put('visitor_currency', $visitor_currency_code);
//     session()->put('visitor_country_code', $visitor_country_code);
// }

if (!function_exists('checkBusinessData')) {
	function checkBusinessData($slug) 
	{
		$businessExists = Business::where('slug', $slug)->exists();
			if($businessExists){
				$existBusiness = 4;
				return $existBusiness;
			}else{
			$pageData = Page::where('slug', $slug)->first();
			if($pageData){
				if ($pageData->posttype != 'service') {
					$existsVal = 1;
					return $existsVal;
				}
			  }
			}
	}
}

if (!function_exists('get_stuctured_data')) {
	function get_stuctured_data($page_id=0,$urlSegments) {
		$return = false;
		$numSegments = count($urlSegments);

		$businessName = '';
		$businessExists = '';
		$citiesExists = '';
		$bothExists = '';
		// if ($numSegments == 5) {
		// 	$businessName = $urlSegments[4];
		// 	$businessExists = Business::where('slug', $businessName)->exists();
		// 	$citiesExists = Cities::where('slug', $businessName)->exists();
		// }
		$checkCity = Request::segment(1);
		if($checkCity){
			$citiesExists = Cities::where('slug', $checkCity)->exists();
		}
		$checkingBusiness = Request::segment(2);
		if($checkCity){
			$businessExists = Business::where('slug', $checkingBusiness)->exists();
		}
		$checkBoth = Request::segment(3);
		if($checkBoth){
			$bothExists = Business::where('slug', $checkBoth)->exists();
		}
		$exclude_stuctured_data = config('site.exclude_stuctured_data')?explode(',', config('site.exclude_stuctured_data')):[];
        if (!in_array($page_id, $exclude_stuctured_data)) {
            $page = Page::where('id', $page_id)->first();

            if ($page !== null) { 
                $posttype = $page->posttype;
                $page_id = $page->id;

                if ($posttype == 'service') { 
                    $extra_data = get_page_extra_data($page->id); 
                } elseif($posttype == 'pricing'){
                    $extra_data = get_pricing_page_extra_data($page->id);
                } elseif($posttype == 'city-service' || $posttype == 'business-service' || $posttype == 'city-business-service'){
                    $extra_data = get_dynamic_page_extra_data($page->id);
					if($businessExists){

							foreach ($extra_data as $item) {
								$item->title = str_replace('{business}', $checkingBusiness, $item->title);
								$item->body = str_replace('{business}', $checkingBusiness, $item->body);
							}
					}elseif($citiesExists){
							foreach ($extra_data as $item) {
								$item->title = str_replace('{city}', $checkCity, $item->title);
								$item->body = str_replace('{city}', $checkCity, $item->body);
							}
					}
					if($citiesExists && $bothExists){
						foreach ($extra_data as $item) {
							$item->title = str_replace('{city}', $checkCity, $item->title);
							$item->body = str_replace('{city}', $checkCity, $item->body);
							$item->title = str_replace('{business}', $checkBoth, $item->title);
							$item->body = str_replace('{business}', $checkBoth, $item->body);
						}
					} 
					
				}elseif($page_id == 1) {
					$page_data = Page::where('id', FAQ_Page_ID)->first();
                    $extra_data = '';

                    if ($page_data !== null && $page_data->id != $page_id) {
                        $extra_data = get_page_extra($page_data->id);
                    }
                }else{
                    $extra_data = PageExtra::where('page_id', $page_id)
                        			->where(function ($query) {
                        				$query->where('type', 10)
                        					->orWhere('type', 9)
                        					->orWhere('type', 12)
                        					->orWhere('type', 11);
                        			})
                        			->where('section_type', 13)
                        			->where('status', 1)
                        			->orderBy('rank', 'asc')
                        			->get();
					$page = [];
				}
                $return = ['page' => $page, 'extra_data' => $extra_data];
            }
        }
		return $return;
	}
}

// if (!function_exists('getImageNameAlt')) {
// 	function getImageNameAlt($image_id)
// 	{
// 		$image_path = 'uploads/'.$image_id;
// 		$image_name = pathinfo($image_path, PATHINFO_FILENAME);
// 		$image_name_alt = substr($image_name, strpos($image_name, '_') + 1);

// 		return $image_name_alt;
// 	}
// }

if (!function_exists('getImageNameAlt')) {
    function getImageNameAlt($image_id)
    {
        $image_path = 'uploads/' . $image_id;
        $image_name = pathinfo($image_path, PATHINFO_FILENAME);

        $underscore_position = strpos($image_name, '_');

        if ($underscore_position !== false) {
            $image_name = substr($image_name, $underscore_position + 1);
        }

        $image_name = preg_replace('/[_-]/', ' ', $image_name); 
        $image_name = ucwords($image_name); 

        return $image_name;
    }
}




if (!function_exists('get_blog_stuctured_data')) {
	function get_blog_stuctured_data($page_id=0) {
		$return = false;
            $page = Page::where('id', $page_id)->where('posttype','blog')->first();
			// echo "<pre>";
			// print_r($page);exit;
            if ($page !== null) { // Check if $page is not null
                $posttype = $page->posttype;
                if ($posttype == 'blog') {
                    $extra_data = get_page_extra($page->id);
                }else{
                    $extra_data = '';
				} 
                $return = ['page' => $page, 'extra_data' => $extra_data];
				// echo "<pre>";
				// print_r($return);exit;
            }
		return $return;
	}
}

if (!function_exists('get_page_extra_data')) {
	function get_page_extra_data($page_id) {
		$return = false;
		$extra_data = PageExtra::where('page_id', $page_id)
			->where(function ($query) {
				$query->where('type', 31)
					->orWhere('type', 32);
			})
			->where('status', 1)
			->orderBy('rank', 'asc')
			->get();


		if ($extra_data->count()>0) {
			$return = $extra_data;
		}
		// echo "<pre>";
		// print_r($extra_data);exit;
		return $return;
	}
}
if (!function_exists('get_pricing_page_extra_data')) {
	function get_pricing_page_extra_data($page_id) {
		$return = false;
		$extra_data = PageExtra::where('page_id', $page_id)
			->where(function ($query) {
				$query->where('type', 18)
					->orWhere('type', 19);
			})
			->orderBy('rank', 'asc')
			->get();


		if ($extra_data->count()>0) {
			$return = $extra_data;
		}
		// echo "<pre>";
		// print_r($extra_data);exit;
		return $return;
	}
}

if (!function_exists('get_dynamic_page_extra_data')) {
	function get_dynamic_page_extra_data($page_id) {
		$return = false;
		$extra_data = PageExtra::where('page_id', $page_id)
			->where(function ($query) {
				$query->where('type', 26)
					->orWhere('type', 27);
			})
    ->orderBy('rank', 'asc')
    ->get();

		if ($extra_data->count()>0) {
			$return = $extra_data;
		}
		return $return;
	}
}


if (!function_exists('get_breadcrumb_data')) {
	function get_breadcrumb_data($page_id=0) {
    $return = false;
    $page = Page::where('id', $page_id)->where('status',1)->first();

    $resultArray = [];
    $position = 0;
    if ($page !== null) {
        $posttype = $page->posttype;
        $home_page = Page::where('id', 1)->first();
        if ($home_page) {
            $position++;
            $resultArray[] = ['name' => $home_page->page_name, 'url' => url('/'), 'position' => $position];
        }
        if ($posttype == 'service' || $posttype == 'pricing' || $posttype == 'city-service' || $posttype == 'business-service' || $posttype == 'city-business-service') {
            // No specific breadcrumb logic for these post types in the provided code
        } elseif ($posttype == 'blog') {
            $blogPage = Page::where('page_template', 5)->where('status',1)->first();
            if ($blogPage) {
                $position++;
                $resultArray[] = ['name' => $blogPage->page_name, 'url' => url($blogPage->slug), 'position' => $position];
            }
        } elseif ($posttype == 'news') {
            $news = Page::where('page_template', 20)->where('slug', 'news')->where('status',1)->first();
            if ($news) {
                $position++;
                $resultArray[] = ['name' => $news->page_name, 'url' => url($news->slug), 'position' => $position];
            }
        }
        
        // $parentPage = Page::where('id', $page->parent_id)->where('status',1)->first();
        // if ($parentPage) {
        //     $position++;
        //     $resultArray[] = ['name' => $parentPage->page_name, 'url' => url($parentPage->slug), 'position' => $position];
            
        // }
        if ($home_page && $page->id != $home_page->id) {
            if ($posttype == 'city-service' || $posttype == 'business-service' || $posttype == 'city-business-service') {
                $pageSlug = Page::where('id', $page->service_parent_id)->where('status',1)->first();

                if ($posttype == 'city-service') {
                    $position++;
                    $city_slug = request()->segment(1);
                    $citiesName = Cities::where('slug', $city_slug)->first();
                    $resultArray[] = ['name' => $page->page_name . ' in ' . $citiesName->city_name, 'url' => url("$city_slug/$pageSlug->slug"), 'position' => $position];
                }

                if ($posttype == 'business-service') {
                    $business_slug = request()->segment(2);
                    $businessName = Business::where('slug', $business_slug)->first();
                    $position++;
                    $resultArray[] = ['name' => $page->page_name, 'url' => url($pageSlug->slug), 'position' => $position];
                    if ($pageSlug->slug) {
                        $position++;
                        $resultArray[] = ['name' => $businessName->business_name, 'url' => url("$pageSlug->slug/$business_slug"), 'position' => $position];
                    }
                }

                if ($posttype == 'city-business-service') {
                    $city_slug = request()->segment(1);
                    $business_slug = request()->segment(3);
                    $businessName = Business::where('slug', $business_slug)->first();
                    $citiesName = Cities::where('slug', $city_slug)->first();
                    $position++;
                    $resultArray[] = ['name' => $page->page_name . ' in ' . $citiesName->city_name, 'url' => url("$city_slug/$pageSlug->slug"), 'position' => $position];
                    if ($pageSlug->slug) {
                        $position++;
                        $resultArray[] = ['name' => $businessName->business_name, 'url' => url("$city_slug/$pageSlug->slug/$business_slug"), 'position' => $position];
                    }
                } 
            } else {
                $position++;
                $resultArray[] = ['name' => $page->page_name, 'url' => url($page->slug), 'position' => $position];
            }
        }
    }
    $return = ['page' => $page, 'resultArray' => $resultArray];
    return $return;
}

}

	if (!function_exists('getCitiesData')) {
		function getCitiesData() 
		{
			$citiesData = Cities::all();
			
			return $citiesData;
		}
	}
	if (!function_exists('getBusinessData')) {
		function getBusinessData() 
		{
			$businessData = Business::all();
			
			return $businessData;
		}
	}

	if (!function_exists('public_img_path')) {
		function public_img_path($imgval)
		{
			$uploadsPath = public_path('uploads/' . $imgval);
			return $uploadsPath;
		}
	}

	if (!function_exists('getSettingsData')) {
		function getSettingsData()
		{
			$metaTags = Settings::whereBetween('id', [47, 87])->get();
	
			return $metaTags;
		}
	}
	function getImportantLinks() 
	{
		$importantLinks = Settings::whereBetween('id', [108, 118])->get(); 
		$pageDataCollection = collect(); 

		foreach ($importantLinks as $setting) {
			$pageData = Page::where('id', $setting->value)->get();
			if ($pageData->isNotEmpty()) {
				$pageDataCollection = $pageDataCollection->merge($pageData); // Merge collections
			}
		}
		
		return $pageDataCollection;
	}
	if (!function_exists('getImportantOurServices')) {
		function getImportantOurServices() 
		{
			$importantServices = Settings::whereBetween('id', [98, 102])
								->orWhereIn('id', [124, 125, 126])
								->get();

			$pageDataCollection = collect();

			foreach ($importantServices as $setting) {
				$pageData = Page::where('id', $setting->value)->get();
				if ($pageData->isNotEmpty()) {
					$pageDataCollection = $pageDataCollection->merge($pageData); 
				}
			}
			return $pageDataCollection;
		}
	}
	if (!function_exists('getImportantRescources')) {
		function getImportantRescources() 
		{
			$importantResources = Settings::whereBetween('id', [127, 136])->get(); 
			return $importantResources;
		}
	}
	if (!function_exists('getImportantHeaderRescources')) {
		function getImportantHeaderRescources() 
		{
			$importantResources = Settings::whereBetween('id', [143, 158])->get(); 
			// echo "<pre>";
			// print_r($importantResources);exit;
			return $importantResources;
		}
	}
	if (!function_exists('getCountries')) {
		function getCountries() 
		{
			$coutriesData = Settings::whereBetween('id', [159, 178])->get(); 
			// echo "<pre>";
			// print_r($importantResources);exit;
			return $coutriesData;
		}
	}
	if (!function_exists('getNavbar')) {
		function getNavbar() 
		{
			$coutriesData = Settings::whereBetween('id', [179, 188])->get(); 
			// echo "<pre>";
			// print_r($importantResources);exit;
			return $coutriesData;
		}
	}
	if (!function_exists('getImportantContact')) {
		function getImportantContact() 
		{
			$importantContact = Settings::whereBetween('id', [93, 97])->get(); 
			$pageDataCollection = collect();

			foreach ($importantContact as $setting) {
				$pageData = Page::where('id', $setting->value)->get();
				if ($pageData->isNotEmpty()) {
					$pageDataCollection = $pageDataCollection->merge($pageData); 
				}
			}
			return $pageDataCollection;
		}
	}
	if (!function_exists('checkCityData')) {
		function checkCityData($city) 
		{
			$cityExists = Cities::where('slug', $city)->exists();
			return $cityExists;
		}
	}
	if (!function_exists('checkSlugData')) {
		function checkSlugData($slug) 
		{
			$businessExists = Business::where('slug', $slug)->exists();
				if($businessExists){
					$existBusiness = 2;
					return $existBusiness;
				}else{
				$pageData = Page::where('slug', $slug)->first();
				if($pageData){

					if ($pageData->posttype != 'service') {
						$existsVal = 1;
						return $existsVal;
					}
				}
				}
		}
	}

	
	if (!function_exists('getServiceData')) {
		function getServiceData() 
		{
			$pageData = Page::where('id', Service_Page_ID)->first(); // Use first() instead of get()
			
			if ($pageData) {
				return $pageData->slug; 
			}
	
			return null; 
		}
	}
	if (!function_exists('checkAllData')) {
		function checkAllData($city,$slug) 
		{
			$cityExists = Cities::where('slug', $slug)->exists();
			$serviceExists = Page::where('slug', $city)->exists();
			
			if ($cityExists && $serviceExists) {
				$existsVal = 1;
					return $existsVal;
			}
	
			return null;
		}
	}

	if (!function_exists('checkCityBusiness')) {
		function checkCityBusiness($city,$slug,$business) 
		{
			$cityExists = Cities::where('slug', $slug)->exists();
			$serviceExists = Page::where('slug', $city)->exists();
			$businessExists = Business::where('slug', $business)->exists();
			
			if ($cityExists && $serviceExists && $businessExists) {
				$existsVal = 1;
					return $existsVal;
			}
	
			return null; 
		}
	}

	if (!function_exists('mediaLibraryData')) {
		function mediaLibraryData() 
		{
			$directory = public_path('uploads');

			if (File::isDirectory($directory)) {
				$files = File::files($directory);
	
				$imageFiles = [];
				foreach ($files as $file) {
					$extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
					if ($extension === 'webp') {
						$imageFiles[] = $file->getFileName();
					}
				}
				
			}
			$return = ['imageFiles'=>$imageFiles];
			return $return;
		}
	}
	
	if(!function_exists('array_to_csv')){
	    // 	 csv download  
    	function array_to_csv($array, $download = "")
    	{
    		if ($download != "")
    		{
    			@header('Content-Type: application/csv');
    			@header('Content-Disposition: attachement; filename="' . $download . '"');
    		}	
    
    		ob_start();
    		$f = fopen('php://output', 'w') or show_error("Can't open php://output");
    		$n = 0;
    		foreach ($array as $line)
    		{
    			$n++;
    			if ( ! fputcsv($f, $line))
    			{
    				show_error("Can't write line $n: $line");
    			}
    		}
    		fclose($f) or show_error("Can't close php://output");
    		$str = ob_get_contents();
    		ob_end_clean();
    
    		if ($download == "")
    		{
    			return $str;	
    		}
    		else
    		{
    			echo $str;
    		}
    	}
	}
	
	
	if(!function_exists('parse_csv_file')){
	   function parse_csv_file($p_Filepath) {
            $separator = ','; // Set your CSV separator (comma by default)
            $enclosure = '"'; // Default enclosure used in CSV files
        
            // Force the file contents to be treated as UTF-8
            $fileContents = file_get_contents($p_Filepath);
            if ($fileContents === false) {
                return []; // Return an empty array if the file can't be read
            }
        
            // Detect encoding and convert to UTF-8 if necessary
            $encoding = mb_detect_encoding($fileContents, 'UTF-8, ISO-8859-1, ISO-8859-15', true);
            if ($encoding !== 'UTF-8') {
                $fileContents = mb_convert_encoding($fileContents, 'UTF-8', $encoding);
            }
        
            // Handle BOM if present
            $fileContents = preg_replace('/^\xEF\xBB\xBF/', '', $fileContents);
        
            // Create a temporary file to read the UTF-8 encoded contents
            $tempFile = tmpfile();
            fwrite($tempFile, $fileContents);
            rewind($tempFile);
        
            // Read the first row to get the headers
            $headers = fgetcsv($tempFile, 0, $separator, $enclosure);
            if ($headers === false) {
                fclose($tempFile);
                return []; // Return an empty array if no headers are found
            }
        
            // Initialize an array to store the parsed content
            $content = [];
            while (($row = fgetcsv($tempFile, 0, $separator, $enclosure)) !== false) {
                if (!empty(array_filter($row))) { // Skip empty lines
                    // Combine headers with row values to create an associative array
                    if (count($headers) === count($row)) {
                        $content[] = array_combine($headers, $row);
                    }
                }
            }  
            fclose($tempFile);
            return $content;
        } 
	}
	
	// ------------------------------------------------------------------------

    /**
     * Array to CSV
     *
     * download == "" -> return CSV string
     * download == "toto.csv" -> download file toto.csv
     */
    if (!function_exists('array_to_csv')) {
    	function array_to_csv($array, $download = "")
    	{
    		if ($download != "") {
    			header('Content-Type: application/csv');
    			header('Content-Disposition: attachement; filename="' . $download . '"');
    		}
    
    		ob_start();
    		$f = fopen('php://output', 'w') or show_error("Can't open php://output");
    		$n = 0;
    		foreach ($array as $line) {
    			$n++;
    			if (!fputcsv($f, $line)) {
    				show_error("Can't write line $n: $line");
    			}
    		}
    		fclose($f) or show_error("Can't close php://output");
    		$str = ob_get_contents();
    		ob_end_clean();
    
    		if ($download == "") {
    			return $str;
    		} else {
    			echo $str;
    		}
    	}
    }
    
    if(!function_exists('outputCsv')){
        function outputCsv($fileName, $assocDataArray)
        {
            //ob_clean();
            header('Pragma: public');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Cache-Control: private', false);
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment;filename=' . $fileName);    
            if(isset($assocDataArray['0'])){
                $fp = fopen('php://output', 'w');
                fputcsv($fp, array_keys($assocDataArray['0']));
                foreach($assocDataArray AS $values){
                    fputcsv($fp, $values);
                }
                fclose($fp);
            }
        }
    }
    
    
    if (!function_exists('pre')) {
    	function pre($data){ 
    		echo "<pre>"; print_r($data); echo "</pre>"; die;
    	}
    }
    
    if(!function_exists('OBR')){
        function OBR($data){
            return  json_decode(json_encode($data), true);
        }
    }
	
	if(!function_exists('escape_string')){
	    function escape_string($data){
        	$result =   array();
        	foreach($data as $row){
        		$result[]   =   preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "", str_replace('"', '',$row)); //str_replace('"', '',$row);
        	}
        	return $result;
        }
	}
	
	if(!function_exists('downloadFile')){
	   function downloadFile($path, $downloadName = null)
        {
            $filePath = public_path('csv/' . $path);
        
            if (!file_exists($filePath)) {
                abort(404, 'File not found.');
            }
        
            $downloadName = $downloadName ?? basename($filePath);
        
            // Ensure correct MIME type for CSV
            $mimeType = 'text/csv';
        
            return response()->download($filePath, $downloadName, [
                'Content-Type' => $mimeType,
                'Content-Disposition' => 'attachment; filename="' . $downloadName . '"',
            ]);
        }
 

	}
	
	if(!function_exists('extractHeadings')){
	    function extractHeadings($content)
        {
            $headings = [];
            
            // Use regex to find headings
            preg_match_all('/<h([1-6])>(.*?)<\/h[1-6]>/', $content, $matches, PREG_SET_ORDER);
            
            foreach ($matches as $match) {
                $level = (int)$match[1];
                $text = $match[2];
                $headings[] = [
                    'level' => $level,
                    'text' => $text,
                    'id' => Str::slug($text) // Generate slug for anchor links
                ];
            }
            
            return $headings;
        }
	}

?>
