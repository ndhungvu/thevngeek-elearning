<?php

use Illuminate\Database\Seeder;
use App\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->comments();
    }

    public function comments()
    {
//      \DB::table('comments')->truncate();
        factory(Comment::class, 10)->create();
    }
}
