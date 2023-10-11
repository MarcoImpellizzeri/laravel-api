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
        Schema::table('projects', function (Blueprint $table) {
            // type_id

            // creao una colonna di tipo unsignedBigInteger
            $table->unsignedBigInteger('type_id')->nullable()->after('image');

            // rendo la colonna type_id una foreign key
            $table->foreign('type_id')
                ->references('id')
                ->on('projects')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            // rimuoviamo la foreign key
            $table->dropForeign("projects_type_id_foreign");

            // si rimuove la colonna type_id
            $table->dropColumn('type_id');
        });
    }
};
