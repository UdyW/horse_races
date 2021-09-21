<?php

/**
 * Unit tests for the DataTransferServiceTest
 */

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class DataTransferServiceTest extends TestCase
{
    /**
     * Test to assert if the factory returns a valid datalink object
     *
     * @return void
     */
    public function testGetDataLinkObjectReturnsCorrectDatalinkObject()
    {
        $dataTransferService = new \App\DataPump\DataTransferService(
            'xml',
            'horse_racing',
            base_path('tests/Unit/DataPump/DataLinkObjects/test.xml')
        );

        $this->assertEquals(
            'App\DataPump\DataLinkObjects\XMLDataLink',
            get_class($dataTransferService->getDataLinkObject())
        );
    }

    /**
     * Test to assert if the getResponse function returns a valid array
     *
     * @return void
     */
    public function testGetResponseReturnsValidResponseArray()
    {
        $dataTransferService = new \App\DataPump\DataTransferService(
            'xml',
            'horse_racing',
            base_path('tests/Unit/DataPump/DataLinkObjects/test.xml')
        );
        $contentArray = $dataTransferService->getResponse();
        //dd($contentArray["Meeting"]["Race"]["Going"]["@attributes"]["brief"]);
        $this->assertIsArray($contentArray);
    }
}
