<?php namespace App\Http\Controllers\api;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OpenpayController;
use App\Http\Controllers\NodejsServer;

use Illuminate\Http\Request;
use Auth;
use App\City;
use App\OfferStore;
use App\Offer;
use App\User;
use App\Cart;
use App\CartCoupen;
use App\AppUser;
use App\Order;
use App\Order_staff;
use App\OrderAddon;
use App\OrderItem;
use App\Lang;
use App\Rate;
use App\Slider;
use App\Banner;
use App\Address;
use App\Admin;
use App\Page;
use App\Language;
use App\Text;
use App\Delivery;
use App\CategoryStore;
use App\Opening_times;
use App\CardsUser;
use App\Favorites;
use DB;
use Validator;
use Redirect;
use Excel;
use Stripe;

class ApiController extends Controller {

	public function welcome()
	{
		$res = new Slider;

		return response()->json(['data' => $res->getAppData()]);
	}

	public function city()
	{
		$city = new City;
        $text = new Text;
        $lid =  isset($_GET['lid']) && $_GET['lid'] > 0 ? $_GET['lid'] : 0;

		return response()->json([
			'data' => $city->getAll(0),
			'text' => $text->getAppData($lid)
		]);
	}

	public function GetNearbyCity()
	{
		$city = new City;
        $text = new Text;
        $lid =  isset($_GET['lid']) && $_GET['lid'] > 0 ? $_GET['lid'] : 0;

		return response()->json([
			'data' => $city->GetNearbyCity(0),
			'text' => $text->getAppData($lid)
		]);
	}

	public function updateCity()
	{
		$res = AppUser::find($_GET['id']);
		$res->last_city = $_GET['city_id'];
		$res->save();

		return response()->json(['data' => 'done']);
	}

	public function lang()
	{
		$res = new Language;

		return response()->json(['data' => $res->getWithEng()]);
	}

	public function getDataInit()
	{
		$text    = new Text;
		$l 		 = Language::find($_GET['lid']);

		$data = [
			'text'		=> $text->getAppData($_GET['lid']),
			'app_type'	=> isset($l->id) ? $l->type : 0,
			'admin'		=> Admin::find(1),
		];

		return response()->json(['data' => $data]);
		
	}

	public function homepage($city_id)
	{
		$banner  = new Banner;
		$store   = new User;
		$text    = new Text;
		$offer   = new Offer;
		$cats    = new CategoryStore;
		$l 		 = Language::find($_GET['lid']);

		$data = [
			'admin'		=> Admin::find(1),
			'banner'	=> $banner->getAppData($city_id,0),
			'middle'	=> $banner->getAppData($city_id,1),
			'bottom'	=> $banner->getAppData($city_id,2),
			'store'		=> $store->getAppData($city_id),
			'trending'	=> $store->InTrending($city_id), //$store->getAppData($city_id,true),
			'Categorys' => $cats->getAllCats(),
			'offers'    => $offer->getAll(0),
			'Tot_stores'=> $store->getTotsStores($city_id)
		];

		return response()->json(['data' => $data]);
	}

	public function ViewAllCats()
	{
		$cats    = new CategoryStore;
	
		$data = [
			'Categorys' => $cats->getAllCats(),
		];

		return response()->json(['data' => $data]);
	}

	public function getStoreOpen($city_id)
	{
		$store   = new User;
		$except  = [
			'id',
			'password',
			'shw_password',
			'remember_token',
			'sms_api',
			'costs_ship',
			'c_type',
			'c_value',
			'min_distance',
			'max_distance_staff',
			'min_value',
			'store_type',
			'openpay_client_id',
			'openpay_private_key',
			'openpay_public_key',
			'paypal_client_id',
			'stripe_client_id',
			'stripe_api_id',
			'ApiKey_google',
			'comm_stripe',
			'send_terminal',
			'max_cash',
			'created_at',
			'updated_at'
		];

		$data = [
			'store'		=> $store->getStoreOpen($city_id),
			'admin'		=> collect(Admin::find(1))->except($except),
		];

		return response()->json(['data' => $data]);		
	}

	public function getStore($id)
	{
		
		$store   = new User; 
		return response()->json(['data' => $store->getStore($id)]);
	}

	public function GetInfiniteScroll($city_id) {
		
		try{
			$store   = new User;
			$data = [
				'store'		=> $store->GetAllStores($city_id)
			];
			return response()->json(['data' => $data]);
		} catch (\Exception $th) {
			return response()->json(['data' => 'error','error' => $th->getMessage()]);
		}
	}

