<?php

namespace App\Http\Controllers\Backend\Product;

use App\Models\Product\Product;
use App\Http\Controllers\Controller;
use App\Repositories\Backend\Product\ProductRepository;
use App\Repositories\Backend\Categories\CategoriesRepository;
use App\Repositories\Backend\SubCategories\SubCategoriesRepository;
use App\Repositories\Backend\Style\StyleRepository;
use App\Repositories\Backend\Material\MaterialRepository;
use App\Repositories\Backend\Weave\WeaveRepository;
use App\Repositories\Backend\Color\ColorRepository;
use App\Http\Requests\Backend\Product\StoreRequest;
use App\Http\Requests\Backend\Product\ManageRequest;
use App\Http\Requests\Backend\Product\EditRequest;
use App\Http\Requests\Backend\Product\CreateRequest;
use App\Http\Requests\Backend\Product\DeleteRequest;
use App\Http\Requests\Backend\Product\UpdateRequest;
use App\Http\Requests\Backend\Product\PriceManagementRequest;
use App\Http\Requests\Backend\Product\InventoryManagementRequest;
use App\Models\Categories\Category;
use App\Models\SubCategories\SubCategory;
use App\Models\Style\Style;
use App\Models\Material\Material;
use App\Models\Weave\Weave;
use App\Models\Color\Color;

