<?php namespace App\Repositories\Backend\Product;

use App\Models\Product\Product;
use Illuminate\Support\Facades\DB;
use App\Exceptions\GeneralException;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;
use App\Http\Utilities\FileUploads;
use App\Models\Product\ProductSize;
use App\Models\Product\ProductColor;
use App\Models\Product\ProductReview;
use App\Models\Weave\Weave;
use Excel;
use App\Models\Categories\Category;
use App\Models\SubCategories\SubCategory;
use App\Models\Style\Style;
use App\Models\Material\Material;
use App\Models\Email\Email;
use App\Models\Color\Color;
use Box\Spout\Reader\ReaderFactory;
use Box\Spout\Common\Type;

/**
 * Class ProductRepository.
 */
class ProductRepository extends BaseRepository
{
    /**
     * Associated Repository Model.
     */
    const MODEL = Product::class;

    public function __construct()
    {
        $this->category     = new Category();
        $this->subCategory  = new SubCategory();
        $this->style        = new Style();
        $this->weave        = new Weave();
        $this->material     = new Material();
        $this->email        = new Email();
        $this->color        = new Color();
        $this->productColor = new ProductColor();
        $this->productSize  = new ProductSize();
    }

    /**
     * @param string $order_by
     * @param string $sort
     *
     * @return mixed
     */
    public function getAll($order_by = 'type', $sort = 'DESC')
    {
        return $this->query()
            ->orderBy($order_by, $sort)
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    /**
     * @return mixed
     */
    public function getForDataTable()
    {
        return $this->query()
            ->select([
                'products.id',
                'products.name'
            ]);
    }

    /**
     * @param array $input
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function create(array $input)
    {

        if ($this->query()->where('sku', $input['sku'])->first()) {
            throw new GeneralException("Product with same SKU Exist");
        }
        $files = $input['main_image'];

        $imageNameArray = [];

        foreach ($files as $file)
        {
            /*$destinationPath    = public_path(). '/uploads/products/';
            $filename           = time().$file->getClientOriginalName();

            $file->move($destinationPath, $filename);*/

            $fileUpload = new FileUploads();
            $fileUpload->setBasePath('products');

            $filename = $fileUpload->upload($file);

            $imageNameArray[] = $filename;
        }

        $input['main_image'] = json_encode($imageNameArray);

        $sizeArray = [];

        if(isset($input['length']) && !empty($input['length']))
        {
            foreach ($input['length'] as $singleKey => $singleValue) {
                $sizeArray[$singleKey]['length']    = $singleValue;
                $sizeArray[$singleKey]['width']     = $input['width'][$singleKey];
                $sizeArray[$singleKey]['price']     = $input['price'][$singleKey];
                $sizeArray[$singleKey]['price_affiliate']     = $input['price_affiliate'][$singleKey];                
				$sizeArray[$singleKey]['msrp']     = $input['msrp'][$singleKey];
            }

            $sizeArray = array_values($sizeArray);
        }

        unset($input['length'], $input['width']);

        $basePath = public_path("product_custom_logos");

        if(isset($input['custom_logo1']) && is_object($input['custom_logo1']))
        {
            $imageName = time().$input['custom_logo1']->getClientOriginalName();

            $input['custom_logo1']->move(
                $basePath, $imageName
            );

            $input['custom_logo1'] = $imageName;
        }

        if(isset($input['custom_logo2']) && is_object($input['custom_logo2']))
        {
            $imageName = time().$input['custom_logo2']->getClientOriginalName();

            $input['custom_logo2']->move(
                $basePath, $imageName
            );

            $input['custom_logo2'] = $imageName;
        }

        $input['shop'] = [
            'amazon_link'   => isset($input['amazon_link']) ? $input['amazon_link'] : '',
            'ebay_link'     => isset($input['ebay_link']) ? $input['ebay_link'] : '',
            'custom_link1'  => isset($input['custom_link1']) ? $input['custom_link1'] : '',
            'custom_logo1'  => isset($input['custom_logo1']) ? $input['custom_logo1'] : '',
            'custom_link2'  => isset($input['custom_link2']) ? $input['custom_link2'] : '',
            'custom_logo2'  => isset($input['custom_logo2']) ? $input['custom_logo2'] : ''
        ];

