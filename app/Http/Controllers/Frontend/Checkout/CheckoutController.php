<?php

namespace App\Http\Controllers\Frontend\Checkout;
use App\Http\Controllers\Controller;
//use Session, Cart, Auth, Ups;
use App\Models\Order\Order;
use App\Models\Order\OrderProduct;
use Session, Cart, Auth, Validator;
use App\Models\Product\ProductSize;
use App\Repositories\Backend\Product\ProductRepository;
use App\Models\UserAddress\UserAddress;
use Illuminate\Http\Request;
use Darryldecode\Cart\CartCondition;
use App\Models\Promo\Promo;
use App\Models\Product\Product;
use Srmklive\PayPal\Services\ExpressCheckout;
use Srmklive\PayPal\Services\AdaptivePayments;
//Use Beaudierman\Ups;

use Stripe\Error\Card;
use Stripe;



/**
 * Class CheckoutController.
 */
class CheckoutController extends Controller
{
    /**
     * CheckoutController constructor.
     */
	public function __construct()
	{
		$this->productRepository 	= new ProductRepository();
		$this->productSize			= new ProductSize();
        $this->userAddress          = new UserAddress();
        $this->promo                = new Promo();
        $this->product              = new Product();
	}

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function cart(Request $request)
    {
    	 if(Auth::check())
        {
            $cartId = Auth::user()->id;
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
        } 

        $cartData = Cart::session($cartId);
        
		//dd($cartData->getContent(), $cartData->getConditionsByType('promo'));
		//dd($cartData->getContent());
        if(empty($cartData->getContent()->count()))
        {
        	return redirect()->route('frontend.index')->withFlashWarning("No Product in the Cart.");
        } 
        return view('frontend.checkout.cart')->with([
        	'cartData' 			=> $cartData,
        	'productRepository' => $this->productRepository,
        	'productSize'		=> $this->productSize,
            'promos'            => $cartData->getConditionsByType('promo')
        	]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function cartUpdate(Request $request)
    {
        $postData = $request->all();

        $this->productSize;

        if(Auth::check())
        {
            $cartId = Auth::user()->id;
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
        }

        $cartData = Cart::session($cartId);

        $sizeId = $cartData->get($postData['item_id'])->attributes->size_id;

        $sizeData = $this->productSize->find($sizeId);

        if(isset($sizeData->quantity) && $sizeData->quantity < $postData['quantity'])
        {
            return redirect()->route('frontend.checkout.cart')->withFlashWarning("Not Enough Quantity Available to Update.");
        }

        Cart::session($cartId)->update($postData['item_id'], array(
            'quantity' => array(
                'relative' => false,
                'value' => $postData['quantity']
            )
        ));

        return redirect()->route('frontend.checkout.cart');
    }

    /**
     * @param $itemId
     * @return mixed
     */
    public function removeItemFromCart($itemId)
    {
        if(Auth::check())
        {
            $cartId = Auth::user()->id;
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
        }

        Cart::session($cartId)->remove($itemId);
        return redirect()->route('frontend.checkout.cart')->withFlashWarning("Item Successfully Deleted.");
    }

    /**
     * @return $this
     */
    public function checkout()
    {
        /*$address = new \Ups\Entity\Address();
        $address->setAttentionName('Test Test');
        $address->setBuildingName('Test');
        $address->setAddressLine1('Address Line 1');
        $address->setAddressLine2('Address Line 2');
        $address->setAddressLine3('Address Line 3');
        $address->setStateProvinceCode('NY');
        $address->setCity('New York');
        $address->setCountryCode('US');
        $address->setPostalCode('10000');

        $xav = new \Ups\AddressValidation(env('UPS_ACCESS_KEY'),
                    env('UPS_USERID'),
                    env('UPS_PASSWORD'));
        $xav->activateReturnObjectOnValidate(); //This is optional
        try {
            $response = $xav->validate($address, $requestOption = \Ups\AddressValidation::REQUEST_OPTION_ADDRESS_VALIDATION, $maxSuggestion = 15);
            dd($response);
        } catch (Exception $e) {
            var_dump($e);
        }

        dd("dfdfdfdfdfdf");*/


        if(Auth::check())
        {
			$userId = Auth::user()->id;
			$cartId = Auth::user()->id;
			
			if(Session::has('cartSessionId'))
			{
				$cartId = Session::get('cartSessionId');
			}
			else
			{
				$cartId = rand(0,9999);
				session(['cartSessionId' => $cartId]);
			}

			$cartData = Cart::session($cartId);

			$billingAddress = $this->userAddress
						->where('type', 'billing')
						->where('user_id', $userId)
						->first();

			$shippingAddress = $this->userAddress
						->where('type', 'shipping')
						->where('user_id', $userId)
						->first();

            return view('frontend.checkout.guestCheckout')->with([
                'cartData'          => $cartData,
                'productRepository' => $this->productRepository,
                'productSize'       => $this->productSize,
                'billingAddress'    => $billingAddress,
                'shippingAddress'   => $shippingAddress
            ]);
		}
        else
        {
			//return redirect()->route('frontend.checkout.guestCheckout');
			return $this->guestCheckout();
        } 
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
	 
	public function guestCheckout()
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
		
		$cartData = Cart::session($cartId);
		
		return view('frontend.checkout.guestCheckout')->with([
            'cartData'          => $cartData,
            'productRepository' => $this->productRepository,
            'productSize'       => $this->productSize
            ]);
	}
    public function AddUserAddress(Request $request)
    {
        $postData = $request->all();

        $check = $this->userAddress
                    ->where('type', $postData['type'])
                    ->where('user_id', $postData['user_id'])
                    ->first();

        if($check)
        {
            $check->user_id = $postData['user_id'];
            $check->type = $postData['type'];
            $check->email = $postData['email'] ? $postData['email'] : 'dsdsdsds@sdds.com';
            $check->first_name = $postData['first_name'];
            $check->last_name = $postData['last_name'];
            $check->address = $postData['address'];
            $check->street = $postData['street'];
            $check->city = $postData['city'];
            $check->state = $postData['state'];
            $check->postal_code = $postData['postal_code'];
            $check->phone = $postData['phone'];
            $check->country = 'USA';

            $check->save();
        }
        else
        {
            $model = new UserAddress();
            $model->user_id = $postData['user_id'];
            $model->type = $postData['type'];
            $model->email = $postData['email'] ? $postData['email'] : 'dsdsdsds@sdds.com';
            $model->first_name = $postData['first_name'];
            $model->last_name = $postData['last_name'];
            $model->address = $postData['address'];
            $model->street = $postData['street'];
            $model->city = $postData['city'];
            $model->state = $postData['state'];
            $model->postal_code = $postData['postal_code'];
            $model->phone = $postData['phone'];
            $model->country = 'USA';

            $model->save();
        }

        if($postData['type'] == 'shipping')
        {
            $rate = new \Ups\Rate(
                    env('UPS_ACCESS_KEY'),
                    env('UPS_USERID'),
                    env('UPS_PASSWORD')
                );

            try {
                $shipment = new \Ups\Entity\Shipment();

                $shipperAddress = $shipment->getShipper()->getAddress();
                $shipperAddress->setPostalCode('20005');

                $address = new \Ups\Entity\Address();
                $address->setPostalCode('20005');
                $shipFrom = new \Ups\Entity\ShipFrom();
                $shipFrom->setAddress($address);

                $shipment->setShipFrom($shipFrom);

                $shipTo = $shipment->getShipTo();
                $shipTo->setCompanyName('Test Ship To');
                $shipToAddress = $shipTo->getAddress();
                $shipToAddress->setPostalCode('20005');

                $package = new \Ups\Entity\Package();
                $package->getPackagingType()->setCode(\Ups\Entity\PackagingType::PT_PACKAGE);
                $package->getPackageWeight()->setWeight(10);
                
                // if you need this (depends of the shipper country)
                /*$weightUnit = new \Ups\Entity\UnitOfMeasurement;
                $weightUnit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_KGS);
                $package->getPackageWeight()->setUnitOfMeasurement($weightUnit);*/

                $dimensions = new \Ups\Entity\Dimensions();
                $dimensions->setHeight(10);
                $dimensions->setWidth(10);
                $dimensions->setLength(10);

                $unit = new \Ups\Entity\UnitOfMeasurement;
                $unit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_IN);

                $dimensions->setUnitOfMeasurement($unit);
                $package->setDimensions($dimensions);

                $shipment->addPackage($package);

                $rates = $rate->getRate($shipment);
                if(isset($rates->RatedShipment) && isset($rates->RatedShipment[0]))
                {
                    $passRates = $rates->RatedShipment[0]->TotalCharges->MonetaryValue;
                }

                if(Auth::check())
                {
                    $cartId = Auth::user()->id;
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
                }

                $cartData = Cart::session($cartId);

                $checkCartCondition = $cartData->getConditionsByType('coupon');

                if($checkCartCondition->count() > 0)
                {
                    foreach ($checkCartCondition as $key => $value) 
                    {
                        $cartData->removeCartCondition($key);
                    }
                }

                // Tax Start
                try
                {
                    //Calculate Taxes
                    $client = \TaxJar\Client::withApiKey(env('TAXJAR_API_KEY'));
        
                    $order_taxes = $client->taxForOrder([
                          'from_country'    => 'US',
                          'from_zip'        => '20036',
                          'from_state'      => 'DC',
                          'to_country'      => 'US',
                          'to_zip'          => $postData['postal_code'],
                          'to_state'        => $postData['state'],
                          'amount'          => $cartData->getSubTotal(),
                          'shipping'        => $passRates
                    ]);

                    if(isset($order_taxes->amount_to_collect))
                    {
                        $tax = $order_taxes->amount_to_collect;

                        $condition = new CartCondition(array(
                            'name' => 'tax',
                            'type' => 'coupon',
                            'target' => 'total',
                            'value' => '+'.$tax,
                            'attributes' => array()
                        ));

                        Cart::session($cartId)->condition($condition);
                    }
                    else
                    {
                        return response()->json([
                            'error' => "Error in State and Zipcode validation."
                        ]); 
                    }
                }
                catch(Exception $e)
                {
                    return response()->json([
                        'error' => "Error in State and Zipcode validation."
                    ]);
                }
                // Tax End

                $condition = new CartCondition(array(
                    'name' => 'shipping',
                    'type' => 'coupon',
                    'target' => 'total',
                    'value' => '+'.$passRates,
                    'attributes' => array()
                ));

                Cart::session($cartId)->condition($condition);

                return response()->json([
                    'rates' => $passRates,
                    'tax'   => $tax,
                    'subtotal' => Cart::session($cartId)->getSubTotal()
                ]);
            } catch (Exception $e) {
                return response()->json([
                    'error' => $e
                ]);
            }
        }

        return response()->json(true);
    }

    public function AddGuestAddress(Request $request)
    {
        $userId = 0;
        if(Auth::check())
        {
            $userId = Auth::user()->id;
        }

        $postData = $request->all();

        $model = new UserAddress();
        $model->user_id = $userId;
        $model->type = $postData['type'];
        $model->email = $postData['email'] ? $postData['email'] : 'dsdsdsds@sdds.com';
        $model->first_name = $postData['first_name'];
        $model->last_name = $postData['last_name'];
        $model->address = $postData['address'];
        $model->street = $postData['street'];
        $model->city = $postData['city'];
        $model->state = $postData['state'];
        $model->postal_code = $postData['postal_code'];
        $model->phone = $postData['phone'];
        $model->country = 'USA';

        $model->save();

        if($postData['type'] == 'shipping')
        {
            session(['shippingUserAddressID' => $model->id]);
        }
        else
        {
            session(['billingUserAddressID' => $model->id]);
        }

        if($postData['type'] == 'shipping')
        {
            $address = new \Ups\Entity\Address();
            $address->setStateProvinceCode($postData['state']);
            $address->setCity($postData['city']);
            $address->setCountryCode('US');
            $address->setPostalCode($postData['postal_code']);

            $av = new \Ups\SimpleAddressValidation(env('UPS_ACCESS_KEY'), env('UPS_USERID'), env('UPS_PASSWORD'));
            try {
                $response = $av->validate($address);
            } catch (Exception $e) {
                return response()->json([
                    'error' => "Error in Address, Not a valid address"
                ]);
            }

            $rate = new \Ups\Rate(
                env('UPS_ACCESS_KEY'),
                env('UPS_USERID'),
                env('UPS_PASSWORD')
            );

            try {
                $shipment = new \Ups\Entity\Shipment();

                $shipperAddress = $shipment->getShipper()->getAddress();
                $shipperAddress->setPostalCode('20005');

                $address = new \Ups\Entity\Address();
                $address->setPostalCode('20005');
                $shipFrom = new \Ups\Entity\ShipFrom();
                $shipFrom->setAddress($address);

                $shipment->setShipFrom($shipFrom);

                $shipTo = $shipment->getShipTo();
                $shipTo->setCompanyName('Test Ship To');
                $shipToAddress = $shipTo->getAddress();
                $shipToAddress->setPostalCode('20005');

                $package = new \Ups\Entity\Package();
                $package->getPackagingType()->setCode(\Ups\Entity\PackagingType::PT_PACKAGE);
                $package->getPackageWeight()->setWeight(22);

                // if you need this (depends of the shipper country)
                /*$weightUnit = new \Ups\Entity\UnitOfMeasurement;
                $weightUnit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_KGS);
                $package->getPackageWeight()->setUnitOfMeasurement($weightUnit);*/

                $dimensions = new \Ups\Entity\Dimensions();
                $dimensions->setHeight(10);
                $dimensions->setWidth(10);
                $dimensions->setLength(10);

                $unit = new \Ups\Entity\UnitOfMeasurement;
                $unit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_IN);

                $dimensions->setUnitOfMeasurement($unit);
                $package->setDimensions($dimensions);

                $shipment->addPackage($package);

                $rates = $rate->getRate($shipment);

                if(isset($rates->RatedShipment) && isset($rates->RatedShipment[0]))
                {
                    $passRates = $rates->RatedShipment[0]->TotalCharges->MonetaryValue;
                }

                if(Session::has('cartSessionId'))
                {
                    $cartId = Session::get('cartSessionId');
                }
                else
                {
                    $cartId = rand(0,9999);
                    session(['cartSessionId' => $cartId]);
                }

                $cartData = Cart::session($cartId);

                $checkCartCondition = $cartData->getConditionsByType('coupon');

                if($checkCartCondition->count() > 0)
                {
                    foreach ($checkCartCondition as $key => $value)
                    {
                        $cartData->removeCartCondition($key);
                    }
                }

                // Tax Start
                try
                {
                    //Calculate Taxes
                    $client = \TaxJar\Client::withApiKey(env('TAXJAR_API_KEY'));

                    $order_taxes = $client->taxForOrder([
                        'from_country'    => 'US',
                        'from_zip'        => '20036',
                        'from_state'      => 'DC',
                        'to_country'      => 'US',
                        'to_zip'          => $postData['postal_code'],
                        'to_state'        => $postData['state'],
                        'amount'          => $cartData->getSubTotal(),
                        'shipping'        => $passRates
                    ]);

                    if(isset($order_taxes->amount_to_collect))
                    {
                        $tax = $order_taxes->amount_to_collect;

                        $condition = new CartCondition(array(
                            'name' => 'tax',
                            'type' => 'coupon',
                            'target' => 'total',
                            'value' => '+'.$tax,
                            'attributes' => array()
                        ));

                        Cart::session($cartId)->condition($condition);
                    }
                    else
                    {
                        return response()->json([
                            'error' => "Error in State and Zipcode validation."
                        ]);
                    }
                }
                catch(Exception $e)
                {
                    return response()->json([
                        'error' => "Error in State and Zipcode validation."
                    ]);
                }
                // Tax End

                $condition = new CartCondition(array(
                    'name' => 'shipping',
                    'type' => 'coupon',
                    'target' => 'total',
                    'value' => '+'.$passRates,
                    'attributes' => array()
                ));

                Cart::session($cartId)->condition($condition);
                return response()->json([
                    'rates' => $passRates,
                    'tax'   => $tax,
                    'subtotal' => Cart::session($cartId)->getTotal()
                ]);
            } catch (Exception $e) {
                return response()->json([
                    'error' => $e
                ]);
            }
        }

        return response()->json(true);
    }
	
	public function AddGuestAddress1(Request $request)
    {
        $postData = $request->all();

		$model = new UserAddress();
		$model->type = $postData['type'];
		$model->email = $postData['email'] ? $postData['email'] : 'dsdsdsds@sdds.com';
		$model->first_name = $postData['first_name'];
		$model->last_name = $postData['last_name'];
		$model->address = $postData['address'];
		$model->street = $postData['street'];
		$model->city = $postData['city'];
		$model->state = $postData['state'];
		$model->postal_code = $postData['postal_code'];
		$model->phone = $postData['phone'];
		$model->country = 'USA';

		$model->save();

        if($postData['type'] == 'shipping')
        {
            $rate = new \Ups\Rate(
                    env('UPS_ACCESS_KEY'),
                    env('UPS_USERID'),
                    env('UPS_PASSWORD')
                );

            try {
                $shipment = new \Ups\Entity\Shipment();

                $shipperAddress = $shipment->getShipper()->getAddress();
                $shipperAddress->setPostalCode('20005');

                $address = new \Ups\Entity\Address();
                $address->setPostalCode('20005');
                $shipFrom = new \Ups\Entity\ShipFrom();
                $shipFrom->setAddress($address);

                $shipment->setShipFrom($shipFrom);

                $shipTo = $shipment->getShipTo();
                $shipTo->setCompanyName('Test Ship To');
                $shipToAddress = $shipTo->getAddress();
                $shipToAddress->setPostalCode('20005');

                $package = new \Ups\Entity\Package();
                $package->getPackagingType()->setCode(\Ups\Entity\PackagingType::PT_PACKAGE);
                $package->getPackageWeight()->setWeight(10);
                
                // if you need this (depends of the shipper country)
                /*$weightUnit = new \Ups\Entity\UnitOfMeasurement;
                $weightUnit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_KGS);
                $package->getPackageWeight()->setUnitOfMeasurement($weightUnit);*/

                $dimensions = new \Ups\Entity\Dimensions();
                $dimensions->setHeight(10);
                $dimensions->setWidth(10);
                $dimensions->setLength(10);

                $unit = new \Ups\Entity\UnitOfMeasurement;
                $unit->setCode(\Ups\Entity\UnitOfMeasurement::UOM_IN);

                $dimensions->setUnitOfMeasurement($unit);
                $package->setDimensions($dimensions);

                $shipment->addPackage($package);

                $rates = $rate->getRate($shipment);
                if(isset($rates->RatedShipment) && isset($rates->RatedShipment[0]))
                {
                    $passRates = $rates->RatedShipment[0]->TotalCharges->MonetaryValue;
                }
				
				if(Session::has('cartSessionId'))
				{
					$cartId = Session::get('cartSessionId');                
				}
				else
				{
					$cartId = rand(0,9999);
					session(['cartSessionId' => $cartId]);
				}

                $cartData = Cart::session($cartId);

                $checkCartCondition = $cartData->getConditionsByType('coupon');

                if($checkCartCondition->count() > 0)
                {
                    foreach ($checkCartCondition as $key => $value) 
                    {
                        $cartData->removeCartCondition($key);
                    }
                }

                // Tax Start
                try
                {
                    //Calculate Taxes
                    $client = \TaxJar\Client::withApiKey(env('TAXJAR_API_KEY'));
        
                    $order_taxes = $client->taxForOrder([
                          'from_country'    => 'US',
                          'from_zip'        => '20036',
                          'from_state'      => 'DC',
                          'to_country'      => 'US',
                          'to_zip'          => $postData['postal_code'],
                          'to_state'        => $postData['state'],
                          'amount'          => $cartData->getSubTotal(),
                          'shipping'        => $passRates
                    ]);

                    if(isset($order_taxes->amount_to_collect))
                    {
                        $tax = $order_taxes->amount_to_collect;

                        $condition = new CartCondition(array(
                            'name' => 'tax',
                            'type' => 'coupon',
                            'target' => 'total',
                            'value' => '+'.$tax,
                            'attributes' => array()
                        ));

                        Cart::session($cartId)->condition($condition);
                    }
                    else
                    {
                        return response()->json([
                            'error' => "Error in State and Zipcode validation."
                        ]); 
                    }
                }
                catch(Exception $e)
                {
                    return response()->json([
                        'error' => "Error in State and Zipcode validation."
                    ]);
                }
                // Tax End

                $condition = new CartCondition(array(
                    'name' => 'shipping',
                    'type' => 'coupon',
                    'target' => 'total',
                    'value' => '+'.$passRates,
                    'attributes' => array()
                ));

                Cart::session($cartId)->condition($condition);

                return response()->json([
                    'rates' => $passRates
                    ]);
            } catch (Exception $e) {
                return response()->json([
                    'error' => $e
                ]);
            }
        }

        return response()->json(true);
    }

    public function applyPromo(Request $request)
    {
        $postData = $request->all();

        $checkPromo = $this->promo->where('code', $postData['promocode'])->first();

        if(!$checkPromo)
        {
            return redirect()->route('frontend.checkout.cart')->withFlashWarning("No such Promocode Exist.");
        }

        if(Auth::check())
        {
            $cartId = Auth::user()->id;
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
        }

        $cartData = Cart::session($cartId);

        $checkCartCondition = $cartData->getConditionsByType('promo');
        
        if($checkCartCondition->count() > 0)
        {
            $promos = $checkCartCondition->all();

            $promoList = array_keys($promos);

            if(in_array($postData['promocode'], $promoList))
            {
                return redirect()->route('frontend.checkout.cart')->withFlashWarning("Procode Already Applied.");
            }

            return redirect()->route('frontend.checkout.cart')->withFlashWarning("Only One Promocode can be applicable.");
        }
        else
        {
            if($checkPromo->type == 'flat')
            {
                $lessVal = '-'.$checkPromo->discount;
            }
            else
            {
                $lessVal = '-'.$checkPromo->discount.'%';
            }

            $condition = new CartCondition(array(
                'name' => $postData['promocode'],
                'type' => 'promo',
                'target' => 'subtotal',
                'value' => $lessVal,
                'attributes' => array()
            ));   
        }

        Cart::session($cartId)->condition($condition);

        return redirect()->route('frontend.checkout.cart')->withFlashSuccess("Promocode Successfully Applied.");
    }

    public function removePromo(Request $request)
    {
        if(Auth::check())
        {
            $cartId = Auth::user()->id;
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
        }

        $cartData = Cart::session($cartId);

        $checkCartCondition = $cartData->getConditionsByType('promo');

        if($checkCartCondition->count() == 0)
        {
            return redirect()->route('frontend.checkout.cart')->withFlashWarning("No Promocode Applied.");
        }

        $promos = $checkCartCondition->all();

        foreach ($promos as $key => $value) 
        {
            $cartData->removeCartCondition($key);
        }

        return redirect()->route('frontend.checkout.cart')->withFlashSuccess("Promocode removed Successfully.");
        
    }

    public function beforePayment(Request $request)
    {

        if(Auth::check())
        {
            $cartId = Auth::user()->id;
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
        }

        $cartData = Cart::session($cartId);

        $provider = new ExpressCheckout;
        $provider->setCurrency('USD');

        $data = [];

        foreach($cartData->getContent() as $singleKey => $singleValue)
        {
            $productData = $this->productRepository->find($singleValue->attributes->product_id);

            $data['items'][] = [
                                    'name' => $singleValue->name,
                                    'price' => $singleValue->price,
                                    'qty' => $singleValue->quantity
                                ];
        }

        $data['invoice_id']             = 1;
        $data['invoice_description']    = "Order #{$data['invoice_id']} Invoice";
        $data['return_url']             = url('/payment/success');
        $data['cancel_url']             = url('/cart');

        $total = 0;
        foreach($data['items'] as $item) 
        {
            $total += $item['price']*$item['qty'];
        }

        $checkCartCondition = $cartData->getConditionsByType('promo');

        if($checkCartCondition->count() > 0)
        {
            $promoData  = $checkCartCondition->first();

            $promoName  = $promoData->getName();
            $promoVal   = $promoData->getValue();

            $promoObjData = $this->promo->where('code', $promoName)->first();

            if($promoObjData->type == 'percentage')
            {
                $promoPriceVal = round(($promoObjData->discount / 100) * $total, 2);
            }
            else
            {
                $promoPriceVal = $promoObjData->discount;
            }

            $data['items'][] = [
                                    'name' => 'Discount',
                                    'price' => '-'.$promoPriceVal,
                                    'qty' => 1
                                ];

            $total = $total - $promoPriceVal;
        }  

        $shippingCondition = $cartData->getConditionsByType('coupon');

        if($shippingCondition->count() > 0)
        {
        	foreach($shippingCondition as $getCondition){
            $priceShipping      = (float)str_replace('+', '', $getCondition->getValue());

            $data['items'][] = [
                                    'name' => $getCondition->getName(),
                                    'price' => $priceShipping,
                                    'qty' => 1
                                ];

            $total = $total+ $priceShipping;
        	}
            $shippingData       = $shippingCondition->first();
            $priceShipping      = (float)str_replace('+', '', $shippingData->getValue());

            $data['items'][] = [
                                    'name' => 'Shipping',
                                    'price' => $priceShipping,
                                    'qty' => 1
                                ];

            $total = $total+ $priceShipping;
        } 

        $data['total'] = $total;

        //give a discount of 10% of the order amount
        
        /*if($shippingCondition->count() > 0)
        {
            $shippingData       = $shippingCondition->first();            
            $data['shipping']   = (float)str_replace('+', '', $shippingData->getValue());  
        }*/

        $response = $provider->setExpressCheckout($data);

        if((isset($response['type']) && $response['type'] == 'error') || (isset($response['paypal_link']) && !$response['paypal_link']))
        {
            return redirect()->route('frontend.checkout.cart')->withFlashWarning("Error in Checkout with Paypal, Please try again later.");
        }
        else
        {
            return redirect($response['paypal_link']);    
        }
    }

    public function afterPayment(Request $request)
    {
        dd($request->all());
    }

    public function overview()
    {
        if(Auth::check())
        {
            $cartId = Auth::user()->id;
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
        }

        $cartData = Cart::session($cartId);

        return view('frontend.checkout.overview')->with([
            'cartData'          => $cartData,
            'productRepository' => $this->productRepository,
            'productSize'       => $this->productSize,
        ]);
    }

    public function paymentStripe()
    {
        return view('frontend.checkout.paymentstripe');
    }

    public function beforePaymentOrder()
    {
        $cartId = Session::get('cartSessionId');
        $cartData = Cart::session($cartId);

        $checkCartCondition = $cartData->getConditions();
        $shipping = 0;
        $tax = 0;
        $billingAddressId = 0;
        $shippingAddressId = 0;

        if(Session::has('shippingUserAddressID'))
        {
            $shippingAddressId = Session::get('shippingUserAddressID');
        }

        if(Session::has('billingUserAddressID'))
        {
            $billingAddressId = Session::get('billingUserAddressID');
        }

        foreach ($checkCartCondition as $singleCondition)
        {
            if($singleCondition->getName() == 'tax')
            {
                $tax = $singleCondition->getValue();
            }
            if($singleCondition->getName() == 'shipping')
            {
                $shipping = $singleCondition->getValue();
            }
        }

        $userId = 0;
        if(Auth::check())
        {
            $userId = Auth::user()->id;
        }

        $model = new Order();
        $model->user_id = $userId;
        $model->status = 'pending';
        $model->subtotal = $cartData->getSubTotal();
        $model->total = $cartData->getTotal();
        $model->ship_rate = $shipping;
        $model->tax = $tax;
        $model->billing_address_id = $billingAddressId;
        $model->shipping_address_id = $shippingAddressId;

        $model->save();

        $orderId = $model->id;
        session(['orderId' => $orderId]);

        foreach ($cartData->getContent() as $singleKey => $singleValue)
        {
            $orderProduct = new OrderProduct();
            $orderProduct->order_id = $orderId;
            $orderProduct->product_id = $singleValue->attributes->product_id;
            $orderProduct->quantity = $singleValue->quantity;
            $orderProduct->price = $singleValue->price;
            $orderProduct->attributes = $singleValue->attributes;
            $orderProduct->save();
        }
    }

