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
        Schema::create('courses', function (Blueprint $table) {
            $table->string("course_code")->primary();
            $table->string("course_title");
            $table->tinyInteger("credit_unit_lecture")->unsigned();
            $table->tinyInteger("credit_unit_laboratory")->unsigned();
            $table->tinyInteger("contact_hours_lecture")->unsigned();
            $table->tinyInteger("contact_hours_laboratory")->unsigned();
            $table->string("pre_requisite")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
