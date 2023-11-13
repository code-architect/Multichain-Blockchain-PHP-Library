<?php

use CodeArchitect\Framework\Private\MultiChainClient;

require 'vendor/autoload.php';
class Config
{

    public function __construct()
    {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
        $dotenv->load();
        $dotenv->required(['RPC_HOST', 'RPC_PORT', 'RPC_USER', 'RPC_PASSWORD']);
    }

    public function instance(): MultiChainClient
    {
//        return new MultiChainClient( $this->RPC_host, $this->RPC_port, $this->RPC_user, $this->RPC_password);
        return new MultiChainClient( $_ENV['RPC_HOST'], $_ENV['RPC_PORT'], $_ENV['RPC_USER'], $_ENV['RPC_PASSWORD']);
    }

    public function getChainName()
    {
        return $_ENV["CHAIN_NAME"];
    }
}