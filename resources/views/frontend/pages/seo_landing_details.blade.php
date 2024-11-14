@extends('layouts.app')
@section('content')
@if ($extra_data->isNotEmpty())
    @foreach ($extra_data as $val)
        @php $page_id = $val->page_id; @endphp
        @php
            switch ($val->type) {
            case 1:
                $first_image                 = $val->image;
            break;
            case 2:
                $second_link                 = $val->link;
                $second_title                = $val->title;
                $second_founder              = $val->founder;
                $second_business_category    = $val->business_category;
                $second_competition          = $val->competition;
                $second_seo_package          = $val->seo_package;
                $second_seo_image            = $val->image;
            break;
            case 3:
                $third_title                 = $val->title;
            break;
            case 4:
                $fourth_body                 = $val->body;
            break;
            case 6:
                $sixth_title                 = $val->title;
            break;
            case 7:
                $seventh_title               = $val->title;
                $seventh_sub_title           = $val->sub_title;
            break;
            case 8:
                $eight_content               = $val->body;
            break;
            case 9:
                $ninth_title                 = $val->title;
                $ninth_sub_title             = $val->sub_title;
            break;
            case 10:
                $tenth_title                 = $val->title;
                $tenth_image                 = $val->image;
            break;
            case 11:
                $eleven_title                = $val->title;
                $eleven_image                = $val->image;
            break;
            case 12:
                $twelve_content              = $val->body;

            break;
            case 13:
                $thirteen_title              = $val->title;
            break;
            }
        @endphp
    @endforeach
@endif

@if ($seo_extra_data->isNotEmpty())
    @foreach ($seo_extra_data as $val)
        @php $page_id = $val->page_id; @endphp
        @php
            switch ($val->type) {
            case 1:
                $seo_one_title                 = $val->title;
            break;
            case 3:
                $seo_third_title                 = $val->title;
            break;
            case 5:
                $seo_five_title                 = $val->title;
            break;
            case 5:
                $seo_five_title                 = $val->title;
            break;
            case 8:
                $seo_eight_title                 = $val->title;
            break;
            }
        @endphp
    @endforeach
@endif
<style>
@media(max-width:767px){
    .nammaticon{
        height: 80px !important;
        min-width: 80px !important;
        margin:auto !important;
        margin-bottom:20px !important;
    }
    .nammatleft_new .nammabody{
        padding-left:1rem;
        padding-right:1rem;
    }
    .nammatleft_new{
        padding-top:20px;
    } 
}
@media (max-width: 639.98px) {
    .nammaticon{
        height: 80px !important;
        min-width: 80px !important;
        margin:auto !important;
        margin-bottom:20px !important;
    }
}
@media(max-width:420px){
    .nammaticon{
        height: 80px !important;
        min-width: 80px !important;
        margin:auto !important;
        margin-bottom:20px !important;
        margin-left: 5% !important;
        margin-right: 5% !important;
    }
    .catadd{
        width: 180px;
    }
    .child_div{
        margin-left: 15%;
    }
}
.overviewlefttable_one {
    height: 1538px;
}
</style>
<div class="bannersection">
   <div class="container">
      <div class="bannerimg">
         @if(!empty($first_image))
            @if (file_exists(public_img_path($first_image)))
            <img src="{{ asset('uploads/' . $first_image) }}" alt="{{ getImageNameAlt($first_image) }}">
            @else Image not found @endif
         @endif
      </div>
   </div>
