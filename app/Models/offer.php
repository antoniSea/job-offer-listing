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

    public function Images()
    {
        return $this->hasMany(offerImage::class);
    }

    use HasFactory;
}
