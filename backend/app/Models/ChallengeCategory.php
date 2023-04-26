<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Challenge;

class ChallengeCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'image', 'image_checked', 'color', 'created_at', 'updated_at'
    ];

    protected $withCount = ['challenges'];

    public function challenges()
    {
        return $this->hasMany(Challenge::class);
    }
}
