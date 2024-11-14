<?php

namespace App\Http\Controllers;
use App\Http\Controllers\MessageController;
use App\Models\Page;
use App\Models\PageExtra;
use App\Models\Category;
use App\Models\CategoryPage;
use App\Models\Cities;
use App\Models\Contact_us;
use App\Models\Business;
use App\Models\User;
use App\Models\CaseStudies;
use App\Models\CaseStudiesCategory;
use App\Models\PortfolioCategory;
use App\Models\Portfolio;
use App\Models\SampleCategory;
use App\Models\MediaCoverageCategory;
use App\Models\MediaCoverage;
use App\Models\NewsCategory;
use App\Models\Sample;
use App\Models\GuestPost;
use App\Models\Settings;
use App\Models\PackageCategory;
use App\Models\PackagePlan;
use App\Models\PackageType;
use App\Models\PackageFeatureTitle;
use App\Models\PackageFeatureSubTitle;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Auth;
use Redirect;
use Session;
use File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Stripe\Error\Card;
use Cartalyst\Stripe\Stripe;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EventExport;
use Barryvdh\DomPDF\Facade as PDF; 
use App\Models\Client; // Import the Client model
use App\{
        Helpers\PriceHelper,
        Traits\StripeCheckout, 
        Traits\PaypalCheckout
};
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Config;
use Stripe as STPR;
use Omnipay\Omnipay;
use Paytm\Checksum; 

class FrontendController extends Controller

{

