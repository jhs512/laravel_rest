<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReactionPoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'reaction_pointable_type',
        'reaction_pointable_id',
        'user_id',
        'point',
    ];

    public static function findBy(string $simpleReactionPointableType, int $reactionPointableId, int $userId)
    {
        $reactionPointableType = static::getReactionPointableTypeBy($simpleReactionPointableType);
        return ReactionPoint::where('reaction_pointable_type', $reactionPointableType)->where('reaction_pointable_id', $reactionPointableId)->where('user_id', $userId)->first();
    }

    public static function createReactionPoint(string $simpleReactionPointableType, int $reactionPointableId, int $userId, int $point) {
        $reactionPointableType = static::getReactionPointableTypeBy($simpleReactionPointableType);

        return static::create([
            'reaction_pointable_type' => $reactionPointableType,
            'reaction_pointable_id' => $reactionPointableId,
            'user_id' => $userId,
            'point' => $point,
        ]);
    }

    public static function updateReactionPointablePoints(ReactionPoint $reactionPoint) {
        $reactionPointable = $reactionPoint->reaction_pointable;

        $goodReactionPointSum = static::where('reaction_pointable_type', $reactionPoint->reaction_pointable_type)
            ->where('reaction_pointable_id', $reactionPoint->reaction_pointable_id)
            ->where('point', '>', 0)
            ->sum('point');

        $reactionPointable->good_reaction_point = $goodReactionPointSum;

        $badReactionPointSum = static::where('reaction_pointable_type', $reactionPoint->reaction_pointable_type)
            ->where('reaction_pointable_id', $reactionPoint->reaction_pointable_id)
            ->where('point', '<', 0)
            ->sum('point');

        $reactionPointable->bad_reaction_point = $badReactionPointSum * -1;

        $reactionPointable->save();
    }

    public static function makeGood(string $simpleReactionPointableType, int $reactionPointableId, int $userId)
    {
        $reactionPoint = static::createReactionPoint($simpleReactionPointableType, $reactionPointableId, $userId, 1);
        static::updateReactionPointablePoints($reactionPoint);
    }

    public static function cancelGood(string $simpleReactionPointableType, int $reactionPointableId, int $userId)
    {
        $reactionPoint = static::findBy($simpleReactionPointableType, $reactionPointableId, $userId);
        $reactionPoint->delete();

        static::updateReactionPointablePoints($reactionPoint);
    }

    public static function makeBad(string $simpleReactionPointableType, int $reactionPointableId, int $userId)
    {
        $reactionPoint = static::createReactionPoint($simpleReactionPointableType, $reactionPointableId, $userId, -1);
        static::updateReactionPointablePoints($reactionPoint);
    }

    public static function cancelBad(string $simpleReactionPointableType, int $reactionPointableId, int $userId)
    {
        $reactionPoint = static::findBy($simpleReactionPointableType, $reactionPointableId, $userId);
        $reactionPoint->delete();

        static::updateReactionPointablePoints($reactionPoint);
    }

    public static function getReactionPointableTypeBy(string $simpleReactionPointableType)
    {
        return 'App\\Models\\' . ucfirst($simpleReactionPointableType);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reaction_pointable()
    {
        return $this->morphTo();
    }
}
