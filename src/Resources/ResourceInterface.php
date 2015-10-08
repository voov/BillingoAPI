<?php
/**
 * Copyright (c) 2015, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 */

namespace Billingo\API\Client\Resources;


use Doctrine\Common\Collections\Collection;

interface ResourceInterface
{
	/**
	 * Return the list of resources
	 * @return ResourceInterface[]|Collection
	 */
	public static function all();

	/**
	 * Fill the resource with attributes
	 * @param array $attributes
	 * @return mixed
	 */
	public function fill($attributes = []);

	/**
	 * Read one resource
	 * @param $id
	 * @return ResourceInterface
	 */
	public static function read($id);

	/**
	 * Save the resource
	 * @return mixed
	 */
	public function save();

	/**
	 * Delete resource
	 * @return mixed
	 */
	public function delete();

}