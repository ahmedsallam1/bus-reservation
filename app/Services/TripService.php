<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 15/05/20
 * Time: 04:59 م
 */

namespace App\Services;


use App\Repository\TripRepositoryInterface;

class TripService
{
    private $repository;

    /**
     * TripService constructor.
     * @param TripRepositoryInterface $repository
     */
    public function __construct(TripRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param array $criteria
     * @return mixed
     */
    public function getSeats(array $criteria)
    {
        return $this->repository->getSeats($this->prepareCriteria($criteria));
    }

    /**
     * @param array $criteria
     * @return array
     */
    private function prepareCriteria(array $criteria)
    {
        if (isset($criteria['origin'], $criteria['destination'])) {
            $criteria['line'] = [
                'origin' => $criteria['origin'],
                'destination' => $criteria['destination'],
            ];

            unset($criteria['origin'], $criteria['destination']);
        }

        return $criteria;
    }
}