<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'cart',
        'user_identifier',
        'first_name',
        'last_name',
        'email',
        'address',
        'phone_number',
        'additional_information'
    ];

    public function Customer() {
        return $this->belongsTo(User::class, 'email', 'user_identifier');
    }
}
