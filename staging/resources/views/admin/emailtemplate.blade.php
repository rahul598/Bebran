@extends('layouts.admin')

@section('content')
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{ __('Email Template') }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Email Template') }}</li>
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
            <h3 class="card-title">Update</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form type="form" action="{{ url(Admin_Prefix.'emailtemplate') }}"  method="post" enctype="multipart/form-data" class="formvalidation">

            @csrf

            <div class="card-body">


                <div class="form-group row clearfix">
                  <label class="col-sm-2 control-label">Regsitration Email</label>
                  <div class="col-sm-10">
                    <textarea class="form-control summernote" name="registration_email" id="registration_email" data-validation-engine="validate[required]" placeholder="Enter ...">{{$emailtemplate->registration_email}}</textarea>
                    <small>{#Fullname#} => User Full name, {#Email#} => Email, {#Firstname#} => User First name, {#Password#} => New Password, {#Loginurl#} => Login URL, {#Sitename#} => Site Title</small>
                  </div>
                </div>

                <div class="form-group row clearfix">
                  <label class="col-sm-2 control-label">Forgot Password Email</label>
                  <div class="col-sm-10">
                    <textarea class="form-control summernote" name="forgotpass_email" id="forgotpass_email" data-validation-engine="validate[required]" placeholder="Enter ...">{{$emailtemplate->forgotpass_email}}</textarea>
                    <small>{#ResetPasswordLink#} => Reset Password Link, {#Fullname#} => User Full name, {#Sitename#} => Site Title</small>
                  </div>
                </div> 

                <div class="form-group row clearfix">
                  <label class="col-sm-2 control-label">Password Change Email</label>
                  <div class="col-sm-10">
                    <textarea class="form-control summernote" name="password_change_email" id="password_change_email" data-validation-engine="validate[required]" placeholder="Enter ...">{{$emailtemplate->password_change_email}}</textarea>
                    <small>{#Password#} => New Password, {#Fullname#} => User Full name, {#Firstname#} => User First name, {#Sitename#} => Site Title</small>
                  </div>
                </div>

                <div class="form-group row clearfix">
                  <label class="col-sm-2 control-label">Verify Email</label>
                  <div class="col-sm-10">
                    <textarea class="form-control summernote" name="verify_email" id="verify_email" data-validation-engine="validate[required]" placeholder="Enter ...">{{$emailtemplate->verify_email}}</textarea>
                    <small>{#Fullname#} => User Full name, {#Firstname#} => User First name, {#Sitename#} => Site Title</small>
                  </div>
                </div>

                <!-- <div class="form-group row clearfix">
                  <label class="col-sm-2 control-label">Job Proposal Alert</label>
                  <div class="col-sm-10">
                    <textarea class="form-control summernote" name="job_proposal_alert" id="job_proposal_alert" data-validation-engine="validate[required]" placeholder="Enter ...">{{$emailtemplate->job_proposal_alert}}</textarea>
                    <small>{#JobTitle#} => Job Title, {#JobNumber#} => Job Number, {#Fullname#} => Customer Full name, {#WorkerFullname#} => Worker Full name, {#Sitename#} => Site Title</small>
                  </div>
                </div> -->

                <!-- <div class="form-group row clearfix">
                  <label class="col-sm-2 control-label">Order Email</label>
                  <div class="col-sm-10">
                    <textarea class="form-control summernote" name="order_email" id="order_email" data-validation-engine="validate[required]" placeholder="Enter ...">{{$emailtemplate->order_email}}</textarea>
                    <small>{#Fullname#} => User Full name, {#Firstname#} => User First name, {#Email#} => Email, {#OrderID#} => Order ID, {#MyOrderurl#} => My Order URL, {#Loginurl#} => Login URL, {#Sitename#} => Site Title</small>
                  </div>
                </div> -->

                <!-- <div class="form-group row clearfix">
                  <label class="col-sm-2 control-label">Order Email To Admin</label>
                  <div class="col-sm-10">
                    <textarea class="form-control summernote" name="order_email_to_admin" id="order_email_to_admin" data-validation-engine="validate[required]" placeholder="Enter ...">{{$emailtemplate->order_email_to_admin}}</textarea>
                    <small>{#Fullname#} => User Full name, {#Firstname#} => User First name, {#Email#} => Email, {#OrderID#} => Order ID, {#MyOrderurl#} => My Order URL, {#Loginurl#} => Login URL, {#Sitename#} => Site Title</small>
                  </div>
                </div> -->

                <!-- <div class="form-group row clearfix">
                  <label class="col-sm-2 control-label">Order Cancel Email</label>
                  <div class="col-sm-10">
                    <textarea class="form-control summernote" name="order_cancel_email" id="order_cancel_email" data-validation-engine="validate[required]" placeholder="Enter ...">{{$emailtemplate->order_cancel_email}}</textarea>
                    <small>{#Fullname#} => User Full name, {#Firstname#} => User First name, {#Email#} => Email, {#OrderID#} => Order ID, {#MyOrderurl#} => My Order URL, {#Loginurl#} => Login URL, {#Sitename#} => Site Title</small>
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