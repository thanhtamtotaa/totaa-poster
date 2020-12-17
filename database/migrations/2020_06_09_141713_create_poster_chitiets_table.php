<?php

use Totaa\TotaaBfo\Models\BfoInfo;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Totaa\TotaaPoster\Models\Poster\Poster_List;
use Totaa\TotaaPoster\Models\Poster\Poster_BeMat;
use Totaa\TotaaPoster\Models\Poster\Poster_HinhThuc;

class CreatePosterChitietsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poster_chitiets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('poster_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('poster_hinhthuc_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('poster_bemat_id')->unsigned()->nullable()->default(null);
            $table->integer('ngang')->unsigned()->nullable();
            $table->integer('doc')->unsigned()->nullable();
            $table->longText('vitridan')->nullable()->default(null);
            $table->longText('ghichu')->nullable()->default(null);
            $table->boolean('active')->nullable()->default(null);
            $table->string('belongto_mnv', 10)->nullable()->default(null);
            $table->string('created_by_mnv', 10)->nullable()->default(null);
            $table->unsignedBigInteger('created_by')->nullable()->default(null);
            $table->unsignedBigInteger('updated_by')->nullable()->default(null);
            $table->unsignedBigInteger('deleted_by')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            if (class_exists(Poster_List::class)) {
                $table->foreign('poster_id')->references('id')->on(with(new Poster_List)->getTable())->onDelete('SET NULL')->onUpdate('cascade');
            }

            if (class_exists(Poster_HinhThuc::class)) {
                $table->foreign('poster_hinhthuc_id')->references('id')->on(with(new Poster_HinhThuc)->getTable())->onDelete('SET NULL')->onUpdate('cascade');
            }

            if (class_exists(Poster_BeMat::class)) {
                $table->foreign('poster_bemat_id')->references('id')->on(with(new Poster_BeMat)->getTable())->onDelete('SET NULL')->onUpdate('cascade');
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
        Schema::dropIfExists('poster_chitiets');
    }
}
