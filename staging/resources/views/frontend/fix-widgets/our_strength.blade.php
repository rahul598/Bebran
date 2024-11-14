<div class="strength" style="background:url({{ asset('frontend/images/strengthbg.webp') }}) center no-repeat fixed">
      <div class="container">
        <div class="headingbox text-center">
          <h3>{!! $our_strength[6]->title !!}</h3>
        </div>
        <ul>
          @foreach ($our_strength as $key => $val)  
            @if ($key != 6)
                <li>
                    <div class="ourbox">
                        <div class="ourimg" style="margin-bottom: 20px;">
                            <img src="{{ asset('uploads/'.$val->image) }}" alt="{{ getImageNameAlt($val->image) }}" width="60">
                        </div>
                        <h4>{{ $val->title }}</h4>
                        <h6>{{ $val->sub_title }}</h6>
                    </div>
                </li> 
            @endif
        @endforeach

        </ul>
      </div>
    </div>