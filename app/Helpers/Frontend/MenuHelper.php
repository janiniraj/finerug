<?php namespace App\Helpers\Frontend;

use App\Models\Product\Product;
use App\Models\Product\UserFavourite;
use App\Models\Setting\Setting;
use Auth;

/**
 * Class MenuHelper.
 */
class MenuHelper
{
    public $product;

    public $rugCategoryList;
    public $rugCollection;
    public $rugStyleList;
    public $rugMaterialList;
    public $rugWeaveList;
    public $rugColorList;
    public $rugShapeList;


    public $lightingCategoryList;
    public $lightingCollection;
    public $lightingStyleList;
    public $lightingMaterialList;
    public $lightingWeaveList;
    public $lightingColorList;
    public $lightingShapeList;


    public $accessoriesCategoryList;
    public $accessoriesCollection;
    public $accessoriesStyleList;
    public $accessoriesMaterialList;
    public $accessoriesWeaveList;
    public $accessoriesColorList;
    public $accessoriesShapeList;

	
    public $furnitureCategoryList;
    public $furnitureCollection;
    public $furnitureStyleList;
    public $furnitureMaterialList;
    public $furnitureWeaveList;
    public $furnitureColorList;
    public $furnitureShapeList;


    public $flooringCategoryList;
    public $flooringCollection;
    public $flooringStyleList;
    public $flooringMaterialList;
    public $flooringWeaveList;
    public $flooringColorList;
    public $flooringShapeList;

	
	
    public $favouriteCount;

    public $settings;

    public $catalogLink;

