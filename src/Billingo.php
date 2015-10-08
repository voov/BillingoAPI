<?php
/**
 * Copyright (c) 2015, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 */

namespace Billingo\API;


use Billingo\API\Client\Container\Container;
use GuzzleHttp\Client;

class Billingo
{
	/**
	 * @var array
	 */
	private $opts;

	/**
	 * Billingo constructor.
	 * @param array $opts
	 */
	public function __construct(array $opts = [])
	{
		// Bind the config to the container
		Container::bind('config', function() use ($opts) {
			return $opts;
		});

		// Bind Guzzle
		Container::bind('client', function() use ($opts) {
			return new Client(['base_uri' => $opts['base_uri']]);
		});
	}
}