<div class="tooluse ourPartners diff_color">
    <div class="container">
      <div class="headingbox text-center">
        <h2>{!! $our_partners[0]->title !!}</h2>
      </div>
      <div id="toolcarousel1" class="owl-carousel tool-carousel">
        @foreach ($our_partners as $key => $value)
          @if ($value->type == 17)
            <figure><img src="{{ asset('uploads/'.$value->image) }}" alt="{{ getImageNameAlt($value->image) }}"></figure>
          @endif
        @endforeach
      </div>
    </div>
  </div>
