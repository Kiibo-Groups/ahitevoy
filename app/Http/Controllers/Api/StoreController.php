<?php

namespace App\Http\Controllers\api;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\NodejsServer;

use Illuminate\Http\Request;
use Auth;
use App\Delivery;
use App\Order;
use App\Language;
use App\Text;
use App\User;
use App\City;
use App\Admin;
use App\Item;
use App\Order_staff;
use DB;
use Validator;
use Redirect;
use Excel;
use Stripe;

class StoreController extends Controller
{

	public function homepage()
	{
		$res 	 = new Order;
		$text    = new Text;
		$l 		 = Language::find($_GET['lid']);

		return response()->json([
			'data' 		=> $res->storeOrder(),
			'complete' 	=> $res->storeOrder(5),
			'text'		=> $text->getAppData($_GET['lid']),
			'admin'		=> Admin::find(1),
			'app_type'	=> isset($l->id) ? $l->type : 0,
			'store'		=> User::find($_GET['id']),
			'overview'	=> $res->overView(),
			'dboy'		=> Delivery::where('status', 0)->get()
		]);
	}

	public function orderProcess()
	{
		try {
			$res 		 = Order::find($_GET['id']);
			$data_deli   = '';
			$res->status 		= $_GET['status'];
			$res->save();


			// Cambiamos el status en FB 
			$fb_server = new NodejsServer;
			$dat_s = array(
				'external_id' 	=> $res->external_id,
				'status' 		=> $res->status,
				'change_from'   => 'store_app'
			);
			$fb_server->orderStatus($dat_s);

			if (isset($_GET['dboy_Ext'])) {
				$res->d_boy = 0;
				$res->save();
				// 0 = Auto, 1 = Moto, 2 = Bici
				$type_staff = isset($_GET['type_staff']) ? $_GET['type_staff'] : 1;

				// Enviamos al servidor
				$dat_s = array(
					'order_id'		=> $_GET['id'],
					'type_staff'    => $type_staff,
				);

				$data_deli = $fb_server->setStaffDelivery($dat_s);
			}

			//$res->sendSms($_GET['id']);
			return response()->json(['data' => $_GET['id'], 'data_deli' => $data_deli]);
		} catch (\Throwable $th) {
			return response()->json(['data' => 'fail', 'data_deli' => []]);
		}
	}

	public function city()
	{
		$city = new City;
		$text = new Text;

		return response()->json(['data' => $city->getAll(0)]);
	}

	public function updateCity()
	{
		$admin = Admin::find($_GET['user_id']);

		$admin->city_notify = $_GET['city_id'];
		$admin->save();

		return response()->json(['data' => 'done']);
	}

	public function getStaffNearby($id)
	{
		$staff = new Delivery;
		return response()->json(['dboy' => $staff->getNearby($id, 1)]);
	}

	public function overview()
	{
		$res 	 = new User;

		return response()->json([
			'data' 		=> $res->overview_app()
		]);
	}

	public function login(Request $Request)
	{
		$res = new User;

		return response()->json($res->login($Request->all()));
	}

	public function signup(Request $request)
	{
		try {
			$data = $request->all();

			$input['name'] = $data['username'];
			$input['email'] = $data['email'];
			$input['phone']	=  isset($data['phone']) ? $data['phone'] : null;
			$input['password'] = bcrypt("password");
			$input['shw_password'] = "password";
			$input['status'] = 1;

			$input['logo'] = time() . rand(111, 699) . ".png";
			$input['img_discount'] = time() . rand(111, 699) . ".png";
			$input['saldo'] = 0;
			$input['delivery_min_charges_value'] = 0;
			$input['delivery_min_distance'] = 0;
			$input['type_charges_value'] = 0;
			$input['distance_max'] = 0;
			$input['trending'] = 0;
			$input['city_id'] = 1;
			$input['c_type'] = 0;
			$input['c_value'] = 0;
			$input['t_type'] = 0;
			$input['t_value'] = 0;
			$input['stripe_pay'] = 0;
			$input['p_staff'] = 0;
			$input['service_del'] = 0;
			$input['pickup'] = 0;
			$input['open'] = 0;
			$input['subtype'] = 0;
			$input['Cuenta_clave'] = 0;
			$input['banco_name'] = 0;


			$create = User::create($input);

			return response()->json(['data' => $create, 'msg' => 'done']);
		} catch (\Exception $th) {
			return response()->json(['data' => "error", 'error' => $th->getMessage()]);
		}
	}

	public function forgot(Request $Request)
	{
		$res = new User;
		return response()->json($res->forgot($Request->all()));
	}

	public function verify(Request $Request)
	{
		$res = new User;

		return response()->json($res->verify($Request->all()));
	}

	public function updatePassword(Request $Request)
	{
		$res = new User;

		return response()->json($res->updatePassword($Request->all()));
	}

	public function userInfo($id)
	{
		return response()->json(['data' => User::find($id)]);
	}

	public function storeOpen($type)
	{
		try {
			$res 		= User::find($_GET['user_id']);

			if (isset($res->id)) {

				$res->open 	= $type;
				$res->save();
			}

			return response()->json(['data' => true]);
		} catch (\Exception $th) {
			return response()->json(['data' => "error", 'error' => $th->getMessage()]);
		}
	}

	public function updateInfo(Request $Request)
	{
		$res 				= User::find($Request->get('id'));

		if ($Request->get('password')) {
			$res->password      = bcrypt($Request->get('password'));
			$res->shw_password  = $Request->get('password');
		}

		$res->min_cart_value 		 = $Request->get('min_cart_value');
		$res->delivery_charges_value = $Request->get('delivery_charges_value');
		$res->save();

		return response()->json(['data' => true]);
	}

	public function updateLocation(Request $Request)
	{
		if ($Request->get('user_id') > 0) {
			$add 			= Delivery::find($Request->get('user_id'));
			$add->lat 		= $Request->get('lat');
			$add->lng 		= $Request->get('lng');
			$add->save();
		}

		return response()->json(['data' => true]);
	}

	public function getItem()
	{
		$res = new User;
		return response()->json(['data' => $res->menuItem($_GET['id'], $_GET['type'], $_GET['value'])]);
	}

	public function changeStatus()
	{
		$res 		 = Item::find($_GET['id']);
		$res->status = $_GET['status'];
		$res->save();

		return response()->json(['data' => true]);
	}
}
