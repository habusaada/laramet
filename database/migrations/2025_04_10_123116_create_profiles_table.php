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

        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('profile_id')->nullable()->unique();
            $table->string('phone_number')->nullable();
            $table->string('company_name')->nullable();$table->enum('company_location', [
                'Istanbul',
                'Ankara',
                'Izmir',
                'Bursa',
                'Adana',
                'Gaziantep',
                'Konya',
                'Antalya',
                'Kayseri',
                'Mersin',
                'Diyarbakır',
                'Samsun',
                'Eskişehir',
                'Denizli',
                'Trabzon',
                'Erzurum',
                'Malatya',
                'Sakarya',
                'Manisa',
                'Balıkesir',
            ])->nullable();
            $table->string('job_title')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->enum('gender', ['male', 'female', 'other'])->nullable();
            $table->string('profile_image')->nullable();
            $table->text('address')->nullable();
            $table->string('timezone')->nullable();
            $table->text('bio')->nullable();
            $table->json('notification_preferences')->nullable();
            $table->timestamp('last_login_at')->nullable();
            $table->boolean('verified')->default(false);
            $table->enum('status', [
                'pending',       // After registration
                'under_review',  // After email verification
                'approved',      // After admin approval
                'rejected'       // Rejected by admin
            ])->default('pending');
            $table->text('rejection_reason')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('profiles', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
        });

        Schema::dropIfExists('profiles');
    }
};
