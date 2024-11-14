@extends('layouts.admin')
@section('content')
@php
$package_section_array = unserialize(Package_Section_Array);
@endphp
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{ __('Add Package Plan') }}</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
          <li class="breadcrumb-item active">{{ __('Add Package Plan') }}</li>
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
          <form role="form" action="{{ url(Admin_Prefix.'package-plan/add/') }}"  method="post" enctype="multipart/form-data" class="customValidate">
            @csrf
            <input type="hidden" name="id" value="0">
            <input type="hidden" name="posttype" value="page">

            <div class="card-body">

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Page Name</label>
                <div class="col-sm-10">
                  <select class="form-control" name="page_id" id="page_id" required>
                    @foreach($all_pages as $pages)
                      <option value="{{ $pages->id }}" @if($pages->id == old('page_id')) selected @endif>{{ $pages->page_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Category</label>
                <div class="col-sm-10">
                  <select class="form-control" name="category_id" id="category_id" required>
                    @foreach($package_category as $category)
                      <option value="{{ $category->id }}" @if($category->id == old('category_id')) selected @endif>{{ $category->title }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="title" id="title" placeholder="Enter ..." value="{{ old('title') }}" required>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Sub Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="sub_title" id="sub_title" placeholder="Enter ..." value="{{ old('sub_title') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Price</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="price" id="price" placeholder="Enter ..." value="{{ old('price') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Discount Price</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="discount_price" id="discount_price" placeholder="Enter ..." value="{{ old('discount_price') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Discount Persentage</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="discount_percentage" id="discount_percentage" placeholder="Enter ..." value="{{ old('discount_percentage') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Content Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="content_title" id="content_title" placeholder="Enter ..." value="{{ old('content_title') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Content Title</label>
                <div class="col-sm-10">
                  <textarea class="form-control ckeditor" name="content" id="content" placeholder="Enter ...">{{ old('content') }}</textarea>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Rank</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="rank" id="rank" placeholder="Enter ..." value="{{ old('rank') }}" required>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Button Text</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="button_text" id="button_text" placeholder="Enter ..." value="{{ old('button_text') }}" required>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10">
                  <select name="status" id="status" class="form-control">
                    <option value="1" {!!Request::old('status')=='1'?'selected':''!!}>Active</option>
                    <option value="0" {!!Request::old('status')=='0'?'selected':''!!}>Inactive</option>
                  </select>
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

@section('more-scripts')
<script type="text/javascript">
$(document).ready(function() {
  var wrapper       = $(".add_section"); //Fields wrapper
  var add_button      = $(".add_section_btn"); //Add button ID

  $(add_button).click(function(e){ //on add input button click
    e.preventDefault();
    section_new_type = $(".section_new_type").val();
    var html = '';
    if (section_new_type>0) {
      html = $(".type"+section_new_type).html();
    }
    if (html) {
      $(wrapper).append(html); //add input box
    }
    
  });
  
  $(wrapper).on("click",".remove_field", function(e){ //Company click on remove text
    e.preventDefault(); 
    //$(this).parent('div').parent('div').parent('div').remove();
    $(this).parents('.sn').remove();
  })
});
</script>
@stop