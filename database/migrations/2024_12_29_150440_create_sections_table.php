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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId("program_id")->constrained("programs");
            $table->enum("year_level", ["First Year", "Second Year", "Third Year", "Fourth Year"]);
            $table->tinyInteger("section_name")->unsigned();
            $table->tinyInteger("current_student_enrolled")->unsigned();
            $table->tinyInteger("max_capacity")->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
