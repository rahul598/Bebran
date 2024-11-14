@extends('layouts.admin')

@section('content')
@php
$page_display_in_array = unserialize(Page_Display_In_Array);
$page_template_array = unserialize(Page_Template_Array);
$display_in=0;
if(old('menu_order')>0)
{
  $menu_order = old('menu_order');
}else{
  $header_menu = get_fields_value_where('pages',"id>0",'menu_order','desc');
  $menu_order = count($header_menu)?$header_menu[0]->menu_order+1:1;
}

$page_section_array = unserialize(Page_Section_Array);

$category_id = old('category_id')?old('category_id'):[];
@endphp
  <!-- Content Header (News header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{ __('Add News') }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Add News') }}</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

  
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row"> 
      <div class="col-md-12">

        <div class="card card-primary">
          <div class="card-header with-border">
            <h3 class="card-title">Add</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" action="{{ url(Admin_Prefix.'page/add/') }}"  method="post" enctype="multipart/form-data" class="customValidate">

            @csrf

            <input type="hidden" name="id" value="0">
            <input type="hidden" name="posttype" value="news">
            <input type="hidden" name="page_template" value="20">

            <div class="card-body">

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control module_name" name="page_name" id="page_name" placeholder="Enter ..." value="{{ old('page_name') }}" required>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Slug</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control module_slug" name="slug" id="slug" placeholder="Enter ..." value="{{ old('slug') }}" required>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Category</label>
                <div class="col-sm-10">
                  <select name="category_id" class="form-control select" data-placeholder="Select" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $key => $value)
                    <option value="{!! $value->id !!}" @if(in_array($value->id,$category_id)) selected @endif>{!! $value->name !!}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Redirected to</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="redirect_to" id="redirect_to">
                </div>
              </div>
              
              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Meta Tag</label>
                <div class="col-sm-10">
                  <textarea type="text" class="form-control" name="meta_tag" placeholder="Enter ..."></textarea>
                </div>
              </div>
              
              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Meta Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="Enter ..." value="{{ old('meta_title') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Meta Keyword</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="meta_keyword" placeholder="Enter ...">{{ old('meta_keyword') }}</textarea>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Meta Description</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="meta_description" placeholder="Enter ...">{{ old('meta_description') }}</textarea>
                </div>
              </div>

              <!-- <div class="form-group row clearfix bannerimage">
                <label class="col-sm-2 control-label">Banner Image</label>
                <div class="col-sm-10">
                  <input type="file" name="bannerimage" data-validation-engine="validate[,custom[validateMIME[image/webp]]]">
                  Mime Type: webp, Max image upload size 2 Mb<br>
                </div>
              </div> -->

              <div class="form-group row clearfix bannerimage">
                <label class="col-sm-2 control-label">Feature Image</label>
                <div class="col-sm-4">
                  <input type="file" name="image2" data-validation-engine="validate[,custom[validateMIME[image/webp]]]">
                  Mime Type: webp, Max image upload size 2 Mb<br>
                </div>
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-4">
                  <select name="status" id="status" class="form-control">
                    <option value="1" {!!Request::old('status')=='1'?'selected':''!!}>Active</option>
                    <option value="0" {!!Request::old('status')=='0'?'selected':''!!}>Inactive</option>
                  </select>
                </div>
              </div>

                <div class="form-group row clearfix">
                  <label class="col-sm-2 control-label">Content</label>
                  <div class="col-sm-10">
                    <textarea name="body" class="ckeditor" placeholder="Enter ...">{{ old('body') }}</textarea>
                  </div>
                </div>

                <div class="form-group row clearfix">
                  <label class="col-sm-2 control-label">Author Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="author_name" id="author_name" placeholder="Enter ..." value="{{ old('author_name') }}">
                  </div>
                </div>
                <div class="form-group row clearfix">
                  <label class="col-sm-2 control-label">Author Designation</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="author_desg" id="author_desg" placeholder="Enter ..." value="{{ old('author_desg') }}">
                  </div>
                </div>
                <div class="form-group row clearfix">
                  <label class="col-sm-2 control-label">Author Image</label>
                  <div class="col-sm-10">
                    <input type="file" class="form-control" name="author_image" id="author_image" placeholder="Enter ..." value="{{ old('author_image') }}">
                  </div>
                </div>
                <div class="form-group row clearfix">
                  <label class="col-sm-2 control-label">Author url</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="author_url" id="author_url" placeholder="Enter ..." value="">
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


@endsection 



