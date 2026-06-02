<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Users table (Laravel default extended)
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_admin')->default(false);
            $table->rememberToken();
            $table->timestamps();
        });

        // Industries table
        Schema::create('industries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->json('overpass_tags')->nullable();
            $table->string('icon')->default('building');
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });

        // Searches table
        Schema::create('searches', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('industry_id')->nullable()->constrained()->nullOnDelete();
            $table->string('query')->nullable();
            $table->string('city')->nullable();
            $table->string('postal_code')->nullable();
            $table->string('country')->default('AT');
            $table->integer('radius_km')->default(25);
            $table->boolean('filter_website')->default(false);
            $table->boolean('filter_email')->default(false);
            $table->boolean('filter_phone')->default(false);
            $table->boolean('filter_name')->default(true);
            $table->integer('result_count')->default(0);
            $table->string('status')->default('pending'); // pending, running, completed, failed
            $table->timestamps();
        });

        // Leads table
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('search_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('industry_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name')->nullable();
            $table->string('email')->nullable()->index();
            $table->string('phone')->nullable();
            $table->string('website')->nullable()->index();
            $table->string('address')->nullable();
            $table->string('city')->nullable()->index();
            $table->string('postal_code')->nullable()->index();
            $table->string('country')->default('AT');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->string('source_url')->nullable();
            $table->string('source_type')->default('overpass');
            $table->boolean('has_website')->default(false);
            $table->boolean('has_email')->default(false);
            $table->boolean('has_phone')->default(false);
            $table->boolean('has_address')->default(false);
            $table->boolean('has_name')->default(false);
            $table->boolean('website_valid')->nullable();
            $table->text('notes')->nullable();
            $table->string('status')->default('new'); // new, contacted, interested, converted, archived
            $table->timestamps();

            $table->index(['city', 'postal_code']);
            $table->index(['country']);
        });

        // Sessions table
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('leads');
        Schema::dropIfExists('searches');
        Schema::dropIfExists('industries');
        Schema::dropIfExists('users');
        Schema::dropIfExists('sessions');
    }
};
