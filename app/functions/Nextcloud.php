<?php

use GuzzleHttp\RequestOptions;
use GuzzleHttp\Client;

$nextcloud = new Nextcloud();
class Nextcloud extends Controller {

	public function create($username, $password, $qouta) {
	
		$client = new Client();
		$response = $client->post(
			'' . env('NEXTCLOUD_CREATE') . '',

			[
				'headers' => [
					'Content-Type' => 'application/x-www-form-urlencoded',
					'OCS-APIRequest' => 'true'
				],


				'form_params' => [
					'userid' => $username,
					'password' => $password,
					'quota' => $qouta
				],
			]
		);

		return $response->getBody()->getContents();
	}
	
}