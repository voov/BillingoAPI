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
	 * @return mixed|\Psr\Http\Message\ResponseInterface
	 */
	private function request($method, $uri, $data=[])
	{
		try {

			return $this->client->request($method, $uri, $data);

		} catch (\Exception $e) {

		}

		return null; //
	}

	/**
	 * GET
	 * @param $uri
	 * @param array $data
	 * @return mixed|\Psr\Http\Message\ResponseInterface
	 */
	public function get($uri, $data=[])
	{
		return $this->request('GET', $uri, $data);
	}

	/**
	 * POST
	 * @param $uri
	 * @param array $data
	 * @return mixed|\Psr\Http\Message\ResponseInterface
	 */
	public function post($uri, $data=[])
	{
		return $this->request('GET', $uri, $data);
	}

	/**
	 * PUT
	 * @param $uri
	 * @param array $data
	 * @return mixed|\Psr\Http\Message\ResponseInterface
	 */
	public function put($uri, $data = [])
	{
		return $this->request('GET', $uri, $data);
	}


	/**
	 * DELETE
	 * @param $uri
	 * @param array $data
	 * @return mixed|\Psr\Http\Message\ResponseInterface
	 */
	public function delete($uri, $data = [])
	{
		return $this->request('GET', $uri, $data);
	}
}