use Illuminate\Http\Request;
use DB, DNS1D;
use App\Models\Product\ProductSize;

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
     * @param ProductRepository       $products
     */
    public function __construct()
    {
        $this->products     = new ProductRepository();
        $this->category     = new CategoriesRepository();
        $this->subCategory  = new SubCategoriesRepository();
        $this->style        = new StyleRepository();
        $this->material     = new MaterialRepository();
        $this->weave        = new WeaveRepository();
        $this->color        = new ColorRepository();
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function index(ManageRequest $request)
    {
        $products = $this->products->getAll();//dd($products);
        return view('backend.products.index')->with(['products' => $products]);
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function create(CreateRequest $request)
    {
        $categoryList   = $this->category->query()->where('status', 1)->orderBy('category', 'ASC')->pluck('category', 'id');
        $styleList      = $this->style->query()->where('status', 1)->orderBy('name', 'ASC')->pluck('name', 'id');
        $materialList   = $this->material->query()->where('status', 1)->orderBy('name', 'ASC')->pluck('name', 'id');
        $weaveList      = $this->weave->query()->where('status', 1)->orderBy('name', 'ASC')->pluck('name', 'id');
        $colorList      = $this->color->query()->where('status', 1)->orderBy('display_name', 'ASC')->pluck('name', 'id');

        return view('backend.products.create')->with([
            'categoryList'  => $categoryList,
            'styleList'     => $styleList,
            'materialList'  => $materialList,
            'weaveList'     => $weaveList,
            'colorList'     => $colorList
            ]);
    }

    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function store(StoreRequest $request)
    {
        $this->products->create($request->all());

        return redirect()->route('admin.product.index')->withFlashSuccess("Product Successfully saved.");
    }

    /**
     * @param Product              $product
     * @param Request $request
     *
     * @return mixed
     */
    public function edit(Product $product, EditRequest $request)
    {
        $categoryList   = $this->category->query()->where('status', 1)->orderBy('category', 'ASC')->pluck('category', 'id');
        $styleList      = $this->style->query()->where('status', 1)->orderBy('name', 'ASC')->pluck('name', 'id');
        $materialList   = $this->material->query()->where('status', 1)->orderBy('name', 'ASC')->pluck('name', 'id');
        $weaveList      = $this->weave->query()->where('status', 1)->orderBy('name', 'ASC')->pluck('name', 'id');
        $colorList      = $this->color->query()->where('status', 1)->orderBy('display_name', 'ASC')->pluck('name', 'id');
        $subcategoryList = $this->subCategory->query()->where('category_id', $product->category_id)->orderBy('subcategory', 'ASC')->pluck('subcategory', 'id');

        return view('backend.products.edit')
            ->with([
                    'product' => $product,
                    'categoryList'  => $categoryList,
                    'styleList'     => $styleList,
                    'materialList'  => $materialList,
                    'weaveList'     => $weaveList,
                    'colorList'     => $colorList,
                    'subcategoryList' => $subcategoryList
                ]);
    }

    /**
     * @param Product              $product
     * @param Request $request
     *
     * @return mixed
     */
    public function update(Product $product, UpdateRequest $request)
    {
        $this->products->update($product, $request->all());

        return redirect()->route('admin.product.index')->withFlashSuccess("Product Updated.");
    }

    /**
     * @param Product              $product
     * @param Request $request
     *
     * @return mixed
     */
    public function destroy(Product $product, DeleteRequest $request)
    {
        $this->products->delete($product);

        return redirect()->route('admin.product.index')->withFlashSuccess("Product Deleted");
    }

    public function uploadSheet(Request $request)
    {
		set_time_limit(800);
		ini_set('memory_limit', '-1');
        $response = $this->products->uploadSheet($request->all());

        $flashMessage = '';

        if(isset($response['updated']) && $response['updated'])
        {
            $flashMessage .= $response['updated']." Products Updated Successfully."." <br/>";
        }

        $flashMessage .= $response['success']." Products Uploaded Successfully.";

        if($response['error'] > 0)
        {
            $flashMessage .= $response['error']." Products did not uploaded.";
            $flashMessage .= implode(' <br/> ', $response['errorMessage']);
        }

        
        //print_r($response);die;

        return redirect()->route('admin.product.index')->withFlashMessage($flashMessage);
    }

    public function downloadSheet()
    {

        $passArray['categoryList']      = Category::where('status',1)->get()->pluck('category')->toArray();
        $passArray['subCategoryList']   = SubCategory::where('status',1)->get()->pluck('subcategory')->toArray();
        $passArray['styleList']         = Style::where('status',1)->get()->pluck('name')->toArray();
        $passArray['materialList']      = Material::where('status',1)->get()->pluck('name')->toArray();
        $passArray['weaveList']         = Weave::where('status',1)->get()->pluck('name')->toArray();
        $passArray['colorList']         = Color::where('status',1)->get()->pluck('display_name')->toArray();
        $passArray['shapeList']         = config('constant.shapes');
        $passArray['countryList']       = config('constant.countries');

        \Excel::create( 'product', function ( $excel ) use ($passArray) {
            $excel->sheet( 'sheet1', function ( $sheet ) use ($passArray) {

            });
            $excel->sheet( 'product', function ( $sheet ) use ($passArray) {
                $sheet->SetCellValue( "A1", "Type" );
                $sheet->SetCellValue( "B1", "Name" );
                $sheet->SetCellValue( "C1", "SKU" );
                $sheet->SetCellValue( "D1", "Brand" );
                $sheet->SetCellValue( "E1", "Category" );
                $sheet->SetCellValue( "F1", "Collection" );
                $sheet->SetCellValue( "G1", "Style" );
                $sheet->SetCellValue( "H1", "Material" );
                $sheet->SetCellValue( "I1", "Weaves" );
                $sheet->SetCellValue( "J1", "Color" );
                $sheet->SetCellValue( "K1", "Border Color" );
                $sheet->SetCellValue( "L1", "Shape" );
                $sheet->SetCellValue( "M1", "Size" );
                $sheet->SetCellValue( "N1", "Foundation" );
                $sheet->SetCellValue( "O1", "Knotes Per Sq." );
                $sheet->SetCellValue( "P1", "Country Of Origin" );
                $sheet->SetCellValue( "Q1", "Image" );
                $sheet->SetCellValue( "R1", "Details" );
                $sheet->SetCellValue( "S1", "Amazon Link" );
                $sheet->SetCellValue( "T1", "Ebay Link" );
                $sheet->SetCellValue( "U1", "Age" );
                $sheet->SetCellValue( "V1", "Design" );
                $sheet->SetCellValue( "W1", "Dimension" );

                $colCount = 100; //Getting the value of column count

                // Type
                $types = implode(',', array('Rug', 'Furniture', 'Lighting', 'Accessories'));
                //dd($types);
                for ( $i = 2; $i <= $colCount; $i ++ ) {
                   $objValidation = $sheet->getCell( 'A' . $i )->getDataValidation();
                   $objValidation->setType( \PHPExcel_Cell_DataValidation::TYPE_LIST );
                   $objValidation->setErrorStyle( \PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
                   $objValidation->setAllowBlank( false );
                   $objValidation->setShowInputMessage( true );
                   $objValidation->setShowErrorMessage( true );
                   $objValidation->setShowDropDown( true );
                   $objValidation->setErrorTitle( 'Input error' );
                   $objValidation->setError( 'Value is not in list.' );
                   $objValidation->setPromptTitle( 'Type' );
                   $objValidation->setPrompt( 'Please pick a value from the drop-down list.' );
                   $objValidation->setFormula1( $types ); //note this!
                }

                $categories = '"'.implode(',', $passArray['categoryList']).'"';
                for ( $i = 2; $i <= $colCount; $i ++ ) {
                   $objValidation = $sheet->getCell( 'E' . $i )->getDataValidation();
                   $objValidation->setType( \PHPExcel_Cell_DataValidation::TYPE_LIST );
                   $objValidation->setErrorStyle( \PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
                   $objValidation->setAllowBlank( false );
                   $objValidation->setShowInputMessage( true );
                   $objValidation->setShowErrorMessage( true );
                   $objValidation->setShowDropDown( true );
                   $objValidation->setErrorTitle( 'Input error' );
                   $objValidation->setError( 'Value is not in list.' );
                   $objValidation->setPromptTitle( 'Category' );
                   $objValidation->setPrompt( 'Please pick a value from the drop-down list.' );
                   $objValidation->setFormula1( $categories ); //note this!
                }

                // Subcategories
                $subcategories = '"'.implode(',', $passArray['subCategoryList']).'"';
                for ( $i = 2; $i <= $colCount; $i ++ ) {
                   $objValidation = $sheet->getCell( 'F' . $i )->getDataValidation();
                   $objValidation->setType( \PHPExcel_Cell_DataValidation::TYPE_LIST );
                   $objValidation->setErrorStyle( \PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
                   $objValidation->setAllowBlank( false );
                   $objValidation->setShowInputMessage( true );
                   $objValidation->setShowErrorMessage( true );
                   $objValidation->setShowDropDown( true );
                   $objValidation->setErrorTitle( 'Input error' );
                   $objValidation->setError( 'Value is not in list.' );
                   $objValidation->setPromptTitle( 'SubCategory' );
                   $objValidation->setPrompt( 'Please pick a value from the drop-down list.' );
                   $objValidation->setFormula1( $subcategories ); //note this!
                }

                // styles
                $styles = '"'.implode(',', $passArray['styleList']).'"';
                for ( $i = 2; $i <= $colCount; $i ++ ) {
                   $objValidation = $sheet->getCell( 'G' . $i )->getDataValidation();
                   $objValidation->setType( \PHPExcel_Cell_DataValidation::TYPE_LIST );
                   $objValidation->setErrorStyle( \PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
                   $objValidation->setAllowBlank( false );
                   $objValidation->setShowInputMessage( true );
                   $objValidation->setShowErrorMessage( true );
                   $objValidation->setShowDropDown( true );
                   $objValidation->setErrorTitle( 'Input error' );
                   $objValidation->setError( 'Value is not in list.' );
                   $objValidation->setPromptTitle( 'Style' );
                   $objValidation->setPrompt( 'Please pick a value from the drop-down list.' );
                   $objValidation->setFormula1( $styles ); //note this!
                }

                // materials
                $materials = '"'.implode(',', $passArray['materialList']).'"';
                for ( $i = 2; $i <= $colCount; $i ++ ) {
                   $objValidation = $sheet->getCell( 'H' . $i )->getDataValidation();
                   $objValidation->setType( \PHPExcel_Cell_DataValidation::TYPE_LIST );
                   $objValidation->setErrorStyle( \PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
                   $objValidation->setAllowBlank( false );
                   $objValidation->setShowInputMessage( true );
                   $objValidation->setShowErrorMessage( true );
                   $objValidation->setShowDropDown( true );
                   $objValidation->setErrorTitle( 'Input error' );
                   $objValidation->setError( 'Value is not in list.' );
                   $objValidation->setPromptTitle( 'Material' );
                   $objValidation->setPrompt( 'Please pick a value from the drop-down list.' );
                   $objValidation->setFormula1( $materials ); //note this!
                }

                // weaves
                $weaves = '"'.implode(',', $passArray['weaveList']).'"';
                for ( $i = 2; $i <= $colCount; $i ++ ) {
                   $objValidation = $sheet->getCell( 'I' . $i )->getDataValidation();
                   $objValidation->setType( \PHPExcel_Cell_DataValidation::TYPE_LIST );
                   $objValidation->setErrorStyle( \PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
                   $objValidation->setAllowBlank( false );
                   $objValidation->setShowInputMessage( true );
                   $objValidation->setShowErrorMessage( true );
                   $objValidation->setShowDropDown( true );
                   $objValidation->setErrorTitle( 'Input error' );
                   $objValidation->setError( 'Value is not in list.' );
                   $objValidation->setPromptTitle( 'Weaves' );
                   $objValidation->setPrompt( 'Please pick a value from the drop-down list.' );
                   $objValidation->setFormula1( $weaves ); //note this!
                }

                // colors
                $colors = '"'.implode(',', $passArray['colorList']).'"';
                for ( $i = 2; $i <= $colCount; $i ++ ) {
                   $objValidation = $sheet->getCell( 'J' . $i )->getDataValidation();
                   $objValidation->setType( \PHPExcel_Cell_DataValidation::TYPE_LIST );
                   $objValidation->setErrorStyle( \PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
                   $objValidation->setAllowBlank( false );
                   $objValidation->setShowInputMessage( true );
                   $objValidation->setShowErrorMessage( true );
                   $objValidation->setShowDropDown( true );
                   $objValidation->setErrorTitle( 'Input error' );
                   $objValidation->setError( 'Value is not in list.' );
                   $objValidation->setPromptTitle( 'Color' );
                   $objValidation->setPrompt( 'Please pick a value from the drop-down list.' );
                   $objValidation->setFormula1( $colors ); //note this!
                }

                // bordercolors
                $bordercolors = '"'.implode(',', $passArray['colorList']).'"';
                for ( $i = 2; $i <= $colCount; $i ++ ) {
                   $objValidation = $sheet->getCell( 'K' . $i )->getDataValidation();
                   $objValidation->setType( \PHPExcel_Cell_DataValidation::TYPE_LIST );
                   $objValidation->setErrorStyle( \PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
                   $objValidation->setAllowBlank( false );
                   $objValidation->setShowInputMessage( true );
                   $objValidation->setShowErrorMessage( true );
                   $objValidation->setShowDropDown( true );
                   $objValidation->setErrorTitle( 'Input error' );
                   $objValidation->setError( 'Value is not in list.' );
                   $objValidation->setPromptTitle( 'Border Color' );
                   $objValidation->setPrompt( 'Please pick a value from the drop-down list.' );
                   $objValidation->setFormula1( $bordercolors ); //note this!
                }

                // shapes
                $shapes = '"'.implode(',', $passArray['shapeList']).'"';
                for ( $i = 2; $i <= $colCount; $i ++ ) {
                   $objValidation = $sheet->getCell( 'L' . $i )->getDataValidation();
                   $objValidation->setType( \PHPExcel_Cell_DataValidation::TYPE_LIST );
                   $objValidation->setErrorStyle( \PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
                   $objValidation->setAllowBlank( false );
                   $objValidation->setShowInputMessage( true );
                   $objValidation->setShowErrorMessage( true );
                   $objValidation->setShowDropDown( true );
                   $objValidation->setErrorTitle( 'Input error' );
                   $objValidation->setError( 'Value is not in list.' );
                   $objValidation->setPromptTitle( 'Shape' );
                   $objValidation->setPrompt( 'Please pick a value from the drop-down list.' );
                   $objValidation->setFormula1( $shapes ); //note this!
                }

                // countries
                $countries = implode(',', $passArray['countryList']);
                for ( $i = 2; $i <= $colCount; $i ++ ) {
                   $objValidation = $sheet->getCell( 'P' . $i )->getDataValidation();
                   $objValidation->setType( \PHPExcel_Cell_DataValidation::TYPE_LIST );
                   $objValidation->setErrorStyle( \PHPExcel_Cell_DataValidation::STYLE_INFORMATION );
                   $objValidation->setAllowBlank( false );
                   $objValidation->setShowInputMessage( true );
                   $objValidation->setShowErrorMessage( true );
                   $objValidation->setShowDropDown( true );
                   $objValidation->setErrorTitle( 'Input error' );
                   $objValidation->setError( 'Value is not in list.' );
                   $objValidation->setPromptTitle( 'Country Of Origin' );
                   $objValidation->setPrompt( 'Please pick a value from the drop-down list.' );
                   $objValidation->setFormula1( $countries ); //note this!
                }

           } );

        } )->download( 'xlsx' );
        exit;
    }

    public function exportProducts()
    {
        //$products = $this->products->query()->where('status', 1)->get();
        $products = $this->products->query()->get();

        \Excel::create( 'product', function ( $excel ) use ($products) {
            $excel->sheet( 'product', function ( $sheet ) use ($products) {
                $sheet->SetCellValue( "A1", "Type" );
                $sheet->SetCellValue( "B1", "SKU" );
                $sheet->SetCellValue( "C1", "Brand" );
                $sheet->SetCellValue( "D1", "Product Name" );
                $sheet->SetCellValue( "E1", "Category" );
                $sheet->SetCellValue( "F1", "Collection" );
                $sheet->SetCellValue( "G1", "Style" );
                $sheet->SetCellValue( "H1", "Color" );
                $sheet->SetCellValue( "I1", "Size" );
                $sheet->SetCellValue( "J1", "General Size" );
                $sheet->SetCellValue( "K1", "Shape" );
                $sheet->SetCellValue( "L1", "Collection of Copy" );
                $sheet->SetCellValue( "M1", "Dimension" );
                $sheet->SetCellValue( "N1", "Pile Height" );//pile_height
                $sheet->SetCellValue( "O1", "Weight" );//weight
                $sheet->SetCellValue( "P1", "Construction" );
                $sheet->SetCellValue( "Q1", "Material" );
                $sheet->SetCellValue( "R1", "Country Of Origin" );
                $sheet->SetCellValue( "S1", "Cost" );
                $sheet->SetCellValue( "T1", "IMAP" );
                $sheet->SetCellValue( "U1", "MSRP" );
                $sheet->SetCellValue( "V1", "Discount" );
                $sheet->SetCellValue( "W1", "Border Color" );
                $sheet->SetCellValue( "X1", "Foundation" );
                $sheet->SetCellValue( "Y1", "Knotes Per Sq." );
                $sheet->SetCellValue( "Z1", "Image" );
                $sheet->SetCellValue( "AA1", "Amazon Link" );
                $sheet->SetCellValue( "AB1", "Ebay Link" );
                $sheet->SetCellValue( "AC1", "Age" );
                $sheet->SetCellValue( "AD1", "Design" );
                $sheet->SetCellValue( "AE1", "URL" );
                $sheet->SetCellValue( "AF1", "Inventory" );

                foreach($products as $productKey => $productValue)
                {
                    $rowNumber = $productKey+2;
                    // Images
                    $decodedImages = json_decode($productValue->main_image, true);
                    $images = [];
                    if(!empty($decodedImages))
                    {
                        foreach($decodedImages as $imageKey => $imageValue)
                        {
                            $images[] = env('ADMIN_URL'). '/img/products/'.$imageValue;
                        }
                    }

                    // Colors
                    $colors = [];
                    if($productValue->colors->count() > 0)
                    {
                        foreach($productValue->colors as $singleColor)
                        {
                            if(isset($singleColor->color->display_name) && $singleColor->color->display_name)
                            {
                                $colors[] = $singleColor->color->display_name;
                            }
                        }
                    }

                    // size
                    $size = [];
                    $designerPrice = [];
                    $consumerPrice = [];
					$msrpPrice = [];
					$quantity = [];
                    if($productValue->size->count() > 0)
                    {
                        foreach($productValue->size as $singleSize)
                        {
                            $length = $singleSize->length+0;
                            $width = $singleSize->width+0;
                            $explodedLength = explode(".", $length);
                            $explodedWidth = explode(".", $width);

                            $size[] = $explodedLength[0]."'".(isset($explodedLength[1]) ? $explodedLength[1]."''" : ""). ' x '. $explodedWidth[0]."'".(isset($explodedWidth[1]) ? $explodedWidth[1]."''" : "");
                            $designerPrice[] = $singleSize->price_affiliate;
                            $consumerPrice[] = $singleSize->price*$length*$width;
                            $msrpPrice[] = $singleSize->price*$length*$width;
							$quantity[] = $singleSize->quantity;
                        }
                    }

                    //shop links
                    $shop = json_decode($productValue->shop, true);

                    $sheet->SetCellValue( "A".$rowNumber, ucfirst($productValue->type) );
                    $sheet->SetCellValue( "B".$rowNumber, $productValue->sku );
                    $sheet->SetCellValue( "C".$rowNumber, $productValue->brand );
                    $sheet->SetCellValue( "D".$rowNumber, $productValue->name );
                    $sheet->SetCellValue( "E".$rowNumber, isset($productValue->category->category) ? $productValue->category->category : "" );
                    $sheet->SetCellValue( "F".$rowNumber, isset($productValue->subcategory->subcategory) ? $productValue->subcategory->subcategory : "");
                    $sheet->SetCellValue( "G".$rowNumber, isset($productValue->style->name) ? $productValue->style->name : "" );
                    $sheet->SetCellValue( "H".$rowNumber, implode(" , ", $colors) );
                    $sheet->SetCellValue( "I".$rowNumber, implode(" , ", $size) );
                    $sheet->SetCellValue( "J".$rowNumber, $productValue->generalsize); 
                    $sheet->SetCellValue( "K".$rowNumber, $productValue->shape );
                    $sheet->SetCellValue( "L".$rowNumber, $productValue->detail );
                    $sheet->SetCellValue( "M".$rowNumber, $productValue->dimension );
                    $sheet->SetCellValue( "N".$rowNumber, $productValue->pile_height); 
                    $sheet->SetCellValue( "O".$rowNumber, $productValue->weight); 
                    $sheet->SetCellValue( "P".$rowNumber, isset($productValue->weave->name) ? $productValue->weave->name : "" );
                    $sheet->SetCellValue( "Q".$rowNumber, isset($productValue->material->name) ? $productValue->material->name : "" );
                    $sheet->SetCellValue( "R".$rowNumber, $productValue->country_origin );
                    $sheet->SetCellValue( "S".$rowNumber, implode(" , ", $consumerPrice) );
                    $sheet->SetCellValue( "T".$rowNumber, implode(" , ", $designerPrice) );
                    $sheet->SetCellValue( "U".$rowNumber, implode(" , ", $msrpPrice) );
                    $sheet->SetCellValue( "V".$rowNumber, $productValue->discount );
                    $sheet->SetCellValue( "W".$rowNumber, isset($productValue->borderColor->display_name) ? $productValue->borderColor->display_name : "" );
                    $sheet->SetCellValue( "X".$rowNumber, $productValue->foundation );
                    $sheet->SetCellValue( "Y".$rowNumber, $productValue->knote_per_sq );
                    $sheet->SetCellValue( "Z".$rowNumber, implode(" , ", $images) );
                    $sheet->SetCellValue( "AA".$rowNumber, isset($shop['amazon_link']) ? $shop['amazon_link'] : "" );
                    $sheet->SetCellValue( "AB".$rowNumber, isset($shop['ebay_link']) ? $shop['ebay_link'] : "" );
                    $sheet->SetCellValue( "AC".$rowNumber, $productValue->age );
                    $sheet->SetCellValue( "AD".$rowNumber, $productValue->design );
                    $sheet->SetCellValue( "AE".$rowNumber, url('/')."/product/".$productValue->id); 
                    $sheet->SetCellValue( "AF".$rowNumber, implode(" , ", $quantity)); 
                }
            } );
        })->download( 'xlsx' );
    }

    public function getSkuByType($type)
    {

        if($type == 'rug')
        {
          $prefix = 'PR';
        }
        else if($type == 'furniture')
        {
            $prefix = 'PF';
        }
        else if($type == 'lighting')
        {
            $prefix = 'PL';
        }
        else
        {
            $prefix = 'PA';
        }

        $skuResponse = DB::select("SELECT TRIM(LEADING '".$prefix."' FROM sku)as trimmedVal FROM products WHERE type='".$type."' AND  sku LIKE '".$prefix."%' AND TRIM(LEADING '".$prefix."' FROM sku) REGEXP '^[0-9]+$'");

        if(count($skuResponse) > 0)
        {
            $sku = $prefix.str_pad(($skuResponse[0]->trimmedVal)+1, 4, '0', STR_PAD_LEFT);
        }
        else
        {
            $sku = $prefix.'0001';
        }

        return response()->json($sku);
    }

    public function getBarcodeWithDetails($id, Request $request)
    {
        $productDetails = $this->products->find($id);

        if(!$productDetails->barcode)
        {
            $barcode = rand(1111111111,9999999999);

            $productDetails->barcode = $barcode;

            $productDetails->save();
        }

        $colors = [];

        if($productDetails->colors)
        {
          foreach ($productDetails->colors as $key => $color)
          {

              if(isset($color->color->display_name))
              {
                  $colors[] = $color->color->display_name;
              }
          }
        }

        $passData = [
          'id' => $productDetails->id,
          'name' => $productDetails->name,
          'sku' => $productDetails->sku,
          'type' => ucfirst($productDetails->type),
          'color' => implode(", ", $colors),
          'material' => isset($productDetails->material->name) ? $productDetails->material->name : "",
          'shape' => $productDetails->shape,
          'origin' => $productDetails->country_origin,
          'barcode' => $productDetails->barcode,
          'barcode_image' => DNS1D::getBarcodePNG($productDetails->barcode, "C39+", 1.2,40),
          'url' => env('MAIN_SITE_URL'),
          'dimension' => $productDetails->dimension,
          'style' => isset($productDetails->style->name) ? $productDetails->style->name : ""
        ];

        return response()->json($passData);
    }

    public function getBarcodeMultiple(Request $request)
    {
      $postData = $request->all();

      $productIds = $postData['productids'];

      $products = $this->products->query()->whereIn('id', $productIds)->get();

      foreach ($products as $key => $value)
      {
          if(!$value->barcode)
          {
              $barcode = rand(1111111111,9999999999);

              $value->barcode = $products[$key]->barcode = $barcode;

              $value->save();
          }
          $products[$key]->barcode_image = DNS1D::getBarcodePNG($value->barcode, "C39+", 1.2,40);
      }

      return view('backend.products.barcode-multiple')->with(['products' => $products]);
    }

    public function priceManagement(PriceManagementRequest $request)
    {
        $getData = $request->all();

        if(isset($getData['q']) && $getData['q'])
        {
            $products = $this->products->query()->where('sku', 'LIKE', '%'.$getData['q'].'%')->paginate(10);
        }
        else
        {
            $products = $this->products->query()->paginate(10);
        }

        return view('backend.products.price-management')->with(['products' => $products]);
    }

    public function priceManagementStore(Request $request)
    {
      $postData = $request->all();

      $data = $postData['data'];

      foreach ($data as $key => $value)
      {
        $product = $this->products->find($value['id']);
        $product->price = $value['price'];
        $product->price_affiliate = $value['price_affiliate'];

        $product->save();

        if(isset($value['size']) && !empty($value['size']))
        {
            foreach ($value['size'] as $sKey => $sValue)
            {
              $productSizeModel = ProductSize::find($sValue['id']);

              $productSizeModel->price = isset($sValue['price']) ? $sValue['price'] : $sValue['price'];
              $productSizeModel->price_affiliate = isset($sValue['price_affiliate']) ? $sValue['price_affiliate'] : $sValue['price_affiliate'];
              $productSizeModel->msrp = isset($sValue['msrp']) ? $sValue['msrp'] : $sValue['msrp'];

              $productSizeModel->save();
            }
        }

      }
      return redirect()->route('admin.product.price-management');
    }

    public function inventoryManagement(InventoryManagementRequest $request)
    {
        $getData = $request->all();

        if(isset($getData['q']) && $getData['q'])
        {
            $products = $this->products->query()->where('sku', 'LIKE', '%'.$getData['q'].'%')->paginate(10);
        }
        else
        {
            $products = $this->products->query()->paginate(10);
        }

        return view('backend.products.inventory-management')->with(['products' => $products]);
    }

    public function inventoryManagementStore(Request $request)
    {
      $postData = $request->all();

      $data = $postData['data'];

      foreach ($data as $key => $value)
      {
        $product = $this->products->find($value['id']);

        $product->is_stock = $value['is_stock'];

        $product->save();

        if(isset($value['size']) && !empty($value['size']))
        {
            foreach ($value['size'] as $sKey => $sValue)
            {
              $productSizeModel = ProductSize::find($sValue['id']);

              $productSizeModel->quantity = isset($sValue['quantity']) ? $sValue['quantity'] : $sValue['quantity'];

              $productSizeModel->save();
            }
        }

      }
      return redirect()->route('admin.product.inventory-management');
    }
}
