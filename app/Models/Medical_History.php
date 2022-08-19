<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medical_History extends Model
{
    use HasFactory;
    protected $fillable = [
        'medical_detail',
        'dr_name',
        'date',
        'cat_id',
    ];
    public function catdata()
    {
        return $this->belongsTo(Cat::class);
    }
}
