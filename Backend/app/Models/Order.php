<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Models\User;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';
    protected $fillable = [
        'id',
        'order_date',
        'total_amount',
        'status',
        'shipping_address',
        'shipping_money',
        'user_id',
        'order_note',
        'number_phone'
    ]; 

    public function payment() {
        return $this->hasOne(Payment::class, 'order_id');
    }

    public function orderDetails() {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}

