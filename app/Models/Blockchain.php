<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Blockchain extends Model
{
    use HasFactory;

    public function blocks() : HasMany
    {
        return $this->hasMany(Block::class);
    }


}
