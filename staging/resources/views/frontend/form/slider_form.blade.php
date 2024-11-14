  <!-- Desktop Banner -->
  <div class="service-inner-banner desktop position-relative" style="background-image: url({{ asset('uploads/'.$image) }});">
      <div class="banner-textbox">
          <div class="container">
            <div class="titlebox-banner">
              @if(!empty($first_body))
              {!! $first_body !!}
              @endif
            </div>
          </div>
        </div>
    <div class="container">
      <div class="service-inner-body d-flex justify-content-end align-items-center">
        <div class="bannerForm">
          <form method="post" action="{{ url('service-form') }}" class="slider_from" id="slider_from" autocomplete="off">
            @csrf
            @if (session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            @endif
            <div class="form">
              <input type="hidden" name="page_id" class="form-control" value="{{ $page_id }}">
              <input type="hidden" name="form_identity" class="form-control" value="slider_form">
              <input type="hidden" name="number_new" class="form-control number_new" value="">
              <h4>{!! $title !!}</h4>
              <div class="form-group">
                <div class="icon"><i class="fa-solid fa-user"></i></div>
                <input type="text" class="form-control" name="name" placeholder="Full name *" required>
                @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
              </div>
              <div class="form-group">
                <div class="icon d-none"><i class="fa-solid fa-phone"></i></div>
                <input type="number" class="form-control mobile_code" id="mobile_code" name="phone" oninput="if (this.value.length > 10) { this.value = this.value.slice(0, 10); }" placeholder="Mobile Number *" required value="">
                @if ($errors->has('phone'))
                <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
              </div>
              <div class="form-group FormSelect">
                <div class="icon"><i class="fa-solid fa-gear"></i></div>
                <select class="form-control" name="serviceName">
                  <option>Select Service</option>
                  @foreach ($allServiceData as $key=>$value)
                    <option value="{{ $value->page_name }}">{{ $value->page_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <div class="icon"><i class="fa-solid fa-tag"></i></div>
                <input type="number" class="form-control" name="budget" placeholder="Budget *">
                @if ($errors->has('budget'))
                <span class="text-danger">{{ $errors->first('budget') }}</span>
                @endif
              </div>
              <div class="form-group">
                <div class="icon"><i class="fa-solid fa-link"></i></div>
                <input type="text" class="form-control" name="website_url" placeholder="Website url">
                @if ($errors->has('website_url'))
                <span class="text-danger">{{ $errors->first('website_url') }}</span>
                @endif
              </div>
              <div class="captcha_box mb-2">
                <div id="html_element" ></div>
                @if ($errors->has('g-recaptcha-response'))
                <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                @elseif ($errors->has('recaptcha_validate'))
                <span class="text-danger">{{ $errors->first('recaptcha_validate') }}</span>
                @endif
              </div>
              <button type="submit" class="btn-primary w-100">{{ $btn_text }}</button>
            </div>
          </form>
        </div> 
      </div>
    </div>
  </div>

   <!--Mobile Banner -->
  <div class="service-inner-banner mobaile">
    <div class="container">
      <div class="service-inner-body d-md-flex justify-content-end align-items-center"> 
        <div class="bannerForm">
          <form method="post" action="{{ url('service-form') }}" autocomplete="off">
            @csrf
            @if (session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
            @endif
            <div class="form">
              <input type="hidden" name="page_id" class="form-control" value="{{ $page_id }}">
              <input type="hidden" name="form_identity" class="form-control" value="slider_form">
              <h4>{!! $title !!}</h4>
              <div class="form-group">
                <div class="icon"><i class="fa-solid fa-user"></i></div>
                <input type="text" class="form-control" name="name" placeholder="Full name *" required>
                @if ($errors->has('name'))
                <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
              </div>
              <div class="form-group">
                <div class="icon"><i class="fa-solid fa-phone"></i></div>
                <input type="number" class="form-control" name="phone" oninput="if (this.value.length > 10) { this.value = this.value.slice(0, 10); }" placeholder="Mobile Number *" required>
                @if ($errors->has('phone'))
                <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
              </div>
              <div class="form-group FormSelect">
                <div class="icon"><i class="fa-solid fa-gear"></i></div>
                <select class="form-control" name="serviceName">
                  <option>Select Service</option>
                  @foreach ($allServiceData as $key=>$value)
                    <option value="{{ $value->page_name }}">{{ $value->page_name }}</option>
                  @endforeach
                </select>
              </div>
              <div class="form-group">
                <div class="icon"><i class="fa-solid fa-tag"></i></div>
                <input type="number" class="form-control" name="budget" placeholder="Budget *">
                @if ($errors->has('budget'))
                <span class="text-danger">{{ $errors->first('budget') }}</span>
                @endif
              </div>
              <div class="form-group">
                <div class="icon"><i class="fa-solid fa-link"></i></div>
                <input type="text" class="form-control" name="website_url" placeholder="Website url">
                @if ($errors->has('website_url'))
                <span class="text-danger">{{ $errors->first('website_url') }}</span>
                @endif
              </div>
              <div class="captcha_box mb-2">
                <div id="discreetPuzzle" class="mt-2"></div>
                @if ($errors->has('g-recaptcha-response'))
                <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                @elseif ($errors->has('recaptcha_validate'))
                <span class="text-danger">{{ $errors->first('recaptcha_validate') }}</span>
                @endif
              </div>
              <button type="submit" class="btn-primary w-100">{{ $btn_text }}</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>  