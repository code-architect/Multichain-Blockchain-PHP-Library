<?php

require 'vendor/autoload.php';
require 'Config.php';

$config = new Config();
$mc = $config->instance();


$config = new Config();
$mc = $config->instance();


// Multichain Basic commands
$multiBasic = new \CodeArchitect\Framework\Operations\MultichainBasic(mc: $mc);
// Multichain Streams
$multiStream = new \CodeArchitect\Framework\Operations\MultichainStreams(mc: $mc);
header('Content-Type: application/json');

// check if the connection is active or not
//print_r($multiBasic->isActive());

// List of all the streams
//print_r($multiStream->getListOfStreams());
// create a new stream
dd($multiBasic->getsSecificAddresses(["18jqy14p8VLa9Zhouq3ZFUdSRjzam5cxXcphrZ", "1FJLQU46LYz4Lg1nyPciXJE4VCwRT7mDYX1yFY"]));



