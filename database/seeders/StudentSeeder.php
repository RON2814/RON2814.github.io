<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert addresses
        DB::table('addresses')->insert([
            [
                'house_number' => 'Blk 12 Lt 6',
                'street' => 'Sampaguita',
                'barangay' => 'Queens Row West',
                'city' => 'Bacoor',
                'province' => 'Cavite',
                'zip_code' => '4102',
            ],
        
        ]);

        // Create users
        DB::table('users')->insert([
            [
                'id' => '202211717',
                'name' => 'Rances Cuizon',
                'email' => 'bc.rances.cuizon@cvsu.edu.ph',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'role_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
         
        ]);

        // Create students
        DB::table('students')->insert([
            [
                'student_number' => '202211717',
                'last_name' => 'Cuizon',
                'first_name' => 'Rances',
                'middle_name' => 'Sabate',
                'extension_name' => null,
                'contact_number' => '09664471234',
                'birthday' => '2003-08-24',
                'sex' => 'male',
                'program_id' => 1,
                'classification' => 'Regular',
                'address_id' => 1, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
           
        ]);

       
    }
}
