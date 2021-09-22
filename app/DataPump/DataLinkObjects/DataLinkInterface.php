<?php

namespace App\DataPump\DataLinkObjects;

/**
 * Interface to be implemented by all data links (xml, api)
 */
interface DataLinkInterface
{
    /**
     * Data links should have a function to read a file and return its data to as an array
     * @param string $dataSourcePath path of the
     * @return array data in key=>value format
     */
    public function import(string $dataSourcePath);
}
