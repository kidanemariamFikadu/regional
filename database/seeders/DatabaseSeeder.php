<?php

namespace Database\Seeders;

use App\Models\JobDescription;
use App\Models\Setting;
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
            PermissionSeed::class,
            RoleSeed::class,
            JobDescriptionSeed::class,
            EvaluationQuestionsSeeder::class,
        ]);

        $user = User::factory()->create([
            'name' => 'Super admin',
            'email' => 'admin@lersha.com',
            'password' => bcrypt('password'),
            'phone_number' => '0912345678',
        ]);
        $user->assignRole('Admin');
        
        Setting::create([
            'key'=>'active_month',
            'value'=>date('Y-m'),
        ]);
    }
}
