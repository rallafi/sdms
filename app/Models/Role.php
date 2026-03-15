<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Fields that can be inserted
    protected $fillable = [
        'name',
        'description',
    ];

    // One role can belong to many users
    public function users()
    {
        return $this->hasMany(User::class);
    }
}