@extends('frontend.layouts.master')

@section('after-styles')
    {{ Html::style('/frontend/css/stores-style.css') }}
@endsection

@section('content')
    <div class="container" id="stores">
        <div class="section" id="shops">
            <div class="heading">
                <hr><h1><span>Shop in Store</span></h1>
            </div>

            <div class="row shops">

                @foreach($stores as $single)
                <div class="shop-container col-sm-12">
                    <div class="col-sm-6 text-container">
                        <p>{{ $single->name }}</p>
                        <p>{{ $single->address }}</p>
                        <p>{{ $single->street }}</p>
                        <p>{{ $single->pobox.' , '.$single->city.' , '.$single->state.' , '.$single->country }}</p>
                        <p><a href="tel:{{ $single->phone }}"><i class="fa fa-phone-square" aria-hidden="true"></i>{{ $single->phone }}</a></p>
                        <p><a href="mailto:{{ $single->email }}?Subject=Contact" target="_top"><i class="fas fa-envelope" aria-hidden="true"></i>{{ $single->email }}</a></p>
                        <p>
                            @php
                                $shop = json_decode($single->shop, true);
                            @endphp

                            @if(isset($shop['amazon_link']))
                                <a class="shop-icon fa-3x" target="_blank" href="{{ $shop['amazon_link'] }}"><i class="fab fa-amazon"></i></a>
                            @endif

                            @if(isset($shop['ebay_link']))
                                <a class="shop-icon fa-3x" target="_blank" href="{{ $shop['ebay_link'] }}"><i class="fab fa-ebay "></i></a>
                            @endif

                            @if(isset($shop['custom_link1']) && $shop['custom_link1'] && isset($shop['custom_logo1']) && $shop['custom_logo1'])
                                <a class="shop-icon fa-3x" target="_blank" href="{{ $shop['custom_link1'] }}"><img src="{{ url('/').'/stores/'.$shop['custom_logo1'] }}" /></a>
                            @endif

                            @if(isset($shop['custom_link2']) && $shop['custom_link2'] && isset($shop['custom_logo2']) && $shop['custom_logo2'])
                                <a class="shop-icon fa-3x" target="_blank" href="{{ $shop['custom_link2'] }}"><img src="{{ url('/').'/stores/'.$shop['custom_logo2'] }}" /></a>
                            @endif
                        </p>
                    </div>
                    <div class="col-sm-6">
                        <iframe style="border: 0;width: 100%;min-height: 300px;" src="https://maps.google.com/maps?q={{ $single->address }}&hl=es;z=14&amp;output=embed" frameborder="0" allowfullscreen="allowfullscreen"></iframe>
                    </div>
                </div>
                @endforeach
                
            </div>
        </div>

    </div>
@endsection