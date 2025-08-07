<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name', 'phone_number', 'alamat', 'request_pelanggan',
        'ongkir', 'total_price', 'status', 'payment_method', 'delivery_status', 
        'order_date', 'bukti_pembayaran', 'alasan_penolakam'
    ];
    

    protected $dates = ['order_date'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public static function getOrdersByDate($date)
    {
        return self::whereDate('order_date', $date)->get();
    }

    
}

