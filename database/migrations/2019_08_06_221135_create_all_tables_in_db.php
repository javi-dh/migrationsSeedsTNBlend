<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAllTablesInDb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
			Schema::create('brands', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->string('name'); // varchar 250
				$table->timestamps();
			});

			Schema::create('categories', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->string('name'); // varchar 250
				$table->timestamps();
			});

			Schema::create('colors', function (Blueprint $table) {
				$table->bigIncrements('id');
				$table->string('name'); // varchar 250
				$table->timestamps();
			});

      Schema::create('products', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('name'); // varchar 250
        $table->text('description'); // text
        $table->decimal('price', 8, 2); // 999.999.99
				// Foreign Key (Para crear una FK es necesario que previamente la tabla a la que hacemos referencia exista)
				$table->unsignedBigInteger('user_id')->nullable();
    		$table->foreign('user_id')->references('id')->on('users');

				$table->unsignedBigInteger('brand_id')->nullable();
    		$table->foreign('brand_id')->references('id')->on('brands');

				$table->unsignedBigInteger('category_id')->nullable();
    		$table->foreign('category_id')->references('id')->on('categories');

        $table->timestamps();
      });

			Schema::create('color_product', function (Blueprint $table) {
				$table->bigIncrements('id');

				$table->unsignedBigInteger('color_id')->nullable();
    		$table->foreign('color_id')->references('id')->on('colors');

				$table->unsignedBigInteger('product_id')->nullable();
    		$table->foreign('product_id')->references('id')->on('products');

				$table->timestamps();
			});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
			Schema::table('color_product', function (Blueprint $table) {
				$table->dropForeign('color_id');
				$table->dropColumn('color_id');
				$table->dropForeign('product_id');
				$table->dropColumn('product_id');
      });
      Schema::dropIfExists('color_product');

			Schema::table('products', function (Blueprint $table) {
				$table->dropForeign('category_id');
				$table->dropColumn('category_id');
				$table->dropForeign('brand_id');
				$table->dropColumn('brand_id');
				$table->dropForeign('user_id');
				$table->dropColumn('user_id');
      });
			Schema::dropIfExists('products');

			Schema::dropIfExists('colors');
			Schema::dropIfExists('categories');
			Schema::dropIfExists('brands');
    }
}
