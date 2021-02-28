<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash; // Serve per avere le password cifrate
use App\User;
use App\Role;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /* Creo le 2 tabelle: una per i ruoli degli utenti (admin o utente generico), l'altra per gli utenti  */
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('role_user')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        /* Dichiaro ed inizializzo 2 variabili: una per l'admin, l'altra per lo user */
        $adminRole = Role::where('name', 'Admin')->first();
        $userRole = Role::where('name', 'User')->first();
        
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        // Creazione dell'utente admin
        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'email' => 'admin@gimmefund.com',
            'password' => Hash::make('password'),
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user1 = User::create([
            'first_name' => 'Davide', 
            'last_name' => 'Zanellato',
            'email' => 'davide@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Enrico Fermi, 299',
            'city' => 'Taglio di Po',
            'CAP' => '45019',
            'phone_number' => '3472460103',
            'birthday' => '1999-11-29',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user2 = User::create([
            'first_name' => 'Marco', 
            'last_name' => 'Beltrame',
            'email' => 'marco@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Domenico Sampieri, 74',
            'city' => 'Adria',
            'CAP' => '45011',
            'points' => 0,
            'phone_number' => '3403183848',
            'birthday' => '1999-08-30',
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user3 = User::create([
            'first_name' => 'Francesco', 
            'last_name' => 'Sindaco',
            'email' => 'francesco@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Domenico Sampieri, 139/A',
            'city' => 'Adria',
            'CAP' => '45011',
            'phone_number' => '3206479281',
            'birthday' => '1999-04-28',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user4 = User::create([
            'first_name' => 'Enrico',
            'last_name' => 'Bregoli',
            'email' => 'enrico@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via dei Bersaglieri, 4',
            'city' => 'Taglio di Po',
            'CAP' => '45019',
            'phone_number' => '3338087889',
            'birthday' => '1999-06-18',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user5 = User::create([
            'first_name' => 'Giulia',
            'last_name' => 'Russo',
            'email' => 'giulia.russo@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Viale della Republica, 4',
            'city' => 'Matera',
            'CAP' => '75010',
            'phone_number' => '0314 5146879',
            'birthday' => '1969-07-11',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user6 = User::create([
            'first_name' => 'Candida',
            'last_name' => 'Pisano',
            'email' => 'CandidaPisano@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Nicolai, 82',
            'city' => 'Padavena',
            'CAP' => '32034',
            'phone_number' => '0341 9587872',
            'birthday' => '1975-09-10',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user7 = User::create([
            'first_name' => 'Ivana',
            'last_name' => 'Pugliesi',
            'email' => 'IvanaPugliesi@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Duomo, 36',
            'city' => 'Livorno',
            'CAP' => '57122',
            'phone_number' => '0372 1245041',
            'birthday' => '1952-06-03',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user8 = User::create([
            'first_name' => 'Rossana',
            'last_name' => 'Trevisano',
            'email' => 'rossanaTrevisano@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Tasso, 25',
            'city' => 'Ponticelli Città Della Pieve',
            'CAP' => '06060',
            'phone_number' => '0371 5239465',
            'birthday' => '1963-09-13',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user9 = User::create([
            'first_name' => 'Noemi',
            'last_name' => 'Esposito',
            'email' => 'noemiEsposito@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Giotto, 48',
            'city' => 'Roveredo di Gua',
            'CAP' => '37040',
            'phone_number' => '0319 9633501',
            'birthday' => '1940-10-08',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user10 = User::create([
            'first_name' => 'Eugenio',
            'last_name' => 'Fiorentino',
            'email' => 'eugenioFiorentino@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via del Carmine, 122',
            'city' => 'Nove',
            'CAP' => '36055',
            'phone_number' => '0391 8325930',
            'birthday' => '1980-06-18',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user11 = User::create([
            'first_name' => 'Ludovica',
            'last_name' => 'Toscano',
            'email' => 'ludovicaToscano@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Vipacco, 70',
            'city' => 'Tempio Pausania',
            'CAP' => '07029',
            'phone_number' => '0384 2689310',
            'birthday' => '1958-07-18',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);
        
        $user12 = User::create([
            'first_name' => 'Annibale',
            'last_name' => 'Pisani',
            'email' => 'annibalePisani@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Scuderlando, 70',
            'city' => 'Crognaleto',
            'CAP' => '64043',
            'phone_number' => '0327 5559929',
            'birthday' => '1994-02-19',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user13 = User::create([
            'first_name' => 'Bruto',
            'last_name' => 'Beneventi',
            'email' => 'brutoBeneventi@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via delle Mura Gianicolensi, 114',
            'city' => 'Casagiove',
            'CAP' => '81022',
            'phone_number' => '0382 1762721',
            'birthday' => '1995-03-13',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user14 = User::create([
            'first_name' => 'Gustava',
            'last_name' => 'Mazzanti',
            'email' => 'gustavaMazzanti@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Rosmini, 10',
            'city' => 'Dragonea',
            'CAP' => '84010',
            'phone_number' => '0315 6981443',
            'birthday' => '1963-08-13',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user15 = User::create([
            'first_name' => 'Lazzaro',
            'last_name' => 'Piccio',
            'email' => 'lazzaroPiccio@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Solfatara, 5',
            'city' => 'Refrancore',
            'CAP' => '14030',
            'phone_number' => '0331 3681445',
            'birthday' => '1990-09-28',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user16 = User::create([
            'first_name' => 'Elsa',
            'last_name' => 'Milano',
            'email' => 'elsaMilano@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Sacchi, 82',
            'city' => 'Bolladello',
            'CAP' => '21050',
            'phone_number' => '0329 4580674',
            'birthday' => '1964-03-15',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user17 = User::create([
            'first_name' => 'Prisco',
            'last_name' => 'Cremonesi',
            'email' => 'priscoCremonesi@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Piazza Trieste e Trento, 130',
            'city' => 'Mombarcaro',
            'CAP' => '12070',
            'phone_number' => '0313 1092927',
            'birthday' => '1989-02-16',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user18 = User::create([
            'first_name' => 'Elena',
            'last_name' => 'Padovano',
            'email' => 'elenaPadovano@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via del Carmine, 78',
            'city' => 'Montegalda',
            'CAP' => '36047',
            'phone_number' => '0318 3300416',
            'birthday' => '1951-12-20',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user19 = User::create([
            'first_name' => 'Alvisio',
            'last_name' => 'Sal',
            'email' => 'alvisioSal@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Antonio Beccadelli, 54',
            'city' => 'Melpignano',
            'CAP' => '73020',
            'phone_number' => '0331 3279575',
            'birthday' => '1943-11-12',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user20 = User::create([
            'first_name' => 'Licia',
            'last_name' => 'Romano',
            'email' => 'liciaRomano@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Bonafus Alfonso, 103',
            'city' => 'Cornino',
            'CAP' => '33030',
            'phone_number' => '0358 7977570',
            'birthday' => '1974-02-24',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user21 = User::create([
            'first_name' => 'Abelina',
            'last_name' => 'Napolitano',
            'email' => 'abelinaNapolitano@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via San Casmo fuori Porta Nuova, 126',
            'city' => 'Monza',
            'CAP' => '20052',
            'phone_number' => '0376 0438576',
            'birthday' => '1960-02-07',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user22 = User::create([
            'first_name' => 'Teodata',
            'last_name' => 'Siciliani',
            'email' => 'teodataSiciliani@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Strada Statale, 67',
            'city' => 'Fleccchia',
            'CAP' => '13867',
            'phone_number' => '0349 1561550',
            'birthday' => '1989-12-15',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user23 = User::create([
            'first_name' => 'Geraldino',
            'last_name' => 'Greece',
            'email' => 'geraldinoGreece@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Giacinto Gigante, 39',
            'city' => 'Piumazzo',
            'CAP' => '41010',
            'phone_number' => '0374 0640961',
            'birthday' => '1969-03-07',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user24 = User::create([
            'first_name' => 'Olimpia',
            'last_name' => 'Lorenzo',
            'email' => 'olimpiaLorenzo@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Nizza, 44',
            'city' => 'Postioma',
            'CAP' => '31040',
            'phone_number' => '0340 4355561',
            'birthday' => '1953-11-23',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user24 = User::create([
            'first_name' => 'Lara',
            'last_name' => 'Genovesi',
            'email' => 'laraGenovesi@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Torricelli, 21',
            'city' => 'Marcena',
            'CAP' => '38020',
            'phone_number' => '0315 3447277',
            'birthday' => '1968-02-28',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user25 = User::create([
            'first_name' => 'Nereo',
            'last_name' => 'Li Fonti',
            'email' => 'nereoLiFonti@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Antonio Beccadelli, 4',
            'city' => 'Surbo',
            'CAP' => '73010',
            'phone_number' => '0378 0458904',
            'birthday' => '2000-12-03',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user26 = User::create([
            'first_name' => 'Antonina',
            'last_name' => 'Boni',
            'email' => 'antoninaBoni@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Valpantena, 120',
            'city' => 'Atena Lucana Scalo',
            'CAP' => '84030',
            'phone_number' => '0311 4169819',
            'birthday' => '1992-05-09',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user27 = User::create([
            'first_name' => 'Candida',
            'last_name' => 'Fiorentini',
            'email' => 'candidaFiorentini@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Giulio Petroni, 26',
            'city' => 'Grumello Del Monte',
            'CAP' => '24064',
            'phone_number' => '0320 2828964',
            'birthday' => '1941-07-25',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user28 = User::create([
            'first_name' => 'Cirilla',
            'last_name' => 'Loggia',
            'email' => 'cirillaLoggia@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Partenope, 142',
            'city' => 'Montiano',
            'CAP' => '47020',
            'phone_number' => '0372 4879854',
            'birthday' => '1965-12-16',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user29 = User::create([
            'first_name' => 'Nicoletta',
            'last_name' => 'Lombardo',
            'email' => 'nicolettaLombardo@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Piazza Principe Umberto, 150',
            'city' => 'Firenze',
            'CAP' => '50122',
            'phone_number' => '0335 4012697',
            'birthday' => '1949-08-12',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user30 = User::create([
            'first_name' => 'Principio',
            'last_name' => 'Marchesi',
            'email' => 'principioMarchesi@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Santa Teresa degli Scalzi, 42',
            'city' => 'Calcarelli',
            'CAP' => '90020',
            'phone_number' => '0329 7410792',
            'birthday' => '1976-10-19',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user30 = User::create([
            'first_name' => 'Giacomo',
            'last_name' => 'Piva',
            'email' => 'giacomoPiva@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Corso Garibaldi, 128',
            'city' => 'Sant\'Oliva Di Pontecorvo, 128',
            'CAP' => '03030',
            'phone_number' => '0399 3586930',
            'birthday' => '1970-09-09',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user31 = User::create([
            'first_name' => 'Remigio',
            'last_name' => 'Sagese',
            'email' => 'remigioSagese@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Corso Garibaldi, 128',
            'city' => 'Sant\'Oliva Di Pontecorvo, 128',
            'CAP' => '03030',
            'phone_number' => '0399 3586930',
            'birthday' => '1970-09-09',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user32 = User::create([
            'first_name' => 'Nora',
            'last_name' => 'Mancini',
            'email' => 'noraMancini@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Torre di Mezzavia, 120',
            'city' => 'Tufillo',
            'CAP' => '66050',
            'phone_number' => '0339 5883813',
            'birthday' => '1990-03-15',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user33 = User::create([
            'first_name' => 'Olga',
            'last_name' => 'Greco',
            'email' => 'olgaGreco@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Rosmini, 135',
            'city' => 'Ceraso',
            'CAP' => '84052',
            'phone_number' => '0389 3966983',
            'birthday' => '1989-09-15',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user34 = User::create([
            'first_name' => 'Calliope',
            'last_name' => 'Toscano',
            'email' => 'calliopeToscano@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Callicratide, 9',
            'city' => 'Valsacarenche',
            'CAP' => '11010',
            'phone_number' => '0376 8236602',
            'birthday' => '1985-04-13',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user35 = User::create([
            'first_name' => 'Gandolfo',
            'last_name' => 'Onio',
            'email' => 'gandolfoOnio@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via delle Alalee, 35',
            'city' => 'Castelletto Orba',
            'CAP' => '15060',
            'phone_number' => '0376 8236602',
            'birthday' => '1985-04-13',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user36 = User::create([
            'first_name' => 'Ciriaco',
            'last_name' => 'Giordano',
            'email' => 'ciriacoGiordano@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Antonio Beccadelli',
            'city' => 'Surbo',
            'CAP' => '73010',
            'phone_number' => '0330 384074',
            'birthday' => '1959-06-30',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user37 = User::create([
            'first_name' => 'Pietro',
            'last_name' => 'Siciliani',
            'email' => 'pietroSiciliani@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Galvani, 101',
            'city' => 'Cavanella Po',
            'CAP' => '45013',
            'phone_number' => '0318 3192973',
            'birthday' => '1982-09-12',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user38 = User::create([
            'first_name' => 'Vittoria',
            'last_name' => 'Pisano',
            'email' => 'vittoriaPisano@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Vicenza, 126',
            'city' => 'Gavignano',
            'CAP' => '40050',
            'phone_number' => '0382 6706838',
            'birthday' => '1954-04-12',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);
        
        $user39 = User::create([
            'first_name' => 'Damiana',
            'last_name' => 'Udinese',
            'email' => 'damianaUdinese@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Giulio Camuzzoni, 115',
            'city' => 'San Pantaleone',
            'CAP' => '89060',
            'phone_number' => '0348 2734836',
            'birthday' => '1981-08-27',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user40 = User::create([
            'first_name' => 'Ciriaca',
            'last_name' => 'Pirozzi',
            'email' => 'ciriacaPirozzi@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Corso Vittorio Emanuele, 133',
            'city' => 'Montepescali Stazione',
            'CAP' => '58035',
            'phone_number' => '0385 6675204',
            'birthday' => '1975-08-30',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user41 = User::create([
            'first_name' => 'Greta',
            'last_name' => 'Calabrese',
            'email' => 'gretaCalabrese@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Spalato, 140',
            'city' => 'Camponogara',
            'CAP' => '30010',
            'phone_number' => '0324 4392089',
            'birthday' => '1996-12-01',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user42 = User::create([
            'first_name' => 'Paride',
            'last_name' => 'Panucci',
            'email' => 'paridePanucci@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Nicolai, 33',
            'city' => 'Forzo di Zoldo',
            'CAP' => '32010',
            'phone_number' => '0336 0080862',
            'birthday' => '1941-01-07',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user43 = User::create([
            'first_name' => 'Lionella',
            'last_name' => 'De Luca',
            'email' => 'lionellaDeLuca@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Vico Giganti, 5',
            'city' => 'Bagnaia',
            'CAP' => '06071',
            'phone_number' => '0323 5408242',
            'birthday' => '1945-11-29',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user44 = User::create([
            'first_name' => 'Rosita',
            'last_name' => 'Genovese',
            'email' => 'rositaGenovese@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Pisanelli, 52',
            'city' => 'Bocale Secondo',
            'CAP' => '89060',
            'phone_number' => '0316 8440205',
            'birthday' => '1973-03-05',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);
        
        $user45 = User::create([
            'first_name' => 'Massimiliano',
            'last_name' => 'Napolitano',
            'email' => 'massimilianoNapolitano@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Torino, 123',
            'city' => 'Rezzano',
            'CAP' => '29020',
            'phone_number' => '0394 2715033',
            'birthday' => '1943-07-05',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user46 = User::create([
            'first_name' => 'Quirico',
            'last_name' => 'Giordano',
            'email' => 'quiricoGiornano@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Rio Nell Elba, 132',
            'city' => 'Genova',
            'CAP' => '16167',
            'phone_number' => '0380 2631772',
            'birthday' => '1970-02-11',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user47 = User::create([
            'first_name' => 'Liberio',
            'last_name' => 'Manfrin',
            'email' => 'liberioManfrin@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Duomo, 145',
            'city' => 'Rio nell Elba',
            'CAP' => '57039',
            'phone_number' => '0324 0648815',
            'birthday' => '1950-12-03',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user48 = User::create([
            'first_name' => 'Edvige',
            'last_name' => 'Mazzanti',
            'email' => 'edvigeMazzanti@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Solfatara, 64',
            'city' => 'San Martino Alfieri',
            'CAP' => '14010',
            'phone_number' => '0398 9495657',
            'birthday' => '1940-07-21',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user49 = User::create([
            'first_name' => 'Valeria',
            'last_name' => 'Pugliesi',
            'email' => 'valeriaPugliesi@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via Nazionale, 140',
            'city' => 'Terlan',
            'CAP' => '39010',
            'phone_number' => '0341 9325723',
            'birthday' => '1968-02-17',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        $user50 = User::create([
            'first_name' => 'Maria Pia',
            'last_name' => 'Endrizzi',
            'email' => 'mariaPiaEndrizzi@gimmefund.com',
            'password' => Hash::make('password'),
            'address' => 'Via A.G. Alaimo',
            'city' => 'Castelleone di Sausa',
            'CAP' => '60010',
            'phone_number' => '0321 7554341',
            'birthday' => '1958-08-23',
            'points' => 0,
            'updated_at' => date('Y-m-d h:i:s'),
            'created_at' => date('Y-m-d h:i:s')
        ]);

        /* Gestione delle chiavi esterne: chiamo il metodo attach() per attaccare la chiave esterna */
        $admin->roles()->attach($adminRole);
        $user1->roles()->attach($userRole);
        $user2->roles()->attach($userRole);
        $user3->roles()->attach($userRole);
        $user4->roles()->attach($userRole);
        $user5->roles()->attach($userRole);
        $user6->roles()->attach($userRole);
        $user7->roles()->attach($userRole);
        $user8->roles()->attach($userRole);
        $user9->roles()->attach($userRole);
        $user10->roles()->attach($userRole);
        $user11->roles()->attach($userRole);
        $user12->roles()->attach($userRole);
        $user13->roles()->attach($userRole);
        $user14->roles()->attach($userRole);
        $user15->roles()->attach($userRole);
        $user16->roles()->attach($userRole);
        $user17->roles()->attach($userRole);
        $user18->roles()->attach($userRole);
        $user19->roles()->attach($userRole);
        $user20->roles()->attach($userRole);
        $user21->roles()->attach($userRole);
        $user22->roles()->attach($userRole);
        $user23->roles()->attach($userRole);
        $user24->roles()->attach($userRole);
        $user25->roles()->attach($userRole);
        $user26->roles()->attach($userRole);
        $user27->roles()->attach($userRole);
        $user28->roles()->attach($userRole);
        $user29->roles()->attach($userRole);
        $user30->roles()->attach($userRole);
        $user31->roles()->attach($userRole);
        $user32->roles()->attach($userRole);
        $user33->roles()->attach($userRole);
        $user34->roles()->attach($userRole);
        $user35->roles()->attach($userRole);
        $user36->roles()->attach($userRole);
        $user37->roles()->attach($userRole);
        $user38->roles()->attach($userRole);
        $user39->roles()->attach($userRole);
        $user40->roles()->attach($userRole);
        $user41->roles()->attach($userRole);
        $user42->roles()->attach($userRole);
        $user43->roles()->attach($userRole);
        $user44->roles()->attach($userRole);
        $user45->roles()->attach($userRole);
        $user46->roles()->attach($userRole);
        $user47->roles()->attach($userRole);
        $user48->roles()->attach($userRole);
        $user49->roles()->attach($userRole);
        $user50->roles()->attach($userRole);
    }
}
