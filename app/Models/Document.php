<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Document extends Model {
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'filename',
        'vector_id',
        'metadata',
        'content',
        'processed_at',
    ];
}
