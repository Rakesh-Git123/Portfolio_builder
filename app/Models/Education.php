<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $fillable = ['portfolio_id', 'degree', 'institution', 'year'];

    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }
}

