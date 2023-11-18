<?php

namespace CodeArchitect\Framework\Operations;

class MultichainStreams extends BaseClass
{
    /**
     * List of all the existing streams
     * @return mixed
     */
    public function getListOfStreams(): mixed
    {
        return $this->mc->liststreams();
    }


    /**
     * Subscribe to a stream
     * @param string $streamName
     * @return bool|string
     */
    public function subscribeToStream(string $streamName): bool|string
    {
        $this->mc->subscribe($streamName);
        if($this->mc->success())
        {
            $data = ["status" => "success", "code" => 201, "data" => ["data" => "Subscribed to Stream"]];
            return $this->helper->makeJsonSuccessResponse($data);
        }else{
            $data = ["status" => "error", "code" => 404, "data" => ["data" => "Cannot subscribe to Stream"]];
            return $this->helper->makeJsonErrorResponse($data);
        }
    }


    /**
     * Unsubscribe to a stream
     * @param string $streamName
     * @param bool $plugOff
     * @return void
     */
    public function unSubscribeToStream(string $streamName, bool $plugOff=false): void
    {
        $this->mc->unsubscribe($streamName, $plugOff);
    }


    /**
     * Subscribe to keys and items (requires Enterprise)
     * @param string $streamName
     * @param string $keys
     * @return void
     */
    public function partialSubscription(string $streamName, string $keys): void
    {
        $this->mc->subscribe('stream1', true, 'items,keys');
    }


    /**
     * Publish into the stream
     * @param string $streamName
     * @param string|array $key Example:can give and array of keys or a single key e.g: ['key1', 'key2'], "key1"
     * @param array|string $streamData Example: can be text data or json or raw binary or data from binary cache etc. e.g: 'aeg24gqg3d4', ['text' => 'hello world'], ['json' => ['name' => 'John Wick', 'age' => 45]], ['cache' => 'Ev1HQV1aUCY']
     * @return bool|string
     */
    public function publishInStream(string $streamName, string|array $key, array|string $streamData): bool|string
    {
        // publish and return response
        $result = $this->mc->publish($streamName, $key, $streamData);
        if (empty($result)) {
            $data = ["status" => "error", "code" => 422, "data" => ["data" => $result['error']['message']]];
            return $this->helper->makeJsonErrorResponse($data);
        } else {
            $data = ["status" => "success", "code" => 201, "data" => ["data" => "Published data to the stream successfully!!"]];
            return $this->helper->makeJsonSuccessResponse($data);
        }
    }


    /**
     * Publish into Multiple off chain/steam (requires Enterprise)
     * @param string $streamName Stream name
     * @param array|string $streamData Example: [['key' => 'key1', 'data' => ['json' => ['name' => 'John', 'age' => 30]]], ['keys' => ['key2', 'key3'], 'data' => ['json' => ['name' => 'Iogan', 'age' => 20]]]]
     * @return bool|string
     */
    public function multiPublishingOffChain(string $streamName, array|string $streamData): bool|string
    {
        $result = $this->mc->publishmulti($streamName, $streamData);
        if (empty($result)) {
            $data = ["status" => "error", "code" => 422, "data" => ["data" => $result['error']['message']]];
            return $this->helper->makeJsonErrorResponse($data);
        } else {
            $data = ["status" => "success", "code" => 201, "data" => ["data" => "Published data to the stream successfully!!"]];
            return $this->helper->makeJsonSuccessResponse($data);
        }
    }



    /*  Querying subscribed streams  */

    /**
     * Return most recent items
     * @param string $streamName
     * @param bool $status
     * @param int $num
     * @param int $base
     * @return bool|string
     */
    public function listAllStreamItems(string $streamName, bool $status=false, int $num=10, int $base=0): bool|string
    {
        $result = $this->mc->liststreamitems($streamName, $status, $num, $base);
        if (empty($result)) {
            $data = ["status" => "error", "code" => 404, "data" => ["data" => "No Data Available"]];
            return $this->helper->makeJsonErrorResponse($data);
        } else {
            $data = ["status" => "success", "code" => 201, "data" => ["data" => $result]];
            return $this->helper->makeJsonSuccessResponse($data);
        }
    }


    /**
     * Find items based on key items, paging through items
     * @param string $streamName
     * @param string $key
     * @param bool $status
     * @param int $num
     * @param int $base
     * @return bool|string
     */
    public function listStreamItemsBasedOnItems(string $streamName, string $key, bool $status=false, int $num=10, int $base=0): bool|string
    {
        $result = $this->mc->liststreamkeyitems($streamName, $key, $status, $num, $base);
        if (empty($result)) {
            $data = ["status" => "error", "code" => 404, "data" => ["data" => "No Data Available"]];
            return $this->helper->makeJsonErrorResponse($data);
        } else {
            $data = ["status" => "success", "code" => 201, "data" => ["data" => $result]];
            return $this->helper->makeJsonSuccessResponse($data);
        }
    }


    /**
     * @param string $streamName
     * @param string $address
     * @param bool $status
     * @param int $num
     * @param int $base
     * @return bool|string
     */
    public function listStreamItemsBasedOnPublisher(string $streamName, string $address, bool $status=false, int $num=10, int $base=0): bool|string
    {
        $result = $this->mc->liststreampublisheritems($streamName, $address, $status, $num, $base);
        if (empty($result)) {
            $data = ["status" => "error", "code" => 404, "data" => ["data" => "No Data Available"]];
            return $this->helper->makeJsonErrorResponse($data);
        } else {
            $data = ["status" => "success", "code" => 201, "data" => ["data" => $result]];
            return $this->helper->makeJsonSuccessResponse($data);
        }
    }


}