@extends('frontend.layouts.master')

@section('after-styles')
    {{ Html::style('/frontend/css/awards-style.css') }}
@endsection

@section('content')
    <div class="container" id="awards">
        <div class="section">

            <div class="row">
                @foreach($promoList as $single)
                    <div class="col-md-3 padding">
                        <div class="card text-center promo-card" style="">
                            <div class="promo-image">
                                {{ $single->code }}
                            </div>
                            <div class="card-body">
                                @if($single->type == 'flat')
                                    <h5 class="card-title">
                                        Flat {{ $single->discount }} with use of Coupon "{{ $single->code }}"
                                    </h5>
                                @else
                                    <h5 class="card-title">
                                        {{ $single->discount }}% with use of Coupon {{ $single->code }}
                                    </h5>
                                @endif
                                <h6 class="card-name">{{ $single->name }}</h6>
                                <p class="card-text">{{ $single->description }}</p>
                                <a href="#" class="btn btn-danger">Shop Now</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection