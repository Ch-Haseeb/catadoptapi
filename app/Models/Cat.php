<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cat extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'breed',
        'features',
        'user_id',
        'picture',
        'color',
        'DOB'
    ];
    
    public function medical_history()
    {
        return $this->hasMany(Medical_History::class);
    }
    public function UserData()
    {
        return $this->belongsTo(User::class);
    }
}
