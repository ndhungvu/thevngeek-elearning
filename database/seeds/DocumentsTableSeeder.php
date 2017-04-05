<?php

use Illuminate\Database\Seeder;
use App\Document;

class DocumentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->documents();
    }

    public function documents()
    {
//        \DB::table('documents')->truncate();
        factory(Document::class, 10)->create();
    }
}
