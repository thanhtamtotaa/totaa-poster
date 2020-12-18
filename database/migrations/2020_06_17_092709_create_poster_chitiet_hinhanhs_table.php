<?php

use Totaa\TotaaBfo\Models\BfoInfo;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Totaa\TotaaPoster\Models\Poster\Poster_ChiTiet;

class CreatePosterChitietHinhanhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poster_chitiet_hinhanhs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('poster_chitiet_id')->unsigned()->nullable()->default(null);
            $table->longText('totaa_file_id')->nullable()->default(null);
            $table->boolean('active')->nullable()->default(null);
            $table->string('belongto_mnv', 10)->nullable()->default(null);
            $table->string('created_by_mnv', 10)->nullable()->default(null);
            $table->unsignedBigInteger('created_by')->nullable()->default(null);
            $table->unsignedBigInteger('updated_by')->nullable()->default(null);
            $table->unsignedBigInteger('deleted_by')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            if (class_exists(Poster_ChiTiet::class)) {
                $table->foreign('poster_chitiet_id')->references('id')->on(with(new Poster_ChiTiet)->getTable())->onDelete('SET NULL')->onUpdate('cascade');
            }

            if (class_exists(BfoInfo::class)) {
                $table->foreign('belongto_mnv')->references('mnv')->on(with(new BfoInfo)->getTable())->onDelete('SET NULL')->onUpdate('cascade');
                $table->foreign('created_by_mnv')->references('mnv')->on(with(new BfoInfo)->getTable())->onDelete('SET NULL')->onUpdate('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('poster_chitiet_hinhanhs');
    }
}
