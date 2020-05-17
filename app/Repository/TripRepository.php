<?php
/**
 * Created by PhpStorm.
 * User: ahmed
 * Date: 15/05/20
 * Time: 05:06 م
 */

namespace App\Repository;


use App\Trip;
use Illuminate\Database\Eloquent\Builder;

class TripRepository implements TripRepositoryInterface
{
    /**
     * @var Trip
     */
    private $model;

    /**
     * TripRepository constructor.
     * @param Trip $model
     */
    public function __construct(Trip $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $criteria
     * @return Trip[]|Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getSeats(array $criteria)
    {
        $builder = $this->model->newModelQuery();


        foreach ($criteria as $key => $value) {
            $method = 'scope'.$key;
            if (method_exists($this, $method)) {
                $builder = $this->{$method}($builder, $value);
            }
        }

        return $builder->get();
    }

    /**
     * @param Builder $builder
     * @param array $line
     * @return Builder
     */
    public function scopeLine(Builder $builder, array $line)
    {
        $origin = $line['origin'];
        $destination = $line['destination'];

        $builder->whereHas('stops', function ($query) use ($origin, $destination) {
            $query->where('lines.origin_id', $origin);
            $query->where('lines.destination_id', $destination);
        });

        return $builder;
    }

    /**
     * @param Builder $builder
     * @param bool $available
     * @return Builder
     */
    public function scopeAvailable(Builder $builder, bool $available)
    {
        return $available ? $this->scopeUnreservedSeats($builder) : $this->scopeReservedSeats($builder);
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeReservedSeats(Builder $builder)
    {
        $builder->with(['seats' => function ($query) {
            $query->whereHas('reservations', function ($query) {
                $query->whereHas('trip', function ($query) {
                    $query->where('completed', false);
                });
            });
        }]);

        return $builder;
    }

    /**
     * @param Builder $builder
     * @return Builder
     */
    public function scopeUnreservedSeats(Builder $builder)
    {
        $builder->with(['seats' => function ($query) {
            $query->whereDoesntHave('reservations', function ($query) {
                $query->whereHas('trip', function ($query) {
                    $query->where('completed', false);
                });
            });
        }]);

        return $builder;
    }
}