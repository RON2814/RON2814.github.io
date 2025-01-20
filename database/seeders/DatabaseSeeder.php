<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Program;
use App\Models\Role;
use App\Models\Roles\Admin;
use App\Models\Roles\Department;
use App\Models\Roles\Registrar;
use App\Models\Roles\Student;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Role::insert([
            ["id" => 1, "title" => "Student"],
            ["id" => 2, "title" => "Department"],
            ["id" => 3, "title" => "Registrar"],
            ["id" => 4, "title" => "Admin"],
        ]);

        Program::insert([
            ["id" => 1, "title" => "BSCS", "description" => "Bachelor of Science in Computer Science",],
            ["id" => 2, "title" => "BSIT", "description" => "Bachelor of Science in Information Technology",],
        ]);
        $this->call([
            CourseSeeder::class,
            StudentSeeder::class,
            InstructorSeeder::class,
            ChecklistSeeder::class,
        ]);


        // Create initial users with specific roles

        // Create additional users using factories
        //$this->createUsersWithRoles();



        $studentUser = User::create([
            "id" => "202211662",
            "name" => "Apayong, John Aaron",
            "email" => "student@email.com",
            "password" => bcrypt("password"),
            "role_id" => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $address = Address::create([
            "house_number" => "1234",
            "street" => "1234 Street",
            "barangay" => "Barangay",
            "city" => "City",
            "province" => "Province",
            "zip_code" => "1234",
        ]);

        Student::create([
            "student_number" => $studentUser->id,
            "last_name" => "Apayong",
            "first_name" => "John Aaron",
            "middle_name" => "Oliva",
            "contact_number" => "09123456789",
            "program_id" => 1,
            "address_id" => $address->id,
        ]);

        $deptUser = User::create([
            "id" => "2",
            'name' => 'Test User Department',
            'email' => 'department@email.com',
            'password' => bcrypt('password'),
            'role_id' => 2,
        ]);

        Department::create([
            "department_id" => $deptUser->id,
            "last_name" => "Department",
            "first_name" => "User",
            "middle_name" => "Test",
            "contact_number" => "09123456789",
            "program_id" => 1,
        ]);

        $registrarUser = User::create([
            "id" => "3",
            'name' => 'Test User Registrar',
            'email' => "registrar@email.com",
            "password" => bcrypt("password"),
            "role_id" => 3,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Registrar::create([
            "registrar_id" => $registrarUser->id,
            "last_name" => "Registrar",
            "first_name" => "User",
            "middle_name" => "Test",
            "contact_number" => "09123456789",
        ]);

        $admin = User::create([
            "id" => "4",
            'name' => 'Test User Admin',
            'email' => "admin@email.com",
            "password" => bcrypt("password"),
            "role_id" => 4,
        ]);

        Admin::create([
            "admin_id" => $admin->id,
            "last_name" => "Admin",
            "first_name" => "User",
            "middle_name" => "Test",
            "contact_number" => "09123456789",
        ]);
    }

    // private function createUsersWithRoles()
    // {
    //     // Create Students
    //     Student::factory()->count(20)->create();

    //     // Create Admins
    //     User::factory()->count(3)->create(['role_id' => 4]);
    //     // Create Registrars
    //     User::factory()->count(5)->create(['role_id' => 3]);
    //     // Create Departments
    //     User::factory()->count(8)->create(['role_id' => 2]);
    // }
}
