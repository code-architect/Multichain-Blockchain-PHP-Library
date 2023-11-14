<?php

namespace CodeArchitect\Framework\Operations;

class MultichainPermissionsManagement extends BaseClass
{
    /**
     * Grant a string of permissions to an address
     * @param string $address The wallet address
     * @param string $permissionString Example like 'send,receive'
     * @return false|string
     */
    public function grantGlobalPermission(string $address,string $permissionString): bool|string
    {
        $result = $this->mc->grant($address, 'send,receive');
        if ($result) {
            $data = ["status" => "success", "code" => 200, "data" => ["data" => $result]];
            return $this->helper->makeJsonSuccessResponse($data);
        } else {
            $data = ["status" => "error", "code" => 422, "data" => ["data" => "Failed to grant permissions"]];
            return $this->helper->makeJsonErrorResponse($data);
        }
    }


    /**
     * Grant a single string of permission to an address
     * @param string $address The wallet address
     * @param string $permissionString Example string 'stream1.write'
     * @return false|string
     */
    public function perEntityPermission(string $address,string $permissionString): bool|string
    {
        $result = $this->mc->grant($address, $permissionString);
        if ($result) {
            $data = ["status" => "success", "code" => 200, "data" => ["data" => $result]];
            return $this->helper->makeJsonSuccessResponse($data);
        } else {
            $data = ["status" => "error", "code" => 422, "data" => ["data" => "Failed to grant permissions"]];
            return $this->helper->makeJsonErrorResponse($data);
        }
    }


    /**
     * Grant permission to multiple address
     * @param array $address ["address1", "address2]
     * @param string $permissionString Example string 'connect'
     * @return bool|string
     */
    public function multipleAddressesPermission(array $address,string $permissionString): bool|string
    {
        $arrayToString = implode(',', $address);
        $result = $this->mc->grant($arrayToString, $permissionString);
        if ($result) {
            $data = ["status" => "success", "code" => 200, "data" => ["data" => $result]];
            return $this->helper->makeJsonSuccessResponse($data);
        } else {
            $data = ["status" => "error", "code" => 422, "data" => ["data" => "Failed to grant permissions"]];
            return $this->helper->makeJsonErrorResponse($data);
        }
    }


    /**
     * Get the list of all addresses with permission
     * @return bool|string
     */
    public function getListOfAllPermissions(): bool|string
    {
        $result = $this->mc->listpermissions();
        if ($result) {
            $data = ["status" => "success", "code" => 200, "data" => ["data" => $result]];
            return $this->helper->makeJsonSuccessResponse($data);
        } else {
            $data = ["status" => "error", "code" => 404, "data" => ["data" => "Failed to get list permissions"]];
            return $this->helper->makeJsonErrorResponse($data);
        }
    }


    /**
     * Get list of addresses with the given permission list
     * @param string $permissions Example: comma seperated permission list like, 'send,receive'
     * @return bool|string
     */
    public function getListOfSpecificPermissions(string $permissions): bool|string
    {
        $result = $this->mc->listpermissions($permissions);
        if ($result) {
            $data = ["status" => "success", "code" => 200, "data" => ["data" => $result]];
            return $this->helper->makeJsonSuccessResponse($data);
        } else {
            $data = ["status" => "error", "code" => 404, "data" => ["data" => "Failed to get list permissions"]];
            return $this->helper->makeJsonErrorResponse($data);
        }
    }


    /**
     * Get list of specific address permission
     * @param string|array $address Example either pass array of addresses or string
     * @return bool|string
     */
    public function getListOfSpecificAddressPermissions(string|array $address): bool|string
    {
        $result = $this->mc->listpermissions('*', $address);

        if ($result) {
            $data = ["status" => "success", "code" => 200, "data" => ["data" => $result]];
            return $this->helper->makeJsonSuccessResponse($data);
        } else {
            $data = ["status" => "error", "code" => 404, "data" => ["data" => "Failed to get address permission list"]];
            return $this->helper->makeJsonErrorResponse($data);
        }
    }


    /**
     * Revoke permissions from an addresss
     * @param string $address The wallet address
     * @param string $permission Example: pass a single permission e.g, 'connect', or a string of permissions e.g.: 'send,receive'
     * @return bool|string
     */
    public function revokeAddressPermissions(string $address, string $permission): bool|string
    {
        $result = $this->mc->revoke($address, $permission);
        if ($result) {
            $data = ["status" => "success", "code" => 200, "data" => ["data" => $result]];
            return $this->helper->makeJsonSuccessResponse($data);
        } else {
            $data = ["status" => "error", "code" => 404, "data" => ["data" => "Failed to revoke permission or permission was not granted to begin with"]];
            return $this->helper->makeJsonErrorResponse($data);
        }
    }


    /**
     * Check if the permission was given
     * @param string $address Wallet address
     * @param string $permission Example: Pass a permission string e.g: 'send'
     * @return bool|string
     */
    public function verifyPermission(string $address, string $permission): bool|string
    {
        $result = $this->mc->verifypermission($address, $permission);
        if ($result) {
            $data = ["status" => "success", "code" => 200, "data" => ["data" => $result]];
            return $this->helper->makeJsonSuccessResponse($data);
        } else {
            $data = ["status" => "error", "code" => 404, "data" => ["data" => "Not allowed or permission was not granted to begin with"]];
            return $this->helper->makeJsonErrorResponse($data);
        }
    }

}
