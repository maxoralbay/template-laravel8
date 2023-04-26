<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentDocument extends Model
{
    use HasFactory;

    protected $fillable = ['equipment_id', 'name', 'path', 'created_at', 'updated_at'];

    
}
