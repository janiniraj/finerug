@extends('frontend.layouts.master')

@section('after-styles')
    {{ Html::style('/frontend/css/tnc-style.css') }}
@endsection

@section('content')
    <div class="container" id="tnc">
        <div class="section">

            <div class="tnc-poster">
                <img src="http://placehold.it/1000x350" alt="Terms & Conditions" class="img-responsive">
                <div class="caption">
                    <span>Terms & Conditions</span>
                </div>
            </div>

            <div class="terms">

                <p>This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph
                    This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph
                    This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph
                    This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph
                    This is a Paragraph.</p>

                <p>This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph
                    This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph
                    This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph
                    This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph
                    This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph
                    This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph
                    This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph
                    This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph
                    This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph</p>

            </div>

        </div>
    </div>
@endsection