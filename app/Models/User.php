<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relationship with portfolios.
     * One user can have many portfolios.
     */
    public function portfolios()
    {
        return $this->hasMany(Portfolio::class);
    }

    /**
     * Relationship with projects.
     * One user can have many projects through portfolios.
     */
    public function projects()
    {
        return $this->hasManyThrough(Project::class, Portfolio::class);
    }

    /**
     * Relationship with skills.
     * One user can have many skills.
     */
    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    /**
     * Relationship with education.
     * One user can have many education records.
     */
    public function education()
    {
        return $this->hasMany(Education::class);
    }

    /**
     * Relationship with experiences.
     * One user can have many experiences.
     */
    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    /**
     * Relationship with about me.
     * One user can have one "about me" section.
     */
    public function aboutMe()
    {
        return $this->hasOne(AboutMe::class);
    }
}
