<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 16/05/20
 * Time: 05:43 ص
 */

namespace App\Services;


use App\Reservation;
use App\Seat;
use App\Trip;
use Illuminate\Support\Facades\DB;

class ReservationService
{
    /**
     * @var Reservation
     */
    private $reservation;

    /**
     * @var Seat
     */
    private $seat;

    /**
     * @var Trip
     */
    private $trip;

    public function __construct(Reservation $reservation, Seat $seat, Trip $trip)
    {
        $this->reservation = $reservation;
        $this->seat = $seat;
        $this->trip = $trip;
    }

    /**
     * @param array $reservation
     * @return Reservation
     */
    public function create(array $reservation)
    {
        try {
            DB::beginTransaction();

            $seat = $this->seat::lockForUpdate()->find($reservation['seat_id']);
            $trip = $this->trip->find($reservation['trip_id']);

            if (!$this->available($seat, $trip)) {
                abort(404, 'Seat Not Available');
            }

            sleep(5);
            $this->reservation->seat()->associate($seat);
            $this->reservation->trip()->associate($trip);
            $this->reservation->user()->associate(auth()->user());

            $this->reservation->save();

            DB::commit();

            return $this->reservation;
        } catch (\Exception $e) {
            DB::rollBack();

            return $e;
        }
    }

    /**
     * @param Seat $seat
     * @param Trip $trip
     * @return bool
     */
    public function available(Seat $seat, Trip $trip)
    {
        if ($this->exists($seat, $trip)) {
            return false;
        }

        if (!$this->tripHasSeat($seat, $trip)) {
            return false;
        }

        return true;
    }

    /**
     * @param Seat $seat
     * @param Trip $trip
     * @return mixed
     */
    public function tripHasSeat(Seat $seat, Trip $trip)
    {
        return $trip->seats->contains($seat);
    }

    /**
     * @param Seat $seat
     * @param Trip $trip
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function exists(Seat $seat, Trip $trip)
    {
        return Reservation::with(['seat', 'trip'])
            ->where('seat_id', $seat->id)
            ->where('trip_id', $trip->id)
            ->get()
            ->first();
    }
}