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
        /** 
         * We remove this unit constraint to simplify 
         * development on a dev environment.
         */
        if (app()->isProduction()) {
            return;
        }

        Schema::table('clips', function (Blueprint $table) {
            $table->dropUnique('clips_external_id_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (app()->isProduction()) {
            return;
        }

        Schema::table('clips', function (Blueprint $table) {
            $table->unique('external_id');
        });
    }
};
