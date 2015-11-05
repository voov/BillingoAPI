<?php
/**
 * Copyright (c) 2015, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 */

namespace Billingo\API\Client\HTTP;


class Route
{
	private $uri;

	/**
	 * Route constructor.
	 * @param $uri
	 */
	public function __construct($uri)
	{
		$this->uri = rtrim($uri, '/');
	}

	/**
	 * Generate full path
	 * @param $path
	 * @param array $params
	 * @param bool $absolute
	 * @return string
	 */
	public function path($path, $params=[], $absolute=false)
	{
		$paramsString = implode('/', (array)$params);
		$path = rtrim($path, '/') . '/' . $paramsString;
		if($absolute) return $path;
		return $this->uri . '/' . $path;
	}
}