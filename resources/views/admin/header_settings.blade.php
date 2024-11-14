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

          <form type="form" action="{{ url(Admin_Prefix.'header-settings') }}"  method="post" enctype="multipart/form-data" class="customValidate">
            @csrf
            <div class="card-body">

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Meta Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_meta_title" placeholder="Enter ..." value="{{ config('site.meta_title') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Meta Keyword</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="site_meta_keyword" placeholder="Enter ...">{{ config('site.meta_keyword') }}</textarea>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Meta Description</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="site_meta_description" placeholder="Enter ...">{{ config('site.meta_description') }}</textarea>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Meta Tag</label>
                <div class="col-sm-10">
                <textarea class="form-control" name="site_meta_tag" placeholder="Enter ...">{{ config('site.meta_tag') }}</textarea>
                </div>
              </div>

              
              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Header Code</label>
                <div class="col-sm-10">
                <textarea class="form-control" name="site_google_analytics" placeholder="Enter ...">{{ config('site.google_analytics') }}</textarea>
                </div>
              </div>
              
              {{-- <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Language Meta tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_language_meta_tag" placeholder="Enter ..." value="{{ config('site.language_meta_tag') }}">
                </div>
              </div> --}}

              {{-- <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Charset Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_charset_tag" placeholder="Enter ..." value="{{ config('site.charset_tag') }}">
                </div>
              </div> --}}

              {{-- <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">View Port Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_view_port_tag" placeholder="Enter ..." value="{{ config('site.view_port_tag') }}">
                </div>
              </div> --}}

              {{-- <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Index Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_index_tag" placeholder="Enter ..." value="{{ config('site.index_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Author Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_author_tag" placeholder="Enter ..." value="{{ config('site.author_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Copyright Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_copyright_tag" placeholder="Enter ..." value="{{ config('site.copyright_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Revisit After Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_revisit_after_tag" placeholder="Enter ..." value="{{ config('site.revisit_after_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Rating Tag (for content maturity level)</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_rating_tag" placeholder="Enter ..." value="{{ config('site.rating_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Canonical Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_canonical_tag" placeholder="Enter ..." value="{{ config('site.site_canonical_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Open Graph Title Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_open_graph_title_tag" placeholder="Enter ..." value="{{ config('site.open_graph_title_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Open Graph Description Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_open_graph_description_tag" placeholder="Enter ..." value="{{ config('site.open_graph_description_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Open Graph Image Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_open_graph_image" placeholder="Enter ..." value="{{ config('site.open_graph_description_tag') }}">
                </div>
              </div> 

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Open Graph Url Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_open_graph_url_tag" placeholder="Enter ..." value="{{ config('site.open_graph_url_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Open Graph Type Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_open_graph_type_tag" placeholder="Enter ..." value="{{ config('site.open_graph_type_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Open Graph Site Name Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_open_graph_site_name_tag" placeholder="Enter ..." value="{{ config('site.open_graph_site_name_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Twitter Card Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_twitter_card_tag" placeholder="Enter ..." value="{{ config('site.twitter_card_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Twitter Site Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_twitter_site_tag" placeholder="Enter ..." value="{{ config('site.twitter_site_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Twitter Title Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_twitter_title_tag" placeholder="Enter ..." value="{{ config('site.twitter_title_tag') }}">
                </div>
              </div>
              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Twitter Description Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_twitter_description_tag" placeholder="Enter ..." value="{{ config('site.twitter_description_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Twitter Image </label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_twitter_image" placeholder="Enter ..." value="{{ config('site.open_graph_description_tag') }}">
                </div>
              </div> 

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Geo Graphic Region Tag (for Location Specific Pages)</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_geo_graphic_region_tag" placeholder="Enter ..." value="{{ config('site.geo_graphic_region_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Geo Graphic Position Tag (for Location Specific Pages)</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_geo_graphic_position_tag" placeholder="Enter ..." value="{{ config('site.geo_graphic_position_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Geo Graphic Placename Tag (for Location Specific Pages)</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_geo_graphic_placename_tag" placeholder="Enter ..." value="{{ config('site.geo_graphic_placename_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Facebook Title Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_facebook_title_tag" placeholder="Enter ..." value="{{ config('site.facebook_title_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Facebook Description Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_facebook_description_tag" placeholder="Enter ..." value="{{ config('site.facebook_description_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Facebook Image </label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_facebook_image" placeholder="Enter ..." value="{{ config('site.open_graph_description_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Facebook Url Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_facebook_url_tag" placeholder="Enter ..." value="{{ config('site.facebook_url_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Facebook Type Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_facebook_type_tag" placeholder="Enter ..." value="{{ config('site.facebook_type_tag') }}">
                </div>
              </div> --}}

              {{-- <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Twitter Card Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_twitter_card_tag" placeholder="Enter ..." value="{{ config('site.twitter_card_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Twitter Site Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_twitter_site_tag" placeholder="Enter ..." value="{{ config('site.twitter_site_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Twitter Title Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_twitter_title_tag" placeholder="Enter ..." value="{{ config('site.twitter_title_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Twitter Description Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_twitter_description_tag" placeholder="Enter ..." value="{{ config('site.twitter_description_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Twitter Image Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_twitter_image" placeholder="Enter ..." value="{{ config('site.open_graph_description_tag') }}">
                </div>
              </div> --}}

              {{-- <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">LinkedIn Title Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_linkedIn_title_tag" placeholder="Enter ..." value="{{ config('site.linkedIn_title_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">LinkedIn Description Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_linkedIn_description_tag" placeholder="Enter ..." value="{{ config('site.linkedIn_description_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">LinkedIn Image Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_linkedIn_image" placeholder="Enter ..." value="{{ config('site.open_graph_description_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">LinkedIn Url Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_linkedIn_url_tag" placeholder="Enter ..." value="{{ config('site.linkedIn_url_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">LinkedIn Type Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_linkedIn_type_tag" placeholder="Enter ..." value="{{ config('site.linkedIn_type_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Instagram Title Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_instagram_title_tag" placeholder="Enter ..." value="{{ config('site.instagram_title_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Instagram Description Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_instagram_description_tag" placeholder="Enter ..." value="{{ config('site.instagram_description_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Instagram Image Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_instagram_image" placeholder="Enter ..." value="{{ config('site.open_graph_description_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Instagram Url Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_instagram_url_tag" placeholder="Enter ..." value="{{ config('site.instagram_url_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Instagram Type Tag</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_instagram_type_tag" placeholder="Enter ..." value="{{ config('site.instagram_type_tag') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Site Verification Tag - 1</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_verification_tag_1" placeholder="Enter ..." value="{{ config('site.verification_tag_1') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Site Verification Tag - 2</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_verification_tag_2" placeholder="Enter ..." value="{{ config('site.verification_tag_2') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Site Verification Tag - 3</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_verification_tag_3" placeholder="Enter ..." value="{{ config('site.verification_tag_3') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Site Verification Tag - 4</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_verification_tag_4" placeholder="Enter ..." value="{{ config('site.verification_tag_4') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Custom Code in Head section - 1</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_custom_code_in_head_section_1" placeholder="Enter ..." value="{{ config('site.custom_code_in_head_section_1') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Custom Code in Head section - 2</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_custom_code_in_head_section_2" placeholder="Enter ..." value="{{ config('site.custom_code_in_head_section_2') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Custom Code in Head section - 3</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_custom_code_in_head_section_3" placeholder="Enter ..." value="{{ config('site.custom_code_in_head_section_3') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Custom Code in Head section - 4</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="site_custom_code_in_head_section_4" placeholder="Enter ..." value="{{ config('site.custom_code_in_head_section_4') }}">
                </div>
              </div> --}}

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Nav Menu Links</label>
                <div class="col-sm-10 mt-1">
                </div>
                <label class="col-sm-2 mt-2 control-label">Title</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_header_nav_title1" value="{!!config('site.header_nav_title1')!!}">
                </div>
                <label class="col-sm-1 mt-2 control-label">Link</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_header_nav_link1" value="{!!config('site.header_nav_link1')!!}">
                </div>
                <label class="col-sm-2 mt-2 control-label">Title</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_header_nav_title2" value="{!!config('site.header_nav_title2')!!}">
                </div>
                <label class="col-sm-1 mt-2 control-label">Link</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_header_nav_link2" value="{!!config('site.header_nav_link2')!!}">
                </div>
                <label class="col-sm-2 mt-2 control-label">Title</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_header_nav_title3" value="{!!config('site.header_nav_title3')!!}">
                </div>
                <label class="col-sm-1 mt-2 control-label">Link</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_header_nav_link3" value="{!!config('site.header_nav_link3')!!}">
                </div>
                <label class="col-sm-2 mt-2 control-label">Title</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_header_nav_title4" value="{!!config('site.header_nav_title4')!!}">
                </div>
                <label class="col-sm-1 mt-2 control-label">Link</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_header_nav_link4" value="{!!config('site.header_nav_link4')!!}">
                </div>
                <label class="col-sm-2 mt-2 control-label">Title</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_header_nav_title5" value="{!!config('site.header_nav_title5')!!}">
                </div>
                <label class="col-sm-1 mt-2 control-label">Link</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_header_nav_link5" value="{!!config('site.header_nav_link5')!!}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Button</label>
                <div class="col-sm-10 mt-1">
                </div>
                <label class="col-sm-2 mt-2 control-label">Title</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_header_nav_button_title1" value="{!!config('site.header_nav_button_title1')!!}">
                </div>
                <label class="col-sm-1 mt-2 control-label">Link</label>
                <div class="col-sm-4 mt-1">
                  <input type="text" class="form-control" name="site_header_nav_button_link1" value="{!!config('site.header_nav_button_link1')!!}">
                </div>
              </div>

            </div>
              <!-- /.card-body -->
              <div class="card-footer">
                <button type="submit" class="btn btn-primary" name="submit" value="Submit">Submit</button>
              </div>

            </form>
            <div class="card-footer">
                <button class="btn btn-success" id="generateXML">Generate sitemap XML</button>
            </div>

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



