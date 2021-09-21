<?php

namespace App\DataPump;

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

    public function getEntitysForSchema(array $schemaMap)
    {
        return array_keys($schemaMap[$this->schemaMapName]);
    }

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

    public function interateThroughSourceArray(array $schemaMap, array $sourceArray)
    {
        $this->recursive($schemaMap, $sourceArray);
        return $this->container;
    }

    protected function recursive(array $schemaMap, array $sourceArray)
    {
        $entityList = $this->getEntitysForSchema($schemaMap);

        foreach ($sourceArray as $key => $value) {
            if (is_string($key) && in_array($key, $entityList)) {
                $models = $this->createModelFromMapArray($key, $value);
                if(count($models) > 1) {
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
    public function findMappingForEntity(string $entity)
    {
        return config('schemaMap.' . $this->schemaMapName . '.' . $entity);
    }

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
