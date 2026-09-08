<?php

namespace Database\Seeders;

use App\Models\related_buildings;
use App\Models\department;
use App\Models\staff;
use App\Models\visa_applications;
use App\Models\appointments;
use App\Models\visits_logs;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | 1. Related Buildings
        |--------------------------------------------------------------------------
        */

        $embassy = related_buildings::create([
            'name' => 'Embassy of Japan in Damascus',
        ]);

        $literature = related_buildings::create([
            'name' => 'Japanese Literature Department at Damascus University',
        ]);

        $academic = related_buildings::create([
            'name' => 'Japan Center for Academic Cooperation in Aleppo',
        ]);

        /*
        |--------------------------------------------------------------------------
        | 2. Departments
        |--------------------------------------------------------------------------
        */

        $visaDept = department::create([
            'name' => 'Visa Section',
            'building_id' => $embassy->id,
        ]);

        $consularDept = department::create([
            'name' => 'Consular Services',
            'building_id' => $embassy->id,
        ]);

        $eduDept = department::create([
            'name' => 'JLPT Language Certification Track',
            'building_id' => $academic->id,
        ]);

        $langDept = department::create([
            'name' => 'Japanese Literature Degree Program',
            'building_id' => $literature->id,
        ]);

        /*
        |--------------------------------------------------------------------------
        | 3. Staff / Authentication Users
        |--------------------------------------------------------------------------
        |
        | RegisterRequest permits only:
        | Admin, Officer, Coordinator, Staff
        |
        | Every seeded staff member therefore uses one of those exact roles.
        |
        | Password is explicitly hashed here so the seed data is immediately
        | usable for Laravel authentication and Sanctum login testing.
        |
        */

        $visaStaff = collect();

        for ($i = 1; $i <= 4; $i++) {
            $visaStaff->push(
                staff::factory()->create([
                    'full_name' => "Visa Officer {$i}",
                    'job_title' => 'Visa Officer',
                    'role' => 'Officer',
                    'department_id' => $visaDept->department_id,
                    'email' => "visa.officer{$i}@embassy.test",
                    'password' => Hash::make('password123'),
                ])
            );
        }

        $consularStaff = collect();

        for ($i = 1; $i <= 3; $i++) {
            $consularStaff->push(
                staff::factory()->create([
                    'full_name' => "Consular Staff {$i}",
                    'job_title' => 'Consular Officer',
                    'role' => 'Staff',
                    'department_id' => $consularDept->department_id,
                    'email' => "consular.staff{$i}@embassy.test",
                    'password' => Hash::make('password123'),
                ])
            );
        }

        $academicStaff = collect();

        for ($i = 1; $i <= 3; $i++) {
            $academicStaff->push(
                staff::factory()->create([
                    'full_name' => "Academic Coordinator {$i}",
                    'job_title' => 'Academic Coordinator',
                    'role' => 'Coordinator',
                    'department_id' => $eduDept->department_id,
                    'email' => "academic.coordinator{$i}@embassy.test",
                    'password' => Hash::make('password123'),
                ])
            );
        }

        /*
        |--------------------------------------------------------------------------
        | 4. Visa Applications
        |--------------------------------------------------------------------------
        */

        visa_applications::factory()
            ->count(15)
            ->create();

        /*
        |--------------------------------------------------------------------------
        | 5. Appointments
        |--------------------------------------------------------------------------
        |
        | Visa Interviews -> Visa Section staff
        | Other consular services -> Consular Services staff
        |
        */

        for ($i = 0; $i < 20; $i++) {
            $purpose = fake()->randomElement([
                'Visa Interview',
                'Passport Renewal',
                'Document Attestation',
                'Notary Services',
            ]);

            if ($purpose === 'Visa Interview') {
                $interviewer = $visaStaff->random();
            } else {
                $interviewer = $consularStaff->random();
            }

            appointments::factory()->create([
                'interviewer_staff_id' => $interviewer->staff_id,
                'purpose_of_visit' => $purpose,
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | 6. Visitor Check-In Logs
        |--------------------------------------------------------------------------
        */

        $allStaff = staff::all();

        for ($i = 0; $i < 15; $i++) {
            visits_logs::factory()->create([
                'staff_id' => $allStaff->random()->staff_id,
            ]);
        }
    }
}