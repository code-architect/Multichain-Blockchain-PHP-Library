<?php

require 'vendor/autoload.php';
require 'Config.php';

$config = new Config();
$mc = $config->instance();


//$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
//$dotenv->load();
//$dotenv->required(['RPC_HOST', 'RPC_PORT', 'RPC_USER', 'RPC_PASSWORD']);
//
//$rpchost = $_ENV['RPC_HOST']; // change if multichaind is not running locally
//$rpcport = $_ENV['RPC_PORT'];; // usually default-rpc-port in blockchain parameters
//$rpcuser = $_ENV['RPC_USER'];; // see multichain.conf in blockchain directory
//$rpcpassword = $_ENV['RPC_PASSWORD'];; // see multichain.conf in blockchain directory
////$mc=new MultiChainClient($rpchost, $rpcport, $rpcuser, $rpcpassword);

$config = new Config();
$mc = $config->instance();

print_r($mc->getinfo());

header('Content-Type: application/json');

// Your data to be sent in the response
$data = [
    'message' => 'Hello, this is a simple REST API response!',
    'timestamp' => time(),
];

// Encode the data as JSON
$response = json_encode($data);

// Output the JSON response
echo $response;


