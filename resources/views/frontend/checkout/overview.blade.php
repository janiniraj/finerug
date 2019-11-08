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
                        <td><a href="{{ route('frontend.product.show', $singleValue->attributes->product_id) }}"><img class="cart-product-image" src="{{ admin_url().'/img/products/thumbnail/'.$images[0] }}" /></a> </td>
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

                @if($cartData->getConditionsByType('coupon')->count() > 0)
                    @foreach($cartData->getConditionsByType('coupon') as $couponK => $couponV)
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>{{ $couponV->getName() }}</td>
                            <td class="text-right">$ {{ str_replace('+', '', $couponV->getValue()) }}</td>
                        </tr>
                    @endforeach                    
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