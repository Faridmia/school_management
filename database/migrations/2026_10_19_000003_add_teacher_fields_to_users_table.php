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
            if (!Schema::hasColumn('users', 'marital_status')) {
                $table->string('marital_status', 50)->nullable()->after('gender');
            }
            if (!Schema::hasColumn('users', 'date_of_joining')) {
                $table->date('date_of_joining')->nullable()->after('date_of_birth');
            }
            if (!Schema::hasColumn('users', 'permanent_address')) {
                $table->text('permanent_address')->nullable()->after('address');
            }
            if (!Schema::hasColumn('users', 'qualification')) {
                $table->text('qualification')->nullable()->after('permanent_address');
            }
            if (!Schema::hasColumn('users', 'work_experience')) {
                $table->text('work_experience')->nullable()->after('qualification');
            }
            if (!Schema::hasColumn('users', 'note')) {
                $table->text('note')->nullable()->after('work_experience');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $columns = [
                'marital_status',
                'date_of_joining',
                'permanent_address',
                'qualification',
                'work_experience',
                'note',
            ];
            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
