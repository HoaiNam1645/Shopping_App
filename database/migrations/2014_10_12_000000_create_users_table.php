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
            $table->string('full_name');              // NOT NULL
            $table->string('email')->unique();        // NOT NULL
            $table->string('password');               // NOT NULL
            $table->string('phone');    // NOT NULL
            $table->string('address');                // NOT NULL
            $table->string('image')->nullable();      // Có thể NULL
            $table->string('role')->default('user');  // NOT NULL với default 'user'
            $table->timestamps();                     // NOT NULL
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
