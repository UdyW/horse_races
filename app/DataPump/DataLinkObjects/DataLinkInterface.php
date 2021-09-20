<?php

namespace App\DataPump\DataLinkObjects;

interface DataLinkInterface
{
    public function import(string $dataSourcePath);
}
