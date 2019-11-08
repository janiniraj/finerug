@extends('frontend.layouts.master')

@section('after-styles')
    {{ Html::style('/frontend/css/contact-style.css') }}
@endsection

@section('content')
    <div class="container" id="contact-us">
        <div class="section row" id="contact">
            <div class="col-sm-6">

                <div class="info">
                    <p>This is a Paragraph, This is a Paragraph, This is a Paragraph<br>
                        This is a Paragraph, This is a Paragraph, This is a Paragraph<br>
                        This is a Paragraph, This is a Paragraph, This is a Paragraph<br>
                        <br>
                        Tel.: 001 1234 56789<br>
                        Fax: 001 1234 56789<br>
                        Email: gmail.gmail@gmail.com
                    </p>

                    <hr>

                    <form action="/action_page.php">
                        <p>Leave a Message</p>
                        <div class="form-group">
                            <input type="text" class="form-control" id="name" placeholder="Your Name">
                            <input type="email" class="form-control" id="email" placeholder="Your Email">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" rows="5" id="message" placeholder="Your Message"></textarea>
                        </div>

                        <div class="submit-btn"><button type="submit" class="btn btn-default">SEND</button></div>
                    </form>

                </div>
            </div>
            <div class="col-sm-6 photo">
                <img class="img-responsive" src="http://placehold.it/500x500">
            </div>
        </div>

        <div class="section" id="location">
            <div class="embed-responsive embed-responsive-16by9">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d387532.13185059966!2d-74.28733130279933!3d40.638817623603465!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2smy!4v1523210887824"  frameborder="0" style="border:0" allowfullscreen></iframe>
            </div>
        </div>

    </div>
@endsection