    public function postPaymentStripe(Request $request)
    {
        $this->beforePaymentOrder();

        $orderId = Session::get('orderId');

        if(Session::has('cartSessionId'))
        {
            $cartId = Session::get('cartSessionId');
        }
        else
        {
            $cartId = rand(0,9999);
            session(['cartSessionId' => $cartId]);
        }

        $cartData = Cart::session($cartId);

        $validator = Validator::make($request->all(), [
            'cc_name' => 'required',
            'cc_card_no' => 'required',
            'cc_expiry_month' => 'required',
            'cc_expiry_year' => 'required',
            'cc_cvv' => 'required',
            'amount' => 'required',
        ]);
        $input = $request->all();
        if ($validator->passes()) {
            $input = array_except($input,array('_token'));
            $stripe = Stripe::setApiKey(env('STRIPE_SECRET'));
            try {
                $token = $stripe->tokens()->create([
                    'card' => [
                        'number' => $request->get('cc_card_no'),
                        'exp_month' => $request->get('cc_expiry_month'),
                        'exp_year' => $request->get('cc_expiry_year'),
                        'cvc' => $request->get('cc_cvv'),
                    ],
                ]);
                if (!isset($token['id'])) {
                    return redirect()->route('frontend.checkout.cart')->withFlashWarning("Error from Stripe Account Setup");
                }
                $charge = $stripe->charges()->create([
                    'card' => $token['id'],
                    'currency' => 'USD',
                    'amount' => Cart::session($cartId)->getTotal(),
                    'description' => 'wallet',
                ]);

                if($charge['status'] == 'succeeded') {
                    Order::where('id', $orderId)->update(array('status' => 'payment success'));
                    Cart::clear();

                    return redirect()->route('frontend.index')->withFlashSuccess("Payment Successful.");
                } else {
                    Order::where('id', $orderId)->update(array('status' => 'payment failed'));
                    return redirect()->route('frontend.checkout.cart')->withFlashWarning("Error from Payment Gateway");
                }
            } catch (Exception $e) {
                return redirect()->route('frontend.checkout.cart')->withFlashWarning("Error occured in stripe payment.");
            } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {
                return redirect()->route('frontend.checkout.cart')->withFlashWarning("Card is not valid");
            } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
                return redirect()->route('frontend.checkout.cart')->withFlashWarning("Parameters are missing for Stripe payment.");
            }
        } else
        {
            return redirect()->route('frontend.checkout.cart')->withFlashWarning("Parameters are missing for Request.");
        }
    }
}
