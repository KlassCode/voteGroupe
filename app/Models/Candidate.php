<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Candidate extends Model
{
    use HasFactory;
    protected $fillable = [
        'fullname',
        'email',
        'number_of_votes',
        'election_id'
    ];

    public function election(): BelongsTo
    {
        return $this->belongsTo(Election::class);
    }
}
