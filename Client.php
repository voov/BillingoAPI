<?php
/**
 Copyright (c) 2014, VOOV LLC.
 All rights reserved.
 Written by Daniel Fekete
*/

namespace R7;
/**
 * Class Client
 * Implements a REST client
 * @package R7
 */
class Client {
	protected $url;
	public function __construct($url) {
		$this->url = $url;
	}
	public function sendRequest($type, $data, $endpoint = "/", $headers = null) {

		$params = array('http' => array(
			'method' => $type,
			'ignore_errors' => true
		));
		$url = $this->url . $endpoint;

		if($type == "POST") {
			if(is_string($data)) {
				$params["http"]['header'] = "Content-type: text/plain;utf-8\r\n"
				. "Content-Length: " . strlen($data) . "\r\n";
				$params["http"]["content"] = $data;
			} else {
				$params["http"]['header'] = "Content-type: application/x-www-form-urlencoded;utf-8\r\n"
					. "Content-Length: " . strlen($data) . "\r\n";
				$params["http"]["content"] = http_build_query($data);
			}
		} else {
			$url .= "?" . http_build_query($data);
		}
		
		if($headers != null) $params["http"]["header"] = $headers;
		$ctx = stream_context_create($params);
		$fp = @fopen($url, "rb", false, $ctx);
		if(!$fp) throw new \Exception("Problem with $url, $php_errormsg");
		$response = @stream_get_contents($fp);
		if($response == FALSE) throw new \Exception("Problem reading data from $url, $php_errormsg");
		fclose($fp);
		return $response;
	}
} 