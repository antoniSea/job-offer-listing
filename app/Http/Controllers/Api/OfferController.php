<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Api\OfferRequest;
use App\Models\Offer;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(auth()->user()->offers()->with('images')->paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OfferRequest $request)
    {
        $offer = new Offer();
        $offer->fill($request->validated());
        $offer->team_id = auth()->user()->currentTeam->id;
        $offer->save();
        
        return response()->json($offer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(auth()->user()->offers()->with('images')->findorfail($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OfferRequest $request, $id)
    {
        $offer = auth()->user()->offers()->findorfail($id);
        $offer->fill($request->validated());
        $offer->save();

        return response()->json($offer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        auth()->user()->offers()->findorfail($id)->delete();

        return response()->json(['message' => 'Offer deleted']);
    }

    public function publicIndex()
    {
        return response()->json(Offer::paginate(10));
    }
}
