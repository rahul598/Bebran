@extends('layouts.admin')
@section('content')
<!-- Content Header (Category header) -->
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Edit Country') }}</h1>
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
               <li class="breadcrumb-item active">{{ __('Edit Country') }}</li>
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
                  <h3 class="card-title">Edit</h3>
               </div>
               <!-- /.card-header -->
               <!-- form start -->
               <form role="form" method="post" enctype="multipart/form-data" class="customValidate">
                  @csrf
                  <div class="card-body">
                     <div class="form-group row clearfix">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                           <input type="text" class="form-control module_name" name="country_name" placeholder="Enter ..." value="{{ $countryData->name }}" required>
                           @if ($errors->has('country_name'))
                           <span class="text-danger">{{ $errors->first('country_name') }}</span>
                           @endif
                        </div>
                     </div>
                     <div class="form-group row clearfix">
                        <label class="col-sm-2 control-label">Country Url</label>
                        <div class="col-sm-10">
                           <input type="text" class="form-control module_name" name="country_url" placeholder="Enter ..." value="{{ $countryData->country_url }}">
                           @if ($errors->has('country_url'))
                           <span class="text-danger">{{ $errors->first('country_url') }}</span>
                           @endif
                        </div>
                     </div>
                  </div>
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
