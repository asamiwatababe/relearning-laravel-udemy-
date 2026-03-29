<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Chore extends Model
{
    protected $fillable = [
        'category',
        'name',
        'points',
    ];

    public function choreRecords(): HasMany
    {
        return $this->hasMany(ChoreRecord::class);
    }
}
