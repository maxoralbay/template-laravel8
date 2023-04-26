<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class PasswordReset extends Model
{
    use HasFactory;

    protected $fillable = ['email', 'token', 'created_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'email');
    }
}
