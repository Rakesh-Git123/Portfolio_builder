<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['portfolio_id', 'name', 'level'];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}

