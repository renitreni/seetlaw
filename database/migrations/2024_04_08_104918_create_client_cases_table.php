<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('client_cases', function (Blueprint $table) {
            $table->id();
            $table->string('case_number');
            $table->string('case_plaintiff')->nullable();
            $table->string('case_defendant')->nullable();
            $table->string('case_relation')->nullable();
            $table->string('case_type')->nullable();
            $table->string('case_status')->nullable();
            $table->text('case_description')->nullable();
            $table->string('case_docsready')->nullable();
            $table->string('case_files')->nullable();
            $table->date('case_date')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_cases');
    }
};
