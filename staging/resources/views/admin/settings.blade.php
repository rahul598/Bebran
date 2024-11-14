@extends('layouts.admin')



@section('content')

  <!-- Content Header (Page header) -->

  <div class="content-header">

    <div class="container-fluid">

      <div class="row mb-2">

        <div class="col-sm-6">

          <h1 class="m-0 text-dark">{{ __('General Settings') }}</h1>

        </div>

        <div class="col-sm-6">

          <ol class="breadcrumb float-sm-right">

            <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>

            <li class="breadcrumb-item active">{{ __('General Settings') }}</li>

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

            <h3 class="card-title">General Settings</h3>

          </div>

          <!-- /.card-header -->

          <!-- form start -->

          <form type="form" action="{{ url(Admin_Prefix.'general-settings') }}"  method="post" enctype="multipart/form-data" class="customValidate">



            @csrf



            <div class="card-body">



              <div class="form-group row clearfix">

                <label class="col-sm-2 control-label">Site Title</label>

                <div class="col-sm-10">

                  <input type="text" class="form-control" name="site_title" id="site_title" placeholder="Enter ..." value="{{ config('site.title') }}" required>

                </div>

              </div>



              <!-- <div class="form-group row clearfix">

                <label class="col-sm-2 control-label">Site URL</label>

                <div class="col-sm-10">

                  <input type="text" class="form-control url" name="site_url" id="site_url" placeholder="Enter ..." value="{!!config('site.url')!!}">

                </div>

              </div> -->



              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Logo </label>
                <div class="col-sm-10">
                  <input type="file" name="site_logo" class="form-control1">
                  <br><small>Mime Type: webp, Max image upload size 2 Mb</small>
                  <div class="clearfix">
                    <?php
                    if(config('site.logo') && File::exists(public_path('uploads/'.config('site.logo'))) )
                    {
                      ?>
                      <img src="{{ asset('/uploads/'.config('site.logo')) }}" style="margin: 10px 0 0 0; max-width: 200px;background: #033355;padding: 10px;border-radius: 10px;">
                      <?php
                    }
                    ?>
                  </div>
                </div>
              </div> 

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Mobile Logo </label>
                <div class="col-sm-10">
                  <input type="file" name="site_mobilelogo" class="form-control1">
                  <br><small>Mime Type: webp, Max image upload size 2 Mb</small>
                  <div class="clearfix">
                    <?php
                    if(config('site.mobilelogo') && File::exists(public_path('uploads/'.config('site.mobilelogo'))) )
                    {
                      ?>
                      <img src="{{ asset('/uploads/'.config('site.mobilelogo')) }}" style="margin: 10px 0 0 0; max-width: 200px;background: #033355;padding: 10px;border-radius: 10px;">
                      <?php
                    }
                    ?>
                  </div>
                </div>
              </div> 


              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Footer Logo </label>
                <div class="col-sm-10">
                  <input type="file" name="site_footer_logo">
                  <br><small>Mime Type: webp, Max image upload size 2 Mb</small>
                  <div class="clearfix">
                    <?php
                    if(config('site.footer_logo') && File::exists(public_path('uploads/'.config('site.footer_logo'))) )
                    {
                      ?>
                      <img src="{{ asset('/uploads/'.config('site.footer_logo')) }}" style="margin: 10px 0 0 0; max-width: 200px;background: #033355;padding: 10px;border-radius: 10px;">
                      <?php
                    }
                    ?>
                  </div>
                </div>
              </div><!--  -->



              <div class="form-group row clearfix">

                <label class="col-sm-2 control-label">Favicon </label>

                <div class="col-sm-10">

                  <input type="file" name="site_favicon"><br>

                  <small>Mime Type: webp, Max image upload size 2 Mb</small>



                  <div class="clearfix">

                    <?php

                    if(config('site.favicon') && File::exists(public_path('uploads/'.config('site.favicon'))) )

                    {

                      ?>

                      <img src="{{ asset('/uploads/'.config('site.favicon')) }}" style="margin: 10px 0 0 0;">

                      <?php

                    }

                    ?>

                  </div>

                </div>

              </div>



              {{-- <div class="form-group row clearfix">

                <label class="col-sm-2 control-label">Contact Email</label>

                <div class="col-sm-10">

                <input type="text" class="form-control required" name="site_contact_email" id="site_contact_email" placeholder="Enter ..." value="{{ config('site.contact_email') }}">

                </div>

              </div> --}}



              {{-- <div class="form-group row clearfix">

                <label class="col-sm-2 control-label">Support Email</label>

                <div class="col-sm-10">

                  <input type="text" class="form-control required email" name="site_support_email" id="site_support_email" placeholder="Enter ..." value="{{ config('site.support_email') }}">

                </div>

              </div> --}}



              {{-- <div class="form-group row clearfix">

                <label class="col-sm-2 control-label">Site Email</label>

                <div class="col-sm-10">

                  <input type="text" class="form-control required email" name="site_email" id="site_email" placeholder="Enter ..." value="{{ config('site.email') }}">

                </div>

              </div> --}}

              <div class="form-group row clearfix">

                <label class="col-sm-2 control-label">Book Appoinment</label>

                <div class="col-sm-10">

                  <input type="text" class="form-control" name="site_book_appointment" id="site_book_appointment" placeholder="Enter ..." value="{{ config('site.book_appointment') }}">

                </div>

              </div>



              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Site Phone</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control required" name="site_phone" id="site_phone" placeholder="Enter ..." value="{{ config('site.phone') }}">
                </div>
                <label class="col-sm-2 control-label">Site WhatsApp</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="site_whatsapp" id="site_whatsapp" placeholder="Enter ..." value="{{ config('site.whatsapp') }}">
                </div>
              </div>



              {{-- <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Site Address</label>
                <div class="col-sm-10">
                <textarea class="form-control" name="site_address" placeholder="Enter ...">{{ config('site.address') }}</textarea>
                </div>
              </div> --}}



              <div class="form-group row clearfix">

                <label class="col-sm-2 control-label">Admin Pagination</label>

                <div class="col-sm-10">

                <input type="text" class="form-control required" name="admin_pagination" id="admin_pagination" placeholder="Enter ..." value="{{ config('admin.pagination') }}" data-rule-digits="true">

                </div>

              </div>



              {{-- <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Site Pagination</label>
                <div class="col-sm-10">
                <input type="text" class="form-control required" name="site_pagination" id="site_pagination" placeholder="Enter ..." value="{{ config('site.pagination') }}" data-rule-digits="true">
                </div>
              </div> --}}

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Resource Menu Links</label>
                <div class="col-sm-10 mt-1">
                </div>
                <label class="col-sm-2 mt-2 control-label">Title</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_header_resource_title1" value="{!!config('site.header_resource_title1')!!}">
                </div>
                <label class="col-sm-1 mt-2 control-label">Link</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_header_resource_link1" value="{!!config('site.header_resource_link1')!!}">
                </div>
                <label class="col-sm-2 mt-2 control-label">Title</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_header_resource_title2" value="{!!config('site.header_resource_title2')!!}">
                </div>
                <label class="col-sm-1 mt-2 control-label">Link</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_header_resource_link2" value="{!!config('site.header_resource_link2')!!}">
                </div>
                <label class="col-sm-2 mt-2 control-label">Title</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_header_resource_title3" value="{!!config('site.header_resource_title3')!!}">
                </div>
                <label class="col-sm-1 mt-2 control-label">Link</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_header_resource_link3" value="{!!config('site.header_resource_link3')!!}">
                </div>
                <label class="col-sm-2 mt-2 control-label">Title</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_header_resource_title4" value="{!!config('site.header_resource_title4')!!}">
                </div>
                <label class="col-sm-1 mt-2 control-label">Link</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_header_resource_link4" value="{!!config('site.header_resource_link4')!!}">
                </div>
                <label class="col-sm-2 mt-2 control-label">Title</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_header_resource_title5" value="{!!config('site.header_resource_title5')!!}">
                </div>
                <label class="col-sm-1 mt-2 control-label">Link</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_header_resource_link5" value="{!!config('site.header_resource_link5')!!}">
                </div>
                <label class="col-sm-2 mt-2 control-label">Title</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_header_resource_title6" value="{!!config('site.header_resource_title6')!!}">
                </div>
                <label class="col-sm-1 mt-2 control-label">Link</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_header_resource_link6" value="{!!config('site.header_resource_link6')!!}">
                </div>
                <label class="col-sm-2 mt-2 control-label">Title</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_header_resource_title7" value="{!!config('site.header_resource_title7')!!}">
                </div>
                <label class="col-sm-1 mt-2 control-label">Link</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_header_resource_link7" value="{!!config('site.header_resource_link7')!!}">
                </div>
                <label class="col-sm-2 mt-2 control-label">Title</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_header_resource_title8" value="{!!config('site.header_resource_title8')!!}">
                </div>
                <label class="col-sm-1 mt-2 control-label">Link</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_header_resource_link8" value="{!!config('site.header_resource_link8')!!}">
                </div>
              </div>
              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Countries Links</label>
                <div class="col-sm-10 mt-1">
                </div>
                <label class="col-sm-2 mt-2 control-label">Title</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_country_title1" value="{!!config('site.country_title1')!!}">
                </div>
                <label class="col-sm-1 mt-2 control-label">Link</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_country_link1" value="{!!config('site.country_link1')!!}">
                </div>
                <label class="col-sm-2 mt-2 control-label">Title</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_country_title2" value="{!!config('site.country_title2')!!}">
                </div>
                <label class="col-sm-1 mt-2 control-label">Link</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_country_link2" value="{!!config('site.country_link2')!!}">
                </div>
                <label class="col-sm-2 mt-2 control-label">Title</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_country_title3" value="{!!config('site.country_title3')!!}">
                </div>
                <label class="col-sm-1 mt-2 control-label">Link</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_country_link3" value="{!!config('site.country_link3')!!}">
                </div>
                <label class="col-sm-2 mt-2 control-label">Title</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_country_title4" value="{!!config('site.country_title4')!!}">
                </div>
                <label class="col-sm-1 mt-2 control-label">Link</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_country_link4" value="{!!config('site.country_link4')!!}">
                </div>
                <label class="col-sm-2 mt-2 control-label">Title</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_country_title5" value="{!!config('site.country_title5')!!}">
                </div>
                <label class="col-sm-1 mt-2 control-label">Link</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_country_link5" value="{!!config('site.country_link5')!!}">
                </div>
                <label class="col-sm-2 mt-2 control-label">Title</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_country_title6" value="{!!config('site.country_title6')!!}">
                </div>
                <label class="col-sm-1 mt-2 control-label">Link</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_country_link6" value="{!!config('site.country_link6')!!}">
                </div>
                <label class="col-sm-2 mt-2 control-label">Title</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_country_title7" value="{!!config('site.country_title7')!!}">
                </div>
                <label class="col-sm-1 mt-2 control-label">Link</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_country_link7" value="{!!config('site.country_link7')!!}">
                </div>
                <label class="col-sm-2 mt-2 control-label">Title</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_country_title8" value="{!!config('site.country_title8')!!}">
                </div>
                <label class="col-sm-1 mt-2 control-label">Link</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_country_link8" value="{!!config('site.country_link8')!!}">
                </div>
                <label class="col-sm-2 mt-2 control-label">Title</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_country_title9" value="{!!config('site.country_title9')!!}">
                </div>
                <label class="col-sm-1 mt-2 control-label">Link</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_country_link9" value="{!!config('site.country_link9')!!}">
                </div>
                <label class="col-sm-2 mt-2 control-label">Title</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_country_title10" value="{!!config('site.country_title10')!!}">
                </div>
                <label class="col-sm-1 mt-2 control-label">Link</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_country_link10" value="{!!config('site.country_link10')!!}">
                </div>
              </div>

              <!-- <div class="form-group row clearfix">

                <label class="col-sm-2 control-label">Meta Title</label>

                <div class="col-sm-10">

                <input type="text" class="form-control" name="site_meta_title" placeholder="Enter ..." value="{{ config('site.meta_title') }}">

                </div>

              </div> -->


