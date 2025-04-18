<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EvaluationQuestionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = Carbon::now();

        $questions = [
            ['category' => 'Call Opening', 'Question' => 'Did the agent properly greet the caller?', 'value' => 5, 'status' => 'active', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2025-04-02 10:40:02', 'updated_at' => '2025-04-02 10:40:02'],
            ['category' => 'Call Opening', 'Question' => 'Did the agent introduce themselves and the company?', 'value' => 5, 'status' => 'active', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2025-04-02 10:40:23', 'updated_at' => '2025-04-02 10:40:23'],
            ['category' => 'Communication & Listening Skills', 'Question' => 'Did the agent speak clearly and professionally?', 'value' => 10, 'status' => 'active', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2025-04-02 10:40:41', 'updated_at' => '2025-04-02 10:40:41'],
            ['category' => 'Communication & Listening Skills', 'Question' => 'Did the agent actively listen and acknowledge the customer’s concerns?', 'value' => 10, 'status' => 'active', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2025-04-02 10:44:31', 'updated_at' => '2025-04-02 10:44:31'],
            ['category' => 'Issue Resolution', 'Question' => 'Did the agent understand and address the issue correctly?', 'value' => 15, 'status' => 'active', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2025-04-02 10:44:48', 'updated_at' => '2025-04-02 10:46:51'],
            ['category' => 'Issue Resolution', 'Question' => 'Did the agent provide accurate and complete information?', 'value' => 15, 'status' => 'active', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2025-04-02 10:47:23', 'updated_at' => '2025-04-02 10:47:23'],
            ['category' => 'Professionalism & Courtesy', 'Question' => 'Did the agent remain polite, patient, and professional throughout the call?', 'value' => 10, 'status' => 'active', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2025-04-02 10:47:38', 'updated_at' => '2025-04-02 10:47:38'],
            ['category' => 'Professionalism & Courtesy', 'Question' => 'Did the agent manage any difficult situation calmly?', 'value' => 10, 'status' => 'active', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2025-04-02 10:47:54', 'updated_at' => '2025-04-02 10:47:54'],
            ['category' => 'Call Closing', 'Question' => 'Did the agent summarize the resolution or next steps?', 'value' => 5, 'status' => 'active', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2025-04-02 10:48:16', 'updated_at' => '2025-04-02 10:48:16'],
            ['category' => 'Call Closing', 'Question' => 'Did the agent thank the caller and close the call professionally?', 'value' => 5, 'status' => 'active', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2025-04-02 10:48:32', 'updated_at' => '2025-04-02 10:48:32'],
            ['category' => 'Compliance & Adherence', 'Question' => 'Did the agent follow company scripts, guidelines, and compliance policies?', 'value' => 10, 'status' => 'active', 'created_by' => 1, 'updated_by' => 1, 'created_at' => '2025-04-02 10:48:52', 'updated_at' => '2025-04-02 10:48:52'],
        ];

        DB::table('evaluation_questions')->insert($questions);
    }
}
