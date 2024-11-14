<div class="partner bg_acc_new">
    <div class="container">
        <div class="headingbox text-center">
            <h2>{!! $our_partners[0]->title !!}</h2>
        </div>
        <div id="partnerscarousel" class="owl-carousel partners-carousel">
            @foreach ($our_partners as $key=>$value)
            
                @if($value->type ==17 )
                    @if ($value->embaded_code == NULL)
                    <a href="{{($value->btn_url != null && $value->btn_url != "")?$value->btn_url:''}}" target="_blank"><figure><img src="{{ asset('uploads/'.$value->image) }}" alt="{{ getImageNameAlt($value->image) }}"></figure></a>
                    @else
                    <figure>{!! $value->embaded_code !!}</figure>
                    @endif
                @endif
            @endforeach
        </div>

    </div>
</div>