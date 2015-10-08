<?php
/**
 * Copyright (c) 2015, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 */

namespace Billingo\API\Client\HTTP;


use Billingo\API\Client\Container\Container;
use Billingo\API\Client\Exceptions\JSONParseException;
use Billingo\API\Client\Exceptions\RequestErrorException;
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
	 * @return mixed|array
	 * @throws JSONParseException
	 * @throws RequestErrorException
	 */
	private function request($method, $uri, $data=[])
	{
		$response = $this->client->request($method, $uri, $data);
		$jsonData = json_decode($response->getBody(), true);
		if($jsonData == null) throw new JSONParseException('Cannot decode: ' . $response->getBody());
		if($response->getStatusCode() != 200 || $jsonData['success'] == 0)
			throw new RequestErrorException('Error: ' . $jsonData['msg'], $response->getStatusCode());

		return $jsonData;
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