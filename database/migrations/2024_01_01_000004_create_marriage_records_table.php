<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('marriage_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('groom_member_id')->constrained('members')->cascadeOnDelete();
            $table->foreignId('bride_member_id')->constrained('members')->cascadeOnDelete();
            $table->date('marriage_date');
            $table->string('officiant')->nullable();
            $table->json('witnesses')->nullable();
            $table->string('church_book_no')->nullable();
            $table->string('page_no')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('marriage_records');
    }
};
