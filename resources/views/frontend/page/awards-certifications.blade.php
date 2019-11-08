@extends('frontend.layouts.master')

@section('after-styles')
    {{ Html::style('/frontend/css/awards-style.css') }}
@endsection

@section('content')
    <div class="container" id="awards">
        <div class="section">
            <div class="heading">
                <hr><h1><span>Awards Certification</span></h1>
            </div>

            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="award top">
                        <div class="award-img">
                            <img class="img-responsive" src="http://placehold.it/500x350">
                            <div class="award-caption">Awards</div>
                        </div>
                        <div class="award-desc">
                            <p>This is aparaghraph, This is aparaghraph, This is aparaghraph
                                This is aparaghraph, This is aparaghraph, This is aparaghraph
                                This is aparaghraph, This is aparaghraph, This is aparaghraph</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="award">
                        <div class="award-img">
                            <img class="img-responsive" src="http://placehold.it/500x350">
                            <div class="award-caption">Awards</div>
                        </div>
                        <div class="award-desc">
                            <p>This is aparaghraph, This is aparaghraph, This is aparaghraph
                                This is aparaghraph, This is aparaghraph, This is aparaghraph
                                This is aparaghraph, This is aparaghraph, This is aparaghraph</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="award">
                        <div class="award-img">
                            <img class="img-responsive" src="http://placehold.it/500x350">
                            <div class="award-caption">Awards</div>
                        </div>
                        <div class="award-desc">
                            <p>This is aparaghraph, This is aparaghraph, This is aparaghraph
                                This is aparaghraph, This is aparaghraph, This is aparaghraph
                                This is aparaghraph, This is aparaghraph, This is aparaghraph</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <div class="award">
                        <div class="award-img">
                            <img class="img-responsive" src="http://placehold.it/500x350">
                            <div class="award-caption">Awards</div>
                        </div>
                        <div class="award-desc">
                            <p>This is aparaghraph, This is aparaghraph, This is aparaghraph
                                This is aparaghraph, This is aparaghraph, This is aparaghraph
                                This is aparaghraph, This is aparaghraph, This is aparaghraph</p>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="award">
                        <div class="award-img">
                            <img class="img-responsive" src="http://placehold.it/500x350">
                            <div class="award-caption">Awards</div>
                        </div>
                        <div class="award-desc">
                            <p>This is aparaghraph, This is aparaghraph, This is aparaghraph
                                This is aparaghraph, This is aparaghraph, This is aparaghraph
                                This is aparaghraph, This is aparaghraph, This is aparaghraph</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection