<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'price',
        'status',
    ];

    protected $cast = [
        'user_id' => 'string',
        'price' => 'number'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function products() {
        return $this->BelongsToMany(Product::class);
    }

}
