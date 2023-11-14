<?php

namespace CodeArchitect\Framework\Helper;

use stdClass;

class HelperClass
{


//    public function makeJsonResponse(array $fieldNames, array $data, bool $isJson = true)
//    {
//        $combinedArray = array_combine($fieldNames, $data);
//    }

    public function makeJsonSuccessResponse(array $dataArray)
    {
        $stdClassData = $this->arrayToStdClass($dataArray);
        return json_encode($stdClassData, JSON_PRETTY_PRINT);
    }

    public function makeJsonErrorResponse(array $dataArray)
    {
        $stdClassData = $this->arrayToStdClass($dataArray);
        return json_encode($stdClassData, JSON_PRETTY_PRINT);
    }

    private function arrayToStdClass($array): stdClass
    {
        $stdclass = new stdClass();

        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $stdclass->$key = $this->arrayToStdClass($value); // Recursively convert arrays
            } else {
                $stdclass->$key = $value;
            }
        }
        return $stdclass;
    }

}