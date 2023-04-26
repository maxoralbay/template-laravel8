<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EquipmentCategory;
use App\Models\EquipmentDocument;

class Equipment extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'equipment_category_id', 
        'user_id', 'brand', 'serial_number', 
        'buy_date', 'created_at', 'updated_at'
    ];
    
    protected $table = 'equipments';

    public function category()
    {
        return $this->belongsTo(EquipmentCategory::class, 'equipment_category_id');
    }

    public function documents()
    {
        return $this->hasMany(EquipmentDocument::class);
    }
}
