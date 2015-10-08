<?php
/**
 * Copyright (c) 2015, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 */

namespace Billingo\API\Client\HTTP;


use Billingo\API\Client\Container\Container;
use GuzzleHttp\Client;

class Request
{
	/**
	 * @var Client
	 */
	private $client;

	/**
	 * Request constructor.
	 */
	public function __construct()
	{
		$this->client = Container::client();
	}

	/**
	 * Make a request to the Billingo API
	 * @param $method
	 * @param $uri
	 * @param array $data
	 */
	private function request($method, $uri, $data=[])
	{
		try {

			$config = Container::config();

			//$this->client->request($method, )

		} catch (\Exception $e) {

		}
	}
}