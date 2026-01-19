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
        Schema::table('transactions', function (Blueprint $table) {
            if (! Schema::hasColumn('transactions', 'transaction_code')) {
                $table->string('transaction_code')->unique()->nullable()->after('id');
            }

            if (! Schema::hasColumn('transactions', 'user_id')) {
                $table->foreignId('user_id')->nullable()->constrained()->after('transaction_code');
            }

            if (! Schema::hasColumn('transactions', 'total_price')) {
                $table->bigInteger('total_price')->default(0)->after('user_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            if (Schema::hasColumn('transactions', 'total_price')) {
                $table->dropColumn('total_price');
            }

            if (Schema::hasColumn('transactions', 'user_id')) {
                $table->dropForeign(['user_id']);
                $table->dropColumn('user_id');
            }

            if (Schema::hasColumn('transactions', 'transaction_code')) {
                $table->dropUnique(['transaction_code']);
                $table->dropColumn('transaction_code');
            }
        });
    }
};
