<html>
Dear {{ $offerData->first_name }} {{ $offerData->last_name }},
<br/>
<br/>
You have made request on product, please <a href="{{ route('frontend.product.show', $offerData->product_id) }}">click here</a> to view.
Message from Admin: {{ $postData['description'] }}
</html>