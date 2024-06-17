<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('client_courts', function (Blueprint $table) {
            $table->id();
            $table->foreignId("case_id")->references("id")->on("client_cases")->onDelete("cascade");
            $table->string("court_name")->nullable();
            $table->string("court_address")->nullable();
            $table->date("court_date")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_courts');
    }
};
