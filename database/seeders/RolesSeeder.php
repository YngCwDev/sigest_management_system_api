<?php

namespace Database\Seeders;
use App\Models\Roles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Roles::create(['profile' => 'admin']);
        Roles::create(['profile' => 'supervisor']);
        Roles::create(['profile' => 'default']);
    }
}
