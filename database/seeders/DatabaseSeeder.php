<?php

namespace Database\Seeders;

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
        $this->call([
            RoleSeed::class,
        ]);

        $user = User::factory()->create([
            'name' => 'Super admin',
            'email' => 'admin@lersha.com',
            'password' => bcrypt('password'),
            'phone_number' => '0912345678',
        ]);
        $user->assignRole('Admin');
        User::factory(50)->create();
    }
}
