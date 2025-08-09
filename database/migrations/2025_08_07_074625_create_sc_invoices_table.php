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
        Schema::create('sc_invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); // Foreign key to sc_orders
            $table->foreign('order_id')->references('id')->on('sc_orders')->onDelete('cascade');
            $table->uuid('invoice_number')->unique();
            $table->string('gateway_invoice_id')->nullable(); // Unique identifier from the payment gateway
            $table->decimal('total_amount', 10, 2);
            $table->string('status')->default('PENDING'); // Possible values: PENDING, PAID, CANCELLED, REFUNDED
            $table->date('issue_date')->nullable(); // Date when the invoice was issued
            $table->date('due_date')->nullable(); // Date when the payment is due
            $table->text('notes')->nullable(); // Additional notes or comments on the invoice
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sc_invoices');
    }
};
