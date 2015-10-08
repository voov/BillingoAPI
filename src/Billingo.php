<?php
/**
 * Copyright (c) 2015, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 */

namespace Billingo\API;


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
		$this->opts = $opts;
	}
}