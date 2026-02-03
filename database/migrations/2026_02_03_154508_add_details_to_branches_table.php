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
            $table->string('code')->after('name');
            $table->string('manager_name')->after('address');
            $table->string('assistant_1_name')->nullable()->after('manager_name');
            $table->string('assistant_2_name')->nullable()->after('assistant_1_name');
            $table->string('phone')->nullable()->after('assistant_2_name');
            $table->string('manager_phone')->nullable()->after('phone');
            $table->decimal('cost', 15, 2)->default(0)->after('manager_phone');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('branches', function (Blueprint $table) {
            $table->dropColumn([
                'code',
                'manager_name',
                'assistant_1_name',
                'assistant_2_name',
                'phone',
                'manager_phone',
                'cost'
            ]);
        });
    }
};
