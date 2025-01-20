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
        Schema::create('checklists', function (Blueprint $table) {
            $table->id();
            $table->string("student_number");
            $table->string("course_code");
            $table->enum("grade", ["1.00", "1.25", "1.50", "1.75", "2.00", "2.25", "2.50", "2.75", "3.00", "4.00", "5.00", "INC", "S", "DROPPED", "CREDITED"])->nullable();
            $table->foreignId("instructor_id")->nullable()->contraigned("instructors");
            $table->enum("year", ["First Year", "Second Year", "Third Year", "Fourth Year"]);
            $table->enum("semester", ["First Semester", "Second Semester", "Midyear"]);
            $table->foreignId("enrollment_id")->nullable()->contraigned("enrollments");
            $table->timestamps();

            // Foreign keys
            $table->foreign("student_number")->references("student_number")->on("students")->onDelete('cascade');
            $table->foreign("course_code")->references("course_code")->on("courses");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('checklists');
    }
};
