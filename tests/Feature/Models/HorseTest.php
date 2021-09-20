<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class HorseTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * test to assert if Horse->Jockey has a valid relationship
     *
     * @return void
     */
    public function testHorseHasAValidJockey(): void
    {
        $jockey = \App\Models\Jockey::factory()->create();

        $horse = \App\Models\Horse::factory()->create(['jockey_id' => $jockey->id]);

        $this->assertInstanceOf(\App\Models\Jockey::class, $horse->jockey);

        $this->assertEquals(1, $horse->jockey->count());
    }

    /**
     * test to assert if Horse->Trainer has a valid relationship
     *
     * @return void
     */
    public function testHorseHasAValidTrainer(): void
    {

        $trainer = \App\Models\Trainer::factory()->create();
        $horse = \App\Models\Horse::factory()->create(['trainer_id' => $trainer->id]);

        $this->assertInstanceOf(\App\Models\Trainer::class, $horse->trainer);

        $this->assertEquals(1, $horse->trainer->count());
    }
}
