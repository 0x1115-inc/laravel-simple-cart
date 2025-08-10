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

class Invoice extends Model
{

    // Available statuses
    const STATUS_PENDING = 'PENDING';
    const STATUS_PARTIAL_FULFILLED = 'PARTIAL_FULFILLED';
    const STATUS_FULFILLED = 'FULFILLED';
    const STATUS_SUCCESSED = 'SUCCESSED';
    const STATUS_EXPIRED = 'EXPIRED';

    protected $table = 'sc_invoices';
    
    protected $fillable = [
        'invoice_number',
        'gateway_invoice_id',
        'issue_date',
        'due_date',
        'notes',
        'total_amount',
        'status', 
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function isExpired(): bool
    {
        // Check if the invoice is expired based on the due date
        return $this->status === self::STATUS_EXPIRED || !in_array($this->status, [
            self::STATUS_FULFILLED,
            self::STATUS_SUCCESSED,
        ]) && $this->due_date < now();
    }
}
