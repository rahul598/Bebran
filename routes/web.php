<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CashfreeController;
use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\PriceWidgetController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

 Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');*/

Auth::routes(['verify' => true, 'register' => false]);

/***************** Clear Cache *****************/
Route::get('/cc', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    $exitCode = Artisan::call('route:clear');
    return 'DONE'; //Return anything
});

/*Admin Route Start*/
/*Authentication*/

Route::get('/admin/login', [App\Http\Controllers\AdminController::class, 'showLogin']);
Route::post('/admin/login', [App\Http\Controllers\AdminController::class, 'doLogin'])->name('login');
Route::get('/admin/logout', [App\Http\Controllers\AdminController::class, 'doLogout']);
Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index']); 

// Verify email
Route::get('/email/verify/{id}/{hash}', [App\Http\Controllers\Api\VerificationController::class, '__invoke'])
    ->middleware(['signed'])
    ->name('verification.verify');
    
// admin routes
Route::group(['middleware' => ['auth','verified'],'prefix'=>'admin'], function () { // 

    Route::get('/download-csv', function () {
        $file = public_path('csv/result_overview_new.csv');
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="result_overview.csv"',
        ];
    
        return Response::download($file, 'result_overview.csv', $headers);
    })->name('download_csv');
    
    Route::get('/keyword-download-csv', function () {
        $file = public_path('csv/keyword_csv.csv');
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="result_overview.csv"',
        ];
    
        return Response::download($file, 'keyword.csv', $headers);
    })->name('keyword_download_csv');
    
    Route::get('/keyword-growth-download-csv', function () {
        $file = public_path('csv/keyword_growth_csv.csv');
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="result_overview.csv"',
        ];
    
        return Response::download($file, 'keyword_growth.csv', $headers);
    })->name('keyword_growth_download_csv');

	Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'index'])->name('dashboard');
	Route::get('/home', [App\Http\Controllers\AdminController::class, 'index']);
	/*Settings*/
	Route::get('general-settings', [App\Http\Controllers\SettingsController::class, 'settings']);
	Route::post('general-settings', [App\Http\Controllers\SettingsController::class, 'update']);
	Route::get('general-settings/delete/{key}', [App\Http\Controllers\SettingsController::class, 'delete']);
	

	Route::get('header-settings', [App\Http\Controllers\SettingsController::class, 'headerSettings']);
	Route::post('header-settings', [App\Http\Controllers\SettingsController::class, 'headerSettingsUpdate']);
	Route::get('footer-settings', [App\Http\Controllers\SettingsController::class, 'footerSettings']);
	Route::post('footer-settings', [App\Http\Controllers\SettingsController::class, 'footerSettingsUpdate']);


	Route::get('profile', [App\Http\Controllers\SettingsController::class, 'profile']);
	Route::post('profile', [App\Http\Controllers\SettingsController::class, 'profileUpdate']);
	Route::get('form-settings', [App\Http\Controllers\SettingsController::class, 'formSettings']);
	Route::post('form-settings', [App\Http\Controllers\SettingsController::class, 'formUpdate']);

	/*Emailtemplate*/
	Route::get('email-template', [App\Http\Controllers\EmailtemplateController::class, 'emailtemplate']);
	Route::post('emailtemplate', [App\Http\Controllers\EmailtemplateController::class, 'update']);

	/*User*/
	Route::get('user', [App\Http\Controllers\UserController::class, 'index']);
	Route::get('user/customer', [App\Http\Controllers\UserController::class, 'customer']);
	Route::get('user/add', [App\Http\Controllers\UserController::class, 'add']);
	Route::post('user/add', [App\Http\Controllers\UserController::class, 'insert']);
	Route::get('user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit']);
	Route::post('user/update', [App\Http\Controllers\UserController::class, 'update']);
	Route::get('user/view/{id}', [App\Http\Controllers\UserController::class, 'view']);
	Route::get('user/delete/{id}', [App\Http\Controllers\UserController::class, 'delete']);
	Route::get('user/status/{id}/{status}', [App\Http\Controllers\UserController::class, 'status']);
	Route::get('get-state', [App\Http\Controllers\UserController::class, 'get_state']);
	 

	/*Page*/
	Route::get('page', [App\Http\Controllers\PageController::class, 'index']);
	Route::get('page/add', [App\Http\Controllers\PageController::class, 'add']);
	Route::post('page/add', [App\Http\Controllers\PageController::class, 'insert']);
	Route::get('page/edit/{id}', [App\Http\Controllers\PageController::class, 'edit']);
	Route::post('page/update', [App\Http\Controllers\PageController::class, 'update']);
	Route::get('page-extra/content-delete/{key}/{id}', [App\Http\Controllers\PageController::class, 'page_extra_remove_image']);
	Route::get('page-extra/delete/{id}', [App\Http\Controllers\PageController::class, 'page_extra_remove']);
	Route::get('page/delete/{id}', [App\Http\Controllers\PageController::class, 'delete']);
	Route::get('page/status/{id}/{status}', [App\Http\Controllers\PageController::class, 'status']);

	/*blog*/
	Route::get('blog', [App\Http\Controllers\PageController::class, 'blog']);
	Route::get('blog/add', [App\Http\Controllers\PageController::class, 'blog_add']);
	Route::get('blog/edit/{id}', [App\Http\Controllers\PageController::class, 'blog_edit']);
	Route::post('ckeditor/upload', [App\Http\Controllers\PageController::class, 'uploadMedia'])->name('ckeditorImageUpload'); 
	Route::post('/ckeditor/upload/file', [App\Http\Controllers\PageController::class, 'uploadFile'])->name('ckeditorFileUpload');
	

	// Case Studies Category 
	Route::get('caseStudiesCategory', [App\Http\Controllers\CaseStudiesController::class, 'index']);
	Route::get('caseStudiesCategory/add', [App\Http\Controllers\CaseStudiesController::class, 'add']);
	Route::post('caseStudiesCategory/add', [App\Http\Controllers\CaseStudiesController::class, 'insert']);
	Route::get('caseStudiesCategory/edit/{id}', [App\Http\Controllers\CaseStudiesController::class, 'edit']);
	Route::post('caseStudiesCategory/update', [App\Http\Controllers\CaseStudiesController::class, 'update']);
	Route::get('caseStudiesCategory/delete/{id}', [App\Http\Controllers\CaseStudiesController::class, 'delete']);
	Route::get('caseStudiesCategory/status/{id}/{status}', [App\Http\Controllers\CaseStudiesController::class, 'status']);

	// Case Studies
	Route::get('caseStudiesLanding', [App\Http\Controllers\PageController::class, 'caseStudiesLanding']);
	Route::get('case-study', [App\Http\Controllers\CaseStudiesController::class, 'case_studies']);
	Route::get('case-study/add', [App\Http\Controllers\CaseStudiesController::class, 'case_studies_add']);
	Route::post('case-study/add', [App\Http\Controllers\CaseStudiesController::class, 'case_studies_insert']);
	Route::get('case-study/edit/{id}', [App\Http\Controllers\CaseStudiesController::class, 'case_studies_edit']);
	Route::post('case-study/update', [App\Http\Controllers\CaseStudiesController::class, 'case_studies_update']);
	Route::get('case-study/delete/{id}', [App\Http\Controllers\CaseStudiesController::class, 'case_studies_delete']);
	Route::get('case-study/status/{id}/{status}', [App\Http\Controllers\CaseStudiesController::class, 'case_studies_status']);

	//Portfolio Category    
	Route::get('portfolioCategory', [App\Http\Controllers\PortfolioController::class, 'index']);
	Route::get('portfolioCategory/add', [App\Http\Controllers\PortfolioController::class, 'add']);
	Route::post('portfolioCategory/add', [App\Http\Controllers\PortfolioController::class, 'insert']);
	Route::get('portfolioCategory/edit/{id}', [App\Http\Controllers\PortfolioController::class, 'edit']);
	Route::post('portfolioCategory/update', [App\Http\Controllers\PortfolioController::class, 'update']);
	Route::get('portfolioCategory/delete/{id}', [App\Http\Controllers\PortfolioController::class, 'delete']);
	Route::get('portfolioCategory/status/{id}/{status}', [App\Http\Controllers\PortfolioController::class, 'status']);

	//Portfolio
	Route::get('portfolioLanding', [App\Http\Controllers\PageController::class, 'portfolioLanding']);
	Route::get('portfolio', [App\Http\Controllers\PortfolioController::class, 'portfolio']);
	Route::get('portfolio/add', [App\Http\Controllers\PortfolioController::class, 'portfolio_add']);
	Route::post('portfolio/add', [App\Http\Controllers\PortfolioController::class, 'portfolio_insert']);
	Route::get('portfolio/edit/{id}', [App\Http\Controllers\PortfolioController::class, 'portfolio_edit']);
	Route::post('portfolio/update', [App\Http\Controllers\PortfolioController::class, 'portfolio_update']);
	Route::get('portfolio/delete/{id}', [App\Http\Controllers\PortfolioController::class, 'portfolio_delete']);
	Route::get('portfolio/status/{id}/{status}', [App\Http\Controllers\PortfolioController::class, 'portfolio_status']);

	//Sample Category 
	Route::get('sampleCategory', [App\Http\Controllers\SampleController::class, 'index']);
	Route::get('sampleCategory/add', [App\Http\Controllers\SampleController::class, 'add']);
	Route::post('sampleCategory/add', [App\Http\Controllers\SampleController::class, 'insert']);
	Route::get('sampleCategory/edit/{id}', [App\Http\Controllers\SampleController::class, 'edit']);
	Route::post('sampleCategory/update', [App\Http\Controllers\SampleController::class, 'update']);
	Route::get('sampleCategory/delete/{id}', [App\Http\Controllers\SampleController::class, 'delete']);
	Route::get('sampleCategory/status/{id}/{status}', [App\Http\Controllers\SampleController::class, 'status']);

	//Sample     
	Route::get('sampleLanding', [App\Http\Controllers\PageController::class, 'sampleLanding']);
	Route::get('sample', [App\Http\Controllers\SampleController::class, 'sample']);
	Route::get('sample/add', [App\Http\Controllers\SampleController::class, 'sample_add']);
	Route::post('sample/add', [App\Http\Controllers\SampleController::class, 'sample_insert']);
	Route::get('sample/edit/{id}', [App\Http\Controllers\SampleController::class, 'sample_edit']);
	Route::post('sample/update', [App\Http\Controllers\SampleController::class, 'sample_update']);
	Route::get('sample/delete/{id}', [App\Http\Controllers\SampleController::class, 'sample_delete']);
	Route::get('sample/status/{id}/{status}', [App\Http\Controllers\SampleController::class, 'sample_status']);

	//Media Coverage Category 
	Route::get('mediaCoverageCategory', [App\Http\Controllers\MediaCoverageController::class, 'index']);
	Route::get('mediaCoverageCategory/add', [App\Http\Controllers\MediaCoverageController::class, 'add']);
	Route::post('mediaCoverageCategory/add', [App\Http\Controllers\MediaCoverageController::class, 'insert']);
	Route::get('mediaCoverageCategory/edit/{id}', [App\Http\Controllers\MediaCoverageController::class, 'edit']);
	Route::post('mediaCoverageCategory/update', [App\Http\Controllers\MediaCoverageController::class, 'update']);
	Route::get('mediaCoverageCategory/delete/{id}', [App\Http\Controllers\MediaCoverageController::class, 'delete']);
	Route::get('mediaCoverageCategory/status/{id}/{status}', [App\Http\Controllers\MediaCoverageController::class, 'status']);

	//Media Coverage   mediaCoverageLanding
	Route::get('mediaCoverageLanding', [App\Http\Controllers\PageController::class, 'mediaCoverageLanding']);
	Route::get('mediaCoverage', [App\Http\Controllers\MediaCoverageController::class, 'media_coverage']);
	Route::get('mediaCoverage/add', [App\Http\Controllers\MediaCoverageController::class, 'media_coverage_add']);
	Route::post('mediaCoverage/add', [App\Http\Controllers\MediaCoverageController::class, 'media_coverage_insert']);
	Route::get('mediaCoverage/edit/{id}', [App\Http\Controllers\MediaCoverageController::class, 'media_coverage_edit']);
	Route::post('mediaCoverage/update', [App\Http\Controllers\MediaCoverageController::class, 'media_coverage_update']);
	Route::get('mediaCoverage/delete/{id}', [App\Http\Controllers\MediaCoverageController::class, 'media_coverage_delete']);
	Route::get('mediaCoverage/status/{id}/{status}', [App\Http\Controllers\MediaCoverageController::class, 'media_coverage_status']);

	/*Service*/
	Route::get('service', [App\Http\Controllers\PageController::class, 'service']);
	Route::get('service/add', [App\Http\Controllers\PageController::class, 'service_add']);
	Route::get('service/edit/{id}', [App\Http\Controllers\PageController::class, 'service_edit']);
	
    // price widget
    Route::get('price_widget_list', [App\Http\Controllers\PriceWidgetController::class, 'index'])->name('price_widget_list');
    Route::get('price_widget_list/edit/{id}', [App\Http\Controllers\PriceWidgetController::class, 'price_widget_edit']);
    Route::post('price_widget_list/edit/{id}/{id2}', [App\Http\Controllers\PriceWidgetController::class, 'price_widget_update'])->name('price_widget_update');
    // Route::post('price_widget_list/edit/{id}', [App\Http\Controllers\PriceWidgetController::class, 'price_widget_update'])->name('price_widget_update');
    Route::post('price_widget_list_description/edit', [App\Http\Controllers\PriceWidgetController::class, 'price_widget_update_description'])->name('price_widget_update_description');
    Route::get('price_widget_list/delete/{id}', [App\Http\Controllers\PriceWidgetController::class, 'price_widget_delete'])->name('price_widget_delete');
    Route::get('price_widget', [App\Http\Controllers\PriceWidgetController::class, 'add_plan'])->name('price_widget_price');
    Route::post('price_widget/add', [App\Http\Controllers\PriceWidgetController::class, 'add_plan_data'])->name('price_widget_add');
    Route::post('price_widget_description/add', [App\Http\Controllers\PriceWidgetController::class, 'add_plan_description_data'])->name('add_plan_description_data');
    Route::get('same_service_price_widget /{id}', [App\Http\Controllers\PriceWidgetController::class, 'same_service_price_widget'])->name('same_service_price_widget');
    Route::post('same_service_price_widget/{id}', [App\Http\Controllers\PriceWidgetController::class, 'same_service_price_widget_add'])->name('same_service_price_widget_add');
    
    // reatiner routes
    Route::post('price_widget/retainer', [App\Http\Controllers\PriceWidgetController::class, 'add_retainer_plan_data'])->name('price_widget_retainer');
    // reatiner routes 
        // feature routes
    Route::get('price_widget_feature', [App\Http\Controllers\PriceWidgetController::class, 'price_feature'])->name('price_feature');
    Route::post('price_widget_feature', [App\Http\Controllers\PriceWidgetController::class, 'price_feature_add'])->name('price_feature_add');
    Route::get('price_widget_feature_list', [App\Http\Controllers\PriceWidgetController::class, 'feature_list'])->name('feature_list');
    Route::get('price_widget_feature_list/edit/{id}', [App\Http\Controllers\PriceWidgetController::class, 'feature_list_edit'])->name('feature_list_edit');
    Route::post('price_widget_feature_list/edit/{id}', [App\Http\Controllers\PriceWidgetController::class, 'feature_list_update'])->name('feature_list_update');
    Route::get('same_service_feature/{id}', [App\Http\Controllers\PriceWidgetController::class, 'same_service_feature'])->name('same_service_feature');
    Route::post('same_service_feature/{id}', [App\Http\Controllers\PriceWidgetController::class, 'same_service_feature_add'])->name('same_service_feature_add');
    Route::get('price_widget_feature/delete/{id}', [App\Http\Controllers\PriceWidgetController::class, 'feature_list_delete'])->name('feature_list_delete');
    Route::post('features_data_delete', [App\Http\Controllers\PriceWidgetController::class, 'features_data_delete'])->name('features_data_delete');
    
    // route for download listing
    Route::get('/pricing-list-id', [App\Http\Controllers\DownloadCsvController::class, 'index'])->name('pricing_list_id');
    Route::get('/pricing-list-upload', [App\Http\Controllers\DownloadCsvController::class, 'uploadPage'])->name('uploadPage');
    Route::post('/pricing-list-upload-data', [App\Http\Controllers\DownloadCsvController::class, 'upload'])->name('pricing_list_upload');
    Route::get('/download-sample', [App\Http\Controllers\DownloadCsvController::class, 'downloadSampleFile'])->name('download.sample');
    Route::get('/download-price-data-download/{id}', [App\Http\Controllers\DownloadCsvController::class, 'price_data_download'])->name('price_data_download');
    Route::get('/download-price-data-download_new', [App\Http\Controllers\DownloadCsvController::class, 'price_data_download_new'])->name('price_data_download_new');
    
    Route::get('/download-price-data-download-features/{id}', [App\Http\Controllers\DownloadCsvController::class, 'price_data_download_features'])->name('price_data_download_features');
    Route::post('/features-new-list-upload-data', [App\Http\Controllers\DownloadCsvController::class, 'features_list_upload'])->name('features_list_upload');
    // route of features upload via csv
     Route::get('/feature-uploader', [App\Http\Controllers\DownloadCsvController::class, 'featureUploadPage'])->name('featureUploadPage');
      Route::get('/feature-csv-sample', [App\Http\Controllers\DownloadCsvController::class, 'featureCsvSample'])->name('featureCsvSample');
      Route::post('/feature-upload-data', [App\Http\Controllers\DownloadCsvController::class, 'featureUpload'])->name('featureUpload');
      Route::get('/feature-exist-data', [App\Http\Controllers\DownloadCsvController::class, 'featureExistData'])->name('featureExistData');
      
      
    //   addon
    Route::get('/addon', [App\Http\Controllers\PriceWidgetController::class, 'addon'])->name('addonShowPage');
    Route::post('/addon', [App\Http\Controllers\PriceWidgetController::class, 'addonAdd'])->name('addonAdd');
    Route::get('/addon-show', [App\Http\Controllers\PriceWidgetController::class, 'addonIndex'])->name('addonIndex');
    //   addon
    // price widget 
    
    
    // Our strength 
    Route::get('our-strength', [App\Http\Controllers\WidegetController::class, 'index']);
    Route::get('our-strength/edit/{id}', [App\Http\Controllers\WidegetController::class, 'edit']);
    Route::post('our-strength/update', [App\Http\Controllers\WidegetController::class, 'update']);
    Route::match(['put', 'delete', 'patch'], '/updateDeleteToggle/{id}', [App\Http\Controllers\WidegetController::class, 'updateDeleteToggle'])->name('updateDeleteToggleRoute');
    // routes/web.php
    Route::post('/store-form-data', [App\Http\Controllers\WidegetController::class, 'storeFormData'])->name('storeFormData');
    

    // Our strength
    
    // Certified digital marketing professionals
    Route::get('certified-digital-marketing-professionals', [App\Http\Controllers\certifiedController::class, 'index']);
    Route::post('/updateTitleContent/{id}', [App\Http\Controllers\certifiedController::class, 'updateTitleContent'])->name('updateTitleContent');
    Route::match(['put', 'delete', 'patch'], '/updateDeleteToggleCertified/{id}', [App\Http\Controllers\certifiedController::class, 'updateDeleteToggleCertified'])->name('updateDeleteToggleCertified');
    Route::post('/store-form-certified', [App\Http\Controllers\certifiedController::class, 'storeFormDataCertified'])->name('storeFormDataCertified'); 
    Route::match(['put', 'delete', 'patch'], '/updateDeleteToggleAddon/{id}', [App\Http\Controllers\PriceWidgetController::class, 'updateDeleteToggleAddon'])->name('updateDeleteToggleAddon');
    // Certified digital marketing professionals
    
    // ToolUseController
    Route::get('tools-we-use', [App\Http\Controllers\ToolUseController::class, 'index']);
    Route::get('tools-we-useedit/{id}', [App\Http\Controllers\ToolUseController::class, 'edit']);
    Route::post('/updateTitletools/{id}', [App\Http\Controllers\ToolUseController::class, 'updateTitleTools'])->name('updateTitleTools');
    Route::match(['put', 'delete', 'patch'], '/updateDeleteToggleTools/{id}', [App\Http\Controllers\ToolUseController::class, 'updateDeleteToggleTools'])->name('updateDeleteToggleTools');
    Route::post('/store-form-tools', [App\Http\Controllers\ToolUseController::class, 'storeFormDataTools'])->name('storeFormDataTools');
    // ToolUseController
    
    // OurPartners
    Route::get('our-partners', [App\Http\Controllers\OurPartners::class, 'index']);
    Route::post('/updateTitlePartner/{id}', [App\Http\Controllers\OurPartners::class, 'updateTitlePartner'])->name('updateTitlePartner');
    Route::match(['put', 'delete', 'patch'], '/updateDeleteTogglePartner/{id}', [App\Http\Controllers\OurPartners::class, 'updateDeleteTogglePartner'])->name('updateDeleteTogglePartner');
    Route::post('/store-form-partner', [App\Http\Controllers\OurPartners::class, 'storeFormDataPartner'])->name('storeFormDataPartner');
    // OurPartners
    
    // OurWorkFeatures
    Route::get('our-work-featured', [App\Http\Controllers\OurWorkFeatures::class, 'index']);
    Route::post('/updateTitleFeatured/{id}', [App\Http\Controllers\OurWorkFeatures::class, 'updateTitleFeatured'])->name('updateTitleFeatured');
    Route::match(['put', 'delete', 'patch'], '/updateDeleteToggleFeatured/{id}', [App\Http\Controllers\OurWorkFeatures::class, 'updateDeleteToggleFeatured'])->name('updateDeleteToggleFeatured');
    Route::post('/store-form-features', [App\Http\Controllers\OurWorkFeatures::class, 'storeFormDataFeatured'])->name('storeFormDataFeatured');
    // OurWorkFeatures
    
    // Video Testimonials
    Route::get('video-testimonials', [App\Http\Controllers\VideoTestimonials::class, 'index']);
    Route::post('/updateTitleVideo/{id}', [App\Http\Controllers\VideoTestimonials::class, 'updateTitleVideo'])->name('updateTitleVideo');
    Route::match(['put', 'delete', 'patch'], '/updateDeleteToggleVideo/{id}', [App\Http\Controllers\VideoTestimonials::class, 'updateDeleteToggleVideo'])->name('updateDeleteToggleVideo');
    Route::post('/store-form-video', [App\Http\Controllers\VideoTestimonials::class, 'storeFormDataVideo'])->name('storeFormDataVideo_new');
    // Video Testimonials
    
    // Price Widget
    // Route::get('price-widget', [App\Http\Controllers\PriceWidget::class, 'index']);
    // Price Widget
    
    // Plan feature Widget
    // Route::get('plan-feature-widget', [App\Http\Controllers\PlanFeatureWidget::class, 'index']);
    // Plan feature Widget 
    
    // review form
    Route::get('reviews', [App\Http\Controllers\ContactFormController::class, 'index']);
    Route::match(['put', 'delete', 'patch'], '/updateDeleteToggleReview/{id}', [App\Http\Controllers\ContactFormController::class, 'updateDeleteToggleReview'])->name('updateDeleteToggleReview');
    Route::post('/store-form-reviews', [App\Http\Controllers\ContactFormController::class, 'storeFormDataReview'])->name('storeFormDataReview');
    Route::post('/updateTitleReview/{id}', [App\Http\Controllers\ContactFormController::class, 'updateTitleReview'])->name('updateTitleReview');
    // review form

    
    
    // client data
     Route::get('clients', [App\Http\Controllers\ClientController::class, 'index'])->name('clients');
     Route::get('clients/{id}', [App\Http\Controllers\ClientController::class, 'view_data'])->name('view_client_data');
    // client data
    
    // payment widget
    Route::get('payment', [App\Http\Controllers\PaymentSettingController::class, 'payment'])->name('payment'); 
    Route::post('payment/update', [App\Http\Controllers\PaymentSettingController::class, 'update'])->name('payment.update');
    // payment widget 
     


	/*City service*/
	Route::get('city-service', [App\Http\Controllers\PageController::class, 'cityService']);
	Route::get('city-service/add', [App\Http\Controllers\PageController::class, 'cityServiceAdd']);
	Route::get('city-service/edit/{id}', [App\Http\Controllers\PageController::class, 'cityServiceEdit']);
	Route::post('city-service/add', [App\Http\Controllers\PageController::class, 'dynamicCityServiceInsert']);
	Route::post('city-service/update', [App\Http\Controllers\PageController::class, 'dynamicCityServiceUpdate']);

	/*City service*/
	Route::get('business-service', [App\Http\Controllers\PageController::class, 'businessService']);
	Route::get('business-service/add', [App\Http\Controllers\PageController::class, 'businessServiceAdd']);
	Route::get('business-service/edit/{id}', [App\Http\Controllers\PageController::class, 'businessServiceEdit']);
	Route::post('business-service/add', [App\Http\Controllers\PageController::class, 'dynamicBusinessServiceInsert']);
	Route::post('business-service/update', [App\Http\Controllers\PageController::class, 'dynamicBusinessServiceUpdate']);

	/*City Business service*/
	Route::get('city-business-service', [App\Http\Controllers\PageController::class, 'citybusinessService']);
	Route::get('city-business-service/add', [App\Http\Controllers\PageController::class, 'citybusinessServiceAdd']);
	Route::get('city-business-service/edit/{id}', [App\Http\Controllers\PageController::class, 'citybusinessServiceEdit']);
	Route::post('city-business-service/add', [App\Http\Controllers\PageController::class, 'dynamicCitybusinessServiceInsert']);
	Route::post('city-business-service/update', [App\Http\Controllers\PageController::class, 'dynamicCitybusinessServiceUpdate']);

	/*Resources*/
	Route::get('resource', [App\Http\Controllers\PageController::class, 'resource']);
	Route::get('resource/add', [App\Http\Controllers\PageController::class, 'resource_add']);
	Route::get('resource/edit/{id}', [App\Http\Controllers\PageController::class, 'resource_edit']);

	/*Pricing*/
	Route::get('pricing', [App\Http\Controllers\PageController::class, 'pricing']);
	Route::get('pricing/add', [App\Http\Controllers\PageController::class, 'pricing_add']);
	Route::get('pricing/edit/{id}', [App\Http\Controllers\PageController::class, 'pricing_edit']);

	/*----- Package Category ----------*/
	Route::get('package-category', [App\Http\Controllers\PackageController::class, 'package_category']);
	Route::get('package-category/add', [App\Http\Controllers\PackageController::class, 'package_category_add']);
	Route::post('package-category/add', [App\Http\Controllers\PackageController::class, 'package_category_insert']);
	Route::get('package-category/edit/{id}', [App\Http\Controllers\PackageController::class, 'package_category_edit']);
	Route::post('package-category/update', [App\Http\Controllers\PackageController::class, 'package_category_update']);
	Route::get('package-category/delete/{id}', [App\Http\Controllers\PackageController::class, 'package_category_delete']);
	Route::get('package-category/status/{id}/{status}', [App\Http\Controllers\PackageController::class, 'package_category_status']);

	/*----- Package Type ----------*/
	Route::get('package-type', [App\Http\Controllers\PackageController::class, 'package_type']);
	Route::get('package-type/add', [App\Http\Controllers\PackageController::class, 'package_type_add']);
	Route::post('package-type/add', [App\Http\Controllers\PackageController::class, 'package_type_insert']);
	Route::get('package-type/edit/{id}', [App\Http\Controllers\PackageController::class, 'package_type_edit']);
	Route::post('package-type/update', [App\Http\Controllers\PackageController::class, 'package_type_update']);
	Route::get('package-type/delete/{id}', [App\Http\Controllers\PackageController::class, 'package_type_delete']);
	Route::get('package-type/status/{id}/{status}', [App\Http\Controllers\PackageController::class, 'package_type_status']);

	/*----- Package Plan ---------*/
	Route::get('package-plan', [App\Http\Controllers\PackageController::class, 'package_plan']);
	Route::get('package-plan/add', [App\Http\Controllers\PackageController::class, 'package_plan_add']);
	Route::post('package-plan/add', [App\Http\Controllers\PackageController::class, 'package_plan_insert']);
	Route::get('package-plan/edit/{id}', [App\Http\Controllers\PackageController::class, 'package_plan_edit']);
	Route::post('package-plan/update', [App\Http\Controllers\PackageController::class, 'package_plan_update']);
	Route::get('package-plan/delete/{id}', [App\Http\Controllers\PackageController::class, 'package_plan_delete']);
	Route::get('package-plan/status/{id}/{status}', [App\Http\Controllers\PackageController::class, 'package_plan_status']);

	/*----- Feature Title --------*/
	Route::get('feature-title', [App\Http\Controllers\PackageController::class, 'feature_title']);
	Route::get('feature-title/add', [App\Http\Controllers\PackageController::class, 'feature_title_add']);
	Route::post('feature-title/add', [App\Http\Controllers\PackageController::class, 'feature_title_insert']);
	Route::get('feature-title/edit/{id}', [App\Http\Controllers\PackageController::class, 'feature_title_edit']);
	Route::post('feature-title/update', [App\Http\Controllers\PackageController::class, 'feature_title_update']);
	Route::get('feature-title/delete/{id}', [App\Http\Controllers\PackageController::class, 'feature_title_delete']);
	Route::get('feature-title/status/{id}/{status}', [App\Http\Controllers\PackageController::class, 'feature_title_status']);
	
	/*------ Feature Sub Title --------*/
	Route::get('feature-sub-title', [App\Http\Controllers\PackageController::class, 'feature_sub_title']);
	Route::get('feature-sub-title/add', [App\Http\Controllers\PackageController::class, 'feature_sub_title_add']);
	Route::post('feature-sub-title/add', [App\Http\Controllers\PackageController::class, 'feature_sub_title_insert']);
	Route::get('feature-sub-title/edit/{id}', [App\Http\Controllers\PackageController::class, 'feature_sub_title_edit']);
	Route::post('feature-sub-title/update', [App\Http\Controllers\PackageController::class, 'feature_sub_title_update']);
	Route::get('feature-sub-title/delete/{id}', [App\Http\Controllers\PackageController::class, 'feature_sub_title_delete']);
	Route::get('feature-sub-title/status/{id}/{status}', [App\Http\Controllers\PackageController::class, 'feature_sub_title_status']);

	/*------ Feature --------*/
	Route::get('feature', [App\Http\Controllers\PackageController::class, 'feature']);
	Route::get('feature/add', [App\Http\Controllers\PackageController::class, 'feature_add']);
	Route::post('feature/add', [App\Http\Controllers\PackageController::class, 'feature_insert']);
	// Route::get('feature/edit/{id}', [App\Http\Controllers\PackageController::class, 'feature_edit']);
	// Route::post('feature/update', [App\Http\Controllers\PackageController::class, 'feature_update']);
	// Route::get('feature/delete/{id}', [App\Http\Controllers\PackageController::class, 'feature_delete']);
	// Route::get('feature/status/{id}/{status}', [App\Http\Controllers\PackageController::class, 'feature_status']);

	Route::post('get_data_feature', [App\Http\Controllers\PackageController::class, 'get_data_feature']);
	

	/*Countries*/
	Route::get('countries', [App\Http\Controllers\PageController::class, 'countries'])->name('countries');
	Route::match(['get', 'post'], 'countries/add', [App\Http\Controllers\PageController::class, 'country_add']);
	Route::match(['get', 'post'], 'countries/edit/{id}', [App\Http\Controllers\PageController::class, 'country_edit']);
	Route::match(['get', 'post'], 'countries/delete/{id}', [App\Http\Controllers\PageController::class, 'delete_country']);

	/*Cities*/
	Route::get('cities', [App\Http\Controllers\PageController::class, 'cities'])->name('cities');
	Route::match(['get', 'post'], 'cities/add', [App\Http\Controllers\PageController::class, 'city_add']);
	Route::match(['get', 'post'], 'cities/edit/{id}', [App\Http\Controllers\PageController::class, 'city_edit']);
	Route::match(['get', 'post'], 'cities/delete/{id}', [App\Http\Controllers\PageController::class, 'delete_city']);

	/*Business*/
	Route::get('business', [App\Http\Controllers\PageController::class, 'business'])->name('business');
	Route::match(['get', 'post'], 'business/add', [App\Http\Controllers\PageController::class, 'business_add']);
	Route::match(['get', 'post'], 'business/edit/{id}', [App\Http\Controllers\PageController::class, 'business_edit']);
	Route::match(['get', 'post'], 'business/delete/{id}', [App\Http\Controllers\PageController::class, 'delete_business']);
	
	
    // for tracking 
	Route::get('tracking-code', [App\Http\Controllers\TrackingCodeForm::class, 'index'])->name('tracking_code');   
    Route::match(['put', 'delete', 'patch'], '/updateDeleteToggleTrack/{id}', [App\Http\Controllers\TrackingCodeForm::class, 'updateDeleteToggleTrack'])->name('updateDeleteToggleTrack');
    Route::post('/store-form-Track', [App\Http\Controllers\TrackingCodeForm::class, 'storeFormDataTrack'])->name('storeFormDataTrack');
	/*Contact*/
	
	Route::get('form-list', [App\Http\Controllers\PageController::class, 'fetchFormData'])->name('fetchFormData');
	Route::get('contact-form-list', [App\Http\Controllers\PageController::class, 'Contact_form_data'])->name('Contact_form_data');
	Route::get('blog-form-list', [App\Http\Controllers\PageController::class, 'blog_form_data'])->name('blog_form_data');
	Route::get('body-form-list', [App\Http\Controllers\PageController::class, 'body_form_data'])->name('body_form_data');
	Route::get('slider-form-list', [App\Http\Controllers\PageController::class, 'slider_form_data'])->name('slider_form_data');
	Route::get('sign_up', [App\Http\Controllers\PageController::class, 'sign_up'])->name('sign_up');
	Route::get('purchase', [App\Http\Controllers\PageController::class, 'purchase_data'])->name('purchase_data');  
	
	Route::get('get_data_lead',[App\Http\Controllers\PageController::class, 'get_data_lead'])->name('get_data_lead');
	Route::get('guest_lead',[App\Http\Controllers\PageController::class, 'guest_lead'])->name('guest_lead');
	
	
