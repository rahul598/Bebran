@extends('layouts.admin')
@section('content')
  <!-- Content Header (Blog header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{ __('Edit Media Converage') }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Edit Media Converage') }}</li>
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
          <form role="form" action="{{ url(Admin_Prefix.'mediaCoverage/update/') }}"  method="post" enctype="multipart/form-data" class="customValidate">

            @csrf

            <input type="hidden" name="id" value="{{$list->id}}">
            <div class="card-body">
              {{-- <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Category</label>
                <div class="col-sm-10">
                  <select name="category_id" class="form-control select2" data-placeholder="Select">
                    <option value="">Select Category</option>
                    @foreach($media_coverage_categories as $key => $value)
                    <option value="{!! $value->id !!}" @if($value->id == $list->category_id) selected @endif>{!! $value->name !!}</option>
                    @endforeach
                  </select>
                </div>
              </div> --}}

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control module_name" name="title" id="title" placeholder="Enter ..." value="{{ $list->title }}" required>
                </div>
              </div>

              <div class="form-group row clearfix bannerimage">
                <label class="col-sm-2 control-label">Image</label>
                <div class="col-sm-10">
                  <input type="file" name="image" data-validation-engine="validate[,custom[validateMIME[image/webp]]]">
                  Mime Type: webp, Max image upload size 2 Mb<br>
                  <div class="clearfix">
                    <?php
                    if($list->image && File::exists(public_path('uploads/'.$list->image)) )
                      {
                        ?>
                        <img src="{{ asset('/uploads/'.$list->image) }}" style="margin: 10px 0 0 0;max-width: 300px;">
                        <?php
                      }
                      ?>
                    </div>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Button Text</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="btn_text" id="btn_text" required placeholder="Enter ..." value="{{ $list->btn_text }}">
                </div>
              </div>
              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Button url</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="btn_url" id="btn_url" required placeholder="Enter ..." value="{{ $list->btn_url }}">
                </div>
                <label class="col-sm-2 control-label mt-2">Status</label>
                <div class="col-sm-10 mt-2">
                  <select name="status" id="status" class="form-control">
                    <option value="1" {!!$list->status =='1'?'selected':''!!}>Active</option>
                    <option value="0" {!!$list->status =='0'?'selected':''!!}>Inactive</option>
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


<div class="copy type000 d-none">  
  <div class="sn">   
    <div class="form-group row clearfix">
      <input type="hidden" name="type[]" value="">
      <input type="hidden" name="section_type[]" value="1">
      <input type="hidden" name="section_new_img2[]" value="">
      <input type="hidden" name="section_new_t[]" value="">
      <input type="hidden" name="section_new_st[]" value="">
      <input type="hidden" name="section_new_c[]" value="">
      <input type="hidden" name="section_new_btn_text[]" value="">
      <input type="hidden" name="section_new_btn_url[]" value="">
      <label class="col-sm-2 control-label">Banner Image</label>
      <div class="col-sm-9">
        <input type="file" name="section_new_img[]" data-validation-engine="validate[,custom[validateMIME[image/webp]]]">
        Mime Type: webp, Max image upload size 2 Mb<br>
      </div>
      <div class="col-sm-1"><a href="javascript:;" class="remove_field">Remove</a></div>
    </div>
  </div>
</div>

<div class="copy type1 d-none"> 
  <div class="sn">   
    <div class="form-group row clearfix">
      <input type="hidden" name="type[]" value="">
      <input type="hidden" name="section_type[]" value="1">
      <input type="hidden" name="section_new_st[]" value="">
      <input type="hidden" name="section_new_img2[]" value="">
      <input type="hidden" name="section_new_btn_url[]" value="">
      <label class="col-sm-2 control-label">Title</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="section_new_t[]" placeholder="Enter ..." value="" required>
      </div>
      <div class="col-sm-1"><a href="javascript:;" class="remove_field">Remove</a></div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Image</label>
      <div class="col-sm-10">
        <input type="file" name="section_new_img[]" data-validation-engine="validate[,custom[validateMIME[image/webp]]]">
        Mime Type: webp, Max image upload size 2 Mb<br>
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Content</label>
      <div class="col-sm-10">
        <textarea class="form-control ckeditor" name="section_new_c[]" placeholder="Enter ..."></textarea>
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Button Text</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_btn_text[]" placeholder="Enter ..." value="">
      </div>
    </div>
  </div>
</div>

<div class="copy type2 d-none"> 
  <div class="sn">    
    <div class="form-group row clearfix">
      <input type="hidden" name="type[]" value="">
      <input type="hidden" name="section_type[]" value="2">
      <input type="hidden" name="section_new_img[]" value="">
      <input type="hidden" name="section_new_img2[]" value="">
      <input type="hidden" name="section_new_st[]" value="">
      <input type="hidden" name="section_new_c[]" value="">
      <input type="hidden" name="section_new_btn_text[]" value="">
      <input type="hidden" name="section_new_btn_url[]" value="">
      <label class="col-sm-2 control-label">Title</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="section_new_t[]" placeholder="Enter ..." value="" required>
      </div>
      <div class="col-sm-1"><a href="javascript:;" class="remove_field">Remove</a></div>
    </div>
  </div>
</div>

<div class="copy type3 d-none">  
  <div class="sn">   
    <div class="form-group row clearfix">
      <input type="hidden" name="type[]" value="">
      <input type="hidden" name="section_type[]" value="3">
      <input type="hidden" name="section_new_img2[]" value="">
      <input type="hidden" name="section_new_t[]" value="">
      <input type="hidden" name="section_new_st[]" value="">
      <input type="hidden" name="section_new_c[]" value="">
      <input type="hidden" name="section_new_btn_text[]" value="">
      <input type="hidden" name="section_new_btn_url[]" value="">
      <label class="col-sm-2 control-label">Image</label>
      <div class="col-sm-9">
        <input type="file" name="section_new_img[]" data-validation-engine="validate[,custom[validateMIME[image/webp]]]">
        Mime Type: webp, Max image upload size 2 Mb<br>
      </div>
      <div class="col-sm-1"><a href="javascript:;" class="remove_field">Remove</a></div>
    </div>
  </div>
</div>

<div class="copy type4 d-none">  
  <div class="sn">   
    <div class="form-group row clearfix">
      <input type="hidden" name="type[]" value="">
      <input type="hidden" name="section_type[]" value="4">
      <input type="hidden" name="section_new_img[]" value="">
      <input type="hidden" name="section_new_img2[]" value="">
      <input type="hidden" name="section_new_t[]" value="">
      <input type="hidden" name="section_new_st[]" value="">
      <input type="hidden" name="section_new_btn_text[]" value="">
      <input type="hidden" name="section_new_btn_url[]" value="">
      <label class="col-sm-2 control-label">Content</label>
      <div class="col-sm-9">
        <textarea class="form-control ckeditor" name="section_new_c[]" placeholder="Enter ..."></textarea>
      </div>
      <div class="col-sm-1"><a href="javascript:;" class="remove_field">Remove</a></div>
    </div>
  </div>
</div>

<div class="copy type5 d-none">  
  <div class="sn">    
    <div class="form-group row clearfix">
      <input type="hidden" name="type[]" value="">
      <input type="hidden" name="section_type[]" value="5">
      <input type="hidden" name="section_new_img[]" value="">
      <input type="hidden" name="section_new_img2[]" value="">
      <input type="hidden" name="section_new_t[]" value="">
      <input type="hidden" name="section_new_st[]" value="">
      <input type="hidden" name="section_new_c[]" value="">
      <label class="col-sm-2 control-label">Button Text</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="section_new_btn_text[]" placeholder="Enter ..." value="">
      </div>
      <div class="col-sm-1"><a href="javascript:;" class="remove_field">Remove</a></div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Banner Button URL</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_btn_url[]" placeholder="Enter ..." value="">
      </div>
    </div>
  </div>
</div>

<div class="copy type6 d-none"> 
  <div class="sn">    
    <div class="form-group row clearfix">
      <input type="hidden" name="type[]" value="">
      <input type="hidden" name="section_type[]" value="6">
      <input type="hidden" name="section_new_img[]" value="">
      <input type="hidden" name="section_new_img2[]" value="">
      <input type="hidden" name="section_new_t[]" value="">
      <input type="hidden" name="section_new_st[]" value="">
      <input type="hidden" name="section_new_c[]" value="">
      <input type="hidden" name="section_new_btn_url[]" value="">
      <label class="col-sm-2 control-label">Button Text</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="section_new_btn_text[]" placeholder="Enter ..." value="">
      </div>
      <div class="col-sm-1"><a href="javascript:;" class="remove_field">Remove</a></div>
    </div>
  </div>
</div>

<div class="copy type7 d-none"> 
  <div class="sn">   
    <div class="form-group row clearfix">
      <input type="hidden" name="type[]" value="">
      <input type="hidden" name="section_type[]" value="7">
      <input type="hidden" name="section_new_img[]" value="">
      <input type="hidden" name="section_new_img2[]" value="">
      <input type="hidden" name="section_new_st[]" value="">
      <input type="hidden" name="section_new_c[]" value="">
      <label class="col-sm-2 control-label">Title</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="section_new_t[]" placeholder="Enter ..." value="" required>
      </div>
      <div class="col-sm-1"><a href="javascript:;" class="remove_field">Remove</a></div>
    </div> 
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Button Text</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_btn_text[]" placeholder="Enter ..." value="">
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Banner Button URL</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_btn_url[]" placeholder="Enter ..." value="">
      </div>
    </div>
  </div>
</div>

<div class="copy type8 d-none"> 
  <div class="sn">   
    <div class="form-group row clearfix">
      <input type="hidden" name="type[]" value="">
      <input type="hidden" name="section_type[]" value="8">
      <input type="hidden" name="section_new_img[]" value="">
      <input type="hidden" name="section_new_img2[]" value="">
      <input type="hidden" name="section_new_c[]" value="">
      <input type="hidden" name="section_new_btn_text[]" value="">
      <input type="hidden" name="section_new_btn_url[]" value="">
      <label class="col-sm-2 control-label">Title</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="section_new_t[]" placeholder="Enter ..." value="" required>
      </div>
      <div class="col-sm-1"><a href="javascript:;" class="remove_field">Remove</a></div>
    </div> 
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Sub Title</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_st[]" placeholder="Enter ..." value="">
      </div>
    </div>
  </div>
</div>

<div class="copy type9 d-none"> 
  <div class="sn">   
    <div class="form-group row clearfix">
      <input type="hidden" name="type[]" value="">
      <input type="hidden" name="section_type[]" value="9">
      <input type="hidden" name="section_new_img2[]" value="">
      <input type="hidden" name="section_new_c[]" value="">
      <input type="hidden" name="section_new_btn_text[]" value="">
      <input type="hidden" name="section_new_btn_url[]" value="">
      <label class="col-sm-2 control-label">Title</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="section_new_t[]" placeholder="Enter ..." value="" required>
      </div>
      <div class="col-sm-1"><a href="javascript:;" class="remove_field">Remove</a></div>
    </div> 
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Sub Title</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_st[]" placeholder="Enter ..." value="">
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Image</label>
      <div class="col-sm-10">
        <input type="file" name="section_new_img[]" data-validation-engine="validate[,custom[validateMIME[image/webp]]]">
        Mime Type: webp, Max image upload size 2 Mb<br>
      </div>
    </div>
  </div>
</div>

<div class="copy type10 d-none"> 
  <div class="sn">   
    <div class="form-group row clearfix">
      <input type="hidden" name="type[]" value="">
      <input type="hidden" name="section_type[]" value="10">
      <input type="hidden" name="section_new_img2[]" value="">
      <input type="hidden" name="section_new_c[]" value="">
      <label class="col-sm-2 control-label">Title</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="section_new_t[]" placeholder="Enter ..." value="" required>
      </div>
      <div class="col-sm-1"><a href="javascript:;" class="remove_field">Remove</a></div>
    </div> 
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Sub Title</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_st[]" placeholder="Enter ..." value="">
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Image</label>
      <div class="col-sm-10">
        <input type="file" name="section_new_img[]" data-validation-engine="validate[,custom[validateMIME[image/webp]]]">
        Mime Type: webp, Max image upload size 2 Mb<br>
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Button Text</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_btn_text[]" placeholder="Enter ..." value="">
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Banner Button URL</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_btn_url[]" placeholder="Enter ..." value="">
      </div>
    </div>
  </div>
</div>

<div class="copy type11 d-none"> 
  <div class="sn">   
    <div class="form-group row clearfix">
      <input type="hidden" name="type[]" value="">
      <input type="hidden" name="section_type[]" value="11">
      <input type="hidden" name="section_new_c[]" value="">
      <input type="hidden" name="section_new_btn_text[]" value="">
      <input type="hidden" name="section_new_btn_url[]" value="">
      <label class="col-sm-2 control-label">Title</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="section_new_t[]" placeholder="Enter ..." value="" required>
      </div>
      <div class="col-sm-1"><a href="javascript:;" class="remove_field">Remove</a></div>
    </div> 
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Sub Title</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_st[]" placeholder="Enter ..." value="">
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Image</label>
      <div class="col-sm-10">
        <input type="file" name="section_new_img[]" data-validation-engine="validate[,custom[validateMIME[image/webp]]]">
        Mime Type: webp, Max image upload size 2 Mb<br>
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Image 2</label>
      <div class="col-sm-10">
        <input type="file" name="section_new_img2[]" data-validation-engine="validate[,custom[validateMIME[image/webp]]]">
        Mime Type: webp, Max image upload size 2 Mb<br>
      </div>
    </div>
  </div>
</div>

<div class="copy type12 d-none"> 
  <div class="sn">   
    <div class="form-group row clearfix">
      <input type="hidden" name="type[]" value="">
      <input type="hidden" name="section_type[]" value="12">
      <input type="hidden" name="section_new_c[]" value="">
      <label class="col-sm-2 control-label">Title</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="section_new_t[]" placeholder="Enter ..." value="" required>
      </div>
      <div class="col-sm-1"><a href="javascript:;" class="remove_field">Remove</a></div>
    </div> 
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Sub Title</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_st[]" placeholder="Enter ..." value="">
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Image</label>
      <div class="col-sm-10">
        <input type="file" name="section_new_img[]" data-validation-engine="validate[,custom[validateMIME[image/webp]]]">
        Mime Type: webp, Max image upload size 2 Mb<br>
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Image 2</label>
      <div class="col-sm-10">
        <input type="file" name="section_new_img2[]" data-validation-engine="validate[,custom[validateMIME[image/webp]]]">
        Mime Type: webp, Max image upload size 2 Mb<br>
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Button Text</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_btn_text[]" placeholder="Enter ..." value="">
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Banner Button URL</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_btn_url[]" placeholder="Enter ..." value="">
      </div>
    </div>
  </div>
</div>

<div class="copy type13 d-none"> 
  <div class="sn">   
    <div class="form-group row clearfix">
      <input type="hidden" name="type[]" value="">
      <input type="hidden" name="section_type[]" value="13">
      <input type="hidden" name="section_new_img[]" value="">
      <input type="hidden" name="section_new_img2[]" value="">
      <input type="hidden" name="section_new_st[]" value="">
      <input type="hidden" name="section_new_btn_text[]" value="">
      <input type="hidden" name="section_new_btn_url[]" value="">
      <label class="col-sm-2 control-label">Title</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="section_new_t[]" placeholder="Enter ..." value="" required>
      </div>
      <div class="col-sm-1"><a href="javascript:;" class="remove_field">Remove</a></div>
    </div> 
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Content</label>
      <div class="col-sm-10">
        <textarea class="form-control ckeditor" name="section_new_c[]" placeholder="Enter ..."></textarea>
      </div>
    </div>
  </div>
</div>

<div class="copy type14 d-none"> 
  <div class="sn">   
    <div class="form-group row clearfix">
      <input type="hidden" name="type[]" value="">
      <input type="hidden" name="section_type[]" value="14">
      <input type="hidden" name="section_new_img[]" value="">
      <input type="hidden" name="section_new_img2[]" value="">
      <input type="hidden" name="section_new_btn_text[]" value="">
      <input type="hidden" name="section_new_btn_url[]" value="">
      <label class="col-sm-2 control-label">Title</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="section_new_t[]" placeholder="Enter ..." value="" required>
      </div>
      <div class="col-sm-1"><a href="javascript:;" class="remove_field">Remove</a></div>
    </div> 
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Sub Title</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_st[]" placeholder="Enter ..." value="">
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Content</label>
      <div class="col-sm-10">
        <textarea class="form-control ckeditor" name="section_new_c[]" placeholder="Enter ..."></textarea>
      </div>
    </div>
  </div>
</div>

<div class="copy type15 d-none"> 
  <div class="sn">   
    <div class="form-group row clearfix">
      <input type="hidden" name="type[]" value="">
      <input type="hidden" name="section_type[]" value="15">
      <input type="hidden" name="section_new_img[]" value="">
      <input type="hidden" name="section_new_img2[]" value="">
      <label class="col-sm-2 control-label">Title</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="section_new_t[]" placeholder="Enter ..." value="" required>
      </div>
      <div class="col-sm-1"><a href="javascript:;" class="remove_field">Remove</a></div>
    </div> 
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Sub Title</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_st[]" placeholder="Enter ..." value="">
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Content</label>
      <div class="col-sm-10">
        <textarea class="form-control ckeditor" name="section_new_c[]" placeholder="Enter ..."></textarea>
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Button Text</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_btn_text[]" placeholder="Enter ..." value="">
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Banner Button URL</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_btn_url[]" placeholder="Enter ..." value="">
      </div>
    </div>
  </div>
</div>

<div class="copy type16 d-none"> 
  <div class="sn">   
    <div class="form-group row clearfix">
      <input type="hidden" name="type[]" value="">
      <input type="hidden" name="section_type[]" value="16">
      <input type="hidden" name="section_new_img2[]" value="">
      <input type="hidden" name="section_new_btn_text[]" value="">
      <input type="hidden" name="section_new_btn_url[]" value="">
      <label class="col-sm-2 control-label">Title</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="section_new_t[]" placeholder="Enter ..." value="" required>
      </div>
      <div class="col-sm-1"><a href="javascript:;" class="remove_field">Remove</a></div>
    </div> 
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Sub Title</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_st[]" placeholder="Enter ..." value="">
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Image</label>
      <div class="col-sm-10">
        <input type="file" name="section_new_img[]" data-validation-engine="validate[,custom[validateMIME[image/webp]]]">
        Mime Type: webp, Max image upload size 2 Mb<br>
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Content</label>
      <div class="col-sm-10">
        <textarea class="form-control ckeditor" name="section_new_c[]" placeholder="Enter ..."></textarea>
      </div>
    </div>
  </div>
</div>

<div class="copy type17 d-none"> 
  <div class="sn">   
    <div class="form-group row clearfix">
      <input type="hidden" name="type[]" value="">
      <input type="hidden" name="section_type[]" value="17">
      <input type="hidden" name="section_new_img2[]" value="">
      <label class="col-sm-2 control-label">Title</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="section_new_t[]" placeholder="Enter ..." value="" required>
      </div>
      <div class="col-sm-1"><a href="javascript:;" class="remove_field">Remove</a></div>
    </div> 
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Sub Title</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_st[]" placeholder="Enter ..." value="">
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Image</label>
      <div class="col-sm-10">
        <input type="file" name="section_new_img[]" data-validation-engine="validate[,custom[validateMIME[image/webp]]]">
        Mime Type: webp, Max image upload size 2 Mb<br>
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Content</label>
      <div class="col-sm-10">
        <textarea class="form-control ckeditor" name="section_new_c[]" placeholder="Enter ..."></textarea>
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Button Text</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_btn_text[]" placeholder="Enter ..." value="">
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Banner Button URL</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_btn_url[]" placeholder="Enter ..." value="">
      </div>
    </div>
  </div>
</div>

<div class="copy type18 d-none"> 
  <div class="sn">   
    <div class="form-group row clearfix">
      <input type="hidden" name="type[]" value="">
      <input type="hidden" name="section_type[]" value="18">
      <input type="hidden" name="section_new_btn_text[]" value="">
      <input type="hidden" name="section_new_btn_url[]" value="">
      <label class="col-sm-2 control-label">Title</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="section_new_t[]" placeholder="Enter ..." value="" required>
      </div>
      <div class="col-sm-1"><a href="javascript:;" class="remove_field">Remove</a></div>
    </div> 
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Sub Title</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_st[]" placeholder="Enter ..." value="">
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Image</label>
      <div class="col-sm-10">
        <input type="file" name="section_new_img[]" data-validation-engine="validate[,custom[validateMIME[image/webp]]]">
        Mime Type: webp, Max image upload size 2 Mb<br>
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Image 2</label>
      <div class="col-sm-10">
        <input type="file" name="section_new_img2[]" data-validation-engine="validate[,custom[validateMIME[image/webp]]]">
        Mime Type: webp, Max image upload size 2 Mb<br>
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Content</label>
      <div class="col-sm-10">
        <textarea class="form-control ckeditor" name="section_new_c[]" placeholder="Enter ..."></textarea>
      </div>
    </div>
  </div>
</div>

<div class="copy type19 d-none"> 
  <div class="sn">   
    <div class="form-group row clearfix">
      <input type="hidden" name="type[]" value="">
      <input type="hidden" name="section_type[]" value="19">
      <label class="col-sm-2 control-label">Title</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="section_new_t[]" placeholder="Enter ..." value="" required>
      </div>
      <div class="col-sm-1"><a href="javascript:;" class="remove_field">Remove</a></div>
    </div> 
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Sub Title</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_st[]" placeholder="Enter ..." value="">
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Image</label>
      <div class="col-sm-10">
        <input type="file" name="section_new_img[]" data-validation-engine="validate[,custom[validateMIME[image/webp]]]">
        Mime Type: webp, Max image upload size 2 Mb<br>
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Image 2</label>
      <div class="col-sm-10">
        <input type="file" name="section_new_img2[]" data-validation-engine="validate[,custom[validateMIME[image/webp]]]">
        Mime Type: webp, Max image upload size 2 Mb<br>
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Content</label>
      <div class="col-sm-10">
        <textarea class="form-control ckeditor" name="section_new_c[]" placeholder="Enter ..."></textarea>
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Button Text</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_btn_text[]" placeholder="Enter ..." value="">
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Banner Button URL</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_btn_url[]" placeholder="Enter ..." value="">
      </div>
    </div>
  </div>
</div>

<div class="copy type20 d-none"> 
  <div class="sn">   
    <div class="form-group row clearfix">
      <input type="hidden" name="type[]" value="">
      <input type="hidden" name="section_type[]" value="20">
      <input type="hidden" name="section_new_img[]" value="">
      <input type="hidden" name="section_new_img2[]" value="">
      <input type="hidden" name="section_new_c[]" value="">
      <label class="col-sm-2 control-label">Title</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="section_new_t[]" placeholder="Enter ..." value="" required>
      </div>
      <div class="col-sm-1"><a href="javascript:;" class="remove_field">Remove</a></div>
    </div> 
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Location</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_st[]" placeholder="Enter ..." value="">
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Phone</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_btn_text[]" placeholder="Enter ..." value="">
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Email</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_btn_url[]" placeholder="Enter ..." value="">
      </div>
    </div>
    
  </div>
</div>

<div class="copy type21 d-none"> 
  <div class="sn">   
    <div class="form-group row clearfix">
      <input type="hidden" name="type[]" value="">
      <input type="hidden" name="section_type[]" value="21">
      <input type="hidden" name="section_new_st[]" value="">
      <input type="hidden" name="section_new_img2[]" value="">
      <input type="hidden" name="section_new_btn_text[]" value="">
      <input type="hidden" name="section_new_btn_url[]" value="">
      <label class="col-sm-2 control-label">Title</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="section_new_t[]" placeholder="Enter ..." value="" required>
      </div>
      <div class="col-sm-1"><a href="javascript:;" class="remove_field">Remove</a></div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Image</label>
      <div class="col-sm-10">
        <input type="file" name="section_new_img[]" data-validation-engine="validate[,custom[validateMIME[image/webp]]]">
        Mime Type: webp, Max image upload size 2 Mb<br>
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Content</label>
      <div class="col-sm-10">
        <textarea class="form-control ckeditor" name="section_new_c[]" placeholder="Enter ..."></textarea>
      </div>
    </div>
  </div>
</div>

<div class="copy type22 d-none"> 
  <div class="sn">    
    <div class="form-group row clearfix">
      <input type="hidden" name="type[]" value="">
      <input type="hidden" name="section_type[]" value="2">
      <input type="hidden" name="section_new_img[]" value="">
      <input type="hidden" name="section_new_img2[]" value="">
      <input type="hidden" name="section_new_st[]" value="">
      <label class="col-sm-2 control-label">Title</label>
      <div class="col-sm-9">
        <input type="text" class="form-control" name="section_new_t[]" placeholder="Enter ..." value="" required>
      </div>
      <div class="col-sm-1"><a href="javascript:;" class="remove_field">Remove</a></div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Content</label>
      <div class="col-sm-10">
        <textarea class="form-control ckeditor" name="section_new_c[]" placeholder="Enter ..."></textarea>
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Button Text</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_btn_text[]" placeholder="Enter ..." value="">
      </div>
    </div>
    <div class="form-group row clearfix">
      <label class="col-sm-2 control-label">Banner Button URL</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="section_new_btn_url[]" placeholder="Enter ..." value="">
      </div>
    </div>
  </div>
</div>

  <div class="copy type23 d-none">
    <div class="sn">    
      <div class="form-group row clearfix">
        <input type="hidden" name="type[]" value="">
        <input type="hidden" name="section_type[]" value="23">
        <input type="hidden" name="section_new_img[]" value="">
        <input type="hidden" name="section_new_img2[]" value="">
        <input type="hidden" name="section_new_st[]" value="">
        <input type="hidden" name="section_new_cat[]" value="">
        <label class="col-sm-2 control-label">Table of contents</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="section_new_t[]" placeholder="Enter ..." value="" required>
        </div>
        <div class="col-sm-1"><a href="javascript:;" class="remove_field">Remove</a></div>
      </div>
      <div class="form-group row clearfix">
        <label class="col-sm-2 control-label">Content</label>
        <div class="col-sm-10">
          <textarea class="form-control ckeditor" name="section_new_c[]" placeholder="Enter ..."></textarea>
        </div>
      </div>
      <div class="form-group row clearfix">
        <label class="col-sm-2 control-label">Parent</label>
        <div class="col-sm-10">
          @if(!empty($parent_extra))
          <select name="section_new_cat[]" class="form-control">
            <option value="">Select</option>
              @foreach ($parent_extra as $key => $value)
                <option value="{{ $value->id }}">{{ $value->title }}</option>
              @endforeach
          @endif
          </select>
        </div>
      </div>
      <div class="form-group row clearfix">
        <label class="col-sm-2 control-label">Image</label>
        <div class="col-sm-10">
          <input type="file" name="section_new_img[]" data-validation-engine="validate[,custom[validateMIME[image/webp]]]">
          Mime Type: webp, Max image upload size 2 Mb<br>
        </div>
      </div>
      <div class="form-group row clearfix">
        <label class="col-sm-2 control-label">Image 2</label>
        <div class="col-sm-10">
          <input type="file" name="section_new_img2[]" data-validation-engine="validate[,custom[validateMIME[image/webp]]]">
          Mime Type: webp, Max image upload size 2 Mb<br>
        </div>
      </div>
      <div class="form-group row clearfix">
        <label class="col-sm-2 control-label">Button Text</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="section_new_btn_text[]" placeholder="Enter ..." value="">
        </div>
      </div>
      <div class="form-group row clearfix">
        <label class="col-sm-2 control-label">Banner Button URL</label>
        <div class="col-sm-10">
          <input type="text" class="form-control" name="section_new_btn_url[]" placeholder="Enter ..." value="">
        </div>
      </div>
    </div>
  </div>
@endsection
@section('more-scripts')
<script type="text/javascript">
$(document).ready(function() {
  var wrapper       = $(".add_section"); //Fields wrapper
  var add_button      = $(".add_section_btn"); //Add button ID

  $(add_button).click(function(e){ //on add input button click
    e.preventDefault();
    sn_section_type = $(".sn_section_type").val();
    sn_type = $(".sn_type").val();
    var html = '';
    if (sn_section_type>0 && sn_type) {
      $(".type"+sn_section_type).find('input[name="type[]"]').val(sn_type);
      html = $(".type"+sn_section_type).html();
    }
    if (html) {
      $(wrapper).append(html); //add input box
    }
    
  });
  
  $(wrapper).on("click",".remove_field", function(e){ //Company click on remove text
    e.preventDefault(); 
    //$(this).parent('div').parent('div').parent('div').remove();
    $(this).parents('.sn').remove();
  })
});
</script>
@stop

