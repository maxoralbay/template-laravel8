<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Challenge;

class ChallengeImage extends Model
{
    use HasFactory;

    protected $fillable = ['challenge_id', 'path', 'deleted_at', 'created_at', 'updated_at'];

    public function challenge()
    {
        return $this->belongsTo(Challenge::class);
    }
}
