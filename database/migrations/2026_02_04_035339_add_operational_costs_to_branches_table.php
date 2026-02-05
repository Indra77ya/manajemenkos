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
        Schema::table('branches', function (Blueprint $table) {
            $table->decimal('cost_wifi', 15, 2)->nullable()->after('cost');
            $table->decimal('cost_water', 15, 2)->nullable()->after('cost_wifi');
            $table->decimal('cost_electricity', 15, 2)->nullable()->after('cost_water');
            $table->decimal('cost_other', 15, 2)->nullable()->after('cost_electricity');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->dropColumn(['cost_wifi', 'cost_water', 'cost_electricity', 'cost_other']);
        });
    }
};
