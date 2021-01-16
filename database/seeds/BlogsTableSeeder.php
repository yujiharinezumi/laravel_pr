<?php

use Illuminate\Database\Seeder;
//Blogモデルを呼び出す
use App\Models\Blog;

class BlogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //第一引数はどのモデルを使うか、第二引数には幾つデータを作るのかを記載する
        factory(Blog::class,15)->create();
    }
}
