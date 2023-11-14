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


// Multichain Basic commands
$multiBasic = new \CodeArchitect\Framework\Operations\MultichainBasic(mc: $mc);
header('Content-Type: application/json');

// check if the connection is active or not
print_r($multiBasic->isActive());



