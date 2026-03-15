<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    protected $fillable = [
        'document_id',
        'user_id',
        'reserved_at',
        'released_at',
        'status',
    ];

    protected $casts = [
        'reserved_at' => 'datetime',
        'released_at' => 'datetime',
    ];

    /**
     * Reservation belongs to a document.
     */
    public function document()
    {
        return $this->belongsTo(Document::class);
    }

    /**
     * Reservation belongs to a user (who reserved it).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