// 	select checkbox for delete data from database using ajax

    Route::get('/get-session-ids', [App\Http\Controllers\PageController::class, 'getSessionIds'])->name('getSessionIds');
    Route::post('/add-to-session', [App\Http\Controllers\PageController::class, 'addToSession'])->name('addToSession');
    Route::post('/add-to-session-guest', [App\Http\Controllers\PageController::class, 'addToSessionGuest'])->name('addToSessionGuest');
    Route::post('/remove-from-session', [App\Http\Controllers\PageController::class, 'removeFromSession'])->name('removeFromSession');
    Route::post('/remove-from-session-guest', [App\Http\Controllers\PageController::class, 'removeFromSessionGuest'])->name('removeFromSessionGuest');
    Route::post('/delete-from-database', [App\Http\Controllers\PageController::class, 'deleteFromDatabase'])->name('deleteFromDatabase');
    Route::post('/delete-from-database-guest', [App\Http\Controllers\PageController::class, 'deleteFromDatabaseGuest'])->name('deleteFromDatabaseGuest');
    Route::get('/get-session-ids-guest', [App\Http\Controllers\PageController::class, 'getSessionIdsGuest'])->name('getSessionIdsGuest');
    // for client
    Route::post('/add-to-session-client', [App\Http\Controllers\PageController::class, 'addToSessionClient'])->name('addToSessionClient');
    Route::post('/remove-from-session-client', [App\Http\Controllers\PageController::class, 'removeFromSessionClient'])->name('removeFromSessionClient'); 
    Route::post('/delete-from-database-client', [App\Http\Controllers\PageController::class, 'deleteFromDatabaseClient'])->name('deleteFromDatabaseClient');
    Route::get('/get-session-ids-client', [App\Http\Controllers\PageController::class, 'getSessionIdsClient'])->name('getSessionIdsClient');
    
    // contact 
    Route::get('/get-session-ids-contact', [App\Http\Controllers\PageController::class, 'getSessionIdsContact'])->name('getSessionIdsContact');
    Route::post('/add-to-session-contact', [App\Http\Controllers\PageController::class, 'addToSessionContact'])->name('addToSessionContact');
    Route::post('/remove-from-session-contact', [App\Http\Controllers\PageController::class, 'removeFromSessionContact'])->name('removeFromSessionContact');
    Route::post('/delete-from-database-contact', [App\Http\Controllers\PageController::class, 'deleteFromDatabaseContact'])->name('deleteFromDatabaseContact');
    Route::post('/export-contact-data/{id}', [App\Http\Controllers\PageController::class, 'contact_csv'])->name('contact_csv');
    Route::post('/export-body-data', [App\Http\Controllers\PageController::class, 'body_slider_csv'])->name('body_slider_csv');
    
    //  blog form
    Route::get('/get-session-ids-blog', [App\Http\Controllers\PageController::class, 'getSessionIdsblog'])->name('getSessionIdsblog');
    Route::post('/add-to-session-blog', [App\Http\Controllers\PageController::class, 'addToSessionblog'])->name('addToSessionblog');
    Route::post('/remove-from-session-blog', [App\Http\Controllers\PageController::class, 'removeFromSessionblog'])->name('removeFromSessionblog');
    Route::post('/delete-from-database-blog', [App\Http\Controllers\PageController::class, 'deleteFromDatabaseblog'])->name('deleteFromDatabaseblog');
    
    //  body form
    Route::get('/get-session-ids-body', [App\Http\Controllers\PageController::class, 'getSessionIdsbody'])->name('getSessionIdsbody');
    Route::post('/add-to-session-body', [App\Http\Controllers\PageController::class, 'addToSessionbody'])->name('addToSessionbody');
    Route::post('/remove-from-session-body', [App\Http\Controllers\PageController::class, 'removeFromSessionbody'])->name('removeFromSessionbody');
    Route::post('/delete-from-database-body', [App\Http\Controllers\PageController::class, 'deleteFromDatabasebody'])->name('deleteFromDatabasebody');


	/*categorypage
	Route::get('categorypage', [App\Http\Controllers\PageController::class, 'categoryPage']);
	Route::get('categorypage/add', [App\Http\Controllers\PageController::class, 'categoryPage_add']);
	Route::get('categorypage/edit/{id}', [App\Http\Controllers\PageController::class, 'categoryPage_edit']);*/

	/*Comment
	Route::get('comment', [App\Http\Controllers\PageController::class, 'comment']);
	Route::get('comment/view/{id}', [App\Http\Controllers\PageController::class, 'commentView']);
	Route::any('comment/status/{id}', [App\Http\Controllers\PageController::class, 'commentStatus']);
	Route::get('comment/delete/{id}', [App\Http\Controllers\PageController::class, 'commentDelete']);*/

	/*Category*/
	Route::get('category', [App\Http\Controllers\CategoryController::class, 'index']);
	Route::get('category/add', [App\Http\Controllers\CategoryController::class, 'add']);
	Route::post('category/add', [App\Http\Controllers\CategoryController::class, 'insert']);
	Route::get('category/edit/{id}', [App\Http\Controllers\CategoryController::class, 'edit']);
	Route::post('category/update', [App\Http\Controllers\CategoryController::class, 'update']);
	Route::get('category/delete/{id}', [App\Http\Controllers\CategoryController::class, 'delete']);
	Route::get('category/status/{id}/{status}', [App\Http\Controllers\CategoryController::class, 'status']);
	Route::get('category/file-destroy/{id}', [App\Http\Controllers\CategoryController::class, 'file_destroy']);

	/* News Category*/
	Route::get('newsCategory', [App\Http\Controllers\NewsCategoryController::class, 'index']);
	Route::get('newsCategory/add', [App\Http\Controllers\NewsCategoryController::class, 'add']);
	Route::post('newsCategory/add', [App\Http\Controllers\NewsCategoryController::class, 'insert']);
	Route::get('newsCategory/edit/{id}', [App\Http\Controllers\NewsCategoryController::class, 'edit']);
	Route::post('newsCategory/update', [App\Http\Controllers\NewsCategoryController::class, 'update']);
	Route::get('newsCategory/delete/{id}', [App\Http\Controllers\NewsCategoryController::class, 'delete']);
	Route::get('newsCategory/status/{id}/{status}', [App\Http\Controllers\NewsCategoryController::class, 'status']);
	Route::get('newsCategory/file-destroy/{id}', [App\Http\Controllers\NewsCategoryController::class, 'file_destroy']);

	/*News*/
	Route::get('news', [App\Http\Controllers\PageController::class, 'news']);
	Route::get('news/add', [App\Http\Controllers\PageController::class, 'news_add']);
	Route::get('news/edit/{id}', [App\Http\Controllers\PageController::class, 'news_edit']);

	/*Tag
	Route::get('tag', [App\Http\Controllers\TagController::class, 'index']);
	Route::get('tag/add', [App\Http\Controllers\TagController::class, 'add']);
	Route::post('tag/add', [App\Http\Controllers\TagController::class, 'insert']);
	Route::get('tag/edit/{id}', [App\Http\Controllers\TagController::class, 'edit']);
	Route::post('tag/update', [App\Http\Controllers\TagController::class, 'update']);
	Route::get('tag/delete/{id}', [App\Http\Controllers\TagController::class, 'delete']);
	Route::get('tag/status/{id}/{status}', [App\Http\Controllers\TagController::class, 'status']);
	Route::get('tag/file-destroy/{id}', [App\Http\Controllers\TagController::class, 'file_destroy']);*/

	/*Service
	Route::get('service', [App\Http\Controllers\ServiceController::class, 'index']);
	Route::get('service/add', [App\Http\Controllers\ServiceController::class, 'add']);
	Route::post('service/add', [App\Http\Controllers\ServiceController::class, 'insert']);
	Route::get('service/edit/{id}', [App\Http\Controllers\ServiceController::class, 'edit']);
	Route::post('service/update', [App\Http\Controllers\ServiceController::class, 'update']);
	Route::get('service/delete/{id}', [App\Http\Controllers\ServiceController::class, 'delete']);
	Route::get('service/status/{id}/{status}', [App\Http\Controllers\ServiceController::class, 'status']);
	Route::get('service/file-destroy/{id}/{key}', [App\Http\Controllers\ServiceController::class, 'file_destroy']);
	Route::get('service/gallery-destroy/{id}', [App\Http\Controllers\ServiceController::class, 'gallery_destroy']);*/

	/*Service Category
	Route::get('service-category', [App\Http\Controllers\ServiceCategoryController::class, 'index']);
	Route::get('service-category/add', [App\Http\Controllers\ServiceCategoryController::class, 'add']);
	Route::post('service-category/add', [App\Http\Controllers\ServiceCategoryController::class, 'insert']);
	Route::get('service-category/edit/{id}', [App\Http\Controllers\ServiceCategoryController::class, 'edit']);
	Route::post('service-category/update', [App\Http\Controllers\ServiceCategoryController::class, 'update']);
	Route::get('service-category/delete/{id}', [App\Http\Controllers\ServiceCategoryController::class, 'delete']);
	Route::get('service-category/status/{id}/{status}', [App\Http\Controllers\ServiceCategoryController::class, 'status']);
	Route::get('service-category/file-destroy/{id}/{key}', [App\Http\Controllers\ServiceCategoryController::class, 'file_destroy']);*/

	/*Category
	Route::get('service-time', [App\Http\Controllers\ServiceTimeController::class, 'index']);
	Route::get('service-time/add', [App\Http\Controllers\ServiceTimeController::class, 'add']);
	Route::post('service-time/add', [App\Http\Controllers\ServiceTimeController::class, 'insert']);
	Route::get('service-time/edit/{id}', [App\Http\Controllers\ServiceTimeController::class, 'edit']);
	Route::post('service-time/update', [App\Http\Controllers\ServiceTimeController::class, 'update']);
	Route::get('service-time/delete/{id}', [App\Http\Controllers\ServiceTimeController::class, 'delete']);
	Route::get('service-time/status/{id}/{status}', [App\Http\Controllers\ServiceTimeController::class, 'status']);
	Route::get('service-time/file-destroy/{id}', [App\Http\Controllers\ServiceTimeController::class, 'file_destroy']);*/

	/*Job
	Route::get('job', [App\Http\Controllers\JobController::class, 'index']);
	Route::get('job/view/{id}', [App\Http\Controllers\JobController::class, 'view']);
	Route::get('job/delete/{id}', [App\Http\Controllers\JobController::class, 'delete']);
	Route::get('job/status/{id}/{status}', [App\Http\Controllers\JobController::class, 'status']);
	Route::get('job/file-destroy/{id}/{key}', [App\Http\Controllers\JobController::class, 'file_destroy']);
	Route::get('job/gallery-destroy/{id}', [App\Http\Controllers\JobController::class, 'gallery_destroy']);*/

	/*Skill
	Route::get('skill', [App\Http\Controllers\SkillController::class, 'index']);
	Route::get('skill/add', [App\Http\Controllers\SkillController::class, 'add']);
	Route::post('skill/add', [App\Http\Controllers\SkillController::class, 'insert']);
	Route::get('skill/edit/{id}', [App\Http\Controllers\SkillController::class, 'edit']);
	Route::post('skill/update', [App\Http\Controllers\SkillController::class, 'update']);
	Route::get('skill/delete/{id}', [App\Http\Controllers\SkillController::class, 'delete']);
	Route::get('skill/status/{id}/{status}', [App\Http\Controllers\SkillController::class, 'status']);
	Route::get('skill/file-destroy/{id}', [App\Http\Controllers\SkillController::class, 'file_destroy']);*/

	/*Testimonial*/
	Route::get('testimonial', [App\Http\Controllers\TestimonialController::class, 'index']);
	Route::get('testimonial/add', [App\Http\Controllers\TestimonialController::class, 'add']);
	Route::post('testimonial/add', [App\Http\Controllers\TestimonialController::class, 'insert']);
	Route::get('testimonial/edit/{id}', [App\Http\Controllers\TestimonialController::class, 'edit']);
	Route::post('testimonial/update', [App\Http\Controllers\TestimonialController::class, 'update']);
	Route::get('testimonial/delete/{id}', [App\Http\Controllers\TestimonialController::class, 'delete']);
	Route::get('testimonial/status/{id}/{status}', [App\Http\Controllers\TestimonialController::class, 'status']);
	Route::get('testimonial/file-destroy/{id}', [App\Http\Controllers\TestimonialController::class, 'file_destroy']);


	// Seo landing Section
	Route::get('seo-result-landing', [App\Http\Controllers\PageController::class, 'seoResultLanding']);
	Route::get('seo-landing', [App\Http\Controllers\PageController::class, 'seoLanding']);
	Route::get('seo-landing/add', [App\Http\Controllers\PageController::class, 'addSeolanding']);
	Route::post('seo-landing/add', [App\Http\Controllers\PageController::class, 'insertSeoLanding']);
	Route::get('seo-landing/edit/{id}', [App\Http\Controllers\PageController::class, 'editSeolanding']);
	Route::post('seo-landing/update', [App\Http\Controllers\PageController::class, 'updateSeoLanding']);
	Route::get('seo-landing/delete/{id}', [App\Http\Controllers\PageController::class, 'deleteSeoLanding']);
	Route::get('seo_result/status/{id}', [App\Http\Controllers\PageController::class, 'display_visible_seo_result']);
	Route::post('order_display_seo_result', [App\Http\Controllers\SeoResultController::class, 'order_display'])->name('order_display_seo_result');
	
    // csv upload
    Route::post('upload-result-overview', [App\Http\Controllers\PageController::class, 'ResultOverview'])->name('ResultOverview');
    
    Route::get('result_overview/{id}', [App\Http\Controllers\DownloadCsvController::class, 'result_overview'])->name('result_overview');
    Route::get('keyword_data_csv/{id}', [App\Http\Controllers\DownloadCsvController::class, 'keyword_data_csv'])->name('keyword_data_csv');
    Route::get('keyword_growth_csv/{id}', [App\Http\Controllers\DownloadCsvController::class, 'keyword_growth_csv'])->name('keyword_growth_csv');
    // csv upload 	
	
	
	
	//seoResult Category    
	Route::get('seoResultCategory', [App\Http\Controllers\SeoResultController::class, 'index'])->name('seoResultCategory.index');
	Route::get('seoResultCategory/add', [App\Http\Controllers\SeoResultController::class, 'add']);
	Route::post('seoResultCategory/add', [App\Http\Controllers\SeoResultController::class, 'insert']);
	Route::get('seoResultCategory/edit/{id}', [App\Http\Controllers\SeoResultController::class, 'edit'])->name('seoResultCategory.edit');
	Route::post('seoResultCategory/update', [App\Http\Controllers\SeoResultController::class, 'update'])->name('seoResultCategory.update');
	Route::get('seoResultCategory/delete/{id}', [App\Http\Controllers\SeoResultController::class, 'delete'])->name('seoResultCategory.delete');
	Route::get('seoResultCategory/status/{id}/{status}', [App\Http\Controllers\SeoResultController::class, 'status'])->name('seoResultCategory.status');
	Route::match(['put', 'delete', 'patch'], '/updateDeleteToggleresult/{id}', [App\Http\Controllers\SeoResultController::class, 'updateDeleteToggleresult'])->name('updateDeleteToggleresult');


	// Media Library Section
	Route::match(['get', 'post'],'media-library-images', [App\Http\Controllers\PageController::class, 'mediaLibrary']);
	Route::get('media-library-images/add', [App\Http\Controllers\PageController::class, 'addMediaLibrary']);
	Route::post('media-library-images/add', [App\Http\Controllers\PageController::class, 'insertMediaLibrary']);
	Route::post('update-media-library-images', [App\Http\Controllers\PageController::class, 'mediaLibraryImageUpdate']);
	Route::post('search-media-library-images', [App\Http\Controllers\PageController::class, 'mediaLibraryImageSearch']);
	// Route::get('seo-landing/edit/{id}', [App\Http\Controllers\PageController::class, 'editSeolanding']);
	// Route::post('seo-landing/update', [App\Http\Controllers\PageController::class, 'updateSeoLanding']);
	Route::get('media-library-images/delete/{id}', [App\Http\Controllers\PageController::class, 'deleteMediaLibrary']);
	// Route::get('testimonial/status/{id}/{status}', [App\Http\Controllers\PageController::class, 'status']);
	// Route::get('testimonial/file-destroy/{id}', [App\Http\Controllers\PageController::class, 'file_destroy']);


	/*form*/
	Route::get('form', [App\Http\Controllers\PageController::class, 'form']);
	Route::get('form/add', [App\Http\Controllers\PageController::class, 'form_add']);
	Route::get('form/edit/{id}', [App\Http\Controllers\PageController::class, 'form_edit']);


	Route::match(['get', 'post'],'exportTableData/{type}', [App\Http\Controllers\PageController::class, 'exportTableData']);
	Route::match(['get', 'post'],'importData', [App\Http\Controllers\PageController::class, 'importData'])->name('importData');
	Route::match(['get', 'post'],'sampleFile', [App\Http\Controllers\PageController::class, 'sampleFile'])->name('sampleFile');

	//Guess form 
	Route::get('guest-forms-data', [App\Http\Controllers\PageController::class, 'guestFormData']);
	Route::match(['get', 'post'],'delete-enquiry/{id}', [App\Http\Controllers\PageController::class, 'deleteEnquiry']);
	Route::match(['get', 'post'],'delete-guest-form/{id}', [App\Http\Controllers\PageController::class, 'deleteGuestForm']);
	
	//Site Map
	Route::post('sitemap_view', [App\Http\Controllers\SitemapXmlController::class, 'siteMap']);
});

