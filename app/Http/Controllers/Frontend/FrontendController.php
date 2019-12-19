<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Repositories\Backend\Categories\CategoriesRepository;
use App\Repositories\Backend\HomeSlider\HomeSliderRepository;
use App\Repositories\Backend\SubCategories\SubCategoriesRepository;
use App\Repositories\Backend\Product\ProductRepository;
use Illuminate\Http\Request;
use App\Repositories\Backend\Subscription\SubscriptionRepository;
use App\Repositories\Backend\Color\ColorRepository;
use Cookie;

/**
 * Class FrontendController.
 */
class FrontendController extends Controller
{

    public function __construct()
    {
        $this->categories       = new CategoriesRepository();
        $this->subcategories    = new SubCategoriesRepository();
        $this->homeSlider       = new HomeSliderRepository();
        $this->product          = new ProductRepository();
        $this->subscription     = new SubscriptionRepository();
        $this->color            = new ColorRepository();
    }

    /**
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories     = $this->categories->query()->where('status', 1)->get();
        $collections    = $this->subcategories->query()->where('status', 1)->get();
        $slides         = $this->homeSlider->query()->where('page_type', 'homepage')->get();

        $newArrivals    = $this->product->query()->where('created_at', '>=', date('Y-m-d', strtotime("-1 month")))->limit(10)->get();

        $furnitures    = $this->product->query()->where('type','furniture')->limit(10)->get();

        $colorList      = $this->color->getAllActive();

        return view('frontend.index')->with([
            'categories'    => $categories,
            'slides'        => $slides,
            'collections'   => $collections,
            'newArrivals'   => $newArrivals,
            'furnitures'	=> $furnitures,
            'colorList'     => $colorList
        ]);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function macros()
    {
        return view('frontend.macros');
    }

    public function emailSubscription(Request $request)
    {
        $flag = $this->subscription->create($request->all());

        if($flag)
        {
            //return redirect()->route('frontend.index')->withFlashSuccess('Thank you for Subscribing.');
            return response()->json(['success' => true, 'message' => 'Thank you for Email signup.']);
        }
        else
        {
            //return redirect()->route('frontend.index')->withFlashWarning('Error in adding email in subscription list.');
            return response()->json(['success' => false, 'message' => 'Email already exist in subscription list.']);
        }
    }
}
