@extends('layouts.admin')

@section('content')
  <!-- Content Header (Category header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{ __('Edit Category') }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Edit Category') }}</li>
          </ol>
        </div>
      </div>
    </div>
  </div>

<style type="text/css">
  .card-title{font-weight: 600;}
  .control-label{font-weight: 400 !important;}
</style>
  
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row"> 
      <div class="col-md-12">

        <div class="card card-primary">
          <div class="card-header with-border">
            <h3 class="card-title">Update</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" action="{{ url(Admin_Prefix.'category/update/') }}"  method="post" enctype="multipart/form-data" class="customValidate">

            @csrf

            <input type="hidden" name="id" value="{{$list->id}}">

            <div class="card-body">

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control module_name" name="name" placeholder="Enter ..." value="{{ $list->name }}" required>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Slug</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control module_slug" name="slug" id="slug" placeholder="Enter ..." value="{{ $list->slug }}" required>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Image</label>
                <div class="col-sm-10">
                  <input type="file" name="image" data-validation-engine="validate[,custom[validateMIME[image/jpeg|image/jpg|image/png|image/gif|image/svg]]]" >
                  Mime Type: jpeg,png,jpg,gif,svg, Max image upload size 2 Mb<br>
                  <div class="clearfix">
                    <?php if($list->image && File::exists(public_path('uploads/'.$list->image)) ) { ?>
                      <img src="{{ asset('/uploads/'.$list->image) }}" style="margin: 10px 0 0 0;max-width: 200px;"> <a href="{{url(Admin_Prefix.'category/file-destroy/'.$list->id)}}"><i class="fa fa-fw fa-close"></i></a>
                    <?php } ?>
                  </div>

                </div>
              </div> 

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Order</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="rank" id="rank" placeholder="Enter ..." value="{{ $list->rank }}" data-rule-digits="true" required>
                </div>
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-4">
                  <select name="status" id="status" class="form-control">
                    <option value="1" {!!$list->status=='1'?'selected':''!!}>Active</option>
                    <option value="0" {!!$list->status=='0'?'selected':''!!}>Inactive</option>
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
