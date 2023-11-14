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
// Multichain Permission
$multiPermission = new \CodeArchitect\Framework\Operations\MultichainPermissionsManagement(mc: $mc);
header('Content-Type: application/json');

// check if the connection is active or not
//print_r($multiBasic->isActive());

// List of all the streams
//print_r($multiStream->getListOfStreams());

//dd($multiPermission->getListOfSpecificAddressPermissions("17oExeajBCrYqP4v7gAjpspzk4eeun9dbTgiDV"));
//dd($multiPermission->grantGlobalPermission("1FJLQU46LYz4Lg1nyPciXJE4VCwRT7mDYX1yFY", 'send,receive'));
//dd($multiPermission->getListOfSpecificPermissions('send,receive'));
//dd($multiPermission->verifyPermission("1FJLQU46LYz4Lg1nyPciXJE4VCwRT7mDYX1yFY", 'send'));
//dd($multiStream->publishInStream("chainStream", "XCV12345",  ['text' => 'hello world']));
//dd($multiStream->multiPublishingOffChain("chainStream", [
//        ['key' => 'key1', 'data' => ['json' => ['name' => 'John', 'age' => 30]]],
//        ['keys' => ['key2', 'key3'], 'data' => ['json' => ['name' => 'Iogan', 'age' => 20]]]
//    ]
//));




