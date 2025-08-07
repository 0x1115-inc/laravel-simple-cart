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
        Schema::create('sc_crypto_payments', function (Blueprint $table) {
            $table->id();            
            $table->unsignedBigInteger('payment_id'); // Foreign key to sc_payments
            $table->foreign('payment_id')->references('id')->on('sc_payments')->onDelete('cascade');
            $table->string('crypto_symbol'); // Cryptocurrency symbol (e.g., BTC, ETH)
            $table->string('crypto_network'); // Blockchain network (e.g., Bitcoin, Ethereum)
            $table->string('crypto_amount'); // Amount of cryptocurrency to be paid. Consider the precision of the cryptocurrency.
            $table->string('crypto_address'); // Cryptocurrency address for the payment
            $table->string('transaction_hash')->unique()->nullable(); // Unique transaction hash from the blockchain
            $table->string('status')->default('PENDING'); // Possible values: PENDING, COMPLETED, FAILED, REFUNDED            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sc_crypto_payments');
    }
};
