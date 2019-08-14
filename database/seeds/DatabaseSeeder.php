<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
      // $this->call(UsersTableSeeder::class);

			// Creamos 10 usuarios FAKE
			$users = factory(App\User::class)->times(10)->create();
			// Creamos 7 marcas
			$brands = factory(App\Brand::class)->times(7)->create();
			// Creamos 7 categorías
			$categories = factory(App\Category::class)->times(7)->create();
			// Creamos 20 colores
			$colors = factory(App\Color::class)->times(20)->create();
			// Creamos 15 productos FAKE
			$products = factory(App\Product::class)->times(15)->create();

			foreach ($products as $oneProduct) {
				$oneProduct->user()->associate($users->random(1)->first()->id);
				$oneProduct->brand()->associate($brands->random(1)->first()->id);
				$oneProduct->category()->associate($categories->random(1)->first()->id);
				$oneProduct->save();

				// Muchos a muchos (Tabla pivot)
				$oneProduct->colors()->sync($colors->random(3));
			}
    }
}
