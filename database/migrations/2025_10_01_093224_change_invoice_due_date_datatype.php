<?php

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
        Schema::table('sc_invoices', function (Blueprint $table) {
            $table->dateTime('due_date')->nullable()->change(); // Change due_date to datetime
            $table->dateTime('issue_date')->nullable()->change(); // Change issue_date to datetime
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sc_invoices', function (Blueprint $table) {
            $table->date('due_date')->nullable()->change(); // Revert due_date back to date
            $table->date('issue_date')->nullable()->change(); // Revert issue_date back to date
        });
    }
};
