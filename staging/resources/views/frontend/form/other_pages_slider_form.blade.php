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
                <h4>{!! $second_title !!} </h4>
                <div class="form-group">
                  <div class="icon"><i class="fa-solid fa-user"></i></div>
                  <input type="text" class="form-control" name="name" placeholder="Full name *" >
                  @if ($errors->has('name'))
                  <span class="text-danger">{{ $errors->first('name') }}</span>
                  @endif
                </div>
               
                <div class="form-group">
                  <!--<div class="icon"><i class="fa-solid fa-phone"></i></div>-->
                  <!--<input type="number" class="form-control" name="phone" oninput="if (this.value.length > 10) { this.value = this.value.slice(0, 10); }" placeholder="Mobile Number *" >-->
                  <input type="number" class="form-control mobile_code" id="mobile_code" name="phone" oninput="if (this.value.length > 10) { this.value = this.value.slice(0, 10); }" placeholder="Mobile Number *" required>
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
                  <input type="number" class="form-control" name="budget" placeholder="Budget *" >
                  @if ($errors->has('budget'))
                  <span class="text-danger">{{ $errors->first('budget') }}</span>
                  @endif
                </div>
                <div class="form-group">
                  <div class="icon"><i class="fa-solid fa-link"></i></div>
                  <input type="text" class="form-control" name="website_url" placeholder="Website url" >
                  @if ($errors->has('website_url'))
                  <span class="text-danger">{{ $errors->first('website_url') }}</span>
                  @endif
                </div>
                <div class="captcha_box mb-2">
                  <!-- <img src="{{ asset('frontend/images/be-bran-captchanew.webp ')}}" alt="be-bran-captchanew"> -->
                <div id="html_element"></div>
                          @if ($errors->has('g-recaptcha-response'))
                          <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
  
                          @elseif ($errors->has('recaptcha_validate'))
                          <span class="text-danger">{{ $errors->first('recaptcha_validate') }}</span>
                          @endif
                </div>
                <button type="submit" class="btn-primary w-100">{{ $second_btn_text }}</button>
              </div>
            </form>
          </div>