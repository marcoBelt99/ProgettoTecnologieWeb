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
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        Comment::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $MAX_COMMENTS_NUMBER = 100;

        $textComment = [
            'Bellissima Iniziativa Complimenti', 
            'Io ho donato e ne sono felice!', 
            'Spero raggiungiante l\'obbiettivo',
            'Io ho donato!',
            'Bellissima iniziattiva!',
            'Bellissima idea!',
            'Bella idea!'
        ];
        
        for($i = 0; $i < $MAX_COMMENTS_NUMBER; $i++){
            Comment::create([
                'text' => $textComment[rand(0, count($textComment)-1)],
                'user_id' => rand(2, 51),
                'fundraiser_id' => rand(1,9)
            ]);
        }
        
    }
}
