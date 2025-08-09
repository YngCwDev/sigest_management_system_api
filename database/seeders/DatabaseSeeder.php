<?php
namespace Database\Seeders;
use Illuminate\Support\Str;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Enums\UserProfile; 

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    // User::factory(10)->create();
    
         DB::table('roles')->insert([
            ['profile' => UserProfile::ADMIN->value, 'created_at' => now(), 'updated_at' => now()],
            ['profile' => UserProfile::SUPERVISOR->value, 'created_at' => now(), 'updated_at' => now()],
            ['profile' => UserProfile::DEFAULT->value, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