	public function getTypeDelivery($id)
	{
		$user = new User;
		return response()->json([$user->getDeliveryType($id)]);
	}

	public function search($query,$type,$city)
	{
		$user = new User;

		return response()->json(['data' => $user->getUser($query,$type,$city)]);
	}

	public function SearchCat($city_id)
	{
		$user = new User;

		return response()->json([
			'cat'	=> CategoryStore::find($_GET['cat'])->name,
			'data' 	=> $user->SearchCat($city_id)
		]);
	}

	public function SearchFilters($city_id)
	{
		$user = new User;

		return response()->json([
			'data' 	=> $user->SearchFilters($city_id)
		]);
	}

	public function addToCart(Request $Request)
	{
		$res = new Cart;

		return response()->json(['data' => $res->addNew($Request->all())]);
	}

	public function updateCart($id,$type)
	{
		$res = new Cart;

		return response()->json(['data' => $res->updateCart($id,$type)]);
	}

	public function cartCount($cartNo)
	{
	  if(isset($_GET['user_id']) && $_GET['user_id'] > 0)
	  {
	  	$order = Order::where('user_id',$_GET['user_id'])->whereIn('status',[0,1,1.5,3,4,5])->count();
	  }
	  else
	  {
	  	$order = 0;
	  }

	  $cart = new Cart;
	  $req  = new Order;

	  	return response()->json([
			'data'  => Cart::where('cart_no',$cartNo)->count(),
			'order' => $order,
			'data_order' => ($order > 0) ? Order::where('user_id',$_GET['user_id'])->whereIn('status',[0,1,1.5,3,4,5])->first()->external_id : '',
			'list_orders' => ($order > 0) ? $req->getListOrder($_GET['user_id']) : [],
			'cart'	=> $cart->getItemQty($cartNo)
		]);
	}

	public function getCart($cartNo)
	{
		try {
			$res = new Cart;
			return response()->json(['data' => $res->getCart($cartNo)]);
		} catch (\Exception $th) {
			return response()->json(['data' => 'error','error' => $th->getMessage()]);
		}
	}

	public function deleteAll($cartNo)
	{
		$res = new Cart;

		return response()->json(['data' => $res->deleteAll($cartNo)]);
	}

	public function getOffer($cartNo)
	{
		$res = new Offer;

		return response()->json(['data' => $res->getOffer($cartNo)]);
	}

	public function applyCoupen($id,$cartNo)
	{
		$res = new CartCoupen;

		return response()->json($res->addNew($id,$cartNo));
	}

	public function signup(Request $Request)
	{
		$res = new AppUser;
		return response()->json($res->addNew($Request->all()));
	}

	public function sendOTP(Request $Request)
	{
		$phone = $Request->phone;
		$hash  = $Request->hash;

		return response()->json(['otp' => app('App\Http\Controllers\Controller')->sendSms($phone,$hash)]);
	}

	public function SignPhone(Request $Request)
	{
		$res = new AppUser;

		return response()->json($res->SignPhone($Request->all()));
	}

	public function chkUser(Request $Request)
	{
		$res = new AppUser;

		return response()->json($res->chkUser($Request->all()));
	}

	public function login(Request $Request)
	{
		$res = new AppUser;
		return response()->json($res->login($Request->all()));
	}

	public function Newlogin(Request $Request)
	{
		$res = new AppUser;

		return response()->json($res->Newlogin($Request->all()));
	}

	public function forgot(Request $Request)
	{
		$res = new AppUser;
		return response()->json($res->forgot($Request->all()));
	}

	public function verify(Request $Request)
	{
		$res = new AppUser;

		return response()->json($res->verify($Request->all()));
	}

	public function updatePassword(Request $Request)
	{
		$res = new AppUser;

		return response()->json($res->updatePassword($Request->all()));
	}

	public function loginFb(Request $Request)
	{
		$res = new AppUser;

		return response()->json($res->loginFb($Request->all()));
	}

	public function getAddress($id)
	{
		$address = new Address;
		$cart 	 = new Cart;

		$data 	 = [
		'address'	 => $address->getAll($id),
		'Comercio'   => User::find($_GET['store']),
		'total'   	 => $cart->getCart($_GET['cart_no'])['total'],
		'c_charges'  => $cart->getCart($_GET['cart_no'])['c_charges']
		];

		return response()->json(['data' => $data]);
	}

	public function getAllAdress($id)
	{
		$address = new Address;
	
		return response()->json(['data' => $address->getAll($id)]);
	}

