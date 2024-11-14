@extends('layouts.admin')
@section('content')
  <!-- Content Header (Blog header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{ __('Add Media library') }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Add Media library') }}</li>
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
          <form role="form" action="{{ url(Admin_Prefix.'media-library-images/add/') }}"  method="post" enctype="multipart/form-data" class="customValidate">
            @csrf
            <div class="card-body">

                <div class="form-group row clearfix bannerimage">
                  <label class="col-sm-2 control-label">Media Library Image</label>
                  <div class="col-sm-10">
                      <input type="file" name="image" data-validation-engine="validate[,custom[validateMIME[image/webp]]]" > 
                      Mime Type: webp, Max image upload size 2 Mb<br>
                  </div>
                </div>
                <div class="form-group row clearfix bannerimage">
                  <label class="col-sm-2 control-label">Media Library Icon Image</label>
                  <div class="col-sm-10">
                      <input type="file" name="icon_image" data-validation-engine="validate[,custom[validateMIME[image/webp]]]" > 
                      Mime Type: webp, Max image upload size 2 Mb<br>
                  </div>
                </div>
                <div class="form-group row clearfix bannerimage">    
                  <label class="col-sm-2 control-label">Media Library PDF</label>
                  <div class="col-sm-10">
                      <input type="file" name="pdf" data-validation-engine="validate[,custom[validateMIME[image/pdf]]]" > 
                      Mime Type: pdf, Max pdf upload size 2 Mb<br>
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



