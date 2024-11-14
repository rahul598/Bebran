@extends('layouts.app')
@section('content')
<style>
/*.border-new {*/
/*    border: 1px solid lightgrey !important;*/
/*    padding: 5px;*/
/*    border-radius: 10px;*/
/*}*/
.result_tab .nav-item.show .nav-link, .result_tab .nav-link.active, .result_tab .nav-link:hover{
    border:none !important;
}
.result_tab .nav-link{
    border:none !important;
    position: relative;
    padding: 8px 16px;
    font-size: 15px;
    background-color: initial;
    border: 1px solid #161616 !important;
    color: #161616;
    border-radius: 5px;
    flex-shrink: 0;
    cursor: pointer;
    transition: var(--trans);
    margin: 0px 5px;
}
 .result_tab .nav-link.active{
    color: #000 !important;
    background-color: #facc15 !important;
    /*background-color: #192052 !important;*/
}
 .result_tab .nav-link:hover{
    background-color: #facc15;
    border-radius: var(--br-8xs);
}
.border-new li {
    padding: 0 3px;
}
@media (max-width: 576px) {
    .result_tab .border-new {
        display: flex;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
        white-space: nowrap;
    }
    .result_tab .nav-item {
        flex: 0 0 auto;
    }
}

</style>
@foreach ($extra_data as $val)
    @php $page_id = $val->page_id; @endphp
    @switch($val->type)
        @case(1)
            @php
            $image = $val->image;
            $first_body = $val->body;
            @endphp
            @break
        @case(2)
            @php
                $title = $val->title;
            @endphp
            @break
        @case(4)
            @php
                $fourth_title = $val->title;
                $fourth_body = $val->body;
            @endphp
            @break
        @case(6)
            @php
                $fifth_title = $val->title;
                $fifth_body = $val->body;
                $fifth_sub_title = $val->sub_title;
            @endphp
            @break
        @case(7)
            @php
                $seventh_title = $val->title;
            @endphp
            @break
        @case(8)
            @php
                $eigth_title = $val->title;
            @endphp
            @break
        @case(9)
            @php
                $ninth_title = $val->title;
            @endphp
            @break
        @case(12)
            @php
                $twelve_title = $val->title;
            @endphp
            @break
    @endswitch
@endforeach
<div class="innerbanner-area"> 
    <img src="{{ asset('uploads/'.$image) }}" alt="{{ getImageNameAlt($image) }}">
  </div>
  
 <!---------------------old code-------------->
