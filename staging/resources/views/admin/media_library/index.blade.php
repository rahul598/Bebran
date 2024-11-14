@extends('layouts.admin')
@section('content')
  <!-- Content Header (Blog header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">{{ __('Edit Image Name') }}</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
            <li class="breadcrumb-item active">{{ __('Edit Image Name') }}</li>
          </ol>
        </div>
        <form role="form" action="{{ url(Admin_Prefix.'media-library-images') }}" method="post" enctype="multipart/form-data" class="customValidate">
          @csrf
          <div>
            <input type="text" name="searchImage">
            <button>Search</button>
          </div>
        </form>
      </div>
    </div>
  </div>

<style type="text/css">
  .card-title{font-weight: 600;}
  .control-label{font-weight: 400 !important;}
</style>
  <?php
// print_r($imageFiles);exit;
  ?>
<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row"> 
        <div class="col-md-12">
            <div class="card card-primary">
            <div class="card-header with-border">
                <h3 class="card-title">Edit</h3>
            </div>
                <form role="form" action="{{ url(Admin_Prefix.'update-media-library-images') }}" method="post" enctype="multipart/form-data" class="customValidate">
                  @csrf
                  <div class="card-body">
                      <div class="form-group row clearfix">
                          <div class="col-sm-10">
                            @if($imageName)
                                <?php  $imagePath = '/uploads/' . $imageName; ?>
                                <img src="{{ asset($imagePath) }}" style="margin: 10px 0 0 0;max-width: 200px;">
                                <input type="text" name="image_names[]" value="{{ $imageName }}">
                                <input type="hidden" name="old_image_names[]" value="{{ $imageName }}">
                            @else
                                <?php
                                $mediaData = mediaLibraryData();
                                if (!empty($mediaData['imageFiles'])) {
                                    foreach ($mediaData['imageFiles'] as $imageFileName) {
                                        $imagePath = '/uploads/' . $imageFileName;
                                        ?>
                                        <div class="clearfix">
                                            <img src="{{ asset($imagePath) }}" style="margin: 10px 0 0 0;max-width: 200px;">
                                            <input type="text" name="image_names[]" value="{{ $imageFileName }}">
                                            <input type="hidden" name="old_image_names[]" value="{{ $imageFileName }}">
                                            {{-- <a href="{{ url(Admin_Prefix.'media-library-images/delete/'.$imageFileName) }}" data-confirm="You want to delete this image!">
                                                <i class="fa fa-window-close"></i>
                                            </a>&nbsp; --}}
                                        </div>
                                <?php }
                                } ?>
                            @endif
                          </div>
                      </div>
                      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
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
@stop

