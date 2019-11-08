@extends('frontend.layouts.master')

@section('after-styles')
    {{ Html::style('/frontend/css/hospitality-style.css') }}
@endsection

@section('content')
    <div class="container" id="hospitality">
        <div class="section">
            <div class="heading">
                <hr><h1><span>Hospitality</span></h1>
            </div>

            <div class="hospitality-slider">
                <section class="slider" id="hospitalitySlider">
                    <div>
                        <img src="http://placehold.it/1920x1080?text=1">
                    </div>
                    <div>
                        <img src="http://placehold.it/1920x1080?text=2">
                    </div>
                    <div>
                        <img src="http://placehold.it/1920x1080?text=3">
                    </div>
                    <div>
                        <img src="http://placehold.it/1920x1080?text=4">
                    </div>
                </section>
            </div>

            <div class="row hospitality-desc">
                <div class="col-lg-10 col-lg-offset-1">
                    <p>This is Paragraph This is Paragraph This is Paragraph This is Paragraph This is Paragraph This is Paragraph
                        This is Paragraph This is Paragraph This is Paragraph This is Paragraph This is Paragraph This is Paragraph
                        This is Paragraph This is Paragraph This is Paragraph This is Paragraph This is Paragraph This is Paragraph
                        This is Paragraph This is Paragraph This is Paragraph This is Paragraph This is Paragraph This is Paragraph
                        This is Paragraph This is Paragraph This is Paragraph This is Paragraph This is Paragraph This is Paragraph</p>
                </div>
            </div>




        </div>
    </div>
@endsection