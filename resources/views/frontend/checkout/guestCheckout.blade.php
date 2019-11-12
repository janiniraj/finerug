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
                    <span class="badge badge-secondary badge-pill">3</span>
                </h4>
                <ul class="list-group mb-3">
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Product name</h6>
                            <small class="text-muted">Brief description</small>
                        </div>
                        <span class="text-muted">$12</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Second product</h6>
                            <small class="text-muted">Brief description</small>
                        </div>
                        <span class="text-muted">$8</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0">Third item</h6>
                            <small class="text-muted">Brief description</small>
                        </div>
                        <span class="text-muted">$5</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between bg-light">
                        <div class="text-success">
                            <h6 class="my-0">Promo code</h6>
                            <small>EXAMPLECODE</small>
                        </div>
                        <span class="text-success">-$5</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong>$20</strong>
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
                <form class="needs-validation" novalidate>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" class="form-control" id="lastName" placeholder="" value="" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="username">Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">@</span>
                            </div>
                            <input type="text" class="form-control" id="username" placeholder="Username" required>
                            <div class="invalid-feedback" style="width: 100%;">
                                Your username is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email <span class="text-muted">(Optional)</span></label>
                        <input type="email" class="form-control" id="email" placeholder="you@example.com">
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" placeholder="1234 Main St" required>
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                        <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                    </div>

                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="country">Country</label>
                            <select class="custom-select d-block w-100" id="country" required>
                                <option value="">Choose...</option>
                                <option>United States</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state">State</label>
                            <select class="custom-select d-block w-100" id="state" required>
                                <option value="">Choose...</option>
                                <option>California</option>
                            </select>
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" id="zip" placeholder="" required>
                            <div class="invalid-feedback">
                                Zip code required.
                            </div>
                        </div>
                    </div>
                    <hr class="mb-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="same-address">
                        <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="save-info">
                        <label class="custom-control-label" for="save-info">Save this information for next time</label>
                    </div>
                    <hr class="mb-4">

                    <h4 class="mb-3">Payment</h4>

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