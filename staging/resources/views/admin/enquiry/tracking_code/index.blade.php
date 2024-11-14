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
          <h1 class="m-0 text-dark">{{ __('Certificates') }} <a href="{{ url(Admin_Prefix.'seoResultCategory/add') }}" class="btn btn-primary d-none">Add</a></h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <!--<li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>-->
            <!--<li class="breadcrumb-item active">{{ __('Widgets') }}</li>-->
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
          <!-- /.card-header -->
          <div class="card-body table-responsive">

        <table id="example2" class="table table-bordered table-hover dataTable">
          <thead>
            <tr>
                <th> Id </th>   
                <th> Tracking Code </th> 
                <th> Placement </th>  
                <th> Page Placement </th>  
                <th> Status </th>  
                <th> Action </th>
            </tr>
          </thead>
          <tbody>

          @if ($lists->count() > 0)
          <?php $row = 1 ; ?>
           @foreach($lists as $keyfirst => $list)

           <tr>
                <td>{{ $row++ }}</td>   
                <td>
                   <textarea class="form-control" name="tracking_code" form="form_{{ $list->id }}">{{ $list->tracking_code }}</textarea>
                </td> 
               <td>
                    <select class="form-control" name="placement" form="form_{{ $list->id }}">
                        <option value="head" {{ $list->placement == 'head' ? 'selected' : '' }}>Head</option>
                        <option value="body" {{ $list->placement == 'body' ? 'selected' : '' }}>Body</option>
                    </select>

                </td> 
               <td>
                    <select class="form-control" name="page_placement" form="form_{{ $list->id }}">
                        <option value="" disabled {{ is_null($list->page_placement) ? 'selected' : '' }}>Select Page</option>
                        <option value="lead_form_slider" {{ $list->page_placement == 'lead_form_slider' ? 'selected' : '' }}>Thank Page for Slider Form</option>
                        <option value="other_form_place" {{ $list->page_placement == 'other_form_place' ? 'selected' : '' }}>Thank Page Same for Other Page</option>
                    </select>

                </td> 
                <td>
                    <span class="badge bg-{{$list->status=='1'?'success':($list->status=='0'?'danger':'warning')}}">{{ ($list->status == '1')?'Active':'Inactive'}}</span>
                </td>
                <td>
                        <form id="form_{{ $list->id }}" action="{{ route('updateDeleteToggleTrack', ['id' => $list->id]) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="_method" id="form_method_{{ $list->id }}" value="PUT">
                            <input type="hidden" name="action" id="form_action_{{ $list->id }}" value="update">
                
                            <button type="button" class="p-1 btn btn-success" onclick="submitForm('{{ $list->id }}', 'update')"><i class="bi bi-pencil-square"></i></button>
                            <button type="button" class="p-1 btn btn-danger" onclick="submitForm('{{ $list->id }}', 'delete')"><i class="bi bi-trash"></i></button>
                            <button type="button" class="p-1 btn {{$list->status!=0?'btn-warning':'btn-light'}}" onclick="submitForm('{{ $list->id }}', 'toggle')"><i class="fa fa-fw fa-lightbulb {{$list->status!=1?'inactive':'text-white'}}"></i></button>
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
 <form class="form-control" action="{{ route('storeFormDataTrack') }}" method="POST" enctype="multipart/form-data">
     @csrf
<div class="modal fade" id="modal-lg">
  <div class="modal-dialog modal-lg">
     
          
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Add Tracking Code of Form</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tracking Code</label>
            <input type="text" class="form-control" name="tracking_code">
          </div>  
          <div class="mb-3">
            <label for="exampleInputEmail4" class="form-label">Placement</label>
            <select class="form-control" name="placement">
                <option value="head">Head</option>
                <option value="body">Body</option>
            </select>
          </div>
          <div class="mb-3">
            <label for="exampleInputEmail4" class="form-label">Placement</label>
            <select class="form-control" name="page_placement">
                <option>Select Page</option>
                <option value="lead_form_slider">Thank Page for Slider Form</option>
                <option value="other_form_place">Thank Page Same for Other Page</option>
            </select>
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
        if (confirm('Are you sure you want to delete this data?')) {
            formMethod.value = 'DELETE';
        }
        
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
