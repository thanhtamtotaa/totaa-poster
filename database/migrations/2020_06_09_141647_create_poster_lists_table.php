<?php

use Totaa\TotaaBfo\Models\BfoInfo;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Totaa\TotaaPoster\Models\Poster\Poster_Name;
use Totaa\TotaaPoster\Models\DiaDiem\DiaDiem_List;
use Totaa\TotaaPoster\Models\Poster\Poster_MucThuong;
use Totaa\TotaaPoster\Models\Poster\Poster_TrangThai;

class CreatePosterListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poster_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('poster_code', 10)->nullable()->default(null)->unique();
            $table->string('ma_hd', 40)->nullable()->default(null)->unique();
            $table->bigInteger('diadiem_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('poster_name_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('mucthuong_id')->unsigned()->nullable()->default(null);
            $table->bigInteger('trangthai_id')->unsigned()->nullable()->default(null);
            $table->boolean('active')->nullable()->default(null);
            $table->string('created_by_mnv', 10)->nullable()->default(null);
            $table->string('order_by_mnv', 10)->nullable()->default(null);
            $table->unsignedBigInteger('created_by')->nullable()->default(null);
            $table->unsignedBigInteger('updated_by')->nullable()->default(null);
            $table->unsignedBigInteger('deleted_by')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();

            if (class_exists(DiaDiem_List::class)) {
                $table->foreign('diadiem_id')->references('id')->on(with(new DiaDiem_List)->getTable())->onDelete('SET NULL')->onUpdate('cascade');
            }

            if (class_exists(BfoInfo::class)) {
                $table->foreign('created_by_mnv')->references('mnv')->on(with(new BfoInfo)->getTable())->onDelete('SET NULL')->onUpdate('cascade');
                $table->foreign('order_by_mnv')->references('mnv')->on(with(new BfoInfo)->getTable())->onDelete('SET NULL')->onUpdate('cascade');
            }

            if (class_exists(BfoInfo::class)) {
                $table->foreign('created_by_mnv')->references('mnv')->on(with(new BfoInfo)->getTable())->onDelete('SET NULL')->onUpdate('cascade');
                $table->foreign('order_by_mnv')->references('mnv')->on(with(new BfoInfo)->getTable())->onDelete('SET NULL')->onUpdate('cascade');
            }

            if (class_exists(Poster_Name::class)) {
                $table->foreign('poster_name_id')->references('id')->on(with(new Poster_Name)->getTable())->onDelete('SET NULL')->onUpdate('cascade');
            }

            if (class_exists(Poster_TrangThai::class)) {
                $table->foreign('trangthai_id')->references('id')->on(with(new Poster_TrangThai)->getTable())->onDelete('SET NULL')->onUpdate('cascade');
            }

            if (class_exists(Poster_MucThuong::class)) {
                $table->foreign('mucthuong_id')->references('id')->on(with(new Poster_MucThuong)->getTable())->onDelete('SET NULL')->onUpdate('cascade');
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
        Schema::dropIfExists('poster_lists');
    }
}
