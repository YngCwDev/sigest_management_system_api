<?php
namespace Database\Seeders;
use Illuminate\Support\Str;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
    // User::factory(10)->create();
    DB::table('roles')->insert([
        ['profile' => 'admin',
        'created_at' => now()
        ],
        ['profile' => 'supervisor',
        'created_at' => now()   
         ],
        ['profile' => 'default',
        'created_at' => now()
        ]
    ]);

    }
}
