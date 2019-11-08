@extends('frontend.layouts.master')

@section('after-styles')
    {{ Html::style('/frontend/css/rug-style.css') }}
@endsection

@section('content')
    <div class="container" id="rug-school">
        <div class="section">

            <div class="rug-poster">
                <img src="./img/rug/rug.jpg" alt="Rug School" class="img-responsive">
            </div>

            <div class="heading">
                <hr><h1><span>Rug School</span></h1>
            </div>

            <div class="rug-school-desc">
                <p>This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph,
                    This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph,
                    This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph,
                    This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph,
                    This is a Paragraph, This is a Paragraph, This is a Paragraph.</p>

                <p>This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph,
                    This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph,
                    This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph,
                    This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph, This is a Paragraph,
                    This is a Paragraph, This is a Paragraph, This is a Paragraph.</p>
            </div>


            <div class="rug-school-schedule">
                <table class="col-md-8">
                    <tr>
                        <th>Rug School</th>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>
            </div>

            <div class="row rug-school-download">
                <div class="col-md-6 download-link">
                    <a href="#" class="btn">Download  Rug School Application</a>
                </div>
                <div class="col-md-6 download-link">
                    <a href="#" class="btn">Download  One Day Workshop</a>
                </div>
            </div>


        </div>
    </div>
@endsection