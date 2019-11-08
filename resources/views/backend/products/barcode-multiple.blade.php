@foreach($products as $product)
	<div class="new-box">
		<p>Name : {{ $product->name }}</p>
		<p>SKU : {{ $product->sku }}</p>
		<p>Supplier SKU : {{ $product->supplier_sku }}</p>
		<p>Material : {{ isset($product->material->name) ? $product->material->name : "" }}</p>
		<img src="data:image/png;base64,{{ $product->barcode_image }}" />
		<p>{{ $product->barcode }}</p>
	</div>
@endforeach