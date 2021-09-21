<?php

namespace App\DataPump;

use App\DataPump\DataLinkObjects\XMLDataLink;

class DataLinkFactory
{
    /**
     * function to generate an instance of a concrete Data Link implementation
     * @param dataLinkType string type of the object required
     */
    public function create(string $dataLinkType)
    {
        switch ($dataLinkType) {
            case 'xml':
                return new XMLDataLink();
                break;

            case 'api':
                return new APIDataLink();

            default:
                throw new \InvalidArgumentException("Invalid DataLink type", 1);
                break;
        }
    }
}
