@extends('frontend.layouts.master')

@section('after-styles')
    {{ Html::style('/frontend/css/return-style.css') }}
@endsection

@section('content')
    <div class="container" id="return">
        <div class="section">

            <div class="return-poster">
                <img src="./img/return/return.jpg" alt="Careers" class="img-responsive">
            </div>

            <div class="heading">
                <hr><h1><span>Return Policy</span></h1>
            </div>


            <div class="return-desc">
                <h3>This is apargraph</h3>
                <p>
                    This is Paragraph This is Paragraph This is Paragraph This is Paragraph This is Paragraph This is Paragraph This is Paragraph This is Paragraph
                    This is Paragraph This is Paragraph This is Paragraph This is Paragraph This is Paragraph This is Paragraph This is Paragraph This is Paragraph
                    This is Paragraph This is Paragraph This is Paragraph This is Paragraph This is Paragraph This is Paragraph This is Paragraph This is Paragraph
                    This is Paragraph This is Paragraph This is Paragraph This is Paragraph This is Paragraph This is Paragraph This is Paragraph This is Paragraph</p>

                <div class="row return-options">
                    <div class="col-md-10 col-md-offset-1">
                        <div class="col-md-5 option start">
                            <h3>Start a return</h3>
                            <p>Return, replace or exchange items</p>
                            <a href="#" class="btn">Return Items</a>
                        </div>

                        <div class="col-md-5 option view">
                            <h3>View return status</h3>
                            <p>Print return lables and check the status of your recent returns</p>
                            <a href="#" class="btn">Manage  Returns</a>
                        </div>
                    </div>
                </div>

                <p>
                    This is apargraph, This is apargraph, This is apargraph, This is apargraph, This is apargraph, This is apargraph, This is apargraph
                    This is apargraph, This is apargraph, This is apargraph, This is apargraph.
                    This is apargraph, This is apargraph, This is apargraph, This is apargraph, This is apargraph, This is apargraph, This is apargraph
                    This is apargraph, This is apargraph, This is apargraph.</p>
            </div>


        </div>
    </div>
@endsection