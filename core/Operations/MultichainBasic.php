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
    public function isActive()
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

}