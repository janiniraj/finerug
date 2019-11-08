<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function($table) {
            $table->string('subcategory_id')->nullable()->after('category_id');
            $table->string('sku')->nullable()->after('name');
            $table->string('brand')->nullable()->after('name');
            $table->text('detail')->nullable()->after('name');
            $table->string('length')->nullable()->after('brand');
            $table->string('width')->nullable()->after('brand');
            $table->integer('style_id')->nullable()->after('brand');
            $table->integer('material_id')->nullable()->after('brand');
            $table->integer('weave_id')->nullable()->after('brand');
            $table->integer('color_id')->nullable()->after('brand');
            $table->integer('border_color_id')->nullable()->after('brand');
            $table->string('shape')->nullable()->after('brand');
            $table->string('foundation')->nullable()->after('brand');
            $table->string('knote_per_sq')->nullable()->after('brand');
            $table->text('shop')->nullable()->after('brand');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
