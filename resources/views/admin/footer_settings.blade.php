@extends('layouts.admin')



@section('content')

  <!-- Content Header (Page header) -->

  <div class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1 class="m-0 text-dark">{{ __('Header Settings') }}</h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>

            <li class="breadcrumb-item active">{{ __('Header Settings') }}</li>

          </ol>

        </div>

      </div>

    </div>

  </div>



  

<!-- Main content -->

<section class="content">

  <div class="container-fluid">

    <div class="row">

      @include('admin.message') 

      <div class="col-md-12">

        <div class="card card-primary">

          <div class="card-header with-border">

            <h3 class="card-title">Header Settings</h3>

          </div>

          <!-- /.card-header -->

          <!-- form start -->

          <form type="form" action="{{ url(Admin_Prefix.'footer-settings') }}"  method="post" enctype="multipart/form-data" class="customValidate">
            @csrf
            <div class="card-body">

                <div class="form-group row clearfix">
                    <label class="col-sm-2 control-label">Skype Link</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="site_skype_link" id="site_skype_link" placeholder="Enter ..." value="{!!config('site.skype_link')!!}" data-url="true">
                    </div>
                  </div>
    
                  <div class="form-group row clearfix">
                    <label class="col-sm-2 control-label">Facebook Link</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="site_facebook_link" id="site_facebook_link" placeholder="Enter ..." value="{!!config('site.facebook_link')!!}" data-validation-engine="validate[custom[url]]">
                    </div>
                  </div>
    
                  <div class="form-group row clearfix">
                    <label class="col-sm-2 control-label">Twitter Link</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="site_twitter_link" id="site_twitter_link" placeholder="Enter ..." value="{!!config('site.twitter_link')!!}" data-url="true">
                    </div>
                  </div>
    
                  <div class="form-group row clearfix">
                    <label class="col-sm-2 control-label">Linkedin Link</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="site_linkedin_link" id="site_linkedin_link" placeholder="Enter ..." value="{!!config('site.linkedin_link')!!}" data-url="true">
                    </div>
                  </div>
    
                  <div class="form-group row clearfix">
                    <label class="col-sm-2 control-label">Instagram Link</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="site_instagram_link" id="site_instagram_link" placeholder="Enter ..." value="{!!config('site.instagram_link')!!}" data-validation-engine="validate[custom[url]]">
                    </div>
                  </div>
    
    
    
                  <div class="form-group row clearfix">
                    <label class="col-sm-2 control-label">Pinterest Link</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control url" name="site_pinterest_link" id="site_pinterest_link" placeholder="Enter ..." value="{!!config('site.pinterest_link')!!}">
                    </div>
                  </div>
    
                  <div class="form-group row clearfix">
                    <label class="col-sm-2 control-label">Youtube Link</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="site_youtube_link" id="site_youtube_link" placeholder="Enter ..." value="{!!config('site.youtube_link')!!}" data-url="true">
                    </div>
                  </div>
    
                  <div class="form-group row clearfix">
                    <label class="col-sm-2 control-label">Community Link</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="site_community_link" id="site_community_link" placeholder="Enter ..." value="{!!config('site.community_link')!!}" data-url="true">
                    </div>
                  </div>
    
    
                  <div class="form-group row clearfix">
                    <label class="col-sm-2 control-label">Footer Content</label>
                    <div class="col-sm-10">
                      <textarea name="site_footer1_title" class="ckeditor" placeholder="Enter ...">{!!config('site.footer1_title')!!}</textarea>
                    </div>
                  </div>
    
                  <div class="form-group row clearfix">
                    <label class="col-sm-2 control-label">Footer Title 2</label>
                    <div class="col-sm-10 mt-1">
                      <input type="text" class="form-control" name="site_footer2_title" id="site_footer2_title" placeholder="Enter ..." value="{!!config('site.footer2_title')!!}">
                    </div>
                    <label class="col-sm-2 control-label mt-1">Address 1</label>
                    <div class="col-sm-10 mt-1">
                      <input type="text" class="form-control" name="site_footer2_title1" id="site_footer2_title1" placeholder="Enter ..." value="{!!config('site.footer2_title1')!!}">
                    </div>
                    <label class="col-sm-2 control-label mt-1">Address 2</label>
                    <div class="col-sm-10 mt-1">
                      <input type="text" class="form-control" name="site_footer2_title6" id="site_footer2_title6" placeholder="Enter ..." value="{!!config('site.footer2_title6')!!}">
                    </div>
                    <label class="col-sm-2 control-label mt-1">Phone no 1</label>
                    <div class="col-sm-10 mt-1">
                      <input type="text" class="form-control" name="site_footer2_title2" id="site_footer2_title2" placeholder="Enter ..." value="{!!config('site.footer2_title2')!!}">
                    </div>
                    <label class="col-sm-2 control-label mt-1">Phone no 2</label>
                    <div class="col-sm-10 mt-1">
                      <input type="text" class="form-control" name="site_footer2_title7" id="site_footer2_title7" placeholder="Enter ..." value="{!!config('site.footer2_title7')!!}">
                    </div>
                    <label class="col-sm-2 control-label mt-1">Email</label>
                    <div class="col-sm-10 mt-1">
                      <input type="text" class="form-control" name="site_footer2_title3" id="site_footer2_title3" placeholder="Enter ..." value="{!!config('site.footer2_title3')!!}">
                    </div>
                    <label class="col-sm-2 control-label mt-1">WhatsApp</label>
                    <div class="col-sm-10 mt-1">
                      <input type="text" class="form-control" name="site_footer2_title4" id="site_footer2_title4" placeholder="Enter ..." value="{!!config('site.footer2_title4')!!}">
                    </div>
                    <label class="col-sm-2 control-label mt-1">Help</label>
                    <div class="col-sm-10 mt-1">
                      <input type="text" class="form-control" name="site_footer2_title5" id="site_footer2_title5" placeholder="Enter ..." value="{!!config('site.footer2_title5')!!}">
                    </div>
                    <label class="col-sm-2 control-label mt-1">Skype</label>
                    <div class="col-sm-10 mt-1">
                      <input type="text" class="form-control" name="site_footer2_title8" id="site_footer2_title8" placeholder="Enter ..." value="{!!config('site.footer2_title8')!!}">
                    </div>
                  </div>
    
                  <div class="form-group row clearfix">
                    <label class="col-sm-2 control-label">Footer Title 3</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="site_footer3_title" id="site_footer3_title" placeholder="Enter ..." value="{!!config('site.footer3_title')!!}">
                    </div>
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10 mt-1">
                      <select class="form-control" name="site_footer3_title1" id="site_footer3_title1">
                        <option value="" selected disabled>Select</option>
                        @foreach($service_pages as $val)
                          <option value="{!! $val->id !!}" @if(config('site.footer3_title1') == $val->id ) selected @endif>{!! $val->page_name !!}</option>
                        @endforeach
                      </select>
                      <!-- <input type="text" class="form-control" name="site_footer3_title1" id="site_footer3_title1" placeholder="Enter ..." value="{!!config('site.footer3_title1')!!}"> -->
                    </div>
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10 mt-1">
                    <select class="form-control" name="site_footer3_title2" id="site_footer3_title2">
                        <option value="" selected disabled>Select</option>
                        @foreach($service_pages as $val)
                          <option value="{!! $val->id !!}" @if(config('site.footer3_title2') == $val->id ) selected @endif>{!! $val->page_name !!}</option>
                        @endforeach
                      </select>
                      <!-- <input type="text" class="form-control" name="site_footer3_title2" id="site_footer3_title2" placeholder="Enter ..." value="{!!config('site.footer3_title2')!!}"> -->
                    </div>
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10 mt-1">
                    <select class="form-control" name="site_footer3_title3" id="site_footer3_title3">
                        <option value="" selected disabled>Select</option>
                        @foreach($service_pages as $val)
                          <option value="{!! $val->id !!}" @if(config('site.footer3_title3') == $val->id ) selected @endif>{!! $val->page_name !!}</option>
                        @endforeach
                      </select>
                      <!-- <input type="text" class="form-control" name="site_footer3_title3" id="site_footer3_title3" placeholder="Enter ..." value="{!!config('site.footer3_title3')!!}"> -->
                    </div>
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10 mt-1">
                    <select class="form-control" name="site_footer3_title4" id="site_footer3_title4">
                        <option value="" selected disabled>Select</option>
                        @foreach($service_pages as $val)
                          <option value="{!! $val->id !!}" @if(config('site.footer3_title4') == $val->id ) selected @endif>{!! $val->page_name !!}</option>
                        @endforeach
                      </select>
                      <!-- <input type="text" class="form-control" name="site_footer3_title4" id="site_footer3_title4" placeholder="Enter ..." value="{!!config('site.footer3_title4')!!}"> -->
                    </div>
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10 mt-1">
                    <select class="form-control" name="site_footer3_title5" id="site_footer3_title5">
                        <option value="" selected disabled>Select</option>
                        @foreach($service_pages as $val)
                          <option value="{!! $val->id !!}" @if(config('site.footer3_title5') == $val->id ) selected @endif>{!! $val->page_name !!}</option>
                        @endforeach
                      </select>
                      <!-- <input type="text" class="form-control" name="site_footer3_title5" id="site_footer3_title5" placeholder="Enter ..." value="{!!config('site.footer3_title5')!!}"> -->
                    </div>
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10 mt-1">
                    <select class="form-control" name="site_footer3_title6" id="site_footer3_title6">
                        <option value="" selected disabled>Select</option>
                        @foreach($service_pages as $val)
                          <option value="{!! $val->id !!}" @if(config('site.footer3_title6') == $val->id ) selected @endif>{!! $val->page_name !!}</option>
                        @endforeach
                      </select>
                    </div>
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10 mt-1">
                    <select class="form-control" name="site_footer3_title7" id="site_footer3_title7">
                        <option value="" selected disabled>Select</option>
                        @foreach($service_pages as $val)
                          <option value="{!! $val->id !!}" @if(config('site.footer3_title7') == $val->id ) selected @endif>{!! $val->page_name !!}</option>
                        @endforeach
                      </select>
                    </div>
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10 mt-1">
                    <select class="form-control" name="site_footer3_title8" id="site_footer3_title8">
                        <option value="" selected disabled>Select</option>
                        @foreach($service_pages as $val)
                          <option value="{!! $val->id !!}" @if(config('site.footer3_title8') == $val->id ) selected @endif>{!! $val->page_name !!}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
    
                  <div class="form-group row clearfix">
                    <label class="col-sm-2 control-label">Footer Title 4</label>
                    <div class="col-sm-10 mt-1">
                      <input type="text" class="form-control" name="site_footer4_title" id="site_footer4_title" placeholder="Enter ..." value="{!!config('site.footer4_title')!!}">
                    </div>
                    <label class="col-sm-2 mt-2 control-label">Title</label>
                    <div class="col-sm-4 mt-1">
                      <input type="text" class="form-control" name="site_resource_title1" value="{!!config('site.resource_title1')!!}">
                    </div>
                    <label class="col-sm-1 mt-2 control-label">Link</label>
                    <div class="col-sm-4 mt-1">
                      <input type="text" class="form-control" name="site_resource_link1" value="{!!config('site.resource_link1')!!}">
                    </div>
                    <label class="col-sm-2 mt-2 control-label">Title</label>
                    <div class="col-sm-4 mt-1">
                      <input type="text" class="form-control" name="site_resource_title2" value="{!!config('site.resource_title2')!!}">
                    </div>
                    <label class="col-sm-1 mt-2 control-label">Link</label>
                    <div class="col-sm-4 mt-1">
                      <input type="text" class="form-control" name="site_resource_link2" value="{!!config('site.resource_link2')!!}">
                    </div>
                    <label class="col-sm-2 mt-2 control-label">Title</label>
                    <div class="col-sm-4 mt-1">
                      <input type="text" class="form-control" name="site_resource_title3" value="{!!config('site.resource_title3')!!}">
                    </div>
                    <label class="col-sm-1 mt-2 control-label">Link</label>
                    <div class="col-sm-4 mt-1">
                      <input type="text" class="form-control" name="site_resource_link3" value="{!!config('site.resource_link3')!!}">
                    </div>
                    <label class="col-sm-2 mt-2 control-label">Title</label>
                    <div class="col-sm-4 mt-1">
                      <input type="text" class="form-control" name="site_resource_title4" value="{!!config('site.resource_title4')!!}">
                    </div>
                    <label class="col-sm-1 mt-2 control-label">Link</label>
                    <div class="col-sm-4 mt-1">
                      <input type="text" class="form-control" name="site_resource_link4" value="{!!config('site.resource_link4')!!}">
                    </div>
                    <label class="col-sm-2 mt-2 control-label">Title</label>
                    <div class="col-sm-4 mt-1">
                      <input type="text" class="form-control" name="site_resource_title5" value="{!!config('site.resource_title5')!!}">
                    </div>
                    <label class="col-sm-1 mt-2 control-label">Link</label>
                    <div class="col-sm-4 mt-1">
                      <input type="text" class="form-control" name="site_resource_link5" value="{!!config('site.resource_link5')!!}">
                    </div>
                    <label class="col-sm-2 mt-2 control-label">Title</label>
                    <div class="col-sm-4 mt-1">
                      <input type="text" class="form-control" name="site_resource_title6" value="{!!config('site.resource_title6')!!}">
                    </div>
                    <label class="col-sm-1 mt-2 control-label">Link</label>
                    <div class="col-sm-4 mt-1">
                      <input type="text" class="form-control" name="site_resource_link6" value="{!!config('site.resource_link6')!!}">
                    </div>
                    <label class="col-sm-2 mt-2 control-label">Title</label>
                    <div class="col-sm-4 mt-1">
                      <input type="text" class="form-control" name="site_resource_title7" value="{!!config('site.resource_title7')!!}">
                    </div>
                    <label class="col-sm-1 mt-2 control-label">Link</label>
                    <div class="col-sm-4 mt-1">
                      <input type="text" class="form-control" name="site_resource_link7" value="{!!config('site.resource_link7')!!}">
                    </div>
                    <label class="col-sm-2 mt-2 control-label">Title</label>
                    <div class="col-sm-4 mt-1">
                      <input type="text" class="form-control" name="site_resource_title8" value="{!!config('site.resource_title8')!!}">
                    </div>
                    <label class="col-sm-1 mt-2 control-label">Link</label>
                    <div class="col-sm-4 mt-1">
                      <input type="text" class="form-control" name="site_resource_link8" value="{!!config('site.resource_link8')!!}">
                    </div>
                  </div>
    
                  <div class="form-group row clearfix">
                    <label class="col-sm-2 control-label">Footer Title 5</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="site_footer5_title" id="site_footer5_title" placeholder="Enter ..." value="{!!config('site.footer5_title')!!}">
                    </div>
                  </div>
    
                  <?php
                  $exclude_stuctured_data = [];
                  if (config('site.exclude_stuctured_data')) {
                    $exclude_stuctured_data = explode(',', config('site.exclude_stuctured_data'));
                  }
                  ?>
                  <div class="form-group row clearfix">
                    <label class="col-sm-2 control-label">Exclude Stuctured Data</label>
                    <div class="col-sm-10">
                      <select name="exclude_stuctured_data[]" id="exclude_stuctured_data" class="form-control select2" multiple>
                        <option value="">Select</option>
                        @foreach ($all_pages as $key => $value)
                            <option value="{{ $value->id }}" {{ in_array($value->id, $exclude_stuctured_data)  ? 'selected' : '' }}>
                                {{ $value->page_name }}
                            </option>
                        @endforeach
                      </select>
                    </div>
                  </div>
    
                  <div class="form-group row clearfix">
                    <label class="col-sm-2 control-label">Important Links</label>
                    <div class="col-sm-10">
                      <!-- <input type="text" class="form-control" name="site_footer4_title" id="site_footer4_title" placeholder="Enter ..." value="{!!config('site.footer4_title')!!}"> -->
                    </div>
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10 mt-1">
                      <select class="form-control" name="site_important_links1" id="site_important_links1">
                        <option value="" selected disabled>Select</option>
                        @foreach($page_pages as $val)
                          <option value="{!! $val->id !!}" @if(config('site.important_links1') == $val->id ) selected @endif>{!! $val->page_name !!}</option>
                        @endforeach
                      </select>
                    </div>
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10 mt-1">
                      <select class="form-control" name="site_important_links2" id="site_important_links2">
                        <option value="" selected disabled>Select</option>
                        @foreach($page_pages as $val)
                          <option value="{!! $val->id !!}" @if(config('site.important_links2') == $val->id ) selected @endif>{!! $val->page_name !!}</option>
                        @endforeach
                      </select>
                    </div>
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10 mt-1">
                    <select class="form-control" name="site_important_links3" id="site_important_links3">
                        <option value="" selected >Select</option>
                        @foreach($page_pages as $val)
                          <option value="{!! $val->id !!}" @if(config('site.important_links3') == $val->id ) selected @endif>{!! $val->page_name !!}</option>
                        @endforeach
                      </select>
                    </div>
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10 mt-1">
                    <select class="form-control" name="site_important_links4" id="site_important_links4">
                        <option value="" selected >Select</option>
                        @foreach($page_pages as $val)
                          <option value="{!! $val->id !!}" @if(config('site.important_links4') == $val->id ) selected @endif>{!! $val->page_name !!}</option>
                        @endforeach
                      </select>
                    </div>
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10 mt-1">
                    <select class="form-control" name="site_important_links5" id="site_important_links5">
                        <option value="" selected >Select</option>
                        @foreach($page_pages as $val)
                          <option value="{!! $val->id !!}" @if(config('site.important_links5') == $val->id ) selected @endif>{!! $val->page_name !!}</option>
                        @endforeach
                      </select>
                    </div>
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10 mt-1">
                    <select class="form-control" name="site_important_links6" id="site_important_links6">
                        <option value="" selected disabled>Select</option>
                        @foreach($page_pages as $val)
                          <option value="{!! $val->id !!}" @if(config('site.important_links6') == $val->id ) selected @endif>{!! $val->page_name !!}</option>
                        @endforeach
                      </select>
                    </div>
                    <label class="col-sm-2 control-label"></label>
                    <div class="col-sm-10 mt-1">
                    <select class="form-control" name="site_important_links7" id="site_important_links7">
                        <option value="" selected >Select</option>
                        @foreach($page_pages as $val)
                          <option value="{!! $val->id !!}" @if(config('site.important_links7') == $val->id ) selected @endif>{!! $val->page_name !!}</option>
                        @endforeach
                      </select>
                    </div>
                    <label class="col-sm-2 control-label"></label>
                      <div class="col-sm-10 mt-1">
                          <select class="form-control" name="site_important_links8" id="site_important_links8">
                            <option value="" selected disabled>Select</option>
                            @foreach($page_pages as $val)
                              <option value="{!! $val->id !!}" @if(config('site.important_links8') == $val->id ) selected @endif>{!! $val->page_name !!}</option>
                            @endforeach
                          </select>
                      </div>
                    <label class="col-sm-2 control-label"></label>
                      <div class="col-sm-10 mt-1">
                          <select class="form-control" name="site_important_links9" id="site_important_links9">
                            <option value="" selected >Select</option>
                            @foreach($page_pages as $val)
                              <option value="{!! $val->id !!}" @if(config('site.important_links9') == $val->id ) selected @endif>{!! $val->page_name !!}</option>
                            @endforeach
                          </select>
                      </div>
                    <label class="col-sm-2 control-label"></label>
                      <div class="col-sm-10 mt-1">
                          <select class="form-control" name="site_important_links10" id="site_important_links10">
                            <option value="" selected >Select</option>
                            @foreach($page_pages as $val)
                              <option value="{!! $val->id !!}" @if(config('site.important_links10') == $val->id ) selected @endif>{!! $val->page_name !!}</option>
                            @endforeach
                          </select>
                      </div>
                    <label class="col-sm-2 control-label"></label>
                      <div class="col-sm-10 mt-1">
                          <select class="form-control" name="site_important_links11" id="site_important_links11">
                            <option value="" selected >Select</option>
                            @foreach($page_pages as $val)
                              <option value="{!! $val->id !!}" @if(config('site.important_links11') == $val->id ) selected @endif>{!! $val->page_name !!}</option>
                            @endforeach
                          </select>
                      </div>
                  </div>
    
                  <div class="form-group row clearfix">
                    <label class="col-sm-2 control-label">Payment Mathods</label>
                    <div class="col-sm-10 mt-1">
                      <input type="file" name="site_payment_methods" class="form-control1">
                      <br><small>Mime Type: webp, Max image upload size 2 Mb</small>
                      <div class="clearfix">
                        <?php
                        if(config('site.payment_methods') && File::exists(public_path('uploads/'.config('site.payment_methods'))) )
                        {
                          ?>
                          <img src="{{ asset('/uploads/'.config('site.payment_methods')) }}" style="margin: 10px 0 0 0; max-width: 200px;background: #033355;padding: 10px;border-radius: 10px;">
                          <?php
                        }
                        ?>
                      </div>
                    </div>
                  </div> 
    
                  <div class="form-group row clearfix">
                    <label class="col-sm-2 control-label">BUY WITH CONFIDENCE </label>
                    <div class="col-sm-10">
                      <input type="file" name="site_buy_with_confidence" class="form-control1">
                      <br><small>Mime Type: webp, Max image upload size 2 Mb</small>
                      <div class="clearfix">
                        <?php
                        if(config('site.buy_with_confidence') && File::exists(public_path('uploads/'.config('site.buy_with_confidence'))) )
                        {
                          ?>
                          <img src="{{ asset('/uploads/'.config('site.buy_with_confidence')) }}" style="margin: 10px 0 0 0; max-width: 200px;background: #033355;padding: 10px;border-radius: 10px;">
                          <?php
                        }
                        ?>
                      </div>
                    </div>
                  </div> 
    
                  <div class="form-group row clearfix">
                    <label class="col-sm-2 control-label">Copyright</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" name="site_copyright" id="site_copyright" placeholder="Enter ..." value="{!!config('site.copyright')!!}">
                    </div>
                  </div>

            </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
              </div>

            </form>
           

          </div>

          <!-- /.card -->



        </div>


      </div>

      <!-- /.row -->

  </div>

</section>

<!-- /.content -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

@endsection