</div>
<!-- inner seolanding area start -->
<div class="nammatrip">
   <div class="container">
      <div class="row d-flex align-items-center justify-content-center nammaarea">
         <div class="col-lg-6 mb-3">
            <div class="nammatleft nammatleft_new">
               <div class="d-flex align-items-center">
                  <div class="nammaticon">
                     @if(!empty($second_seo_image))
                        @if (file_exists(public_img_path($second_seo_image)))
                        <img src="{{ asset('uploads/' . $second_seo_image) }}" alt="{{ getImageNameAlt($second_seo_image) }}">
                        @else Image not found @endif
                     @endif
                  </div>
                    <div class="nammabody">
                        <div class="child_div">
                            <h4>@if(!empty($second_title)){{ $second_title }}@endif<span><a>@if(!empty($second_link)){{ $second_link }}@endif</a></span></h4>
                            <h6>Founder : @if(!empty($second_founder)){{ $second_founder }}@endif</h6>
                            <h6>Target Location :
                                @if(!empty($page->bannerimage))
                                   @if (file_exists(public_img_path($page->bannerimage)))
                                   <img src="{{ asset('uploads/' . $page->bannerimage) }}" alt="{{ getImageNameAlt($page->bannerimage) }}">
                                   @else Image not found @endif
                                @endif
                                @if(!empty($page->bannertext)){{ $page->bannertext }}@endif
                            </h6>
                        </div>
                    </div>
               </div>
            </div>
         </div>
         <div class="col-lg-6">
            <div class="nammatright">
               <table>
                  <tr>
                     <th class="catadd"><b>Business catagory</b></th>
                     <th> :  @if(!empty($second_business_category)){{ $second_business_category }}@endif</th>
                  </tr>
                  <tr>
                     <th class="catadd"><b>Competition</b></th>
                     <th>: @if(!empty($second_competition)){{ $second_competition }}@endif</th>
                  </tr>
                  <tr>
                     <th class="catadd"><b>SEO package</b></th>
                     <th>: @if(!empty($second_seo_package)){{ $second_seo_package }}@endif</th>
                  </tr>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- inner seolanding area stop -->
<!-- inner seolanding area start -->
<div class="seolanding-area results">
   <div class="container">
      <div class="reultsbox shadow">
         <div class="headingbox">
            <h3>@if(!empty($third_title)){!! $third_title !!}@endif</h3>
         </div>
         @php $result_overview = json_decode($page->result_overview_csv); @endphp
          
         @if(!empty($result_overview))
         <table> 
        	<tbody>
        	    <tr>
        			<th>KPI</th> 
        			<th>Day 0</th> 
        			<th>Now</th> 
        		</tr> 
        		
        	    @foreach($result_overview as $key_result => $val_result) 
        	        <tr>
                        @if(!empty($val_result))
                            <th>{{$val_result->KPI}}</th> 
                            <th>{{$val_result->Day}}</th> 
                            <th>{{$val_result->Now}}</th> 
                        @else
                            <th colspan="3">Data is incorrect or missing</th>
                        @endif
        	        </tr>
        		@endforeach 
        	</tbody>
        </table>
        @else
         @if(!empty($fourth_body)){!! $fourth_body !!}@endif
        @endif
      </div>
   </div>
</div>

<!-- inner seolanding area stop --> 
<!-- inner seolanding area start -->
<div class="Increment-area" style="background:url({{ asset('frontend/images/detilsbg.webp') }});">
   <div class="container">
      <div class="incrarea">
         @foreach ($extra_data as $val)
         @if($val->type == 5 ) 
         <div class="incrementbox">
            <div class="incrementicon d-none">
                @if (file_exists(public_img_path($val->image)))
                    <img src="{{ asset('uploads/' . $val->image) }}" alt="{{ getImageNameAlt($val->image) }}">
                @else 
                    Image not found 
                @endif
            </div>
            <h4>{!! $val->title !!}</h4>
            <h3>{!! $val->sub_title !!}</h3>
         </div>
         @endif
         @endforeach
      </div>
   </div>
