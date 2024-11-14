@extends('layouts.admin')
@section('content')
  <!-- Content Header (Blog header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{ __('Add Packages Feature') }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Add Packages Feature') }}</li>
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
          <form role="form" action="{{ url(Admin_Prefix.'feature/add/') }}"  method="post" enctype="multipart/form-data" class="customValidate">
            @csrf
            <div class="card-body">

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Pages</label>
                <div class="col-sm-10">
                  <select class="form-control" name="page_id" id="page_id" required onchange="get_data_feature()">
                    <option value="0" selected disabled>Select a option</option>
                    @foreach($all_pages as $pages)
                      <option value="{{ $pages->id }}" @if($pages->id == old('page_id')){{ 'selected' }}@endif >{{ $pages->page_name }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Category</label>
                <div class="col-sm-10">
                  <select class="form-control" name="category_id" id="category_id" required onchange="get_data_feature()">
                    @foreach($package_category as $category)
                      <option value="{{ $category->id }}" @if($category->id == old('category_id')){{ 'selected' }}@endif >{{ $category->title }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

              <div class="add_section"></div>             

              {{-- <div class="form-group row clearfix">
                <label class="col-sm-2 control-label">Status</label>
                <div class="col-sm-10">
                  <select name="status" id="status" class="form-control">
                    <option value="1" {!!Request::old('status')=='1'?'selected':''!!}>Active</option>
                    <option value="0" {!!Request::old('status')=='0'?'selected':''!!}>Inactive</option>
                  </select>
                </div>
              </div> --}}
            </div>
            <!-- /.card-body -->

            <div class="card-footer" id="card-footer" style="display:none">
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
  function get_data_feature() {
  let page_id = $('#page_id').val();
  let category_id = $('#category_id').val();
  let csrf_token = $('meta[name=csrf-token]').attr('content'); 
  $.ajax({
    type: 'POST',
    url: '<?php echo url("/") ?>/admin/get_data_feature', // Properly embed PHP code in JavaScript
    headers: { 'X-CSRF-TOKEN': csrf_token },
    data: { page_id: page_id, category_id : category_id },
    dataType: 'json',
    success: function(resp) {
      //console.log(resp);
      $('.add_section').empty();
      $('.add_section').html(resp.html);
      $('#card-footer').show();
    },
});
}
</script>
<script>
    function changeVal(subtitleId, key) {
        // Get the checkbox element
        var checkbox = document.getElementById('switch_' + subtitleId + '_' + key);

        // Check if the checkbox is checked
        if (checkbox.checked) {
            // If checked, set the value to 0
            checkbox.value = 1;
        } else {
            // If not checked, set the value to 1
            checkbox.value = 0;
        }

        // You can also do additional actions here if needed

        // For debugging, you can log the current value
        console.log('New value for switch_' + subtitleId + '_' + key + ': ' + checkbox.value);
    }
</script>
@stop


