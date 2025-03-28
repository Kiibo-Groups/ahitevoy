<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Twilio\Rest\Client;
use App\Admin;
use App\Language;
use Twilio;
class Controller extends BaseController
{
	use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


	// Usuarios
	function sendPush($title, $description, $uid = 0, $img = null)
	{
		$content = ["en" => $description];
		$head = ["en" => $title];

		$daTags = [];

		if ($uid > 0) {
			$daTags = ["field" => "tag", "key" => "user_id", "relation" => "=", "value" => $uid];
		} else {
			$daTags = ["field" => "tag", "key" => "user_id", "relation" => "!=", "value" => 'NAN'];
		}

		$fields = array(
			'app_id' => "9ed29aa5-c364-430e-8ab3-729c5c6ce496",
			'included_segments' => array('All'),
			'filters' => [$daTags],
			'data' => array("foo" => "bar"),
			'contents' => $content,
			'headings' => $head,
			'big_picture' => $img
		);


		$fields = json_encode($fields);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Authorization: Basic NTNhM2FiZDItYzAzMy00YzRlLWIzYzUtMjEzY2MyMjdlMjg1'
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);

		return $response;
	}

	// Repartidores
	function sendPushD($title, $description, $uid = 0)
	{
		$content = ["en" => $description];
		$head = ["en" => $title];

		$daTags = [];

		if ($uid > 0) {
			$daTags = ["field" => "tag", "key" => "dboy_id", "relation" => "=", "value" => $uid];
		} else {
			$daTags = ["field" => "tag", "key" => "dboy_id", "relation" => "!=", "value" => 'NAN'];
		}

		$fields = array(
			'app_id' => "00275f8b-54f7-454c-8ea1-509cb10ad1b1",
			'included_segments' => array('All'),
			'filters' => [$daTags],
			'data' => array("foo" => "bar"),
			'contents' => $content,
			'headings' => $head,
			'android_channel_id' => 'd75a97ca-82bb-4c94-acc2-6aace684f0eb'
		);

		$fields = json_encode($fields);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Authorization: Basic YzFkODNjNjYtOTEwMi00NDc1LWI5MGQtYjA5NzM0OTc3NjU5'
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);

		return $response;
	}

	// Repartidores Externos
	function sendPushDExt($title, $description, $uid = 0)
	{
		$content = ["en" => $description];
		$head = ["en" => $title];

		$daTags = [];

		if ($uid > 0) {
			$daTags = ["field" => "tag", "key" => "dboy_ext_id", "relation" => "=", "value" => $uid];
		} else {
			$daTags = ["field" => "tag", "key" => "dboy_ext_id", "relation" => "!=", "value" => 'NAN'];
		}

		$fields = array(
			'app_id' => "00275f8b-54f7-454c-8ea1-509cb10ad1b1",
			'included_segments' => array('All'),
			'filters' => [$daTags],
			'data' => array("foo" => "bar"),
			'contents' => $content,
			'headings' => $head,
			'android_channel_id' => 'd75a97ca-82bb-4c94-acc2-6aace684f0eb'
		);


		$fields = json_encode($fields);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Authorization: Basic YzFkODNjNjYtOTEwMi00NDc1LWI5MGQtYjA5NzM0OTc3NjU5'
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);

		return $response;
	}

	// Comercios
	function sendPushS($title, $description, $uid = 0)
	{
		$content = ["en" => $description];
		$head = ["en" => $title];

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

		return $response;
	}

	// Administrador
	function sendPushAdmin($title, $description, $uid = 0)
	{
		$content = ["en" => $description];
		$head = ["en" => $title];

		$daTags = [];

		if ($uid > 0) {
			$daTags = ["field" => "tag", "key" => "admin_id", "relation" => "=", "value" => $uid];
		} else {
			$daTags = ["field" => "tag", "key" => "admin_id", "relation" => "!=", "value" => 'NAN'];
		}

		$fields = array(
			'app_id' => "b66021b6-480b-492e-99c0-fdd30ca9c9ase2",
			'included_segments' => array('All'),
			'data' => array("foo" => "bar"),
			'filters' => [$daTags],
			'contents' => $content,
			'headings' => $head,
		);


		$fields = json_encode($fields);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Authorization: Basic NzMyYjZhOWMtYzAyNC00NmQ2LWFhYTEtMGQ3Y2I1NmRaskNmM2'
		));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);

		$response = curl_exec($ch);
		curl_close($ch);

		return $response;
	}

	public function currency()
	{
		$admin = Admin::find(1);

		if ($admin->currency) {
			return $admin->currency;
		} else {
			return "Rs.";
		}
	}

	public function getLang()
	{
		$res = new Language;

		return $res->getAll();
	}
}