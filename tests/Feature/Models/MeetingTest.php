<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MeetingTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * test to assert if Meeting->Race has a valid relationship
     *
     * @return void
     */
    public function testMeetingHasManyValidRaces(): void
    {

        $meeting = \App\Models\Meeting::factory()
                    ->has(\App\Models\Race::factory()->count(3))
                    ->create();


        $this->assertCount(3, $meeting->fresh()->race);
        $this->assertInstanceOf(\App\Models\Race::class, $meeting->race->first());
    }
}
