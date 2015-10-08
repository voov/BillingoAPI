<?php
/**
 * Copyright (c) 2015, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 */

namespace Billingo\API\Client\Resources;


interface ResourceInterface
{
	/**
	 * Return the list of resources
	 * @return mixed
	 */
	public function index();


	/**
	 * Read one resource
	 * @param $id
	 * @return mixed
	 */
	public function read($id);

	/**
	 * Create a new resource
	 * @param $data
	 * @return mixed
	 */
	public function create($data);

	/**
	 * Update resource
	 * @param $id
	 * @param $data
	 * @return mixed
	 */
	public function update($id, $data);

	/**
	 * Delete resource
	 * @param $id
	 * @return mixed
	 */
	public function delete($id);

}