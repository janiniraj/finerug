@extends('frontend.layouts.master')
@section('after-styles')
    <style>

    </style>
@endsection
@section('content')
    <div class="container">
        <div class="py-5 text-center">
            <h2>Checkout</h2>
        </div>

        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill">{{ $cartData->getTotalQuantity() }}</span>
                </h4>
                <ul class="list-group mb-3">
                    @foreach($cartData->getContent() as $singleKey => $singleValue)
                        @php
                            $productData = $productRepository->find($singleValue->attributes->product_id);

                            $images = json_decode($productData->main_image, true);

                        @endphp

                        <li class="list-group-item d-flex justify-content-between lh-condensed">
                            <div>
                                <a href="{{ route('frontend.product.show', $singleValue->attributes->product_id) }}" >
                                    <h6 class="my-0">{{ $singleValue->name }}</h6>
                                </a>
                                <small class="text-muted">{{ $singleValue->attributes->size }} </small>
                            </div>
                            <span class="text-muted">${{ $singleValue->price * $singleValue->quantity }}</span>
                        </li>
                    @endforeach

                    @if($cartData->getConditionsByType('promo')->count() > 0)
                        @php
                            $promoCodeDetails = $cartData->getConditionsByType('promo')->first();
                        @endphp
                        <li class="list-group-item d-flex justify-content-between bg-light">
                            <div class="text-success">
                                <h6 class="my-0">Promo code</h6>
                                <small>({{ $promoCodeDetails->getName() }}</small>
                            </div>
                            <span class="text-success">-${{$promoCodeDetails->getValue() }}</span>
                        </li>
                    @endif

                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong>${{ $cartData->getSubTotal() }}</strong>
                    </li>
                </ul>

                <?php /*<form class="card p-2">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Promo code">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-secondary">Redeem</button>
                        </div>
                    </div>
                </form>*/ ?>
            </div>
            <div class="col-md-8 order-md-1">
                <h4 class="mb-3">Billing address</h4>
                <form id="billing" class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" name="first_name" class="form-control" id="firstName" placeholder="First Name" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" name="last_name" class="form-control" id="lastName" placeholder="Last Name" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email <span class="text-muted">(Required)</span></label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com">
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" id="address" placeholder="1234 Main St" required>
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                        <input type="text" name="street" class="form-control" id="address2" placeholder="Apartment or suite">
                    </div>

                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="country">Country</label>
                            <select name="country" class="custom-select d-block w-100" id="country" required>
                                <option value="US" selected>United States</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state">State</label>
                            <select name="state" class="custom-select d-block w-100" id="state" required>
                                <option value="">Choose...</option>
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
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" name="postal_code" class="form-control" id="zip" placeholder="" required>
                            <div class="invalid-feedback">
                                Zip code required.
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="" required>
                        <div class="invalid-feedback">
                            Phone Number required.
                        </div>
                    </div>
                </form>




                <hr class="mb-4">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" checked class="custom-control-input" id="same-address">
                    <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
                </div>
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" class="custom-control-input" id="save-info">
                    <label class="custom-control-label" for="save-info">Save this information for next time</label>
                </div>
                <hr class="mb-4">

                <form id="shipping" class="needs-validation hidden" novalidate>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" name="first_name" class="form-control" id="firstName" placeholder="First Name" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" name="last_name" class="form-control" id="lastName" placeholder="Last Name" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email <span class="text-muted">(Required)</span></label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com">
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" id="address" placeholder="1234 Main St" required>
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                        <input type="text" name="street" class="form-control" id="address2" placeholder="Apartment or suite">
                    </div>

                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="country">Country</label>
                            <select name="country" class="custom-select d-block w-100" id="country" required>
                                <option value="US" selected>United States</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state">State</label>
                            <select name="state" class="custom-select d-block w-100" id="state" required>
                                <option value="">Choose...</option>
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
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" name="postal_code" class="form-control" id="zip" placeholder="" required>
                            <div class="invalid-feedback">
                                Zip code required.
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="" required>
                        <div class="invalid-feedback">
                            Phone Number required.
                        </div>
                    </div>

                    <hr class="mb-4">
                </form>

                <h4 class="mb-3">Payment</h4>
                <form id="payment" class="needs-validation" novalidate>
                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="credit" name="paymentMethod" type="radio" class="custom-control-input" checked required>
                            <label class="custom-control-label" for="credit">Credit card</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="debit" name="paymentMethod" type="radio" class="custom-control-input" required>
                            <label class="custom-control-label" for="debit">Debit card</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input" required>
                            <label class="custom-control-label" for="paypal">Paypal</label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="cc-name">Name on card</label>
                            <input type="text" class="form-control" id="cc-name" placeholder="" required>
                            <small class="text-muted">Full name as displayed on card</small>
                            <div class="invalid-feedback">
                                Name on card is required
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cc-number">Credit card number</label>
                            <input type="text" class="form-control" id="cc-number" placeholder="" required>
                            <div class="invalid-feedback">
                                Credit card number is required
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="cc-expiration">Expiration</label>
                            <input type="text" class="form-control" id="cc-expiration" placeholder="" required>
                            <div class="invalid-feedback">
                                Expiration date required
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="cc-expiration">CVV</label>
                            <input type="text" class="form-control" id="cc-cvv" placeholder="" required>
                            <div class="invalid-feedback">
                                Security code required
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit" style="margin-bottom: 7rem !important;">Proceed to Payment</button>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('after-scripts')
    <script>
    $(document).ready(function(){

        $("#same-address").on("change", function (e) {
            if($(this).is(':checked'))
            {
                $("#shipping").addClass("hidden");
            }
            else
            {
                $("#shipping").removeClass("hidden");
            }
        });
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