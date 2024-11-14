@extends('layouts.admin')
<style>
.btn-light {
    background-color: #06D001 !important;
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
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-lg">
              Add
            </button> 
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Seo Result Categories') }}</li>
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
              <th>Name</th> 
              <th>Slug</th> 
              <th>Status</th> 
              <th>Date</th> 
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
                <input type="text" class="form-control" name="name" form="form_{{ $list->id }}" value="{{ $list->name }}">
            </td> 
            <td>
                <input type="text" class="form-control" name="slug" form="form_{{ $list->id }}" value="{{ $list->slug }}">
            </td> 
            <td>
                <span class="badge bg-{{$list->status=='1'?'success':($list->status=='0'?'danger':'warning')}}">{{ ($list->status == '1')?'Active':'Inactive'}}</span>
            </td>   
            <td>{!! date_convert($list->created_at,3) !!}</td> 
        
            <td>
                <form id="form_{{ $list->id }}" action="{{ route('updateDeleteToggleresult', ['id' => $list->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="_method" id="form_method_{{ $list->id }}" value="PUT">
                    <input type="hidden" name="action" id="form_action_{{ $list->id }}" value="update">
        
                    <button type="button" class="btn btn-success p-1" onclick="submitForm('{{ $list->id }}', 'update')" title="Save"><i class="bi bi-pencil-square"></i></button>
                    <button type="button" class="btn {{$list->status != '1'?'btn-warning':'btn-light text-white'}} p-1 " onclick="submitForm('{{ $list->id }}', 'toggle')" title="Toggle Status">
                        <i class="fa fa-fw fa-lightbulb {{ $list->status != 1 ? 'inactive' : '' }}"></i>
                    </button>
                    <button type="button" class="btn btn-danger p-1" onclick="submitForm('{{ $list->id }}', 'delete')" title="Delete"><i class="bi bi-trash"></i></button>
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
 <form class="form-control" action="{{ url(Admin_Prefix.'seoResultCategory/add/') }}" method="POST" enctype="multipart/form-data">
     @csrf
<div class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-lg">
     
          
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add New Category</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
            <div class="form-group row clearfix">
            <label class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control module_name" name="name" placeholder="Enter ..." value="{{ Request::old('name') }}" required>
            </div>
          </div>

          <div class="form-group row clearfix">
            <label class="col-sm-2 control-label">Slug</label>
            <div class="col-sm-10">
              <input type="text" class="form-control module_slug" name="slug" id="slug" placeholder="Enter ..." value="{{ old('slug') }}" required>
            </div>
          </div>
                <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10">
                    <select name="status" id="status" class="form-control">
                        <option value="1" {!!Request::old('status')=='1'?'selected':''!!}>Active</option>
                        <option value="0" {!!Request::old('status')=='0'?'selected':''!!}>Inactive</option>
                    </select>
                </div>
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