@extends('layouts.admin')
<style>
    .fixed-width-td {
        width: 150px;
    }
    .img-thumbnail {
        max-width: 100px;
        padding: 8px;
    }
    .badge-custom {
        display: inline-block;
        min-width: 60px;
    }
    .vali{
        font-size:13px;
    }
</style>
@section('content')
@php
$user_status_array = unserialize(User_Status_Array);
@endphp
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{ __('Video Tutorials') }} <a href="{{ url(Admin_Prefix.'seoResultCategory/add') }}" class="btn btn-primary d-none">Add</a></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <!--<li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>-->
            <!--<li class="breadcrumb-item active">{{ __('Video Tutorials') }}</li>-->
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
                  Add
            </button>
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
        <div class="card">
        <div class="px-3 py-4 border-bottom-2">
            <form action="{{ route('updateTitleVideo', $component_content->id) }}" method="POST">
            @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Title</label>
                    <input type="text" class="form-control"  name="title" id="exampleInputEmail1" aria-describedby="emailHelp" value="{!! $component_content->title !!}"> 
                </div>
                <div class="mb-3 d-none">
                    <label for="exampleInputEmail1" class="form-label">Text Body</label>
                    <textarea class="form-control">{!! $component_content->body !!}</textarea> 
                </div>
                <button type="submit" name="submit" name="content_body" class="btn btn-primary">Update Video Tutorials Content</button>
        </form>
        </div>
        </div>
        <!-- /.card -->

      </div>
        <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Listing</h3>
            <div class="card-tools listing_page">
              <form action="">
                <div class="input-group input-group-sm" style="">

                  <input type="text" name="search" class="form-control pull-right" placeholder="Search" value="{{ $search }}">

                  <div class="input-group-btn">
                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                  </div>

                </div>
                
              </form>
            </div>

          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive">

        <table id="example2" class="table table-bordered table-hover dataTable">
          <thead>
            <tr>
                <th>Id</th> 
                <th style="width:130px;">Title</th>  
                <th>Image</th>  
                <th>Video Image </th>  
                <th>Video Url </th> 
                <th>Body</th> 
                <th>Order Display</th>  
                <th>Status</th> 
                <th>Action</th>
            </tr>
          </thead>
          <tbody>

          @if ($lists->count() > 0)
          <?php $row = 1 ; ?>
           @foreach($lists as $keyfirst => $list)
           
            <tr>
                <td>{{ $row++ }}</td>
                <td> 
                    <input type="text" class="form-control" name="title" form="form_{{ $list->id }}" value="{{ $list->title }}">
                </td>
                <td class="vali">
                    <label for="menu_image_{{ $list->id }}" class="upload-icon" style="cursor: pointer;">
                        <i class="fa fa-upload"></i> Upload Image
                    </label>
                    <input type="file" class="form-control d-none" id="menu_image_{{ $list->id }}" name="menu_image" form="form_{{ $list->id }}" data-rule-extension="webp">
                    Mime Type: webp, Max image upload size 2 Mb<br>
                    @if($list->image && \Illuminate\Support\Facades\File::exists(public_path('uploads/' . $list->image)))
                        <img src="{{ asset('uploads/' . $list->image) }}" style="margin: 10px 0 0 0; max-width: 200px; padding: 8px;" class="img-thumbnail bg-light">
                    @endif
                </td> 
                <td class="vali">
                    <label for="video_image_{{ $list->id }}" class="upload-icon" style="cursor: pointer;">
                        <i class="fa fa-upload"></i> Upload Video Image
                    </label>
                    <input type="file" class="form-control d-none" id="video_image_{{ $list->id }}" name="video_image" form="form_{{ $list->id }}" data-rule-extension="webp">
                    Mime Type: webp, Max image upload size 2 Mb<br>
                    @if($list->video_img && \Illuminate\Support\Facades\File::exists(public_path('uploads/' . $list->video_img)))
                        <img src="{{ asset('uploads/' . $list->video_img) }}" style="margin: 10px 0 0 0; max-width: 100px; max-height: 100px; padding: 8px;" class="img-thumbnail bg-light">
                    @endif
                </td>
                <td style="width:200px;">
                   <input type="text" class="form-control" name="video_url" form="form_{{ $list->id }}" value="{{ $list->video_url }}">
                </td> 
                <td>
                   <textarea class="form-control summernote2"  name="content_body" form="form_{{ $list->id }}">{!! $list->body !!}</textarea>
                </td> 
                <td>
                   <input type="number" class="form-control" name="order_display" form="form_{{ $list->id }}" value="{{ $list->order_display }}">
                </td> 
                <td>
                    <span class="badge bg-{{$list->status=='1'?'success':($list->status=='0'?'danger':'warning')}}">{{ ($list->status == '1')?'Active':'Inactive'}}</span>
                </td>
                <td>
                    <form id="form_{{ $list->id }}" action="{{ route('updateDeleteToggleVideo', ['id' => $list->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="_method" id="form_method_{{ $list->id }}" value="PUT">
                        <input type="hidden" name="action" id="form_action_{{ $list->id }}" value="update">
            
                        <button type="button" class="btn btn-success p-1" onclick="submitForm('{{ $list->id }}', 'update')"><i class="bi bi-pencil-square"></i></button>
                        <button type="button" class="btn btn-danger p-1" onclick="submitForm('{{ $list->id }}', 'delete')"><i class="bi bi-trash"></i></button>
                        <button type="button" class="btn {{$list->status!='Active'?'btn-warning':'btn-light'}}  p-1" onclick="submitForm('{{ $list->id }}', 'toggle')"><i class="fa fa-fw fa-lightbulb {{$list->status!=1?'inactive':'text-white'}}"></i></button>
                    </form>
                </td> 
            </tr>
          @endforeach

          @else

          <tr>
            <td colspan="<?php echo count($columnArray)+1;?>" align="middle">No Data Found</td>
          </tr>

          @endif
        </tbody>

      </table>

            {{$lists->appends(request()->input())->links("pagination::bootstrap-4")}}
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->

      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
