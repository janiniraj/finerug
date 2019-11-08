{{ Form::open(array('url' => route('frontend.page.contact-submit'))) }}
    <p>Leave a Message</p>
    <div class="form-group">
        <input type="text" name="name" required="required" class="form-control" id="name" placeholder="Your Name">
        <input type="email" name="email" required="required" class="form-control" id="email" placeholder="Your Email">
    </div>
    <div class="form-group">
        <textarea class="form-control" name="message" required="required" rows="5" id="message" placeholder="Your Message"></textarea>
    </div>

    <div class="submit-btn">
        <button type="submit" class="btn btn-default">SEND</button>
    </div>
{{ Form::close() }}