@extends('layouts.admin')

@section('content')
@php
$user_status_array = unserialize(User_Status_Array);
$payment_status_array = unserialize(Payment_Status_Array);
$currency_with_icon_array = unserialize(Currency_With_Icon_Array);
@endphp
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{ __('View User') }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('View User') }}</li>
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
            <h3 class="card-title">View</h3>
          </div>
          <!-- /.card-header -->

          <div class="new-inner-table-description-section">
            <div class="container">
              <div class="table-responsive">
                <h4>User Details</h4>
                <table>
                  <tbody>
                    <tr>
                      <td><span>Date of registration</span></td>
                      <td>{!! date_convert($user->created_at,3) !!}</td>
                    </tr>
                    <tr>
                      <td><span>Role</span></td>
                      <td>{!! $user->role_name !!}</td>
                    </tr>
                    <tr>
                      <td><span>Status</span></td>
                      <td><span class="badge bg-{{$user->status==1?'success':'danger'}}">{!! $user_status_array[$user->status] !!}</span></td>
                    </tr>
                    <tr>
                      <td><span>Name</span></td>
                      <td>{!! $user->name !!}</td>
                    </tr>
                    <tr>
                      <td><span>Name</span></td>
                      <td>{!! $user->name !!}</td>
                    </tr>
                    <tr>
                      <td><span>Username/Email</span></td>
                      <td>{!! $user->email !!}</td>
                    </tr>
                    <tr>
                      <td><span>Profile Image</span></td>
                      <td>
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
                      </td>
                    </tr>
                    <tr>
                      <td><span>Phone Number</span></td>
                      <td>{!! $user->phone_number !!}</td>
                    </tr>
                    <tr>
                      <td><span>Skill</span></td>
                      <td>
                      @foreach($user->skill as $k=>$s)
                      {{$k>0?', ':''}}{{$s->name}}
                      @endforeach
                      </td>
                    </tr>
                    <tr>
                      <td><span>Description</span></td>
                      <td>{!! $user->description !!}</td>
                    </tr>
                    <tr>
                      <td><span>Occupation</span></td>
                      <td>{!! $user->occupation !!}</td>
                    </tr>
                    <tr>
                      <td><span>City</span></td>
                      <td>{!! $user->city !!}</td>
                    </tr>
                    <tr>
                      <td><span>State</span></td>
                      <td>{!! optional($user->state)->name !!}</td>
                    </tr>
                    <tr>
                      <td><span>Country</span></td>
                      <td>{!! optional($user->country)->name !!}</td>
                    </tr>
                    <tr>
                      <td><span>Zip code</span></td>
                      <td>{!! $user->zip_code !!}</td>
                    </tr>
                    <tr>
                      <td><span>Facebook URL</span></td>
                      <td>{!! $user->facebook_url !!}</td>
                    </tr>
                    <tr>
                      <td><span>Instagram URL</span></td>
                      <td>{!! $user->instagram_url !!}</td>
                    </tr>
                    <tr>
                      <td><span>Twitter URL</span></td>
                      <td>{!! $user->twitter_url !!}</td>
                    </tr>
                    <tr>
                      <td><span>Linkedin URL</span></td>
                      <td>{!! $user->linkedin_url !!}</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

            <div class="card-body">


              <!-- /.card-body -->

              <div class="card-footer">
                <button type="button" class="btn btn-primary" onclick="window.location.href='{{ url(Admin_Prefix.'user') }}'" >Back</button>
              </div>

          </div>
          <!-- /.card -->

        </div>


      </div>
      <!-- /.row -->
  </div>
</section>
<!-- /.content -->
@endsection

@section('more-css')
<style type="text/css">
/*new css 23-11-2021*/
.new-inner-table-description-section{
padding: 20px 0px;
}
.new-inner-table-description-section table {
width: 100%;
}
.new-inner-table-description-section th {
font-size: 16px;
}
.new-inner-table-description-section td, .new-inner-table-description-section th {
border:1px solid #dbdbdb;
padding: 13px 15px;
font-size: 13px;
}
.new-inner-table-description-section th {
padding-top: 12px;
padding-bottom: 12px;
text-align: left;
background-color: #4aa9d5;
color: white;
padding-left: 10px;
border: 1px solid aliceblue;
font-weight: 600;
text-align: center;
font-size: 14px;
}
.new-inner-table-description-section table td span{
font-weight:500;
font-size: 16px;
}
.new-inner-table-description-section .table-responsive {
/*max-width: 900px;*/
}
.new-inner-table-description-section table tr:nth-child(even) {
}
.new-inner-table-description-section h4{
margin-bottom: 15px;
}
.new-inner-table-description-section table tr td:first-child{
background: #4aa9d5;
color: #fff;
position: relative;
width: 360px;
}
.new-inner-table-description-section.course_details table tr td:first-child{
background: transparent;
color: #212529;
position: unset;
width: auto;
}
.new-inner-table-description-section table tr td:first-child::after {
width: 0;
height: 0;
border-top: 10px solid transparent;
border-left: 11px solid #4aa9d5;
border-bottom: 10px solid transparent;
position: absolute;
right: -11px;
top: 50%;
content: ' ';
-ms-transition: translate(0, -50%);
-o-transition: translate(0, -50%);
-moz-transition: translate(0, -50%);
-webkit-transform: translate(0, -50%);
transform: translate(0, -50%);
}
.new-inner-table-description-section table.no-data tr td:first-child::after {
  display: none;
}

.new-inner-table-description-section.course_details table tr td:first-child::after{
display: none;
}
.new-inner-table-description-section table tr td:last-child{
padding-left: 20px;
}
.new-inner-table-description-section #accordion{
width: 100%;
}
.new-inner-table-description-section .mb-0 > a {
display: block;
position: relative;
}
.new-inner-table-description-section .mb-0 > a:after {
content: "\f078"; /* fa-chevron-down */
font-family: 'FontAwesome';
position: absolute;
right: 0;
}
.new-inner-table-description-section .mb-0 > a[aria-expanded="true"]:after {
content: "\f077"; /* fa-chevron-up */
}
.new-inner-table-description-section .card-header{
background-color: #fff;
padding: 10px;
border-bottom: none;
}
.new-inner-table-description-section .card-body{
border-top: 1px solid rgba(0,0,0,.125);
}
.new-inner-table-description-section .card{
margin-bottom: 10px;
}
.new-inner-table-description-section .card h5{
font-size: 16px;
font-weight: 500;
}
.new-inner-table-description-section .card .card-body {
text-align: left;
}
.new-inner-table-description-section .card {
margin-bottom: 10px;
width: 100%;
float:none;
max-width: 900px;
}
/*new css 23-11-2021*/
  .card-title{font-weight: 600;}
  .control-label{font-weight: 400 !important;}
</style>
@stop
