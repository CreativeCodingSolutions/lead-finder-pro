<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * Adds guest_score_id column to leads table for LFP guest score capture flow.
     */
    public function up(): void
    {
        // Add guest_score_id to leads table
        if (!Schema::hasColumn('leads', 'guest_score_id')) {
            Schema::table('leads', function (Blueprint $table) {
                $table->unsignedBigInteger('guest_score_id')->nullable()->after('search_id');
            });
        }

        // Add ip_address if missing
        if (!Schema::hasColumn('leads', 'ip_address')) {
            Schema::table('leads', function (Blueprint $table) {
                $table->string('ip_address', 45)->nullable()->after('website_valid');
            });
        }

        // Add consent_given if missing
        if (!Schema::hasColumn('leads', 'consent_given')) {
            Schema::table('leads', function (Blueprint $table) {
                $table->boolean('consent_given')->default(false)->after('ip_address');
            });
        }

        // Add consent_text if missing
        if (!Schema::hasColumn('leads', 'consent_text')) {
            Schema::table('leads', function (Blueprint $table) {
                $table->text('consent_text')->nullable()->after('consent_given');
            });
        }

        // Add email_verified_at if missing
        if (!Schema::hasColumn('leads', 'email_verified_at')) {
            Schema::table('leads', function (Blueprint $table) {
                $table->timestamp('email_verified_at')->nullable()->after('consent_text');
            });
        }

        // Add verification_token if missing
        if (!Schema::hasColumn('leads', 'verification_token')) {
            Schema::table('leads', function (Blueprint $table) {
                $table->string('verification_token', 64)->nullable()->after('email_verified_at');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn([
                'guest_score_id',
                'ip_address',
                'consent_given',
                'consent_text',
                'email_verified_at',
                'verification_token',
            ]);
        });
    }
};
