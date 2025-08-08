<?php
/**
 * Copyright 2025 0x1115 Inc <info@0x1115.com>
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace MCXV\SimpleCart\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    // Order Status Constants
    const STATUS_CREATED = 'CREATED'; // Right after order is placed, wait for payment method selection.
    const STATUS_PENDING = 'PENDING'; // Payment method selected, waiting for payment.
    const STATUS_COMPLETED = 'COMPLETED'; // Payment received, order is complete.
    const STATUS_CANCELLED = 'CANCELLED'; // Order cancelled by customer or admin.
    const STATUS_REFUNDED = 'REFUNDED'; // Payment refunded, order is cancelled.
    const STATUS_FAILED = 'FAILED'; // Payment failed, order is not completed.

    protected $table = 'sc_orders';    
    protected $fillable = [
        'order_number', 
        'customer_id', 
        'status', 
        'total_amount'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }
}
