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
            <input type="hidden" name="country_code" class="form-control country_code" value="">
            <style>
                .slider_from_h1{
                    text-transform: uppercase;
                    font-size: 24px;
                    font-weight: 700;
                    color: #fff;
                    margin: 0 0 15px;
                }
            </style>
            <p class="slider_from_h1">{!! $second_title !!}</p>

            <!-- Full Name -->
            <label for="name" class="small text-white label_font d-flex">Full Name<span class="text-danger">*<span></label>
            <div class="form-group">
                <div class="icon"><i class="fa-solid fa-user"></i></div>
                <input type="text" id="name" class="form-control" name="name" placeholder="Full name *" >
                @if ($errors->has('name'))
                    <span class="text-danger">{{ $errors->first('name') }}</span>
                @endif
            </div>

            <!-- Phone -->
            <label for="phone" class="small text-white label_font d-flex">Phone<span class="text-danger">*<span></label>
            <div class="form-group">
                <input type="number" class="form-control mobile_code" id="phone" name="phone" oninput="if (this.value.length > 10) { this.value = this.value.slice(0, 10); }" placeholder="Mobile Number *" required>
                @if ($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
            </div>

            <!-- Service -->
            <label for="serviceName" class="small text-white label_font d-flex">Service<span class="text-danger">*<span></label>
            <div class="form-group FormSelect">
                <div class="icon"><i class="fa-solid fa-gear"></i></div>
                <select class="form-control" name="serviceName" id="serviceName">
                    <option>Select Service</option>
                    @foreach ($allServiceData as $key=>$value)
                        <option value="{{ $value->page_name }}">{{ $value->page_name }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Budget -->
            <label for="budget" class="small text-white label_font d-flex">Budget<span class="text-danger">*<span></label>
            <div class="form-group">
                <div class="icon"><i class="fa-solid fa-tag"></i></div>
                <input type="number" id="budget" class="form-control" name="budget" placeholder="Budget *" >
                @if ($errors->has('budget'))
                    <span class="text-danger">{{ $errors->first('budget') }}</span>
                @endif
            </div>

            <!-- Website URL -->
            <label for="website_url" class="small text-white label_font d-flex">Website Url<span class="text-danger">*<span></label>
            <div class="form-group">
                <div class="icon"><i class="fa-solid fa-link"></i></div>
                <input type="text" id="website_url" class="form-control" name="website_url" placeholder="Website url" >
                @if ($errors->has('website_url'))
                    <span class="text-danger">{{ $errors->first('website_url') }}</span>
                @endif
            </div>

            <!-- Captcha -->
            <div class="captcha_box mb-2">
                <div id="html_element"></div>
                @if ($errors->has('g-recaptcha-response'))
                    <span class="text-danger">{{ $errors->first('g-recaptcha-response') }}</span>
                @elseif ($errors->has('recaptcha_validate'))
                    <span class="text-danger">{{ $errors->first('recaptcha_validate') }}</span>
                @endif
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn-primary w-100 touch-target2">{{ $second_btn_text }}</button>
        </div>
    </form>
</div>
