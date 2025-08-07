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

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sc_payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id'); // Foreign key to sc_invoices
            $table->foreign('invoice_id')->references('id')->on('sc_invoices')->onDelete('cascade');
            $table->decimal('amount', 10, 2); // Amount paid
            $table->string('payment_method'); // e.g., 'credit_card', 'paypal', 'bank_transfer'
            $table->string('transaction_id')->unique()->nullable(); // Unique transaction ID from payment gateway
            $table->string('status')->default('PENDING'); // Possible values: PENDING, COMPLETED, FAILED, REFUNDED
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sc_payments');
    }
};
