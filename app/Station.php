<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Station extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function lines()
    {
        return $this->belongsToMany(Station::class, 'lines', 'origin_id', 'destination_id');
    }
}