<div class="seolanding-area d-none">
    <div class="innerbanner-area">
        <nav class="breadcrumb">
            <div class="container">
                <a class="breadcrumb-item" href="{{ url('/') }}">home</a>
                <span class="breadcrumb-item active">{{ $page->page_name }}</span>
            </div>
        </nav>
    </div>
    <div class="container">
        <div class="headingbox">
            <h3>
                @if(!empty($title))
                    {!! $title !!}
                @endif
            </h3>
        </div>
      <div class="container">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs justify-content-center result_tab" style="margin-bottom:10%;border: none !important;" role="tablist">
            <div class="d-flex mb-5 border-new">
            <li class="nav-item" role="presentation">
                <a class="text-dark rounded nav-link active border-0" id="tab-all" data-bs-toggle="tab" href="#content-all" role="tab" aria-controls="content-all" aria-selected="true">
                    All
                </a>
            </li>
            @foreach ($seo_category as $index => $category)
                <li class="nav-item" role="presentation">
                    <a class="text-dark  nav-link rounded" id="tab-{{ $category->id }}" data-bs-toggle="tab" href="#content-{{ $category->id }}" role="tab" aria-controls="content-{{ $category->id }}" aria-selected="{{ $index === 0 ? 'true' : 'false' }}">
                        {{ $category->name }}
                    </a>
                </li>
            @endforeach
            </div>
        </ul>
    
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- All Tab Pane -->
            <div class="tab-pane fade show active" id="content-all" role="tabpanel" aria-labelledby="tab-all">
                <div class="row row-cols-1 row-cols-sm-1 row-cols-md-4 row-cols-lg-4 row-cols-xxl-4">
                    @foreach ($seo_results as $val)
                        @if($val->display_on_off != 'Inactive')
                            <div class="col mb-4">
                                <div class="card seoLandingBox">
                                    <div class="card-img d-flex">
                                        <img src="{{ asset('uploads/'.$val->image2) }}" alt="{{ getImageNameAlt($val->image2) }}">
                                    </div>
                                    <div class="card-body">
                                        <h4>{{ $val->page_title }}</h4>
                                        <p>{!! $val->body !!}</p>
                                        <div class="d-flex align-items-center seoLandingBoxCountry">
                                            <div class="flex-shrink-0 media-img">
                                                <img src="{{ asset('uploads/'.$val->bannerimage) }}" alt="{{ getImageNameAlt($val->bannerimage) }}">
                                            </div>
                                            <div class="flex-grow-1 media-body">
                                                <h5>{{ $val->bannertext }}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="searchPercent d-flex align-items-center justify-content-center">
                                            <h5>{!! $val->author_url !!}</h5>
                                        </div>
                                        @if(!empty($val->redirect_to))
                                            <a href="{{ url($val->redirect_to) }}" class="btn-read text-center">
                                                Read More 
                                            </a>
                                        @else
                                            <a href="{{ url('seo-result/'.$val->slug) }}"  class="btn-read text-center">
                                                 Read More 
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
    
           <!-- Category-specific Tab Panes -->
            @foreach ($seo_category as $index => $category) 
                <div class="tab-pane fade {{ $index === 0 ? 'show active' : '' }}" id="content-{{ $category->id }}" role="tabpanel" aria-labelledby="tab-{{ $category->id }}">
                    <div class="row row-cols-1 row-cols-sm-1 row-cols-md-4 row-cols-lg-4 row-cols-xxl-4">
                        
                        @if (!empty($seo_results))
                            @foreach ($seo_results as $val)
                            
                                @php 
                                    $category_new = json_decode($val->business_category, true);
                                    if (!is_array($category_new)) {
                                        $category_new = [];
                                    }
                                @endphp  
                                @if($val->display_on_off != 'Inactive' && in_array($category->id, $category_new))
                                
                                    <div class="col mb-4">
                                        <div class="card seoLandingBox">
                                            <div class="card-img d-flex">
                                                <img src="{{ asset('uploads/'.$val->image2) }}" alt="{{ getImageNameAlt($val->image2) }}">
                                            </div>
                                            <div class="card-body">
                                                <h4>{{ $val->page_title }}</h4>
                                                <p>{!! $val->body !!}</p>
                                                <div class="d-flex align-items-center seoLandingBoxCountry">
                                                    <div class="flex-shrink-0 media-img">
                                                        <img src="{{ asset('uploads/'.$val->bannerimage) }}" alt="{{ getImageNameAlt($val->bannerimage) }}">
                                                    </div>
                                                    <div class="flex-grow-1 media-body">
                                                        <h5>{{ $val->bannertext }}</h5>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <div class="searchPercent d-flex align-items-center justify-content-center">
                                                    <h5>{!! $val->author_url !!}</h5>
                                                </div>
                                                @if(!empty($val->redirect_to))
                                                    <a href="{{ url($val->redirect_to) }}"  class="btn-read text-center">
                                                         Read More 
                                                    </a>
                                                @else
                                                    <a href="{{ url('seo-result/'.$val->slug) }}">
                                                         Read More 
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    </div> 
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            @endforeach

            
            <?php  //die;?>


        </div>
