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
        Schema::create('regional_offices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('region');
            $table->string('country')->default('Ethiopia');
            $table->timestamps();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('phone_number')->nullable()->after('email');
            $table->unsignedBigInteger('regional_office_id')->nullable()->after('phone_number');
            $table->foreign('regional_office_id')->references('id')->on('regional_offices');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regional_offices');
    }
};
