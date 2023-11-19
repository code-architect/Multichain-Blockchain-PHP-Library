<?php

namespace CodeArchitect\Framework\Operations;

use http\Exception\InvalidArgumentException;

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



    /*------------------------------------------  Querying subscribed streams ----------------------------------------*/

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
        return $this->returnResult($result);
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
        return $this->returnResult($result);
    }


    /**
     * Show most recent publisher items
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
        return $this->returnResult($result);
    }


    /**
     * List latest stream data based on key or keys
     * @param string $streamName
     * @param string|array $keys Can be a single string like "key1" or an array like ["key1", "key2"]
     * @param bool $status True or False
     * @param int $num default is 10
     * @param int $base default is 0
     * @return bool|string
     */
    public function listStreamBasedOnKeys(string $streamName, string|array $keys='*', bool $status=false, int $num=10, int $base=0): bool|string
    {
        $result = $this->mc->liststreamkeys($streamName, $keys, $status, $num, $base);
        return $this->returnResult($result);
    }


    /**
     * List stream data based on addresses
     * @param string $streamName
     * @param string|array $addresses Can be a single string like "key1" or an array like ["key1", "key2"]
     * @param bool $status True or False
     * @param int $num default is 10
     * @param int $base default is 0
     * @return bool|string
     */
    public function listStreamBasedOnPublishers(string $streamName, string|array $addresses='*', bool $status=false, int $num=10, int $base=0): bool|string
    {
        $result = $this->mc->liststreampublishers($streamName, $addresses, $status, $num, $base);
        return $this->returnResult($result);
    }


    /**
     * Get blocks based on height, timestamp0
     * @param string $streamName
     * @param int|string|array $blocks can be string just one block, or block range i.e: 1 - 100, or most recent blocks -10, or blocks stamped in time range i.e: ['starttime' => 1577835600, 'endtime' => 160945299]
     * @return bool|string
     */
    public function listStreamBasedOnBlock(string $streamName, int|string|array $blocks=125): bool|string
    {
        $result = $this->mc->liststreamblockitems($streamName, $blocks);
        return $this->returnResult($result);
    }


    /**
     * Return Data based on key (was enterprise now public)
     * @param string $streamName
     * @param string $key
     * @param string $details
     * @return bool|string
     */
    public function getStreamKeyDetails(string $streamName, string $key, string $details): bool|string
    {
        $result = $this->mc->getstreamkeysummary($streamName, $key, $details);
        return $this->returnResult($result);
    }


    /**
     * Return Data based on key (was enterprise now public)
     * @param string $streamName
     * @param string $address
     * @param string $details
     * @return bool|string
     */
    public function getStreamPublisherDetails(string $streamName, string $address, string $details): bool|string
    {
        $result = $this->mc->getstreampublishersummary($streamName, $address, $details);
        return $this->returnResult($result);
    }


    /**
     * Returns Query items based on keys
     * @param string $streamName
     * @param string|array $key Can be items with both keys (AND logic): ['keys' => ['key1', 'key2']] or ['key' => 'key1', 'publisher' => $address] with key and publisher
     * @return bool|string
     */
    public function getStreamQueryItems(string $streamName, string|array $key): bool|string
    {
        $result = $this->mc->liststreamqueryitems($streamName, $key); // items with both keys (AND logic)
       //
        return $this->returnResult($result);
    }



    //------------------------------------------------ Private -------------------------------------------------------//
    private function returnResult($result, int $errorCode = 404, int $successCode = 201)
    {
        if (empty($result)) {
            $data = ["status" => "error", "code" => $errorCode, "data" => ["data" => "No Data Available"]];
            return $this->helper->makeJsonErrorResponse($data);
        } else {
            $data = ["status" => "success", "code" => $successCode, "data" => ["data" => $result]];
            return $this->helper->makeJsonSuccessResponse($data);
        }
    }


    private function checkRequiredParameter($requiredParameter): void
    {
        if ($requiredParameter === null) {
            // Throw an exception or handle the error as needed
            throw new InvalidArgumentException("Required parameter is missing.");
        }
    }


}