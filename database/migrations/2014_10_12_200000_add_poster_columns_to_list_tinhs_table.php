<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPosterColumnsToListTinhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('list_tinhs', function (Blueprint $table) {
            $table->boolean('poster')->nullable()->default(null)->after('order');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('list_tinhs', function (Blueprint $table) {
            $table->dropColumn('poster');
        });
    }
}
