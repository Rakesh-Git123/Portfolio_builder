<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = ['portfolio_id', 'position', 'company', 'duration'];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}