    public function __construct()
    {

    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    /* Home Page Get*/

    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    public function index()

    {
        // get_live_visitor_data();

        $setting = Settings::whereIn('id', array(5, 6, 7))->get();

        $page = Page::where('slug','home')->first();
        // echo "<pre>"; print_r($page); die;
        // $partners = Our_partner::where('status', '1')->get();

        // $Specialities = Specialities::where('status', '1')->get();

        // $Specialities_cat = Specialities_cat::where('status', '1')->get();

        // $Testimonials = Testimonials::where('status', '1')->get();

        // $Promocodes = Promocode::where('status', '1')->get();

        // $hospitals = User::where('role_id', '2')->where('status', '1')->orderBy('rank', 'asc')->limit(3)->get();

        // $doctors = User::where('role_id', '3')->where('status', '1')->orderBy('rank', 'asc')->limit(5)->get();

        // $news = Page::where('posttype', 'news')->where('status', '1')->orderBy('id', 'DESC')->limit(5)->get();

        // $services = Page::where('posttype', 'service')->where('status', '1')->get(); 

        $extra_data = array(); 
        if($page) 
        {

            if($page->meta_title) 
            { 
                @$setting[0]->value = $page->meta_title; 
                //@$setting[0]->value = $page->page_name; 
            } 
            if($page->meta_keyword) 
            { 
                @$setting[1]->value = $page->meta_keyword; 
            } 
            if($page->meta_description) 
            { 
                @$setting[2]->value = $page->meta_description; 
            } 
            
            $page_image = '';

            $page_url = url('/');

            $site_logo = config('site.logo');

            if($page->bannerimage && File::exists(public_path('uploads/'.$page->bannerimage)) )

            {

                $page_image = asset('/uploads/'.$page->bannerimage);

            }elseif (config('site.meta_image') && File::exists(public_path('uploads/'.config('site.meta_image')))) {

                $page_image = asset('/uploads/'.config('site.meta_image'));

            }elseif ($site_logo && File::exists(public_path('uploads/'.$site_logo))) {

                $page_image = asset('/uploads/'.$site_logo);

            }

            $extra_data = PageExtra::where('page_id',$page->id)->orderBy('rank', 'asc')->get();
            // echo "<pre>";
            // print_r($extra_data);exit;
            $faqData = PageExtra::where('page_id',FAQ_Page_ID)->orderBy('rank', 'asc')->get();
            $blogData = Page::where('posttype', 'blog')->where('status', '1')->orderBy('id', 'DESC')->take(3)->get();

            $allServiceData = Page::whereIn('posttype', ['service'])
            ->where('status', '1')
            ->orderBy('service_order', 'asc')
            ->get();

            $visitor = addVisitor();

            // echo "<pre>";
            // print_r($faqData);exit;
            $data['seo_results'] = Page::where('posttype','seo')->where('status','1')->orderBy('id', 'ASC')->get();
            // $data['portfolio_results'] = Portfolio::where('status','1')->orderBy('id', 'ASC')->get();


            $data['page']                   = $page;
            $data['setting']                = $setting;
            $data['page_url']               = $page_url;
            $data['page_image']             = $page_image;
            $data['extra_data']             = $extra_data;
            $data['visitor']                = $visitor;
            $data['faqData']                = $faqData;
            $data['blogData']               = $blogData;
            $data['allServiceData']         = $allServiceData;
            $data['video']                  = DB::table("video_tutorails")->where('status', 1)->get();
            $data['our_strength']           = DB::table("our_strength")->where('status', 'Active')->get();
            $data['certificate']            = DB::table("certificate_digital")->where('status', 1)->get();
            $data['tools_we_use']           = DB::table("tools_we_use")->where('status', 1)->get();
            $data['our_partners']           = DB::table("our_partners")->where('status', 1)->get();
            $data['our_work_featured']      = DB::table("our_work_featured")->where('status', 1)->get();
            // echo "<pre>";print_r($data['video']); die;
            return view('frontend.home', $data);

        }

        else
        {

            return view('errors.404');

            // return redirect('404');

        }

    }


    /* Blog details Page Get*/

    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++
    public function getCategoriesBlog(Request $request,$slug){
        $categoryDetails = Category::where('slug',$slug)->where('status','1')->first();
        if($categoryDetails){

        $catId = $categoryDetails->id;

        //------------------------------------Blog Pagination------------------------------------------------

        $itemsPerPage = 8; // number of items to display per page
        $currentPage = $request->input('page', 1); // get the current page number from the request
        $slugData = $slug;
        // Calculate the offset and limit values
        $offset = ($currentPage - 1) * $itemsPerPage;
        $limit = $itemsPerPage;

        // Fetch the data using offset and limit
        $blogData = CategoryPage::join('pages', 'category_page.page_id', '=', 'pages.id')
            ->where('category_page.category_id', $catId)
            ->where('posttype', 'blog')
            ->where('status', 1)
            ->orderBy('pages.id', 'DESC')
            ->offset($offset)
            ->limit($limit)
            ->get();
        //---------------------------------------------------------------------------------------------------
        
        $totalItems = CategoryPage::join('pages', 'category_page.page_id', '=', 'pages.id')
                            ->where('category_page.category_id', $catId)
                            ->where('posttype', 'blog')
                            ->where('status', 1)
                            ->orderBy('pages.id', 'DESC')
                            ->count();
        $totalPages = ceil($totalItems / $itemsPerPage);


        // $blogData = CategoryPage::join('pages', 'category_page.page_id', '=', 'pages.id')
        //             ->where('category_page.category_id', $catId)
        //             ->get();

        $recentPost = Page::where('posttype','blog')->where('status','1')->orderBy('id', 'DESC')->limit(5)->get();

        $allServiceData = Page::whereIn('posttype', ['service'])
        ->where('status', '1')
        ->orderBy('service_order', 'asc')
        ->get();
        if($blogData){
            $page = Page::where('slug','blog')->where('status','1')->first();

            $categoryData = Category::where('status',1)->get();
            $followLinks = Settings::whereIn('id', array(24,25,26,27))->get();
            $serviceData = Page::where('posttype','service')->where('status','1')->orderBy('id', 'DESC')->limit(8)->get();

            // $resourceData = Page::where('posttype','resource')->where('status','1')->orderBy('id', 'DESC')->limit(8)->get();
            $resourceData = Page::whereIn('id', [391, 393, 160, 30])
                    ->where('status', '1')
                    ->orderBy('id', 'DESC')
                    ->limit(8)
                    ->get();

            $detailsPage = Page::where('slug','blog')->first();
            $page_id = $detailsPage->id;
            $extra_data = PageExtra::where('page_id',$page_id)->orderBy('rank', 'asc')->get();
            return view('frontend.pages.blog_list', compact('blogData','extra_data','categoryData','allServiceData','recentPost','serviceData','followLinks','resourceData','currentPage','totalPages','slugData','page'));
        }else{
            return view('errors.404');
        }
        }else{
            return view('errors.404');
        }


    }
    public function blog_details(Request $request, $slug)
    {
        $setting = Settings::whereIn('id', array(5, 6, 7))->get();
        $page = Page::where('slug',$slug)->where('status','1')->first();  
        $extra_data = array();
        if($page)

        {
            
        $detailsPage = Page::where('slug','blog-details')->first(); 
        $page_id = $detailsPage['id'];

        $blogs = Page::where('posttype','news')->where('status','1')->orderBy('id', 'DESC')->limit(5)->get();

        $recentPost = Page::where('posttype','blog')->where('status','1')->orderBy('id', 'DESC')->limit(5)->get();

        $blog_details = page::where('slug', $slug)->get();
        
        $serviceData = Page::where('posttype','service')->where('status','1')->orderBy('id', 'DESC')->limit(8)->get();
        
        $pageId = $blog_details[0]->id;
        
        $allData = CategoryPage::where('page_id',$pageId)->get();
        
        
        $resourceData = Page::whereIn('id', [391, 393, 160, 30])
                    ->where('status', '1')
                    ->orderBy('id', 'DESC')
                    ->limit(8)
                    ->get();
        $results = $catAllData = [];
        if($allData->isNotEmpty() && isset($allData[0]->category_id)) {
            $catId = $allData[0]->category_id;
    
            $catAllData = CategoryPage::where('category_id',$catId)->get();
            
            $results = CategoryPage::join('pages', 'category_page.page_id', '=', 'pages.id')
                        ->where('category_page.category_id', $catId)
                        ->get();
       }else{
            return view('errors.404');
       }
        $blogData = Page::where('posttype','blog')->where('status','1')->orderBy('id', 'DESC')->get();

        $followLinks = Settings::whereIn('id', array(24,25,26,27))->get();
        
        $allServiceData = Page::whereIn('posttype', ['service'])
        ->where('status', '1')
        ->orderBy('service_order', 'asc')
        ->get();


            if($page->meta_title)

            {

                @$setting[0]->value = $page->meta_title;

                //@$setting[0]->value = $page->page_name;

            }

            if($page->meta_keyword)

            {

                @$setting[1]->value = $page->meta_keyword;

            }

            if($page->meta_description)

            {

                @$setting[2]->value = $page->meta_description;

            }



            $page_image = '';

            $page_url = url('/');

            $site_logo = config('site.logo');

            if($page->bannerimage && File::exists(public_path('uploads/'.$page->bannerimage)) )

            {

                $page_image = asset('/uploads/'.$page->bannerimage);

            }elseif (config('site.meta_image') && File::exists(public_path('uploads/'.config('site.meta_image')))) {

                $page_image = asset('/uploads/'.config('site.meta_image'));

            }elseif ($site_logo && File::exists(public_path('uploads/'.$site_logo))) {

                $page_image = asset('/uploads/'.$site_logo);

            }


            $pageId = $page['id'];

            $extra_data = PageExtra::where('page_id',$pageId)->orderBy('rank', 'asc')->orderBy('type', 'asc')->get();
            
            $content = '';

            foreach ($extra_data as $data) {
                $content = $data->body . "\n"; 
            }

            $contents = $extra_data->pluck('body')->implode("\n");  
            
            $headings = extractHeadings($contents);  
            $content = $this->addHeadingIds($content, $headings);
            $categoryData = Category::where('status',1)->get();

            //Visitor Add/Update

            $visitor = addVisitor();
            
            return view('frontend.pages.blog_details', compact('content','headings','page','setting','page_url','page_image', 'extra_data', 'blogs','blog_details','categoryData','results','blogData','recentPost','followLinks','serviceData','resourceData','allServiceData'));

        }

        else

        {
            return view('errors.404');
            // return redirect('404');

        }

    }
    
    private function addHeadingIds($content, $headings)
    {
        foreach ($headings as $heading) {
            $id = $heading['id'];
            $text = preg_quote($heading['text'], '/'); // Escape special characters for regex
    
            // Replace the heading with the same heading that includes the ID attribute
            $content = preg_replace(
                "/<h{$heading['level']}>(.*?)<\/h{$heading['level']}>/",
                "<h{$heading['level']} id=\"{$id}\">$1</h{$heading['level']}>",
                $content,
                1 // Replace only the first occurrence
            );
        }
    
        return $content;
    }
    public function getCategoriesNews(Request $request,$slug){
        $categoryDetails = NewsCategory::where('slug',$slug)->where('status','1')->first(); 
        if($categoryDetails)
        {
            
                $catId = $categoryDetails->id;

                //------------------------------------Blog Pagination------------------------------------------------

                $itemsPerPage = 8; // number of items to display per page
                $currentPage = $request->input('page', 1); // get the current page number from the request
                $slugData = $slug;
                // Calculate the offset and limit values
                $offset = ($currentPage - 1) * $itemsPerPage;
                $limit = $itemsPerPage;
                

                $newsData = NewsCategory::join('pages', 'news_category.id', '=', 'pages.news_category')
                    ->where('news_category.id', $catId)
                    ->where('posttype', 'news')
                    ->orderBy('pages.id', 'DESC')
                    ->offset($offset)
                    ->limit($limit)
                    ->get();
                
                //---------------------------------------------------------------------------------------------------
                // Retrieve the total number of blog posts
                $totalItems = NewsCategory::join('pages', 'news_category.id', '=', 'pages.news_category')
                                    ->where('news_category.id', $catId)
                                    ->where('posttype', 'news')
                                    ->orderBy('pages.id', 'DESC')
                                    ->count();
                $totalPages = ceil($totalItems / $itemsPerPage);


                // $blogData = CategoryPage::join('pages', 'category_page.page_id', '=', 'pages.id')
                //             ->where('category_page.category_id', $catId)
                //             ->get();

                $recentPost = Page::where('posttype','news')->where('status','1')->orderBy('id', 'DESC')->get();
                $allServiceData = Page::whereIn('posttype', ['service'])
                ->where('status', '1')
                ->orderBy('service_order', 'asc')
                ->get();
                if($newsData){
                    
                    $categoryData = NewsCategory::where('status', 1)->get();
                    $followLinks = Settings::whereIn('id', array(24, 25, 26, 27))->get();
                    $serviceData = Page::where('posttype', 'service')->where('status', '1')->orderBy('id', 'DESC')->limit(8)->get();
                    // $resourceData = Page::where('posttype', 'resource')->where('status', '1')->orderBy('id', 'DESC')->limit(8)->get();
                    $resourceData = Page::whereIn('id', [391, 393, 160, 30])
                    ->where('status', '1')
                    ->orderBy('id', 'DESC')
                    ->limit(8)
                    ->get();
                
                    $detailsPage = Page::where('slug', 'news')->first(); 
                    if ($detailsPage) {
                        
                        $page_id = $detailsPage->id;
                        $extra_data = PageExtra::where('page_id', $page_id)->orderBy('rank', 'asc')->get();
                        return view('frontend.pages.news_list', compact('newsData', 'extra_data', 'categoryData', 'serviceData', 'followLinks', 'resourceData', 'currentPage', 'totalPages', 'allServiceData', 'recentPost'));
                    } else {
                        return view('errors.404');
                    }
                }
                else
                {
                    return view('errors.404');
                }
        }else{
            return view('errors.404');
        }
    }
    public function newsDetails($slug)
    {
        $setting = Settings::whereIn('id', array(5, 6, 7))->get();
        $page = Page::where('slug',$slug)->where('status','1')->where('posttype','news')->first();
        $extra_data = array();
        if($page)
        {
        $detailsPage = Page::where('slug','blog-details')->first();
        $page_id = $detailsPage['id'];

        $blogs = Page::where('posttype','news')->where('status','1')->orderBy('id', 'DESC')->limit(5)->get();
        $recentPost = Page::where('posttype','news')->where('status','1')->orderBy('id', 'DESC')->get();
        $newsDetails = page::where('slug', $slug)->where('posttype','news')->first();
        $serviceData = Page::where('posttype','service')->where('status','1')->orderBy('id', 'DESC')->limit(8)->get();
        $pageId = $newsDetails->id;
        $newsCategory = NewsCategory::where('id',$newsDetails->news_category)->first();
        // $resourceData = Page::where('posttype','resource')->where('status','1')->orderBy('id', 'DESC')->limit(8)->get();
        $resourceData = Page::whereIn('id', [391, 393, 160, 30])
                    ->where('status', '1')
                    ->orderBy('id', 'DESC')
                    ->limit(8)
                    ->get();

        $results = NewsCategory::join('pages', 'news_category.id', '=', 'pages.news_category')
                    ->where('news_category.id', $newsCategory->id)
                    ->get();
        $blogData = Page::where('posttype', 'blog')->where('status', '1')->orderBy('id', 'DESC')->take(3)->get();

        $followLinks = Settings::whereIn('id', array(24,25,26,27))->get();
        $allServiceData = Page::whereIn('posttype', ['service'])
        ->where('status', '1')
        ->orderBy('service_order', 'asc')
        ->get();
            if($page->meta_title)
            {
                @$setting[0]->value = $page->meta_title;
            }
            if($page->meta_keyword)
            {
                @$setting[1]->value = $page->meta_keyword;
            }
            if($page->meta_description)
            {
                @$setting[2]->value = $page->meta_description;
            }
            $page_image = '';
            $page_url = url('/');
            $site_logo = config('site.logo');
            if($page->bannerimage && File::exists(public_path('uploads/'.$page->bannerimage)) )
            {
                $page_image = asset('/uploads/'.$page->bannerimage);

            }elseif (config('site.meta_image') && File::exists(public_path('uploads/'.config('site.meta_image')))) {
                $page_image = asset('/uploads/'.config('site.meta_image'));
            }elseif ($site_logo && File::exists(public_path('uploads/'.$site_logo))) {
                $page_image = asset('/uploads/'.$site_logo);
            }
            $pageId = $page['id'];
            $extra_data = PageExtra::where('page_id',$pageId)->orderBy('rank', 'asc')->get();
            $categoryData = NewsCategory::where('status',1)->get();
            $visitor = addVisitor();

            return view('frontend.pages.news_details', compact('page','setting','page_url','page_image', 'extra_data', 'blogs','newsDetails','categoryData','results','blogData','recentPost','followLinks','serviceData','resourceData','allServiceData','newsCategory'));
        }
        else
        {
            return view('errors.404');
        }
    }



    /* Doctor Get Opinion Get*/

    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    public function Contact_us(Request $request)
    {
        if ($request->isMethod('post')) {

        $data = $request->all();

        $first_name = $request->first_name;
        $last_name = $request->last_name;
        $email = $request->email;
        $phone = $request->phone;
        // $whatsapp_number = $request->whatsapp_number;

        $message = $request->message;

            $rules = array(

                'first_name' => 'required|string|max:255',

                'phone' => 'required|int|min:10',

                'email' => 'required|string|max:255',
                'g-recaptcha-response' => 'required',
            );

            $customMessages = ['g-recaptcha-response.required'=>'The recaptcha field is required.'];

            $url = 'https://www.google.com/recaptcha/api/siteverify';
            $remoteip = $_SERVER['REMOTE_ADDR'];
            $recaptcha_data = [
                'secret' => '6LdReU8mAAAAANVKY00ET_E-5Zjokuzqr9lCocLD',
                'response' => $request->{'g-recaptcha-response'},
                'remoteip' => $remoteip
            ];
            $options = [
                    'http' => [
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => http_build_query($recaptcha_data)
                ]
            ];
            $context = stream_context_create($options);
            $result = file_get_contents($url, false, $context);
            $resultJson = json_decode($result);
            if ($resultJson->success != true) {
                $data['recaptcha_validate'] = '';
                $rules['recaptcha_validate'] = 'required';
                $customMessages['recaptcha_validate.required'] = 'ReCaptcha Error';
                //return back()->withErrors(['captcha' => 'ReCaptcha Error']);
            }

            $validator = Validator::make($data , $rules, $customMessages);

            if ($validator->fails())
            {
                return Redirect::back()->withErrors($validator)->withInput();
            }
            else
            {
                    $obj = new Contact_us();

                    $obj->first_name = $request->first_name;

                    $obj->last_name = $request->last_name;

                    $obj->phone = ($request->country_code !='')?$request->country_code.$request->phone:$request['number_new'];

                    // $obj->whatsapp_number = $request->whatsapp_number;

                    $obj->email = $request->email;

                    $obj->message = $request->message;

                    $obj->role = 1;
                    $obj->page_id      = $request->page_id;
                    $obj->save();

                    $list = Contact_us::find($obj->id);

                    // if ($list) {
                    //             require base_path("vendor/autoload.php");
                    //             $mail = new PHPMailer(true);

                    //             $mail->isSMTP();

                    //             // $mail->Host     = 'smtp.hostinger.com';
                    //             // $mail->SMTPAuth = true;
                    //             // $mail->Username = 'test@luckydeliveries.com';
                    //             // $mail->Password = 'Test@1234';
                    //             // $mail->SMTPSecure = 'ssl';
                    //             // $mail->Port     = 465;

                    //             // $mail->setFrom('test@luckydeliveries.com', 'luckydeliveries');
                    //             // $mail->addReplyTo('info@example.com', 'luckydeliveries');

                    //             $tm_email = $this->input->post('email_contact');
                    //             // Add a recipient
                    //             $mail->addAddress('info@example.com');

                    //             $subject   = "Bebran - Contact Form Details";

                    //             $mail_body  = '<html><body>';
                    //             $mail_body .= '<table rules="all" style="border-color: #666;" cellpadding="10">';

                    //             $mail_body .= "<tr><td><strong>Name:</strong> </td><td>" . $name . "</td></tr>";
                    //             $mail_body .= "<tr><td><strong>Email:</strong> </td><td>" . $email. "</td></tr>";
                    //             $mail_body .= "<tr><td><strong>Message:</strong> </td><td>" . $message . "</td></tr>";
                    //             $mail_body .= "</table>";
                    //             $mail_body .= "</body></html>";
                    //             $mail_body .= "<p>We appreciate your association. </p><p>Thank You,</p><p>www.luckydeliveries.com</p><p>PS: This is an auto generated mail, Please do not reply to this.</p>";

                    //             // Email subject
                    //             $mail->Subject = $subject;

                    //             // Set email format to HTML
                    //             $mail->isHTML(true);

                    //             $mail->Body = $mail_body;

                    //             if($mail->send()){
                    //                 echo 1111;exit;
                    //             }

                    // }

                 return redirect('/thank-you')->with('success', 'Thank you for contacting. We’ll be in touch soon!');
            }
        }
    }
    public function blogForm(Request $request){
        //  pre($request->all());
        if (!empty($request->all())) {
            
            $data = $request->all();
                $rules = array(
                    'name' => 'required|string|max:255',
                    'number_new' => 'required|min:10|unique:contact_us,phone',
                    'email' => 'required|string|max:255|unique:contact_us,email',
                    'g-recaptcha-response' => 'required',
                    'serviceName' => 'required|string', // Added validation for serviceName
                    'budget' => 'nullable|numeric|min:1', // Optional, must be numeric and minimum value is 1 if provided
                    'website_url' => 'nullable|url', // Optional, must be a valid URL if provided
                );


                $customMessages = ['g-recaptcha-response.required'=>'The recaptcha field is required.'];

                $url = 'https://www.google.com/recaptcha/api/siteverify';
                $remoteip = $_SERVER['REMOTE_ADDR'];
                $recaptcha_data = [
                    'secret' => '6LdReU8mAAAAANVKY00ET_E-5Zjokuzqr9lCocLD',
                    'response' => $request->{'g-recaptcha-response'},
                    'remoteip' => $remoteip
                ];
                $options = [
                        'http' => [
                        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                        'method' => 'POST',
                        'content' => http_build_query($recaptcha_data)
                    ]
                ];
                $context = stream_context_create($options);
                $result = file_get_contents($url, false, $context);
                $resultJson = json_decode($result);
                if ($resultJson->success != true) {
                    $data['recaptcha_validate'] = '';
                    $rules['recaptcha_validate'] = 'required';
                    $customMessages['recaptcha_validate.required'] = 'ReCaptcha Error';
                    //return back()->withErrors(['captcha' => 'ReCaptcha Error']);
                }

                $validator = Validator::make($data , $rules);
                 
                if (!$validator)
                {
                    return Redirect::back()->withErrors($validator)->withInput();
                }
                else
                {
                        $obj = new Contact_us();

                        $obj->first_name   = $request->name;
                        // $obj->email        = $request->email;
                        $obj->phone        = ($request->country_code !='')?$request->country_code.$request->phone:$request['number_new'];
                        // $obj->location     = $request->location;
                        $obj->budget       = $request->budget;
                        $obj->website      = $request->website_url;
                        $obj->service_name = $request->serviceName;
                        $obj->page_id      = $request->page_id;

                        $obj->save();

                        $list = Contact_us::find($obj->id);
                        
                        // if ($list) {
                        //             require base_path("vendor/autoload.php");
                        //             $mail = new PHPMailer(true);

                        //             $mail->isSMTP();

                        //             // $mail->Host     = 'smtp.hostinger.com';
                        //             // $mail->SMTPAuth = true;
                        //             // $mail->Username = 'test@luckydeliveries.com';
                        //             // $mail->Password = 'Test@1234';
                        //             // $mail->SMTPSecure = 'ssl';
                        //             // $mail->Port     = 465;

                        //             // $mail->setFrom('test@luckydeliveries.com', 'luckydeliveries');
                        //             // $mail->addReplyTo('info@example.com', 'luckydeliveries');

                        //             $tm_email = $this->input->post('email_contact');
                        //             // Add a recipient
                        //             $mail->addAddress('info@example.com');

                        //             $subject   = "Bebran - Contact Form Details";

                        //             $mail_body  = '<html><body>';
                        //             $mail_body .= '<table rules="all" style="border-color: #666;" cellpadding="10">';

                        //             $mail_body .= "<tr><td><strong>Name:</strong> </td><td>" . $name . "</td></tr>";
                        //             $mail_body .= "<tr><td><strong>Email:</strong> </td><td>" . $email. "</td></tr>";
                        //             $mail_body .= "<tr><td><strong>Message:</strong> </td><td>" . $message . "</td></tr>";
                        //             $mail_body .= "</table>";
                        //             $mail_body .= "</body></html>";
                        //             $mail_body .= "<p>We appreciate your association. </p><p>Thank You,</p><p>www.luckydeliveries.com</p><p>PS: This is an auto generated mail, Please do not reply to this.</p>";

                        //             // Email subject
                        //             $mail->Subject = $subject;

                        //             // Set email format to HTML
                        //             $mail->isHTML(true);

                        //             $mail->Body = $mail_body;

                        //             if($mail->send()){
                        //                 echo 1111;exit;
                        //             }

                        // }

                     return redirect('/thank-you')->with('success', 'Thank you for contacting. We’ll be in touch soon!');
                }
            }
    }
    public function guestForm(Request $request){ 
        if ($request->isMethod('post')) {
            $data = $request->all();
                $rules = array(
                    'post_title' => 'required|string|max:255',
                    'author_name' => 'required',
                    'email_address' => 'required|string|max:255',
                    'guest_mobile' => 'required|min:11|numeric',
                    'post_content' => 'required',
                    'g-recaptcha-response' => 'required',
                );

                $customMessages = ['g-recaptcha-response.required'=>'The recaptcha field is required.'];

                $url = 'https://www.google.com/recaptcha/api/siteverify';
                $remoteip = $_SERVER['REMOTE_ADDR'];
                $recaptcha_data = [
                    'secret' => '6LdReU8mAAAAANVKY00ET_E-5Zjokuzqr9lCocLD',
                    'response' => $request->{'g-recaptcha-response'},
                    'remoteip' => $remoteip
                ];
                $options = [
                        'http' => [
                        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                        'method' => 'POST',
                        'content' => http_build_query($recaptcha_data)
                    ]
                ];
                $context = stream_context_create($options);
                $result = file_get_contents($url, false, $context);
                $resultJson = json_decode($result);
                if ($resultJson->success != true) {
                    $data['recaptcha_validate'] = '';
                    $rules['recaptcha_validate'] = 'required';
                    $customMessages['recaptcha_validate.required'] = 'ReCaptcha Error';
                    //return back()->withErrors(['captcha' => 'ReCaptcha Error']);
                }

                $validator = Validator::make($data , $rules);

                if ($validator->fails())
                {
                    return Redirect::back()->withErrors($validator)->withInput();
                }
                else
                {
                        $obj = new GuestPost();

                        $obj->post_title    = $request->post_title;
                        $obj->author_name   = $request->author_name;
                        $obj->email_address = $request->email_address;
                        $obj->guest_mobile = ($request->country_code !='')?$request->country_code.$request->phone:$request['number_new'];
                        $obj->post_content  = $request->post_content;

                        // echo "<pre>";
                        // print_r($obj);exit;
                        $obj->save();

                        $list = GuestPost::find($obj->id);

                        // if ($list) {
                        //             require base_path("vendor/autoload.php");
                        //             $mail = new PHPMailer(true);

                        //             $mail->isSMTP();

                        //             // $mail->Host     = 'smtp.hostinger.com';
                        //             // $mail->SMTPAuth = true;
                        //             // $mail->Username = 'test@luckydeliveries.com';
                        //             // $mail->Password = 'Test@1234';
                        //             // $mail->SMTPSecure = 'ssl';
                        //             // $mail->Port     = 465;

                        //             // $mail->setFrom('test@luckydeliveries.com', 'luckydeliveries');
                        //             // $mail->addReplyTo('info@example.com', 'luckydeliveries');

                        //             $tm_email = $this->input->post('email_contact');
                        //             // Add a recipient
                        //             $mail->addAddress('info@example.com');

                        //             $subject   = "Bebran - Contact Form Details";

                        //             $mail_body  = '<html><body>';
                        //             $mail_body .= '<table rules="all" style="border-color: #666;" cellpadding="10">';

                        //             $mail_body .= "<tr><td><strong>Name:</strong> </td><td>" . $name . "</td></tr>";
                        //             $mail_body .= "<tr><td><strong>Email:</strong> </td><td>" . $email. "</td></tr>";
                        //             $mail_body .= "<tr><td><strong>Message:</strong> </td><td>" . $message . "</td></tr>";
                        //             $mail_body .= "</table>";
                        //             $mail_body .= "</body></html>";
                        //             $mail_body .= "<p>We appreciate your association. </p><p>Thank You,</p><p>www.luckydeliveries.com</p><p>PS: This is an auto generated mail, Please do not reply to this.</p>";

                        //             // Email subject
                        //             $mail->Subject = $subject;

                        //             // Set email format to HTML
                        //             $mail->isHTML(true);

                        //             $mail->Body = $mail_body;

                        //             if($mail->send()){
                        //                 echo 1111;exit;
                        //             }

                        // }

                     return redirect('/thank-you-guest-post')->with('success', 'Thank you for contacting. We’ll be in touch soon!');
                }
            }
        }
    public function blogCommentForm(Request $request){
        if ($request->isMethod('post')) {
            $data = $request->all();

                $rules = array(
                    'name' => 'required|string|max:255',
                    'email' => 'required|string|max:255',
                    'phone' => 'required',
                    'g-recaptcha-response' => 'required',
                );

                $customMessages = ['g-recaptcha-response.required'=>'The recaptcha field is required.'];

                $url = 'https://www.google.com/recaptcha/api/siteverify';
                $remoteip = $_SERVER['REMOTE_ADDR'];
                $recaptcha_data = [
                    'secret' => '6LdReU8mAAAAANVKY00ET_E-5Zjokuzqr9lCocLD',
                    'response' => $request->{'g-recaptcha-response'},
                    'remoteip' => $remoteip
                ];
                $options = [
                        'http' => [
                        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                        'method' => 'POST',
                        'content' => http_build_query($recaptcha_data)
                    ]
                ];
                $context = stream_context_create($options);
                $result = file_get_contents($url, false, $context);
                $resultJson = json_decode($result);
                if ($resultJson->success != true) {
                    $data['recaptcha_validate'] = '';
                    $rules['recaptcha_validate'] = 'required';
                    $customMessages['recaptcha_validate.required'] = 'ReCaptcha Error';
                    //return back()->withErrors(['captcha' => 'ReCaptcha Error']);
                }

                $validator = Validator::make($data , $rules);

                if ($validator->fails())
                {

                    return Redirect::back()->withErrors($validator)->withInput();
                }
                else
                {
                        $obj = new Contact_us();

                        $obj->first_name   = $request->name;
                        // $obj->email        = $request->email;
                        $obj->phone        = $request->phone;
                        // $obj->location     = $request->location;
                        $obj->budget       = $request->budget;
                        $obj->website      = $request->website_url;
                        $obj->service_name = $request->serviceName;
                        $obj->page_id      = $request->page_id;
                        $obj->save();

                        $list = Contact_us::find($obj->id);

                        // if ($list) {
                        //             require base_path("vendor/autoload.php");
                        //             $mail = new PHPMailer(true);

                        //             $mail->isSMTP();

                        //             // $mail->Host     = 'smtp.hostinger.com';
                        //             // $mail->SMTPAuth = true;
                        //             // $mail->Username = 'test@luckydeliveries.com';
                        //             // $mail->Password = 'Test@1234';
                        //             // $mail->SMTPSecure = 'ssl';
                        //             // $mail->Port     = 465;

                        //             // $mail->setFrom('test@luckydeliveries.com', 'luckydeliveries');
                        //             // $mail->addReplyTo('info@example.com', 'luckydeliveries');

                        //             $tm_email = $this->input->post('email_contact');
                        //             // Add a recipient
                        //             $mail->addAddress('info@example.com');

                        //             $subject   = "Bebran - Contact Form Details";

                        //             $mail_body  = '<html><body>';
                        //             $mail_body .= '<table rules="all" style="border-color: #666;" cellpadding="10">';

                        //             $mail_body .= "<tr><td><strong>Name:</strong> </td><td>" . $name . "</td></tr>";
                        //             $mail_body .= "<tr><td><strong>Email:</strong> </td><td>" . $email. "</td></tr>";
                        //             $mail_body .= "<tr><td><strong>Message:</strong> </td><td>" . $message . "</td></tr>";
                        //             $mail_body .= "</table>";
                        //             $mail_body .= "</body></html>";
                        //             $mail_body .= "<p>We appreciate your association. </p><p>Thank You,</p><p>www.luckydeliveries.com</p><p>PS: This is an auto generated mail, Please do not reply to this.</p>";

                        //             // Email subject
                        //             $mail->Subject = $subject;

                        //             // Set email format to HTML
                        //             $mail->isHTML(true);

                        //             $mail->Body = $mail_body;

                        //             if($mail->send()){
                        //                 echo 1111;exit;
                        //             }

                        // }

                     return redirect('/thank-you')->with('success', 'Thank you for contacting. We’ll be in touch soon!');

                }
            }
    }
    public function homeForm(Request $request){  
        if ($request->isMethod('post')) {

            $data = $request->all();
                $rules = array(
                    'name' => 'required|string|max:255',
                    'phone' => 'required|int|min:10',
                    'serviceName' => 'required',
                    'email' => 'required|string|max:255',
                    'g-recaptcha-response' => 'required',
                );

                $customMessages = ['g-recaptcha-response.required'=>'The recaptcha field is required.'];

                $url = 'https://www.google.com/recaptcha/api/siteverify';
                $remoteip = $_SERVER['REMOTE_ADDR'];
                $recaptcha_data = [
                    'secret' => '6LdReU8mAAAAANVKY00ET_E-5Zjokuzqr9lCocLD',
                    'response' => $request->{'g-recaptcha-response'},
                    'remoteip' => $remoteip
                ];
                $options = [
                        'http' => [
                        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                        'method' => 'POST',
                        'content' => http_build_query($recaptcha_data)
                    ]
                ];
                $context = stream_context_create($options);
                $result = file_get_contents($url, false, $context);
                $resultJson = json_decode($result);
                if ($resultJson->success != true) {
                    $data['recaptcha_validate'] = '';
                    $rules['recaptcha_validate'] = 'required';
                    $customMessages['recaptcha_validate.required'] = 'ReCaptcha Error';
                    //return back()->withErrors(['captcha' => 'ReCaptcha Error']);
                }

                $validator = Validator::make($data , $rules);

                if (!$validator)
                {
                    return Redirect::back()->withErrors($validator)->withInput();
                }
                else
                {
                        $obj = new Contact_us();

                        $obj->first_name   = $request->name;
                        // $obj->email        = $request->email;
                        $obj->phone        = ($request->country_code !='')?$request->country_code.$request->phone:$request['number_new'];
                        // $obj->location     = $request->location;
                        $obj->budget       = $request->budget;
                        $obj->website      = $request->website_url;
                        $obj->service_name = $request->serviceName;
                        $obj->page_id      = $request->page_id;
                        $obj->form_identity      = $request->form_identity;
                        $obj->save();

                        $list = Contact_us::find($obj->id);

                        // if ($list) {
                        //             require base_path("vendor/autoload.php");
                        //             $mail = new PHPMailer(true);

                        //             $mail->isSMTP();

                        //             // $mail->Host     = 'smtp.hostinger.com';
                        //             // $mail->SMTPAuth = true;
                        //             // $mail->Username = 'test@luckydeliveries.com';
                        //             // $mail->Password = 'Test@1234';
                        //             // $mail->SMTPSecure = 'ssl';
                        //             // $mail->Port     = 465;

                        //             // $mail->setFrom('test@luckydeliveries.com', 'luckydeliveries');
                        //             // $mail->addReplyTo('info@example.com', 'luckydeliveries');

                        //             $tm_email = $this->input->post('email_contact');
                        //             // Add a recipient
                        //             $mail->addAddress('info@example.com');

                        //             $subject   = "Bebran - Contact Form Details";

                        //             $mail_body  = '<html><body>';
                        //             $mail_body .= '<table rules="all" style="border-color: #666;" cellpadding="10">';

                        //             $mail_body .= "<tr><td><strong>Name:</strong> </td><td>" . $name . "</td></tr>";
                        //             $mail_body .= "<tr><td><strong>Email:</strong> </td><td>" . $email. "</td></tr>";
                        //             $mail_body .= "<tr><td><strong>Message:</strong> </td><td>" . $message . "</td></tr>";
                        //             $mail_body .= "</table>";
                        //             $mail_body .= "</body></html>";
                        //             $mail_body .= "<p>We appreciate your association. </p><p>Thank You,</p><p>www.luckydeliveries.com</p><p>PS: This is an auto generated mail, Please do not reply to this.</p>";

                        //             // Email subject
                        //             $mail->Subject = $subject;

                        //             // Set email format to HTML
                        //             $mail->isHTML(true);

                        //             $mail->Body = $mail_body;

                        //             if($mail->send()){
                        //                 echo 1111;exit;
                        //             }

                        // }

                     return redirect('/thank-you')->with('success', 'Thank you for contacting. We’ll be in touch soon!');
                }
            }
    }

    public function serviceForm(Request $request){

        if ($request->isMethod('post')) {

            $data = $request->all(); 
                $rules = array(
                    'name' => 'required|string|max:255',
                    'number_new' => 'required|regex:/^\+[0-9]{1,3}[0-9]{10}$/',
                    // 'email' => 'required|string|max:255|unique:contact_us,email',
                    'serviceName' => 'required',
                    'g-recaptcha-response' => 'required',
                );

                $customMessages = ['g-recaptcha-response.required'=>'The recaptcha field is required.'];

                $url = 'https://www.google.com/recaptcha/api/siteverify';
                $remoteip = $_SERVER['REMOTE_ADDR'];
                $recaptcha_data = [
                    'secret' => '6LdReU8mAAAAANVKY00ET_E-5Zjokuzqr9lCocLD',
                    'response' => $request->{'g-recaptcha-response'},
                    'remoteip' => $remoteip
                ];
                $options = [
                        'http' => [
                        'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                        'method' => 'POST',
                        'content' => http_build_query($recaptcha_data)
                    ]
                ];
                $context = stream_context_create($options);
                $result = file_get_contents($url, false, $context);
                $resultJson = json_decode($result);
                if ($resultJson->success != true) {
                    $data['recaptcha_validate'] = '';
                    $rules['recaptcha_validate'] = 'required';
                    $customMessages['recaptcha_validate.required'] = 'ReCaptcha Error';
                    //return back()->withErrors(['captcha' => 'ReCaptcha Error']);
                }

                $validator = Validator::make($data , $rules);

                if ($validator->fails())
                {
                    return Redirect::back()->withErrors($validator)->withInput();
                }
                else
                {

                        $obj = new Contact_us();

                        $obj->first_name   = $request->name;
                        // $obj->email        = $request->email;
                        $obj->phone        = ($request->country_code !='')?$request->country_code.$request->phone:$request['number_new'];
                        // $obj->location     = $request->location;
                        $obj->budget       = $request->budget;
                        $obj->website      = $request->website_url;
                        $obj->service_name = $request->serviceName;
                        $obj->page_id      = $request->page_id;
                        $obj->form_identity      = $request->form_identity;

                        $obj->save();

                        $list = Contact_us::find($obj->id);

                        // if ($list) {
                        //             require base_path("vendor/autoload.php");
                        //             $mail = new PHPMailer(true);

                        //             $mail->isSMTP();

                        //             // $mail->Host     = 'smtp.hostinger.com';
                        //             // $mail->SMTPAuth = true;
                        //             // $mail->Username = 'test@luckydeliveries.com';
                        //             // $mail->Password = 'Test@1234';
                        //             // $mail->SMTPSecure = 'ssl';
                        //             // $mail->Port     = 465;

                        //             // $mail->setFrom('test@luckydeliveries.com', 'luckydeliveries');
                        //             // $mail->addReplyTo('info@example.com', 'luckydeliveries');

                        //             $tm_email = $this->input->post('email_contact');
                        //             // Add a recipient
                        //             $mail->addAddress('info@example.com');

                        //             $subject   = "Bebran - Contact Form Details";

                        //             $mail_body  = '<html><body>';
                        //             $mail_body .= '<table rules="all" style="border-color: #666;" cellpadding="10">';

                        //             $mail_body .= "<tr><td><strong>Name:</strong> </td><td>" . $name . "</td></tr>";
                        //             $mail_body .= "<tr><td><strong>Email:</strong> </td><td>" . $email. "</td></tr>";
                        //             $mail_body .= "<tr><td><strong>Message:</strong> </td><td>" . $message . "</td></tr>";
                        //             $mail_body .= "</table>";
                        //             $mail_body .= "</body></html>";
                        //             $mail_body .= "<p>We appreciate your association. </p><p>Thank You,</p><p>www.luckydeliveries.com</p><p>PS: This is an auto generated mail, Please do not reply to this.</p>";

                        //             // Email subject
                        //             $mail->Subject = $subject;

                        //             // Set email format to HTML
                        //             $mail->isHTML(true);

                        //             $mail->Body = $mail_body;

                        //             if($mail->send()){
                        //                 echo 1111;exit;
                        //             }

                        // }

                    //  return redirect()->back()->with('success', 'Thank you for contacting. We’ll be in touch soon!'); 
                    
                    return redirect('/thank-you-lead-form')->with('success', 'Thank you for contacting. We’ll be in touch soon!');

                }
            }
    }
    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    /* Other Page Get*/
    public function seo_result_filter(Request $request, $category_id){
         
        $perPage = 20; // Define the number of results per page

        $seoResults = Page::where('display_on_off', '!=', 'Inactive')
                    ->where('posttype', 'seo')
                    ->when($category_id != 'all', function ($query) use ($category_id) {
                        return $query->whereJsonContains('business_category', $category_id);
                    })
                    ->orderBy('display_order', 'asc')
                    ->paginate($perPage);

        return response()->json($seoResults);
    }

    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    public function ShowPage(Request $request,$slug)
    {    
        
        $setting = Settings::whereIn('id', array(5, 6, 7))->get();
        
        $page = Page::where('slug',$slug)->where('status','1')->first();  
        $extra_data = array(); 
        if($page)
        {
            if ($page->redirect_to > 0 && $page->redirect_to  != 'No Redirection') {
                // $redirect_to = get_page($page->redirect_to);
                // dd($redirect_to);
                // if ($redirect_to != 'No Redirection') {
                    return redirect($page->redirect_to);
                // }
            }
            if($page->meta_title)
            {
                @$setting[0]->value = $page->meta_title;
                //@$setting[0]->value = $page->page_name;
            }

            if($page->meta_keyword)
            {
                @$setting[1]->value = $page->meta_keyword;
            }

            if($page->meta_description)
            {
                @$setting[2]->value = $page->meta_description;
            }


            $page_image = '';

            $page_url = url('/'.$page->slug);

            $site_logo = config('site.logo');

            if($page->bannerimage && File::exists(public_path('uploads/'.$page->bannerimage)) )

            {
                $page_image = asset('/uploads/'.$page->bannerimage);

            }elseif (config('site.meta_image') && File::exists(public_path('uploads/'.config('site.meta_image')))) {

                $page_image = asset('/uploads/'.config('site.meta_image'));

            }elseif ($site_logo && File::exists(public_path('uploads/'.$site_logo))) {

                $page_image = asset('/uploads/'.$site_logo);

            }
 

            $extra_data   = PageExtra::where('page_id',$page->id)->where('status',1)->orderBy('rank', 'asc')->get();

            $recentPost   = Page::where('posttype','blog')->where('status','1')->orderBy('id', 'DESC')->limit(5)->get();

            $faqData      = PageExtra::where('page_id',FAQ_Page_ID)->orderBy('rank', 'asc')->get();
            $guestPost    = GuestPost::orderBy('created_at', 'asc')->limit(5)->get();

            $categoryData = Category::where('status',1)->get();
            //---------------------------------Blog Pagination-----------------------------------

        

            // Fetch the data using offset and limit
            if($page->posttype == 'service'){
                $itemsPerPage = 3; // number of items to display per page
                $currentPage = $request->input('page', 1); // get the current page number from the request
    
                // Calculating the offset and limit values
                $offset = ($currentPage - 1) * $itemsPerPage;
                $limit = $itemsPerPage;
            }elseif($page->posttype == 'blog'){
                $itemsPerPage = 16; // number of items to display per page
                $currentPage = $request->input('page', 1); // get the current page number from the request
    
                $offset = ($currentPage - 1) * $itemsPerPage;
                $limit = $itemsPerPage;
       
            }elseif($page->id == 30){
                $itemsPerPage = 8; // number of items to display per page
                $currentPage = $request->input('page', 1); // get the current page number from the request
    
                $offset = ($currentPage - 1) * $itemsPerPage;
                $limit = $itemsPerPage;
            }else{
                $itemsPerPage = 3; // number of items to display per page
                $currentPage = $request->input('page', 1); // get the current page number from the request
    
                $offset = ($currentPage - 1) * $itemsPerPage;
                $limit = $itemsPerPage;
            }

                $blogData = Page::where('posttype', 'blog')
                ->where('status', 1)
                ->orderBy('id', 'DESC')
                ->offset($offset)
                ->limit($limit)
                ->get();
                // echo "<pre>";
                // print_r($faqData);exit;

            // Retrieve the total number of blog posts
            $totalItems = Page::where('posttype', 'blog')->where('status', 1)->count();
            $totalPages = ceil($totalItems / $itemsPerPage);


            // $blogData = Page::where('posttype','blog')->where('status','1')->orderBy('id', 'DESC')->get();

            //-----------------------------------------------------------------------------------------
            $serviceData    = Page::where('posttype','service')->where('status','1')->orderBy('id', 'ASC')->limit(8)->get();

            $followLinks    = Settings::whereIn('id', array(24,25,26,27))->get();

            // $resourceData   = Page::where('posttype','resource')->where('status','1')->orderBy('id', 'DESC')->limit(8)->get();
            $resourceData = Page::whereIn('id', [391, 393, 160, 30])
                    ->where('status', '1')
                    ->orderBy('id', 'DESC')
                    ->limit(8)
                    ->get();

            $allServiceData = Page::whereIn('posttype', ['service'])
            ->where('status', '1')
            ->orderBy('service_order', 'asc')
            ->get();


            // echo "<pre>";
            // print_r($extra_data);exit;


            $data['page']           = $page;
            $data['setting']        = $setting;
            $data['page_url']       = $page_url;
            $data['page_image']     = $page_image;
            $data['extra_data']     = $extra_data;
            $data['faqData']        = $faqData;
            $data['categoryData']   = $categoryData;
            $data['blogData']       = $blogData;
            $data['recentPost']     = $recentPost;
            $data['serviceData']    = $serviceData;
            $data['allServiceData'] = $allServiceData;
            $data['followLinks']    = $followLinks;
            $data['resourceData']   = $resourceData;
            $data['totalPages']     = $totalPages;
            $data['currentPage']    = $currentPage;
            $data['guestPost']      = $guestPost;
            $data['video']          = DB::table("video_tutorails")->where('status', 1)->get();
            $data['our_strength']   = DB::table("our_strength")->where('status', 'Active')->get();
            $data['certificate']    = DB::table("certificate_digital")->where('status', 1)->get();
            $data['tools_we_use']   = DB::table("tools_we_use")->where('status', 1)->get();
            $data['our_partners']   = DB::table("our_partners")->where('status', 1)->get();
            $data['our_work_featured']      = DB::table("our_work_featured")->where('status', 1)->get();

            // echo "<pre>";
            // print_r($page);exit;
            // $item_display_per_page = config('site.pagination');

            // $data['hospitals'] = User::where('role_id', '2')->where('status', '1')->orderBy('rank', 'asc')->paginate($item_display_per_page);

            // $data['blogs'] = Page::where('posttype','news')->where('status','1')->paginate($item_display_per_page);

            // print_r($page->id);die;

            if($page->id=='1'){

                return redirect('/');

            }elseif ($page->page_template=='1') {
                return view('frontend.home', $data);

            }elseif ($page->page_template=='3') {

                return view('frontend.pages.about', $data);

            }elseif ($page->page_template=='4') {
                // echo "<pre>";print_r($data['extra_data']); die;
                return view('frontend.pages.terms_conditions', $data);

            }elseif ($page->page_template=='5') { 
            
                return view('frontend.pages.blog_list', $data);

            }elseif ($page->page_template=='6' && $page->posttype != 'blog') {
                return view('frontend.pages.blog_details', $data);

            }elseif ($page->page_template=='8') {

                return view('frontend.pages.plan-treatment', $data);

            }elseif ($page->page_template=='9') {

                return view('frontend.pages.contact', $data);

            }elseif ($page->page_template=='10') {

                return view('frontend.pages.default', $data);

            }elseif ($page->page_template=='11') {
                $data['seo_results'] = Page::where('posttype','seo')->where('status','1')->orderBy('id', 'ASC')->get();
                $data['blogData'] = Page::where('posttype', 'blog')->where('status', 1)->where('service_id', $page->id) ->orderBy('id', 'DESC')->offset($offset)->limit($limit)->get();
                $query_from = DB::table('pages_extra')->where('page_id', 1)->where('type', 18)->first();
                
                // new table data
                $page_id = $page->id; 
                
                $package = DB::table('digital_service_price_widget')->where('service_type', $page->price_widget)->get(); 
                $package1 = DB::table('digital_service_price_widget')
                            ->select('duration_id', 'plan_duration')
                            ->where('service_type', $page->price_widget)
                            ->groupBy('duration_id','plan_duration')
                            ->get();
                
                $feature_data1 = DB::table('service_price_widgets')->where('service_page_id', $page->id)->get();
               
                $feature_data = json_decode(json_encode($feature_data1), true); 
                $digital_package_price = json_decode(json_encode($package), true); 
                $digital_package_price1 = json_decode(json_encode($package1), true); 
                // echo "<pre>";print_r($page->price_widget);die;
                
                $data_new = $data1 = $data2 = $data3 = [];
                foreach($digital_package_price as $key1 => $val1){
                         if($val1['duration_id'] == 1){
                            $data_new[] = array(
                                'id'=> $val1['id'],
                                'duration_id'=> $val1['duration_id'],
                                'plan_name'=> $val1['plan_name'],
                                'plan_duration'=> $val1['plan_duration'],
                                'most_popular'=> $val1['most_popular'],
                                'main_price'=> $val1['main_price'],
                                'percentage'=> $val1['percentage'],
                                'discount_price'=> $val1['discount_price'], 
                                'button_text'=> $val1['button_text'],
                                'service_type'=> $val1['service_type']
                                ); 
                         }
                         if($val1['duration_id'] == 2){
                            $data1[] = array(
                                'id'=> $val1['id'],
                                'duration_id'=> $val1['duration_id'],
                                'plan_name'=> $val1['plan_name'],
                                'plan_duration'=> $val1['plan_duration'],
                                'most_popular'=> $val1['most_popular'],
                                'main_price'=> $val1['main_price'],
                                'discount_price'=> $val1['discount_price'],
                                'percentage'=> $val1['percentage'], 
                                'button_text'=> $val1['button_text'],
                                'service_type'=> $val1['service_type']
                                ); 
                         }
                         if($val1['duration_id'] == 3){
                            $data2[] = array(
                                'id'=> $val1['id'],
                                'duration_id'=> $val1['duration_id'],
                                'plan_name'=> $val1['plan_name'],
                                'plan_duration'=> $val1['plan_duration'],
                                'most_popular'=> $val1['most_popular'],
                                'main_price'=> $val1['main_price'],
                                'discount_price'=> $val1['discount_price'],
                                'percentage'=> $val1['percentage'], 
                                'button_text'=> $val1['button_text'],
                                'service_type'=> $val1['service_type']
                                ); 
                         }
                         if($val1['duration_id'] == 4){
                            $data3[] = array(
                                'id'=> $val1['id'],
                                'duration_id'=> $val1['duration_id'],
                                'plan_name'=> $val1['plan_name'],
                                'plan_duration'=> $val1['plan_duration'],
                                'most_popular'=> $val1['most_popular'],
                                'main_price'=> $val1['main_price'],
                                'discount_price'=> $val1['discount_price'],
                                'percentage'=> $val1['percentage'], 
                                'button_text'=> $val1['button_text'],
                                'service_type'=> $val1['service_type']
                                ); 
                         }
                             
                        
                    }
                     $small_description = DB::table('plan_description_price_widget')->where('service_type', $page->price_widget)->get(); 
                // new table data
                 
                return view('frontend.pages.service', $data , compact('digital_package_price', 'digital_package_price1', 'page_id', 'data_new', 'data1', 'data2', 'data3','feature_data', 'small_description', 'query_from'));

            }elseif ($page->page_template=='13') {
                $data['packag_category'] = PackageCategory::where('status', '1')->orderBy('id', 'ASC')->get();
                $data['packag_plan'] = PackagePlan::where('page_id', $page->id)->where('status', '1')->orderBy('id', 'ASC')->get();
                $data['packag_type'] = PackageType::where('page_id', $page->id)->where('status', '1')->orderBy('id', 'ASC')->get();
                $data['packag_title_subtitle'] = PackageFeatureSubTitle::where('page_id', $page->id)->where('status', '1')->orderBy('title_id', 'ASC')->orderBy('rank', 'ASC')->get();
                // new table data
               $page_id = $page->id;
                
                $package = DB::table('digital_service_price_widget')->where('service_type', $page->id)->get();
                $package1 = DB::table('digital_service_price_widget')
                    ->select('duration_id', 'plan_duration')
                    ->where('service_type', $page->id)
                    ->groupBy('duration_id','plan_duration')
                    ->get();
                
                $feature_data1 = DB::table('service_price_widgets')->where('service_page_id', $page->id)->get();
               
                $feature_data = json_decode(json_encode($feature_data1), true); 
                $digital_package_price = json_decode(json_encode($package), true); 
                $digital_package_price1 = json_decode(json_encode($package1), true); 
                // echo "<pre>";print_r( $feature_data);die;
                
                $data_new = $data1 = $data2 = $data3 = [];
                foreach($digital_package_price as $key1 => $val1){
                         if($val1['duration_id'] == 1){
                            $data_new[] = array(
                                'id'=> $val1['id'],
                                'duration_id'=> $val1['duration_id'],
                                'plan_name'=> $val1['plan_name'],
                                'plan_duration'=> $val1['plan_duration'],
                                'most_popular'=> $val1['most_popular'],
                                'main_price'=> $val1['main_price'],
                                'discount_price'=> $val1['discount_price'], 
                                'percentage'=> $val1['percentage'], 
                                'button_text'=> $val1['button_text'],
                                'service_type'=> $val1['service_type']
                                ); 
                         }
                         if($val1['duration_id'] == 2){
                            $data1[] = array(
                                'id'=> $val1['id'],
                                'duration_id'=> $val1['duration_id'],
                                'plan_name'=> $val1['plan_name'],
                                'plan_duration'=> $val1['plan_duration'],
                                'most_popular'=> $val1['most_popular'],
                                'main_price'=> $val1['main_price'],
                                'discount_price'=> $val1['discount_price'], 
                                'percentage'=> $val1['percentage'], 
                                'button_text'=> $val1['button_text'],
                                'service_type'=> $val1['service_type']
                                ); 
                         }
                         if($val1['duration_id'] == 3){
                            $data2[] = array(
                                'id'=> $val1['id'],
                                'duration_id'=> $val1['duration_id'],
                                'plan_name'=> $val1['plan_name'],
                                'plan_duration'=> $val1['plan_duration'],
                                'most_popular'=> $val1['most_popular'],
                                'main_price'=> $val1['main_price'],
                                'discount_price'=> $val1['discount_price'], 
                                'percentage'=> $val1['percentage'], 
                                'button_text'=> $val1['button_text'],
                                'service_type'=> $val1['service_type']
                                ); 
                         }
                         if($val1['duration_id'] == 4){
                            $data3[] = array(
                                'id'=> $val1['id'],
                                'duration_id'=> $val1['duration_id'],
                                'plan_name'=> $val1['plan_name'],
                                'plan_duration'=> $val1['plan_duration'],
                                'most_popular'=> $val1['most_popular'],
                                'main_price'=> $val1['main_price'],
                                'discount_price'=> $val1['discount_price'], 
                                'percentage'=> $val1['percentage'], 
                                'button_text'=> $val1['button_text'],
                                'service_type'=> $val1['service_type']
                                ); 
                         }
                             
                        
                    }
                 $small_description = DB::table('plan_description_price_widget')->where('service_type', $page->id)->get();   
                // new table data  
                
                $data['seo_results'] = Page::where('posttype','seo')->where('status','1')->orderBy('id', 'ASC')->get();
                return view('frontend.pages.pricing', $data, compact('digital_package_price', 'digital_package_price1', 'page_id', 'data_new', 'data1', 'data2', 'data3','feature_data', 'small_description'));

            }
            elseif ($page->page_template=='14') {
                // this old code------------------------------
                // $data['seo_results'] = Page::where('posttype', 'seo')
                //                     ->where('status', '1')
                //                     ->orderBy('id', 'ASC')
                //                     ->paginate(20); // Fetch 20 results per page
                // $data['seo_category'] = DB::table('seoResultCategory')->get();
                // // echo "<pre>";
                // // print_r( $data['seo_results']);exit;
                // return view('frontend.pages.seo_landing', $data);
                
                // this old code------------------------------
                
                $category_id = $request->get('category_id', 'all');
                
                // Base query for SEO results
                $query = Page::where('posttype', 'seo')
                             ->where('status', '1');
                             
                
                // If a specific category is selected, add the filter to the query
                if ($category_id != 'all') {
                    $query->where('business_category', $category_id)
                    ->orderBy('display_order', 'ASC');
                }else{
                     $query->orderBy('id', 'ASC');
                }
                
                // Paginate the results
                $data['seo_results'] = $query->paginate(20); // Fetch 20 results per page
                
                // Fetch all categories
                $data['seo_category'] = DB::table('seoResultCategory')
                                        ->orderBy('id', 'asc')
                                        ->get();
                
                // Pass the selected category ID to the view
                $data['category_id'] = $category_id;
                // echo "<pre>";print_r(json_decode(json_encode($data['seo_results']), true)); die;
                return view('frontend.pages.seo_landing', $data);

            } elseif ($page->page_template=='15') {
                $pagesData = Page::all();
                $xmlContent = view('frontend.site_map', ['pages' => $pagesData])->render();
        
                $filePath = base_path('sitemap.xml');
        
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
        
                file_put_contents($filePath, $xmlContent);
                return response()->file(base_path('sitemap.xml'));

            } 
            elseif ($page->page_template=='19') {

                 // In your controller
$data['caseStudiesCategoryData'] = DB::table('pages')
    ->join('case_studies_category', 'pages.case_study_category', '=', 'case_studies_category.id')
    ->select(
        'pages.*',
        'case_studies_category.id as category_id',
        'case_studies_category.name as category_name',
        'case_studies_category.slug as category_slug',
        'pages.slug as page_slug'
    )
    ->where('pages.status', '1')
    ->where('pages.posttype', 'case-study')
    ->get()
    ->groupBy('category_slug'); // Group by category_slug


                // $data['caseStudiesCategoryData'] = json_decode(json_encode($case), true);

                $data['seo_results'] = Page::where('posttype','seo')->where('status','1')->orderBy('id', 'ASC')->get();
                // pre();
                return view('frontend.pages.case_study', $data);

            // } elseif ($page->page_template=='19') {

            //     $data['caseStudiesCategoryData'] = DB::table('case_studies')
            //         ->join('case_studies_category', 'case_studies.category_id', '=', 'case_studies_category.id')
            //         ->select('case_studies.*', 'case_studies_category.*')
            //         ->get()
            //         ->groupBy('category_id');
            
            //         $data['seo_results'] = Page::where('posttype','seo')->where('status','1')->orderBy('id', 'ASC')->get();
            //     // echo "<pre>";
            //     // print_r($caseStudiesCategory);exit;
            //     return view('frontend.pages.case_study', $data);

            }elseif ($page->id=='158') {

                return view('frontend.pages.cookies', $data);

            }elseif ($page->id=='159') {

                return view('frontend.pages.disclaimer', $data);

            }elseif ($page->id=='160') {
                
                return view('frontend.pages.submit_guest_post', $data);

            }elseif ($page->id=='161') {

                return view('frontend.pages.thank_you', $data);

            }elseif ($page->id=='171') {
                return view('frontend.pages.thank_you_guest', $data);
            }
            elseif ($page->id=='172') {
                $data['followLinks'] = Settings::whereIn('id', array(24,25,27))->get();
                // echo "<pre>";
                // print_r($data['followLinks']);exit;
                return view('frontend.pages.thank_you_lead_form', $data);
            }elseif ($page->id=='177') {
                // echo "<pre>";
                // print_r($data['followLinks']);exit;
                return view('frontend.pages.thank_you_signup', $data);
            }
            elseif ($page->id=='390') {

                return view('frontend.pages.testimonial', $data);
            }elseif ($page->id=='391') {


                $itemsPerPage = 8; // number of items to display per page
                $currentPage = $request->input('page', 1); // get the current page number from the request
                $slugData = $slug;
                // Calculate the offset and limit values
                $offset = ($currentPage - 1) * $itemsPerPage;
                $limit = $itemsPerPage;
                $totalItems = Page::where('posttype', 'news')->where('status', 1)->count();

                $totalPages = ceil($totalItems / $itemsPerPage);
                $data['totalPages']     = $totalPages;

                $data['newsData'] = Page::where('posttype', 'news')->where('status', 1)->orderBy('id', 'DESC')->offset($offset)->limit($limit)->get();
                $data['categoryData'] = NewsCategory::where('status',1)->get();
                $data['recentPost']   = Page::where('posttype','news')->where('status','1')->orderBy('id', 'DESC')->limit(5)->get();

                return view('frontend.pages.news_list', $data);

            }elseif ($page->page_template=='392') {
                
                return view('frontend.pages.news_details', $data);

            }
            
            elseif ($page->id=='388') {
                // print_r('hi');die;
                $data['portfolioCategoryData'] = DB::table('pages')
                    ->join('portfolio_category', 'pages.portfolio_category', '=', 'portfolio_category.id')
                    ->select('pages.*', 'portfolio_category.*', 'pages.slug as page_slug')
                    ->where('posttype','portfolio')
                    ->get()
                    ->groupBy('category_id');
            
                $data['seo_results'] = Page::where('posttype','seo')->where('status','1')->orderBy('id', 'ASC')->get();
                return view('frontend.pages.portfolio', $data);
            }elseif ($page->id=='389') {
                // print_r('hi');die;
                $data['sampleCategoryData'] = DB::table('sample')
                    ->join('sample_category', 'sample.category_id', '=', 'sample_category.id')
                    ->select('sample.*', 'sample_category.*')
                    ->get()
                    ->groupBy('category_id');
            
                $data['seo_results'] = Page::where('posttype','seo')->where('status','1')->orderBy('id', 'ASC')->get();
                return view('frontend.pages.sample', $data);
            }elseif ($page->id=='393') {
                // print_r('hi');die;
                // $data['mediaCoverageCategoryData'] = DB::table('media_coverage')
                //     ->join('media_coverage_category', 'media_coverage.category_id', '=', 'media_coverage_category.id')
                //     ->select('media_coverage.*', 'media_coverage_category.*')
                //     ->get()
                //     ->groupBy('category_id');
                $data['mediaCoverageCategoryData'] = DB::table('media_coverage')
                        ->where('status', '1')
                        ->get();
                $data['seo_results'] = Page::where('posttype','seo')->where('status','1')->orderBy('id', 'ASC')->get();
                return view('frontend.pages.media_coverage', $data);
            }
            elseif ($page->id=='178') {
                return view('frontend.pages.thank_you_purchase', $data);
            }
            elseif($page->page_template=='2'){

                $item_display_per_page = config('site.pagination');

                $query = User::where(['role_id'=>'3', 'status' => '1']);

                if (request()->city) {

                    if (is_array(request()->city)) {

                        foreach (request()->city as $key => $city) {

                            if ($key == 0) {

                                $query->where('city', 'like', '%' . trim($city) . '%');

                            } else {

                                $query->orWhere('city', 'like', '%' . trim($city) . '%');

                            }

                        }

                    }else{

                        $query->where('city', 'like', '%' . trim(request()->city) . '%');

                    }

                }

                if (request()->hospital) {

                    if (is_array(request()->hospital)) {

                        foreach (request()->hospital as $key => $hospital) {

                            if ($key == 0) {

                                $query->WhereHas('hospitals', function($q) use ($hospital)

                                {

                                    $q->where('name', 'like', '%' . trim($hospital) . '%');

                                });

                            } else {

                                $query->orWhereHas('hospitals', function($r) use ($hospital)

                                {

                                    $r->where('name', 'like', '%' . trim($hospital) . '%');

                                });

                            }

                        }

                    }else{

                        $query->WhereHas('hospitals', function($q) use ($hospital)

                        {

                            $q->where('name', 'like', '%' . trim(request()->hospital) . '%');

                        });

                    }

                }

                if (request()->speciality) {

                    if (is_array(request()->speciality)) {

                        foreach (request()->speciality as $key => $speciality) {

                            if ($key == 0) {

                                $query->WhereHas('user_metas', function($q) use ($speciality)

                                {

                                    $q->where('key', 'speciality')->where('value', 'like', '%' . trim($speciality) . '%');

                                });

                            } else {

                                $query->orWhereHas('user_metas', function($r) use ($speciality)

                                {

                                    $r->where('key', 'speciality')->where('value', 'like', '%' . trim($speciality) . '%');

                                });

                            }

                        }

                    }else{

                        $query->WhereHas('user_metas', function($q) use ($speciality)

                        {

                            $q->where('key', 'speciality')->where('value', 'like', '%' . trim(request()->speciality) . '%');

                        });

                    }

                }

                $doctors = $query->paginate($item_display_per_page);

                $data['doctors'] = $doctors;

                return view('frontend.pages.doctor_appointment', $data);

            }else{
                // return view('frontend.pages', $data);
                @$setting[0]->value = 'Page not found';
                return view('errors.404', compact('setting'));
            }

        }else {
            @$setting[0]->value = 'Page not found';
            return view('errors.404', compact('setting'));
        }
    }

    public function importData(Request $request)
    {
        $file = $request->file('file');

        // Validate the file

        // Process the uploaded file and save the data to the database
        Excel::import(new Contact_us, $file);

        // Optionally, you can provide feedback or redirect to a success page
        return redirect()->back()->with('success', 'Data imported successfully.');
    }

    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    /* Not Found Page Get*/

    //++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++

    public function not_found()
    {
        $setting = Settings::whereIn('id', array(5, 6, 7))->get();

        @$setting[0]->value = 'Page not found';

        return view('errors.404', compact('setting'));

    }


    // public function change_data(){
    //     $records = DB::table('pages_extra')
    //     ->where('page_id', 92)
    //     ->get();

    //     $idsToDelete = [];

    //     $newRecords = DB::table('pages')
    //             ->where('id', '!=', 92)
    //             ->where('posttype', 'pricing')
    //             ->get();

    //     foreach ($newRecords as $record) {
    //     $id = $record->id;
    //     $idsToDelete[] = $id;
    //     }
   
    //     if (!empty($idsToDelete)) {
    //         DB::table('pages_extra')
    //             ->whereIn('page_id', $idsToDelete)
    //             ->delete();
    //         }

    //         foreach ($records as $record) {
    //             foreach ($idsToDelete as $id) {
    //                 $dataToInsert = [
    //                     'page_id' => $id,
    //                     'type' => $record->type,
    //                     'section_type' => $record->section_type,
    //                     'title' => $record->title,
    //                     'image' => $record->image,
    //                     'image2' => $record->image2,
    //                     'body' => $record->body,
    //                     'sub_title' => $record->sub_title,
    //                     'btn_text' => $record->btn_text,
    //                     'btn_url' => $record->btn_url,
    //                     'rank' => $record->rank,
    //                     'status' => $record->status,
    //                     'status_show' => $record->status_show,
    //                 ];
    //                 DB::table('pages_extra')->insert($dataToInsert);
    //             }
    //         }

    //     // echo "<pre>";
    //     //  print_r($idsToDelete);exit;



    //     // $records = DB::table('pages_extra')
    //     // ->where('page_id', 185)
    //     // ->get();

    //     // $idsToAdd = [];

    //     // $newRecords = DB::table('pages')
    //     // ->where('id', '!=', 33)
    //     // ->where('posttype', 'service')
    //     // ->get();
    
    //     // foreach ($newRecords as $record) {
    //     // $newPageId = DB::table('pages')->insertGetId([
    //     //     'page_name' => $record->page_name,
    //     //     'posttype' => 'business-service',
    //     //     'meta_title' => $record->meta_title,
    //     //     'meta_keyword' => $record->meta_keyword,
    //     //     'meta_description' => $record->meta_description,
    //     //     'service_parent_id' => $record->id,
    //     //     'page_template' => $record->page_template,
    //     //     'status' => $record->status,
    //     //     // Add any other fields as needed
    //     // ]);
    //     // }
	// }

    // public function change_data(){
    //     $records = DB::table('package_feature_sub_title')
    //     ->where('page_id', 92)
    //     ->get();

    //     $idsToDelete = [];

    //     $newRecords = DB::table('pages')
    //             ->where('id', '!=', 92)
    //             ->where('posttype', 'pricing')
    //             ->get();

    //     foreach ($newRecords as $record) {
    //         $id = $record->id;
    //         $idsToDelete[] = $id;
    //     }
    //     $types_id_array = [];
    //     foreach ($records as $record) {
    //         // print_r($types); echo '<br>';
    //         foreach ($idsToDelete as $id) {
    //             $package_type 	= PackageType::where('page_id', $id)
    //                     ->where('category_id', $record->category_id)
    //                     ->where('status', '1')
    //                     ->orderby('rank', 'asc')
    //                     ->get();
    //             foreach($package_type as $types_value){
    //                 $types_id_array[] = $types_value->id;
    //             }
    //             $types = implode(',',$types_id_array);
    //             // print_r($id.'--'.$record->category_id.'//'.$types.'<br>');
    //             $condition = [
    //                 'page_id'           => $id,
    //                 'category_id'       => $record->category_id,
    //                 'title_id'             => $record->title_id,
    //                 'rank' => $record->rank,
    //                 'status' => $record->status
    //             ];
    //             // $dataToInsert = [];
    //             $dataToInsert = [
    //                 'types' => $types,
    //                 'switch' => $record->switch,
    //             ];
    //             DB::table('package_feature_sub_title')->where($condition)->update($dataToInsert);
    //         unset($types_id_array); 
    //         }
            
    //     }

    //     // echo "<pre>";
    //     // print_r($types);
    //     //  print_r($idsToDelete);exit;
	// }
     
    public function seoLandingDetails(Request $request,$slug){
        $page = Page::where('slug',$slug)->where('status','1')->first(); 
        $extra_data   = PageExtra::where('page_id',$page->id)->where('status',1)->orderBy('rank', 'asc')->get();
        $seo_extra_data   = PageExtra::where('page_id',398)->where('status',1)->orderBy('rank', 'asc')->get();

        $itemsPerPage = 3; 
        $currentPage = $request->input('page', 1); 
        $offset = ($currentPage - 1) * $itemsPerPage;
        $limit = $itemsPerPage;
        
        $blogData = Page::where('posttype', 'blog')
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->offset($offset)
            ->limit($limit)
            ->get();


        $data['page']           = $page;
        $data['extra_data']     = $extra_data;
        $data['seo_extra_data']     = $seo_extra_data;
        $data['blogData']     = $blogData;
        $data['video'] = DB::table("video_tutorails")->get(); 
        
        return view('frontend.pages.seo_landing_details',$data);
    }

    public function dynamicCityView(Request $request, $city, $slug){
        $cityExists = Cities::where('slug', $city)->first();

        if ($cityExists) {
            $getCityName = $request->segment(1); 
        
            $page = Page::where('slug', $slug)->where('status', '1')->first();
            $setting = Settings::whereIn('id', array(5, 6, 7))->get();

            if($page){
            
            if($page->posttype == 'service'){
        
            $childPage = Page::where('service_parent_id', $page->id)
                        ->where('posttype', 'city-service')
                        ->where('status', '1')
                        ->first();
                        
            
            
            if($childPage){

                if($childPage->meta_title)

                {
                    @$setting[0]->value = str_replace(['{city}', '{city1}'], [$getCityName, ucfirst($cityExists->city_name)], $childPage->meta_title);
                }
                $pageMetaTag = '';

                if($childPage->meta_tag)

                {
                    // $pageMetaTag = str_replace('{city}', $getCityName, $childPage->meta_tag);
                    $pageMetaTag = str_replace(['{city}', '{city1}'], [$getCityName, ucfirst($cityExists->city_name)], $childPage->meta_tag);

                    
                }
             
                if($childPage->meta_keyword)

                {
                    // @$setting[1]->value = str_replace('{city}', $getCityName, $childPage->meta_keyword);
                    @$setting[1]->value = str_replace(['{city}', '{city1}'], [$getCityName, ucfirst($cityExists->city_name)], $childPage->meta_keyword);
                }

                if($childPage->meta_description)

                {
                    // @$setting[2]->value = str_replace('{city}', $getCityName, $childPage->meta_description);
                    @$setting[2]->value = str_replace(['{city}', '{city1}'], [$getCityName, ucfirst($cityExists->city_name)], $childPage->meta_description);
                }

                $extra_data = PageExtra::where('page_id', $childPage->id)
                    ->where('status', 1)
                    ->orderBy('rank', 'asc')
                    ->get();
            

                foreach ($extra_data as $extra) {
                    // $extra->title = str_replace('{city}', ucfirst($getCityName), $extra->title);
                    $extra->title = str_replace(['{city}', '{city1}'], [$getCityName, ucfirst($getCityName)], $extra->title);
                    
                    // $extra->sub_title = str_replace('{city}', ucfirst($getCityName), $extra->sub_title);
                    $extra->sub_title = str_replace(['{city}', '{city1}'], [$getCityName, ucfirst($getCityName)], $extra->sub_title);
                    
                    // $extra->body = str_replace('{city}', $getCityName, $extra->body);
                    $extra->body = str_replace(['{city}', '{city1}'], [$getCityName, ucfirst($getCityName)], $extra->body);
                    
                    // $extra->btn_text = str_replace('{city}', ucfirst($getCityName), $extra->btn_text);
                    $extra->btn_text = str_replace(['{city}', '{city1}'], [$getCityName, ucfirst($getCityName)], $extra->btn_text);
                }
                
                $itemsPerPage = 3; // number of items to display per page
                $currentPage = $request->input('page', 1); 
                $offset = ($currentPage - 1) * $itemsPerPage;
                $limit = $itemsPerPage;
                
                $blogData = Page::where('posttype', 'blog')
                    ->where('status', 1)
                    ->orderBy('id', 'DESC')
                    ->offset($offset)
                    ->limit($limit)
                    ->get();

                $allServiceData = Page::whereIn('posttype', ['service'])
                    ->where('status', '1')
                    ->orderBy('service_order', 'asc')
                    ->get();

                $data['seo_results'] = Page::where('posttype','seo')->where('status','1')->orderBy('id', 'ASC')->get();
                
                $data['allServiceData'] = $allServiceData;
                $data['extra_data'] =     $extra_data;
                $data['childPage'] =      $childPage;
                $data['blogData'] =       $blogData;
                $data['setting'] =        $setting;
                $data['city_name'] =      $cityExists->city_name;
                $data['video'] = DB::table("video_tutorails")->where('status', 1)->get();
                $data['our_strength'] = DB::table("our_strength")->where('status', 'Active')->get();
                $data['tools_we_use'] = DB::table("tools_we_use")->where('status', 1)->get();
                $data['our_partners']   = DB::table("our_partners")->where('status', 1)->get();
                if($pageMetaTag){
                    $data['pageMetaTag'] = $pageMetaTag;
                }else{
                    $data['pageMetaTag'] = '';
                }
                $data['page'] = $childPage;
                
                // new table data
               $page_id = $page->id;
                
                $package = DB::table('digital_service_price_widget')->where('service_type', $page->price_widget)->get();
                $package1 = DB::table('digital_service_price_widget')
                    ->select('duration_id', 'plan_duration')
                    ->where('service_type', $page->price_widget)
                    ->groupBy('duration_id','plan_duration')
                    ->get();
                
                $feature_data1 = DB::table('service_price_widgets')->where('service_page_id', $page->price_widget)->get();
               
                $feature_data = json_decode(json_encode($feature_data1), true); 
                $digital_package_price = json_decode(json_encode($package), true); 
                $digital_package_price1 = json_decode(json_encode($package1), true); 
                // echo "<pre>";print_r( $feature_data);die;
                
                $data_new = $data1 = $data2 = $data3 = [];
                foreach($digital_package_price as $key1 => $val1){
                         if($val1['duration_id'] == 1){
                            $data_new[] = array(
                                'id'=> $val1['id'],
                                'duration_id'=> $val1['duration_id'],
                                'plan_name'=> $val1['plan_name'],
                                'plan_duration'=> $val1['plan_duration'],
                                'most_popular'=> $val1['most_popular'],
                                'main_price'=> $val1['main_price'],
                                'discount_price'=> $val1['discount_price'],
                                'percentage'=> $val1['percentage'],
                                'small_description'=> $val1['small_description'],
                                'small_features'=> $val1['small_features'],
                                'button_text'=> $val1['button_text'],
                                'service_type'=> $val1['service_type']
                                ); 
                         }
                         if($val1['duration_id'] == 2){
                            $data1[] = array(
                                'id'=> $val1['id'],
                                'duration_id'=> $val1['duration_id'],
                                'plan_name'=> $val1['plan_name'],
                                'plan_duration'=> $val1['plan_duration'],
                                'most_popular'=> $val1['most_popular'],
                                'main_price'=> $val1['main_price'],
                                'discount_price'=> $val1['discount_price'],
                                'percentage'=> $val1['percentage'],
                                'small_description'=> $val1['small_description'],
                                'small_features'=> $val1['small_features'],
                                'button_text'=> $val1['button_text'],
                                'service_type'=> $val1['service_type']
                                ); 
                         }
                         if($val1['duration_id'] == 3){
                            $data2[] = array(
                                'id'=> $val1['id'],
                                'duration_id'=> $val1['duration_id'],
                                'plan_name'=> $val1['plan_name'],
                                'plan_duration'=> $val1['plan_duration'],
                                'most_popular'=> $val1['most_popular'],
                                'main_price'=> $val1['main_price'],
                                'discount_price'=> $val1['discount_price'],
                                'percentage'=> $val1['percentage'],
                                'small_description'=> $val1['small_description'],
                                'small_features'=> $val1['small_features'],
                                'button_text'=> $val1['button_text'],
                                'service_type'=> $val1['service_type']
                                ); 
                         }
                         if($val1['duration_id'] == 4){
                            $data3[] = array(
                                'id'=> $val1['id'],
                                'duration_id'=> $val1['duration_id'],
                                'plan_name'=> $val1['plan_name'],
                                'plan_duration'=> $val1['plan_duration'],
                                'most_popular'=> $val1['most_popular'],
                                'main_price'=> $val1['main_price'],
                                'discount_price'=> $val1['discount_price'],
                                'percentage'=> $val1['percentage'],
                                'small_description'=> $val1['small_description'],
                                'small_features'=> $val1['small_features'],
                                'button_text'=> $val1['button_text'],
                                'service_type'=> $val1['service_type']
                                ); 
                         }
                             
                        
                    }
                     $small_description = DB::table('plan_description_price_widget')->where('service_type', $page->price_widget)->get(); 
                // new table data  
                // echo "<pre>";  print_r(json_decode(json_encode($page->price_widget), true)); die;
                return view('frontend.pages.dynamic_city', $data, compact('data_new', 'data1', 'data2', 'data3','feature_data', 'small_description'));

                }else{
                return view('errors.404');
                }
                }else{
                    return view('errors.404');
                }
                }else{
                    return view('errors.404');

                }


        } else {
            $getBusinessName = $request->segment(2); 
            $businessName = Business::where('slug', $getBusinessName)->first();
            
            $page = Page::where('slug', $city)->where('status', '1')->first();
     
            $setting = Settings::whereIn('id', array(5, 6, 7))->get();

            if (!$businessName || !$page || !($childPage = Page::where('service_parent_id', $page->id)->where('posttype', 'city-business-service')->where('status', '1')->first())) {
                return view('errors.404');
            }

            if($page){
            
            if($page->posttype == 'service'){

            $childPage = Page::where('service_parent_id', $page->id)->where('posttype', 'business-service')->where('status', '1')->first();

                if($childPage){

                    if($childPage->meta_title)

                    {
                        // @$setting[0]->value = str_replace('{business}', $businessName->slug, $childPage->meta_title);
                         @$setting[0]->value = str_replace(['{business}', '{business1}'], [$getBusinessName, ucfirst($getBusinessName)], $childPage->meta_title);
                    }
                    $pageMetaTag = '';

                    if($childPage->meta_tag)

                    {
                        // $pageMetaTag = str_replace('{business}', $getBusinessName, $childPage->meta_tag);
                        $pageMetaTag = str_replace(['{business}', '{business1}'], [$getBusinessName, ucfirst($getBusinessName)], $childPage->meta_tag);

                    }
                    if($childPage->meta_keyword)

                    {
                        // @$setting[1]->value = str_replace('{business}', $businessName->slug, $childPage->meta_keyword);
                        @$setting[1]->value = str_replace(['{business}', '{business1}'], [$getBusinessName, ucfirst($getBusinessName)], $childPage->meta_keyword);
                    }

                    if($childPage->meta_description)

                    {
                        // @$setting[2]->value = str_replace('{business}', $businessName->slug, $childPage->meta_description);
                        @$setting[2]->value = str_replace(['{business}', '{business1}'], [$getBusinessName, ucfirst($getBusinessName)], $childPage->meta_description);
                    }
            
                    $extra_data = PageExtra::where('page_id', $childPage->id)->where('status', 1)->orderBy('rank', 'asc')->get();
                    foreach ($extra_data as $extra) {
                        // $extra->title = str_replace('{business}', $businessName->business_name, $extra->title);
                        // $extra->sub_title = str_replace('{business}', $businessName->business_name, $extra->sub_title);
                        // $extra->body = str_replace('{business}', $businessName->business_name, $extra->body);
                        // $extra->btn_text = str_replace('{business}', $businessName->business_name, $extra->btn_text);
                        
                        // $extra->title = str_replace('{city}', ucfirst($getCityName), $extra->title);
                    $extra->title = str_replace(['{business}', '{business1}'], [$businessName->business_name, ucfirst($businessName->business_name)], $extra->title);
                    
                    // $extra->sub_title = str_replace('{city}', ucfirst($getCityName), $extra->sub_title);
                    $extra->sub_title = str_replace(['{business}', '{business1}'], [$businessName->business_name, ucfirst($businessName->business_name)], $extra->sub_title);
                    
                    // $extra->body = str_replace('{city}', $getCityName, $extra->body);
                    $extra->body = str_replace(['{business}', '{business1}'], [$businessName->business_name, ucfirst($businessName->business_name)], $extra->body);
                    
                    // $extra->btn_text = str_replace('{city}', ucfirst($getCityName), $extra->btn_text);
                    $extra->btn_text = str_replace(['{business}', '{business1}'], [$businessName->business_name, ucfirst($businessName->business_name)], $extra->btn_text);
                    }


                    $itemsPerPage = 3; 
                    $currentPage = $request->input('page', 1); 
                    $offset = ($currentPage - 1) * $itemsPerPage;
                    $limit = $itemsPerPage;
                    $blogData = Page::where('posttype', 'blog')
                                ->where('status', 1)
                                ->orderBy('id', 'DESC')
                                ->offset($offset)
                                ->limit($limit)
                                ->get();

                    $allServiceData = Page::whereIn('posttype', ['service'])
                                    ->where('status', '1')
                                    ->orderBy('service_order', 'asc')
                                    ->get();
                    $data['seo_results'] = Page::where('posttype','seo')->where('status','1')->orderBy('id', 'ASC')->get();

                    $data['childPage']              = $childPage;
                    $data['extra_data']             = $extra_data;
                    $data['allServiceData']         = $allServiceData;
                    $data['blogData']               = $blogData;
                    $data['slug']                   = $city;
                    $data['business_name']          = $businessName->business_name;
                    $data['video']                  = DB::table("video_tutorails")->where('status', 1)->get();
                    $data['our_strength']           = DB::table("our_strength")->where('status', 'Active')->get();
                    $data['tools_we_use']           = DB::table("tools_we_use")->where('status', 1)->get();
                    $data['our_partners']           = DB::table("our_partners")->where('status', 1)->get();
                    if($pageMetaTag){
                        $data['pageMetaTag'] = $pageMetaTag;
                    }else{
                        $data['pageMetaTag'] = '';
                    }
                    $data['setting'] = $setting;
                    $data['page'] = $childPage;
                    
                    // new table data
               $page_id = $page->id;
                
                $package = DB::table('digital_service_price_widget')->where('service_type', $page->price_widget)->get();
                $package1 = DB::table('digital_service_price_widget')
                    ->select('duration_id', 'plan_duration')
                    ->where('service_type', $page->price_widget)
                    ->groupBy('duration_id','plan_duration')
                    ->get();
                
                $feature_data1 = DB::table('service_price_widgets')->where('service_page_id', $page->price_widget)->get();
               
                $feature_data = json_decode(json_encode($feature_data1), true); 
                $digital_package_price = json_decode(json_encode($package), true); 
                $digital_package_price1 = json_decode(json_encode($package1), true); 
                // echo "<pre>";print_r( $feature_data);die;
                
                $data_new = $data1 = $data2 = $data3 = [];
                foreach($digital_package_price as $key1 => $val1){
                         if($val1['duration_id'] == 1){
                            $data_new[] = array(
                                'id'=> $val1['id'],
                                'duration_id'=> $val1['duration_id'],
                                'plan_name'=> $val1['plan_name'],
                                'plan_duration'=> $val1['plan_duration'],
                                'most_popular'=> $val1['most_popular'],
                                'main_price'=> $val1['main_price'],
                                'discount_price'=> $val1['discount_price'],
                                'percentage'=> $val1['percentage'], 
                                'button_text'=> $val1['button_text'],
                                'service_type'=> $val1['service_type']
                                ); 
                         }
                         if($val1['duration_id'] == 2){
                            $data1[] = array(
                                'id'=> $val1['id'],
                                'duration_id'=> $val1['duration_id'],
                                'plan_name'=> $val1['plan_name'],
                                'plan_duration'=> $val1['plan_duration'],
                                'most_popular'=> $val1['most_popular'],
                                'main_price'=> $val1['main_price'],
                                'discount_price'=> $val1['discount_price'],
                                'percentage'=> $val1['percentage'], 
                                'button_text'=> $val1['button_text'],
                                'service_type'=> $val1['service_type']
                                ); 
                         }
                         if($val1['duration_id'] == 3){
                            $data2[] = array(
                                'id'=> $val1['id'],
                                'duration_id'=> $val1['duration_id'],
                                'plan_name'=> $val1['plan_name'],
                                'plan_duration'=> $val1['plan_duration'],
                                'most_popular'=> $val1['most_popular'],
                                'main_price'=> $val1['main_price'],
                                'discount_price'=> $val1['discount_price'],
                                'percentage'=> $val1['percentage'], 
                                'button_text'=> $val1['button_text'],
                                'service_type'=> $val1['service_type']
                                ); 
                         }
                         if($val1['duration_id'] == 4){
                            $data3[] = array(
                                'id'=> $val1['id'],
                                'duration_id'=> $val1['duration_id'],
                                'plan_name'=> $val1['plan_name'],
                                'plan_duration'=> $val1['plan_duration'],
                                'most_popular'=> $val1['most_popular'],
                                'main_price'=> $val1['main_price'],
                                'discount_price'=> $val1['discount_price'],
                                'percentage'=> $val1['percentage'], 
                                'button_text'=> $val1['button_text'],
                                'service_type'=> $val1['service_type']
                                ); 
                         }
                             
                        
                    }
                     $small_description = DB::table('plan_description_price_widget')->where('service_type', $page->price_widget)->get(); 
                // new table data  

                    return view('frontend.pages.dynamic_business', $data, compact('data_new', 'data1', 'data2', 'data3','feature_data', 'small_description'));
                    }else{
                    return view('errors.404');
                    }
                }else{
                    return view('errors.404');
                }
            }else{
                return view('errors.404');
            }
        }
    }

    public function dynamicCityBusinessView(Request $request, $city, $slug, $business) { 
        // pre($city);
        $page = Page::where('slug', $slug)->where('status', '1')->first(); 
        $businessName = Business::where('slug', $business)->first();
        $citiesName = Cities::where('slug', $city)->first();
        
        
        $setting = Settings::whereIn('id', [5, 6, 7])->get(); 
        if($page){

            $childPage = Page::where('service_parent_id', $page->id)->where('posttype', 'city-business-service')->where('status', '1')->first();
            if (!$businessName || !$citiesName || !$page || !($childPage = Page::where('service_parent_id', $page->id)->where('posttype', 'city-business-service')->where('status', '1')->first())) {
                return view('errors.404');
            }
        
            foreach (['meta_title', 'meta_keyword', 'meta_description'] as $index => $field) {
                if ($childPage->$field) {
                    $setting[$index]->value = str_replace(['{business}', '{city}'], [$businessName->business_name, $citiesName->city_name], $childPage->$field);
                }
            }
            $pageMetaTag = '';
            if ($childPage->meta_tag) { 
                $search = ['{business1}', '{city1}', '{business}', '{city}'];
                $replace = [$businessName->business_name, $citiesName->city_name, $business, $citiesName->slug];
                
                $pageMetaTag = str_replace($search, $replace, $childPage->meta_tag);
            }
 
            $extra_data = PageExtra::where('page_id', $childPage->id)->where('status', 1)->orderBy('rank', 'asc')->get();
        
            foreach ($extra_data as $extra) {
                foreach (['title', 'sub_title', 'body', 'btn_text'] as $field) {
                    $extra->$field = str_replace(['{business}', '{city}'], [$businessName->business_name, $citiesName->city_name], $extra->$field);
                }
            }
        
            $itemsPerPage = 3;
            $currentPage = $request->input('page', 1); 
            $offset = ($currentPage - 1) * $itemsPerPage;
            $limit = $itemsPerPage;
            
            $blogData = Page::where('posttype', 'blog')->where('status', 1)->orderBy('id', 'DESC')->offset($offset)->limit($limit)->get();
            $allServiceData = Page::whereIn('posttype', ['service'])->where('status', '1')->orderBy('service_order', 'asc')->get();
            $data['seo_results'] = Page::where('posttype', 'seo')->where('status', '1')->orderBy('id', 'ASC')->get();
        
            $data['childPage'] = $childPage;
            $data['extra_data'] = $extra_data;
            $data['allServiceData'] = $allServiceData;
            $data['blogData'] = $blogData;
            $data['setting'] = $setting;
            $data['page'] = $childPage;
            $data['slug'] = $slug;
            $data['business_name'] = $businessName->business_name;
            $data['cities_name'] = $citiesName->city_name;
            $data['video'] = DB::table("video_tutorails")->where('status', 1)->get();
            $data['our_strength'] = DB::table("our_strength")->where('status', 'Active')->get();
            $data['tools_we_use'] = DB::table("tools_we_use")->where('status', 1)->get();
            $data['our_partners']   = DB::table("our_partners")->where('status', 1)->get();
            if($pageMetaTag){
                $data['pageMetaTag'] = $pageMetaTag; 
            }else{
                $data['pageMetaTag'] = ''; 
            }  
            // new table data
               $page_id = $page->id;
                
                $package = DB::table('digital_service_price_widget')->where('service_type', $page->price_widget)->get();
                $package1 = DB::table('digital_service_price_widget')
                    ->select('duration_id', 'plan_duration')
                    ->where('service_type', $page->price_widget)
                    ->groupBy('duration_id','plan_duration')
                    ->get();
                
                $feature_data1 = DB::table('service_price_widgets')->where('service_page_id', $page->price_widget)->get();
               
                $feature_data = json_decode(json_encode($feature_data1), true); 
                $digital_package_price = json_decode(json_encode($package), true); 
                $digital_package_price1 = json_decode(json_encode($package1), true);  
                
                $data_new = $data1 = $data2 = $data3 = [];
                foreach($digital_package_price as $key1 => $val1){
                         if($val1['duration_id'] == 1){
                            $data_new[] = array(
                                'id'=> $val1['id'],
                                'duration_id'=> $val1['duration_id'],
                                'plan_name'=> $val1['plan_name'],
                                'plan_duration'=> $val1['plan_duration'],
                                'most_popular'=> $val1['most_popular'],
                                'main_price'=> $val1['main_price'],
                                'discount_price'=> $val1['discount_price'],
                                'percentage'=> $val1['percentage'], 
                                'button_text'=> $val1['button_text'],
                                'service_type'=> $val1['service_type']
                                ); 
                         }
                         if($val1['duration_id'] == 2){
                            $data1[] = array(
                                'id'=> $val1['id'],
                                'duration_id'=> $val1['duration_id'],
                                'plan_name'=> $val1['plan_name'],
                                'plan_duration'=> $val1['plan_duration'],
                                'most_popular'=> $val1['most_popular'],
                                'main_price'=> $val1['main_price'],
                                'discount_price'=> $val1['discount_price'],
                                'percentage'=> $val1['percentage'], 
                                'button_text'=> $val1['button_text'],
                                'service_type'=> $val1['service_type']
                                ); 
                         }
                         if($val1['duration_id'] == 3){
                            $data2[] = array(
                                'id'=> $val1['id'],
                                'duration_id'=> $val1['duration_id'],
                                'plan_name'=> $val1['plan_name'],
                                'plan_duration'=> $val1['plan_duration'],
                                'most_popular'=> $val1['most_popular'],
                                'main_price'=> $val1['main_price'],
                                'discount_price'=> $val1['discount_price'],
                                'percentage'=> $val1['percentage'], 
                                'button_text'=> $val1['button_text'],
                                'service_type'=> $val1['service_type']
                                ); 
                         }
                         if($val1['duration_id'] == 4){
                            $data3[] = array(
                                'id'=> $val1['id'],
                                'duration_id'=> $val1['duration_id'],
                                'plan_name'=> $val1['plan_name'],
                                'plan_duration'=> $val1['plan_duration'],
                                'most_popular'=> $val1['most_popular'],
                                'main_price'=> $val1['main_price'],
                                'discount_price'=> $val1['discount_price'],
                                'percentage'=> $val1['percentage'], 
                                'button_text'=> $val1['button_text'],
                                'service_type'=> $val1['service_type']
                                ); 
                         }
                             
                        
                    }
                     $small_description = DB::table('plan_description_price_widget')->where('service_type', $page->price_widget)->get(); 
                // new table data 
        
            return view('frontend.pages.dynamic_city_business', $data,  compact('data_new', 'data1', 'data2', 'data3','feature_data', 'small_description'));
        }else{
            return view('errors.404');
        }
    }
    
    public function caseStudyDetails(Request $request,$slug){
        
        $page = Page::where('slug', $slug)->where('status', '1')->first();
         if($page){
            $extra_data = PageExtra::where('page_id', $page->id)->where('status', 1)->orderBy('rank', 'asc')->get();
            $blogData = Page::where('posttype', 'blog')->where('status', '1')->orderBy('id', 'DESC')->take(3)->get();
            $data['extra_data'] = $extra_data;
            $data['blogData'] = $blogData;
            $data['video'] = DB::table("video_tutorails")->get();
            // echo "<pre>";
            // print_r($data['extra_data']);exit;
            
            $data['page'] = $page;
             return view('frontend.pages.case_study_details',$data);
         }else{
            return view('errors.404');
        }
       
    }
    public function portfolioDetails(Request $request,$slug){
        
        $page = Page::where('slug', $slug)->where('status', '1')->first();
         if($page){
            //  pre($page);
            $extra_data = PageExtra::where('page_id', $page->id)->where('status', 1)->orderBy('rank', 'asc')->get();
            $blogData = Page::where('posttype', 'blog')->where('status', '1')->orderBy('id', 'DESC')->take(3)->get();
            $data['extra_data'] = $extra_data;
            $data['blogData'] = $blogData;
            $data['video'] = DB::table("video_tutorails")->get(); 
            
            $data['page'] = $page;
             return view('frontend.pages.portfolio_details',$data);
         }else{
            return view('errors.404');
        }
       
    }
    
    public function price_new(Request $request){ 
        $package = DB::table('digital_service_price_widget')->where('service_type', 113)->get();
        $package1 = DB::table('digital_service_price_widget')
                    ->select('duration_id', 'plan_duration')
                    ->where('service_type', 113)
                    ->groupBy('duration_id','plan_duration')
                    ->get();

        $digital_package_price = json_decode(json_encode($package), true);  
        $digital_package_price1 = json_decode(json_encode($package1), true); 
        
        $data = $data1 = $data2 = $data3 = [];
        
        // foreach($digital_package_price1 as $key => $val){
            
            
        // }
        foreach($digital_package_price as $key1 => $val1){
                 if($val1['duration_id'] == 1){
                    $data[] = array(
                        'id'=> $val1['id'],
                        'duration_id'=> $val1['duration_id'],
                        'plan_name'=> $val1['plan_name'],
                        'plan_duration'=> $val1['plan_duration'],
                        'most_popular'=> $val1['most_popular'],
                        'main_price'=> $val1['main_price'],
                        'discount_price'=> $val1['discount_price'],
                        'percentage'=> $val1['percentage'], 
                        'button_text'=> $val1['button_text'],
                        'service_type'=> $val1['service_type']
                        ); 
                 }
                 if($val1['duration_id'] == 2){
                    $data1[] = array(
                        'id'=> $val1['id'],
                        'duration_id'=> $val1['duration_id'],
                        'plan_name'=> $val1['plan_name'],
                        'plan_duration'=> $val1['plan_duration'],
                        'most_popular'=> $val1['most_popular'],
                        'main_price'=> $val1['main_price'],
                        'discount_price'=> $val1['discount_price'],
                        'percentage'=> $val1['percentage'], 
                        'button_text'=> $val1['button_text'],
                        'service_type'=> $val1['service_type']
                        ); 
                 }
                 if($val1['duration_id'] == 3){
                    $data2[] = array(
                        'id'=> $val1['id'],
                        'duration_id'=> $val1['duration_id'],
                        'plan_name'=> $val1['plan_name'],
                        'plan_duration'=> $val1['plan_duration'],
                        'most_popular'=> $val1['most_popular'],
                        'main_price'=> $val1['main_price'],
                        'discount_price'=> $val1['discount_price'],
                        'percentage'=> $val1['percentage'], 
                        'button_text'=> $val1['button_text'],
                        'service_type'=> $val1['service_type']
                        ); 
                 }
                 if($val1['duration_id'] == 4){
                    $data3[] = array(
                        'id'=> $val1['id'],
                        'duration_id'=> $val1['duration_id'],
                        'plan_name'=> $val1['plan_name'],
                        'plan_duration'=> $val1['plan_duration'],
                        'most_popular'=> $val1['most_popular'],
                        'main_price'=> $val1['main_price'],
                        'discount_price'=> $val1['discount_price'],
                        'percentage'=> $val1['percentage'], 
                        'button_text'=> $val1['button_text'],
                        'service_type'=> $val1['service_type']
                        ); 
                 }
                     
                
            }
         $small_description = DB::table('plan_description_price_widget')->where('service_type', $page->price_widget)->get(); 
       
        //  echo "<pre>";print_r($data3);
        // die;
        // echo "<pre>";print_r($digital_package_price1); die;
        return view('frontend.price_widget', compact('digital_package_price', 'digital_package_price1', 'data', 'data1', 'data2', 'data3', 'small_description'));
    }
    
    
    //  user authentication fuction 
    public function user_login(Request $request){
        // dd($request->all());
        // if(isset($request['submit'])){
        
            
        // }else{
        if ($request->has('returnUrl')) {
            $request->session()->put('returnUrl', $request['returnUrl']);
        }
            return view('frontend.login');
        // }
    }
    // public function user_register(Request $request){ 
        
    //     if($request['register']){
    //       // Validate the form data
    //         $validator = Validator::make($request->all(), [
    //             'first_name' => 'required|string|max:255',
    //             'last_name' => 'required|string|max:255',
    //             'email' => 'required|email|unique:users|max:255',
    //             'phone' => 'required|string|max:15',
    //             'password' => 'required|string|min:8|confirmed',
    //         ]);
    
    //         // If validation fails, return back with errors
    //         if ($validator->fails()) {
    //             return redirect()->back()
    //                 ->withErrors($validator)
    //                 ->withInput();
    //         }
    //         // If validation passes, create new user and store in the database
    //       $data = [
    //             'first_name' => $request['first_name'],
    //             'last_name' => $request['last_name'],
    //             'email' => $request['email'],
    //             'phone' => $request['phone'],
    //             'password' => bcrypt($request['password']),  
    //             'confirm_password' => bcrypt($request['password_confirmation']), 
                
    //         ]; 
            
    //         if(!empty($data)){
    //             $result = DB::table('clients')->insert($data);
    //             if($result){
    //                  return redirect()->route('user.login')->with('success', 'Registration successful! Please login to continue.');
    //             }
    //         }
                 
       
    //     }
    // }
    public function user_register(Request $request){ 
        if($request->isMethod('post') && $request->has('register')) {
            // Validate the form data
            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users|max:255',
                'phone' => 'required|string|max:15',
                'password' => 'required|string|min:8|confirmed',
            ]);
    
            // If validation fails, return back with errors
            if ($validator->fails()) {
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }
    
            // If validation passes, create new user and store in the database
            $data = [
                'first_name' => $request['first_name'],
                'last_name' => $request['last_name'],
                'email' => $request['email'],
                'phone' => $request['phone'],
                'password' => bcrypt($request['password']),  
                'confirm_password' => bcrypt($request['password_confirmation']), 
            ]; 
    
            if(!empty($data)){
                $result = DB::table('clients')->insert($data);
                if($result){
                    // Check if returnUrl exists in the session and append it to the login route
                    $returnUrl = $request->session()->get('returnUrl');
                    if ($returnUrl) {
                        return redirect()->route('user.login', ['returnUrl' => $returnUrl])
                            ->with('success', 'Registration successful! Please login to continue.');
                    }
                    return redirect()->route('user.login')
                        ->with('success', 'Registration successful! Please login to continue.');
                }
            }
        } else {
            // Check for returnUrl in the query parameters and save it in the session
            if ($request->has('returnUrl')) {
                $request->session()->put('returnUrl', $request->query('returnUrl'));
            }
    
            return view('frontend.register');
        }
    }

    
   
    /* user Login POST */
    
    
