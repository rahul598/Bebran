@extends('layouts.admin')

@section('content')
@php
@endphp
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{ __('Edit User') }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Edit User') }}</li>
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
            <h3 class="card-title">Update</h3>
          </div>
          <!-- /.card-header -->
          <!-- form start -->
          <form role="form" action="{{ url(Admin_Prefix.'user/update/') }}"  method="post" enctype="multipart/form-data" class="customValidate">

            @csrf

            <input type="hidden" name="id" value="{{$user->id}}">

            <div class="card-body">

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">First Name</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="fname" placeholder="Enter first name..." value="{{$user->fname}}" required>
                </div>
                <label class="col-sm-2 control-label">Last Name</label>
                <div class="col-sm-4">
                  <input type="text" class="form-control" name="lname" id="lname" placeholder="Enter last name..." value="{{$user->lname}}">
                </div> 
              </div>
 

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control email" name="email" id="email" placeholder="Enter ..." value="{{$user->email}}" required>
                </div>
              </div>

              <div class="form-group row clearfix">
                <input type="hidden" name="role_id" value="{{$user->role_id}}">
                <label class="col-sm-2 control-label">Role</label>
                <div class="col-sm-3">
                  <select name="role_id" id="role_id" class="form-control" style="width: 100%;" data-validation-engine="validate[required]">
                    <option value="">Select</option>

                    @foreach($roles as $role)
                    <option value="{{ $role->id }}" @if( $user->role_id==$role->id) selected="selected" @endif >{{ $role->display_name }}</option>
                    @endforeach
                    
                  </select>
                </div>
                <label class="col-sm-2 control-label">Phone Number</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Enter phone..." value="{{$user->phone_number}}">
                </div>
                <label class="col-sm-1 control-label">Status</label>
                <div class="col-sm-2">
                  <select name="status" id="status" class="form-control">
                    <option value="1" {!!$user->status=='1'?'selected':''!!}>Active</option>
                    <option value="0" {!!$user->status=='0'?'selected':''!!}>Inactive</option>
                    <!-- <option value="2" {!!$user->status=='2'?'selected':''!!}>Deleted</option> -->
                  </select>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Avatar</label>
                <div class="col-sm-10">
                  <input type="file" name="avatar"><br>
                  Mime Type: webp, Max image upload size 2 Mb<br>
                  <div class="clearfix">
                    <?php
                    if($user->avatar && File::exists(public_path('uploads/'.$user->avatar)) )
                      {
                        ?>
                        <img src="{{ asset('/uploads/'.$user->avatar) }}" style="margin: 10px 0 0 0;max-width: 200px;">
                        <?php
                      }
                      ?>
                    </div>

                  </div>
                </div>

                <div class="form-group row clearfix">
                  <label class="col-sm-2 control-label">Password</label>
                  <div class="col-sm-4">
                    <input type="password" class="form-control" placeholder="Enter ..." name="password" id="password" autocomplete="off" data-rule-pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$" data-rule-minlength="8" />
                  </div>
                  <label class="col-sm-2 control-label">Retype Password</label>
                  <div class="col-sm-4">
                    <input type="password" class="form-control" placeholder="Enter ..." name="password_confirmation" id="password_confirmation" autocomplete="off" data-rule-equalTo="#password"/>
                  </div>
                </div>

                <div class="form-group row clearfix">
                  <label class="col-sm-2 control-label">Description</label>
                  <div class="col-sm-10">
                    <textarea name="description" class="form-control" class="ckeditor1" placeholder="Enter ...">{{ $user->description }}</textarea>
                  </div>
                </div>

              <!-- <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Occupation</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="occupation" id="occupation" placeholder="Enter occupation..." value="{{ old('occupation') }}">
                </div>
              </div> -->

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Country</label>
                <div class="col-sm-3">
                  <select name="country_id" id="country_id" class="form-control select2" data-placeholder="Select">
                    <option value="">Select</option>
                    @foreach($countries as $country)
                    <option value="{{ $country->id }}" @if($user->country_id==$country->id) selected="selected" @endif >{{ $country->name }}</option>
                    @endforeach
                  </select>
                </div>
                <label class="col-sm-1 control-label">City</label>
                <div class="col-sm-3">
                  <input type="text" class="form-control" name="city" id="city" placeholder="Enter city..." value="{{ $user->city }}">
                </div>
                <label class="col-sm-1 control-label">Zip code</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control" name="zip_code" id="zip_code" placeholder="Enter zip code..." value="{{ $user->zip_code }}">
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
function country_change1()
{
  var country_id = $("#country_id").val();//alert(country_id);
  if (country_id>0) 
  {
    //$('#state_id option').hide();
    //$('#state_id option:eq(0)').show();
    //$("#state_id option[data-country_id=" + country_id + "]").show();
    $("#state_id option[data-country_id=" + country_id + "]").hide();
    // $("#country_id").find(':selected').data('country_id');
  } else {
    $('#state_id:option').hide();
    $('#state_id option:eq(0)').show()
  }
  
}
function country_change()
{
  var country_id = $("#country_id").val();
  var state_id = '{{$user->state_id}}';
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
/*  $("#password").rules("add", { regex: "^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$" });
  $.validator.addMethod(
        "regex",
        function(value, element, regexp) {
            var re = new RegExp(regexp);
            return this.optional(element) || re.test(value);
        },
        "Please check your input."
);*/
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
