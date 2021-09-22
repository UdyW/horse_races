<?php

namespace App\Datapump;

use App\DataPump\DataLinkFactory;
use App\DataPump\DataMapper;

/**
 * Main entry point of the Datapump
 * Responsible of storing storing data in db for given data link, schema and source patt
 */
class DataTransferService
{
    private $dataLinkType;

    public function __construct(string $dataLinkType, string $schemaMapName, string $dataSourcePath)
    {
        $this->dataLinkType = $dataLinkType;
        $this->schemaMapName = $schemaMapName;
        $this->dataSourcePath = $dataSourcePath;
    }

    /**
     * Get the correct data link object for a given type (xml, api)
     */
    public function getDataLinkObject()
    {
        $dataLinkFactory = new DataLinkFactory();

        return $dataLinkFactory->create($this->dataLinkType);
    }

    /**
     * Get responce array from the source
     */
    public function getResponse()
    {
        return $this->getDataLinkObject()->import($this->dataSourcePath);
    }

    /**
     * Get schema from config
     */
    protected function getSchemaMap()
    {
        return config('schemaMap');
    }

    /**
     * Store the data returned form the DataMapper in to the database
     */
    public function storeData()
    {
        $dataMapper = new DataMapper($this->schemaMapName, $this->getResponse());
        $models = $dataMapper->interateThroughSourceArray($this->getSchemaMap(), $this->getResponse());

        foreach ($models as $model) {
            try {
                $model->save();
            } catch (\Exception $e) {
                echo $e->getMessage();
            }
        }
    }
}
