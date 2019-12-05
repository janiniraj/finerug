<?php

namespace App\Http\Controllers\Frontend\Product;

use App\Http\Controllers\Controller;

use App\Repositories\Backend\Product\ProductRepository;

use Illuminate\Http\Request;
use App\Repositories\Backend\Categories\CategoriesRepository;

use App\Repositories\Backend\SubCategories\SubCategoriesRepository;

use App\Repositories\Backend\Style\StyleRepository;

use App\Repositories\Backend\Material\MaterialRepository;
use App\Repositories\Backend\Weave\WeaveRepository;
use App\Repositories\Backend\Color\ColorRepository;
use App\Models\Product\ProductColor;
use App\Models\Product\UserFavourite;
use App\Models\Product\ProductReview;
use App\Models\Product\ProductSize;
use Redirect;
use Auth;
use App\Models\Offer\Offer;

use DB;

use Session, Cart;

use Illuminate\Support\Facades\Mail;
use Illuminate\Mail\Mailable;


/**
 * Class ProductController.
 */
class ProductController extends Controller
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
        $this->categories       = new CategoriesRepository();
        $this->subcategories    = new SubCategoriesRepository();
        $this->style            = new StyleRepository();
        $this->material         = new MaterialRepository();
        $this->weave            = new WeaveRepository();
        $this->color            = new ColorRepository();
        $this->productColor 	= new ProductColor();
        $this->userFavourite    = new UserFavourite();
        $this->productReview    = new ProductReview();
        $this->productSize      = new ProductSize();
	
    }

    /**
     * Product List
     *
     * @param $categoryName
     * @param Request $request
     * @return $this
     */
    public function index($categoryName = NULL, Request $request)
    {
        $filterData = $request->all();

        if(isset($filterData['category']) && $filterData['category'])
        {
            $categoryId = $filterData['category'];
            unset($filterData['category']);
            $appendData = http_build_query($filterData);
            $categoryName = $this->categories->getCategoryNameById($categoryId);
            return Redirect::to('products/'.$categoryName.'?'.$appendData);
        }

        if($categoryName)
        {
            $categoryId     = $this->categories->getCategoryIdByName($categoryName);
            $collectionList = $this->subcategories->getSubCategoriesByCategory($categoryId); 
        }
        else
        {
            $collectionList = $this->subcategories->getAll();
        }

        $categoryList   = $this->categories->getAll();        
        $styleList      = $this->style->getAll();
        $materialList   = $this->material->getAll();
        $weaveList      = $this->weave->getAll();
        $colorList      = $this->color->getAll();

		DB::enableQueryLog();
		$productsAll = $this->products->query();
        $products = $this->products->query();

        if(isset($categoryId) && $categoryId)
        {
            $products = $products->where('products.category_id', $categoryId);
        }        

        if(!empty($filterData))
        {
            if(isset($filterData['type']) && $filterData['type'] != 'all')
            {
                $products = $products->where('products.type', $filterData['type']);
				$productsAll->where('products.type', $filterData['type']);
            }

            if(isset($filterData['collection']) && $filterData['collection'])
            {
                $products = $products->where('products.subcategory_id', $filterData['collection']);
            }

            if(isset($filterData['style']) && $filterData['style'])
            {
                $products = $products->where('products.style_id', $filterData['style']);
            }

            if(isset($filterData['material']) && $filterData['material'])
            {
                $products = $products->where('products.material_id', $filterData['material']);
            }

            if(isset($filterData['weave']) && $filterData['weave'])
            {
                $products = $products->where('products.weave_id', $filterData['weave']);
            }

            if(isset($filterData['color']) && $filterData['color'])
            {
                $products = $products->join('product_colors as pc', 'pc.product_id', '=', 'products.id')->select('products.*')->where('pc.color_id', $filterData['color']);
            }

            if(isset($filterData['shape']) && $filterData['shape'])
            {
                $products = $products->where('products.shape', $filterData['shape']);
            }
			
            if(isset($filterData['unit_width']) && $filterData['unit_width'] && isset($filterData['width_min']) && $filterData['width_min'] && isset($filterData['width_max']) && $filterData['width_max'])
            {
                if($filterData['unit_width'] == 'inch')
                {
                    $filterData['width_min'] = $filterData['width_min']/12;
                    $filterData['width_max'] = $filterData['width_max']/12;
                }
                $products = $products->whereBetween('width', [$filterData['width_min'], $filterData['width_max']]);
            }
			
			if(isset($filterData['sizes']) && count($filterData['sizes'])>0){
				$products = $products->join('product_sizes', 'product_sizes.product_id', '=', 'products.id')->select("products.*");
				$i = 0;
				foreach($filterData['sizes'] as $sizestr){
					$tempArr = explode("x",$sizestr);
					if($i==0) $products = $products->where(["product_sizes.width"=>$tempArr[0],"product_sizes.length"=>$tempArr[1]]);
					else $products = $products->orWhere(["product_sizes.width"=>$tempArr[0],"product_sizes.length"=>$tempArr[1]]);
					$i++;
				}
				
				//$products = $products->get();
			}
            if(isset($filterData['unit_length']) && $filterData['unit_length'] && isset($filterData['length_min']) && $filterData['length_min'] && isset($filterData['length_max']) && $filterData['length_max'])
            {
                if($filterData['unit_length'] == 'inch')
                {
                    $filterData['width_min'] = $filterData['width_min']/12;
                    $filterData['width_max'] = $filterData['width_max']/12;
                }
                $products = $products->whereBetween('length', [$filterData['length_min'], $filterData['length_max']]);
            }

            if(isset($filterData['search']) && $filterData['search'])
            {
                $products = $products->where('products.name', 'LIKE', "%".$filterData['search']."%");
                $products = $products->orWhere('products.sku', 'LIKE', "%".$filterData['search']."%");
            }

            if(isset($filterData['sku']) && $filterData['sku'])
            {
                $products = $products->where('products.sku', 'LIKE', "%".$filterData['sku']."%");
            }

            if(isset($filterData['country']) && $filterData['country'])
            {
                $products = $products->where('products.country_origin', $filterData['country']);
            }

            if(isset($filterData['knote_per_sq']) && $filterData['knote_per_sq'])
            {
                $products = $products->where('products.knote_per_sq', $filterData['knote_per_sq']);
            }

            if(isset($filterData['foundation']) && $filterData['foundation'])
            {
                $products = $products->where('products.foundation', $filterData['foundation']);
            }

            if(isset($filterData['border_color']) && $filterData['border_color'])
            {
                $products = $products->where('products.border_color_id', $filterData['border_color']);
            }
            
			if(isset($filterData['brand']) && $filterData['brand'])
            {
                $products = $products->where('products.brand', $filterData['brand']);
            }
			if(isset($filterData['discount']) && $filterData['discount'])
            {
                $products = $products->where('products.discount', $filterData['discount']);
            }
			
			if(isset($filterData['price_range']) && $filterData['price_range'])
            {
				$priceArray = explode(";",$filterData['price_range']);
                $products = $products->whereBetween('products.price', $priceArray);
            }
        }
		//echo $products->tosql();

        $categoryParam      = clone $productsAll; 
        $collectionParam    = clone $productsAll;
        $styleParam         = clone $productsAll;
        $materialParam      = clone $productsAll;
        $weaveParam         = clone $productsAll;
        $colorParam         = clone $productsAll;
        $brandParam         = clone $productsAll;
        $sizeParam          = clone $productsAll;
        $discountParam      = clone $productsAll;

        $products   = $products->paginate(config('constant.perPage'));
		/*
		$laQuery = DB::getQueryLog();
		echo "<pre>";
		print_r($laQuery);
		echo "</pre>";
		*/

        $categoryList = $categoryParam->join('categories', 'categories.id', '=', 'products.category_id')->select('categories.*')->groupBy('products.category_id')->get();

        $collectionList = $collectionParam->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')->select('subcategories.*')->groupBy('products.subcategory_id')->get();

        $styleList = $styleParam->join('styles', 'styles.id', '=', 'products.style_id')->select('styles.*')->groupBy('products.style_id')->get();

        $materialList = $materialParam->join('materials', 'materials.id', '=', 'products.material_id')->select('materials.*')->groupBy('products.material_id')->get();

        $weaveList = $weaveParam->join('weaves', 'weaves.id', '=', 'products.weave_id')->select('weaves.*')->groupBy('products.weave_id')->get();

		$colorList = $colorParam->join('product_colors', 'product_colors.product_id', '=', 'products.id')->join('colors','colors.id','=','product_colors.color_id')->select('colors.*')->groupBy('colors.id')->get();

		$sizeList = $sizeParam->join('product_sizes', 'product_sizes.product_id', '=', 'products.id')->select('product_sizes.*')->groupBy('product_sizes.width','product_sizes.length')->get();
		
		
			
		$brandList = $brandParam->select('brand')->groupBy('brand')->get();
		$discountList = $discountParam->select('discount')->where('discount','>',0)->groupBy('discount')->get();
        $filterDisplay = [];

        $labelType= [
            'type'          => 'Product',
            'category'      => 'Category',
            'collection'    => 'Collection',
            'style'         => 'Style',
            'material'      => 'Material',
            'weave'         => 'Weave',
            'shape'         => 'Shape',
            'country'       => 'Country of Origin',
            'knote_per_sq'  => 'Knots per Sq',
            'foundation'    => 'Foundation',
            'sku'           => 'Item Number',
            'discount'      => 'Discount'
        ];

        foreach ($filterData as $singleKey => $singleValue)
        {
            if(in_array($singleKey,array_keys($labelType)) && $singleValue)
            {
                $filterDisplay[$labelType[$singleKey]] = $labelType[$singleKey] . ' : ' . ucfirst($singleValue);
            }

            if($singleKey == 'type' && $singleValue)
            {
                $filterDisplay['Product'] = 'Product : '. ucfirst($singleValue);
            }

            if($categoryName)
            {
                $filterDisplay['Category'] = 'Category : '. ucfirst($categoryName);
            }

            if($singleKey == 'collection' && $singleValue)
            {
                $filterDisplay['Collection'] = 'Collection : '. ucfirst($this->subcategories->find($singleValue)->subcategory);
            }

            if($singleKey == 'style' && $singleValue)
            {
                $filterDisplay['Style'] = 'Style : '. ucfirst($this->style->find($singleValue)->name);
            }

            if($singleKey == 'material' && $singleValue)
            {
                $filterDisplay['Material'] = 'Material : '. ucfirst($this->material->find($singleValue)->name);
            }

            if($singleKey == 'weave' && $singleValue)
            {
                $filterDisplay['Weave'] = 'Weave : '. ucfirst($this->weave->find($singleValue)->name);
            }

            if($singleKey == 'shape' && $singleValue)
            {
                $filterDisplay['Weave'] = 'shape : '. ucfirst($singleValue);
            }

            if($singleKey == 'color' && $singleValue)
            {
                $filterDisplay['Color'] = $this->color->find($singleValue)->name;
            }

            if($singleKey == 'border_color' && $singleValue)
            {
                $filterDisplay['Border Color'] = $this->color->find($singleValue)->name;
            }
            if($singleKey == 'brand' && $singleValue)
            {
                $filterDisplay['Brand'] = 'Brand : '. ucfirst($singleValue);
            }
            if($singleKey == 'discount' && $singleValue)
            {
                $filterDisplay['Discount'] = 'Discount : '. ($singleValue)." %";
            }
			
            if($singleKey == 'price_range' && $singleValue)
            {
				$priceArray = explode(";",$singleValue);
				if($priceArray[0]!=0 && $priceArray[1]!=10000) $filterDisplay['Price Range'] = 'Price range : '.$priceArray[0]." - ".$priceArray[1];
            }
            if($singleKey == 'sizes' && count($singleValue)>0)
            {
				$filterDisplay['Size'] = 'Size : '. implode(' , ', $singleValue);
			}
        }
		/*
        $sizeDisplay = [];

        if(isset($filterData['width_min']) && $filterData['width_min'] && isset($filterData['width_max']) && $filterData['width_max'])
        {
            $sizeDisplay[] = 'Width : '.$filterData['width_min']. ' - '. $filterData['width_max'].' '. ucfirst($filterData['unit_width']);
        }

        if(isset($filterData['length_min']) && $filterData['length_min'] && isset($filterData['length_max']) && $filterData['length_max'])
        {
            $sizeDisplay[] = 'Width : '.$filterData['length_min']. ' - '. $filterData['length_max'].' '. ucfirst($filterData['unit_length']);
        }

        if(!empty($sizeDisplay))
        {
            $filterDisplay['Size'] = 'Size : '. implode(' , ', $sizeDisplay);
        }
		*/
        return view('frontend.products.index')->with([
            'products'          => $products,
            'categoryList'      => $categoryList,
            'collectionList'    => $collectionList,
            'styleList'         => $styleList,
            'materialList'      => $materialList,
            'weaveList'         => $weaveList,
            'colorList'         => $colorList,
            'filterData'        => $filterData,
            'categoryId'        => isset($categoryId) ? $categoryId : '',
            'brandList'         => $brandList,
            'discountList'      => $discountList,
            //'clearanceList'     => $clearanceList,
            'sizeList'     		=> $sizeList,
            'filterDisplay'     => $filterDisplay
        ]);
    }

    /**
     * Product Show
     *
     * @param $productId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($productId)
    {
        $product = $this->products->find($productId);
        //$colorList  = DB::table('product_colors')->where('id','=',$product->color_id)->get();
        $colorList  = DB::table('product_colors')->join('colors', 'colors.id', '=', 'product_colors.color_id')->where('product_id',$productId)->get();
        $quantityList  = DB::table('product_sizes')->select('quantity')->where('product_id',$productId)->get();
		$waevesData = DB::table('weaves')->where('id','=',$product->weave_id)->get();
 		if(count($waevesData)>0) $product->waevesName = $waevesData[0]->name;
        $newArrivals = $this->products->query()->where('created_at', '>=', date('Y-m-d', strtotime("-1 month")))->limit(10)->get();

        $productLike = $this->products->query()
                        ->where('category_id', '=', $product->category_id)
                        ->orWhere('shape', '=', $product->shape)
                        ->orWhere('color_id', '=', $product->color_id)
                        ->inRandomOrder()
                        ->limit(10)
                        ->get();

        $favourite = 0;

        if(Auth::check())
        {
            $check = $this->userFavourite->where([
                'user_id'       => Auth::user()->id,
                'product_id'    => $productId
            ])->first();

            if($check)
            {
                $favourite = 1;
            }           

        }

        $reviews = $this->productReview->where('product_id', $productId)->join('users', 'users.id', '=', 'reviews.user_id')->select(['reviews.*', 'users.first_name', 'users.last_name'])->get();

        $averageStarQuery = $this->productReview->where('product_id', $productId)->select(DB::raw("SUM(star) as sumStar, COUNT(id) as countStar"))->first();
        $averageStar = 0;

        if($averageStarQuery->sumStar)
        {
            $averageStar = round($averageStarQuery->sumStar / $averageStarQuery->countStar);
        }

        return view('frontend.products.show')->with([
            'product'       => $product,
            'newArrivals'   => $newArrivals,
            'favourite'     => $favourite,
            'reviews'       => isset($reviews) ? $reviews : [],
            'averageStar'   => $averageStar,
            'productLike'   => $productLike,
			'colorList'		=> $colorList,
            'quantityList'     => $quantityList
            ]);
    }
	
	public function rate($productId,$sizeId){
		$product = $this->products->find($productId);
		foreach($product->size as $single){
			if($single->id==$sizeId){
				$data['cost'] = $single->length*$single->width*$single->msrp;
				$data['imap'] = $single->length*$single->width*$single->price_affiliate;
				break;
			}
		}
		return response()->json($data);
	}
	
	public function getQuantity($productId,$sizeId){
		$product = $this->products->find($productId);
		foreach($product->size as $single){
			if($single->id==$sizeId){
				$data['quantity'] = $single->quantity;
				break;
			}
		}
		return $data;
	}

    /**
     * New Arrival
     *
     * @param Request $request
     * @return $this
     */
    public function newArrival(Request $request)
    {
        $filterData = $request->all();

        $categoryList   = $this->categories->getAll();
        $collectionList = $this->subcategories->getAll();
        $styleList      = $this->style->getAll();
        $materialList   = $this->material->getAll();
        $weaveList      = $this->weave->getAll();
        $colorList      = $this->color->getAll();

        $products = $this->products->query();

        if(!empty($filterData))
        {
            if(isset($filterData['category']) && $filterData['category'])
            {
                $products = $products->where('category_id', $filterData['category']);
            }

            if(isset($filterData['collection']) && $filterData['collection'])
            {
                $products = $products->where('subcategory_id', $filterData['collection']);
            }

            if(isset($filterData['style']) && $filterData['style'])
            {
                $products = $products->where('style_id', $filterData['style']);
            }

            if(isset($filterData['material']) && $filterData['material'])
            {
                $products = $products->where('material_id', $filterData['style']);
            }

            if(isset($filterData['weave']) && $filterData['weave'])
            {
                $products = $products->where('weave_id', $filterData['weave']);
            }

            if(isset($filterData['color']) && $filterData['color'])
            {
                $products = $products->where('color_id', $filterData['color']);
            }

            if(isset($filterData['shape']) && $filterData['shape'])
            {
                $products = $products->where('shape', $filterData['shape']);
            }

            if(isset($filterData['unit_width']) && $filterData['unit_width'] && isset($filterData['width_min']) && $filterData['width_min'] && isset($filterData['width_max']) && $filterData['width_max'])
            {
                if($filterData['unit_width'] == 'inch')
                {
                    $filterData['width_min'] = $filterData['width_min']/12;
                    $filterData['width_max'] = $filterData['width_max']/12;
                }
                $products = $products->whereBetween('width', [$filterData['width_min'], $filterData['width_max']]);
            }

            if(isset($filterData['unit_length']) && $filterData['unit_length'] && isset($filterData['length_min']) && $filterData['length_min'] && isset($filterData['length_max']) && $filterData['length_max'])
            {
                if($filterData['unit_length'] == 'inch')
                {
                    $filterData['width_min'] = $filterData['width_min']/12;
                    $filterData['width_max'] = $filterData['width_max']/12;
                }
                $products = $products->whereBetween('length', [$filterData['length_min'], $filterData['length_max']]);
            }
        }

        $products = $products->where('created_at', '>=', date('Y-m-d', strtotime("-1 month")))->paginate(config('constant.perPage'));

        return view('frontend.products.new-arrival')->with([
            'products'          => $products,
            'categoryList'      => $categoryList,
            'collectionList'    => $collectionList,
            'styleList'         => $styleList,
            'materialList'      => $materialList,
            'weaveList'         => $weaveList,
            'colorList'         => $colorList
        ]);
    }

    /**
     * Add Favourites
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addFavourites(Request $request)
    {
        $postData = $request->all();

        if(isset($postData['product_id']) && $postData['product_id'])
        {
            $userCheck = Auth::check();
            if($userCheck == false)
            {
                return response()->json([
                    'error' => true,
                    'redirect' => true,
                    'message' => 'Login first to add to favourite.'
                ]);
            }

            $check = $this->userFavourite->where([
                'user_id'       => Auth::user()->id,
                'product_id'    => $postData['product_id']
            ])->first();

            if($postData['favourite'] == 0)
            {
                if(!empty($check))
                {
                    $this->userFavourite->where('id', $check->id)->delete();

                    return response()->json([
                        'success' => true,
                        'message' => 'Removed from Favourite List.'
                    ]);
                }
                else
                {
                    return response()->json([
                        'error' => true,
                        'message' => 'Add to Favourite List First.'
                    ]);
                }
            }
            else
            {
                if(!empty($check))
                {
                    return response()->json([
                        'error' => true,
                        'message' => 'Already Exist in Favourite List.'
                    ]);
                }
                else
                {
                    $this->userFavourite->create([
                        'user_id'       => Auth::user()->id,
                        'product_id'    => $postData['product_id']
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Successfully Added in Favourite List'
                    ]);
                }
            }
        }
        else
        {
            return response()->json([
               'error' => true,
               'message' => 'Error in Data'
            ]);
        }
    }

    public function favourites(Request $request)
    {
        if(!Auth::check())
        {
            return redirect()->route('frontend.index')->withFlashWarning("Login first to add products in favourite.");;
        }

        $user = AUth::user();

        $categoryList   = $this->categories->getAll();
        $collectionList = $this->subcategories->getAll();
        $styleList      = $this->style->getAll();
        $materialList   = $this->material->getAll();
        $weaveList      = $this->weave->getAll();
        $colorList      = $this->color->getAll();

        $products = $this->products->query();

        if(!empty($filterData))
        {
            if(isset($filterData['category']) && $filterData['category'])
            {
                $products = $products->where('category_id', $filterData['category']);
            }

            if(isset($filterData['collection']) && $filterData['collection'])
            {
                $products = $products->where('subcategory_id', $filterData['collection']);
            }

            if(isset($filterData['style']) && $filterData['style'])
            {
                $products = $products->where('style_id', $filterData['style']);
            }

            if(isset($filterData['material']) && $filterData['material'])
            {
                $products = $products->where('material_id', $filterData['style']);
            }

            if(isset($filterData['weave']) && $filterData['weave'])
            {
                $products = $products->where('weave_id', $filterData['weave']);
            }

            if(isset($filterData['color']) && $filterData['color'])
            {
                $products = $products->where('color_id', $filterData['color']);
            }

            if(isset($filterData['shape']) && $filterData['shape'])
            {
                $products = $products->where('shape', $filterData['shape']);
            }

            if(isset($filterData['unit_width']) && $filterData['unit_width'] && isset($filterData['width_min']) && $filterData['width_min'] && isset($filterData['width_max']) && $filterData['width_max'])
            {
                if($filterData['unit_width'] == 'inch')
                {
                    $filterData['width_min'] = $filterData['width_min']/12;
                    $filterData['width_max'] = $filterData['width_max']/12;
                }
                $products = $products->whereBetween('width', [$filterData['width_min'], $filterData['width_max']]);
            }

            if(isset($filterData['unit_length']) && $filterData['unit_length'] && isset($filterData['length_min']) && $filterData['length_min'] && isset($filterData['length_max']) && $filterData['length_max'])
            {
                if($filterData['unit_length'] == 'inch')
                {
                    $filterData['width_min'] = $filterData['width_min']/12;
                    $filterData['width_max'] = $filterData['width_max']/12;
                }
                $products = $products->whereBetween('length', [$filterData['length_min'], $filterData['length_max']]);
            }
        }

        $products = $products->join('user_favourites', 'user_favourites.product_id', '=', 'products.id')->where('user_favourites.user_id', $user->id)->paginate(config('constant.perPage'));

        return view('frontend.products.favourite')->with([
            'products'          => $products,
            'categoryList'      => $categoryList,
            'collectionList'    => $collectionList,
            'styleList'         => $styleList,
            'materialList'      => $materialList,
            'weaveList'         => $weaveList,
            'colorList'         => $colorList
        ]);

    }

    public function advanceSearch(Request $request)
    {
        $categoryList   = $this->categories->getAll();
        $collectionList = $this->subcategories->getAll();        
        $styleList      = $this->style->getAll();
        $materialList   = $this->material->getAll();
        $weaveList      = $this->weave->getAll();
        $colorList      = $this->color->getAll();

        return view('frontend.products.advance-search')->with([
            'categoryList'      => $categoryList,
            'collectionList'    => $collectionList,
            'styleList'         => $styleList,
            'materialList'      => $materialList,
            'weaveList'         => $weaveList,
            'colorList'         => $colorList
        ]);
    }

    public function writeReview(Request $request)
    {
        $postData = $request->all();
        $success = true;

        $userCheck = Auth::check();
        if($userCheck == false)
        {
            return response()->json([
                'success'   => false,
                'auth'      => false,
                'message'   => 'Login first to write a review.'
            ]);
        }

        $postData['user_id'] = Auth::user()->id;

        $reviewData = $this->productReview->create($postData);

        if($reviewData)
        {
            return response()->json([
                'success'   => true,
                'auth'      => true,
                'message'   => 'Thank you for writing Review.'
            ]);
        }
        else
        {
            return response()->json([
                'success'   => false,
                'auth'      => true,
                'message'   => 'Error in writing Review.'
            ]);
        }
    }
	
	public function getSuggestion(Request $request)
    {
        $data       = $request->all();
        $finalArray = [];

        if(isset($data['term']) && $data['term'])
        {
            // $products = $this->products->query()->where('status', 1)->where('name', 'LIKE', '%'.$data['term'].'%')->get();
            $products = $this->products->query()->where('name', 'LIKE', '%'.$data['term'].'%')->limit(5)->get();
			
            foreach ($products as $key => $value) 
            {
				
				$images = json_decode($value->main_image, true);
				$imgURL = "";
				if(count($images)>0) $imgURL = url('/'). '/img/products/thumbnail/'.$images[0];
                $finalArray[$key] = [
                    'id' => $value->id,
                    'label' => $value->name,
                    'value' => $value->name,
                    'imgPath' => $imgURL,
                    'price' => $value->price_affiliate
                ];
            }
        }
        return response()->json($finalArray);
    }	
	
   /**
     * @param Request $request
     * @return bool
     */
    public function addToCart(Request $request) 
    {
        
        $postData = $request->all();
		//dd($postData);
		
        $sizeData = $this->productSize->find($postData['size_id']);
        /*
        return response()->json([
            'success' => true,
            'message' => ''.$sizeData
        ]);
*/
       
        if($sizeData->quantity < $postData['quantity'])
        {
            return response()->json([
                'success' => false,
                'message' => 'Not Enough Quantity Available to Update.'
            ]);
        }
        
        $productData = $this->products->find($postData['product_id']);
		//dd($productData);
/*
        return response()->json([
            'success' => true,
            'message' => ''.$productData
        ]);
        */
        

        if(empty($sizeData) || empty($productData))
        {
            return response()->json([
                'success' => false,
                'message' => 'Product Size not available.'
            ]);
        }
      
        $length = $sizeData->length+0;
        $width = $sizeData->width+0;

        

        $explodedLength = explode(".", $length);
        $explodedWidth = explode(".", $width);
             
        if(isset($explodedLength[1])) {
            $sizeName = $explodedLength[0]."'".$explodedLength[1]."''" .' x '.$explodedWidth[0]."'";
        }
        else {
            $sizeName = $explodedLength[0]."'"."".' x '.$explodedWidth[0]."'";
        }

        if(isset($explodedWidth[1])) {
            $sizeName = $sizeName.$explodedWidth[1]."''";
        } 
        
        /* $sizeName = $explodedLength[0]."'".(isset($explodedLength[1]) ? $explodedLength[1]."''" : ""). ' x '. $explodedWidth[0]."'".(isset($explodedWidth[1]) ? $explodedWidth[1]."''" : ""); */

        //return response()->json([
         //   'success' => true,
          //  'message' => ''.$sizeName
        // ]);
         
        if(Auth::check())
        {
            $cartId = Auth::user()->id;
			//dd('test1');
        }
        else
        {
            if(Session::has('cartSessionId'))
            {
                $cartId = Session::get('cartSessionId');                
            }
            else
            {
                $cartId = rand(0,9999);
                session(['cartSessionId' => $cartId]);
            }
			//dd('test2');
        } 
		//dd($cartId);
        $cartData = Cart::session($cartId)->getContent();
		//dd($cartData);
		//Session::push('cart_items', $cartData);
		
        $updated = false;

        if(!empty($cartData))
        {
            foreach($cartData as $singleKey => $singleValue)
            {                
                //if(isset($singleValue->attributes->size_id) && isset($singleValue->attributes->product_id) && $singleValue->attributes->size_id == $postData['size_id'] && $singleValue->attributes->product_id == $postData['product_id'])
				if($singleValue->attributes->size_id == $postData['size_id'] && $singleValue->attributes->product_id == $postData['product_id'])
                {
                    $quantity = $singleValue->quantity+1;

                    Cart::session($cartId)->add($singleKey,$productData->name,$productData->price, $quantity,array(
                            'size'      => $sizeName,
                            'size_id'   => $sizeData->id,
                            'product_id' => $productData->id
                    ));
                    $updated = true;
                    break;
                }
            }

            if($updated == true)
            {
                return response()->json([
                    'success' => true,
                    'message' => 'Product Quantity Increased.'
                ]);
            }
        }

        /* $user = Auth::user();
        $role = $user->roles->first();
        if($role->name == 'Affiliate')
        {
            $price = $sizeData->price_affiliate;
        }
        else
        {
            $price = $sizeData->price;
        } */

	$price = $productData->price;
    
        $finalPrice = number_format($sizeData->width*$sizeData->length*$price, 2, '.', '');
        //dd($finalPrice);

        Cart::session($cartId)->add(rand(0,9999),$productData->name,$finalPrice, $postData['quantity'],array(
                'size'      => $sizeName,
                'size_id'   => $sizeData->id,
                'product_id' => $productData->id
        ));
        
		//$this->createActivityLog(Auth::user()->id, $productData->id, 'add_cart');
		
        return response()->json([
            'success' => true,
            'message' => 'Product Added to Cart.'
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Product Added to Cart.'."**".$postData['product_id']."**".$postData['size_id']
        ]);

    }

    public function cart(Request $request)
    {
        return view('frontend.products.cart');
    } 

    public function makeAnOfferUser(){
         if(Auth::check())
        {
            $userId = Auth::user()->id;
            $userDetails = $this->users
                        ->where('id', $userId)
                        ->first();
        }
        return view('frontend.products.show')->with([
                'userDetails'   => $userDetails
                ]);    
    }

	public function makeanOffer(Request $request){
		$postdata  = $request->all();

		$orderModel = new Offer();

        $orderModel->first_name = $postdata['first_name'];
        $orderModel->last_name = $postdata['last_name'];
        $orderModel->email = $postdata['email'];
        $orderModel->phone = $postdata['phone'];
        $orderModel->offer_price = $postdata['offer_price'];
        $orderModel->product_id = $postdata['product_id'];

        if($orderModel->save())
        {
            return redirect()->route('frontend.product.show', $postdata['product_id'])->withFlashSuccess("We submitted your request for offer, we will get back to you soon.");
        }
        else
        {
            return redirect()->route('frontend.product.show', $postdata['product_id'])->withFlashWarning("Error Occured.");
        }
		//Mail::send($data);	
	}

    /*public function cartCount(){
        //$session_id=Session::get('session_id');
        $cartCount=count(Cart::session($cartId));

        return $cartCount;
    }*/
}
