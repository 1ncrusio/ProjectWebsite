<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAlatTableChangeStatusToIdStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alat', function (Blueprint $table) {
            // Drop the existing status column
            $table->dropColumn('status');

            // Add the id_status column and set it as a foreign key
            $table->unsignedBigInteger('id_status')->nullable();

            $table->foreign('id_status')->references('id_status')->on('status_alat')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alat', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['id_status']);

            // Drop the id_status column
            $table->dropColumn('id_status');

            // Add the status column back
            $table->enum('status', ['offline', 'online']);
        });
    }
}
