@extends('layouts.admin')

@section('content')
@php
if(old('rank')>0)
{
  $rank = old('rank');
}else{
  $header_menu = get_fields_value_where('news_category',"id>0",'rank','desc');
  $rank = count($header_menu)?$header_menu[0]->rank+1:1;
}
@endphp
  <!-- Content Header (Category header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{ __('Add News Category') }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Add News Category') }}</li>
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
          <form role="form" action="{{ url(Admin_Prefix.'newsCategory/add/') }}"  method="post" enctype="multipart/form-data" class="customValidate">

            @csrf

            <div class="card-body">

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control module_name" name="name" placeholder="Enter ..." value="{{ Request::old('name') }}" required>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Slug</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control module_slug" name="slug" id="slug" placeholder="Enter ..." value="{{ old('slug') }}" required>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Image</label>
                <div class="col-sm-10">
                  <input type="file" name="image" data-validation-engine="validate[,custom[validateMIME[image/jpeg|image/jpg|image/png|image/gif|image/svg]]]" >
                  Mime Type: jpeg,png,jpg,gif,svg, Max image upload size 2 Mb<br>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Order</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="rank" id="rank" placeholder="Enter ..." value="{{ $rank }}" data-rule-digits="true" required>
                </div>
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-4">
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

<!-- /.content-wrapper -->

@endsection
