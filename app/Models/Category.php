<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Allow mass assignment on these fields
    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * A category has many documents.
     */
    public function documents()
    {
        return $this->hasMany(Document::class);
    }
}

