<?php

namespace Database\Seeders;

use App\Models\Checklist\Instructor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InstructorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('instructors')->insert([
            // [
            //     'first_name' => 'Donnalyn',
            //     'middle_name' => 'B.',
            //     'last_name' => 'Montallana',
            //     'extention_name' => null,
            //     'email' => 'bc.donnalyn.montallana@cvsu.edu.ph',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'first_name' => 'Jovelyn',
            //     'middle_name' => 'D.',
            //     'last_name' => 'Ocampo',
            //     'extention_name' => null,
            //     'email' => 'bc.jovelyn.ocampo@cvsu.edu.ph',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            // [
            //     'first_name' => 'Ely Rose',
            //     'middle_name' => 'L.',
            //     'last_name' => 'Panaganiban-Briones',
            //     'extention_name' => null,
            //     'email' => 'bc.elyrose.panaganiban-briones@cvsu.edu.ph',
            //     'created_at' => now(),
            //     'updated_at' => now(),
            // ],
            [
                'first_name' => 'Alvin',
                'middle_name' => 'D.',
                'last_name' => 'Catalo',
                'extention_name' => null,
                'email' => 'bc.alvin.catalo@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Alvina',
                'middle_name' => 'E.',
                'last_name' => 'Ramallosa',
                'extention_name' => null,
                'email' => 'bc.alvina.ramalhosa@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Bryan Dale',
                'middle_name' => 'R.',
                'last_name' => 'Ablaza',
                'extention_name' => null,
                'email' => 'bc.bryandale.abalaza@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Mikaela',
                'middle_name' => 'G.',
                'last_name' => 'Arciaga',
                'extention_name' => null,
                'email' => 'bc.mikaela.aracicia@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Stephen',
                'middle_name' => 'G.',
                'last_name' => 'Bacolor',
                'extention_name' => null,
                'email' => 'bc.stephen.bacolor@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Steffanie',
                'middle_name' => 'M.',
                'last_name' => 'Bato',
                'extention_name' => null,
                'email' => 'bc.styfannie.bato@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Jhon Nerick',
                'middle_name' => 'T.',
                'last_name' => 'Batuigas',
                'extention_name' => null,
                'email' => 'bc.jhonneirick.batuira@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Edan',
                'middle_name' => 'A.',
                'last_name' => 'Belgica',
                'extention_name' => null,
                'email' => 'bc.edan.belgica@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Christian C.',
                'middle_name' => 'C.',
                'last_name' => 'Boladra',
                'extention_name' => null,
                'email' => 'bc.christian.boladra@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Rajeel',
                'middle_name' => 'J.',
                'last_name' => 'Carvajal',
                'extention_name' => null,
                'email' => 'bc.rajeel.carvajal@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Jerico D.',
                'middle_name' => null,
                'last_name' => 'Castillo',
                'extention_name' => null,
                'email' => 'bc.jerico.castillo@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Mariel',
                'middle_name' => 'E.',
                'last_name' => 'Castillo',
                'extention_name' => null,
                'email' => 'bc.mariele.castillo@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Alvin',
                'middle_name' => 'R.',
                'last_name' => 'Celino',
                'extention_name' => null,
                'email' => 'bc.alvin.celino@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Allen Dave',
                'middle_name' => 'H.',
                'last_name' => 'Coles',
                'extention_name' => null,
                'email' => 'bc.allendave.colib@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Rufino',
                'middle_name' => 'A.',
                'last_name' => 'Dela Cruz',
                'extention_name' => 'Jr',
                'email' => 'bc.rufino.delacruz@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Jen Jerome',
                'middle_name' => 'V.',
                'last_name' => 'Dela Peña',
                'extention_name' => null,
                'email' => 'bc.jenjerome.delapena@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Redem',
                'middle_name' => 'M.',
                'last_name' => 'Decipulo',
                'extention_name' => null,
                'email' => 'bc.redem.decipulo@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Roi',
                'middle_name' => 'M.',
                'last_name' => 'Francisco',
                'extention_name' => null,
                'email' => 'bc.roi.francisco@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Lawrence',
                'middle_name' => 'G.',
                'last_name' => 'Jimenez',
                'extention_name' => null,
                'email' => 'bc.lawrence.jimenez@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Ashley',
                'middle_name' => 'Q.',
                'last_name' => 'Manuel',
                'extention_name' => null,
                'email' => 'bc.ashley.manuel@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'James',
                'middle_name' => 'D.',
                'last_name' => 'Mañozo',
                'extention_name' => null,
                'email' => 'bc.james.manozo@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Edmund',
                'middle_name' => 'C.',
                'last_name' => 'Martinez',
                'extention_name' => null,
                'email' => 'bc.edmund.martinez@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Julius',
                'middle_name' => 'M.',
                'last_name' => 'Mojas',
                'extention_name' => null,
                'email' => 'bc.julius.mojas@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Engr. Richard',
                'middle_name' => 'D.',
                'last_name' => 'Ongayo',
                'extention_name' => null,
                'email' => 'bc.richard.ongayo@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Aida',
                'middle_name' => 'M.',
                'last_name' => 'Penson',
                'extention_name' => null,
                'email' => 'bc.aida.penson@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Nestor Miguel',
                'middle_name' => 'T.',
                'last_name' => 'Pimentel',
                'extention_name' => null,
                'email' => 'bc.nestormiguel.pimentel@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Jay-Ar',
                'middle_name' => null,
                'last_name' => 'Racadio',
                'extention_name' => null,
                'email' => 'bc.jayar.racadio@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Joven',
                'middle_name' => null,
                'last_name' => 'Rios',
                'extention_name' => null,
                'email' => 'bc.joven.rios@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Ryan',
                'middle_name' => 'E.',
                'last_name' => 'Roy',
                'extention_name' => null,
                'email' => 'bc.ryan.roy@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Niño',
                'middle_name' => 'M.',
                'last_name' => 'Rodil',
                'extention_name' => null,
                'email' => 'bc.nino.rodil@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Rachel',
                'middle_name' => 'O.',
                'last_name' => 'Rodriguez',
                'extention_name' => null,
                'email' => 'bc.rachel.rodriguez@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Clarissa',
                'middle_name' => 'V.',
                'last_name' => 'Rostrollo',
                'extention_name' => null,
                'email' => 'bc.clarissa.rostrollo@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Clarence',
                'middle_name' => 'B.',
                'last_name' => 'Salvador',
                'extention_name' => null,
                'email' => 'bc.clarence.salvador@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Jessica Anne',
                'middle_name' => 'S.',
                'last_name' => 'Sambrano',
                'extention_name' => null,
                'email' => 'bc.jessicaanne.sambrano@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Benedick',
                'middle_name' => 'M.',
                'last_name' => 'Sarmiento',
                'extention_name' => null,
                'email' => 'bc.benedick.sarmiento@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Jerome',
                'middle_name' => 'E.',
                'last_name' => 'Tacata',
                'extention_name' => null,
                'email' => 'bc.jerome.tacata@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Pamela Marie',
                'middle_name' => 'O.',
                'last_name' => 'Tagum',
                'extention_name' => null,
                'email' => 'bc.pamelamarie.tagum@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Cesar',
                'middle_name' => null,
                'last_name' => 'Talibong',
                'extention_name' => 'II',
                'email' => 'bc.cesar.talibong@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Russel Adrianne',
                'middle_name' => null,
                'last_name' => 'Villareal',
                'extention_name' => null,
                'email' => 'bc.russeladrianne.villareal@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Frederick',
                'middle_name' => null,
                'last_name' => 'Agunod',
                'extention_name' => null,
                'email' => 'bc.frederick.agunod@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Raezy Mai',
                'middle_name' => null,
                'last_name' => 'Pica',
                'extention_name' => null,
                'email' => 'bc.raezymai.pica@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Christian',
                'middle_name' => null,
                'last_name' => 'Castillo',
                'extention_name' => null,
                'email' => 'bc.christian.castillo@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Jhon Robert',
                'middle_name' => null,
                'last_name' => 'Rosal',
                'extention_name' => null,
                'email' => 'bc.jhonrobert.rosal@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Romel John',
                'middle_name' => null,
                'last_name' => 'Jamito',
                'extention_name' => null,
                'email' => 'bc.romeljohn.jamito@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Jhune Hay',
                'middle_name' => null,
                'last_name' => 'Mitra',
                'extention_name' => null,
                'email' => 'bc.jhune.mitra@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Arjon',
                'middle_name' => null,
                'last_name' => 'Veluz',
                'extention_name' => null,
                'email' => 'bc.arjon.veluz@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Christian',
                'middle_name' => null,
                'last_name' => 'Perlado',
                'extention_name' => null,
                'email' => 'bc.christian.perlado@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Paul',
                'middle_name' => null,
                'last_name' => 'Montejar',
                'extention_name' => null,
                'email' => 'bc.paul.montejar@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Raymart',
                'middle_name' => null,
                'last_name' => 'Gianan',
                'extention_name' => null,
                'email' => 'bc.raymart.gianan@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Jove Ann',
                'middle_name' => null,
                'last_name' => 'Tatad',
                'extention_name' => null,
                'email' => 'bc.joveann.tatad@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Shawn Michael',
                'middle_name' => null,
                'last_name' => 'Aldea',
                'extention_name' => null,
                'email' => 'bc.shawnmichael.aldea@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Jayson',
                'middle_name' => 'M',
                'last_name' => 'Nati',
                'extention_name' => null,
                'email' => 'bc.jayson.nati@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Ronald',
                'middle_name' => null,
                'last_name' => 'Rosete',
                'extention_name' => null,
                'email' => 'bc.ronald.rosete@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Andrew',
                'middle_name' => 'L',
                'last_name' => 'Gabionza',
                'extention_name' => null,
                'email' => 'bc.andrew.gabionza@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'first_name' => 'Lorenzo',
                'middle_name' => null,
                'last_name' => 'Moreno',
                'extention_name' => null,
                'email' => 'bc.lorenzo.moreno@cvsu.edu.ph',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
        
        
        
    }
}
