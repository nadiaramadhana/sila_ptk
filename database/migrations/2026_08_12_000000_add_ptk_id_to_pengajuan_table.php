<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            $table->bigInteger('ptk_id')
                ->nullable()
                ->after('user_id')
                ->index();

            $table->foreign('ptk_id')
                ->references('id')
                ->on('data_ptk')
                ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('pengajuan', function (Blueprint $table) {
            $table->dropForeign(['ptk_id']);
            $table->dropColumn('ptk_id');
        });
    }
};
