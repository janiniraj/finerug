<div class="col-sm-4">
    <div class="card">
        <article class="card-group-item">
            <header class="card-header"><h6 class="title">My Details </h6></header>
            <div class="filter-content">
                <div class="list-group list-group-flush">
                    <a href="{{ route('frontend.account.my-account') }}" class="list-group-item">My Account</a>
                    <a href="{{ route('frontend.product.favourites') }}" class="list-group-item">My Wishlist</a>
                    <a href="{{ route('frontend.account.my-orders') }}" class="list-group-item">My Orders</a>
                    <a href="{{ route('frontend.account.my-addresses') }}" class="list-group-item">My Addresses</a>
                    <a href="#" class="list-group-item">Track Last Order</a>
                    <a href="{{ route('frontend.account.edit-profile') }}" class="list-group-item">Edit Profile</a>
                    <a href="{{ route('frontend.auth.logout') }}" class="list-group-item">Logout</a>
                </div>  <!-- list-group .// -->
            </div>
        </article>
    </div>
</div> <!-- col.// -->