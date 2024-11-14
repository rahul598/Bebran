@extends('layouts.admin')

@section('content')
@php
$header_display_in_array = unserialize(Header_Display_In_Array);
$page_template_array = unserialize(Page_Template_Array);
$page_section_array = unserialize(Page_Section_Array);
@endphp
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{ __('Edit Our Strength') }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <!--<li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>-->
            <!--<li class="breadcrumb-item active">{{ __('Edit  Our Strength') }}</li>-->
            <a class="btn btn-primary" href="{{ url(Admin_Prefix.'our-strength') }}">Back</a>
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
          
            <form role="form" action="{{ url(Admin_Prefix.'page/update/') }}"  method="post" enctype="multipart/form-data" class="customValidate">
              <!-- /.card -->
                <div class="card-body">  
                    <div class="form-group row clearfix">
                        <label class="col-sm-2 control-label">Section Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="section_title" placeholder="Enter ..." value="{{ $our_strength->title }}">
                        </div> 
                    </div>
                    <div class="form-group row clearfix">
                        <label class="col-sm-2 control-label">Sub Title</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="section_sub_title" placeholder="Enter ..." value="{{ $our_strength->sub_title }}">
                        </div>
                    </div>
                    <div class="form-group row clearfix">
                        <label class="col-sm-2 control-label">Image</label>
                        <div class="col-sm-10">
                            <input type="file" class="form-control" name="image" data-rule-extension="webp">
                            Mime Type: webp, Max image upload size 2 Mb<br>
                    
                            <div class="clearfix">
                                <?php
                                if($our_strength->image && File::exists(public_path('uploads/'.$our_strength->image)) )
                                  {
                                    ?>
                                    <img src="{{ asset('/uploads/'.$our_strength->image) }}" style="margin: 10px 0 0 0;max-width: 200px;background-color: #0e25ca;padding: 8px;">  
                                <?php
                                  }
                                ?>
                            </div>
                        </div>
                    </div> 
                </div>
            </form> 
        </div>
        </div>
      </div>
  </div>
</section>
@endsection