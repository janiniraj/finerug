<p>You have a new request for Estimate</p>
<p>Below are the details:</p>

<p><strong>{{ trans('validation.attributes.frontend.name') }}:</strong> {{ $request->name }}</p>
<p><strong>{{ trans('validation.attributes.frontend.email') }}:</strong> {{ $request->email }}</p>
<p><strong>{{ trans('validation.attributes.frontend.phone') }}:</strong> {{ $request->phone or "N/A" }}</p>
<p><strong>Pickup Location:</strong> {{ $request->location or "N/A" }}</p>
<p><strong>Pickup Date:</strong> {{ $request->date or "N/A" }}</p>
<p><strong>{{ trans('validation.attributes.frontend.message') }}:</strong> {{ $request->message }}</p>