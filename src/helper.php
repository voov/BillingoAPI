<?php
/**
 * Copyright (c) 2015, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 */

if(!function_exists('container')) {
	/**
	 * Resolve from Container
	 * @param $resolve
	 * @return mixed
	 * @throws \Billingo\API\Client\Container\NotFoundException
	 */
	function container($resolve) {
		return \Billingo\API\Client\Container\Container::resolve($resolve);
	}
}