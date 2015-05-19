<?php
/**
 Copyright (c) 2014, VOOV LLC.
 All rights reserved.
 Written by Daniel Fekete
*/

namespace R7;
/**
 * Class Signer
 * Creates R7 compatible signatures
 * @package R7
 */
class Signer {
	public static function createSignedAttributeSet(&$attributes, $privateKey) {
		$attributes["ts"] = gmmktime() . "";
		$attributes["public_key"] = PUBLIC_KEY;
		$q = json_encode($attributes);
		$attributes["signature"] = hash_hmac("sha256", $q, $privateKey);
	}
}