<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->categories();
    }

    public function categories()
    {
//        \DB::table('categories')->truncate();
        $faker = Faker\Factory::create();

        factory(Category::class, 10)->create();

        Category::first()->update([
            'parent' => $faker->randomElement(Category::pluck('id')->toArray()),
        ]);
    }
}
