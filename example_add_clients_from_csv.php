<html>
<title>Billingo Online Invoicing API demo - Add clients from csv</title>
<meta name="author" content="webNpro - web development">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<body>
<?php
/**
 * Billingo Online Invoicing API demo - Add clients from csv
 * Written by Zoltan Korosi | webNpro - web development
 * 
 */
define("PRIVATE_KEY", "YOUR_PRIVATE_KEY");
define("PUBLIC_KEY", "YOUR_PUBLIC_KEY");

require_once "lib/Billingo.php";
require_once "lib/csvData.class.php";

use Billingo\Billingo;

// Get clients from the clients.csv file
echo "Get clients from the 'clients.csv' file<br/>";
$clients_csv = new csvData(dirname(__FILE__) . '/clients.csv',";"); 
$csv_clients = $clients_csv->get(); 

// Send clients to Billingo
echo "Send clients to Billingo<br/>";
$b = new Billingo();
foreach ($csv_clients as $client)
    {
        $newClient = $b->addClient($client);
        if($newClient->success == true) {
            // OK
            echo $newClient->clients_id." ".$client["name"]." [OK]<br/>";
        } else {
            // FAILED
            echo $client["name"]." [FAILED]<br/>";
        }
    }

// That's it. Enjoy :-)
echo "That's it. Enjoy! :-)"
?>
</body>
</html>