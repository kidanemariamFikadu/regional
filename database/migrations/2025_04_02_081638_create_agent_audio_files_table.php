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
        Schema::create('agent_audio_files', function (Blueprint $table) {
            $table->id();
            $table->foreignId('agent_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('evaluation_month_id')->constrained('agent_evaluation_months')->onDelete('cascade');
            $table->string('file_url');
            $table->enum('status',['evaluated','not_evaluated'])->default('not_evaluated');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->foreignId('evaluated_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->dateTime('evaluated_at')->nullable();
            $table->integer('score')->nullable();
            $table->longText('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('agent_audio_files');
    }
};
