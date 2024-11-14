@extends('layouts.admin')

@section('content')
@php
$user_status_array = unserialize(User_Status_Array);
@endphp
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">{{ __('Our Work Featured') }} 
                    <a href="{{ url(Admin_Prefix.'seoResultCategory/add') }}" class="btn btn-primary d-none">Add</a>
                </h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <!--<li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>-->
                    <!--<li class="breadcrumb-item active">{{ __('Our Work Featured') }}</li>-->
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
                        <form action="{{ route('updateTitleFeatured', $component_content->id) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" id="exampleInputEmail1" aria-describedby="emailHelp" value="{!! $component_content->title !!}"> 
                            </div>
                            <div class="mb-3 d-none">
                                <label for="exampleInputEmail1" class="form-label">Text Body</label>
                                <textarea class="form-control"  name="content_body">{!! $component_content->body !!}</textarea> 
                            </div>
                            <button type="submit" name="submit" class="btn btn-primary">Update Work Featured Content</button>
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
                                <div class="input-group input-group-sm">
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
                                    <th style="width:250px;">Image </th>  
                                    <th>Image Url </th> 
                                    <th>Order Display</th>  
                                    <th>Status</th> 
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($lists->count() > 0)
                                <?php $row = 1; ?>
                                @foreach($lists as $keyfirst => $list)
                                <tr>
                                   <td>{{ $row++ }}</td>
                                    <td>
                                        <label for="menu_image_{{ $list->id }}" class="upload-icon" style="cursor: pointer;">
                                            <i class="fa fa-upload"></i> Upload Image
                                        </label>
                                        <input type="file" class="form-control d-none" id="menu_image_{{ $list->id }}" name="menu_image" form="form_{{ $list->id }}" data-rule-extension="webp">
                                        Mime Type: webp, Max image upload size 2 Mb<br>
                                        @if ($list->image && \Illuminate\Support\Facades\File::exists(public_path('uploads/' . $list->image)))
                                            <img src="{{ asset('uploads/' . $list->image) }}" style="margin: 10px 0 0 0; max-width: 150px; padding: 8px;" class="img-thumbnail bg-light">
                                        @endif
                                    </td>

                                    <td>
                                       <input type="text" class="form-control" name="image_url" form="form_{{ $list->id }}" value="{{ $list->btn_url }}">
                                    </td> 
                                    <td>
                                       <input type="number" class="form-control" name="order_display" form="form_{{ $list->id }}" value="{{ $list->order_display }}">
                                    </td> 
                                    <td>
                                        <span class="badge bg-{{$list->status=='1'?'success':($list->status=='0'?'danger':'warning')}}">{{ ($list->status == '1')?'Active':'Inactive'}}</span>
                                    </td>
                                    <td>
                                        <form id="form_{{ $list->id }}" action="{{ route('updateDeleteToggleFeatured', ['id' => $list->id]) }}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" name="_method" id="form_method_{{ $list->id }}" value="PUT">
                                            <input type="hidden" name="action" id="form_action_{{ $list->id }}" value="update">
                                
                                            <button type="button" class="p-1 btn btn-success" onclick="submitForm('{{ $list->id }}', 'update')"><i class="bi bi-pencil-square"></i></button>
                                            <button type="button" class="p-1 btn btn-danger" onclick="submitForm('{{ $list->id }}', 'delete')"><i class="bi bi-trash"></i></button>
                                            <button type="button" class="p-1 btn {{$list->status!='Active'?'btn-warning':'btn-info'}}" onclick="submitForm('{{ $list->id }}', 'toggle')"><i class="fa fa-fw fa-lightbulb {{$list->status!=1?'inactive':''}}"></i></button>
                                        </form>
                                    </td> 
                              </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="{{ count($columnArray) + 1 }}" align="middle">No Data Found</td>
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
 <form class="form-control" action="{{ route('storeFormDataFeatured') }}" method="POST" enctype="multipart/form-data">
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
            <label for="exampleInputEmail1" class="form-label">Image Url</label>
            <input type="text" class="form-control" name="image_url">
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail2" class="form-label">Image</label>
            <input type="file" class="form-control" name="menu_image">
          </div> 
          <div class="mb-3">
            <label for="exampleInputEmail4" class="form-label">Order Display</label>
            <input type="number" class="form-control" name="order_display"  >
          </div>
        
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
    </div>
    
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
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
@endsection