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
        Schema::create('common_faq_package', function (Blueprint $table) {
            $table->id();
            $table->foreignId('common_faq_id')->constrained('common_faqs')->onDelete('cascade');
            $table->foreignId('package_id')->constrained('packages')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('common_faq_package');
    }
};