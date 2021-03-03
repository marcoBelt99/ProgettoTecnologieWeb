<?php

use Illuminate\Database\Seeder;
use App\Comment;

class CommentssTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Fundraiser::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');


        $comment1 = Comment::create([
            'text' => 'prova',
            'date' => '2021-03-03',
            'user_id' => rand(2,51),
            'category_id' => 1,

        ]);

        $comment2 = Comment::create([
            'text' => 'djeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee',
            'date' => '2021-02-25',
            'user_id' => rand(2,51),
            'category_id' => 2,
        ]);


        
    }
}