<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;

    // Allow mass assignment on these fields
    protected $fillable = [
        'title',
        'description',
        'category_id',
        'file_name',
        'file_path',
        'file_size',
        'file_type',
        'uploaded_by',
        'last_edited_by',
        'is_reserved',
    ];

    // Cast fields to correct types
    protected $casts = [
        'is_reserved' => 'boolean',
    ];

    /**
     * Document belongs to a category.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Document belongs to an uploader (user).
     */
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    /**
     * Document may have a last editor (user).
     */
    public function lastEditor()
    {
        return $this->belongsTo(User::class, 'last_edited_by');
    }

    /**
     * Document can have many reservations (history).
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    /**
     * Active reservation for this document (at most one).
     */
    public function activeReservation()
    {
        return $this->hasOne(Reservation::class)->where('status', 'active');
    }
}