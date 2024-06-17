<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Yaramay',
             'email' => 'admin@yaramay.com',
             'password'=>Hash::make("Yaramay2024")
         ]);

         \App\Models\User::factory()->create([
             'name' => 'Ismail',
             'email' => 'ismael@seetlaw.online',
             'password'=>Hash::make("Ismael2024")
         ]);

         \App\Models\User::factory()->create([
             'name' => 'Saleh',
             'email' => 'saleh@seetlaw.online',
             'password'=>Hash::make("Saleh2024")
         ]);

      //  \App\Models\ClientCase::factory(20)->create();
      //  \App\Models\Invoice::factory(20)->create();
    }
}
