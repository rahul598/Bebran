<div class="professional" style="background:url({{ asset('frontend/images/professionalbg.webp') }}) center no-repeat fixed">
      <div class="container">
        <div class="headingbox text-center">
          <h2>{!! $certificate[0]->title !!}</h2>
        </div>
        {!! $certificate[0]->body !!}
      </div>
    </div>
    <div class="marklogo">
    <div class="container">
        <div id="digitacarousel" class="owl-carousel digita-carousel">
            @foreach ($certificate as $val)
            @if ($val->type == 8)
                @if ($val->embaded_code == NULL)
                    
                        <a href="{{($val->btn_url != null && $val->btn_url != "")?$val->btn_url:''}}" target="_blank"><figure><img src="{{ asset('uploads/' . $val->image) }}" alt="{{ getImageNameAlt($val->image) }}" width="120"></figure></a>
                    
                @else
                    <figure>{!! $val->embaded_code !!}</figure>
                @endif
                @endif
            @endforeach
        </div>
    </div>
</div>
