<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'type',
        'stock',
        'price',
        'status'
    ];

    public function incomingItems()
    {
        return $this->hasMany(IncomingItem::class);
    }

    public function outgoingItems()
    {
        return $this->hasMany(OutgoingItem::class);
    }
}