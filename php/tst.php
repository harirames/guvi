<?php
require '../vendor/autoload.php';
$client=new MongoDB\Client();
$collection = $client->guvi->user_details;

$result = $collection->insertOne( [ 'name' => 'hari', 'age' => '25' ] );

echo "Inserted with Object ID '{$result->getInsertedId()}'";
?>