	public function addAddress(Request $Request)
	{
		$res = new Address;

		return response()->json($res->addNew($Request->all()));
	}

	public function removeAddress($id)
	{
		$res = new Address;
		return response()->json($res->Remove($id));
	}

	public function searchLocation(Request $Request)
	{
		$city = new City;
		return response()->json([
			'citys' => $city->getAll()
		]);

	}

	public function order(Request $Request)
	{
		try {
			$res = new Order;
			return response()->json($res->addNew($Request->all()));
		} catch (\Exception $th) {
			return response()->json(['data' => 'error', 'error' => $th->getMessage()]);
		}
	}

	public function userinfo($id)
	{
		return response()->json(['data' => AppUser::find($id)]);
	}

	public function signupOP(Request $Request)
	{
		try {
			$res = new AppUser;
			return response()->json(['data' => $res->signupOP($Request->all())]);
		} catch (\Exception $th) {
			return response()->json(['data' => "error",'error' => $th->getMessage()]);
		}
	}

	public function updateInfo($id,Request $Request)
	{
		$res = new AppUser;

		return response()->json($res->updateInfo($Request->all(),$id));
	}

	public function cancelOrder($id,$uid)
	{
		try {
			$res = new Order;
			return response()->json($res->cancelOrder($id,$uid));
		} catch (\Exception $th) {
			return response()->json(['data' => 'error', 'error' => $th->getMessage()]);
		}
	}

	public function rate(Request $Request)
	{
		try {
			$rate = new Rate;
		return response()->json($rate->addNew($Request->all()));
		} catch (\Exception $th) {
			return response()->json(['data' => 'error', 'error' => $th->getMessage()]);
		}

	}

	public function pages()
	{
		$res = new Page;

		return response()->json(['data' => $res->getAppData()]);
	}

	public function myOrder($id)
	{
		$res = new Order;

		return response()->json(['data' => $res->history($id)]);
	}

	public function stripe()
	{

		try {
			Stripe\Stripe::setApiKey(Admin::find(1)->stripe_api_id);

			$res = Stripe\Charge::create ([
					"amount" => $_GET['amount'] * 100,
					"currency" => "MXN",
					"source" => $_GET['token'],
					"description" => "Pago de compra en AhiTeVoy"
			]);

			if($res['status'] === "succeeded")
			{
				return response()->json(['data' => "done",'id' => $res['source']['id']]);
			}
			else
			{
				return response()->json(['data' => "error"]);
			}
		} catch (\Throwable $th) {
			return response()->json(['data' => "error"]);
		}
	}

	public function getChat($id)
	{

		$uid     = $id;
		$content = ["en" => "Prueba de notificaciones"];
		$head = ["en" => "Prueba de audio para notificaciones."];

		$daTags = [];
		if ($uid > 0) {
			$daTags = ["field" => "tag", "key" => "store_id", "relation" => "=", "value" => $uid];
		} else {
			$daTags = ["field" => "tag", "key" => "store_id", "relation" => "!=", "value" => 'NAN'];
		}

		$fields = array(
			'app_id' => "c41d3e93-68e5-4b01-9dfd-eb898b272e5b",
			'included_segments' => array('All'),
			'filters' => [$daTags],
			'data' => array("foo" => "bar"),
			'contents' => $content,
			'headings' => $head,
			'android_channel_id' => '4897030b-cc2e-41eb-9d94-ee2a1629580a'
		);


		$fields = json_encode($fields);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Authorization: Basic M2MyOTI0OGUtNTE3Ni00Y2ZhLWE4MjMtZmNhZjMwMWJjNjM4'
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);

