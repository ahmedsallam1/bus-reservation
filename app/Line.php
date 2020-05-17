<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Line extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function trips()
    {
        return $this->belongsToMany(Bus::class, 'trips', 'line_id', 'bus_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function origin()
    {
        return $this->belongsTo(Station::class, 'origin_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function destination()
    {
        return $this->belongsTo(Station::class, 'origin_id', 'id');
    }
}
