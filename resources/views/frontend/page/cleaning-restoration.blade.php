@extends('frontend.layouts.master')

@section('after-styles')
    {{ Html::style('/frontend/css/cleaning-style.css') }}
@endsection

@section('content')
    <div class="container" id="cleaning">
        <div class="section">

            <div class="cleaning-poster">
                <img src="./img/cleaning/cleaning.jpg" alt="Cleaning Poster" class="img-responsive">
            </div>

            <div class="heading">
                <hr><h1><span>Cleaning & Restoration</span></h1>
            </div>

            <div class="samples">
                <div class="row">
                    <div class="col-md-4">
                        <div class="sample">
                            <div class="sample-img">
                                <img class="img-responsive" src="http://placehold.it/500x500">
                                <div class="sample-caption">Sample</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sample">
                            <div class="sample-img">
                                <img class="img-responsive" src="http://placehold.it/500x500">
                                <div class="sample-caption">Sample</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sample">
                            <div class="sample-img">
                                <img class="img-responsive" src="http://placehold.it/500x500">
                                <div class="sample-caption">Sample</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="sample">
                            <div class="sample-img">
                                <img class="img-responsive" src="http://placehold.it/500x500">
                                <div class="sample-caption">Sample</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sample">
                            <div class="sample-img">
                                <img class="img-responsive" src="http://placehold.it/500x500">
                                <div class="sample-caption">Sample</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sample">
                            <div class="sample-img">
                                <img class="img-responsive" src="http://placehold.it/500x500">
                                <div class="sample-caption">Sample</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="sample">
                            <div class="sample-img">
                                <img class="img-responsive" src="http://placehold.it/500x500">
                                <div class="sample-caption">Sample</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sample">
                            <div class="sample-img">
                                <img class="img-responsive" src="http://placehold.it/500x500">
                                <div class="sample-caption">Sample</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="sample">
                            <div class="sample-img">
                                <img class="img-responsive" src="http://placehold.it/500x500">
                                <div class="sample-caption">Sample</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection