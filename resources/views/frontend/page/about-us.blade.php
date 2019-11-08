@extends('frontend.layouts.master')

@section('after-styles')
    {{ Html::style('/frontend/css/about-style.css') }}
@endsection

@section('content')
    <div class="container" id="about-us">
        <div class="section">
            <div class="heading">
                <hr><h1><span>Categories</span></h1>
            </div>

            <div class="row about-slider">
                <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
                    <section class="slider" id="aboutUsSlider">
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
            </div>

            <div class="row about-desc">
                <div class="col-lg-10 col-lg-offset-1">
                    <p>This is a paragraph, This is a paragraph This is a paragraph This is a paragraph This is a  paragraph This is a  paragraph This is a  paragraphThis is a  paragraphThis is a  paragraph </p>
                    <p>This is a paragraph, This is a paragraph This is a paragraph This is a paragraph This is a  paragraph This is a  paragraph This is a  paragraphThis is a  paragraphThis is a  paragraph
                        This is a paragraph, This is a paragraph This is a paragraph This is a paragraph This is a  paragraph This is a  paragraph This is a  paragraphThis is a  paragraphThis is a  paragraph </p>
                    <p>This is a paragraph, This is a paragraph This is a paragraph This is a paragraph This is a  paragraph This is a  paragraph This is a  paragraphThis is a  paragraphThis is a  paragraph </p>
                </div>
            </div>

            <div class="about-video">
                <div class="embed-responsive embed-responsive-16by9">
                    <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                </div>
            </div>

            <div class="row about-desc">
                <div class="col-lg-10 col-lg-offset-1">
                    <p>This is a paragraph, This is a paragraph This is a paragraph This is a paragraph This is a  paragraph This is a  paragraph This is a  paragraphThis is a  paragraphThis is a  paragraph
                        This is a paragraph, This is a paragraph This is a paragraph This is a paragraph</p>
                    <p>This is a paragraph, This is a paragraph This is a paragraph This is a paragraph This is a  paragraph This is a  paragraph This is a  paragraphThis is a  paragraphThis is a  paragraph </p>
                </div>
            </div>

            <div class="about-boxes">
                <div class="box col-sm-4 left">
                    <div class="box-img"><img class="img-responsive" src="http://placehold.it/500x500" ></div>
                    <div class="box-desc">
                        <p>This is a paragraph,</p>
                        <p>This is a paragraph,</p>
                        <p>This is a paragraph,</p>
                        <p>This is a paragraph,</p>
                        <p>This is a paragraph,</p>
                    </div>
                </div>
                <div class="box col-sm-4 right">
                    <div class="box-img"><img class="img-responsive" src="http://placehold.it/500x500" ></div>
                    <div class="box-desc">
                        <p>This is a paragraph,</p>
                        <p>This is a paragraph,</p>
                        <p>This is a paragraph,</p>
                        <p>This is a paragraph,</p>
                        <p>This is a paragraph,</p>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection