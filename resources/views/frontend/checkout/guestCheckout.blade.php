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
                    <li class="tax-container list-group-item d-flex justify-content-between hidden">
                        <span>Tax</span>
                        <strong class="total">$0.00</strong>
                    </li>
                    <li class="shipping-fee-container list-group-item d-flex justify-content-between hidden">
                        <span>Shipping Fee</span>
                        <strong class="total">$0.00</strong>
                    </li>
                    <li class="subtotal-container list-group-item d-flex justify-content-between">
                        <span>Total (USD)</span>
                        <strong class="total">${{ $cartData->getSubTotal() }}</strong>
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
                {{ Form::open(['route' => 'frontend.checkout.add_guest_address', 'id' => 'user_shipping', 'class' => 'form-horizontal needs-validation', 'role' => 'form', 'method' => 'post', 'files' => true, 'novalidate' => true]) }}
                    <h4 class="mb-3">Shipping address</h4>
                    {{ Form::hidden('type', 'shipping') }}
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
                        <input type="email" name="email" class="form-control" id="email" placeholder="you@example.com" required>
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
                            <label for="city">City</label>
                            <input type="text" name="city" class="form-control" id="city" placeholder="" required>
                            <div class="invalid-feedback">
                                City is required.
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="zip">Zip</label>
                        <input type="text" name="postal_code" class="form-control" id="zip" placeholder="" required>
                        <div class="invalid-feedback">
                            Zip code required.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="" required>
                        <div class="invalid-feedback">
                            Phone Number required.
                        </div>
                    </div>
                    <button id="shipping_submit" class="btn btn-primary btn-lg btn-block" type="submit" style="margin-bottom: 3rem !important;">Proceed Next</button>
                {{ Form::close() }}




                <hr class="mb-4">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" checked class="custom-control-input" id="same-address">
                    <label class="custom-control-label" for="same-address">Billing address is the same as my Shipping address</label>
                </div>
                <hr class="mb-4">


                

                {{ Form::open(['route' => 'frontend.checkout.add_guest_address', 'id' => 'user_billing', 'class' => 'form-horizontal needs-validation hidden', 'role' => 'form', 'method' => 'post', 'files' => true]) }}
                    <h4 class="mb-3">Billing address</h4>
                    {{ Form::hidden('type', 'billing') }}
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="firstName">First name</label>
                            <input type="text" name="first_name" class="form-control" id="billing_firstName" placeholder="First Name" required>
                            <div class="invalid-feedback">
                                Valid first name is required.
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="lastName">Last name</label>
                            <input type="text" name="last_name" class="form-control" id="billing_lastName" placeholder="Last Name" required>
                            <div class="invalid-feedback">
                                Valid last name is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email <span class="text-muted">(Required)</span></label>
                        <input type="email" name="email" class="form-control" id="billing_email" placeholder="you@example.com">
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" name="address" class="form-control" id="billing_address" placeholder="1234 Main St" required>
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                        <input type="text" name="street" class="form-control" id="billing_address2" placeholder="Apartment or suite">
                    </div>

                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="country">Country</label>
                            <select name="country" class="custom-select d-block w-100" id="billing_country" required>
                                <option value="US" selected>United States</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state">State</label>
                            <select name="state" class="custom-select d-block w-100" id="billing_state" required>
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
                            <label for="city">City</label>
                            <input type="text" name="city" class="form-control" id="billing_city" placeholder="" required>
                            <div class="invalid-feedback">
                                City is required.
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="zip">Zip</label>
                        <input type="text" name="postal_code" class="form-control" id="billing_zip" placeholder="" required>
                        <div class="invalid-feedback">
                            Zip code required.
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" class="form-control" id="billing_phone" placeholder="" required>
                        <div class="invalid-feedback">
                            Phone Number required.
                        </div>
                    </div>

                    <button id="billing_submit" class="btn btn-primary btn-lg btn-block" type="submit" style="margin-bottom: 3rem !important;">Proceed Next</button>

                    <hr class="mb-4">
                {{ Form::close() }}


                {{ Form::open(['route' => 'frontend.checkout.stripe', 'id' => 'user_payment', 'class' => 'form-horizontal needs-validation', 'role' => 'form', 'method' => 'post', 'files' => true]) }}
                    <h4 class="mb-3">Payment</h4>
                    <div class="d-block my-3">
                        <div class="custom-control custom-radio">
                            <input id="credit" name="paymentMethod" type="radio" class="custom-control-input payment-type" value="credit" checked required>
                            <label class="custom-control-label" for="credit">Credit card</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="debit" name="paymentMethod" type="radio" class="custom-control-input payment-type" value="debit" required>
                            <label class="custom-control-label" for="debit">Debit card</label>
                        </div>
                        <div class="custom-control custom-radio">
                            <input id="paypal" name="paymentMethod" type="radio" class="custom-control-input payment-type" value="paypal" required>
                            <label class="custom-control-label" for="paypal">Paypal</label>
                        </div>
                    </div>
                    <div class="row card-details-container">
                        <div class="col-md-6 mb-3">
                            <label for="cc-name">Name on card</label>
                            <input type="text" class="form-control" name="cc_name" id="cc-name" placeholder="John" required>
                            <small class="text-muted">Full name as displayed on card</small>
                            <div class="invalid-feedback">
                                Name on card is required
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="cc-number">Credit card number</label>
                            <input type="number" maxlength="20" class="form-control" name="cc_card_no" id="cc-number" placeholder="" required>
                            <div class="invalid-feedback">
                                Credit card number is required
                            </div>
                        </div>

                        <div class="col-md-2 mb-2">
                            <label for="cc-expiration">Month</label>
                            <select name="cc_expiry_month" class="custom-select d-block w-50" id="cc_expiry_month" required>
                                @for($i = 1; $i <= 12; $i++)
                                    <option value="{{str_pad($i, 2, '0', STR_PAD_LEFT)}}" @php if($i == 1){ echo 'selected'; } @endphp>{{str_pad($i, 2, '0', STR_PAD_LEFT)}}</option>
                                @endfor
                            </select>
                            <div class="invalid-feedback">
                                Expiration Month required
                            </div>
                        </div>
                        <div class="col-md-2 mb-2">
                            <label for="cc-expiration">Year</label>
                            <select name="cc_expiry_year" class="custom-select d-block w-50" id="cc_expiry_year" required>
                                @for($i = date('Y'); $i <= 2050; $i++)
                                    <option value="{{ $i }}" @php if($i == date('Y')){ echo 'selected'; } @endphp>{{ $i }}</option>
                                @endfor
                            </select>
                            <div class="invalid-feedback">
                                Expiration Year required
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="cc-expiration">CVV</label>
                            <input type="text" class="form-control" name="cc_cvv" id="cc-cvv" placeholder="" required>
                            <div class="invalid-feedback">
                                Security code required
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button class="btn btn-primary btn-lg btn-block" type="submit" style="margin-bottom: 7rem !important;">Proceed to Payment</button>
                        </div>
                    </div>
                    <div class="row paypal-container" style="display: none;">
                        <div class="col-md-12">
                            <a href="{{ route('frontend.checkout.before-payment') }}" class="btn btn-primary btn-lg btn-block" style="margin-bottom: 7rem !important;">Proceed to Paypal</a>
                        </div>
                    </div>
                    <hr class="mb-4">

                {{ Form::close() }}

            </div>
        </div>
    </div>
@endsection

@section('after-scripts')
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script>
    $(document).ready(function(){
        $("#user_payment").fadeOut();

        $("#same-address").on("change", function (e) {
            if($(this).is(':checked'))
            {
                $("#user_billing").addClass("hidden");
            }
            else
            {
                $("#user_billing").removeClass("hidden");
            }
        });

        $(".payment-type").on("change", function(){
            if($(this).val() == 'paypal')
            {
                $(".card-details-container").fadeOut("slow");
                $(".paypal-container").fadeIn("slow");
            }
            else
            {
                $(".paypal-container").fadeOut("slow");
                $(".card-details-container").fadeIn("slow");
            }
        });

        function copySameData()
        {
            $("#user_shipping input, #user_shipping select").each(function(){
                if($(this).attr('type') != "hidden")
                {
                    var inputName = $(this).attr('name');
                    var inputVal = $(this).val();

                    $("#user_billing input, #user_billing select").filter(':visible').each(function(){

                        if($(this).attr('name') == inputName)
                        {
                            $(this).val(inputVal);
                        }
                    });
                }
            });
        }

        $("#user_shipping").validate({
            ignore: ":hidden",
            rules: {
                first_name: {
                    required: true,
                    minlength: 3
                },
                last_name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                address: {
                    required: true,
                    minlength: 3
                },
                country: {
                    required: true
                },
                state: {
                    required: true
                },
                city: {
                    required: true,
                    minlength: 3
                },
                postal_code: {
                    required: true,
                    number: true
                },
                phone: {
                    required: true,
                    number: true
                }
            },
            submitHandler: function (form) {
                $.ajax({
                    url:      $("#user_shipping").attr('action'),
                    type:     $("#user_shipping").attr('method'),
                    data:     $("#user_shipping").serialize(),
                    success: function(data) {
                        //console.log(data.rates);
                        if(data.rates)
                        {
                            alert("Shipping Charges Added: $"+data.rates);
                            $("#user_payment").fadeIn("slow");
                            if($("#same-address").is(':checked'))
                            {
                                copySameData();
                                $("#billing_submit").trigger('click');
                            }
                            $(".tax-container strong").text("$"+data.tax);
                            $(".shipping-fee-container strong").text("$"+data.rates);
                            $(".subtotal-container strong").text("$"+data.subtotal);
                        }
                        else
                        {
                            alert(data.error);
                        }
                    },
                    error: function () {
                        alert("Error in Validating Address");
                    }
                });
            }
        });

        $("#user_billing").validate({
            ignore: ":hidden",
            rules: {
                first_name: {
                    required: true,
                    minlength: 3
                },
                last_name: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                address: {
                    required: true,
                    minlength: 3
                },
                country: {
                    required: true
                },
                state: {
                    required: true
                },
                city: {
                    required: true,
                    minlength: 3
                },
                postal_code: {
                    required: true,
                    number: true
                },
                phone: {
                    required: true,
                    number: true
                }
            },
            submitHandler: function (form) {
                $.ajax({
                    url:      $("#user_billing").attr('action'),
                    type:     $("#user_billing").attr('method'),
                    data:     $("#user_billing").serialize(),
                    success: function(data) {

                    },
                    error: function () {
                        alert("Error in Shipping Address");
                    }
                });
            }
        });
    });
    </script>
@endsection