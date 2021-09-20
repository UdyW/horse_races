<?php

namespace Tests\Feature\DataPump;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DataTransferServiceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStoreDataFunction()
    {
        $dataTransferService = new \App\DataPump\DataTransferService(
            'xml',
            base_path('tests/Unit/DataPump/DataLinkObjects/test.xml')
        );
        $contentArray = $dataTransferService->getResponse();

        $index = config('schemaMap.horse_racing.Meeting')["meeting_id"][0];
        $this->assertTrue(true);

    }
}
