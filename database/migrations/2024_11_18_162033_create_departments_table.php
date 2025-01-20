<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->string("department_id")->primary();
            $table->string("last_name");
            $table->string("first_name");
            $table->string("middle_name");
            $table->string("extension_name")->nullable();
            $table->string("contact_number");
            $table->foreignId("program_id")->constrained("programs");
            $table->timestamps();

            // Foreign keys
            $table->foreign("department_id")->references("id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
