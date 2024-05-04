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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('sex')->nullable();
            $table->string('usertype')->default('user');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('status')->default(1);
            $table->timestamp('email_verified_at')->nullable();
            $table->foreignId('dept_id')->nullable()->constrained('departments')->onDelete('cascade');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