</div>



        <!-- Pagination Links -->
        <div class="pagination pagi_rahul justify-content-center">
            {{ $seo_results->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
 <!---------------------old code-------------->
 
 
<div class="seolanding-area" id="rsult_new">
    <div class="innerbanner-area">
        <nav class="breadcrumb">
            <div class="container">
                <a class="breadcrumb-item" href="{{ url('/') }}">home</a>
                <span class="breadcrumb-item active">{{ $page->page_name }}</span>
            </div>
        </nav>
    </div>
    <div class="container">
    <!-- Nav tabs -->
    <div class="d-flex mb-5 border-new justify-content-center" style="flex-wrap:wrap; width:100%;">
    <ul class="nav nav-tabs justify-content-center result_tab" style="margin-bottom:10%;border: none !important;" role="tablist">
        <li class="nav-item" role="presentation" style="margin: 5px 0;">
            <a class="category_tab text-dark rounded nav-link active border-0" data-category="all">
                All
            </a>
        </li>
        @foreach ($seo_category as $index => $category)
            <li class="nav-item" role="presentation" style="margin: 5px 0;">
                <a class="category_tab text-dark rounded nav-link" data-category="{{ $category->id }}">
                    {{ $category->name }}
                </a>
            </li>
        @endforeach
    </ul>
</div>


    <!-- Results Container -->
    <div id="seo-results-container" class="row row-cols-1 row-cols-sm-1 row-cols-md-4 row-cols-lg-4 row-cols-xxl-4">
    <!-- SEO results will be appended here -->
    </div>
    <div class="pagination pagi_rahul justify-content-center">
    </div>
</div>

</div>


<!-- inner seolanding area stop -->

<!-- seoclientsay area start --> 
<!--------------ourclient video ------------------>
    @include('frontend.fix-widgets.video_client')
<!--------------ourclient video ------------------>
<!-- seoclientsay area stop -->


<!-- seocampaigns area start -->
<div class="seocampaigns-area">
    <div class="container">
        <div class="seocampaigns-body">
            <div class="headingbox">
                <h3>@if(!empty($fifth_title)) {{ $fifth_title }}@endif<strong>@if(!empty($fifth_sub_title)) {{ $fifth_sub_title }}@endif</strong></h3>
            </div>
            @if(!empty($fifth_body)) {!! $fifth_body !!}@endif
        </div>        
    </div>
</div>

<div class="review">
  <div class="container">
     <div class="headingbox text-center ">
        <h3>@foreach ($extra_data as $val)
                @if($val->type == 7 && $val->section_type  == 2)
                {!! $val->title !!}
                @endif
            @endforeach
        </h3>
     </div>
     <div class="row g-4 masonrybox" data-masonry='{"percentPosition": true }'>
      @foreach ($extra_data as $val)
          @if($val->type == 8 || $val->section_type == 18 && $val->type == 7)
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
                  <h4>{{ $val->title }}</h4>
                  <ul>
                  @for ($i= 0; $i < $val->sub_title ; $i++)
                  <li><i class="fa-solid fa-star"></i></li>
                  @endfor
                  </ul>
                  <div>{!! $val->body !!}</div>
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
          <h3>{!! $ninth_title !!}</h3>
        </div>
      </div>
    </section>
    <section class="faqarea">
      <div class="container">
         <div class="row">
          <div class="col-lg-6">
            <div class="accordion" id="accordionExample1">
               @foreach ($extra_data as $key=>$faq)
                   @if($faq->type == 10 )
                     <div class="accordion-item">
                       <h2 class="accordion-header" id="heading{{ $key }}">
                           <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $key }}" aria-expanded="false" aria-controls="collapse{{ $key }}">{{ $faq->title }}</button>
                       </h2>
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
            <div class="col-lg-6">
               <div class="accordion" id="accordionExample">
                  @foreach ($extra_data as $key=>$faq)
                    @if($faq->type == 11 )
                      <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne{{ $key }}" aria-expanded="{{ $loop->first ? 'true' : 'false' }}" aria-controls="collapseOne{{ $key }}">{{ $faq->title }}</button>
                        </h2>
                        <div id="collapseOne{{ $key }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
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
          <h3>{!! $twelve_title !!}</h3>
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
                  <div>@if($limitedContent){!! $limitedContent.'...' !!}@else {!! $limitedContent !!} @endif</div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
@endsection
@section('more-scripts')
<script>
  $(document).ready(function() {
      @if (session('success'))
          $('html, body').animate({
              scrollTop: $('#homeForm').offset().top
          }, 1000);
      @endif
 
  });
  