        return [
			'data' => $response
		];
	}

	public function getStatus($id)
	{
		try {
			$order = Order::find($id);
			$dboy  = Delivery::find($order->d_boy);
			$store = User::find($order->store_id);

			return response()->json(['data' => $order,'dboy' => $dboy, 'store' => $store]);
		} catch (\Throwable $th) {
			return response()->json(['data' => [],'dboy' => [], 'store' => []]);
		}
	}

	public function getPolylines()
	{
		$url = "https://maps.googleapis.com/maps/api/directions/json?origin=".$_GET['latOr'].",".$_GET['lngOr']."&destination=".$_GET['latDest'].",".$_GET['lngDest']."&mode=driving&key=".Admin::find(1)->ApiKey_google;
		$max      = 0;

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec ($ch);
        $info = curl_getinfo($ch);
        $http_result = $info ['http_code'];
        curl_close ($ch);


		$request = json_decode($output, true);

		return response()->json($request);
	}

	public function sendChat(Request $Request)
	{
		$chat = new Chat;
		return response()->json($chat->addNew($Request->all()));
	}

	public function deleteOrders (Request $Request)
	{
		$items  = $Request->all()['SendChk'];

		for ($i=0; $i < count($items); $i++) { 
			Order::find($items[$i])->delete();
			Order_staff::where('order_id',$items[$i])->delete();
			OrderAddon::where('order_id',$items[$i])->delete();
			OrderItem::where('order_id',$items[$i])->delete();
		}	

		return response()->json(['data' => 'done']);
	}

	/**
	 * Metodos OpenPay
	 */

	public function getClient(Request $Request)
	{
		try {
			$openPay = new OpenpayController;
			return response()->json(['data' => $openPay->getClient($Request->all())]);
		} catch (\Throwable $th) {
			return response()->json(['data' => "error"]);
		}
	}

	public function SetCardClient(Request $Request)
	{
		try {
			$openpay = new OpenpayController;
			$req     = $openpay->SetCardClient($Request->all());
			if ($req['status'] == true) {
				$user = AppUser::find($Request->get('user_id'));
				$card = new CardsUser;
				$data 	 = [
					'user_id'	 	=> $user->id,
					'token_card'   	=> $req['data']['id']
				];

				$card->addNew($data,'add');
			}

			return response()->json(['data' => $req]);
		} catch (\Throwable $th) {
			return response()->json(['data' => "error",'error' => $th]);
		}
	}

	public function GetCards(Request $Request)
	{
		try {
			$openpay = new OpenpayController;
			
			return response()->json(['data' => $openpay->getCardsClient($Request->all())]);
		} catch (\Throwable $th) {
			return response()->json(['data' => "error"]);
		}
	}

	public function DeleteCard(Request $Request)
	{
		try {
			$openpay = new OpenpayController;
			
			return response()->json(['data' => $openpay->DeleteCard($Request->all())]);
		} catch (\Throwable $th) {
			return response()->json(['data' => "error"]);
		}
	}

	public function getCard(Request $Request)
	{
		try {
			$openpay = new OpenpayController;
			
			return response()->json(['data' => $openpay->getCard($Request->all())]);
		} catch (\Throwable $th) {
			return response()->json(['data' => "error"]);
		}
	}

	public function chargeClient(Request $Request)
	{
		try {
			$openpay = new OpenpayController;
			
			return response()->json(['data' => $openpay->chargeClient($Request->all())]);
		} catch (\Throwable $th) {
			return response()->json(['data' => "error"]);
		}
	}

	/**
	 * 
	 *  Favorites Funcions
	 * 
	 */

	 public function SetFavorite(Request $Request)
	 {
		try {
			$req = new Favorites;
			
			return response()->json(['data' => $req->addNew($Request->all())]);
		} catch (\Throwable $th) {
			return response()->json(['data' => "error"]);
		}
	 }

	 public function GetFavorites($id)
	 {
		try {
			$req = new Favorites;
			
			return response()->json(['data' => $req->GetFavorites($id)]);	
		} catch (\Exception $th) {
			return response()->json(['data' => "error",'error' => $th->getMessage()]);
		}
	 }

	 public function TrashFavorite($id, $user)
	 {
		try {
			$req = new Favorites;
			return response()->json(['data' => $req->TrashFavorite($id, $user)]);	
		} catch (\Throwable $th) {
			return response()->json(['data' => "error",'error' => $th]);
		}
	 }


	/**
	  * 
	  * Solcitud de repartidores cercanos
	  *
	 */

	public function getNearbyStaffs($order,$type_staff)
	{
		// Obtenemos repartidores Mas cercanos
		$delivery = new Delivery;
		return response()->json(['data' => $delivery->getNearby($order, $type_staff)]);
	}

	public function setStaffOrder($order, $dboy)
	{
		// Chequeo de pedido y registro de repartidores
		$delivery = new Delivery;
		return response()->json(['data' => $delivery->setStaffOrder($order,$dboy)]);	
	}

	public function delStaffOrder($order)
	{
		// Chequeo de pedido y registro de repartidores
		$delivery = new Delivery;
		return response()->json(['data' => $delivery->delStaffOrder($order)]);	
	}

	public function updateStaffDelivery($staff, $external_id)
	{
		$staff = Delivery::find($staff);

		$staff->external_id = $external_id;
		$staff->save();

		return response()->json(['data' => 'done']);
	}
}
