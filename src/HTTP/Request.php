<?php
/**
 * Copyright (c) 2015, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 */

namespace Billingo\API\Client\HTTP;


use GuzzleHttp\Client;

class Request
{
	private $client;

	/**
	 * Request constructor.
	 */
	public function __construct()
	{
		$this->client = new Client([
			'base_url' => ''
								   ]);
	}


}