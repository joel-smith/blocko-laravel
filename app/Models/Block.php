<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Block extends Model
{
    use HasFactory;

    protected $fillable = [
        'data',
        'prev_hash',
        'hash'
    ];

    public function calculateHash()
    {
        return hash('sha256', $this->id . $this->data . $this->prev_hash . $this->created_at->timestamp);
    }
}
