@extends('layouts.admin')
@section('content')
<!-- Content Header (Category header) -->
<div class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1 class="m-0 text-dark">{{ __('Edit City') }}</h1>
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
               <li class="breadcrumb-item active">{{ __('Edit City') }}</li>
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
                  <h3 class="card-title">Edit</h3>
               </div>
               <!-- /.card-header -->
               <!-- form start -->
               <form role="form" method="post" enctype="multipart/form-data" class="customValidate">
                  @csrf
                  <div class="card-body">
                     {{-- <div class="form-group row clearfix">
                        <label class="col-sm-2 control-label">Select Country</label>
                        <div class="col-sm-4">
                           <select name="country_id" class="form-control" id="country_id">
                              <option value="">Select</option>
                              @foreach ($countries as $key => $val)
                                  <option value="{{ $val->id }}" {{ $countryData[0]->fk_country_id == $val->id ? 'selected' : '' }}>
                                      {{ $val->name }}
                                  </option>
                              @endforeach
                          </select>
                           @if ($errors->has('city_name'))
                           <span class="text-danger">{{ $errors->first('city_name') }}</span>
                           @endif
                        </div>
                     </div> --}}
                     <div class="form-group row clearfix">
                        <label class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-4">
                           <input type="text" class="form-control module_name" name="city_name" placeholder="Enter ..." value="{{ $countryData->city_name }}" required>
                           @if ($errors->has('city_name'))
                           <span class="text-danger">{{ $errors->first('city_name') }}</span>
                           @endif
                        </div>
                     </div>
                     <div class="form-group row clearfix">
                        <label class="col-sm-2 control-label">Business slug</label>
                        <div class="col-sm-4">
                           <input type="text" class="form-control module_slug" name="slug" placeholder="Enter ..." value="{{ $countryData->slug }}" required>
                           @if ($errors->has('slug'))
                           <span class="text-danger">{{ $errors->first('slug') }}</span>
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
