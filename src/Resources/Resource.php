<?php
/**
 * Copyright (c) 2015, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 */

namespace Billingo\API\Client\Resources;


use Billingo\API\Client\Container\Container;
use Billingo\API\Client\HTTP\Request;
use Billingo\API\Client\Exceptions\NewDeleteException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

abstract class Resource implements ResourceInterface
{

	/**
	 * @var array attribute array
	 */
	private $attributes;

	/**
	 * @var string URI for the resource
	 */
	protected static $route = "";

	/**
	 * @var boolean FALSE if Resource is loaded
	 */
	public $exists;

	/**
	 * @var Request
	 */
	private $request;

	function __construct($attributes = [], $exists=false)
	{
		$this->request = Container::request();
		$this->fill($attributes);
		$this->exists = $exists;
	}

	/**
	 * Return the route with the resource ID appended
	 * @return string
	 */
	protected static function getRouteWithId($id) {
		return rtrim(static::$route, '/') . '/' . $id;
	}

	function __set($name, $value)
	{
		$this->attributes[$name] = $value;
	}

	function __get($name) {
		return $this->attributes[$name];
	}


	/**
	 * Fill the resource with attributes
	 * @param array $attributes
	 * @return mixed
	 */
	public function fill($attributes = [])
	{
		$this->attributes = $attributes;
	}

	/**
	 * Save the resource
	 * @return mixed
	 */
	public function save()
	{
		if(!$this->exists) {
			// save the resource as new
			$this->request->post(static::$route, $this->attributes);
		} else {
			// update current resource
			$this->request->put(static::getRouteWithId($this->id), $this->attributes);
		}
	}

	/**
	 * Return the list of resources
	 * @return ResourceInterface[]|Collection
	 */
	public static function all()
	{
		$coll = new ArrayCollection();
		/** @var Request $request */
		$request = Container::request();
		$response = $request->get(static::$route);
		foreach ((array)$response['data'] as $item) {
			$instance = new static($item, true);
			$coll->add($instance);
		}

		return $coll;
	}

	/**
	 * Read one resource
	 * @param $id
	 * @return ResourceInterface
	 */
	public static function read($id)
	{
		/** @var Request $request */
		$request = Container::request();
		$response = $request->get(static::getRouteWithId($id));
		return new static($response['data'], true); // fill the instance with loaded data;
	}

	/**
	 * Delete resource
	 * @return mixed
	 * @throws NewDeleteException
	 */
	public function delete()
	{
		if($this->exists && $this->id != null) $this->request->delete(static::getRouteWithId($this->id), ['id' => $this->id]);
		else throw new NewDeleteException();
	}


}