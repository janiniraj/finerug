<?php
use App\Helpers\Frontend\MenuHelper;
$helper = new MenuHelper();
?>
<div class="container-fluid" id="footer">
    <div class="row">
        <div class="col-sm-7 links">
            <ul>
                <li class="list-heading no-arrow "><a href="{{ route('frontend.page.about-us') }}">About Us</a></li>
                <li><a href="{{ route('frontend.page.history') }}">History</a></li>
                <li><a href="{{ route('frontend.page.awards-certifications') }}">Awards & Certifications</a></li>
                <li><a href="{{ route('frontend.page.terms-conditions') }}">Term and Condition</a></li>
                <li><a href="{{ route('frontend.page.privacy-policy') }}">Privacy Policy</a></li>
                <li><a href="{{ route('frontend.page.return-policy') }}">Return Policy</a></li>
                <li><a href="{{ route('frontend.page.show-room') }}">Show Room</a></li>
                <li><a href="{{ route('frontend.page.site-map') }}">Site Map</a></li>
            </ul>
            <ul>
                <li class="list-heading no-arrow"><a href="{{ route('frontend.page.contact-us') }}">Contact Us</a></li>
                <li><a href="{{ route('frontend.page.cleaning-restoration') }}">Cleaning & Restoration</a></li>
                <li><a href="{{ route('frontend.page.padding') }}">Padding</a></li>
                <li><a href="{{ route('frontend.page.rug-school') }}">Rug School</a></li>
                <li><a href="{{ route('frontend.page.hospitality') }}">Hospitality</a></li>
                <li class="no-arrow">&nbsp;</li>
                <li class="list-heading no-arrow">Association</li>
                <li><a href="#">ABCD</a></li>
                <li><a href="#">EFGH</a></li>
            </ul>
            <ul>
                <li class="list-heading no-arrow">CONNECT WITH US</li>
                <li><a href="{{ route('frontend.page.contact-us') }}">Contact Us</a></li>
                <li><a href="{{ route('frontend.page.become-dealer') }}">Become a Dealer</a></li>
                <li><a href="{{ route('frontend.page.careers') }}">Careers</a></li>
                <li><a href="#">Affiliate Log In</a></li>
                <li><a target="_blank" href="{{ $helper->catalogLink }}">View Catalogue</a></li>
            </ul>
            <ul>
                <li class="list-heading no-arrow">FOLLOW US</li>
                <li><a href="#">Facebook <i class="fab fa-facebook-f"></i></a></li>
                <li><a href="#">Twitter <i class="fab fa-twitter"></i></a></li>
                <li><a href="#">Instagram <i class="fab fa-instagram"></i></a></li>
                <li><a href="#">Youtube <i class="fab fa-youtube"></i></a></li>
            </ul>
        </div>

        <div class="col-sm-5 contacts">
            {{ Form::open(array('url' => route('frontend.email-subscription'))) }}
                <label for="email">SIGN UP FOR EMAILS</label>
                <div class="input-group">
                    <input type="email" class="form-control" required name="email">
                    <div class="input-group-btn">
                        <button class="btn btn-default" type="submit">SUBMIT</button>
                    </div>
                </div>
            {{ Form::close() }}
            <ul>
                <li><a href="{{ route('frontend.page.store') }}">Where to Buy</a></li>
                <li><a href="{{ route('frontend.page.faq') }}">FAQ</a></li>
            </ul>
        </div>

    </div>

    <div class="copyrights"><p>© 2018 All Rights Reserved</p></div>
</div>