    public function __construct()
    {
        $this->product          = new Product();
        $this->rugCategoryList  = $this->product->where('products.type', 'rug')->join('categories', 'categories.id', '=', 'products.category_id')->select('categories.*')->groupBy('products.category_id')->orderBy('categories.category', 'ASC')->get();
        $this->rugCollection    = $this->product->where('products.type', 'rug')->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')->select('subcategories.*')->groupBy('products.subcategory_id')->orderBy('subcategories.subcategory', 'ASC')->get();
        $this->rugStyleList     = $this->product->where('products.type', 'rug')->join('styles', 'styles.id', '=', 'products.style_id')->select('styles.*')->groupBy('products.style_id')->get();
        $this->rugMaterialList  = $this->product->where('products.type', 'rug')->join('materials', 'materials.id', '=', 'products.material_id')->select('materials.*')->groupBy('products.material_id')->get();
        $this->rugWeaveList     = $this->product->where('products.type', 'rug')->join('weaves', 'weaves.id', '=', 'products.weave_id')->select('weaves.*')->groupBy('products.weave_id')->get();
        $this->rugColorList     = $this->product->where('products.type', 'rug')->join('colors', 'colors.id', '=', 'products.color_id')->select('colors.*')->groupBy('products.color_id')->get();
        $this->rugShapeList     = $this->product->where('products.type', 'rug')->select('products.shape')->groupBy('products.shape')->get();

        $this->lightingCategoryList = $this->product->where('products.type', 'lighting')->join('categories', 'categories.id', '=', 'products.category_id')->select('categories.*')->groupBy('products.category_id')->get();
        $this->lightingCollection   = $this->product->where('products.type', 'lighting')->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')->select('subcategories.*')->groupBy('products.subcategory_id')->get();
        $this->lightingStyleList    = $this->product->where('products.type', 'lighting')->join('styles', 'styles.id', '=', 'products.style_id')->select('styles.*')->groupBy('products.style_id')->get();
        $this->lightingMaterialList = $this->product->where('products.type', 'lighting')->join('materials', 'materials.id', '=', 'products.material_id')->select('materials.*')->groupBy('products.material_id')->get();
        $this->lightingWeaveList    = $this->product->where('products.type', 'lighting')->join('weaves', 'weaves.id', '=', 'products.weave_id')->select('weaves.*')->groupBy('products.weave_id')->get();
        $this->lightingColorList    = $this->product->where('products.type', 'lighting')->join('colors', 'colors.id', '=', 'products.color_id')->select('colors.*')->groupBy('products.color_id')->get();
        $this->lightingShapeList    = $this->product->where('products.type', 'lighting')->select('products.shape')->groupBy('products.shape')->get();

        $this->accessoriesCategoryList = $this->product->where('products.type', 'accessories')->join('categories', 'categories.id', '=', 'products.category_id')->select('categories.*')->groupBy('products.category_id')->get();
        $this->accessoriesCollection   = $this->product->where('products.type', 'accessories')->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')->select('subcategories.*')->groupBy('products.subcategory_id')->get();
        $this->accessoriesStyleList    = $this->product->where('products.type', 'accessories')->join('styles', 'styles.id', '=', 'products.style_id')->select('styles.*')->groupBy('products.style_id')->get();
        $this->accessoriesMaterialList = $this->product->where('products.type', 'accessories')->join('materials', 'materials.id', '=', 'products.material_id')->select('materials.*')->groupBy('products.material_id')->get();
        $this->accessoriesWeaveList    = $this->product->where('products.type', 'accessories')->join('weaves', 'weaves.id', '=', 'products.weave_id')->select('weaves.*')->groupBy('products.weave_id')->get();
        $this->accessoriesColorList    = $this->product->where('products.type', 'accessories')->join('colors', 'colors.id', '=', 'products.color_id')->select('colors.*')->groupBy('products.color_id')->get();
        $this->accessoriesShapeList    = $this->product->where('products.type', 'accessories')->select('products.shape')->groupBy('products.shape')->get();

        $this->furnitureCategoryList = $this->product->where('products.type', 'furniture')->join('categories', 'categories.id', '=', 'products.category_id')->select('categories.*')->groupBy('products.category_id')->get();
        $this->furnitureCollection   = $this->product->where('products.type', 'furniture')->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')->select('subcategories.*')->groupBy('products.subcategory_id')->get();
        $this->furnitureStyleList    = $this->product->where('products.type', 'furniture')->join('styles', 'styles.id', '=', 'products.style_id')->select('styles.*')->groupBy('products.style_id')->get();
        $this->furnitureMaterialList = $this->product->where('products.type', 'furniture')->join('materials', 'materials.id', '=', 'products.material_id')->select('materials.*')->groupBy('products.material_id')->get();
        $this->furnitureWeaveList    = $this->product->where('products.type', 'furniture')->join('weaves', 'weaves.id', '=', 'products.weave_id')->select('weaves.*')->groupBy('products.weave_id')->get();
        $this->furnitureColorList    = $this->product->where('products.type', 'furniture')->join('colors', 'colors.id', '=', 'products.color_id')->select('colors.*')->groupBy('products.color_id')->get();
        $this->furnitureShapeList    = $this->product->where('products.type', 'furniture')->select('products.shape')->groupBy('products.shape')->get();

        $this->flooringCategoryList = $this->product->where('products.type', 'flooring')->join('categories', 'categories.id', '=', 'products.category_id')->select('categories.*')->groupBy('products.category_id')->get();
        $this->flooringCollection   = $this->product->where('products.type', 'flooring')->join('subcategories', 'subcategories.id', '=', 'products.subcategory_id')->select('subcategories.*')->groupBy('products.subcategory_id')->get();
        $this->flooringStyleList    = $this->product->where('products.type', 'flooring')->join('styles', 'styles.id', '=', 'products.style_id')->select('styles.*')->groupBy('products.style_id')->get();
        $this->flooringMaterialList = $this->product->where('products.type', 'flooring')->join('materials', 'materials.id', '=', 'products.material_id')->select('materials.*')->groupBy('products.material_id')->get();
        $this->flooringWeaveList    = $this->product->where('products.type', 'flooring')->join('weaves', 'weaves.id', '=', 'products.weave_id')->select('weaves.*')->groupBy('products.weave_id')->get();
        $this->flooringColorList    = $this->product->where('products.type', 'flooring')->join('colors', 'colors.id', '=', 'products.color_id')->select('colors.*')->groupBy('products.color_id')->get();
        $this->flooringShapeList    = $this->product->where('products.type', 'flooring')->select('products.shape')->groupBy('products.shape')->get();
		
        $this->favouriteCount = 0;

        if(Auth::check())
        {
            $userId             = Auth::user()->id;
            $productFavourite   = new UserFavourite();

            $this->favouriteCount = $productFavourite->where('user_id', $userId)
                                        ->join('products', 'products.id', '=', 'user_favourites.product_id')->count();
        }

        $this->settings = Setting::get();

        $this->catalogLink = "#";

        foreach($this->settings as $single)
        {
            if($single->key == 'catalog')
            {
                $this->catalogLink = url('/').'/settings/'.$single->value;
            }
        }

    }
}
