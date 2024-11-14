@php 
    $people = array(33, 89, 92); 
    $slug = ['design-development', 'digital-marketing-services'];
@endphp

<div class="{{ (in_array($page->parent_id, $people) || in_array($page->slug, $slug)) ? 'bg-white' : 'tooluse' }}">


        <div class="container">
        <div class="headingbox text-center">
          <h2>{!! $tools_we_use[0]->title !!}</h2>
        </div>
        {!! $tools_we_use[0]->body !!}
        <div class="owl-carousel tool-carousel">
          @foreach ($tools_we_use as $val)
          
            @if($val->type == 12)
                <a href="{{($val->btn_url != null && $val->btn_url != "")?$val->btn_url:''}}" target="_blank"><figure><img src="{{ asset('uploads/'.$val->image) }}" alt="{{ getImageNameAlt($val->image) }}" class="oj_contain" width="170" height="52"></figure></a>
            @endif
          @endforeach
        </div>
      </div>
    </div>