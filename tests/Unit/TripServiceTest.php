<?php

namespace Tests\Unit;

use App\Repository\TripRepositoryInterface;
use App\Services\TripService;
use App\Trip;
use PHPUnit\Framework\TestCase;

class TripServiceTest extends TestCase
{
    /**
     * @var
     */
    private $service;

    public function setUp(): void
    {
        parent::setUp();

        $mock = \Mockery::mock(TripRepositoryInterface::class);

        $mock->shouldReceive('getSeats')
            ->andReturn(new Trip())
            ->mock();

        $this->service = new TripService($mock);
    }

    /**
     * @return void
     */
    public function testGetSeats()
    {
        $this->assertInstanceOf(Trip::class, $this->service->getSeats([
            'origin' => 1,
            'destination' => 1
        ]));
    }
}
