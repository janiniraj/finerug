@extends('frontend.layouts.master')

@section('after-styles')
    {{ Html::style('/frontend/css/showroom-style.css') }}
@endsection

@section('content')
    <div class="container" id="showroom">
        <div class="section">
            <div class="heading">
                <hr><h1><span>Show Room</span></h1>
            </div>

            <div class="showrooms-list">

                <div class="row show-room">
                    <div class="col-md-5 showroom-desc">
                        <p>This is a Paragraph<br>
                        This is a Paragraph<br>
                        This is a Paragraph<br>
                        This is a Paragraph<br>
                        This is a Paragraph </p>
                    
                        <div class="embed-responsive embed-responsive-4by3 location">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d387532.13185059966!2d-74.28733130279933!3d40.638817623603465!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2smy!4v1523210887824"  frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>

                    <div class="col-md-7 showroom-photo">
                        <img src="http://placehold.it/500x500" alt="Show Room">
                    </div>
                </div>

                <hr>

                <div class="row show-room">

                    <div class="col-md-7 showroom-photo">
                        <img src="http://placehold.it/500x500" alt="Show Room">
                    </div>

                    <div class="col-md-5 showroom-desc">
                        <div class="embed-responsive embed-responsive-4by3 location">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d387532.13185059966!2d-74.28733130279933!3d40.638817623603465!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2smy!4v1523210887824"  frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>

                        <p>This is a Paragraph<br>
                        This is a Paragraph<br>
                        This is a Paragraph<br>
                        This is a Paragraph<br>
                        This is a Paragraph </p>
                    
                    </div>

                </div>

                <hr>

                <div class="row show-room">
                    <div class="col-md-5 showroom-desc">
                        <p>This is a Paragraph<br>
                        This is a Paragraph<br>
                        This is a Paragraph<br>
                        This is a Paragraph<br>
                        This is a Paragraph </p>
                    
                        <div class="embed-responsive embed-responsive-4by3 location">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d387532.13185059966!2d-74.28733130279933!3d40.638817623603465!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2smy!4v1523210887824"  frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>
                    </div>

                    <div class="col-md-7 showroom-photo">
                        <img src="http://placehold.it/500x500" alt="Show Room">
                    </div>
                </div>

            </div>



        </div>
    </div>
@endsection