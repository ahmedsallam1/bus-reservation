<?php

namespace Tests\Feature;

use App\Line;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TripControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * @return void
     */
    public function testSeats()
    {
        $line = Line::all()->first();

        $response = $this->json('Get', '/api/trip/seats', [
            'origin' => $line->origin->id,
            'destination' => $line->destination->id,
            'available' => 1,
        ]);

        $response->assertStatus(200);
    }
}
