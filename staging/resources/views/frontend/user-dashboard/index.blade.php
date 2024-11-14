@extends('frontend.user-dashboard.inc.user_app')
<style>
  .bg-white-soft {
    --dashui-bg-opacity: 1;
    background-color: hsla(0, 0%, 100%, .3) !important
  }

  .bg-primary-soft {
    --dashui-bg-opacity: 1;
    background-color: rgba(98, 75, 255, .3) !important
  }

  .bg-secondary-soft {
    --dashui-bg-opacity: 1;
    background-color: rgba(71, 85, 105, .3) !important
  }

  .bg-success-soft {
    --dashui-bg-opacity: 1;
    background-color: rgba(25, 135, 84, .3) !important
  }

  .bg-info-soft {
    --dashui-bg-opacity: 1;
    background-color: rgba(13, 202, 240, .3) !important
  }

  .bg-warning-soft {
    --dashui-bg-opacity: 1;
    background-color: rgba(255, 193, 7, .3) !important
  }

  .bg-danger-soft {
    --dashui-bg-opacity: 1;
    background-color: rgba(220, 53, 69, .3) !important
  }

  .bg-light-soft {
    --dashui-bg-opacity: 1;
    background-color: rgba(241, 245, 249, .3) !important
  }

  .bg-dark-soft {
    --dashui-bg-opacity: 1;
    background-color: rgba(30, 41, 59, .3) !important
  }

  .icon-lg {
    height: 3rem;
    line-height: 3rem;
    width: 3rem;
  }

  .icon-shape {
    align-items: center;
    display: inline-flex;
    justify-content: center;
    text-align: center;
    vertical-align: middle;
  }
</style>
@section('content')
<div class="container-fluid">
  <!--  Row 1 -->
  <div class="row">
    <div class="col-lg-12">
      <div class="row">
        <?php $arr = array('Duration','Plan Name','Service Name'); ?>
        @foreach($plan_details as $val)
        @php
        $service_names = DB::table('pages')
        ->where('id', $val->service_type)
        ->first();
        @endphp
        <div class="col-lg-4">
          <!-- Total Order Count -->
          <div class="card overflow-hidden">
            <div class="card-body p-4">
              <div class="row align-items-center">
                <div class="col-12">
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <span class="fw-semi-bold">Total Order Count</span>
                      <h2 class="mb-0 mt-2 fw-bold">{{ $order_count }}</h2>
                    </div>
                    <div class="icon-shape icon-lg bg-warning-soft text-warning rounded-3">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users icon-sm">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                        <circle cx="9" cy="7" r="4"></circle>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"></path>
                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <!-- Plan Duration -->
          <div class="card overflow-hidden">
            <div class="card-body p-4">
              <div class="row align-items-center">
                <div class="col-12">
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <span class="fw-semi-bold">{{$arr[0]}}</span>
                      <h2 class="mb-0 mt-2 fw-bold">{{ $val->plan_duration }}</h2>
                    </div>
                    <div class="icon-shape icon-lg bg-info-soft text-info rounded-3">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text icon-sm">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                      </svg>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <!-- Plan Name -->
          <div class="card overflow-hidden">
            <div class="card-body p-4">
              <div class="row align-items-center">
                <div class="col-12"> 
                  <div class="d-flex justify-content-between align-items-center">
                    <div>
                      <span class="fw-semi-bold">{{$arr[1]}}</span>
                      <h2 class="mb-0 mt-2 fw-bold">{{ $val->plan_name }}</h2>
                    </div>
                    <div class="icon-shape icon-lg bg-danger-soft text-danger rounded-3">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart icon-sm">
                        <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                      </svg>
                    </div>
                  </div> 
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <!-- Service Name -->
          <div class="card overflow-hidden">
            <div class="card-body p-4">
              <div class="row align-items-center">
                <div class="col-12">
                  <p class="fs-3 mb-2">{{$arr[2]}}</p>
                  <h4 class="fw-semibold mb-3">{{ $service_names->page_name }}</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</div>
@endsection