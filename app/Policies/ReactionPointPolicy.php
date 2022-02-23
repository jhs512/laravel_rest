<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Article;
use App\Models\ReactionPoint;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReactionPointPolicy
{
    use HandlesAuthorization;

    public function makeGoodReactionPoint(User $user, string $simpleReactionPointableType, int $reactionPointableId)
    {
        $reactionPoint = ReactionPoint::findBy($simpleReactionPointableType, $reactionPointableId, $user->id);

        return empty($reactionPoint);
    }

    public function cancelGoodReactionPoint(User $user, string $simpleReactionPointableType, int $reactionPointableId)
    {
        $reactionPoint = ReactionPoint::findBy($simpleReactionPointableType, $reactionPointableId, $user->id);

        return $reactionPoint and $reactionPoint->point > 0;
    }

    public function makeBadReactionPoint(User $user, string $simpleReactionPointableType, int $reactionPointableId)
    {
        return $this->makeGoodReactionPoint($user, $simpleReactionPointableType, $reactionPointableId);
    }

    public function cancelBadReactionPoint(User $user, string $simpleReactionPointableType, int $reactionPointableId)
    {
        $reactionPoint = ReactionPoint::findBy($simpleReactionPointableType, $reactionPointableId, $user->id);

        return $reactionPoint and $reactionPoint->point < 0;
    }
}
