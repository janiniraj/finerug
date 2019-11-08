<p>New Dealer Request has been Submitted, Please find below details.</p>

<p><strong>First Name:</strong> {{ $data['firstname'] }}</p>
<p><strong>Last Name:</strong> {{ $data['lastname'] }}</p>
<p><strong>Company:</strong> {{ $data['company'] }}</p>
<p><strong>Email:</strong> {{ $data['email'] }}</p>
<p><strong>Form:</strong> <a download="form.pdf" href="{{ $data['form'] }}">Download Form</a></p>