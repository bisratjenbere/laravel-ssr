<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Upvote extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['user_id', 'feature_id', 'upvote'];
    public function feature():BelongsTo
    {
        return $this->belongsTo(Feature::class);
    }
}
