<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutMe extends Model
{
    use HasFactory;

    protected $fillable = ['portfolio_id', 'description', 'image'];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}