</div>
<!-- inner seolanding area stop --> 
<!-- inner seolanding area start -->
<div class="seolanding-area overview-area">
   <div class="container">
      <div class="headingbox">
         <h3>@if(!empty($sixth_title)){!! $sixth_title !!}@endif</h3>
      </div>
      <div class="row">
         <div class="col-lg-4">
            <div class="overviewleft text-center">
               <h4>@if(!empty($seventh_title)){!! $seventh_title !!}@endif</h4>
               <h6>@if(!empty($seventh_sub_title)){!! $seventh_sub_title !!}@endif</h6>
            </div>
            <div class="overviewlefttable overviewlefttable-first-table overviewlefttable_one ">
               @php $keywords_csv = json_decode($page->keywords_csv); @endphp
                      
                <table>
                    @if(!empty($keywords_csv))
                    <tr>
                        <th class="kay">Keyword</th>
                        <th class="postion">Position</th> 
                    </tr>
                    @foreach($keywords_csv as $key_result => $val_result)
                        <tr>
                            @if(!empty($val_result))
                                <td style="height:14.5pt; vertical-align:bottom; white-space:nowrap; width:48pt !important;">
                                    <span style="font-size:11pt">
                                        <span style="color:black">
                                            <span style="font-family:Calibri,sans-serif">
                                                {{$val_result->Keyword}}
                                            </span>
                                        </span>
                                    </span>
                                </td>
                                <td class="text-center" style="height:14.5pt; vertical-align:bottom; white-space:nowrap; width:28pt !important;vertical-align: middle;">
                                    <span style="font-size:11pt">
                                        <span style="color:black">
                                            <span style="font-family:Calibri,sans-serif">
                                                {{$val_result->Position}}
                                            </span>
                                        </span>
                                    </span>
                                </td>
                            @else
                                <td colspan="2" style="text-align:center;">Data is incorrect or missing</td>
                            @endif
                        </tr>
                    @endforeach
                    @else
                    <tr>
                        <th class="kay">Keyword</th>
                        <th class="postion">Position</th> 
                    </tr>
                    <tr>
                        <td colspan="2">
                            @if(!empty($eight_content)){!! $eight_content !!}@endif
                        </td>
                    </tr>
                    @endif 
                </table>
            </div> 
         </div>
         
         <div class="col-lg-8">
            <div class="overviewleft text-center">
               <h4>@if(!empty($ninth_title)){!! $ninth_title !!}@endif</h4>
               <p>@if(!empty($ninth_sub_title)){!! $ninth_sub_title !!}@endif</p>
            </div>
            <div class="resultimg resultimg1 shadow pb-0">
               <div class="headingbox ">
                  <h3>@if(!empty($tenth_title)){!! $tenth_title !!}@endif</h3>
                  @if(!empty($tenth_image))
                     @if (file_exists(public_img_path($tenth_image)))
                     <img src="{{ asset('uploads/' . $tenth_image) }}" alt="{{ getImageNameAlt($tenth_image) }}">
                     @else Image not found @endif
                  @endif
               </div>
               <div class="headingbox mb-4">
                  <h3>@if(!empty($eleven_title)){!! $eleven_title !!}@endif</h3>
                  @if(!empty($eleven_image))
                     @if (file_exists(public_img_path($eleven_image)))
                     <img src="{{ asset('uploads/' . $eleven_image) }}" alt="{{ getImageNameAlt($eleven_image) }}">
                     @else Image not found @endif
                  @endif
               </div>
            </div>
            <div class="overviewlefttable overviewlefttable-last-table">
                 @php $keyword_growth_csv = json_decode($page->keyword_growth_csv); @endphp
               <table>
                    @if(!empty($keyword_growth_csv))
                      <tr>
                         <th class="kay">Keyword</th>
                         <th class="postion">0 Day Position</th>
                         <th class="postion">Current Position</th> 
                      </tr>
                      @foreach($keyword_growth_csv as $key_result => $val_result)
                        <tr>
                            @if($val_result)
                                <td style="height:14.5pt; vertical-align:bottom; white-space:nowrap; width:48pt !important;">
                                    <span style="font-size:11pt">
                                        <span style="color:black">
                                            <span style="font-family:Calibri,sans-serif">
                                                {{$val_result->Keyword}}
                                            </span>
                                        </span>
                                    </span>
                                </td> 
                                <td class="text-center" style="height:14.5pt; vertical-align:bottom; white-space:nowrap; width:20% !important; vertical-align:middle;">
                                    <span style="font-size:11pt">
                                        <span style="color:black">
                                            <span style="font-family:Calibri,sans-serif">
                                                {{ $val_result->{'Day Position'} }}
                                            </span>
                                        </span>
                                    </span>
                                </td>  
                                <td class="text-center" style="height:14.5pt; vertical-align:bottom; white-space:nowrap; width:20% !important; vertical-align:middle;">
                                    <span style="font-size:11pt">
                                        <span style="color:black">
                                            <span style="font-family:Calibri,sans-serif">
                                                {{ $val_result->{'Current Position'} }}
                                            </span>
                                        </span>
                                    </span>
                                </td>  
                            @else
                                <td colspan="3" style="text-align:center;">Data is incorrect or missing</td>
                            @endif
                        </tr>
                    @endforeach

                    @else
                        <tr>
                            <th class="kay">Keyword</th>
                            <th class="postion">0 Day Position</th>
                            <th class="postion">Current Position</th> 
                        </tr>
                      @if(!empty($twelve_content)){!! $twelve_content !!}@endif
                    @endif 
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- inner seolanding area stop --> 
<!-- inner seolanding area start -->
<div class="seolanding-area results-area">
   <div class="container">
      <div class="headingbox">
         <h3>@if(!empty($thirteen_title)){!! $thirteen_title !!}@endif</h3>
      </div>
      <div class="row">
         @php $counter = 0 @endphp
         @foreach ($extra_data as $val)
         @if ($val->type == 14)
         @if ($counter == 0)
         <div class="col-lg-12">
            <div class="resultimg shadow">
               @if(!empty($val->image))
                  @if (file_exists(public_img_path($val->image)))
                  <img src="{{ asset('uploads/' . $val->image) }}" alt="{{ getImageNameAlt($val->image) }}">
                  @else
                  Image not found
                  @endif
               @endif
            </div>
         </div>
         @php $counter = 1 @endphp
         @else
         <div class="col-lg-6">
            <div class="resultimg resultimg1 shadow ">
               @if (file_exists(public_img_path($val->image)))
               <img src="{{ asset('uploads/' . $val->image) }}" alt="{{ getImageNameAlt($val->image) }}">
               @else
               Image not found
               @endif
            </div>
         </div>
         @endif
         @endif
         @endforeach
      </div>
   </div>