        DB::transaction(function () use ($input, $sizeArray) {
            $product                    = self::MODEL;
            $product                    = new $product();
            $product->name              = $input['name'];
            $product->main_image        = $input['main_image'];
            $product->sku               = $input['sku'];
            $product->supplier_sku      = isset($input['supplier_sku']) ? $input['supplier_sku'] : "";
            $product->brand             = $input['brand'];
            $product->category_id       = $input['category_id'];
            $product->subcategory_id    = isset($input['subcategory_id']) ? $input['subcategory_id'] : '';
            $product->style_id          = $input['style_id'];
            $product->material_id       = $input['material_id'];
            $product->weave_id          = $input['weave_id'];
            $product->border_color_id   = isset($input['border_color_id']) ? $input['border_color_id'] : '';
            $product->shape             = $input['shape'];
            /*$product->length            = $input['length'];
            $product->width             = $input['width'];*/
            $product->foundation        = $input['foundation'];
            $product->knote_per_sq      = $input['knote_per_sq'];
            $product->price             = $input['price_per_knot'];
            $product->price_affiliate   = $input['price_affiliate_main'];
            $product->msrp				= $input['msrp_main'];
            $product->weight            = $input['weight'];
            $product->detail            = $input['detail'];
            $product->type              = $input['type'];
            $product->country_origin    = isset($input['country_origin']) ? $input['country_origin'] : '';

            $product->age               = isset($input['age']) ? $input['age'] : '';
            $product->design            = isset($input['design']) ? $input['design'] : '';
            $product->dimension         = isset($input['dimension']) ? $input['dimension'] : '';

            $product->discount         = isset($input['discount']) ? $input['discount'] : '';
            $product->clearance         = isset($input['clearance']) ? $input['clearance'] : '';

            $product->shop = json_encode($input['shop']);

            $product->status = (isset($input['status']) && $input['status'] == 1)
                 ? 1 : 0;

            if ($product->save()) {

                $productId = $product->id;

                if($sizeArray)
                {
                    foreach($sizeArray as $singleKey => $singleValue)
                    {
                        $productSize = new ProductSize();
                        $productSize->product_id = $productId;
                        $productSize->length = $singleValue['length'];
                        $productSize->width = $singleValue['width'];
                        $productSize->price = $singleValue['price'];
                        $productSize->price_affiliate = $singleValue['price_affiliate'];
                        $productSize->save();
                    }
                }

                foreach ($input['color_id'] as $key => $value)
                {
                    $productColor = new ProductColor();
                    $productColor->product_id = $productId;
                    $productColor->color_id = $value;
                    $productColor->save();
                }

                return true;
            }

            throw new GeneralException('Error in saving Product.');
        });
    }

    /**
     * @param Model $product
     * @param  $input
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function update(Model $product, array $input)
    {
        if ($this->query()->where('sku', $input['sku'])->where('id', '!=', $product->id)->first()) {
            throw new GeneralException("Product with same SKU Exist");
        }

        $product->name = $input['name'];
        $product->type = $input['type'];

        $sizeArray = [];

        if(isset($input['length']) && !empty($input['length']))
        {
            foreach ($input['length'] as $singleKey => $singleValue) {
                $sizeArray[$singleKey]['length']    = $singleValue;
                $sizeArray[$singleKey]['width']     = $input['width'][$singleKey];
                $sizeArray[$singleKey]['price']     = $input['price'][$singleKey];
                $sizeArray[$singleKey]['price_affiliate']     = $input['price_affiliate'][$singleKey];
				$sizeArray[$singleKey]['msrp']     = $input['msrp'][$singleKey];
            }

            $sizeArray = array_values($sizeArray);
        }

        unset($input['length'], $input['width']);

        if(isset($input['image_old']))
        {
            $product->main_image = json_encode($input['image_old']);
        }

        if(isset($input['main_image']))
        {
            $files = $input['main_image'];

            $imageNameArray = json_decode($product->main_image, true);

            foreach ($files as $file)
            {
                /*$destinationPath    = public_path(). '/uploads/products/';
                $filename           = time().$file->getClientOriginalName();

                $file->move($destinationPath, $filename);*/

                $fileUpload = new FileUploads();
                $fileUpload->setBasePath('products');

                $filename = $fileUpload->upload($file);

                $imageNameArray[] = $filename;
            }

            $product->main_image = json_encode($imageNameArray);
        }

        if(isset($input['sku']))
        {
            $product->sku = $input['sku'];
        }

        if(isset($input['supplier_sku']))
        {
            $product->supplier_sku = $input['supplier_sku'];
        }

        if(isset($input['weave_id']))
        {
            $product->weave_id = $input['weave_id'];
        }

        if(isset($input['brand']))
        {
            $product->brand = $input['brand'];
        }

        if(isset($input['category_id']))
        {
            $product->category_id = $input['category_id'];
        }

        if(isset($input['subcategory_id']))
        {
            $product->subcategory_id = $input['subcategory_id'];
        }

        if(isset($input['style_id']))
        {
            $product->style_id = $input['style_id'];
        }

        if(isset($input['material_id']))
        {
            $product->material_id = $input['material_id'];
        }

        /*if(isset($input['email_id']))
        {
            $product->email_id = $input['email_id'];
        }*/

        $product->border_color_id = isset($input['border_color_id']) ? $input['border_color_id'] : '';

        if(isset($input['shape']))
        {
            $product->shape = $input['shape'];
        }

        if(isset($input['length']))
        {
            $product->length = $input['length'];
        }

        if(isset($input['width']))
        {
            $product->width = $input['width'];
        }

        if(isset($input['foundation']))
        {
            $product->foundation = $input['foundation'];
        }

        if(isset($input['knote_per_sq']))
        {
            $product->knote_per_sq = $input['knote_per_sq'];
        }

        if(isset($input['price_per_knot']))
        {
            $product->price = $input['price_per_knot'];
        }

        if(isset($input['price_affiliate_main']))
        {
            $product->price_affiliate = $input['price_affiliate_main'];
        }
		
        if(isset($input['msrp']))
        {
            $product->msrp = $input['msrp_main'];
        }

        if(isset($input['weight']))
        {
            $product->weight = $input['weight'];
        }

        if(isset($input['detail']))
        {
            $product->detail = $input['detail'];
        }

        if(isset($input['shop']))
        {
            $product->shop = $input['shop'];
        }

        if(isset($input['country_origin']))
        {
            $product->country_origin = $input['country_origin'];
        }

        if(isset($input['age']))
        {
            $product->age = $input['age'];
        }

        if(isset($input['design']))
        {
            $product->design = $input['design'];
        }

        if(isset($input['dimension']))
        {
            $product->dimension = $input['dimension'];
        }

        $shopOriginal = json_decode($product->shop, true);

        $basePath = public_path("stores");

        if(isset($input['custom_logo1']) && is_object($input['custom_logo1']))
        {
            $imageName = time().$input['custom_logo1']->getClientOriginalName();

            $input['custom_logo1']->move(
                $basePath, $imageName
            );

            $input['custom_logo1'] = $imageName;
        }

        if(isset($input['custom_logo2']) && is_object($input['custom_logo2']))
        {
            $imageName = time().$input['custom_logo2']->getClientOriginalName();

            $input['custom_logo2']->move(
                $basePath, $imageName
            );

            $input['custom_logo2'] = $imageName;
        }

		if(isset($input['discount']))	$product->discount = $input['discount'];
		if(isset($input['clearance']))	$product->clearance = $input['clearance'];
		
        $input['shop'] = [
            'amazon_link'   => isset($input['amazon_link']) ? $input['amazon_link'] : '',
            'ebay_link'     => isset($input['ebay_link']) ? $input['ebay_link'] : '',
            'custom_link1'  => isset($input['custom_link1']) ? $input['custom_link1'] : (isset($shopOriginal['custom_link1']) ? $shopOriginal['custom_link1'] : ''),
            'custom_logo1'  => isset($input['custom_logo1']) ? $input['custom_logo1'] : (isset($shopOriginal['custom_logo1']) ? $shopOriginal['custom_logo1'] : ''),
            'custom_link2'  => isset($input['custom_link2']) ? $input['custom_link2'] : (isset($shopOriginal['custom_link2']) ? $shopOriginal['custom_link2'] : ''),
            'custom_logo2'  => isset($input['custom_logo2']) ? $input['custom_logo2'] : (isset($shopOriginal['custom_logo2']) ? $shopOriginal['custom_logo2'] : '')
        ];

        $product->shop = json_encode($input['shop']);

        $product->status = (isset($input['status']) && $input['status'] == 1)
                 ? 1 : 0;

        DB::transaction(function () use ($product, $input, $sizeArray) {
            if ($product->save()) {

                $productId = $product->id;
                ProductSize::where('product_id', $productId)->delete();

                if($sizeArray)
                {
                    foreach($sizeArray as $singleKey => $singleValue)
                    {
                        $productSize = new ProductSize();
                        $productSize->product_id = $productId;
                        $productSize->length = $singleValue['length'];
                        $productSize->width = $singleValue['width'];
                        $productSize->price = $singleValue['price'];
                        $productSize->price_affiliate = $singleValue['price_affiliate'];
                        $productSize->msrp = $singleValue['msrp'];
                        $productSize->save();
                    }
                }

                ProductColor::where('product_id', $productId)->delete();
                foreach ($input['color_id'] as $key => $value)
                {
                    $productColor = new ProductColor();
                    $productColor->product_id = $productId;
                    $productColor->color_id = $value;
                    $productColor->save();
                }

                return true;
            }

            throw new GeneralException('Error in saving Product');
        });
    }

    /**
     * @param Model $product
     *
     * @throws GeneralException
     *
     * @return bool
     */
    public function delete(Model $product)
    {
        DB::transaction(function () use ($product) {

            if ($product->delete()) {

                return true;
            }

            throw new GeneralException('Error in deleting Product');
        });
    }

    public function uploadSheet($input)
    {
        $file       = $input['file'];
        $basePath   = public_path("product_uploaded_sheets");
        $fileName   = time().$file->getClientOriginalName();

        $file->move(
            $basePath, $fileName
        );

        $success        = 0;
        $error          = 0;
        $updated        = 0;
        $errorMessage   = [];
        $typeArray      = [
                            'rug',
                            'furniture',
                            'flooring'
                        ];

        $reader = ReaderFactory::create(Type::XLSX);

        $reader->open(public_path("product_uploaded_sheets").'/'.$fileName);

        $data       = [];
        $keyArray   = [];
        $sheetCount = 0;

        $standardArray = [
            'Type'=>'type',
            'Category'=>'category',
            'Product Name'=>'name',
            'SKU'=>'sku',
            'Collection' => 'collection',
            'New (Yes/No)' => 'age',
            'Dimensions'=>'dimension',
            'Collection Copy'=>'detail',
            'Size'=>'size',
            'Color Name'=>'color', 
            'Design'=>'design_number',
			'Construction' => 'weave',
            'Material' => 'material',
            'Shape' => 'shape',
            'Country of Origin' => 'country_of_origin',
            'Style'=>'style',
            'Style Subcategory'=>'design',
            'Cleaning'=>'cleaning',
            'Pile Description'=>'pile_description',
            'Brand' => 'brand',
            'Wholesale Price' => 'price',
            'Cost' => 'price',
            'IMAP' => 'price_affiliate',
            'MSRP' => 'msrp',
            'Lead Time' => 'lead_time',
            'Warranty Length' => 'warranty',
            'Ship Type' => 'ship_type',
            'Weight' => 'weight',
            'Product Max Width' => 'width',
            'Product Max Height' => 'height',
            'Product Depth' => 'depth',
            'Pile Height' => 'pile_height',
            'Rolled Shipping Length/Height' => 'shipping_height',
            'Rolled Shipping Width' => 'shipping_width',
            'Image File'=>'image',
            'JPG Export - Flat images' => 'image_s',
            'JPG Export - Flat image' => 'image_1',
            'JPG Export Room image 1' => 'image_2',
            'JPG Export Room image 2' => 'image_3',
            'JPG Export Room image 3' => 'image_4',
            'JPG Export Room image 4' => 'image_5',
            'JPG Export Detail image' => 'image_6',
            'JPG Export Texture image' => 'image_7',
            'UPDATED Room image 1' => 'image_8',
            'UPDATED Room image 2' => 'image_9',
			'Color' => 'color',
	        'Image'=>'image',
	        'Clearance'=>'clearance',
	        'Discount'=>'discount',
	        'Quantity'=>'quantity',
	        'General Size'=>'generalsize',

        ];

        // $standardArray = [
        //     'type'=>'type',
        //     'name'=>'name',
        //     'sku'=>'sku',
        //     'brand' => 'brand',
        //     'categories' => 'category',
        //     'collection' => 'collection',
        //     'style'=>'style',
        //     //'attribute: material material'=>'material',
        //     'material'=>'material',
        //     'emails'=>'emails',
        //     'color'=>'color',
        //     'border color'=>'border_color',
        //     'shape'=>'shape',
        //     'size'=>'size',
        //     'foundation'=>'foundation',
        //     'knotes per sq.'=>'knotes_per_sq.',
        //     'country'=>'country_of_origin',
        //     'image'=>'image',
        //     'details'=>'details',
        //     'amazon_link'=>'amazon_link',
        //     'ebay_link'=>'ebay_link',
        //     'age'=>'age',
        //     'design'=>'design',
        //     'dimension'=>'dimension'
        // ];

        foreach ($reader->getSheetIterator() as $sheet)
        {
            $sheetCount++;
        }

        //print_r($sheetCount);die;

        $currentSheet = 0;

        foreach ($reader->getSheetIterator() as $sheet)
        {
            if($sheetCount > 1 && $currentSheet == 0)
            {
                $currentSheet++;
                continue;
            }

            $rowCount = 0;
            foreach ($sheet->getRowIterator() as $row)
            {
                if(empty($row[0])) break;
                if($sheetCount > 1)
                {
                    if($rowCount == 0)
                    {
                        $keyArray = array_filter($row);
                    }
                    else
                    {
                        $data[] = $row;
                    }
                }
                else
                {
                    if($rowCount == 0)
                    {
                        $keyArray = array_filter($row);
                    }
                    else
                    {
                        $data[] = $row;
                    }
                }
                $rowCount++;
            }
        }

        $newKeyArray = [];

        foreach ($keyArray as $key => $value)
        {
            if(in_array(trim($value), array_keys($standardArray)))
            {
                $newKeyArray[$key] = $standardArray[trim($value)];
            }
        }

        $fileArray = [];

        foreach ($data as $rowkey => $rowValue)
        {
            foreach ($rowValue as $cellKey => $cellValue)
            {
                if(in_array($cellKey, array_keys($newKeyArray)))
                {
                    $fileArray[$rowkey][$newKeyArray[$cellKey]] = $cellValue;
                }
            }

        }

        $reader->close();

        /*$fileArray = Excel::load(public_path("product_uploaded_sheets").'/'.$fileName, function($reader) {
            })->get();*/

        //print_r($fileArray);die;
        //print_r($sheetCount);
        //print_r($rowCount);die;
        //$currentRow = 0;
        foreach ($fileArray as $key => $value){

            // if($currentRow > ($rowCount-1)) break;
            // echo $currentRow."<br/>";
            // $currentRow++;

            $value = array_add($value, 'type', 'rug');
            //$value = array_add($value, 'brand', 'B');

            $detail = '';
            $detail .= isset($value['bullet_1']) ? "<br>" . $value['bullet_1'] : "";
            $detail .= isset($value['bullet_2']) ? "<br>" . $value['bullet_2'] : "";
            $detail .= isset($value['bullet_3']) ? "<br>" . $value['bullet_3'] : "";
			if(@$value['generalsize']==''){
				$explodedSize = explode(',', $value['size']);
				if(!empty($explodedSize)){
					$sizeValue = $explodedSize[0];
                    $mainsizeExplode = explode('x', $sizeValue);
					$mainsizeExplode[0] = str_replace("'",".",$mainsizeExplode[0]);
					$mainsizeExplode[0] = str_replace('"',"",$mainsizeExplode[0]);
					$mainsizeExplode[0] = round($mainsizeExplode[0]);
					$mainsizeExplode[1] = str_replace("'",".",$mainsizeExplode[1]);
					$mainsizeExplode[1] = str_replace('"',"",$mainsizeExplode[1]);
					$mainsizeExplode[1] = round($mainsizeExplode[1]);
					if(count($mainsizeExplode) == 2)
					{
						$length = (int) filter_var($mainsizeExplode[0], FILTER_SANITIZE_NUMBER_INT);
						$width = (int) filter_var($mainsizeExplode[1], FILTER_SANITIZE_NUMBER_INT);
					}
					$value['generalsize'] = $length."x".$width;
				}
			}					
							
            // print_r($value);die;
            $productSaveArray = [
                'name'          => $value['name'],
                'brand'         => $value['brand'],
                'price'    => isset($value['price']) ? $value['price'] : "",
                'price_affiliate'    => isset($value['price_affiliate']) ? $value['price_affiliate'] : "",
                'msrp'    => isset($value['msrp']) ? $value['msrp'] : "",
                'weight'    => isset($value['weight']) ? $value['weight'] : "",
                'country_origin'    => isset($value['country_of_origin']) ? $value['country_of_origin'] : "",
                'design_number'    => isset($value['design_number']) ? $value['design_number'] : "",
                'cleaning'    => isset($value['cleaning']) ? $value['cleaning'] : "",
                'pile_description'    => isset($value['pile_description']) ? $value['pile_description'] : "",
                'lead_time'    => isset($value['lead_time']) ? $value['lead_time'] : "",
                'warranty'    => isset($value['warranty']) ? $value['warranty'] : "",
                'ship_type'    => isset($value['ship_type']) ? $value['ship_type'] : "",
                'width'    => isset($value['width']) ? $value['width'] : "",
                'height'    => isset($value['height']) ? $value['height'] : "",
                'depth'    => isset($value['depth']) ? $value['depth'] : "",
                'pile_height'    => isset($value['pile_height']) ? $value['pile_height'] : "",
                'shipping_height'    => isset($value['shipping_height']) ? $value['shipping_height'] : "",
                'shipping_width'    => isset($value['shipping_width']) ? $value['shipping_width'] : "",
                'age'           => isset($value['age']) ? $value['age'] : "",
                'design'        => isset($value['design']) ? $value['design'] : "",
                'dimension'     => isset($value['dimension']) ? $value['dimension'] : "",
                'upc'     => isset($value['upc']) ? $value['upc'] : "",
                'detail'    => isset($value['detail']) ? $value['detail'] : "",
                'discount'  => isset($value['discount']) ? $value['discount'] : "",
                'clearance'  => isset($value['clearance']) ? $value['clearance'] : "",
                'generalsize' => isset($value['generalsize']) ? $value['generalsize'] : "",
            ];

            $productSaveArray['status'] = 1;

            // Product Type
            if(isset($value['type']) && in_array(strtolower($value['type']), $typeArray))
            {
                $productSaveArray['type'] = strtolower($value['type']);
            } else {
                $error++;
                $errorMessage[] = 'Invalid Type at line '.($key+1);
                continue;
            }

            // Product SKU
            if(isset($value['sku']))
            {
                $skuGet = $this->query()->where('sku', $value['sku'])->select('id')->first();

                if($skuGet)
                {
                    // Added Code By Niraj
                    $existProduct = $this->query()->where('sku', $value['sku'])->first();

                    $productId = $existProduct->id;

                    if(isset($value['name']))
                    {
                        $existProduct->name = $value['name'];
                    }
                    if(isset($value['brand']))
                    {
                        $existProduct->brand = $value['brand'];
                    }
                    if(isset($value['price']))
                    {
                        $existProduct->price = $value['price'];
                    }
                    if(isset($value['price_affiliate']))
                    {
                        $existProduct->price_affiliate = $value['price_affiliate'];
                    }
                    if(isset($value['msrp']))
                    {
                        $existProduct->msrp = $value['msrp'];
                    }
                    if(isset($value['weight']))
                    {
                        $existProduct->weight = $value['weight'];
                    }
                    if(isset($value['country_of_origin']))
                    {
                        $existProduct->country_origin = $value['country_of_origin'];
                    }
                    if(isset($value['design_number']))
                    {
                        $existProduct->design_number = $value['design_number'];
                    }
                    if(isset($value['cleaning']))
                    {
                        $existProduct->cleaning = $value['cleaning'];
                    }
                    if(isset($value['pile_description']))
                    {
                        $existProduct->pile_description = $value['pile_description'];
                    }
                    if(isset($value['lead_time']))
                    {
                        $existProduct->lead_time = $value['lead_time'];
                    }
                    if(isset($value['warranty']))
                    {
                        $existProduct->warranty = $value['warranty'];
                    }
                    if(isset($value['ship_type']))
                    {
                        $existProduct->ship_type = $value['ship_type'];
                    }
                    if(isset($value['width']))
                    {
                        $existProduct->width = $value['width'];
                    }
                    if(isset($value['height']))
                    {
                        $existProduct->height = $value['height'];
                    }
                    if(isset($value['depth']))
                    {
                        $existProduct->depth = $value['depth'];
                    }
                    if(isset($value['pile_height']))
                    {
                        $existProduct->pile_height = $value['pile_height'];
                    }
                    if(isset($value['shipping_height']))
                    {
                        $existProduct->shipping_height = $value['shipping_height'];
                    }
                    if(isset($value['shipping_width']))
                    {
                        $existProduct->shipping_width = $value['shipping_width'];
                    }
                    if(isset($value['bullet_1']) || isset($value['bullet_2']) || isset($value['bullet_3']))
                    {
                        $detail = '';
                        $detail .= isset($value['bullet_1']) ? "<br>" . $value['bullet_1'] : "";
                        $detail .= isset($value['bullet_2']) ? "<br>" . $value['bullet_2'] : "";
                        $detail .= isset($value['bullet_3']) ? "<br>" . $value['bullet_3'] : "";
                        $existProduct->detail = $detail;
                    }
                    if(isset($value['age']))
                    {
                        $existProduct->age = $value['age'];
                    }
                    if(isset($value['design']))
                    {
                        $existProduct->design = $value['design'];
                    }
                    if(isset($value['dimension']))
                    {
                        $existProduct->dimension = $value['dimension'];
                    }
                    if(isset($value['discount']))
                    {
                        $existProduct->discount = $value['discount'];
                    }
                    if(isset($value['clearance']))
                    {
                        $existProduct->clearance = $value['clearance'];
                    }
                    if(isset($value['clearance']))
                    {
                        $existProduct->generalsize = $value['generalsize'];
                    }

                    if(isset($value['category']))
                    {
                        $categoryGet = $this->category->where('category', $value['category'])->select('id')->first();

                        if($categoryGet)
                        {
                            $existProduct->category_id = $categoryGet->id;
                        }
                    }
                    if(isset($value['weave']))
                    {
                        $weaveGet = $this->weave->where('name', $value['weave'])->select('id')->first();
                        if($weaveGet)
                        {
                            $existProduct->weave_id = $weaveGet->id;
                        }
                    }

                    if(isset($value['collection']))
                    {
                        $subCategoryGet = $this->subCategory->where('subcategory', $value['collection'])->select('id')->first();

                        if($subCategoryGet)
                        {
                            $existProduct->subcategory_id = $subCategoryGet->id;
                        }
                    }

                    if(isset($value['style']))
                    {
                        $styleGet = $this->style->where('name', $value['style'])->select('id')->first();

                        if($styleGet)
                        {
                            $existProduct->style_id = $styleGet->id;
                        }
                    }

                    if(isset($value['material']))
                    {
                        $materialGet = $this->material->where('name', $value['material'])->select('id')->first();

                        if($materialGet)
                        {
                            $existProduct->material_id = $materialGet->id;
                        }
                    }


                    $colorArray     = [];
                    if(isset($value['color']) && $value['color'])
                    {
                        $colorNameArray = explode(',', $value['color']);

                        $this->productColor->where('product_id', $existProduct->id)->delete();

                        foreach($colorNameArray as $singleColor)
                        {
                            $colorId = $this->color->where('display_name', trim($singleColor))->select('id')->first();

                            if($colorId)
                            {
                                $productColor = new ProductColor();
                                $productColor->product_id = $productId;
                                $productColor->color_id = $colorId->id;
                                $productColor->save();
                            }
                        }
                    }

                    if(isset($value['border_color']) && $value['border_color'])
                    {
                        $borderColorGet = $this->color->where('display_name', $value['border_color'])->select('id')->first();

                        if($borderColorGet)
                        {
                            $existProduct->border_color_id = $borderColorGet->id;
                        }
                    }

                    // Product Shape
                    $shapes = config('constant.shapes');
                    if(isset($value['shape']) && in_array($value['shape'], $shapes))
                    {
                        $existProduct->shape = array_search($value['shape'], $shapes);
                    }

                    // Country of Origin
                    $countries = config('constant.countries');
                    if(isset($value['country_of_origin']) && in_array(strtolower($value['country_of_origin']), array_map('strtolower', $countries)))
                    {
                        $existProduct->country_origin = array_search(strtolower($value['country_of_origin']), array_map('strtolower', $countries));
                    }

                    // Shop and Image code need to go here, later.

                    // End
                    $existProduct->save();
                    $updated++;
                    continue;
                }
                else
                {
                    $productSaveArray['sku'] = $value['sku'];
                }
            }
            else
            {
                $error++;
                $errorMessage[] = 'SKU is blank at line '.($key+1);
                continue;
            }
			

            // Product Category
            if(isset($value['category']))
            {
                $categoryGet = $this->category->where('category', $value['category'])->select('id')->first();

                if($categoryGet)
                {
                    $productSaveArray['category_id'] = $categoryGet->id;
                }
                else
                {
					$categories = new Category();
					$categories->category = $value['category'];
					$categories->status = 1;
					$categories->save();
					$categoryGet = $this->category->where('category', $value['category'])->select('id')->first();
                    $productSaveArray['category_id'] = $categoryGet->id; 
                }
            }
            else
            {
                $productSaveArray['category_id'] = 0;
            }

            //Product SubCategory
            if(isset($value['collection']))
            {
                $subCategoryGet = $this->subCategory->where('subcategory', $value['collection'])->select('id')->first();

                if($subCategoryGet)
                {
                    $productSaveArray['subcategory_id'] = $subCategoryGet->id;
                }
                else
                {
					$subcategories = new SubCategory();
					$subcategories->category_id = $productSaveArray['category_id'];
					$subcategories->subcategory = $value['collection'];
					$subcategories->status = 1;
					$subcategories->save();
					$subCategoryGet = $this->subCategory->where('subcategory', $value['collection'])->select('id')->first();
					$productSaveArray['subcategory_id'] = $subCategoryGet->id;
                }
            }
            else
            {
                $productSaveArray['subcategory_id'] = 0;
            }

            //Product Style
            if(isset($value['style']))
            {
                $styleGet = $this->style->where('name', $value['style'])->select('id')->first();
				if($styleGet){
					
				}else{
					$productStyle = new Style();
					$productStyle->name = $value['style'];
					$productStyle->status = 1;
					$productStyle->save();
					$styleGet = $this->style->where('name', $value['style'])->select('id')->first();
				}
                if($styleGet)
                {
                    $productSaveArray['style_id'] = $styleGet->id;
                }
                else
                {
                    $error++;
                    $errorMessage[] = 'Invalid Style at line '.($key+1);
                    continue;
                }
            }
            else
            {
                $error++;
                $errorMessage[] = 'Invalid Style(not given) at line '.($key+1);
                continue;
            }

            //Product Material

            if(isset($value['material']))
            {
                $materialGet = $this->material->where('name', $value['material'])->select('id')->first();

                if($materialGet)
                {
                    $productSaveArray['material_id'] = $materialGet->id;
                }
                else
                {
                    $error++;
                    $errorMessage[] = 'Invalid Material at line '.($key+1);
                    continue;
                }
            }
            else
            {
                $error++;
                $errorMessage[] = 'Invalid Material at line '.($key+1);
                continue;
            }

            //Product Email
            /*if(isset($value['emails']))
            {
                $emailGet = $this->email->where('name', $value['emails'])->select('id')->first();

                if($emailGet)
                {
                    $productSaveArray['email_id'] = $emailGet->id;
                }
                else
                {
                    $error++;
                    $errorMessage[] = 'Invalid Emails at line '.($key+1);
                    continue;
                }
            }
            else
            {
                $error++;
                $errorMessage[] = 'Invalid Emails at line '.($key+1);
                continue;
            }*/

            //Product Color
            $colorArray     = [];
            if(isset($value['color']) && $value['color'])
            {
                $colorNameArray = explode(',', $value['color']);

                foreach($colorNameArray as $singleColor)
                {
                    $colorId = $this->color->where('display_name', $singleColor)->select('id')->first();
                    if($colorId)
                    {
                        $colorArray[] = $colorId->id;
                    }
                }
            }

            if(isset($value['border_color']) && $value['border_color'])
            {
                $borderColorGet = $this->color->where('display_name', $value['border_color'])->select('id')->first();

                if($borderColorGet)
                {
                    $productSaveArray['border_color_id'] = $borderColorGet->id;
                }
            }

            // Product Shape
            $shapes = config('constant.shapes');
            if(isset($value['shape']) && in_array($value['shape'], $shapes))
            {
                $productSaveArray['shape'] = array_search($value['shape'], $shapes);
            }

            // Country of Origin
            $countries = config('constant.countries');
            if(isset($value['country_of_origin']) && in_array(strtolower($value['country_of_origin']), array_map('strtolower', $countries)))
            {
                $productSaveArray['country_origin'] = array_search(strtolower($value['country_of_origin']), array_map('strtolower', $countries));
            }
			
			//weave check  and creation
			if(isset($value['weave']))
			{
				$weaveGet = $this->weave->where('name', $value['weave'])->select('id')->first();
				if($weaveGet)
				{
					$productSaveArray['weave_id'] = $weaveGet->id;
				}else{
					$weavesNew = new Weave();
					$weavesNew->name = $value['weave'];
					$weavesNew->status = 1;
					$weavesNew->save();
					$weaveGet = $this->weave->where('name', $value['weave'])->select('id')->first();
					if($weaveGet) $productSaveArray['weave_id'] = $weaveGet->id;
				}
            }

            // Save Product Images
            $productImages  = [];
			if(isset($value['image'])){
				if($value['image']!='') $value['image'] = str_replace(",","||",$value['image']);
			}
			for($imno=1;$imno<=9;$imno++){
				@$value['image'] .='||'.$value['image_'.$imno];  
			}
			// if multipleimages urls will put in one column saparated by "||"
			if(isset($value['image_s'])){
				@$value['image'] .='||'.$value['image_s'];
			}
			
            if(isset($value['image']))
            {
                $images         = explode('||', $value['image']);
                foreach($images as $singleKey => $singleImage)
                {	
					if(trim($singleImage)){
						$imageName = time().'.jpg';
						$imageFlag = $this->grabImage(trim($singleImage), public_path('img').'/products/'.$imageName);
						if($imageFlag != false)
						{
							$fileUpload = new FileUploads();
							$fileUpload->setBasePath('products');
							$fileUpload->setFileName(null, $imageName);
							$fileUpload->makeThumbnail($imageName);
							$productImages[] = $imageName;
						}
					}
                }
                if(count($productImages) == 0)
                {
                    $productSaveArray['status'] = 0;
                    $error++;
                    $errorMessage[] = 'Invalid Images at line '.($key+1);
                }
                $productSaveArray['main_image'] = json_encode($productImages);
            }


            $productSaveArray['shop'] = json_encode([
                'amazon_link'   => isset($input['amazon_link']) ? $input['amazon_link'] : '',
                'ebay_link'     => isset($input['ebay_link']) ? $input['ebay_link'] : '',
                'custom_link1'  => isset($input['custom_link1']) ? $input['custom_link1'] : '',
                'custom_logo1'  => isset($input['custom_logo1']) ? $input['custom_logo1'] : '',
                'custom_link2'  => isset($input['custom_link2']) ? $input['custom_link2'] : '',
                'custom_logo2'  => isset($input['custom_logo2']) ? $input['custom_logo2'] : ''
            ]);


            if($productSaveArray['category_id'] == 0 || $productSaveArray['subcategory_id'] == 0)
            {
                $productSaveArray['status'] = 0;
            }

            $productModel = new Product();
            $productModel->fill($productSaveArray);
            if ($productModel->save()) {

                $productId = $productModel->id;

                if(isset($value['size']))
                {
                    $explodedSize = explode(',', $value['size']);

                    if(!empty($explodedSize))
                    {
                        foreach ($explodedSize as $sizeKey => $sizeValue)
                        {
                            $mainsizeExplode = explode('x', $sizeValue);
                            if(count($mainsizeExplode) == 2)
                            {
                                $productSize = new ProductSize();
                                $productSize->product_id = $productId;
                                $productSize->length = (int) filter_var($mainsizeExplode[0], FILTER_SANITIZE_NUMBER_INT);
                                $productSize->width = (int) filter_var($mainsizeExplode[1], FILTER_SANITIZE_NUMBER_INT);
								if($productSize->price>0 and $productSize->width>0 and $productSize->length>0)$productSize->price = $value['price']/($productSize->width*$productSize->length);
								if($value['price_affiliate']>0 and $productSize->width>0 and $productSize->length>0) $productSize->price_affiliate = $value['price_affiliate']/($productSize->width*$productSize->length);
								if($value['msrp']>0 and $productSize->width>0 and $productSize->length>0)$productSize->msrp = $value['msrp']/($productSize->width*$productSize->length);
								if(isset($value['quantity'])) $productSize->quantity = $value['quantity'];
                                $productSize->save();
                            }
                        }
                    }
                }

                foreach ($colorArray as $key => $value)
                {
                    $productColor = new ProductColor();
                    $productColor->product_id = $productId;
                    $productColor->color_id = $value;
                    $productColor->save();
                }
                $success++;
            }
        }


        return ['updated' => $updated, 'success' => $success, 'error' => $error, 'errorMessage' => $errorMessage];
    }

    public function grabImage($url,$saveto)
    {

        if(strpos($url, 'www.dropbox.com/') !== false)
        {
            $url = str_replace("?dl=1", "", $url);
            $url = str_replace("?dl=0", "", $url);

            $url = str_replace("www.", "dl.", $url);

            $filename_from_url = parse_url($url);
            $ext = pathinfo($filename_from_url['path'], PATHINFO_EXTENSION);

            if(in_array($ext, ['jpg', 'jpeg', 'png']))
            {
                $raw = file_get_contents($url);
                file_put_contents($saveto, $raw);
            }
            else
            {
                return false;
            }
        }
        else
        {
            $filename_from_url = parse_url($url);
            $ext = pathinfo($filename_from_url['path'], PATHINFO_EXTENSION);

            if(in_array($ext, ['jpg', 'jpeg', 'png']))
            {
                $ch = curl_init ($url);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_BINARYTRANSFER,1);
                $raw=curl_exec($ch);
				$status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close ($ch);
				if($status=='200'){
					if(file_exists($saveto)){
						unlink($saveto);
					}
					$fp = fopen($saveto,'x');
					fwrite($fp, $raw);
					fclose($fp);
				}else{
					return false;
				}
            }
            else
            {
                return false;
            }
        }

        return true;
    }
}
