<?php

namespace App\DataPump;

class DataMapper
{
    use DataValidator;

    protected $schemaMapName;

    protected $sourceArray;

    public function __construct(string $schemaMapName, $sourceArray)
    {
        $this->schemaMapName    = $schemaMapName;
        $this->sourceArray      = $sourceArray;
    }

    public function getEntitysForSchema(array $schemaMap)
    {
        return array_keys($schemaMap[$this->schemaMapName]);
    }

    public function getValueFromMapPath(array $path)
    {
        $aux = $this->sourceArray;
        foreach ($path[1] as $pathIndex) {
            if (!array_key_exists($pathIndex, $aux)) {
                throw new \Exception("Index path not valid", 1);
            }

            if (gettype($aux[$pathIndex]) === 'string') {
                return $this->sanatizeData($path[0] ,$aux[$pathIndex]);
            }
            $aux = $aux[$pathIndex];
        }
    }

    protected $container = [];
    public function interateThroughSourceArray(array $schemaMap, array $sourceArray )
    {
        $this->recursive($schemaMap, $sourceArray);
        return $this->container;
    }

    function recursive(array $schemaMap, array $sourceArray){

        $entityList = $this->getEntitysForSchema($schemaMap);

        foreach($sourceArray as $key => $value){
            if(in_array($key, $entityList)) {
                $model = $this->createModelFromMapArray("\App\Models\\".$key, $this->findMappingForEntity($key));
                $model->save();
                array_push($this->container, $model);
            }

            if(is_array($value)){
                $this->recursive($schemaMap, $value);
            }
        }
    }
    public function findMappingForEntity(string $entity)
    {
        return config('schemaMap.'.$this->schemaMapName.'.'.$entity);
    }

    public function createModelFromMapArray(string $model, array $mapArray)
    {
        $entity = new $model();
        foreach($mapArray as $prop=>$path) {
            $entity->$prop = $this->getValueFromMapPath($path, $this->sourceArray);
        }

        return $entity;
    }
}
