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
        Schema::create('retailers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('contact_person')->nullable();
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->decimal('reward_balance', 10, 2)->default(0);
            $table->string('referral_code')->unique();
            $table->foreignId('referred_by')->nullable()->constrained('retailers')->onDelete('set null');
            $table->boolean('bnpl_active')->default(false);
            $table->integer('due_date_days')->default(15);
            $table->decimal('penalty_rate', 5, 2)->default(0);
            $table->decimal('credit_limit', 15, 2)->default(0);
            $table->decimal('current_due', 15, 2)->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retailers');
    }
};
