<?php

namespace App\DataPump\DataLinkObjects;

/**
 * Concrete implelmentation of DataLinkInterface to get an array of data
 * from a xml file in a given location
 */
class XMLDataLink implements DataLinkInterface
{

    public function import($dataSourcePath)
    {
        return $this->readXML($dataSourcePath);
    }

    private function readXML(string $xmlPath)
    {
        $xmlString = '';

        if (($xmlString = @file_get_contents($xmlPath)) === false) {
            $error = error_get_last();
            throw new \Exception("Cannot read the file content", 1);
        } else {
            $xmlObject = simplexml_load_string($xmlString);
            return (json_decode(json_encode($xmlObject), true));
        }
    }
}
