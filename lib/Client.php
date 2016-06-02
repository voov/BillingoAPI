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
    public function sendRequest($type, $data, $endpoint = "/", $headers = []) {

        $params = array('http' => array(
            'method' => $type,
            'ignore_errors' => true
        ));
        $url = $this->url . $endpoint;

        if($type == "POST") {

            if(is_string($data)) {
                $headers[] = 'Content-type: application/json;utf-8';
                $params["http"]["content"] = $data;
            } else {
                $headers[] = 'Content-type: application/x-www-form-urlencoded;utf-8';
                $params["http"]["content"] = http_build_query($data);
            }
            $headers[] = "Content-Length: " . strlen($data);
        } else {
            $url .= "?" . http_build_query($data);
        }

        if(!empty($headers)) $params["http"]["header"] = implode('\r\n', $headers) . '\r\n';

        $ctx = stream_context_create($params);
        $fp = @fopen($url, "rb", false, $ctx);

        if(!$fp) {
            $error = error_get_last();
            throw new \Exception("Problem with $url, {$error['message']}");
        }

        $response = @stream_get_contents($fp);

        if($response == FALSE) {
            $error = error_get_last();
            throw new \Exception("Problem reading data from $url, {$error['message']}");
        }

        fclose($fp);

        return $response;
    }
}
