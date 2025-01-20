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
        Schema::create('students', function (Blueprint $table) {
            $table->string("student_number")->primary();
            $table->string("last_name");
            $table->string("first_name");
            $table->string("middle_name");
            $table->string("extension_name")->nullable();
            $table->string("contact_number")->nullable();
            $table->date("birthday")->nullable();
            $table->enum("sex", ["male", "female"])->nullable();
            $table->foreignId("program_id")->constrained("programs");
            $table->enum("classification", ["Regular", "Irregular", "Transferee", "Returnee"]);
            $table->foreignId("address_id")->constrained("addresses")->onDelete("cascade");
            $table->timestamps();

            // Foreign keys
            $table->foreign("student_number")->references("id")->on("users")->onDelete("cascade");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
