<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ChallengeImage;
use App\Models\ChallengeCategory;
use App\Models\EquipmentCategory;

class Challenge extends Model
{
    use HasFactory;

    protected $fillable = [
        'challenge_category_id', 'equipment_category_id', 'title', 'subtitle', 'content', 'created_at', 'updated_at'
    ];

    public function images()
    {
        return $this->hasMany(ChallengeImage::class);
    }

    public function category()
    {
        return $this->belongsTo(ChallengeCategory::class, 'challenge_category_id');
    }

    public function equipmentCategory()
    {
        return $this->belongsTo(EquipmentCategory::class, 'equipment_category_id');
    }
}
