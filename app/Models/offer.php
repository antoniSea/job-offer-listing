<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class offer extends Model
{
    protected $fillable = [
        'name',
        'description',
        'contact_number',
        'contact_email',
        'contact_name',
        'contact_address',
        'contact_city',
        'contact_street',
        'contact_postal_code',
        'contact_country',
    ];

    protected static function boot()
    {
        parent::boot();

        static::created(function ($offer) {
            $offerAction = new Action();
            $offerAction->name = 'Dodanie oferty';
            $offerAction->description = 'Dodanie oferty o id: ' . $offer->id;
            $offerAction->type = 'create';
            $offerAction->user_id = auth()->user()->id;
            $offerAction->team_id = auth()->user()->currentTeam->id;
            $offerAction->ip_address = request()->ip();
            $offerAction->save();
        });

        static::updated(function ($offer) {
            $offerAction = new Action();
            $offerAction->name = 'Edycja oferty';
            $offerAction->description = 'Edycja oferty o id: ' . $offer->id;
            $offerAction->type = 'update';
            $offerAction->user_id = auth()->user()->id;
            $offerAction->team_id = auth()->user()->currentTeam->id;
            $offerAction->ip_address = request()->ip();
            $offerAction->save();
        });

        static::deleted(function ($offer) {
            $offerAction = new Action();
            $offerAction->name = 'Usunięcie oferty';
            $offerAction->description = 'Usunięcie oferty o id: ' . $offer->id;
            $offerAction->type = 'delete';
            $offerAction->user_id = auth()->user()->id;
            $offerAction->team_id = auth()->user()->currentTeam->id;
            $offerAction->ip_address = request()->ip();
            $offerAction->save();
        });
    }

    public function Images()
    {
        return $this->hasMany(offerImage::class);
    }

    public function Team()
    {
        return $this->belongsTo(Team::class);
    }

    public function Views()
    {
        return $this->hasMany(OfferView::class);
    }

    public function Comments()
    {
        return $this->hasMany(Comment::class);
    }

    use HasFactory;
}
