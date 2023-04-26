<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Challenge;

class UserChallengeLogger extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'challenge_id',
        'completed_at',
        'created_at',
        'updated_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function challenge()
    {
        return $this->belongsTo(Challenge::class, 'challenge_id');
    }
}
