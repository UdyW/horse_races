<?php

namespace Tests\Feature\DataPump;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DataTransferServiceTest extends TestCase
{
    protected function setUp(): void
    {
        $this->dataTransferService = new \App\DataPump\DataTransferService(
            'xml',
            'horse_racing',
            base_path('tests/Unit/DataPump/DataLinkObjects/test.xml')
        );
        parent::setUp();
    }

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testStoreDataFunction()
    {
       $this->dataTransferService->storeData();
        $meeting = \App\Models\Meeting::where('meeting_id', 129250)->first();
        $this->assertEquals('App\Models\Meeting', get_class($meeting));
    }
}
