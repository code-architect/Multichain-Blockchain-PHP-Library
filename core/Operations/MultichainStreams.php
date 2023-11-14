<?php

namespace CodeArchitect\Framework\Operations;

class MultichainStreams extends BaseClass
{
    /**
     * List of all the existing streams
     * @return mixed
     */
    public function getListOfStreams()
    {
        return $this->mc->liststreams();
    }


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


    public function unSubscribeToStream(string $streamName, bool $plugOff)
    {
        $this->mc->unsubscribe('stream1', true);
    }


    /**
     * Subscribe to keys and items (requires Enterprise)
     * @param string $streamName
     * @param string $keys
     * @return void
     */
    public function partialSubscription(string $streamName, string $keys)
    {
        $this->mc->subscribe('stream1', true, 'items,keys');
    }


    public function publishInStream(string $key, array|string $data, string $streamName)
    {
        // check for permissions

        // convert the data into json
        $jsonData = json_encode($data);

        // publish and return response
        $result = $this->mc->publish($streamName, $key, $jsonData);
        if (isset($result['error'])) {
            $data = ["status" => "error", "code" => 500, "data" => ["data" => $result['error']['message']]];
            return $this->helper->makeJsonErrorResponse($data);
        } else {
            $data = ["status" => "success", "code" => 201, "data" => ["data" => "Published data to the stream successfully!!"]];
            return $this->helper->makeJsonSuccessResponse($data);
        }
    }


}