<!-- 
              <div class="form-group row clearfix">

                <label class="col-sm-2 control-label">Meta Keyword</label>

                <div class="col-sm-10">

                <textarea class="form-control" name="site_meta_keyword" placeholder="Enter ...">{{ config('site.meta_keyword') }}</textarea>

                </div>

              </div> -->



              <!-- <div class="form-group row clearfix">

                <label class="col-sm-2 control-label">Meta Description</label>

                <div class="col-sm-10">

                <textarea class="form-control" name="site_meta_description" placeholder="Enter ...">{{ config('site.meta_description') }}</textarea>

                </div>

              </div> -->

              <!-- <div class="form-group row clearfix">

                <label class="col-sm-2 control-label">Meta Tag</label>

                <div class="col-sm-10">

                <textarea class="form-control" name="site_meta_tag" placeholder="Enter ...">{{ config('site.meta_tag') }}</textarea>

                </div>

              </div> -->

              <!-- <div class="form-group row clearfix">

                <label class="col-sm-2 control-label">Meta Image </label>

                <div class="col-sm-10">

                <input type="file" name="site_meta_image">

                <br><small>Mime Type: webp, Max image upload size 2 Mb</small>



                <div class="clearfix">

                  <?php

                  if(config('site.meta_image') && File::exists(public_path('uploads/'.config('site.meta_image'))) )

                  {

                    ?>

                    <img src="{{ asset('/uploads/'.config('site.meta_image')) }}" style="margin: 10px 0 0 0;width: 50%;">

                    <a href="{{ url('/settings/delete/site_meta_image') }}"><i class="fa fa-fw fa-close"></i></a>

                    <?php

                  }

                  ?>

                </div>

                </div>

              </div> -->



              <!-- <div class="form-group row clearfix">

                <label class="col-sm-2 control-label">Header Code</label>

                <div class="col-sm-10">

                <textarea class="form-control" name="site_google_analytics" placeholder="Enter ...">{{ config('site.google_analytics') }}</textarea>

                </div>

              </div> -->


             



              <!-- <div class="form-group row clearfix">

                <label class="col-sm-2 control-label">Copyright</label>

                <div class="col-sm-10">

                  <input type="text" class="form-control" name="site_copyright" id="site_copyright" placeholder="Enter ..." value="{!!config('site.copyright')!!}">

                  <small>{#Year#} => Current Year</small>

                </div>

              </div> -->



              </div>

              <!-- /.card-body -->



              <div class="card-footer">

                <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>

              </div>

            </form>
            <form type="form" action="{{ url(Admin_Prefix.'sitemap_view') }}"  method="post" enctype="multipart/form-data">
                @csrf
                <div class="card-footer">
                    
                    <button type="submit" class="btn btn-success">Generate sitemap XML</button>
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

<script>

  </script>
@endsection



