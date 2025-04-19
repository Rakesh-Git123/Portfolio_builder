<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    // Define the fillable attributes for mass assignment
    protected $fillable = [
        'title',  
        'description',
        'portfolio_id'
    ];
   
    public function portfolio()
    {
        return $this->belongsTo(Portfolio::class);
    }

}

