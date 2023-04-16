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
        Schema::create('fight', function (Blueprint $table) {
            $table->id();
            $table->string('country');
            $table->string('state');
            $table->string('division');
            $table->string('rounds');
            $table->date('date');
            $table->boolean('passport');
            $table->boolean('visa');
            $table->integer('promoter');
            $table->integer('oponent');
            $table->text('notes');
            $table->integer('created_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fight');
    }
};
