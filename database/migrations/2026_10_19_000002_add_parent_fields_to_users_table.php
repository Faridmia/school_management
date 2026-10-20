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
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'parent_id')) {
                $table->integer('parent_id')->nullable()->after('remember_token');
            }
            if (!Schema::hasColumn('users', 'occupation')) {
                $table->string('occupation', 255)->nullable()->after('gender');
            }
            if (!Schema::hasColumn('users', 'address')) {
                $table->string('address', 255)->nullable()->after('occupation');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = ['parent_id', 'occupation', 'address'];
            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
