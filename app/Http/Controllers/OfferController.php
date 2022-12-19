<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Offer;
use App\Http\Requests\OfferRequest;

class OfferController extends Controller
{
    public function index()
    {
        return Inertia::render('Offers/Index', [
            'offers' => Offer::where('team_id', auth()->user()->currentTeam->id)->get(),
        ]);
    }

    public function show($id)
    {
        return Inertia::render('Offers/Show', [
            'offer' => Offer::where('id', $id)->where('team_id', auth()->user()->currentTeam->id)->with('images')->firstorfail(),
        ]);
    }

    public function destroy($id) {
        Offer::findorfail($id)->delete();
        return redirect()->route('offers.index');
    }

    public function create()
    {
        return Inertia::render('Offers/Create');
    }

    public function store(OfferRequest $request) {
        $offer = new Offer($request->validated());
        $offer->team_id = auth()->user()->currentTeam->id;
        $offer->save();

        foreach ($request->images as $image) {
            $imag = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $image['url']));
            $imageName = time() . '_' . uniqid() . '.png';
            $path = public_path('storage/images/' . $imageName);
            file_put_contents($path, $imag);

            $offer->images()->create([
                'image' => url('storage/images/' . $imageName),
                'image_alt' => $image['alt'],
                'image_title' => $image['title'],
                'image_description' => $image['description']
            ]);
        }

        return redirect()->route('offers.index');
    }

    public function edit($id)
    {
        return Inertia::render('Offers/Show', [
            'offer' => Offer::where('id', $id)->where('team_id', auth()->user()->currentTeam->id)->with('images')->firstorfail(),
            'edit' => true
        ]);
    }

    public function update($id, OfferRequest $request) {
        $offer = Offer::where('team_id', auth()->user()->currentTeam->id)->where('id', $id)->firstorfail();
        $offer->update($request->validated());

        return redirect()->route('offers.index');
    }
}
