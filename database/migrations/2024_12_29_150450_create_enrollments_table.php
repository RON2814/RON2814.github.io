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
        Schema::create('enrollments', function (Blueprint $table) {
            $table->id();
            $table->string("student_number");
            $table->foreignId("section_id")->nullable()->constrained("sections");
            $table->enum("year_level", ["First Year", "Second Year", "Third Year", "Fourth Year"]);
            $table->enum("semester", ["First Semester", "Second Semester", "Midyear"]);
            $table->year("school_year_start");
            $table->year("school_year_end");
            $table->enum("status", ["enrolled", "under evaluation", "evaluated", "pending", "N/A", "completed"]);
            $table->string("registrar_encoder_id")->nullable();
            $table->timestamps();

            // Foreign keys
            $table->foreign("student_number")->references("student_number")->on("students")->onDelete('cascade');
            $table->foreign("registrar_encoder_id")->references("registrar_id")->on("registrars");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enrollments');
    }
};
