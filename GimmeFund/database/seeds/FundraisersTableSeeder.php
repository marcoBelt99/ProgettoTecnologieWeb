<?php

use Illuminate\Database\Seeder;
use App\Fundraiser;

class FundraisersTableSeeder extends Seeder
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


        $fundraiser1 = Fundraiser::create([
            'name' => 'Più forti insieme per gli ospedali di Bologna',
            'description' => 'IMPORTANTE: PRIMA DI DONARE LEGGI BENE QUANTO SEGUE E IL PRIMO AGGIORNAMENTO SOTTO!
            È un momento difficile per tutti, mai come oggi l’unione deve fare la forza. Amo Bologna, la mia Città, e vorrei dare il mio contributo come penso anche tutti voi. Sono stato contattato da Fondazione Sant’Orsola e Policlinico di Sant’Orsola che ieri hanno lanciato la campagna “più forti INSIEME” e ho deciso di devolvere a loro tutto quello che insieme riusciremo a raccogliere per sostenere gli ospedali e il personale in prima linea nell’emergenza Coronavirus. Sarà mia premura tenervi informati sull’esito della donazione e condividere con voi la Lettera che invierò alla Fondazione al momento della donazione.',
            'starting_date' => '2020-01-30',
            'ending_date' => '2022-01-30',
            'media_url' => 'https://images.gofundme.com/iUAI5wfF6U96vfdxTetXqlDgo9o=/720x405/https://d2g8igdw686xgo.cloudfront.net/46044960_1583830987419996_r.jpg',
            'goal' => 2000000.00,
            'user_id' => rand(2,51),
            'category_id' => 13,
        ]);

        $fundraiser2 = Fundraiser::create([
            'name' => 'Regaliamo a Martina un futuro',
            'description' => 'Un percorso di vita interrotto da un tragico incidente, due vite spezzate all\'improvviso senza un motivo, che lasciano un vuoto incolmabile.
            Fabry e Vale stavano costruendo, programmando e progettando un futuro radioso per la loro famiglia e la loro bambina, Martina.
            Questa raccolta nasce per continuare a perseguire la missione di vita di Fabry e Vale, regalare a Martina un futuro felice esattamente come i due genitori avrebbero voluto fosse.
            Tutto il ricavato verrà devoluto alla famiglia ed utilizzato per sostenere la figlia della coppia, Martina, nel suo percorso di vita. Servirà per aiutarla ad avere il miglior supporto per affrontare questa situazione ed un futuro migliore.
            L\'invio della somma sarà documentato e postato sui social, così da dimostrare la buonafede di questa raccolta nata velocemente per far fronte a questa triste tragedia',
            'starting_date' => '2020-05-30',
            'ending_date' => '2022-07-30',
            'media_url' => 'https://images.gofundme.com/UTo_8ZAhwkJroA-yyPhuv2VgvOY=/720x405/https://d2g8igdw686xgo.cloudfront.net/54325528_1612176346474376_r.jpeg',
            'goal' => 20000.00,
            'user_id' => rand(2,51),
            'category_id' => 11,
        ]);
        
        $fundraiser3 = Fundraiser::create([
            'name' => 'Aiutiamo il piccolo Davide',
            'description' => 'Salve siamo i genitori di Davide Spinello papà Fabio mamma Veronica
            Davide è un bimbo meraviglioso di 2 anni affetto da SMA 1 atrofia muscolare spinale la forma più grave della malattia
            Questa patologia intacca i motoneuroni e quindi ha difficoltà a respirare a deglutire e ad avere il controllo del capo e del tronco
            Chiediamo un aiuto a tutti voi con questa raccolta fondi per poter andare all estero a somministrare un farmaco chiamato Zolgensma terapia genica che potrebbe dare una nuova speranza al nostro piccolo
            È un farmaco di una sola somministrazione che va a modificare il gene difettoso e correggerlo modificando l evolversi della malattia migliorando lo stile di vita e aiuterà ad avere a nostro figlio una vita più dignitosa come meritano tutti i bimbi come lui
            Questo farmaco in Italia ancora non è accessibile per bimbi al di sopra dei 6 mesi come invece in altri stati europei che lo somministrano a bimbi con peso fino ai 21 kg criteri approvati dall EMA per l Unione Europea 
            Non possiamo più aspettare perché la malattia di nostro figlio avanza e intanto cresce di peso 
            Aiutateci a dare una speranza in più al nostro piccolo grande guerriero
            Grazie',
            'starting_date' => '2020-01-25',
            'ending_date' => '2022-04-30',
            'media_url' => 'https://images.gofundme.com/-ecGvsFfFg1tlLSLrwVTfQGPG5c=/720x405/https://d2g8igdw686xgo.cloudfront.net/54327046_1612189901425863_r.jpg',
            'goal' => 100000.00,
            'user_id' => rand(2,51),
            'category_id' => 14,
        ]);

        $fundraiser4 = Fundraiser::create([
            'name' => 'Una speranza per Stefano',
            'description' => 'Ciao a tutti,
            siamo Daniele e Alessia, i genitori di Stefano, un bimbo di quasi 2 anni affetto da una rara malattia genetica: la SMA di Tipo 1, la forma più grave.
            
            L\'Atrofia muscolare spinale è una malattia neuromuscolare degenerativa che colpisce tutti i muscoli del corpo.
            Per questo motivo Stefano non cammina, non sta seduto, ha problemi respiratori e di deglutizione, infatti si alimenta tramite PEG.
            Nonostante tutto è un bambino sorridente, intelligente, tenace e con moltissima voglia di vivere e combattere: un vero guerriero.
            
            La sua qualità di vita potrebbe migliorare tramite la somministrazione del farmaco ZOLGENSMA, il quale fornisce una copia funzionante del gene difettoso (che comporta la malattia).
            
            In Italia, al momento, è possibile somministrare questo farmaco ai bambini fino ai 6 mesi a differenza degli altri paesi europei il cui criterio per la sua somministrazione si basa sul peso corporeo (21 Kg). Stefano quindi è ESCLUSO, come tanti altri bambini!
            
            Zolgensma è l\'unica terapia genica attualmente esistente per questa malattia, e purtroppo anche la più cara: la singola somministrazione costa 2.100.000 dollari.
            
            Abbiamo deciso, quindi, di aprire questa raccolta fondi: partire all\'estero e far somministrare il farmaco a pagamento al nostro guerriero.
            
            Grazie a tutti coloro che vorranno contribuire per...un futuro per Stefano!',
            'starting_date' => '2020-05-30',
            'ending_date' => '2021-05-30',
            'media_url' => 'https://images.gofundme.com/-xvtqXD4PSBK8YUMkc26UjrIwyI=/720x405/https://d2g8igdw686xgo.cloudfront.net/54334192_1612208662585349_r.jpeg',
            'goal' => 250000.00,
            'user_id' => rand(2,51),
            'category_id' => 5,
        ]);

        $fundraiser5 = Fundraiser::create([
            'name' => 'Sogno a rotelle',
            'description' => 'Questa raccolta è dedicata a Antonio Nocitra è stata creata e voluta dai suoi amici d\'infanzia di Pioltello, in collaborazione con Associazione "Diversi DA CHI Appha" (intestataria del conto dove arriveranno le donazioni), che ha sede a Pioltello (MI).
            Chi è Tony? E\'un ragazzo di quarant\'anni che è stato il nostro compagno di giochi e di vita, siamo cresciuti insieme a Pioltello, un paese dell\'hinterland milanese.
            Sono passati trent\'anni da quei momenti adolescenziali e mentre le nostre vite hanno avuto un corso normale, iniziando da un banale dolore alle punte dei piedi, nella vita di Tony è sceso un lungo e freddo inverno. Lenta ed inesorabile è arrivata la malattia: TETRAPARESI CON DEFICIT DI FORZA GRAVE.
            Tony rimane un uomo sereno, sostenuto costantemente dal padre, positivo, ottimista e sempre disposto a sorridere alla vita. 
            La sua indipendenza dipende da una sedia a rotelle e noi vorremo regalargli la migliore possibile, in modo da garantirli libertà di movimento in paese e con il migliore comfort, vorremmo comprargli una "supercar" in modo da renderlo più libero.
            Se sei arrivato fino a qui il passo successivo, potrebbe essere una tua piccola donazione.
            Antonio è nato il 23 luglio 1976 a Pioltello, dove continua a vivere, con la sua famiglia.',
            'starting_date' => '2020-02-10',
            'ending_date' => '2021-08-24',
            'media_url' => 'https://images.gofundme.com/ej6akNy_9KP8uy3psTksq2KbkcI=/720x405/https://d2g8igdw686xgo.cloudfront.net/54197406_161168189363735_r.jpeg',
            'goal' => 50000.00,
            'user_id' => rand(2,51),
            'category_id' => 14,
        ]);

        $fundraiser6 = Fundraiser::create([
            'name' => 'In memoria di Marco',
            'description' => 'Il dolore della perdita di Marco non spegnerà il ricordo del suo sorriso contagioso, della sua allegria e della sua gentilezza, oltre che della grande professionalità. Un collega e un amico che avrà sempre un posto speciale nel cuore di tutti noi.

            Tutti insieme in Lippert Components vogliamo aiutare la famiglia di Marco ad affrontare questo momento difficile stando loro vicino anche se da lontano, come possiamo.
            
            Raccogliamo fondi, a sostegno della moglie Olimpia e della piccola Giorgia.
            Ogni piccolo gesto è un grande regalo per il loro futuro.',
            'starting_date' => '2020-03-30',
            'ending_date' => '2022-01-22',
            'media_url' => 'https://images.gofundme.com/GhRLPT2LqWhNXV6iAaSgF4f8vrQ=/720x405/https://d2g8igdw686xgo.cloudfront.net/47045586_1585586810297238_r.jpeg',
            'goal' => 25000.00,
            'user_id' => rand(2,51),
            'category_id' => 5,
        ]);

        $fundraiser7 = Fundraiser::create([
            'name' => 'Raccolta per la famiglia di Fabio',
            'description' => 'Non lo so',
            'starting_date' => '2020-03-30',
            'ending_date' => '2022-01-22',
            'media_url' => 'https://images.gofundme.com/GhRLPT2LqWhNXV6iAaSgF4f8vrQ=/720x405/https://d2g8igdw686xgo.cloudfront.net/47045586_1585586810297238_r.jpeg',
            'goal' => 150000.00,
            'user_id' => rand(2,51),
            'category_id' => 5,
        ]);

        // RACCOLTA FONDI DI PROVA
        $fundraiser7 = Fundraiser::create([
            'name' => 'Raccolta Fondi TEST',
            'description' => 'TEST',
            'starting_date' => '2020-01-01',
            'ending_date' => '2021-01-22',
            'media_url' => 'https://images.gofundme.com/GhRLPT2LqWhNXV6iAaSgF4f8vrQ=/720x405/https://d2g8igdw686xgo.cloudfront.net/47045586_1585586810297238_r.jpeg',
            'goal' => 150000.00,
            'user_id' => rand(2,51),
            'category_id' => 5,
        ]);
    }
}