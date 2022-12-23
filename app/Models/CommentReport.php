<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentReport extends Model
{
    use HasFactory;


    /**
     * Get the Offer that owns the CommentReport
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
