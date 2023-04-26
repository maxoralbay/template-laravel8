<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Equipment;
use App\Models\Challenge;

class EquipmentCategory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'image', 'created_at', 'updated_at'];

    
    public function equipments()
    {
        return $this->hasMany(Equipment::class);
    }

    public function challenges()
    {
        return $this->hasMany(Challenge::class);
    }
}
