<?php

namespace App\Datapump;

use App\DataPump\DataLinkFactory;

class DataTransferService
{
    private $dataLinkType;

    public function __construct(string $dataLinkType, string $dataSourcePath)
    {
        $this->dataLinkType = $dataLinkType;
        $this->dataSourcePath = $dataSourcePath;
    }

    public function getDataLinkObject()
    {
        $dataLinkFactory = new DataLinkFactory();

        return $dataLinkFactory->create($this->dataLinkType);
    }

    public function getResponse()
    {
        return $this->getDataLinkObject()->import($this->dataSourcePath);
    }

    public function storeData(array $source)
    {
        true;
    }
}
