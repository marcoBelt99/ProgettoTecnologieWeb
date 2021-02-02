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
        Category::truncate();
     
        $categories = [
            'Altro',
            'Animali e animali domestici',
            'Arte, musica e film creativi',
            'Aziende ed imprenditori',
            'Bambini, ragazzi e famiglie',
            'Celebrazioni ed eventi',
            'Competizioni e spettacoli',
            'Comunità e quartieri',
            'Funerali e commemorazioni',
            'Incidenti ed emergenze',
            'Istruzione',
            'Matrimoni e lune di miele',
            'Missioni, religioni e chiese',
            'Settore medico, malattie e guarigione',
            'Sogni, speranze e desideri',
            'Sport, squadra e club',
            'Viaggi e avventure',
            'Volontariato e servizi'
        ];

        foreach($categories as $c) {
            DB::table('categories')->insert([
                'name' => $c,
                'updated_at' => date('Y-m-d h:i:s'),
                'created_at' => date('Y-m-d h:i:s')
            ]);
        }
    }
}
