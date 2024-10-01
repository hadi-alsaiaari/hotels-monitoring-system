<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        \App\Models\MessagingAccount::factory()->create([
            'name' => 'Tourism Office',
            'type' => 'tourism_office',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \App\Models\MessagingAccount::factory()->create([
            'name' => 'Tourist Police',
            'type' => 'tourist_police',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        
        \App\Models\Conversation::factory()->create([
            'messaging_account_id' => 1,
            'label' => 'All Hotel Executive Manageres',
            'type' => 'group',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \App\Models\Conversation::factory()->create([
            'messaging_account_id' => 2,
            'label' => 'All Hotel Receptionists',
            'type' => 'group',
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        \App\Models\Participant::factory()->create([
            'conversation_id' => 1,
            'messaging_account_id' => 1,
            'role' => 'admin',
            'joined_at' => now(),
        ]);
        \App\Models\Participant::factory()->create([
            'conversation_id' => 2,
            'messaging_account_id' => 2,
            'role' => 'admin',
            'joined_at' => now(),
        ]);


        \App\Models\Role::factory()->create([
            'name' => 'Tourism Office Admin',
            'institution_type' => 'App\Models\TourismOffice',
            'institution_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \App\Models\Role::factory()->create([
            'name' => 'Tourist Police Admin',
            'institution_type' => 'App\Models\TouristPolice',
            'institution_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        \App\Models\Role::factory()->create([
            'name' => 'Security Department Office Admin',
            'institution_type' => 'App\Models\SecurityDepartmentOffice',
            'institution_id' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


        \App\Models\RoleAbility::factory()->create([
            'role_id' => '1',
            'ability' => 'roles.view',
            'type' => 'allow',
        ]);
        \App\Models\RoleAbility::factory()->create([
            'role_id' => '1',
            'ability' => 'roles.create',
            'type' => 'allow',
        ]);
        \App\Models\RoleAbility::factory()->create([
            'role_id' => '1',
            'ability' => 'roles.update',
            'type' => 'allow',
        ]);
        \App\Models\RoleAbility::factory()->create([
            'role_id' => '1',
            'ability' => 'roles.delete',
            'type' => 'allow',
        ]);
        \App\Models\RoleAbility::factory()->create([
            'role_id' => '2',
            'ability' => 'roles.view',
            'type' => 'allow',
        ]);
        \App\Models\RoleAbility::factory()->create([
            'role_id' => '2',
            'ability' => 'roles.create',
            'type' => 'allow',
        ]);
        \App\Models\RoleAbility::factory()->create([
            'role_id' => '2',
            'ability' => 'roles.update',
            'type' => 'allow',
        ]);
        \App\Models\RoleAbility::factory()->create([
            'role_id' => '2',
            'ability' => 'roles.delete',
            'type' => 'allow',
        ]);
        \App\Models\RoleAbility::factory()->create([
            'role_id' => '3',
            'ability' => 'roles.view',
            'type' => 'allow',
        ]);
        \App\Models\RoleAbility::factory()->create([
            'role_id' => '3',
            'ability' => 'roles.create',
            'type' => 'allow',
        ]);
        \App\Models\RoleAbility::factory()->create([
            'role_id' => '3',
            'ability' => 'roles.update',
            'type' => 'allow',
        ]);
        \App\Models\RoleAbility::factory()->create([
            'role_id' => '3',
            'ability' => 'roles.delete',
            'type' => 'allow',
        ]);


        \App\Models\TourismOffice::factory()->create([
            'name' => 'tourism_office',
            'email' => 'tourism.office@tourism.office',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'super_tourism_office' => true,
            'status' => 'active',
            'messaging_account_id' => 1,
            'role_id' => 1,
        ]);
        \App\Models\TouristPolice::factory()->create([
            'name' => 'tourist_police',
            'email' => 'tourist.police@tourist.police',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'super_tourist_police' => true,
            'status' => 'active',
            'messaging_account_id' => 2,
            'role_id' => 2,
        ]);
        \App\Models\SecurityDepartmentOffice::factory()->create([
            'name' => 'security_department_office',
            'email' => 'security.department.office@security.department.office',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'super_security_department_office' => true,
            'status' => 'active',
            'role_id' => 3,
        ]);


        \App\Models\Identity::factory()->create([
            'person_id' => 1,
            'person_type' => 'App\Models\TourismOffice',
            'identity_number' => '1super_tourism_office1',
            'first_name' => 'Ali',
            'second_name' => 'Mohammed',
            'third_name' => 'Ali',
            'last_name' => 'Alsagaph',
            'country' => 'ye',
            'place_of_birth' => 'Hadhramout - Seiyun - Tris',
            'date_of_birth' => '1975-04-22',
            'sex' => 'male',
            'date_of_issue' => '2015-04-22',
            'date_of_expiry' => '2025-04-22',
            'issuing_authority' => 'Seiyun-1',
            'identity_type' => 'personal',
        ]);
        \App\Models\Identity::factory()->create([
            'person_id' => 1,
            'person_type' => 'App\Models\TouristPolice',
            'identity_number' => '1super_tourist_police1',
            'first_name' => 'Mohammed',
            'second_name' => 'Ahmed',
            'third_name' => 'Mohammed',
            'last_name' => 'Alsagaph',
            'country' => 'ye',
            'place_of_birth' => 'Shabwa - Ataq - Blad',
            'date_of_birth' => '1975-04-22',
            'sex' => 'male',
            'date_of_issue' => '2017-10-27',
            'date_of_expiry' => '2027-10-27',
            'issuing_authority' => 'Ataq-1',
            'identity_type' => 'personal',
        ]);
        \App\Models\Identity::factory()->create([
            'person_id' => 1,
            'person_type' => 'App\Models\SecurityDepartmentOffice',
            'identity_number' => '1super_security_department_office1',
            'first_name' => 'Abdullah',
            'second_name' => 'Salmin',
            'third_name' => 'Mubarak',
            'last_name' => 'Bin Hobeish',
            'country' => 'ye',
            'place_of_birth' => 'Hadhramout - Abar - Sadara',
            'date_of_birth' => '1980-04-22',
            'sex' => 'male',
            'date_of_issue' => '2023-01-10',
            'date_of_expiry' => '2033-01-10',
            'issuing_authority' => 'Seiyun-1',
            'identity_type' => 'personal',
        ]);


        // \App\Models\TourismOffice::factory()->create([
        //     'status' => 'active',
        //     'super_tourism_office' => false,
        //     'name' => '2tourism_office2',
        //     'email' => '2tourism.office@tourism.office2',
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => Str::random(10),
        //     'messaging_account_id' => 1,
        // ]);
        // \App\Models\TouristPolice::factory()->create([
        //     'status' => 'active',
        //     'super_tourist_police' => false,
        //     'name' => '2tourist_police2',
        //     'email' => '2tourist.police@tourist.police2',
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => Str::random(10),
        //     'messaging_account_id' => 2,
        // ]);
        // \App\Models\SecurityDepartmentOffice::factory()->create([
        //     'status' => 'active',
        //     'super_security_department_office' => false,
        //     'name' => '2security_department_office2',
        //     'email' => '2security.department.office@security.department.office2',
        //     'email_verified_at' => now(),
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'remember_token' => Str::random(10),
        // ]);


        // \App\Models\Identity::factory()->create([
        //     'person_id' => 2,
        //     'person_type' => 'App\Models\TourismOffice',
        //     'identity_number' => '2tourism_office2',
        //     'first_name' => 'Ali2',
        //     'second_name' => 'Mohammed2',
        //     'third_name' => 'Ali2',
        //     'last_name' => 'Alsagaph2',
        //     'country' => 'ye',
        //     'place_of_birth' => 'Hadhramout - Seiyun - Tris',
        //     'date_of_birth' => '1975-04-22',
        //     'sex' => 'male',
        //     'date_of_issue' => '2015-04-22',
        //     'date_of_expiry' => '2025-04-22',
        //     'issuing_authority' => 'Seiyun-1',
        //     'identity_type' => 'personal',
        // ]);
        // \App\Models\Identity::factory()->create([
        //     'person_id' => 2,
        //     'person_type' => 'App\Models\TouristPolice',
        //     'identity_number' => '2tourist_police2',
        //     'first_name' => 'Mohammed2',
        //     'second_name' => 'Ahmed2',
        //     'third_name' => 'Mohammed2',
        //     'last_name' => 'Alsagaph2',
        //     'country' => 'ye',
        //     'place_of_birth' => 'Shabwa - Ataq - Blad',
        //     'date_of_birth' => '1975-04-22',
        //     'sex' => 'male',
        //     'date_of_issue' => '2017-10-27',
        //     'date_of_expiry' => '2027-10-27',
        //     'issuing_authority' => 'Ataq-1',
        //     'identity_type' => 'personal',
        // ]);
        // \App\Models\Identity::factory()->create([
        //     'person_id' => 2,
        //     'person_type' => 'App\Models\SecurityDepartmentOffice',
        //     'identity_number' => '2security_department_office2',
        //     'first_name' => 'Abdullah2',
        //     'second_name' => 'Salmin2',
        //     'third_name' => 'Mubarak2',
        //     'last_name' => 'Bin Hobeish2',
        //     'country' => 'ye',
        //     'place_of_birth' => 'Hadhramout - Abar - Sadara',
        //     'date_of_birth' => '1980-04-22',
        //     'sex' => 'male',
        //     'date_of_issue' => '2023-01-10',
        //     'date_of_expiry' => '2033-01-10',
        //     'issuing_authority' => 'Seiyun-1',
        //     'identity_type' => 'personal',
        // ]);
    }
}
