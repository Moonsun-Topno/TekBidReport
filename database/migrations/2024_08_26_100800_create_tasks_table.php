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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('owner_id')->constrained('users');
            $table->string('type');
            $table->string('case_type');
            $table->string('region');
            $table->string('customer');
            $table->string('reference_number');
            $table->timestamp('task_started')->nullable();
            $table->timestamp('task_completed')->nullable();
            $table->integer('time_occupied')->nullable(); // Time in minutes or seconds
            $table->longtext('comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
