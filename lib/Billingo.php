<?php
namespace Billingo;
/**
 Copyright (c) 2014, VOOV LLC.
 All rights reserved.
 Written by Daniel Fekete
*/
require_once "Client.php";
require_once "Signer.php";

class Billingo extends \R7\Client {
	//protected  $url = "http://api.getbillingo.com";
	public function __construct() {
		parent::__construct("http://api.getbillingo.com");
	}
	public function addInvoice($invoiceData) {
		\R7\Signer::createSignedAttributeSet($invoiceData, PRIVATE_KEY);
		$enc = json_encode($invoiceData);
		$response = $this->sendRequest("POST", $enc, "/invoices");
		return json_decode($response);
	}
	
	public function listInvoices() {
		$query = array();
		\R7\Signer::createSignedAttributeSet($query, PRIVATE_KEY);
		$response = $this->sendRequest("GET", $query, "/invoices");
		return json_decode($response);
	}
	
	public function listInvoiceItems($invoiceId) {
		$query = array();
		\R7\Signer::createSignedAttributeSet($query, PRIVATE_KEY);
		$response = $this->sendRequest("GET", $query, "/invoices/{$invoiceId}/items");
		return json_decode($response);
	}

	public function getClients() {
		$query = array();
		\R7\Signer::createSignedAttributeSet($query, PRIVATE_KEY);
		$response = $this->sendRequest("GET", $query, "/clients");
		return json_decode($response);
	}

	public function getBankAccounts() {
		$query = array();
		\R7\Signer::createSignedAttributeSet($query, PRIVATE_KEY);
		$response = $this->sendRequest("GET", $query, "/bank_accounts");
		return json_decode($response);
	}

	public function addClient($clientData) {
		\R7\Signer::createSignedAttributeSet($clientData, PRIVATE_KEY);
		$enc = json_encode($clientData);
		$response = $this->sendRequest("POST", $enc, "/clients");
		return json_decode($response);
	}
} 