// 	public function doLogin(Request $request){
// 		// Creating Rules for Email and Password 
// 		$rules = array(
// 			'login_email' => 'required|email', // make sure the email is an actual email
// 			'login_password' => 'required|min:8'
// 		);
		 
// 		// password has to be greater than 3 characters and can only be alphanumeric and);
// 		// checking all field
// 		$validator = Validator::make($request->all() , $rules);
		
		 
// 		// if the validator fails, redirect back to the form
// 		if ($validator->fails()){
// 			return Redirect::to('login')->withErrors($validator) // send back all errors to the login form
// 			->withInput(request()->except('password')); // send back the input (not the password) so that we can repopulate the form
// 		}else{
// 			// create our user data for the authentication
// 			$userdata = array(
// 				'email' => $request->login_email,
// 				'password' => $request->login_password
// 			); 

			
// 			$client = DB::table('clients')->where('email', $userdata['email'])->first(); 
			
//             if ($client && Hash::check($userdata['password'], $client->password)) { 
                
//                 // Authentication was successful
//                 // Auth::login($client);
//                 session()->put('client_data', $client); 
//                 return redirect()->intended(route('main_page'));  // Redirect to the intended page or dashboard
//             }
        
//             // Authentication failed
//             return back()->withErrors([
//                 'email' => 'The provided credentials do not match our records.',
//             ]);
// 		}
// 	}
    public function doLogin(Request $request){
    // Creating Rules for Email and Password 
    $rules = array(
        'login_email' => 'required|email', // make sure the email is an actual email
        'login_password' => 'required|min:8'
    );
     
    // password has to be greater than 3 characters and can only be alphanumeric and);
    // checking all field
    $validator = Validator::make($request->all(), $rules);
    
    // if the validator fails, redirect back to the form
    if ($validator->fails()){
        return Redirect::to('login')->withErrors($validator) // send back all errors to the login form
        ->withInput(request()->except('password')); // send back the input (not the password) so that we can repopulate the form
    } else {
        // create our user data for the authentication
        $userdata = array(
            'email' => $request->login_email,
            'password' => $request->login_password
        ); 

        $client = DB::table('clients')->where('email', $userdata['email'])->first(); 
        
        if ($client && Hash::check($userdata['password'], $client->password)) { 
            // Authentication was successful
            session()->put('client_data', $client);

            // Check if there is a returnUrl in the session and redirect to it
            if ($request->session()->has('returnUrl')) {
                $returnUrl = $request->session()->pull('returnUrl'); // Retrieve and remove the returnUrl from session
                return redirect()->intended($returnUrl);
            }

            // Default redirect after login
            return redirect()->intended(route('main_page')); // Redirect to the intended page or dashboard
        }

        // Authentication failed
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}

	
	public function purchase(Request $request){
	    
        $duration = DB::table('digital_service_price_widget')
                    // ->select('duration_id', 'plan_duration', 'discount_price', 'main_price')
                    ->where('id', $request['id']) 
                    ->first();
                    
        $duration_name = DB::table('digital_service_price_widget')
                        ->select('plan_name')
                        ->where('service_type', $request['service_id'])
                        ->orderBy('plan_name', 'ASC')
                        ->groupBy('plan_name') 
                        ->get();

        
        $duration_new = json_decode(json_encode($duration), true);
        $duration_plan = json_decode(json_encode($duration_name), true);
        // echo"<pre>"; print_r($duration_new); die;
        return view('frontend.purchase', compact('duration_new')); 
    }
    public function next_step(){ 
        return view('frontend.purchase_second');
    }
	public function purchase_second(Request $request){ 
        // $duration = DB::table('digital_service_price_widget')
        //             // ->select('duration_id', 'plan_duration', 'discount_price', 'main_price')
        //             ->where('id', $request['id']) 
        //             ->first();
                    
        // $duration_name = DB::table('digital_service_price_widget')
        //                 ->select('plan_name')
        //                 ->where('service_type', $request['service_id'])
        //                 ->orderBy('plan_name', 'ASC')
        //                 ->groupBy('plan_name') 
        //                 ->get();

        
        // $duration_new = json_decode(json_encode($duration), true);
        // $duration_plan = json_decode(json_encode($duration_name), true);
        // // echo"<pre>"; print_r($duration_new); die;
        return view('frontend.purchase_second'); 
    }
	   
	public function addToCart(Request $request)
    {  
        $servicePlan = $request->input('service_main');
        $packagePlan = $request->input('package_plan');
        $planDuration = $request->input('plan_duration');
        $serviceAddon = $request->input('addon_service');   
        
        if($packagePlan > 0){
            
            $package_id = DB::table('digital_service_price_widget')->where('service_type', $servicePlan)->where('plan_duration', $planDuration)->where('plan_name', $packagePlan)->first();
            $package = json_decode(json_encode($package_id), true); 
            
            // dd($package);
            
            
            $clients = session()->get('client_data');
            $client_data = json_decode(json_encode($clients), true); 
            
            $arr = [
                'client_id' => $client_data['id'],
                'product_id' => $package['id'], 
                'name' => $package['plan_name'],
                'price' => $package['discount_price'],
                'service_id' => $serviceAddon,
                'plan_duration' => $planDuration,
                'website' =>$request['website'],
                'service' =>$servicePlan,
                'competitor' => $request['competitor']
            ]; 
            $resuylt = DB::table('cart_items')->insert($arr); 
            if($resuylt){ 
                // return redirect()->route('checkout.show');
                return redirect()->route('cart.show');
            } 
        }  
    }
    public function showCart()
    { 
        $clientData = session()->get('client_data'); 
        $cartItems = collect(); 
        
        if ($clientData && isset($clientData->id)) { 
            $cartItems = DB::table('cart_items')->where('client_id', $clientData->id)->get();
        }
     
        $client_data = $cartItems->toArray();
        $arr = $price = $addon = [];
        
        if (!empty($client_data)) {
            foreach ($client_data as $key => $val) {
                $package = DB::table('digital_service_price_widget')->where('id', $val->product_id)->first();
                $service_name = DB::table('pages')->where('id', $package->service_type)->first();
                $service_addon = DB::table('digital_service_price_widget')
                    ->where('plan_name', $val->name)
                    ->where('plan_duration', $val->plan_duration)
                    ->where('service_type', $val->service_id)
                    ->first();
    
                $arr[] = [
                    'small_features' => $package->small_features,
                    'main_price' => $package->main_price,
                    'discount_price' => $package->discount_price,
                    'package_name' => $package->plan_name,
                    'package_duration' => $package->plan_duration,
                    'service_name' => $service_name->page_name,
                    'service_addon_price' => $service_addon->discount_price ?? 0,  
                    'service_addon_id' => $service_addon->service_type ?? null,
                    'cart_id' => $val->id,
                ];
    
                $price[] = $package->discount_price;
                $addon[] = $service_addon->discount_price ?? 0; 
            }
        }
    
        $subtotal = array_sum($price);
        $addtotal = array_sum($addon);
    
        return view('frontend.cart', compact('arr', 'subtotal', 'addtotal'));
    }

    public function showCart_old()
    { 
        $cartItems = DB::table('cart_items')->where('client_id', session()->get('client_data')->id)->get(); 
        $client_data = json_decode(json_encode($cartItems), true);
        $arr = $price = $addon = []; 
        if(!empty($client_data)){
            foreach($client_data as $key =>$val){ 
                $package = DB::table('digital_service_price_widget')->where('id', $val['product_id'])->first();
                $service_name = DB::table('pages')->where('id', $package->service_type)->first();
                $service_addon = DB::table('digital_service_price_widget')->where('plan_name', $val['name'])->where('plan_duration', $val['plan_duration'])->where('service_type', $val['service_id'])->first();
                $arr[] = [
                    'small_features'=> $package->small_features,
                    'main_price'=> $package->main_price,
                    'discount_price'=> $package->discount_price,
                    'package_name'=> $package->plan_name,
                    'package_duration'=> $package->plan_duration,
                    'service_name'=> $service_name->page_name,
                    'service_addon_price'=> $service_addon->discount_price,
                    'service_addon_id'=> $service_addon->service_type,
                    'cart_id'=> $val['id']
                    ];
                    
                $price[] = $package->discount_price;
                $addon[] = $service_addon->discount_price;
            }
        } 
        $subtotal = array_sum($price);
        $addtotal = array_sum($addon); 
        
        return view('frontend.cart', compact('arr', 'subtotal', 'addtotal'));
    }
    
    //  change cart plan duariton 
    public function change_plan_duration(Request $request){
        
        $cart_id = DB::table('cart_items')->where('id', $request['Cartid'])->first();
        $plan_package_id = DB::table('digital_service_price_widget')->where('plan_duration',$request['value1'])->where('plan_name', $cart_id->name)->where('service_type', $cart_id->service)->first(); 
        
        if($cart_id){
            $result = DB::table('cart_items')->where('id', $request['Cartid'])->update(['plan_duration'=> $request['value1'], 'product_id'=>$plan_package_id->id]);
            if($result){
                return response()->json(['status'=> 1, 'message'=> 'cart update succesfully!']);
            }
        }
    }
    
    public function delete_cart(Request $request){
        
        $cart_id = DB::table('cart_items')->where('id', $request['Cartid'])->first();  
        if($cart_id){
            $result = DB::table('cart_items')->where('id', $request['Cartid'])->delete();
            if($result){
                return response()->json(['status'=> 1, 'message'=> 'Cart Delete Succesfully!']);
            }
        }
    }
    
    
    
    public function checkout()
    { 
        $country = DB::table('countries')->get(); 
        $cart = DB::table('cart_items')->where('client_id', session()->get('client_data')->id)->get(); 
        $arr = []; 
        
        foreach($cart as $key => $val){
            $mainPrice  = DB::table('digital_service_price_widget')->where('id', $val->product_id)->first();
            $addon_price  = DB::table('digital_service_price_widget')->where('service_type', $val->service_id)->where('plan_name', $val->name)->where('plan_duration', $val->plan_duration)->first();
            
            $arr[] = [
                'main_serviec_price'=> $mainPrice->discount_price,
                'addon_serviec_price'=> $addon_price->discount_price,
                ];  
        } 
        
        $main_service_price = $arr[0]['main_serviec_price'];
        $addon_service_price = $arr[0]['addon_serviec_price'];
        
        $arr['total'] = $main_service_price + $addon_service_price;
        $arr['tax'] = $arr['total'] * 0.18; // Calculate 18% tax
        $arr['total_with_tax'] = $arr['total'] + $arr['tax'];
        
        
        session()->put('cart_vlaue', $arr);
        return view('frontend.checkout', compact('country', 'arr'));
    }
	
	public function value_total(Request $request){   
         
            session()->forget('total_amount');
            
            // Fetch the main service price
            $mainPrice = DB::table('digital_service_price_widget')
                            ->where('service_type', $request->input('service_id'))
                            ->where('plan_name', $request->input('value1'))
                            ->where('plan_duration', $request->input('value2'))
                            ->first();
            
            if (!$mainPrice) {
                return response()->json(['error' => 'Main price not found'], 404);
            }
            
            $main_serviec_price = $mainPrice->discount_price;
         
            $addon_serviec_price = 0;
            if ($request->input('value3')) {
                $addonPrice = DB::table('digital_service_price_widget')
                                ->where('service_type', $request->input('value3'))
                                ->where('plan_name', $request->input('value1'))
                                ->where('plan_duration', $request->input('value2'))
                                ->first();
                
                if ($addonPrice) {
                    $addon_serviec_price = $addonPrice->discount_price;
                }
            }
             
            $total = $main_serviec_price + $addon_serviec_price;
            session()->put('total_amount', $total); 
            return response()->json(['total' => $total]);
        }

// 	public function checkout_client(Request $request)
//     { 
//         dd($request->all());
//         if($request->all()){
//         $data = [
//             'client_id' => $request->input('client_id'),
//             'bill_first_name' => $request->input('bill_first_name'),
//             'bill_last_name' => $request->input('bill_last_name'),
//             'bill_email' => $request->input('bill_email'),
//             'bill_phone' => $request->input('bill_phone'),
//             'bill_company' => $request->input('bill_company'),
//             'bill_address1' => $request->input('bill_address1'),
//             'bill_address2' => $request->input('bill_address2'),
//             'bill_zip' => $request->input('bill_zip'),
//             'bill_city' => $request->input('bill_city'),
//             'bill_country' => $request->input('bill_country'),
//             'same_ship_address' => $request->has('same_ship_address') ? true : false
//         ];
//         if($data){
//              Session::put('shipping_address', $shipping);
//         }
//         // Insert data into the orders table
//         // DB::table('orders')->insert($data);
//         }
//     }
	
	public function checkout_client(Request $request)
    {   
            $user_id = session()->get('client_data')->id;
            if (!empty($request->all())) {
                $shipping = [
                    "client_id"=>$user_id,
                    "bill_first_name" => $request->bill_first_name,
                    "bill_business_name" => $request->bill_business_name,
                    "bill_email" => $request->bill_email,
                    "bill_phone" => $request->bill_phone,
                    "tax" => $request->tax, 
                    "bill_address" => $request->bill_address2,
                    "bill_zip" => $request->bill_zip,
                    "bill_city" => $request->bill_city,
                    "bill_country" => $request->bill_country,
                ];
                
             if(!empty($shipping)){
                 
                 $result = DB::table('client_address')->insert($shipping);
                 if($result){ 
                     return redirect()->route('front.checkout.payment'); 
                 }
             }
            }
            
    }
    
	public function logout(Request $request)
    { 
        session()->forget('client_data'); // Clear the specific session variable
        session()->flush(); // Clear all session data
        return redirect()->route('main_page');  
    }
    
    //  payment funtion 
    public function payment()
    { 
        $cart =  DB::table('cart_items')->where('client_id', session()->get('client_data')->id)->get(); 
        $client_address = DB::table('client_address')->where('client_id', session()->get('client_data')->id)->first(); 
        $total_tax = 0;
        $cart_total = 0;
        $total = 0;

        foreach ($cart as $key => $item) {

            // $total += ($item['price'] + $item['attribute_price']) * $item['qty'];
            $total += $item->price;
            $cart_total = $total;  
        }
        $shipping = [];
      
        // $discount = [];
        // if (Session::has('coupon')) {
        //     $discount = Session::get('coupon');
        // }

        // if (!PriceHelper::Digital()) {
        //     $shipping = null;
        // }
        
        $grand_total = $cart_total;
        // $grand_total = $grand_total - ($discount ? $discount['discount'] : 0);
        // $state_tax = Auth::check() && Auth::user()->state_id ? ($cart_total * Auth::user()->state->price) / 100 : 0;
        // $grand_total = $grand_total + $state_tax;


        $total_amount = $grand_total;

        $data['cart'] = $cart;
        $data['cart_total'] = $cart_total;
        $data['grand_total'] = $total_amount;
        // $data['discount'] = $discount;
        // $data['shipping'] = $shipping;
        // $data['tax'] = $total_tax;
        $data['payments'] = DB::table('payment_settings')->whereStatus(1)->get();
        
        // dd($data);
        return view('frontend.payment', $data, compact('client_address'));
    }
    
    
     public function checkout_submit(Request $request)
        {
    
    
            $input = $request->all();
            
            $checkout = false;
            $payment_redirect = false;
            $payment = null;
    
            if (Session::has('currency')) { 
                $currency = DB::table('currencies')->findOrFail(Session::get('currency'));
            } else { 
                $currency = DB::table('currencies')->where('is_default', 2)->first();
            }
            
             
            $usd_supported = array(
                "USD", "AED", "AFN", "ALL", "AMD", "ANG", "AOA", "ARS", "AUD", "AWG",
                "AZN", "BAM", "BBD", "BDT", "BGN", "BIF", "BMD", "BND", "BOB", "BRL",
                "BSD", "BWP", "BYN", "BZD", "CAD", "CDF", "CHF", "CLP", "CNY", "COP",
                "CRC", "CVE", "CZK", "DJF", "DKK", "DOP", "DZD", "EGP", "ETB", "EUR",
                "FJD", "FKP", "GBP", "GEL", "GIP", "GMD", "GNF", "GTQ", "GYD", "HKD",
                "HNL", "HTG", "HUF", "IDR", "ILS", "INR", "ISK", "JMD", "JPY", "KES",
                "KGS", "KHR", "KMF", "KRW", "KYD", "KZT", "LAK", "LBP", "LKR", "LRD",
                "LSL", "MAD", "MDL", "MGA", "MKD", "MMK", "MNT", "MOP", "MUR", "MVR",
                "MWK", "MXN", "MYR", "MZN", "NAD", "NGN", "NIO", "NOK", "NPR", "NZD",
                "PAB", "PEN", "PGK", "PHP", "PKR", "PLN", "PYG", "QAR", "RON", "RSD",
                "RUB", "RWF", "SAR", "SBD", "SCR", "SEK", "SGD", "SHP", "SLE", "SOS",
                "SRD", "STD", "SZL", "THB", "TJS", "TOP", "TRY", "TTD", "TWD", "TZS",
                "UAH", "UGX", "UYU", "UZS", "VND", "VUV", "WST", "XAF", "XCD", "XOF",
                "XPF", "YER", "ZAR", "ZMW"
            );
    
            
            $paypal_supported = ['USD','EUR', 'AUD', 'BRL', 'CAD', 'HKD', 'JPY', 'MXN', 'NZD', 'PHP', 'GBP', 'RUB'];
            $paystack_supported = ['NGN', "GHS"]; 
            switch ($input['payment_method']) {
                    
                case 'Stripe':
                    if (!in_array($currency->name, $usd_supported)) { 
                        Session::flash('error', __('Currency Not Supported'));
                        return redirect()->back();
                    }
                    $checkout = true;
                    $payment_redirect = true;
                    $payment = $this->stripeSubmit($input);
                    break;
    
                case 'Paypal':
                    if (!in_array($currency->name, $paypal_supported)) { 
                        Session::flash('error', __('Currency Not Supported')); 
                        return redirect()->back();
                    } 
                    $checkout = true;
                    $payment_redirect = true;
                    $payment = $this->paypalSubmit($input);
                    break; 
      
            }
    
    
    
            if ($checkout) {
                if ($payment_redirect) {
                    if ($payment['status']) {
                        return redirect()->away($payment['link']);
                    } else {
                        Session::put('message', $payment['message']);
                        return redirect()->route('front.checkout.cancle');
                    }
                } else {
                    if ($payment['status']) {
                        // return redirect()->route('front.checkout.success');
                        return redirect()->route('thank_page');
                    } else {
                        Session::put('message', $payment['message']);
                        return redirect()->route('front.checkout.cancle');
                    }
                }
            } else {
                return redirect()->route('front.checkout.cancle');
            }
        }
        
        
    //  stripe submit data 
     public function stripeSubmit($data)
        {
             
            $user = session()->get('client_data'); 
            $arr = session()->get('cart_vlaue');
            $cart = DB::table('cart_items')->where('client_id', $user->id)->get();
            // $total = [];
            // foreach($cart as $key => $price){ 
            //     $total[] = $price->price;
            // }
            // $total_amount = array_sum($total); 
            $total_amount = (int) $arr['total_with_tax']; 
            // print_r($total_amount); die;
            $total_tax = (int) $arr['tax'];
            $cart_total = 0;
            $total = 0;
            $option_price = 0; 
            
            $orderData['cart'] = json_encode($cart, true);  
            $orderData['tax'] = $total_tax; 
            $orderData['shipping_info'] = json_encode(Session::get('shipping_address'), true);
            $orderData['billing_info'] = json_encode(Session::get('billing_address'), true);
            $orderData['payment_method'] = 'Stripe';
            $orderData['user_id'] = isset($user) ? $user->id : 0;
            $orderData['transaction_number'] = Str::random(10);
            $orderData['currency_sign'] = PriceHelper::setCurrencySign(); 
            $orderData['order_status'] = 'Pending';
            
            
            // $stripe = new \Stripe\StripeClient(config('services.stripe.secret'));
            $stripe = STPR\Stripe::setApiKey(env('STRIPE_SECRET'));
            // dd($stripe);
            try {
    
                $notify_url = route('front.checkout.redirect') . '?session_id={CHECKOUT_SESSION_ID}';
                $response = \Stripe\Checkout\Session::create([
                    'success_url' => $notify_url,
                    'customer_email' => Session::get('shipping_address')['ship_email'],
                    'payment_method_types' => ['card'],
    
                    'line_items' => [
                        [
                            'price_data' => [
                                'product_data' => [
                                    'name' => 'Bebran' . ' ' . __('Order'),
                                ],
                                'unit_amount' => 100 * $total_amount,
                                'currency' => PriceHelper::setCurrencyName(),
                            ],
                            'quantity' => 1
                        ],
                    ],
    
                    'mode' => 'payment',
                    'allow_promotion_codes' => false,
                ]);
                Session::put('order_data', $orderData);
                Session::put('order_input_data', $data);
                return [
                    'status' => true,
                    'link' => $response['url']
                ];
            } catch (Exception $e) {
                return [
                    'status' => false,
                    'message' => $e->getMessage()
                ];
            }
        }
        
    
    public function paymentRedirect(Request $request)
        {
            $responseData = $request->all();
            // dd($responseData);
            if (isset($responseData['session_id'])) {
                $payment = $this->stripeNotify($responseData);
                if ($payment['status']) {
                    // return redirect()->route('front.checkout.success');
                    return redirect()->route('thank_page');
                } else {
                    Session::put('message', $payment['message']);
                    return redirect()->route('front.checkout.cancle');
                }
            } elseif (Session::has('order_payment_id')) {
                $payment = $this->paypalNotify($responseData);
                if ($payment['status']) {
                    return redirect()->route('thank_page');
                    // return redirect()->route('front.checkout.success');
                } else {
                    Session::put('message', $payment['message']);
                    return redirect()->route('front.checkout.cancle');
                }
            } else {
                return redirect()->route('front.checkout.cancle');
            }
        }
        
    public function stripeNotify($resData)
        {

        $stripe = STPR\Stripe::setApiKey(env('STRIPE_SECRET'));
        
        $response = \Stripe\Checkout\Session::retrieve($resData['session_id']); 
        if ($response['payment_status'] == 'paid' && $response['status'] == 'complete') {
            $cart = DB::table('cart_items')->where('client_id', session()->get('client_data')->id)->get();
            $user = session()->get('client_data');
            $total_tax = 0;
            $cart_total = 0;
            $total = 0;
            $option_price = 0;
            $total = [];
            foreach($cart as $key => $price){ 
                $total[] = $price->price;
            }
            $total_amount = array_sum($total); 

            $orderData = Session::get('order_data');
            $orderData['txnid'] = $response['payment_intent'];
            $orderData['payment_status'] = 'Paid'; 
            
             
            $order = DB::table('orders')->insert($orderData); 
            if ($order) {
                $lastInsertedId = DB::getPdo()->lastInsertId(); 
                $currentDate = date('Ymd'); // Format current date as YYYYMMDD
                $new_txn = 'ORD-' . str_pad($currentDate, 4, '0', STR_PAD_LEFT) . '-' . $lastInsertedId; 
                
                $update_arr = [
                    'transaction_number' => $new_txn
                ];
            
                if (!empty($update_arr)) {
                    $order_update = DB::table('orders')->where('id', $lastInsertedId)->update($update_arr);
                }
            }
             
            Session::put('order_id', $lastInsertedId);
            Session::forget('cart');
            DB::table('cart_items')->where('client_id',session()->get('client_data')->id)->delete();
            Session::forget('order_data');
            Session::forget('order_payment_id');
            return [
                'status' => true
            ];
        } else {
            return [
                'status' => false,
                'message' => 'Payment Failed'
            ];
        }
    }
    
     public function paymentSuccess()
        {
            if (Session::has('order_id')) {
                $order_id = Session::get('order_id');
                $order = DB::table('orders')->find($order_id);
                $cart = json_decode($order->cart, true);
                // $setting = Setting::first();
                // if ($setting->is_twilio == 1) {
                //     // message
                //     $sms = new SmsHelper();
                //     $user_number = $order->user->phone;
                //     if ($user_number) {
                //         $sms->SendSms($user_number, "'purchase'");
                //     }
                // }
                return view('frontend.success', compact('order', 'cart'));
            }
            return redirect()->route('main_page');
        }
    
    
    
    public function paymentCancle()
        {
                $message = '';
                if (Session::has('message')) {
                    $message = Session::get('message');
                    Session::forget('message');
                } else {
                    $message = __('Payment Failed!');
                }
                Session::flash('error', $message);
                return redirect()->route('front.checkout.payment');
            }
            
            
        //  paypal payment gateway intregation
    public function paypalSubmit($data)
    { 
        
        $Paypal_payment = DB::table('payment_settings')->where('name', 'Paypal')->first(); 
        // dd($Paypal_payment);
        $secret = json_decode($Paypal_payment->information); 
        
        $gateway = Omnipay::create('PayPal_Rest');
        $gateway->setClientId($secret->client_id);
        $gateway->setSecret($secret->client_secret);
        $gateway->setTestMode(true); // Set to false for live transactions
        
        
        $user = session()->get('client_data'); 
        $arr = session()->get('cart_vlaue');
            $cart = DB::table('cart_items')->where('client_id', $user->id)->get();
            // $total = [];
            // foreach($cart as $key => $price){ 
            //     $total[] = $price->price;
            // }
            // $total_amount = array_sum($total); 
            $total_amount = number_format($arr['total_with_tax'], 2); 
            $total_tax = number_format($arr['tax'], 2);
        $cart_total = 0;
        $total = 0;
        $option_price = 0; 
        
        $orderData['cart'] = json_encode($cart, true);  
        $orderData['tax'] = $total_tax; 
        $orderData['shipping_info'] = json_encode(Session::get('shipping_address'), true);
        $orderData['billing_info'] = json_encode(Session::get('billing_address'), true);
        $orderData['payment_method'] = 'Stripe';
        $orderData['user_id'] = isset($user) ? $user->id : 0;
        $orderData['transaction_number'] = Str::random(10);
        $orderData['currency_sign'] = PriceHelper::setCurrencySign(); 
        $orderData['order_status'] = 'Pending';
        $paypal_item_name = 'Payment via paypal from' . ' ' . 'bebran';
        $paypal_item_amount =  $total_amount;

        $payment_cancel_url = route('front.checkout.cancle');
        $payment_notify_url = route('front.checkout.redirect');
        
        
        
        try {
           
            $response = $gateway->purchase(array(
                'amount' => $paypal_item_amount,
                'currency' => PriceHelper::setCurrencyName(),
                'returnUrl' => $payment_notify_url,
                'cancelUrl' => $payment_cancel_url
            ))->send();
            
            if ($response->isRedirect()) {

                Session::put('order_data', $orderData);
                Session::put('order_input_data', $data);
                Session::put('order_payment_id', $response->getTransactionReference());
                if ($response->redirect()) {
                    /** redirect to paypal **/

                    return [
                        'status' => true,
                        'link' => $response->redirect()
                    ];
                }
            } else {
                dd($response->getMessage());
                return $response->getMessage();
            }
        } catch (\Throwable $th) {

            return [
                'status' => false,
                'message' => $th->getMessage()
            ];
        }
    }
    
    public function paypalNotify($resData)
        {

       //dd($responseData);
        $orderData = Session::get('order_data');
        /** Get the payment ID before session clear **/
        $order_input_data = Session::get('order_input_data');

        /** clear the session payment ID **/
        if (empty($responseData['PayerID']) || empty($responseData['token'])) {
            return [
                'status' => false,
                'message' => __('Unknown error occurred')
            ];
        }
        $transaction = $this->gateway->completePurchase(array(
            'payer_id' => $responseData['PayerID'],
            'transactionReference' => $responseData['paymentId'],
        ));


        $response = $transaction->send();
         
        if ($response->isSuccessful()) {
            $cart = DB::table('cart_items')->where('client_id', session()->get('client_data')->id)->get();
            $user = session()->get('client_data');
            $total_tax = 0;
            $cart_total = 0;
            $total = 0;
            $option_price = 0;
            $total = [];
            foreach($cart as $key => $price){ 
                $total[] = $price->price;
            }
            $total_amount = array_sum($total);



            $orderData['txnid'] = $response->getData()['transactions'][0]['related_resources'][0]['sale']['id'];
            $orderData['payment_status'] = 'Paid';
            $orderData['transaction_number'] = Str::random(10);
            $orderData['currency_sign'] = PriceHelper::setCurrencySign();
            $orderData['currency_value'] = PriceHelper::setCurrencyValue(); 
            
             
            $order = DB::table('orders')->insert($orderData); 
            if ($order) {
                $lastInsertedId = DB::getPdo()->lastInsertId(); 
                $currentDate = date('Ymd'); // Format current date as YYYYMMDD
                $new_txn = 'ORD-' . str_pad($currentDate, 4, '0', STR_PAD_LEFT) . '-' . $lastInsertedId; 
                
                $update_arr = [
                    'transaction_number' => $new_txn
                ];
            
                if (!empty($update_arr)) {
                    $order_update = DB::table('orders')->where('id', $lastInsertedId)->update($update_arr);
                }
            }
             
            Session::put('order_id', $lastInsertedId);
            Session::forget('cart');
            DB::table('cart_items')->where('client_id',session()->get('client_data')->id)->delete();
            Session::forget('order_data');
            Session::forget('order_payment_id');
            return [
                'status' => true
            ];
        } else {
            return [
                'status' => false,
                'message' => $response->getMessage()
            ];
        }
    }
    
    //  thank purchase page 
    
    public function thank(Request $request, $id){ 
        $user_id = session()->get('client_data')->id;
        $order = DB::table('orders')->where('id', $id)->first(); 
        return view('frontend.pages.thankyou_page', compact('order'));
    }
    
    public function imageGet(Request $request){
        $pageId = $request->input('page_id');
        $image = PageExtra::where('page_id', $pageId)->where('type', 1)->first();
        $imageUrl = asset('uploads/' . $image->image);
        return response()->json(['image_url' => $imageUrl]);
    }
    
    
    // puchase step new
    public function purchase2(Request $request){
	    
        $duration = DB::table('digital_service_price_widget')
                    // ->select('duration_id', 'plan_duration', 'discount_price', 'main_price')
                    ->where('id', $request['id']) 
                    ->first();
                    
        $duration_name = DB::table('digital_service_price_widget')
                        ->select('plan_name')
                        ->where('service_type', $request['service_id'])
                        ->orderBy('plan_name', 'ASC')
                        ->groupBy('plan_name') 
                        ->get();

        
        $duration_new = json_decode(json_encode($duration), true);
        $duration_plan = json_decode(json_encode($duration_name), true); 
        // return view('frontend.purchase', compact('duration_new')); 
        return view('frontend.subscribe.plan', compact('duration_new')); 
    }
    public function purchase_second2(Request $request){  
        return view('frontend.subscribe.detail'); 
    }
    public function addToCartNew(Request $request)
    {  
        $servicePlan = $request->input('service_main');
        $packagePlan = $request->input('package_plan');
        $planDuration = $request->input('plan_duration');
        $serviceAddon = $request->input('addon_service');   
        
        if($packagePlan > 0){
            
            $package_id = DB::table('digital_service_price_widget')->where('service_type', $servicePlan)->where('plan_duration', $planDuration)->where('plan_name', $packagePlan)->first();
            $package = json_decode(json_encode($package_id), true); 
             
            $clients = session()->get('client_data');
            $client_data = json_decode(json_encode($clients), true); 
            
            $arr = [
                'client_id' => $client_data['id'],
                'product_id' => $package['id'], 
                'name' => $package['plan_name'],
                'price' => $package['discount_price'],
                'service_id' => $serviceAddon,
                'plan_duration' => $planDuration,
                'website' =>$request['website'],
                'service' =>$servicePlan,
                'target_location' =>$servicePlan,
                'competitor' => $request['competitor']
            ]; 
            $resuylt = DB::table('cart_items')->insert($arr); 
            if($resuylt){  
                return redirect()->route('cart.show.new');
            } 
        }  
    }
    public function showCartNew()
    { 
        $clientData = session()->get('client_data'); 
        $cartItems = collect(); 
        
        if ($clientData && isset($clientData->id)) { 
            $cartItems = DB::table('cart_items')->where('client_id', $clientData->id)->get();
        }
     
        $client_data = $cartItems->toArray();
        $arr = $price = $addon = [];
        
        if (!empty($client_data)) {
            foreach ($client_data as $key => $val) {
                $package = DB::table('digital_service_price_widget')->where('id', $val->product_id)->first();
                $service_name = DB::table('pages')->where('id', $package->service_type)->first();
                $service_addon = DB::table('digital_service_price_widget')
                    ->where('plan_name', $val->name)
                    ->where('plan_duration', $val->plan_duration)
                    ->where('service_type', $val->service_id)
                    ->first();
    
                $arr[] = [
                    'small_features' => $package->small_features,
                    'main_price' => $package->main_price,
                    'discount_price' => $package->discount_price,
                    'package_name' => $package->plan_name,
                    'package_duration' => $package->plan_duration,
                    'service_name' => $service_name->page_name,
                    'service_addon_price' => $service_addon->discount_price ?? 0,  
                    'service_addon_id' => $service_addon->service_type ?? null,
                    'cart_id' => $val->id,
                ];
    
                $price[] = $package->discount_price;
                $addon[] = $service_addon->discount_price ?? 0; 
            }
        }
    
        $subtotal = array_sum($price);
        $addtotal = array_sum($addon);
    
        return view('frontend.subscribe.cart', compact('arr', 'subtotal', 'addtotal'));
    }
    // puchase step new
        
}

