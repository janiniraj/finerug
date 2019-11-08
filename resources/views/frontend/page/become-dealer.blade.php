@extends('frontend.layouts.master')

@section('after-styles')
    {{ Html::style('/frontend/css/dealers-style.css') }}
@endsection

@section('content')
    <div class="container" id="dealers">
        <div class="section">
            <div class="heading">
                <hr><h1><span>Become a Dealer</span></h1>
            </div>

            <div class="row dealers-header">
                <div class="col-sm-6 desc">
                    <h3>This is a paragraph</h3>
                    <p>This is a paragraph, This is a paragraph
                        This is a paragraph
                        This is a paragraph, This is a paragraph
                        This is a paragraph, This is a paragraph
                        This is a paragraph, This is a paragraph
                        This is a paragraph
                        This is a paragraph, This is a paragraph
                        This is a paragraph.</p>
                </div>

                <div class="col-sm-6 poster">
                    <img src="./img/dealers/dealers.jpg" alt="dealers-poster" class="img-responsive">
                </div>
            </div>

            <div class="row download-section">
                <div class="col-lg-10 col-lg-offset-1 download-links">
                    <a href="#" class="btn">Download Application</a>
                    <a href="#" class="btn">Download International Application</a>
                    <a href="#" class="btn">Return Form</a>
                </div>
            </div>

            <div class="row application">
                <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
                    <form action="">

                        <div class="form-group">
                            <input type="text" class="form-control" id="firstname" placeholder="First Name" name="firstname">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="lastname" placeholder="Last Name" name="lastname">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="company" placeholder="Company Name" name="company">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
                        </div>
                        <div class="form-group upload-file">
                            <label for="upload">Upload Application</label>
                            <input type="file" id="upload">
                        </div>

                        <div class="captcha">
                            <h1 style="text-align:center">Captcha Here</h1>
                        </div>

                        <div class="submit-button">
                            <button type="submit" class="btn btn-default">Submit Application</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection