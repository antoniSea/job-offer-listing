<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use Inertia\Inertia;

class OfferFrontController extends Controller
{
    public function show($id)
    {
        return Inertia::render('Frontend/Offers/Show', [
            'offer' => Offer::with('images')->with('team')->findOrFail($id),
        ]);
    }
}
