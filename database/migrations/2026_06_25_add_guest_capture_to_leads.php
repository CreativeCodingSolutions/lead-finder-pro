<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            if (!Schema::hasColumn('leads', 'ip_address')) {
                $table->string('ip_address', 45)->nullable()->after('website_valid');
            }
            if (!Schema::hasColumn('leads', 'consent_given')) {
                $table->boolean('consent_given')->default(false)->after('ip_address');
            }
            if (!Schema::hasColumn('leads', 'consent_text')) {
                $table->text('consent_text')->nullable()->after('consent_given');
            }
            if (!Schema::hasColumn('leads', 'email_verified_at')) {
                $table->timestamp('email_verified_at')->nullable()->after('consent_text');
            }
            if (!Schema::hasColumn('leads', 'verification_token')) {
                $table->string('verification_token', 64)->nullable()->after('email_verified_at');
            }
        });

        // Guest Scores table — stores demo search sessions as "scores"
        if (!Schema::hasTable('guest_scores')) {
            Schema::create('guest_scores', function (Blueprint $table) {
                $table->id();
                $table->string('uuid')->unique();
                $table->string('url')->nullable();  // landing page URL context
                $table->string('industry_name')->nullable();
                $table->string('city')->nullable();
                $table->string('country', 2)->nullable();
                $table->integer('lead_count');  // how many leads found in demo
                $table->tinyInteger('score');   // calculated "data quality score"
                $table->json('sample_leads');   // store the sample lead data
                $table->string('ip_address', 45)->nullable();
                $table->boolean('lead_captured')->default(false);
                $table->timestamps();

                $table->index('uuid');
                $table->index('created_at');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('guest_scores');
        // No rollback on leads columns — additive only
    }
};
