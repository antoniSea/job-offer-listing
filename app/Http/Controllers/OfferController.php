<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Offer;

class OfferController extends Controller
{
    public function index()
    {
        return Inertia::render('Offers/Index', [
            'offers' => Offer::all(),
        ]);
    }
}
