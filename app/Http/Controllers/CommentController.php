<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Inertia\Inertia;

class CommentController extends Controller
{
    public function index()
    {
        if (auth()->user()->comments_view_mode == 'all') {
            return Inertia::render('Comments/Index', [
                'comments' => auth()->user()->currentTeam->commentsThroughOffers()->with('user')->paginate(10),
            ]);
        }
        else {
            return Inertia::render('Comments/OfferIndex', [
                'offers' => auth()->user()->currentTeam->offers()->paginate(10),
            ]);
        }
    }

    public function showByOffer($offer_id) {
        return Inertia::render('Comments/Index', [
            'comments' => auth()->user()->currentTeam->commentsThroughOffers()->with('user')->where('offer_id', $offer_id)->paginate(10),
            'searched_offer_id' => $offer_id,
        ]);
    }

    public function changeViewMode() {
        $user = User::findorFail(auth()->user()->id);
        $user->comments_view_mode = $user->comments_view_mode == 'offers' ? 'all' : 'offers';
        $user->save();

        session()->flash('flash.banner', 'Zmieniono ustawienia wyświwtlania!');
        session()->flash('flash.bannerStyle', 'success');
 
        return redirect()->route('comments.index');
    }

    public function show($id) {
        return Inertia::render('Comments/Show', [
            'comment' => auth()->user()->currentTeam->commentsThroughOffers()->with('user')->findOrFail($id),
        ]);
    }

}
