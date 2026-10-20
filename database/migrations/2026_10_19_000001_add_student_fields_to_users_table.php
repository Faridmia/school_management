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
            if (!Schema::hasColumn('users', 'last_name')) {
                $table->string('last_name')->nullable()->after('name');
            }
            if (!Schema::hasColumn('users', 'admission_number')) {
                $table->string('admission_number', 50)->nullable()->after('remember_token');
            }
            if (!Schema::hasColumn('users', 'roll_number')) {
                $table->string('roll_number', 50)->nullable()->after('admission_number');
            }
            if (!Schema::hasColumn('users', 'class_id')) {
                $table->integer('class_id')->nullable()->after('roll_number');
            }
            if (!Schema::hasColumn('users', 'gender')) {
                $table->string('gender', 50)->nullable()->after('class_id');
            }
            if (!Schema::hasColumn('users', 'date_of_birth')) {
                $table->date('date_of_birth')->nullable()->after('gender');
            }
            if (!Schema::hasColumn('users', 'caste')) {
                $table->string('caste', 50)->nullable()->after('date_of_birth');
            }
            if (!Schema::hasColumn('users', 'religion')) {
                $table->string('religion', 50)->nullable()->after('caste');
            }
            if (!Schema::hasColumn('users', 'mobile_number')) {
                $table->string('mobile_number', 15)->nullable()->after('religion');
            }
            if (!Schema::hasColumn('users', 'admission_date')) {
                $table->date('admission_date')->nullable()->after('mobile_number');
            }
            if (!Schema::hasColumn('users', 'profile_pic')) {
                $table->string('profile_pic', 100)->nullable()->after('admission_date');
            }
            if (!Schema::hasColumn('users', 'blood_group')) {
                $table->string('blood_group', 10)->nullable()->after('profile_pic');
            }
            if (!Schema::hasColumn('users', 'height')) {
                $table->string('height', 10)->nullable()->after('blood_group');
            }
            if (!Schema::hasColumn('users', 'weight')) {
                $table->string('weight', 10)->nullable()->after('height');
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
                'last_name',
                'admission_number',
                'roll_number',
                'class_id',
                'gender',
                'date_of_birth',
                'caste',
                'religion',
                'mobile_number',
                'admission_date',
                'profile_pic',
                'blood_group',
                'height',
                'weight',
            ];
            foreach ($columns as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
