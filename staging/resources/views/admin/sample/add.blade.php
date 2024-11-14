@extends('layouts.admin')
@section('content')
  <!-- Content Header (Blog header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{ __('Add Sample') }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Add Sample') }}</li>
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
          <form role="form" action="{{ url(Admin_Prefix.'sample/add/') }}"  method="post" enctype="multipart/form-data" class="customValidate">
            @csrf
            <div class="card-body">
              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Category</label>
                <div class="col-sm-10">
                  <select name="category_id" class="form-control select2" data-placeholder="Select">
                    <option value="">Select Category</option>
                    @foreach($sample_categories as $key => $value)
                    <option value="{!! $value->id !!}" @if($value->id == old('category_id')) selected @endif>{!! $value->name !!}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control module_name" name="title" id="title" placeholder="Enter ..." value="{{ old('title') }}" required>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Content</label>
                <div class="col-sm-10">
                  <textarea name="body" class="ckeditor" placeholder="Enter ...">{{ old('body') }}</textarea>
                </div>
              </div>

              <div class="form-group row clearfix bannerimage">
                <label class="col-sm-2 control-label">Image</label>
                <div class="col-sm-10">
                  <input type="file" name="image" data-validation-engine="validate[,custom[validateMIME[image/webp]]]">
                  Mime Type: webp, Max image upload size 2 Mb<br>
                </div>
                <label class="col-sm-2 control-label">Image 2</label>
                <div class="col-sm-10">
                  <input type="file" name="image2" data-validation-engine="validate[,custom[validateMIME[image/webp]]]">
                  Mime Type: webp, Max image upload size 2 Mb<br>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Button Text</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="btn_text" id="btn_text" required placeholder="Enter ..." value="{{ old('btn_text') }}">
                </div>
              </div>
                <div class="form-group row clearfix">
                  <label class="col-sm-2 control-label">Button url</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="btn_url" id="btn_url" required placeholder="Enter ..." value="{{ old('btn_url') }}">
                  </div>
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



