<?php

namespace Tests\Unit;

use Tests\TestCase;

class XMLDataLinkTest extends TestCase
{
    /**
     * test to assert import function returns a valid array
     *
     * @return void
     */
    public function testImportFunctionReturnsValidArray()
    {
        $xmlDataLink = new \App\DataPump\DataLinkObjects\XMLDataLink();
        $contentArray = $xmlDataLink->import(base_path('tests/Unit/DataPump/DataLinkObjects/test.xml'));
        $this->assertIsArray($contentArray);
        $this->assertArrayHasKey('Meeting', $contentArray);
    }

    /**
     * test to assert import function throws a exception for
     * invalid file paths
     *
     * @return void
     */
    public function testImportFunctionThrowsException()
    {
        $xmlDataLink = new \App\DataPump\DataLinkObjects\XMLDataLink();

        $this->expectException(\Exception::class);

        $this->expectErrorMessage('Cannot read the file content');

        $contentArray = $xmlDataLink->import(base_path('tests/Unit/DataPump/DataLinkObjects/foo.xml'));
    }
}
