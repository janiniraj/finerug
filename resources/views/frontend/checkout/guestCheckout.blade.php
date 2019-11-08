@extends('frontend.layouts.master')
@section('content')
    <div class='container'>
        <div class='row' style='padding-top:25px; padding-bottom:25px;'>
            <div class='col-md-12'>
                <div id='mainContentWrapper'>
                    <div class="col-md-8 col-md-offset-2">
                        <h2 style="text-align: center;">
                            Review Your Order & Complete Checkout
                        </h2>
                        <hr/>
                        <div class="shopping_cart">
                            <div class="panel-group" id="accordion">

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="# val
											
											
											
											" href="#collapseOne">Contact and Billing Information</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse in">
                                        <div class="panel-body">
                                        {{ Form::open(['route' => 'frontend.checkout.add_guest_address', 'id' => 'user_billing', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'files' => true]) }}

                                            {{ Form::hidden('type', 'billing') }}

                                            <b>Help us keep your account safe and secure, please verify your billing
                                                information.</b>
                                            <br/><br/>
                                            <table class="table table-striped" style="font-weight: bold;">
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_email">Email:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_email" name="email" value="" required="required" type="email"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_first_name">First name:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_first_name" name="first_name" value="" required="required" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_last_name">Last name:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_last_name" name="last_name" value="" required="required" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_address_line_1">Address:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_address_line_1" value="" name="address" required="required" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_address_line_2">Unit / Suite #:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_address_line_2" value="" name="street" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_city">City:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_city" name="city" value="" required="required" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_state">State:</label></td>
                                                    <td>
                                                        <select class="form-control" id="id_state" name="state">
                                                            <option value="AK">Alaska</option>
                                                            <option value="AL">Alabama</option>
                                                            <option value="AZ">Arizona</option>
                                                            <option value="AR">Arkansas</option>
                                                            <option value="CA">California</option>
                                                            <option value="CO">Colorado</option>
                                                            <option value="CT">Connecticut</option>
                                                            <option value="DE">Delaware</option>
                                                            <option value="FL">Florida</option>
                                                            <option value="GA">Georgia</option>
                                                            <option value="HI">Hawaii</option>
                                                            <option value="ID">Idaho</option>
                                                            <option value="IL">Illinois</option>
                                                            <option value="IN">Indiana</option>
                                                            <option value="IA">Iowa</option>
                                                            <option value="KS">Kansas</option>
                                                            <option value="KY">Kentucky</option>
                                                            <option value="LA">Louisiana</option>
                                                            <option value="ME">Maine</option>
                                                            <option value="MD">Maryland</option>
                                                            <option value="MA">Massachusetts</option>
                                                            <option value="MI">Michigan</option>
                                                            <option value="MN">Minnesota</option>
                                                            <option value="MS">Mississippi</option>
                                                            <option value="MO">Missouri</option>
                                                            <option value="MT">Montana</option>
                                                            <option value="NE">Nebraska</option>
                                                            <option value="NV">Nevada</option>
                                                            <option value="NH">New Hampshire</option>
                                                            <option value="NJ">New Jersey</option>
                                                            <option value="NM">New Mexico</option>
                                                            <option value="NY">New York</option>
                                                            <option value="NC">North Carolina</option>
                                                            <option value="ND">North Dakota</option>
                                                            <option value="OH">Ohio</option>
                                                            <option value="OK">Oklahoma</option>
                                                            <option value="OR">Oregon</option>
                                                            <option value="PA">Pennsylvania</option>
                                                            <option value="RI">Rhode Island</option>
                                                            <option value="SC">South Carolina</option>
                                                            <option value="SD">South Dakota</option>
                                                            <option value="TN">Tennessee</option>
                                                            <option value="TX">Texas</option>
                                                            <option value="UT">Utah</option>
                                                            <option value="VT">Vermont</option>
                                                            <option value="VA">Virginia</option>
                                                            <option value="WA">Washington</option>
                                                            <option value="DC">Washington D.C.</option>
                                                            <option value="WV">West Virginia</option>
                                                            <option value="WI">Wisconsin</option>
                                                            <option value="WY">Wyoming</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_postalcode">Postalcode:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_postalcode" name="postal_code" value="" required="required" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_phone">Phone:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_phone" name="phone" value="" type="text"/>
                                                    </td>
                                                </tr>

                                            </table>
                                            {{ Form::close() }}
                                        </div>
                                    </div>

                                </div>
                                
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <div style="text-align: center; width:100%;">
                                                
                                                <a style="width:100%;color: #fff" class=" btn btn-success billing-submit">Continue to Shipping Information»</a>   
                                            </div>
                                        </h4>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Contact and Shipping Information</a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="panel-collapse collapse">
                                        <div class="panel-body">
                                        {{ Form::open(['route' => 'frontend.checkout.add_guest_address', 'id' => 'user_shipping', 'class' => 'form-horizontal', 'role' => 'form', 'method' => 'post', 'files' => true]) }}
										
                                                {{ Form::hidden('type', 'shipping') }}

                                            <b>Help us keep your account safe and secure, please verify your Shipping
                                                information.</b>
                                                <br/><br/>
                                            <input class="same-as-billing" type="checkbox" /><b>Same As Billing Address</b>
                                            <br/><br/>
                                            <table class="table table-striped" style="font-weight: bold;">
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_email">Email:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_email2" name="email" value="" required="required" type="email"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_first_name">First name:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_first_name2" value="" name="first_name" required="required" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_last_name">Last name:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_last_name2" name="last_name" value="" required="required" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_address_line_1">Address:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_address_line_1_2" value="" name="address" required="required" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_address_line_2">Unit / Suite #:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_address_line_2_2" value="" name="street" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_city">City:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_city2" name="city" value="" required="required" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_state">State:</label></td>
                                                    <td>
                                                        <select class="form-control" id="id_state2" name="state">
                                                            <option value="AK">Alaska</option>
                                                            <option value="AL">Alabama</option>
                                                            <option value="AZ">Arizona</option>
                                                            <option value="AR">Arkansas</option>
                                                            <option value="CA">California</option>
                                                            <option value="CO">Colorado</option>
                                                            <option value="CT">Connecticut</option>
                                                            <option value="DE">Delaware</option>
                                                            <option value="FL">Florida</option>
                                                            <option value="GA">Georgia</option>
                                                            <option value="HI">Hawaii</option>
                                                            <option value="ID">Idaho</option>
                                                            <option value="IL">Illinois</option>
                                                            <option value="IN">Indiana</option>
                                                            <option value="IA">Iowa</option>
                                                            <option value="KS">Kansas</option>
                                                            <option value="KY">Kentucky</option>
                                                            <option value="LA">Louisiana</option>
                                                            <option value="ME">Maine</option>
                                                            <option value="MD">Maryland</option>
                                                            <option value="MA">Massachusetts</option>
                                                            <option value="MI">Michigan</option>
                                                            <option value="MN">Minnesota</option>
                                                            <option value="MS">Mississippi</option>
                                                            <option value="MO">Missouri</option>
                                                            <option value="MT">Montana</option>
                                                            <option value="NE">Nebraska</option>
                                                            <option value="NV">Nevada</option>
                                                            <option value="NH">New Hampshire</option>
                                                            <option value="NJ">New Jersey</option>
                                                            <option value="NM">New Mexico</option>
                                                            <option value="NY">New York</option>
                                                            <option value="NC">North Carolina</option>
                                                            <option value="ND">North Dakota</option>
                                                            <option value="OH">Ohio</option>
                                                            <option value="OK">Oklahoma</option>
                                                            <option value="OR">Oregon</option>
                                                            <option value="PA">Pennsylvania</option>
                                                            <option value="RI">Rhode Island</option>
                                                            <option value="SC">South Carolina</option>
                                                            <option value="SD">South Dakota</option>
                                                            <option value="TN">Tennessee</option>
                                                            <option value="TX">Texas</option>
                                                            <option value="UT">Utah</option>
                                                            <option value="VT">Vermont</option>
                                                            <option value="VA">Virginia</option>
                                                            <option value="WA">Washington</option>
                                                            <option value="DC">Washington D.C.</option>
                                                            <option value="WV">West Virginia</option>
                                                            <option value="WI">Wisconsin</option>
                                                            <option value="WY">Wyoming</option>
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_postalcode2">Postalcode:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_postalcode2" name="postal_code" value="" required="required" type="text"/>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="width: 175px;">
                                                        <label for="id_phone2">Phone:</label></td>
                                                    <td>
                                                        <input class="form-control" id="id_phone2" value="" name="phone" type="text"/>
                                                    </td>
                                                </tr>

                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <div style="text-align: center;">
                                                <a class=" btn   btn-success shipping-submit" id="payInfo" style="width:100%;display: none;color: #fff">Free Shipping </a>
                                            </div>
                                        </h4>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" id="overview_div" href="#collapseOverview">OverView</a>
                                        </h4>
                                    </div>
                                    <div id="collapseOverview" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col"> </th>
                                                            <th scope="col">Product</th>
                                                            <th scope="col">Available</th>
                                                            <th scope="col" class="text-center">Quantity</th>
                                                            <th scope="col" class="text-right">Price</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($cartData->getContent() as $singleKey => $singleValue)
                                                            <tr>
                                                                @php
                                                                    $productData = $productRepository->find($singleValue->attributes->product_id);

                                                                    $images = json_decode($productData->main_image, true);
                                                                @endphp
                                                                <?php /*<td><a href="{{ route('frontend.product.show', $singleValue->attributes->product_id) }}"><img class="cart-product-image" src="{{ admin_url().'/img/products/thumbnail/'.$images[0] }}" /></a> </td>*/ ?>
																<td><a href="{{ route('frontend.product.show', $singleValue->attributes->product_id) }}"><img class="cart-product-image" src="/img/products/thumbnail/{{ $images[0] }}" /></a> </td>
                                                                <td>
                                                                    <a href="{{ route('frontend.product.show', $singleValue->attributes->product_id) }}">{{ $singleValue->name }}
                                                                    </a>
                                                                    <br/>
                                                                    {{ $singleValue->attributes->size }}
                                                                </td>
                                                                <td>In stock</td>
                                                                <td>{{ $singleValue->quantity }}</td>
                                                                <td class="text-right">$ {{ $singleValue->price * $singleValue->quantity }}</td>
                                                            </tr>
                                                        @endforeach

                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>Sub-Total</td>
                                                            <td class="text-right">$ {{ $cartData->getSubTotal() }}</td>
                                                        </tr>

                                                        @if($cartData->getConditionsByType('shipping')->count() > 0)
                                                            @php
                                                                $shippingDetails = $cartData->getConditionsByType('shipping')->first();
                                                            @endphp
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>PromoCode ({{ $promoCodeDetails->getName() }})</td>
                                                                <td class="text-right">{{$promoCodeDetails->getValue() }}</td>
                                                            </tr>
                                                        @endif

                                                        @if($cartData->getConditionsByType('promo')->count() > 0)
                                                            @php
                                                                $promoCodeDetails = $cartData->getConditionsByType('promo')->first();
                                                            @endphp
                                                            <tr>
                                                                <td></td>
                                                                <td></td>
                                                                <td></td>
                                                                <td>PromoCode ({{ $promoCodeDetails->getName() }})</td>
                                                                <td class="text-right">{{$promoCodeDetails->getValue() }}</td>
                                                            </tr>
                                                        @endif

                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td><strong>Total</strong></td>
                                                            <td class="text-right"><strong>$ {{ $cartData->getTotal() }}</strong></td>
                                                        </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                                <b>Enter Payment Information</b>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <span class='payment-errors'></span>
                                            
                                            <a href="{{ route('frontend.checkout.before-payment') }}" type="submit" class="btn btn-success btn-lg before-payment" style="width:100%;">Pay
                                            </a>
                                            <br/>
                                            <div style="text-align: left;"><br/>
                                                By submiting this order you are agreeing to our <a href="">universal billing agreement</a>, and <a href="">terms of service</a>. If you have any questions about our products or services please contact us before placing this order.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('after-scripts')
    <script>
    $(document).ready(function(){
		$('#accordion .in').collapse('show');
        $("#user_billing").submit(function(e){
            e.preventDefault();
            $.ajax({
                url:      $(this).attr('action'),
                type:     $(this).attr('method'),
                data:     $(this).serialize(),
                success: function(data) {
                    $('#accordion .in').collapse('hide');
                    $(".billing-submit").fadeOut(); 
                    $('#collapseTwo').collapse('show');
                    $(".shipping-submit").fadeIn();
                }
            });
        });

        $("#user_shipping").submit(function(e){
            e.preventDefault();
            $.ajax({
                url:      $(this).attr('action'),
                type:     $(this).attr('method'),
                data:     $(this).serialize(),
                success: function(data) {
					//console.log(data.rates);
                    if(data.rates)
                    {
                        alert("Shipping Charges Added: $"+data.rates);

                        $('#accordion .in').collapse('hide');
                        $(".shipping-submit").fadeOut(); 
                        $('#collapseOverview').collapse('show');
                    }
                    else
                    {
                        alert("Error in Address.");
                    }                    
                }
            });
        });

        $(".billing-submit").on("click", function(){
            $("#user_billing").submit();
        });

        $(".shipping-submit").on("click", function(){
            $("#user_shipping").submit();
            //$(this).fadeOut(); 
            //$('#payInfo').fadeIn();
        });

        $("#overview_div").on("click", function(){
            $('#accordion .in').collapse('hide');
            $('#collapseOverview').collapse('show');
        });

        $('#collapseOverview').on('show.bs.collapse', function (e) {
            $.ajax({
                url:      '<?php echo route("frontend.checkout.overview"); ?>',
                type:     'GET',
                success: function(data) {
                     $('#collapseOverview').html(data);                  
                }
            });
        });

        $(".before-payment").on("click", function(e){
            e.preventDefault();
            
            var billingBlankField = false;
            $("#user_billing input").each(function(){
                if($(this).val() == "")
                {
                    billingBlankField = true;
                }
            });

            var shippingBlankField = false;
            $("#user_shipping input").each(function(){
                if($(this).val() == "")
                {
                    shippingBlankField = true;
                }
            });

            if(billingBlankField == true)
            {
                alert("Fields in Billing Address are must to fill.");
                $('#accordion .in').collapse('hide');                
                $('#collapseOne').collapse('show');
                $(".billing-submit").fadeIn();
            }
            else if(shippingBlankField == true)
            {
                alert("Fields in Shipping Address are must to fill.");
                $('#accordion .in').collapse('hide');                
                $(".billing-submit").fadeOut(); 
                $('#collapseTwo').collapse('show');
                $(".shipping-submit").fadeIn();
            }
            else
            {
                window.location.replace($(this).attr('href'));
            }
        });

        $(".same-as-billing").on("change", function(){

            if($(this).is(':checked')) {

                $("#user_billing input, #user_billing select").each(function(){
                    if($(this).attr('type') != "hidden")
                    {
                        var inputName = $(this).attr('name');
                        var inputVal = $(this).val();

                        $("#user_shipping input, #user_shipping select").filter(':visible').each(function(){
                            
                            if($(this).attr('name') == inputName)
                            {
                                $(this).val(inputVal);
                            }
                        });
                    }                    
                });
            }
        });
    });
    </script>
@endsection