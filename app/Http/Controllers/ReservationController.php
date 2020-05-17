<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReservationCreateRequest;
use App\Http\Resources\ReservationSource;
use App\Services\ReservationService;

class ReservationController extends Controller
{
    /**
     * @param ReservationCreateRequest $request
     * @param ReservationService $reservationService
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(ReservationCreateRequest $request, ReservationService $reservationService)
    {
        $reservation = $reservationService->create($request->all());

        if ($reservation instanceof \Exception) {
            return response()->json(
                ['error' => $reservation->getMessage()],
                $reservation->getStatusCode()
            );
        };

        return response()->json([
            'message' => 'Reservation Created Successfully',
            'data' => new ReservationSource($reservation),
        ]);
    }
}
