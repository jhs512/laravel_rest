<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\ReactionPoint;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Gate;

class ReactionPointController extends Controller
{
    public function makeBad(string $simpleReactionPointableType, int $reactionPointableId)
    {
        Gate::authorize('makeBadReactionPoint', [ReactionPoint::class, $simpleReactionPointableType, $reactionPointableId]);

        ReactionPoint::makeBad($simpleReactionPointableType, $reactionPointableId, auth()->user()->id);

        return redirect()->back()->with('success', "싫어요 처리 하였습니다.");
    }

    public function cancelBad(string $simpleReactionPointableType, int $reactionPointableId)
    {
        Gate::authorize('cancelBadReactionPoint', [ReactionPoint::class, $simpleReactionPointableType, $reactionPointableId]);

        ReactionPoint::cancelBad($simpleReactionPointableType, $reactionPointableId, auth()->user()->id);

        return redirect()->back()->with('success', "싫어요를 취소처리 하였습니다.");
    }

    public function makeGood(string $simpleReactionPointableType, int $reactionPointableId)
    {
        Gate::authorize('makeGoodReactionPoint', [ReactionPoint::class, $simpleReactionPointableType, $reactionPointableId]);

        ReactionPoint::makeGood($simpleReactionPointableType, $reactionPointableId, auth()->user()->id);

        return redirect()->back()->with('success', "좋아요 처리 하였습니다.");
    }

    public function cancelGood(string $simpleReactionPointableType, int $reactionPointableId)
    {
        Gate::authorize('cancelGoodReactionPoint', [ReactionPoint::class, $simpleReactionPointableType, $reactionPointableId]);

        ReactionPoint::cancelGood($simpleReactionPointableType, $reactionPointableId, auth()->user()->id);

        return redirect()->back()->with('success', "좋아요를 취소처리 하였습니다.");
    }
}
