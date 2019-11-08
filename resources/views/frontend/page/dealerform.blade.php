<div class="row download-section">
    <div class="col-lg-10 col-lg-offset-1 download-links">
        <a download="application.pdf" href="{{ $vendorFormLink }}" class="btn">Download Application</a>
        <a download="application.pdf"  href="{{ $vendorFormLink }}" class="btn">Download International Application</a>
        <a download="application.pdf"  href="{{ $vendorFormLink }}" class="btn">Return Form</a>
    </div>
</div>
<div class="row application">
    <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2">
        {{ Form::open(array('url' => route('frontend.page.dealer-submit'), 'files' => true)) }}

            <div class="form-group">
                <input type="text" required class="form-control" id="firstname" placeholder="First Name" name="firstname">
            </div>
            <div class="form-group">
                <input type="text" required class="form-control" id="lastname" placeholder="Last Name" name="lastname">
            </div>
            <div class="form-group">
                <input type="text" required class="form-control" id="company" placeholder="Company Name" name="company">
            </div>
            <div class="form-group">
                <input type="email" required class="form-control" id="email" placeholder="Enter email" name="email">
            </div>
            <div class="form-group upload-file">
                <label for="upload">Upload Application</label>
                <input accept="application/pdf" required type="file" id="upload" name="form">
            </div>

            <div class="submit-button">
                <button type="submit" class="btn btn-default">Submit Application</button>
            </div>
        {{ Form::close() }}
    </div>
</div>