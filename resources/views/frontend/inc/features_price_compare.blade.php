@if($feature_data) 
<style>
.nav-pills .nav-item{box-shadow: 0px 2px 20px rgba(0, 0, 0, 30%);margin: 0 1px;}
.nav-pills .nav-link.active, .nav-pills .show>.nav-link{
        color: #fff !important;
    background-color: #192052 !important;
        transform: scale(1.1);
} 
.litebox h2{
    /*color: #ff0000 !important;*/
    color: #FF9500 !important;
    background:#181e4e !important;
        border-radius: 5px;
    padding: 5px 0px;
}
.litebox .h5 {
    font-size: 17px;
    color: #192152;
    text-decoration-line: line-through;
    margin: 10px 0;
}
.litebox:hover .h5{
    color:#fff; 
}
.litebox .h3{
    font-size: 25px;
    font-weight: 600;
    color: #192152;
}
.save-30{
    font-size: 10px !important;
}
</style>
<div class="featuresection" id="feature">
    <div class="container-fluid p-0">
        <div class="headingbox text-center">
            <div class="toolssection_h3">Compare all Features</div>
        </div>
        <div class="main-comparisontable">
            <div class="p-0 overflow_x_scroll" style="padding-left: 20px !important;">
                <div class="scroll-container" id="browse-features">
                    <!--<nav class="nav nav-pills justify-content-center mb-2">-->
                        <ul class="nav mb-5 nav nav-pills justify-content-center mb-2"   role="tablist" aria-labelledby="tablist">
                            <li class="nav-item">
                                <a href="#va11a" id="vwex22-tab-11"  class="nav-link active text-black packages-box duration new_click_new" role="tab" aria-labelledby="a11a" aria-controls="a11a" aria-selected="true" data-bs-toggle="tab">Month
                                    <br>
                                    <span class="sub_title">1 Month</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#va21a" id="vwex22-tab-21"  class="nav-link text-black packages-box duration new_click_new" role="tab" aria-labelledby="a21a" aria-controls="a21a" aria-selected="false" data-bs-toggle="tab">Quarterly
                                    <br>
                                    <span class="sub_title">3 Month</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#va31a" id="vwex22-tab-31"  class="nav-link text-black packages-box duration new_click_new" role="tab" aria-labelledby="a31a" aria-controls="a31a" aria-selected="false" data-bs-toggle="tab">Half Yearly
                                    <br>
                                    <span class="sub_title">6 Month</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#va41a" id="vwex22-tab-41"  class="nav-link text-black packages-box duration new_click_new" role="tab" aria-labelledby="a41a" aria-controls="a41a" aria-selected="false" data-bs-toggle="tab">Yearly
                                    <br>
                                    <span class="sub_title">12 Month</span>
                                </a>
                            </li>
                        </ul>
                    <!--</nav>-->

                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="va11a" role="tabpanel" aria-labelledby="vwex22-tab-11">
                            <table class="price-table">
                                <tbody>
                                    <tr class="sticky-header ">
                                        <td class="black_tad"></td>
                                        @foreach($data_new as $key => $val)
                                        
                                        <td>
                                            <div class="litebox">
                                                <div class="h3">{{ ucfirst($val['plan_name']) }}</div>
                                                <div class="d-flex align-items-center justify-content-around">
                                                    <div class="h5">₹{{ $val['main_price'] }}</div>
                                                    <div class="save-30">Save {{ $val['percentage'] }}%</div>
                                                </div>
                                                <h2>₹{{ $val['discount_price'] }}</h2>
                                                <a href="#" class="cta subscribe-now cta-wrapper mt-3">Subscribe Now</a>
                                            </div>
                                        </td>
                                        @endforeach 
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="va21a" role="tabpanel" aria-labelledby="vwex22-tab-21">
                            <table class="price-table">
                                <tbody>
                                    <tr class="sticky-header">
                                        <td class="black_tad"></td>
                                        @foreach($data1 as $key1 => $val1)
                                        <td>
                                            <div class="litebox">
                                                <div class="h3">{{ ucfirst($val1['plan_name']) }}</div>
                                                <div class="d-flex align-items-center justify-content-around">
                                                    <div class="h5">₹{{ $val1['main_price'] }}</div>
                                                    <div class="save-30">Save {{ $val1['percentage'] }}%</div>
                                                </div>
                                                <h2>₹{{ $val1['discount_price'] }}</h2>
                                                <a href="#" class="cta subscribe-now cta-wrapper mt-3">Subscribe Now</a>
                                            </div>
                                        </td>
                                        @endforeach
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="va31a" role="tabpanel" aria-labelledby="vwex22-tab-31">
                            <table class="price-table">
                                <tbody>
                                    <tr class="sticky-header">
                                        <td class="black_tad"></td>
                                        @foreach($data2 as $key2 => $val2)
                                        <td>
                                            <div class="litebox">
                                                <div class="h3">{{ ucfirst($val2['plan_name']) }}</div>
                                                <div class="d-flex align-items-center justify-content-around">
                                                    <div class="h5">₹{{ $val2['main_price'] }}</div>
                                                    <div class="save-30">Save {{ $val2['percentage'] }}%</div>
                                                </div>
                                                <h2>₹{{ $val2['discount_price'] }}</h2>
                                                <a href="#" class="cta subscribe-now cta-wrapper mt-3">Subscribe Now</a>
                                            </div>
                                        </td>
                                        @endforeach
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="va41a" role="tabpanel" aria-labelledby="vwex22-tab-41">
                            <table class="price-table">
                                <tbody>
                                    <tr class="sticky-header">
                                        <td class="black_tad"></td>
                                        @foreach($data3 as $key3 => $val3)
                                        <td>
                                            <div class="litebox">
                                                <div class="h3">{{ ucfirst($val3['plan_name']) }}</div>
                                                <div class="d-flex align-items-center justify-content-around">
                                                    <div class="h5">₹{{ $val3['main_price'] }}</div>
                                                    <div class="save-30">Save {{ $val3['percentage'] }}%</div>
                                                </div>
                                                <h2>₹{{ $val3['discount_price'] }}</h2>
                                                <a href="#" class="cta subscribe-now cta-wrapper mt-3">Subscribe Now</a>
                                            </div>
                                        </td>
                                        @endforeach
                                    </tr> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @foreach ($feature_data as $row)
                <div class="features_table price-table mt-5">
                    <div class="feature_heading">{{ $row['heading'] }}</div>
                    <table class="feature_heading_table" style="width: 100%">
                        <tbody>
                            @foreach (json_decode($row['subheading']) as $index => $subheading)
                                <tr>
                                    <td class="content_feature fs15 pl-0">{{ $subheading }}</td>
                                    @foreach (['lite', 'standard', 'advance', 'enterprise'] as $type)
                                        <td>
                                            @php
                                                $values = json_decode($row[$type]);
                                                if (isset($values[$index])) {
                                                    $value = $values[$index];
                                                } else {
                                                    $value = null; // Or handle this case as needed
                                                } 
                                            @endphp
                                            @if ($value == "Active" || $value == "active")
                                                <div class="check text-center"><img src="{{ asset('frontend/images/true_check/ture-mark-01-svg.webp') }}" alt="check-icon"></div> 
                                            @elseif($value == null)
                                            <div class="check text-center"><img src="{{ asset('frontend/images/true_check/cross.webp') }}" width="20" alt="cross-icon"></div>
                                            @else
                                                <div class="check text-center">{{ $value }}</div>
                                            @endif
                                        </td>
                                    @endforeach
                                    
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endforeach 
            </div>
        </div>
    </div>
</div> 
@endif