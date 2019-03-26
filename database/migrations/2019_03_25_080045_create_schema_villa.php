<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSchemaVilla extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('block', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('block_number', 5);
            $table->string('created_by', 64);
            $table->string('updated_by', 64)->nullable();
            $table->string('deleted_by', 64)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('house', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('house_number', 5);
            $table->integer('length')->default(0);
            $table->integer('width')->default(0);
            $table->string('created_by', 64);
            $table->string('updated_by', 64)->nullable();
            $table->string('deleted_by', 64)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('block');
            $table->foreign('block')->references('id')->on('block');
        });

        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('people_identification_number', 64);
            $table->string('name', 64);
            $table->string('place_of_birth', 64)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('phone_number',16)->nullable();
            $table->string('created_by', 64);
            $table->string('updated_by', 64)->nullable();
            $table->string('deleted_by', 64)->nullable();
            $table->enum('status_in_family', ['mertua','suami','istri','anak']);
            $table->enum('marriage_status', ['belum_kawin','kawin','cerai']);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('family_card', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('family_identification_number', 64);
            $table->string('created_by', 64);
            $table->string('updated_by', 64)->nullable();
            $table->string('deleted_by', 64)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('head_of_family');
            $table->foreign('head_of_family')->references('id')->on('people');
        });

        Schema::create('citizen', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('people_ids', 128)->nullable();
            $table->string('updated_by', 64)->nullable();
            $table->string('deleted_by', 64)->nullable();
            $table->enum('status_in_house', ['kosong', 'belum_terjual', 'di_sewakan', 'pemilik']);
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('house_holder');
            $table->foreign('house_holder')->references('id')->on('people');
            $table->unsignedBigInteger('house_id');
            $table->foreign('house_id')->references('id')->on('house');
        });

        Schema::create('category_income', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',128);
            $table->boolean('is_mandatory');
            $table->integer('minimum_payment')->default(0);
            $table->string('created_by', 64);
            $table->string('updated_by', 64)->nullable();
            $table->string('deleted_by', 64)->nullable();
            $table->boolean('display_public')->default(false);
            $table->unsignedBigInteger('house_id');
            $table->foreign('house_id')->references('id')->on('house');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('income', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('amount')->default(0);
            $table->string('created_by', 64);
            $table->string('updated_by', 64)->nullable();
            $table->string('deleted_by', 64)->nullable();
            $table->boolean('display_public')->default(false);
            $table->boolean('is_late')->default(false);
            $table->unsignedBigInteger('house_id');
            $table->foreign('house_id')->references('id')->on('house');
            $table->unsignedBigInteger('category_income_id');
            $table->foreign('category_income_id')->references('id')->on('category_income');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('category_expense', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name',128);
            $table->string('created_by', 64);
            $table->string('updated_by', 64)->nullable();
            $table->string('deleted_by', 64)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('expense', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('amount')->default(0);
            $table->string('created_by', 64);
            $table->string('updated_by', 64)->nullable();
            $table->string('deleted_by', 64)->nullable();
            $table->unsignedBigInteger('category_expense_id');
            $table->foreign('category_expense_id')->references('id')->on('category_expense');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('block');
        Schema::dropIfExists('house');
        Schema::dropIfExists('people');
        Schema::dropIfExists('family_card');
        Schema::dropIfExists('citizen');
        Schema::dropIfExists('category_income');
        Schema::dropIfExists('Income');
        Schema::dropIfExists('category_expense');
        Schema::dropIfExists('expense');
    }
}
