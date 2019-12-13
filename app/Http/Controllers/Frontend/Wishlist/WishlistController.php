<?php

namespace App\Http\Controllers\Frontend\Wishlist;

use App\Http\Controllers\Controller;

use App\Repositories\Backend\Product\ProductRepository;

use Illuminate\Http\Request;
use Redirect;
use Auth;

use DB;

use Session, Cart, Wishlist;


/**
 * Class WishlistController.
 */
class WishlistController extends Controller
{

    /**
     * @var ProductRepository
     */
    protected $products;

    /**
     * ProductController constructor.
     */
    public function __construct()
    {
        $this->products         = new ProductRepository();
    }

    public function addToWishlist(Request $request, $productId)
    {
        if(Auth::check())
        {
            $userId = Auth::user()->id;

            $existWishlist = Wishlist::getWishlistItem($productId, $userId);

            if($existWishlist == null)
            {
                Wishlist::add($productId, $userId);

                return response()->json([
                    'success' => true,
                    'message' => 'Product Successfully added into Favourite list.'
                ], 200);

            }
            else
            {
                return response()->json([
                    'success' => false,
                    'message' => 'Product Already Exist in Favourite list.'
                ], 200);
            }
        }
        else
        {
            return response()->json([
                'success' => false,
                'message' => 'Please login first to add product into Favourite list.'
            ], 200);
        }
    }

    public function index(Request $request)
    {
        if(!Auth::check())
        {
            return redirect()->route('frontend.index')->withFlashWarning("Login first to add products in favourite.");;
        }
    }
}
