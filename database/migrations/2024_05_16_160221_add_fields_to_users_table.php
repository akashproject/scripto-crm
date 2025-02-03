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
            //
            $table->string('mobile',20)->after('password');
            $table->string('featured_image')->nullable()->after('mobile');
            $table->enum('status', ['0', '1'])->default('1')->after('remember_token');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            //
            $table->dropColumn('mobile');
            $table->dropColumn('featured_image');
            $table->dropColumn('status');
        });
    }
};
