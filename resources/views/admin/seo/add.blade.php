@extends('layouts.admin')

@section('content')
@php
$page_display_in_array = unserialize(Page_Display_In_Array);
$page_template_array = unserialize(Page_Template_Array);
$display_in=0;
if(old('menu_order')>0)
{
  $menu_order = old('menu_order');
}else{
  $header_menu = get_fields_value_where('pages',"id>0",'menu_order','desc');
  $menu_order = count($header_menu)?$header_menu[0]->menu_order+1:1;
}

$page_section_array = unserialize(Page_Section_Array);
@endphp
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{ __('Add Page') }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Add Page') }}</li>
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
          <form role="form" action="{{ url(Admin_Prefix.'seo-landing/add/') }}"  method="post" enctype="multipart/form-data" class="customValidate">

            @csrf
          
            <input type="hidden" name="id" value="0">
            <input type="hidden" name="posttype" value="seo">

            <div class="card-body">

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Name</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control module_name" name="page_name" id="page_name" placeholder="Enter ..." value="{{ old('page_name') }}" required>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="page_title" id="page_title" placeholder="Enter ..." value="{{ old('page_title') }}">
                </div>
              </div>
              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Slug</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control module_slug" name="slug" id="slug" placeholder="Enter ..." value="{{ old('slug') }}" required>
                </div>
              </div> 
             <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Menu Order</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control required" data-rule-digits="true" name="menu_order" id="menu_order" placeholder="Enter ..." value="{{ $menu_order }}">
                </div>
                <label class="col-sm-2 control-label">Page Template</label>
                <div class="col-sm-2">
                  <select name="page_template" class="form-control">
                    <option value="0">Select Template</option>
                      @foreach($page_template_array as $key => $value)
                      <option value="{!!$key!!}" @if($key==old('page_template')) selected @endif>{!!$value!!}</option>
                      @endforeach
                  </select>
                </div>
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-2">
                  <select name="status" id="status" class="form-control">
                    <option value="1" {!!Request::old('status')=='1'?'selected':''!!}>Active</option>
                    <option value="0" {!!Request::old('status')=='0'?'selected':''!!}>Inactive</option>
                  </select>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Display in</label>
                <div class="col-sm-10">
                @foreach($page_display_in_array as $key => $value)
                  <div class="custom-control custom-radio d-inline">
                    <input class="custom-control-input" type="radio" id="customRadio{{$key}}" name="display_in" value="{{$key}}" @if($key==$display_in) checked @endif>
                    <label for="customRadio{{$key}}" class="custom-control-label">{!! $value !!}</label>
                  </div>
                @endforeach
                </div>
              </div><?php /**/ ?>

              <!-- <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Menu Icon</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control" name="menu_image" data-rule-extension="jpg">
                  Mime Type: webp, Max image upload size 2 Mb<br>
                </div>
              </div> -->

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Meta Title</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" name="meta_title" id="meta_title" placeholder="Enter ..." value="{{ old('meta_title') }}">
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Meta Keyword</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="meta_keyword" placeholder="Enter ...">{{ old('meta_keyword') }}</textarea>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Meta Description</label>
                <div class="col-sm-10">
                  <textarea class="form-control" name="meta_description" placeholder="Enter ...">{{ old('meta_description') }}</textarea>
                </div>
              </div>

              <div class="section_new">
                <div class="form-group row clearfix">
                  <label class="col-sm-2 control-label">Type</label>
                  <div class="col-sm-8">
                    <select name="section_new_type" class="form-control select2 section_new_type">
                      <option value="">Select Type</option>
                      @foreach($page_section_array as $key => $value)
                      <option value="{!! $key !!}">{!! $value !!}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="col-sm-2">
                    <button type="button" class="btn btn-default add_section_btn">Add Section</button>
                  </div> 
                </div> 
                <div class="add_section"></div>              
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


<div class="copy type1 d-none">  
  <div class="sn">   
    <div class="form-group row clearfix">
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

<div class="copy type2 d-none"> 
  <div class="sn">    
    <div class="form-group row clearfix">
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
@endsection


@section('more-scripts')
<script type="text/javascript">
$(document).ready(function() {
  var wrapper       = $(".add_section"); //Fields wrapper
  var add_button      = $(".add_section_btn"); //Add button ID

  $(add_button).click(function(e){ //on add input button click
    e.preventDefault();
    section_new_type = $(".section_new_type").val();
    var html = '';
    if (section_new_type>0) {
      html = $(".type"+section_new_type).html();
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



