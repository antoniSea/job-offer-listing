<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offerImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_id',
        'image',
        'image_alt',
        'image_title',
        'image_description',
    ];

    public function offer()
    {
        return $this->belongsTo(offer::class);
    }
}