</script>
<script>
    $(document).ready(function() {
        // Load all results by default
        loadSeoResults('all');
        
        function loadSeoResults(category_id, page = 1) {
            // Get CSRF token
            let csrf_token = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: `/seo_result_filter/${category_id}?page=${page}`, // Add page query parameter
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrf_token // Add CSRF token to headers
                },
                success: function(data) {
                    console.log(data)
                    let resultsContainer = $('#seo-results-container');
                    resultsContainer.empty();

                    if (data.data.length > 0) { // Check for paginated data
                    
                        data.data.forEach(result => {
                            resultsContainer.append(`
                                <div class="col mb-4">
                                    <div class="card seoLandingBox">
                                        <div class="card-img d-flex">
                                            <img src="{{ asset('uploads/') }}/${result.image2}" alt="{{ getImageNameAlt($val->image2) }}"> 
                                        </div>
                                        <div class="card-body">
                                            <h4>${result.page_title}</h4>
                                             ${result.body ? `<p>${result.body}</p>` : ''} <!-- Conditionally render <p> tag -->
                                            <div class="d-flex align-items-center seoLandingBoxCountry">
                                                <div class="flex-shrink-0 media-img">
                                                    <img src="{{ asset('uploads/') }}/${result.bannerimage}" alt="${result.bannerimage}">
                                                </div>
                                                <div class="flex-grow-1 media-body">
                                                    <h5>${result.bannertext}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <div class="searchPercent d-flex align-items-center justify-content-center">
                                                <h5>${result.author_url}</h5>
                                            </div>
                                            <a href="${result.redirect_to ? result.redirect_to : 'seo-result/' + result.slug}" class="btn-read text-center">
                                                Read More 
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            `);
                        });
                        
                        // Add pagination controls if more than 20 results
                        if (data.total > 20) {
                            let paginationControls = `<nav aria-label="Page navigation example"><ul class="pagination justify-content-center">`;
                
                            if (data.prev_page_url) {
                                paginationControls += `<li class="page-item"><a class="page-link" href="#" data-page="${data.current_page - 1}">Previous</a></li>`;
                            }
                
                            for (let i = 1; i <= data.last_page; i++) {
                                paginationControls += `<li class="page-item ${data.current_page === i ? 'active' : ''}"><a class="page-link" href="#" data-page="${i}">${i}</a></li>`;
                            }
                
                            if (data.next_page_url) {
                                paginationControls += `<li class="page-item"><a class="page-link" href="#" data-page="${data.current_page + 1}">Next</a></li>`;
                            }
                
                            paginationControls += `</ul></nav></div>`;
                
                            // Append pagination controls inside specific <div>
                            $('.pagination.pagi_rahul').html(paginationControls);
                
                            // Add pagination click handler
                            $('.pagination a').on('click', function(e) {
                                e.preventDefault();
                                let page = $(this).data('page');
                                loadSeoResults(category_id, page);
                            });
                        }
                         else {
                            // If pagination is not needed, clear the pagination <div>
                            $('.pagination.pagi_rahul').empty();
                        }

                    } else {
                        resultsContainer.append('<p>No results found.</p>');
                        // If no results, clear the pagination <div>
                        $('.pagination.pagi_rahul').empty();
                    }
                }
            });
        }

        

        // Handle tab click events
        $(document).on('click', '.category_tab', function(e) {
            e.preventDefault(); // Prevent the default behavior
            $('.category_tab').removeClass('active');
            $(this).addClass('active');

            let category_id = $(this).data('category'); 
            loadSeoResults(category_id);
        });
    });
</script>
<!-- JavaScript for handling tab switching -->
<script>
    // document.addEventListener('DOMContentLoaded', function() {
    //     document.querySelectorAll('.nav-link').forEach(function(tab) {
    //         tab.addEventListener('click', function() {
    //             const category = this.getAttribute('data-category');
    //             const url = new URL(window.location.href);
    //             url.searchParams.set('category_id', category);
    //             window.location.href = url.toString();
    //         });
    //     });
    // });
</script>

@stop


