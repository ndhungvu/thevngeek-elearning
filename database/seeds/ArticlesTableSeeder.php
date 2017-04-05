<?php

use Illuminate\Database\Seeder;
use App\Article;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->articles();
    }

    public function articles()
    {
//      \DB::table('articles')->truncate();
        factory(Article::class, 10)->create();
    }
}
