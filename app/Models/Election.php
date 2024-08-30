<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Election extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'code',
        'status',
        'open_date',
        'close_date',
        'number_of_candidates',
        'user_id',
    ];


    const CREATE = "creation";
    const WAIT_VALIDATION = "En attente";
    const ONLINE = "En ligne";
    const CLOSE = "Fermer";

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function candidates(): HasMany
    {
        return $this->hasMany(Candidate::class);
    }
}
