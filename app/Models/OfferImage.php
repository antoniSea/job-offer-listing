<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfferImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'offer_id',
        'image',
        'image_alt',
        'image_title',
        'image_description',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($offerImage) {
            $offerImageAction = new Action();
            $offerImageAction->name = 'Dodanie zdjęcia do oferty';
            $offerImageAction->description = 'Dodanie zdjęcia do oferty o id: ' . $offerImage->offer_id;
            $offerImageAction->type = 'create';
            $offerImageAction->user_id = auth()->user()->id;
            $offerImageAction->team_id = auth()->user()->currentTeam->id;
            $offerImageAction->ip_address = request()->ip();
            $offerImageAction->save();
        });

        static::deleted(function ($offerImage) {
            $offerImageAction = new Action();
            $offerImageAction->name = 'Usunięcie zdjęcia z oferty';
            $offerImageAction->description = 'Usunięcie zdjęcia z oferty o id: ' . $offerImage->offer_id;
            $offerImageAction->type = 'delete';
            $offerImageAction->user_id = auth()->user()->id;
            $offerImageAction->team_id = auth()->user()->currentTeam->id;
            $offerImageAction->ip_address = request()->ip();
            $offerImageAction->save();
        });
    }

    public function offer()
    {
        return $this->belongsTo(offer::class);
    }
}
