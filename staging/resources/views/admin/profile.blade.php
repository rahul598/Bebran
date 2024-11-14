@extends('layouts.admin')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{ __('Profile') }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Profile') }}</li>
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
            <h3 class="card-title">Update Profile</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" action="{{ url(Admin_Prefix.'profile/') }}"  method="post" enctype="multipart/form-data" class="customValidate">

            @csrf

            <input type="hidden" name="id" value="{{$list->id}}">

            <div class="card-body">

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">First Name</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="fname" placeholder="Enter first name..." value="{{$list->fname}}" required>
                </div>
                <label class="col-sm-2 control-label">Last Name</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="lname" id="lname" placeholder="Enter last name..." value="{{$list->lname}}">
                </div> 
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control email" name="email" id="email" placeholder="Enter ..." value="{{$list->email}}" required readonly>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Avatar </label>
                <div class="col-sm-10">
                <input type="file" name="avatar"><br><small>Mime Type: webp, Max image upload size 2 Mb</small>
                  <div class="clearfix">
                    <?php
                    if($list->avatar && File::exists(public_path('uploads/'.$list->avatar)) )
                      {
                        ?>
                        <img src="{{ asset('/uploads/'.$list->avatar) }}" style="margin: 10px 0 0 0;max-width: 200px;">
                        <?php
                      }
                      ?>
                    </div>
                </div>
              </div>

                <div class="form-group row clearfix">
                  <label class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-4">
                    <input type="password" class="form-control" placeholder="Enter ..." name="password" id="password" autocomplete="off"/>
                  </div>
                  <label class="col-sm-2 control-label">Retype Password</label>
                  <div class="col-sm-4">
                    <input type="password" class="form-control" placeholder="Enter ..." name="password_confirmation" id="password_confirmation"  data-rule-equalTo="#password" autocomplete="off"/>
                  </div>
                </div> 

              <!-- <div class="form-group clearfix">
                <label class="control-label">Phone Number</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="Enter ..." name="phone_number" id="phone_number" value="{{$list->phone_number}}" data-validation-engine="validate[required,custom[integer],minSize[10]]" />
                </div>
              </div> -->

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
