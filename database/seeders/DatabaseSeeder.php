<?php

namespace Database\Seeders;
use App\Enums\Priority;
use App\Models\User;
use Illuminate\Support\Str;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    // User::factory(10)->create();
        $this->call([
        
    ]);

    User::create([
        'id' => Str::uuid(),
        'username' => 'vinoo',
        'email' => 'vino@gmail.com',
        'name' => 'vino',
        'priority' => Priority::NORMAL->value,
        'phone' => '+258871234567',
        'password' => bcrypt('vino123'),
        'email_verified_at' => now(),
        'role_id' => 1, 
    ]);

    }
}
