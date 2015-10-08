<?php
/**
 * Copyright (c) 2015, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 */

namespace Billingo\API;


use Billingo\API\Client\Container\Container;
use Billingo\API\Client\HTTP\Request;
use GuzzleHttp\Client;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
			$resolver = new OptionsResolver();
			$resolver->setDefault('version', '2');
			$resolver->setRequired(['host', 'private_key', 'public_key', 'version']);
			return $resolver->resolve($opts);
		});

		// Bind Guzzle
		Container::bind('client', function() use ($opts) {
			return new Client(['base_uri' => $opts['host']]);
		});

		// Bind Request
		Container::bind('request', function() {
			return new Request();
		});
	}
}