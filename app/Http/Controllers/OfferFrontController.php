<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Offer;
use App\Models\OfferView;
use Inertia\Inertia;
use App\Models\Comment;
use App\Models\CommentReport;

class OfferFrontController extends Controller
{
    public function show($id)
    {
        $offerView = new OfferView();
        $offerView->offer_id = $id;
        $offerView->ip = request()->ip();
        $offerView->user_agent = request()->userAgent();
        $offerView->save();

        $offer = Offer::with('images')->with('comments')->with('team')->with('views')->findOrFail($id);
        $offer->comments->each(function ($comment) {
            $comment->user;
            $comment->shownBody = substr($comment->body, 0, 160);
        });        

        return Inertia::render('Frontend/Offers/Show', [
            'offer' => $offer,
        ]);
    }

    public function index()
    {
        if (request()->has('search')) {
            return Inertia::render('Frontend/Offers/Index', [
                'offers' => Offer::with('images')->where('name', 'like', '%' . request()->get('search') . '%')->paginate(8),
            ]);
        }

        return Inertia::render('Frontend/Offers/Index', [
            'offers' => Offer::with('images')->paginate(8),
        ]);
    }

    public function placeComment(Request $request, $id)
    {
        $comment = new Comment();
        $comment->body = $request->comment;
        $comment->user_id = auth()->user()->id ?? null;
        $comment->rating = $request->rating;
        $comment->offer_id = Offer::findOrFail($id)->id;
        $comment->save();

        return redirect()->back();
    }

    public function markAsHelpful($id)
    {
        $comment = Comment::findOrFail($id);
        $comment->found_helpful = $comment->helpful + 1;
        $comment->save();

        return redirect()->back();
    }

    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id)->delete();

        return redirect()->back();
    }

    public function reportComment($offer_id, $comment_id)
    {
        $offers = Offer::with('images')->with('comments')->with('team')->with('views')->findOrFail($offer_id);
        $offers->comments->each(function ($comment) {
            $comment->user;
        });

        return Inertia::render('Frontend/Offers/Show', [
            'offer' => $offers,
            'reportComment' => Comment::findOrFail($comment_id),
        ]);
    }

    public function submitReportComment(Request $request, $offer_id, $comment_id) {
        $report = new CommentReport();
        $report->type = $request->report_reason;
        $report->reason = $request->report_description;
        $report->comment_id = $comment_id;
        $report->save();

        return redirect()->route('offers.front.show', $offer_id);
    }
}
