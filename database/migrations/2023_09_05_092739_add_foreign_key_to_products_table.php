<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }
    
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
};
