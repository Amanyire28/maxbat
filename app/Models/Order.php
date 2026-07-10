<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'items', 'total', 'status', 'notes'];
    protected $casts    = ['items' => 'array'];

    public function user() { return $this->belongsTo(User::class); }

    public function getStatusLabelAttribute(): string
    {
        return match($this->status) {
            'pending'   => 'Pending',
            'confirmed' => 'Confirmed',
            'shipped'   => 'Shipped',
            'delivered' => 'Delivered',
            'cancelled' => 'Cancelled',
            default     => ucfirst($this->status),
        };
    }
}