</section>
<!-- /.content -->


<!-----------------model-----------------> 
<form class="form-control" action="{{ route('storeFormDataVideo_new') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
            
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Our Partner Data Add</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="ूtitle" class="form-label">Title</label>
                        <input type="text" class="form-control" id="title" name="title">
                    </div>
                    <!--<div class="mb-3">-->
                    <!--    <label for="image_url" class="form-label">Image URL</label>-->
                    <!--    <input type="text" class="form-control" id="image_url" name="image_url">-->
                    <!--</div>-->
                    <div class="mb-3">
                        <label for="menu_image" class="form-label">Menu Image</label>
                        <input type="file" class="form-control" id="menu_image" name="menu_image" data-rule-extension="webp">
                    </div>
                    <div class="mb-3">
                        <label for="video_image" class="form-label">Video Image</label>
                        <input type="file" class="form-control" id="video_image" name="video_image" data-rule-extension="webp">
                    </div>
                    <div class="mb-3">
                        <label for="video_url" class="form-label">Video URL</label>
                        <input type="text" class="form-control" id="video_url" name="video_url">
                    </div>
                    <div class="mb-3">
                        <label for="content_body" class="form-label">Content Body</label>
                        <textarea class="form-control summernote" id="content_body" name="content_body"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="order_display" class="form-label">Order Display</label>
                        <input type="number" class="form-control" id="order_display" name="order_display">
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            
        </div>
    </div>
</form>
<!-----------------model-----------------> 
@endsection
@section('more-scripts')
<script>
function submitForm(id, action) {
    const formMethod = document.getElementById(`form_method_${id}`);
    const formAction = document.getElementById(`form_action_${id}`);

    if (action === 'delete') {
        formMethod.value = 'DELETE';
    } else if (action === 'toggle') {
        formMethod.value = 'PATCH';
    } else {
        formMethod.value = 'PUT';
    }

    formAction.value = action;

    document.getElementById(`form_${id}`).submit();
}
</script>
<script>
	$(document).ready(function(){
	    //   summernote
        $('.summernote2').summernote({
            placeholder: 'Write your text here...',
            height: 150, // Change the height as needed, 
            toolbar: [
                ['style', ['style', 'bold', 'italic', 'underline', 'strikethrough', 'clear']],
                ['fonts', ['fontsize', 'fontname']],
                // ['color', ['forecolor', 'backcolor']],
                ['para', ['ul', 'ol', 'paragraph']],
                // ['height', ['height']]
            ]
        });
	});
	</script>
@endsection