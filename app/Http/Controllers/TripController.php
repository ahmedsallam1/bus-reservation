<?php

namespace App\Http\Controllers;

use App\Http\Resources\TripResource;
use App\Services\TripService;
use Illuminate\Http\Request;

class TripController extends Controller
{
    /**
     * @param Request $request
     * @param TripService $service
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function seats(Request $request, TripService $service)
    {
        $seats = $service->getSeats($request->all());

        return TripResource::collection($seats);
    }
}
