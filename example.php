<?php
/**
 * Copyright (c) 2014, VOOV LLC.
 * All rights reserved.
 * Written by Daniel Fekete
 */
define("PRIVATE_KEY", "YOUR_PRIVATE_KEY");
define("PUBLIC_KEY", "YOUR_PUBLIC_KEY");

require_once "lib/Billingo.php";
use Billingo\Billingo;

$product = array(
	'clients_id' => null,
	'fulfillment_date' => '2014-02-06',
	'due_date' => '2014-02-14',
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

$b = new Billingo();
$newClient = $b->addClient(array(
			  "name" => "Teszt " . rand(10, 99),
			  "address_street" => "Valahol utca 300",
			  "address_city" => "Sopron",
			  "address_postcode" => "9400",
			  "address_country" => "Magyarország",
			  "email" => "teszt@teszt2000kft.hu",
			  "taxcode" => "12345678-2-00"
		  ));
if($newClient->success == true) {
	$product["clients_id"] = $newClient->clients_id;
	$invoice = $b->addInvoice($product);
}
