<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <title>Website</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', app_name())</title>
@yield('meta')

<!-- Styles -->
@yield('before-styles')
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    {!! Html::script('/frontend/js/modernizr.js') !!}
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.15.1/dist/sweetalert2.all.js"></script>

    {{ Html::style('/fontawesome/css/fontawesome-all.min.css') }}
    {{ Html::style('/frontend/css/bootstrap-colorselector.min.css') }}
    {{ Html::style('/frontend/css/slick.css') }}
    {{ Html::style('/frontend/css/slick-theme.css') }}
    {{ Html::style('/frontend/css/style.css') }}
    {{ Html::style('/frontend/css/results-style.css') }}
    {{ Html::style('/frontend/css/product-style.css') }}
    
    {{ Html::style('/frontend/css/xzoom.css') }}
    <!--{{ Html::style('/frontend/js/jquery.fancybox.js') }}-->
    {{ Html::style('/frontend/css/magnific-popup.css') }}
    {{ Html::style('/frontend/css/bootstrap-tagsinput.css') }}

    {{ Html::style('/frontend/css/custom.css') }}
    {{ Html::style('/frontend/inc/src/css/custom.css') }}
    {{ Html::style('/frontend/css/login.css') }}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.css">
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.css" />
    <link type="text/css" rel="stylesheet" href="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials-theme-classic.css" />
	
@yield('after-styles')

<!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    {!! Html::script('/frontend/js/app.js') !!}
    {!! Html::script('/frontend/js/slick.min.js') !!}
</head>
<body>

    @include('frontend.includes.header')

    
        @include('includes.partials.messages')
        @yield('content')
    

    @include('frontend.includes.footer')

<!-- Scripts -->
@yield('before-scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/typeahead.js/0.11.1/typeahead.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery.jssocials/1.4.0/jssocials.min.js"></script>
    {!! Html::script('/frontend/js/bootstrap-colorselector.min.js') !!}
    {!! Html::script('/frontend/js/slick.min.js') !!}
    {!! Html::script('/frontend/js/slick-lightbox.min.js') !!}
    {!! Html::script('/frontend/js/xzoom.js') !!}
    {!! Html::script('/frontend/js/jquery.hammer.min.js') !!}
    {!! Html::script('/frontend/js/magnific-popup.js') !!}
    {!! Html::script('/frontend/js/foundation.min.js') !!}
    {!! Html::script('/frontend/js/setup.js') !!}
    {!! Html::script('/frontend/js/bootstrap-tagsinput.min.js') !!}
    {!! Html::script('/frontend/js/color_name.js') !!}
    {!! Html::script('/frontend/js/custom.js') !!}
	

    <script>
        $(function() {
            $('#colorselector').colorselector();
            /*$(".dropdown-submenu a.dropdown-toggle").hover(function(){
                $(this).next('ul').show();
            }, function() {
                $(this).next('ul').hide();
            });*/
        });
    </script>
    <script type="text/javascript">
        function googleTranslateElementInit() {
            new google.translate.TranslateElement({ pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, autoDisplay: false }, 'google_translate_element');
        }
    </script>
    <script src="http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/rateYo/2.3.2/jquery.rateyo.min.js"></script>
    <script>

        function setCookie(c_name,value,exdays){var exdate=new Date();exdate.setDate(exdate.getDate() + exdays);var c_value=escape(value) + ((exdays==null) ? "" : "; expires="+exdate.toUTCString());document.cookie=c_name + "=" + c_value;}
        function getCookie(c_name){var c_value = document.cookie;var c_start = c_value.indexOf(" " + c_name + "=");if (c_start == -1){c_start = c_value.indexOf(c_name + "=");}if (c_start == -1){c_value = null;}else{c_start = c_value.indexOf("=", c_start) + 1;var c_end = c_value.indexOf(";", c_start);if (c_end == -1){c_end = c_value.length;}c_value = unescape(c_value.substring(c_start,c_end));}return c_value;}
        function delCookie(name){document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:01 GMT;';}

        function translateLanguage(lang) {

            var $frame = $('.goog-te-menu-frame:first');
            if (!$frame.length) {
                alert("Error: Could not find Google translate frame.");
                return false;
            }
            if($frame.contents().find('.goog-te-menu2-item span.text:contains(' + lang + ')').get(0))
            {
                $frame.contents().find('.goog-te-menu2-item span.text:contains(' + lang + ')').get(0).click();
            }            
            return false;
        }
        $(document).ready(function(){
            $(".register-button").on('click', function(){
                $("#login-modal").modal('hide');
                $("#register-modal").modal('show');
            });
            $(".forgetpassword-button").on('click', function(){
                $("#login-modal").modal('hide');
                $("#forgetpassword-modal").modal('show');
            });
            $(".back-login").on('click', function(){
                $("#forgetpassword-modal").modal('hide');
                $("#register-modal").modal('hide');
                $("#login-modal").modal('show');
            });

            //Checks if the cookie already exists
            if (!getCookie('firsttime')){
                //Runs the code because the cookie doesn't exist and it's the user's first time
                $("#joinus-modal").modal('show');
                //Set's the cookie to true so there is a value and the code shouldn't run again.
                setCookie('firsttime',true);
            }
        });
		
		$( "#headerSearch" ).autocomplete({
              source: "<?php echo url('/') ?>/get-suggestion",
              minLength: 2,
              select: function( event, ui ) {
                $( "#headerSearch" ).val(ui.item.value);
                $( "#headerSearch" ).closest('form').submit();
              }
            }).autocomplete('instance')._renderItem = function (ul,item){
			return $('<li>')
			.append('<img src='+item.imgPath + ' height=100px width=100px >')
			.append('<a>'+ item.value+'</a>')
			.append(item.price)
			.appendTo(ul);
			};
        $.ajax({
            url:"<?php echo url('/'); ?>"+"/visitor",
            type: "GET",
            success: function(){

            }
        });
    </script>
@yield('after-scripts')
</body>
</html>