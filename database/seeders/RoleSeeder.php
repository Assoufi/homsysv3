<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::firstOrCreate(
            ['name' => 'admin'],
            ['display_name' => 'Admin', 'description' => 'Application administrator']
        );

        Role::firstOrCreate(
            ['name' => 'candidat'],
            ['display_name' => 'Candidat', 'description' => 'Candidate user']
        );
    }
}

