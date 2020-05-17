<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TripStop extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function trip()
    {
        return $this->belongsTo(Trip::class, 'trip_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function line()
    {
        return $this->belongsTo(Line::class, 'line_id', 'id');
    }
}
