<div class="strength" style="background:url({{ asset('frontend/images/strengthbg.webp') }}) center no-repeat fixed">
    
      <div class="container">
        <div class="headingbox text-center">
          <div class="toolssection_h3 text-white belowLine">{!! $our_strength[6]->title !!}</div>
        </div>
        <ul>
          @foreach ($our_strength as $key => $val)  
            @if ($key != 6)
                <li>
                    <div class="ourbox">
                        <div class="ourimg" style="margin-bottom: 20px;">
                            <img src="{{ asset('uploads/'.$val->image) }}" alt="{{ getImageNameAlt($val->image) }}" width="60">
                        </div>
                        <div class="strength_h4">{{ $val->title }}</div>
                        <div style="font-size: 15px;font-weight: 400;color: #fff;">{{ $val->sub_title }}</div>
                    </div>
                </li> 
            @endif
        @endforeach

        </ul>
      </div>
    </div>