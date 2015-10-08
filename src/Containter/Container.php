<?php
/**
 * Copyright (c) 2015, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 */

namespace Billingo\API\Client\Container;


use Closure;

class Container
{
	/**
	 * @var array
	 */
	protected static $container = [];

	/**
	 * Return TRUE if key has been bound to the container
	 * @param $key
	 * @return bool
	 */
	public static function has($key)
	{
		return array_key_exists($key, static::$container);
	}

	/**
	 * Bind a closure to the container
	 * @param $key
	 * @param Closure $closure
	 * @param bool|false $singleton
	 */
	public static function bind($key, Closure $closure, $singleton=false)
	{
		static::$container[$key] = $closure;
	}


	/**
	 * Resolve from container
	 * @param $key
	 * @return mixed
	 * @throws NotFoundException
	 */
	public static function resolve($key)
	{
		if(!static::has($key)) throw new NotFoundException($key . ' not found in container!');
		$obj = static::$container[$key];
		return $obj();
	}

	/**
	 * is triggered when invoking inaccessible methods in a static context.
	 *
	 * @param $name string
	 * @param $arguments array
	 * @return mixed
	 * @link http://php.net/manual/en/language.oop5.overloading.php#language.oop5.overloading.methods
	 */
	public static function __callStatic($name, $arguments)
	{
		return static::resolve($name);
	}


}