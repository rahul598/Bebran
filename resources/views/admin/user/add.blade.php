@extends('layouts.admin')

@section('content')
@php
$skill_id = old('skill_id')?old('skill_id'):[];
@endphp
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{ __('Add User') }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Add User') }}</li>
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
          <form role="form" action="{{ url(Admin_Prefix.'user/add/') }}"  method="post" enctype="multipart/form-data" class="customValidate">

            @csrf

            <div class="card-body">

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">First Name</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="fname" id="fname" placeholder="Enter first name..." value="{{ old('fname') }}" required>
                </div>
                <label class="col-sm-2 control-label">Last Name</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="lname" id="lname" placeholder="Enter last name..." value="{{ old('lname') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control email" name="email" id="email" placeholder="Enter ..." value="{{ old('email') }}" required>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Role</label>
                <div class="col-sm-3">
                  <select name="role_id" id="role_id" class="form-control" required>
                    <option value="">Select</option>
                    @foreach($roles as $role)
                    <option value="{{ $role->id }}" @if( Request::old('role_id')==$role->id) selected="selected" @endif >{{ $role->display_name }}</option>
                    @endforeach
                  </select>
                </div>
                <label class="col-sm-2 control-label">Phone Number</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Enter phone..." value="{{ old('phone_number') }}">
                </div>
                <label class="col-sm-1 control-label">Status</label>
                <div class="col-sm-2">
                  <select name="status" id="status" class="form-control">
                    <option value="1" {!!Request::old('status')=='1'?'selected':''!!}>Active</option>
                    <option value="0" {!!Request::old('status')=='0'?'selected':''!!}>Inactive</option>
                    <!-- <option value="2" {!!Request::old('status')=='2'?'selected':''!!}>Deleted</option> -->
                  </select>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Avatar</label>
                <div class="col-sm-10">
                  <input type="file" name="avatar"><br>
                  Mime Type: webp, Max image upload size 2 Mb<br>

                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Password</label>
                <div class="col-sm-4">
                  <input type="password" class="form-control required" placeholder="Enter ..." name="password" id="password" autocomplete="off"/>
                </div>
                <label class="col-sm-2 control-label">Retype Password</label>
                <div class="col-sm-4">
                  <input type="password" class="form-control" placeholder="Enter ..." name="password_confirmation" id="password_confirmation" autocomplete="off" data-rule-equalTo="#password"/>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Description</label>
                <div class="col-sm-10">
                  <textarea name="description" class="form-control" class="ckeditor1" placeholder="Enter ...">{{ old('description') }}</textarea>
                </div>
              </div>

              <!-- <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Occupation</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="occupation" id="occupation" placeholder="Enter phone..." value="{{ old('occupation') }}">
                </div>
              </div> -->

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Country</label>
                <div class="col-sm-3">
                  <select name="country_id" id="country_id" class="form-control select2" data-placeholder="Select">
                    <option value="">Select</option>
                    @foreach($countries as $country)
                    <option value="{{ $country->id }}" @if(old('country_id')==$country->id) selected="selected" @endif >{{ $country->name }}</option>
                    @endforeach
                  </select>
                </div>
                <label class="col-sm-1 control-label">City</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" name="city" id="city" placeholder="Enter city..." value="{{ old('city') }}">
                </div>
                <label class="col-sm-1 control-label">Zip code</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" name="zip_code" id="zip_code" placeholder="Enter zip code..." value="{{ old('zip_code') }}">
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
function country_change()
{
  var country_id = $("#country_id").val();
  var state_id = '{{old("state_id")}}';
  var data = {'country_id' : country_id};
  $.ajax({
    type : 'get',
    url : '{{url(Admin_Prefix."get-state")}}',
    data : data,
    dataType : 'json',
    beforeSend : function(){
      //$("#loading").show();
    },
    success : function(resp){
      //$("#loading").hide();
      //console.log(resp);
      html = '<option value="">Select</option>';
      if (resp.states.length > 0) {
        resp.states.map(function (row) {
          html += `<option value="${row.id}" ${row.id == state_id ? `selected` : ''}>${row.name}</option>`;
        });
      }
      $("#state_id").empty().html(html);
    }
  });
}
$(document).ready(function(){
  country_change();
  $('#country_id').change(function(){
    country_change();
  });
});
/*
role_change();

function role_change()
{
  var role_id = $("#role_id").val();
  if (role_id==3) 
  {
    $('.franchise').hide('slow');
    $('.student').show('slow');
  }
  else if(role_id==2) 
  {
    $('.student').hide('slow');
    $('.franchise').show('slow');
  } else {
    $('.student').hide('slow');
    $('.franchise').hide('slow');
  }
  
}

$(document).ready(function(){
  $('#role_id').change(function(){
    role_change();
  });
});*/
</script> 

@stop