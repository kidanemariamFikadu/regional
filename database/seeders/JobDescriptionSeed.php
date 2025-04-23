<?php

namespace Database\Seeders;

use App\Models\JobDescription;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobDescriptionSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Managing Director'],
            ['name' => 'Corporate Law Advisor'],
            ['name' => 'Board of Advisors'],
            ['name' => 'Operation Lead'],
            ['name' => 'Agent Supervisor'],
            ['name' => 'Training and Capacity Building'],
            ['name' => 'Call Center Team'],
            ['name' => 'Farm Service Center'],
            ['name' => 'Mechanization Rental Service'],
            ['name' => 'General Service'],
            ['name' => 'Agribusiness and Market Lead'],
            ['name' => 'Partner Management'],
            ['name' => 'Overseas Market'],
            ['name' => 'Talent Mgt'],
            ['name' => 'Communication & Knowledge Lead'],
            ['name' => 'Digital Marketing'],
            ['name' => 'Knowledge and Innovation'],
            ['name' => 'Data Analyst and Insight'],
            ['name' => 'Analytics Team'],
            ['name' => 'MLE'],
            ['name' => 'HR & Finance Lead'],
            ['name' => 'Accountancy'],
            ['name' => 'Agricultural Science Expert'],
            ['name' => 'Dev. Team'],
            ['name' => 'Farmer Care Team'],
        ];
        foreach ($roles as $role) {
            JobDescription::updateOrCreate(
            ['name' => $role['name']]
            );
        }
    }
}