</div>

<!--------------ourclient video ------------------>
    @include('frontend.fix-widgets.video_client')
<!--------------ourclient video ------------------> 
    <div class="review">
      <div class="container">
        <div class="headingbox text-center ">
          <h3>@if(!empty($seo_third_title)) {!! $seo_third_title !!}@endif</h3>
        </div>
        <div class="row g-4 masonrybox" data-masonry='{"percentPosition": true }'>

          @foreach ($seo_extra_data as $val)
            @if($val->type == 4 )
              <div class="col-lg-3 col-md-6 col-sm-6 cordbox">
                <div class="review-box card">
                  <div class="card-img">
                    @if(!empty($val->image))
                        @if (file_exists(public_img_path($val->image)))
                        <img src="{{ asset('uploads/' . $val->image) }}" alt="{{ getImageNameAlt($val->image) }}">
                        @else Image not found @endif
                    @endif
                  </div>
                  <div class="card-body">
                    <div class="card-icon">
                      @if(!empty($val->image))
                          @if (file_exists(public_img_path($val->image)))
                          <img src="{{ asset('uploads/' . $val->image) }}" alt="{{ getImageNameAlt($val->image) }}">
                          @else Image not found @endif
                      @endif
                    </div>
                    <h4>{!! $val->title !!}</h4>
                    <ul>
                      @for ($i= 0; $i < $val->sub_title ; $i++)
                      <li><i class="fa-solid fa-star"></i></li>
                      @endfor
                    </ul>
                    {!! $val->body !!}
                    <div class="rfacebook text-center">
                        @if(!empty($val->image2))
                            @if (file_exists(public_img_path($val->image2)))
                            <img src="{{ asset('uploads/' . $val->image2) }}" alt="{{ getImageNameAlt($val->image2) }}">
                            @else Image not found @endif
                        @endif
                    </div>
                  </div>
                </div>
              </div>
            @endif
          @endforeach

        </div>
      </div>
    </div>
    <section class="faqbg" style="background:url({{ asset('frontend/images/faqbg.webp') }}) center no-repeat fixed;">
      <div class="container">
        <div class="headingbox text-center ">
          <h3>@if(!empty($seo_five_title)) {!! $seo_five_title !!}@endif</h3>
        </div>
      </div>
    </section>

    <section class="faqarea">
      <div class="container">
         <div class="row">
            <div class="col-lg-6">
               <div class="accordion" id="accordionExample">
                  @foreach ($seo_extra_data as $key=>$faq)
                    @if($faq->type == 6 )
                      <div class="accordion-item">
                        <div class="accordion-header" id="headingOne{{$key}}">
                            <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $key }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapseOne{{ $key }}">{{ $faq->title }}</button>
                        </div>
                        <div id="collapseOne{{ $key }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="headingOne{{$key}}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                              {!! $faq->body !!}
                            </div>
                        </div>
                      </div>
                    @endif
                  @endforeach
               </div>
            </div>
            <div class="col-lg-6">
               <div class="accordion" id="accordionExample1">
                  @foreach ($seo_extra_data as $key=>$faq)
                      @if($faq->type == 7 )
                        <div class="accordion-item">
                          <div class="accordion-header" id="heading{{ $key }}">
                              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $key }}" aria-expanded="false" aria-controls="collapse{{ $key }}">{{ $faq->title }}</button>
                          </div>
                          <div id="collapse{{ $key }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="heading{{ $key }}" data-bs-parent="#accordionExample1">
                              <div class="accordion-body">
                                {!! $faq->body !!}
                              </div>
                          </div>
                        </div>
                      @endif
                  @endforeach
               </div>
            </div>
         </div>
      </div>
   </section>

    <div class="blog">
      <div class="container">
        <div class="headingbox text-center ">
          <h3>@if(!empty($seo_eight_title)) {!! $seo_eight_title !!}@endif</h3>
        </div>
        <div class="row">
          @foreach ($blogData as $key=>$val)
          <div class="col-lg-4 col-md-6">
            <div class="bolgbox">
              <div class="bolimg"><img src="{{ asset('uploads/'.$val->image2) }}" alt="{{ getImageNameAlt($val->image2) }}">
                <div class="btxt">
                  <div class="bicon"><img src="{{ asset('uploads/'.$val->author_image) }}" alt="{{ getImageNameAlt($val->author_image) }}"></div>
                  <div class="stxt">
                    <h5>{{ $val->page_title }}</h5>
                    <h6>{{ $val->bannertext }}</h6>
                  </div>
                </div>
              </div>
              <div class="boltxt">
                  <h4>
                     @if(!empty($val->redirect_to))
                        <a href="{{ url($val->redirect_to) }}">{{ $val->page_name }}</a>
                     @else
                        <a href="{{ url('blog/'.$val->slug) }}">{{ $val->page_name }}</a>
                     @endif
                  </h4>
                  @php
                  $text = $val->body;
                  $limitedContent = substr($text, 0, 150);
                  @endphp
                <p>@if($limitedContent){!! $limitedContent.'...' !!}@else {!! $limitedContent !!} @endif</p>  
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
@endsection
@section('more-scripts')
@stop