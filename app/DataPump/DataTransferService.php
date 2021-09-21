<?php

namespace App\Datapump;

use App\DataPump\DataLinkFactory;
use App\DataPump\DataMapper;

class DataTransferService
{
    private $dataLinkType;

    public function __construct(string $dataLinkType, string $schemaMapName, string $dataSourcePath)
    {
        $this->dataLinkType = $dataLinkType;
        $this->schemaMapName = $schemaMapName;
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

    protected function getSchemaMap()
    {
        return config('schemaMap');
    }

    public function storeData()
    {
        $dataMapper = new DataMapper($this->schemaMapName, $this->getResponse());
        $models = $dataMapper->interateThroughSourceArray($this->getSchemaMap(), $this->getResponse());

        foreach ($models as $model) {
            try {
                $model->save();
            } catch (\Exception $e){
                echo $e->getMessage();
            }
        }
    }
}
