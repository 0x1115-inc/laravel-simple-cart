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
        Schema::create('sc_shipments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id'); // Foreign key to sc_orders
            $table->foreign('order_id')->references('id')->on('sc_orders')->onDelete('cascade');
            $table->string('tracking_number')->unique(); // Unique tracking number for the shipment
            $table->string('carrier'); // e.g., 'UPS', 'FedEx', 'DHL'
            $table->string('status')->default('PENDING'); // Possible values: PENDING, SHIPPED, DELIVERED, RETURNED
            $table->date('shipped_date')->nullable(); // Date when the shipment was sent
            $table->date('delivered_date')->nullable(); // Date when the shipment was delivered
            $table->text('notes')->nullable(); // Additional notes or comments on the shipment
            $table->string('shipping_address'); // Address where the shipment is sent
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sc_shipments');
    }
};
