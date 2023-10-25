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
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->boolean('type')->default(true)->comment('1=new/0=old');
            $table->string('name');
            $table->string('contact');
            $table->string('age');
            $table->integer('age_type');
            $table->string('address');
            $table->integer('disease_id');
            $table->integer('blood_group_id')->nullable();
            $table->integer('gender_id');
            $table->integer('religion_id');
            $table->integer('doctor_id');
            $table->date('visit_date');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};
