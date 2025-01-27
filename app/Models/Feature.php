<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Feature extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function upvotes()
    {
        return $this->hasMany(Upvote::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    function scopeWithUpVoteCount(Builder $query)
    {
        $query->withCount(["upvotes as upvote_count" => function($query){
            $query->select(DB::raw("SUM(CASE WHEN upvote = 1 THEN 1 ELSE -1 END)") );
        }]);

    }
    function scopeWithUserVoteStatus(Builder $query, $userId)
    {
       $query ->withExists(["upvotes as user_has_upvoted" => function($query) use ($userId){
              $query->where("user_id", $userId)->where("upvote", 1);
       }]);
         $query ->withExists(["upvotes as user_has_downvoted" => function($query) use ($userId){
                  $query->where("user_id", $userId)->where("upvote", 0);
         }]);
    }
}
