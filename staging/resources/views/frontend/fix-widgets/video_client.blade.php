<div class="seoclientsay-area ourclient">
      <div class="container">
         <div class="headingbox">
            <h3>{!! $video[0]->title !!}</h3>
         </div>

         <div class="seoclientsay-sliderArea">
          <div class="owl-carousel owl-theme seoclientsay-carousel" id="seoclientsay-slider">
            @foreach ($video as $val)
              @if($val->type == 25 )
                <div class="seoclientsay-sliderBox shadow">
                    <div class="seoclientsay-img d-flex"> 
                      @if (file_exists(public_img_path($val->video_img)))
                      <img src="{{ asset('uploads/' . $val->video_img) }}" alt="{{ getImageNameAlt($val->video_img) }}" width="323" height="210"> 
                      @else
                          Image not found
                      @endif
                      <a href="{{ $val->video_url }}" data-fancybox="gallery" data-caption="Caption #1" class="videoView d-flex align-items-center justify-content-center"><i class="fa-brands fa-youtube"></i></a> </div>
                    <div class="seovideotext">
                      <div class="d-flex justify-content-between align-items-center">
                          <h4>{!! $val->title !!}</h4>
                          <div class="seomapicon">
                            @if (file_exists(public_img_path($val->image)))
                            <img src="{{ asset('uploads/' . $val->image) }}" alt="{{ getImageNameAlt($val->image) }}" width="47" height="28">
                            @else
                                Image not found
                            @endif
                          </div>
                      </div>
                      @if($val->sub_title)<h5>{!! $val->sub_title !!}</h5>@endif
                      {!! $val->body !!}
                    </div>
                </div>
              @endif
            @endforeach
          </div>
       </div>
      </div>
    </div>