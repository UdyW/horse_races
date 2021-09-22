<?php

namespace App\DataPump;

/**
 * Maps a source array from a given data source and match
 * to Eloquent models using mappings defined in config.schemaMap
 * @param string $schemaMapName name of the data schema from config.schemaMap
 * @param array $sourceArray array of un resolved data from a given source (DataLinkObject)
 * @param array $container array of validated Eloquent objects
 */
class DataMapper
{
    use DataValidator;

    protected $schemaMapName;

    protected $sourceArray;

    protected $container = [];

    public function __construct(string $schemaMapName, $sourceArray)
    {
        $this->schemaMapName    = $schemaMapName;
        $this->sourceArray      = $sourceArray;
    }

    /**
     * Get a list of Eloquent entities form the schemaMap
     * @param array $schemaMap array of schema definition
     * @return array Eloquent entities
     */
    public function getEntitysForSchema(array $schemaMap): array
    {
        return array_keys($schemaMap[$this->schemaMapName]);
    }

    /**
     * Get sanitized value of a specific path from a data set
     * @param array $path path to the value
     * @param array $dataSet dataset to read the $path
     * @return mixed value of the $path
     */
    public function getValueFromMapPath(array $path, array $dataSet)
    {
        $aux = $dataSet;
        foreach ($path[1] as $pathIndex) {
            if (!array_key_exists($pathIndex, $aux)) {
                throw new \Exception("Index path not valid", 1);
            }

            if (gettype($aux[$pathIndex]) === 'string') {
                return $this->sanatizeData($path[0], $aux[$pathIndex]);
            }
            $aux = $aux[$pathIndex];
        }
    }

    /**
     * Walk through a source array and convert values to defined Eloquent entities
     * @param array $schemaMap map defines the schema paths to props
     * @param array $sourceArray array of data
     */
    public function interateThroughSourceArray(array $schemaMap, array $sourceArray)
    {
        $this->recursive($schemaMap, $sourceArray);
        return $this->container;
    }

    /**
     * Helper function to read all the items in an array
     */
    protected function recursive(array $schemaMap, array $sourceArray)
    {
        $entityList = $this->getEntitysForSchema($schemaMap);

        foreach ($sourceArray as $key => $value) {
            if (is_string($key) && in_array($key, $entityList)) {
                $models = $this->createModelFromMapArray($key, $value);
                if (count($models) > 1) {
                    $this->container = array_merge($this->container, $models);
                } else {
                    array_push($this->container, $models[0]);
                }
            }

            if (is_array($value)) {
                $this->recursive($schemaMap, $value);
            }
        }
    }

    /**
     * Get all the mappings for a given entity
     */
    public function findMappingForEntity(string $entity)
    {
        return config('schemaMap.' . $this->schemaMapName . '.' . $entity);
    }

    /**
     * Create given eloquent model from an array of values
     * @param string $model name of the Eloquent model
     * @param array $dataSet contains data for the $model
     */
    public function createModelFromMapArray(string $model, array $dataSet): array
    {
        $modelClassName = "\App\Models\\" . $model;
        $entityList = array();

        $mapping = $this->findMappingForEntity($model);

        if (array_key_exists('@attributes', $dataSet)) {
            $entity = new $modelClassName();
            foreach ($mapping as $mapkey => $mapPath) {
                $entity->$mapkey = $this->getValueFromMapPath($mapPath, $dataSet);
            }
            array_push($entityList, $entity);
        } else {
            foreach ($dataSet as $singleSet) {
                $entity = new $modelClassName();
                foreach ($mapping as $mapkey => $mapPath) {
                    $entity->$mapkey = $this->getValueFromMapPath($mapPath, $singleSet);
                }
                array_push($entityList, $entity);
            }
        }
        return $entityList;
    }
}
