@extends('frontend.layouts.master')

@section('after-styles')
    {{ Html::style('/frontend/css/stores-style.css') }}
@endsection

@section('content')
    <div class="container" id="stores">
        <div class="section" id="shops">
            <div class="heading">
                <hr><h1><span>Shop in Store</span></h1>
            </div>

            <div class="row shops">
                <div class="box col-sm-4 left">
                    <p>This is a paragraph,
                        This is a paragraph,
                        This is a paragraph,
                        This is a paragraph,
                        This is a paragraph,
                        This is a paragraph,
                        This is a paragraph</p>
                </div>

                <div class="box col-sm-4 right">
                    <p>This is a paragraph,
                        This is a paragraph,
                        This is a paragraph,
                        This is a paragraph,
                        This is a paragraph,
                        This is a paragraph,
                        This is a paragraph</p>
                </div>
            </div>
        </div>

        <div class="section" id="search">
            <div class="heading">
                <hr><h1><span>Search Us Location</span></h1>
            </div>
            <div class="search">
                <form action="">
                    <div class="form-group">
                        <label for="search">Location</label>
                        <input type="text" class="form-control" id="search" placeholder="Search" name="search">
                    </div>
                    <div class="form-group">
                        <label for="zip">Zip Code</label>
                        <input type="text" class="form-control" id="zip" placeholder="" name="zip">
                    </div>
                </form>
            </div>
        </div>

        <div class="section" id="online">
            <div class="heading">
                <hr><h1><span>Search Online</span></h1>
            </div>

            <div class="row online">
                <div class="box col-sm-4 col-xs-6">
                    <a href="#"><img src="http://via.placeholder.com/140x100" alt="logo"></a>
                </div>

                <div class="box col-sm-4 col-xs-6">
                    <a href="#"><img src="http://via.placeholder.com/140x100" alt="logo"></a>
                </div>

                <div class="box col-sm-4 col-xs-6">
                    <a href="#"><img src="http://via.placeholder.com/140x100" alt="logo"></a>
                </div>

                <div class="box col-sm-4 col-xs-6">
                    <a href="#"><img src="http://via.placeholder.com/140x100" alt="logo"></a>
                </div>

                <div class="box col-sm-4 col-xs-6">
                    <a href="#"><img src="http://via.placeholder.com/140x100" alt="logo"></a>
                </div>

                <div class="box col-sm-4 col-xs-6">
                    <a href="#"><img src="http://via.placeholder.com/140x100" alt="logo"></a>
                </div>

                <div class="box col-sm-4 col-xs-6">
                    <a href="#"><img src="http://via.placeholder.com/140x100" alt="logo"></a>
                </div>

                <div class="box col-sm-4 col-xs-6">
                    <a href="#"><img src="http://via.placeholder.com/140x100" alt="logo"></a>
                </div>

                <div class="box col-sm-4 col-xs-6">
                    <a href="#"><img src="http://via.placeholder.com/140x100" alt="logo"></a>
                </div>
            </div>

        </div>

        <div class="section" id="retail">
            <div class="heading">
                <hr><h1><span>Visit Our Retail location</span></h1>
            </div>

            <div class="row retail">
                <div class="box col-sm-4">
                    <p>This is a paragraph,
                        This is a paragraph,
                        This is a paragraph,
                        This is a paragraph,
                        This is a paragraph,
                        This is a paragraph,
                        This is a paragraph</p>
                </div>

                <div class="box col-sm-4">
                    <p>This is a paragraph,
                        This is a paragraph,
                        This is a paragraph,
                        This is a paragraph,
                        This is a paragraph,
                        This is a paragraph,
                        This is a paragraph</p>
                </div>

                <div class="box col-sm-4">
                    <p>This is a paragraph,
                        This is a paragraph,
                        This is a paragraph,
                        This is a paragraph,
                        This is a paragraph,
                        This is a paragraph,
                        This is a paragraph</p>
                </div>
            </div>
        </div>

    </div>
@endsection