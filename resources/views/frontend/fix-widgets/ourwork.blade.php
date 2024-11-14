<div class="ourwork">
      <div class="container">
        <div class="headingbox text-center ">
          <h3>{!! $our_work_featured[0]->title !!}</h3>
        </div>
        <div id="workcarousel" class="owl-carousel work-carousel">
          @php $countNum = 0; @endphp
            @foreach ($our_work_featured as $key=>$value)
            @if($value->type ==22 )
                <a href="{{($value->btn_url != null && $value->btn_url != "")?$value->btn_url:''}}" target="_blank">
                  <figure><img src="{{ asset('uploads/'.$value->image) }}" alt="{{ getImageNameAlt($value->image) }}" class=" " width="100" ></figure>
                </a>
            @endif
          @endforeach
        </div>
      </div>
    </div>