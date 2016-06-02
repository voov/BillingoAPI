<?php
/**
 * Copyright (c) 2014, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 */
define("PRIVATE_KEY", "483c09c3d7e3299db447e3ec48be5a626197c58d590280c59cdd020282a4a957112bb3d9e6e928f75232caa0eae8a531745a0ef2643d4eff3e7b7cb4fa463bab");
define("PUBLIC_KEY", "28729a55286ef14dc086224b8678261e");

require_once "lib/BillingoTest.php";
use Billingo\BillingoTest;

$product = array(
	'clients_id' => null,
	'fulfillment_date' => date('Y-m-d'),
	'due_date' => (new DateTime('now', new DateTimeZone('UTC')))->add(new DateInterval('P8D'))->format('Y-m-d'),
	'is_draft' => 0,
	'payment_method' => 1,
	'comment' => 'N/A',
	'currency' => 'HUF',
	'template' => 'billingo',
	'template_lang_code' => '',
	'electronic_invoice' => 0,
	'recurring_time' => 0,
	'items' =>
		array (
			0 =>
				array(
					'description' => 'Teszt termék 1',
					'net_unit_price' => 25.9,
					'qty' => 1,
					'unit' => 'db',
					'vat_id' => 1,
				),
			1 =>
				array(
					'description' => 'Teszt termék 2',
					'net_unit_price' => 10.99,
					'qty' => 1,
					'unit' => 'db',
					'vat_id' => 1,
				),
			2 =>
				array(
					'description' => 'Teszt termék 2',
					'net_unit_price' => 5,
					'qty' => 1,
					'unit' => 'db',
					'vat_id' => 1,
				),
			3 =>
				array(
					'description' => 'Teszt termék 1',
					'net_unit_price' => 3300,
					'qty' => 2,
					'unit' => 'db',
					'vat_id' => 1,
				),
		),
);

$b = new BillingoTest();
$newClient = $b->addClient(array(
			  "name" => "Teszt " . rand(10, 99),
			  "address_street" => "Valahol utca 300",
			  "address_city" => "Sopron",
			  "address_postcode" => "9400",
			  "address_country" => "Magyarország",
			  "email" => "xyz@voov.hu",
			  "taxcode" => "12345678-2-00"
		  ));
var_dump($newClient);
//var_dump($b->getClients());
if($newClient->success == true) {
	$product["clients_id"] = $newClient->clients_id;
	$invoice = $b->addInvoice($product);
    var_dump($invoice);
}
