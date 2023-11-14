<?php

namespace CodeArchitect\Framework\Operations;

use CodeArchitect\Framework\Helper\HelperClass;

class MultichainBasic extends BaseClass
{

    public function getinfo()
    {
        return $this->mc->getinfo();
    }

    /**
     * Check if the connection is active or not
     * @return false|string
     */
    public function isActive(): bool|string
    {
        $value = $this->getinfo();

        if (!empty($value["chainname"]))
        {
            $data = ["status" => "success", "code" => 200, "data" => ["chainName" => $value["chainname"]]];
            return $this->helper->makeJsonSuccessResponse($data);
        }else{
            $data = ["status" => "error", "code" => 404, "data" => ["error" => "Cannot find active chain name"]];
            return $this->helper->makeJsonErrorResponse($data);
        }
    }


    /**
     * Get current wallet address
     * @return false|string
     */
    public function getCurrentWalletAddress(): bool|string
    {
        // Get a list of addresses in the current wallet
        $addresses = $this->mc->getaddresses();

        // Extract the first address as the current wallet address
        $currentAddress = reset($addresses);

        // Display the current wallet address
        if ($currentAddress) {
            $data = ["status" => "success", "code" => 200, "data" => ["data" => "Current wallet address $currentAddress"]];
            return $this->helper->makeJsonSuccessResponse($data);
        } else {
            $data = ["status" => "error", "code" => 404, "data" => ["data" => "No addresses found in the wallet"]];
            return $this->helper->makeJsonErrorResponse($data);
        }
    }



}