// admin routes

/*Front-End Route Start*/

// Route::middleware('HtmlMinifier')->group(function(){
    
Route::post('image-get',[App\Http\Controllers\FrontendController::class, 'imageGet'])->name('imageGet');
// Route::post('/body_form_data', [App\Http\Controllers\FrontendController::class, 'seo_result_filter'])->name('seo_result_filter');
Route::post('/seo_result_filter/{category_id}', [App\Http\Controllers\FrontendController::class, 'seo_result_filter'])->name('seo_result_filter');
Route::get('/price_new', [App\Http\Controllers\FrontendController::class, 'price_new']);
Route::get('/', [App\Http\Controllers\FrontendController::class, 'index'])->name('main_page');
Route::get('/home', [App\Http\Controllers\FrontendController::class, 'index']); //dashboard

Route::get('/user-logout',  [App\Http\Controllers\FrontendController::class, 'logout'])->name('user_logout');
Route::get('/login', [App\Http\Controllers\FrontendController::class, 'user_login'])->name('user.login');
Route::post('/login', [App\Http\Controllers\FrontendController::class, 'doLogin'])->name('client.login');
Route::post('/register', [App\Http\Controllers\FrontendController::class, 'user_register'])->name('user.register');

Route::get('auth/google', [SocialAuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [SocialAuthController::class, 'handleGoogleCallback']);

Route::prefix('facebook')->name('facebook.')->group(function(){
    Route::get('auth', [SocialAuthController::class, 'redirectToFacebook'])->name('auth.facebook');
    Route::get('callback', [SocialAuthController::class, 'handleFacebookCallback'])->name('callbackFacebook');
});




Route::get('/purchase', [App\Http\Controllers\FrontendController::class, 'purchase'])->name('purchase');
// Route::get('/purchase_second', [App\Http\Controllers\FrontendController::class, 'purchase_second'])->name('purchase_second');
Route::get('/purchase-next', [App\Http\Controllers\FrontendController::class, 'purchase_second'])->name('purchase_second'); 
Route::get('/thank-purchase/{id}', [App\Http\Controllers\FrontendController::class, 'thank'])->name('thank_page');

// 	new purchase journey
Route::get('purchase_first', [App\Http\Controllers\FrontendController::class, 'purchase2'])->name('purchase2');
Route::get('purchase_second', [App\Http\Controllers\FrontendController::class, 'purchase_second2'])->name('purchase_second2');
Route::get('/add-to-cart-new', [App\Http\Controllers\FrontendController::class, 'addToCartNew'])->name('cart.add.new');
Route::get('/cart-new', [App\Http\Controllers\FrontendController::class,'showCartNew'])->name('cart.show.new');
    // 	new purchase journey




Route::get('partials/desktop-banner', function () {
    
    $image = ''; 
    $page_id = 0; 
    $title = ''; 
    $allServiceData = []; 
    $btn_text = ''; 
    $first_body = ''; 

    return view('frontend.pages.banner.desktop-banner', compact('image', 'page_id', 'title', 'allServiceData', 'btn_text', 'first_body'));
})->name('partials.desktop-banner');

Route::get('partials/mobile-banner', function () {
    
    $image = ''; 
    $page_id = 0; 
    $title = '';  
    $allServiceData = []; 
    $btn_text = ''; 
    $first_body = '';  
    
    return view('frontend.pages.banner.mobile-banner', compact('image', 'page_id', 'title', 'allServiceData', 'btn_text', 'first_body'));
})->name('partials.mobile-banner');


Route::get('/user-dashboard', [App\Http\Controllers\UserController::class, 'user_dashbrad'])->name('user_dashbrad');
// Route::get('/user-profile', [App\Http\Controllers\FrontendController::class, 'user_profile'])->name('user_profile');

Route::get('/add-to-cart', [App\Http\Controllers\FrontendController::class, 'addToCart'])->name('cart.add');


// Route for displaying the cart
Route::get('/cart', [App\Http\Controllers\FrontendController::class,'showCart'])->name('cart.show');
Route::get('/cart-new', [App\Http\Controllers\FrontendController::class,'showCartNew'])->name('cart.show.new');
// Route for processing payment
Route::get('/checkout', [App\Http\Controllers\FrontendController::class,'checkout'])->name('checkout.show');
Route::post('/checkout', [App\Http\Controllers\FrontendController::class,'checkout_client'])->name('checkout');
Route::get('/checkout/review/payment', [App\Http\Controllers\FrontendController::class,'payment'])->name('front.checkout.payment'); 
Route::post('/checkout-submit', [App\Http\Controllers\FrontendController::class, 'checkout_submit'])->name('front.checkout.submit');

// paytm routes
Route::post('/payment/callback', [App\Http\Controllers\PaytmController::class,'handleCallback'])->name('front.paytm.callback');
Route::post('/paytm/notify', [App\Http\Controllers\PaytmController::class,'notify'])->name('front.paytm.notify');
Route::post('/paytm/submit', [App\Http\Controllers\PaytmController::class,'store'])->name('front.paytm.submit');

// razorpay 
Route::post('/razorpay/notify', [App\Http\Controllers\RazorpayController::class, 'notify'])->name('front.razorpay.notify');
Route::post('/razorpay/submit', [App\Http\Controllers\RazorpayController::class, 'store'])->name('front.razorpay.submit');


//  payment redirection 
Route::get('/checkout/redirect', [App\Http\Controllers\FrontendController::class, 'paymentRedirect'])->name('front.checkout.redirect');
Route::get('/checkout/success', [App\Http\Controllers\FrontendController::class, 'paymentSuccess'])->name('front.checkout.success');
Route::get('/checkout/cancle', [App\Http\Controllers\FrontendController::class, 'paymentCancle'])->name('front.checkout.cancle');
Route::group(['middleware' => ['auth']], function () {
// 	Route::any('/logout', [App\Http\Controllers\UserController::class, 'logout'])->name('user_logout');
});
Route::group(['middleware' => ['auth','verified']], function() {
});


Route::get('/404', [App\Http\Controllers\FrontendController::class, 'not_found']);

// Route::get('change_data', [App\Http\Controllers\FrontendController::class, 'change_data'])->name('change_data');
// Route::get('siteMapData', [App\Http\Controllers\SitemapXmlController::class, 'siteMap']);
// Route::get('sitemap_index.xml', [App\Http\Controllers\SitemapXmlController::class, 'siteMapView']);


// Route::get('blog-details/{slug}', [App\Http\Controllers\FrontendController::class, 'blog_details']);
Route::get('blog/{slug}', [App\Http\Controllers\FrontendController::class, 'blog_details']);
Route::get('news/{slug}', [App\Http\Controllers\FrontendController::class, 'newsDetails']);
Route::get('category/{id}', [App\Http\Controllers\FrontendController::class, 'getCategoriesBlog']);
Route::get('news-category/{id}', [App\Http\Controllers\FrontendController::class, 'getCategoriesNews']);
Route::match(['get', 'post'],'contact_us', [App\Http\Controllers\FrontendController::class, 'Contact_us']);
Route::match(['get', 'post'],'home-form', [App\Http\Controllers\FrontendController::class, 'homeForm']);
Route::match(['get', 'post'],'blog-form', [App\Http\Controllers\FrontendController::class, 'blogForm'])->name('blog_form');
Route::match(['get', 'post'],'guest-form', [App\Http\Controllers\FrontendController::class, 'guestForm']);
Route::match(['get', 'post'],'blog-comment-form', [App\Http\Controllers\FrontendController::class, 'blogCommentForm']);
Route::match(['get', 'post'],'service-form', [App\Http\Controllers\FrontendController::class, 'serviceForm']);
// Route::match(['get', 'post'],'seo-landing-details/{id}', [App\Http\Controllers\FrontendController::class, 'seoLandingDetails']);
Route::match(['get', 'post'],'seo-result/{id}', [App\Http\Controllers\FrontendController::class, 'seoLandingDetails']);
Route::match(['get', 'post'],'case-study/{id}', [App\Http\Controllers\FrontendController::class, 'caseStudyDetails']);
Route::match(['get', 'post'],'portfolio/{id}', [App\Http\Controllers\FrontendController::class, 'portfolioDetails']);


Route::match(['get', 'post'],'/{slug}/{business}', [App\Http\Controllers\FrontendController::class, 'dynamicCityView']);
Route::match(['get', 'post'],'/{city}/{slug}', [App\Http\Controllers\FrontendController::class, 'dynamicCityView']);
Route::match(['get', 'post'],'/{city}/{slug}/{business}', [App\Http\Controllers\FrontendController::class, 'dynamicCityBusinessView']);

Route::get('/{slug}', [App\Http\Controllers\FrontendController::class, 'ShowPage']);  

Route::post('/value_total', [App\Http\Controllers\FrontendController::class, 'value_total'])->name('value_total'); 
Route::post('/change_plan_duration', [App\Http\Controllers\FrontendController::class, 'change_plan_duration'])->name('change_plan_duration'); 
Route::post('/delete_cart', [App\Http\Controllers\FrontendController::class, 'delete_cart'])->name('delete_cart'); 


//CashfreeController 

;

 
 

