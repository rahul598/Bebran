<div class="tooluse ourPartners diff_color bg_acc_new">
    <div class="container">
      <div class="headingbox text-center">
        <h2>{!! $our_partners[0]->title !!}</h2>
      </div>
      <div id="toolcarousel1" class="owl-carousel tool-carousel">
        @foreach ($our_partners as $key => $value)
          @if ($value->type == 17)
            <a href="{{($value->btn_url != null && $value->btn_url != "")?$value->btn_url:''}}" target="_blank"><figure><img src="{{ asset('uploads/'.$value->image) }}" alt="{{ getImageNameAlt($value->image) }}"></figure></a>
          @endif
        @endforeach
      </div>
    </div>
  </div>
