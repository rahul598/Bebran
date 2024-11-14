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
            <h1 class="m-0 text-dark">{{ __('Contacts') }}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{url('admin')}}">{{ __('Home') }}</a></li>
              <li class="breadcrumb-item active">{{ __('Contacts') }}</li>
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
                  <div class="d-flex justify-content-start mb-4">
                     <h3 class="card-title">Choose Excel File (csv)</h3>
                    <form action="{{ url(Admin_Prefix.'importData') }}" method="POST" enctype="multipart/form-data" class="d-inline-flex justify-content-start">
                    @csrf
                    <input type="file" name="file" class="ml-3 form-file">
                    <button type="submit" class="btn btn-success">Import</button>
                  </form>
                    <form action="{{ url(Admin_Prefix.'exportTableData') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                     <button class="btn btn-danger ml-2">Export</button>
                  </form>
                    <form action="{{ url(Admin_Prefix.'sampleFile') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                     <button class="btn btn-success ml-2">Sample File</button>
                  </form>
                  </div>
                     <div class="card-tools listing_page w-100">
                        <form action="" class="d-flex justify-content-between">
                           <div class="input-group input-group-sm">
                              <label for="from" class="mr-2 mt-1">From</label>
                              <input type="text" id="from" name="from" autocomplete="off" value="{{ $fromDate ?? '' }}">
                              <label for="to" class="mr-2 ml-2 mt-1">to</label>
                              <input type="text" id="to" name="to" autocomplete="off" value="{{ $toDate ?? '' }}">
                           </div>
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
                  <table id="tableData" class="table table-bordered table-hover dataTable">
                     <thead>
                        <tr>
                           <th>Id</th>
                           <th style="width:200px">Date</th>
                           <th>Source</th>
                           <th>Name</th>
                           <th>Last Name</th>
                           <th>Phone</th>
                           <th>Service</th>
                           <th>Budget</th>
                           <th>Website Url</th>
                           <th>Skype</th>
                           <th>Whatsapp</th>
                           <th>Message</th>
                           <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                        @php $i = 1; @endphp
                        @if ($contact_us->count() > 0)
                            @foreach($contact_us as $list)
                                <tr>
                                    {{-- @php $service_name = DB::table('pages')->where('id', $list->service_name)->whereIn('posttype', ['service', 'pricing'])->first();
                                    @endphp --}}
                                    <td>{{ $i }}</td>
                                    <td style="width: 200px;">{{ $formattedDate = date_convert($list->created_at,8) }}</td>
                                    @if ($list->page_id == 'excel')
                                       <td>excel</td>
                                    @else
                                       @php $page = DB::table('pages')->where('id', $list->page_id)->first(); @endphp
                                       @if($page)
                                       <td>{{ $page->page_name }} {{$list->page_id }}</td>
                                       @endif
                                    @endif
                                    <td>{{ $list->first_name }}</td>
                                    <td>{{ $list->last_name }}</td>
                                    <td>{{ $list->phone }}</td>
                                    @if($list->service_name)
                                        <td>{{ $list->service_name }}</td>
                                    @else
                                        <td></td>
                                    @endif
                                    <td>{{ $list->budget }}</td>
                                    <td>{{ $list->website }}</td>
                                    <td>{{ $list->skype }}</td>
                                    <td>{{ $list->whatsapp }}</td>
                                    <td>{{ $list->message }}</td>
                                    <td>
                                       <a href="{{ url(Admin_Prefix.'delete-enquiry/'.$list->id) }}" class="btn btn-danger" data-confirm="" title="Delete"><i class="fa fa-window-close"></i></a>
                                    </td>
                                </tr>
                                @php $i++; @endphp
                            @endforeach
                        @else
                            <tr>
                                <td colspan="14" style="text-align: center;">No Data Found</td>
                            </tr>
                        @endif
                    </tbody>
                  </table>
                  {{$contact_us->appends(request()->input())->links("pagination::bootstrap-4")}}
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
@endsection

