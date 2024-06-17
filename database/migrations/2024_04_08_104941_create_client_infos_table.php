<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('client_infos', function (Blueprint $table) {
            $table->id();
            $table->foreignId("case_id")->references("id")->on("client_cases")->onDelete("cascade");
            $table->string("client_company")->nullable();
            $table->string("client_representative")->nullable();
            $table->string("client_email")->nullable();
            $table->string("client_mobile")->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('client_infos');
    }
};
