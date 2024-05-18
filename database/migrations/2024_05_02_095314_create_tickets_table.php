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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_no')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('prioritylevel')->nullable();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('dept_id')->nullable()->constrained('departments')->onDelete('cascade');
            $table->string('status')->default(1);
            $table->string('temp_user')->nullable();
            $table->dateTime('date_issued')->nullable();
            $table->dateTime('date_solved')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
