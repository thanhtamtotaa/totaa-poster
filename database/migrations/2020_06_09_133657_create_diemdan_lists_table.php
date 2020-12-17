<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Totaa\TotaaPoster\Models\DiaDiem\DiaDiem_PhanLoai;
use Totaa\TotaaDonvi\Models\TotaaXa;
use Totaa\TotaaBfo\Models\BfoInfo;

class CreateDiemDanListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diemdan_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tendiadiem', 255);
            $table->string('phone')->nullable()->default(null);
            $table->bigInteger('loaidiadiem_id')->unsigned()->nullable()->default(null);
            $table->string('chudiadiem', 255)->nullable()->default(null);
            $table->bigInteger('xa_id')->unsigned()->nullable()->default(null);
            $table->string('diachi')->nullable()->default(null);
            $table->longText('thongtinkhac')->nullable()->default(null);
            $table->string('belongto_mnv', 10)->nullable()->default(null);
            $table->string('created_by_mnv', 10)->nullable()->default(null);
            $table->boolean('active')->nullable()->default(null);
            $table->unsignedBigInteger('created_by')->nullable()->default(null);
            $table->unsignedBigInteger('updated_by')->nullable()->default(null);
            $table->unsignedBigInteger('deleted_by')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            if (class_exists(DiaDiem_PhanLoai::class)) {
                $table->foreign('loaidiadiem_id')->references('id')->on(with(new DiaDiem_PhanLoai)->getTable())->onDelete('SET NULL')->onUpdate('cascade');
            }

            if (class_exists(TotaaXa::class)) {
                $table->foreign('xa_id')->references('id')->on(with(new TotaaXa)->getTable())->onDelete('SET NULL')->onUpdate('cascade');
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
        Schema::dropIfExists('diemdan_lists');
    }
}
