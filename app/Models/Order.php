<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_name',
        'account_number',
        'amount',
        'beneficiary_name',
        'documents',
        'status'
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];
}
