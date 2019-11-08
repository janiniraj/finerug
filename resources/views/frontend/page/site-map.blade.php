@extends('frontend.layouts.master')

@section('after-styles')
    {{ Html::style('/frontend/css/site-map-style.css') }}
@endsection

@section('content')
    <div class="container" id="site-map">
        <div class="section">

            <div class="heading">
                <hr><h1><span>Site Map</span></h1>
            </div>

            <img src="{{ url('/') }}/frontend/img/site-map/site-map.jpg" alt="Site Map" class="img-responsive">
        </div>
    </div>
@endsection