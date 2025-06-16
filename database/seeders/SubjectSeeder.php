<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subjects = [
            ['subject_key' => 'accounting', 'subject_name' => 'Accounting'],
            ['subject_key' => 'biology', 'subject_name' => 'Biology'],
            ['subject_key' => 'business', 'subject_name' => 'Business'],
            ['subject_key' => 'chemistry', 'subject_name' => 'Chemistry'],
            ['subject_key' => 'cs', 'subject_name' => 'Computer Science'],
            ['subject_key' => 'economics', 'subject_name' => 'Economics'],
            ['subject_key' => 'eng_lang_b', 'subject_name' => 'English Language B'],
            ['subject_key' => 'further_pure_math', 'subject_name' => 'Further Pure Mathematics'],
            ['subject_key' => 'gc', 'subject_name' => 'Global Citizenship'],
            ['subject_key' => 'humen_biology', 'subject_name' => 'Humen Biology'],
            ['subject_key' => 'ict', 'subject_name' => 'ICT'],
            ['subject_key' => 'isl_studies', 'subject_name' => 'Islamic Studies'],
            ['subject_key' => 'math_b', 'subject_name' => 'Mathematics B'],
            ['subject_key' => 'pst', 'subject_name' => 'Pakistan Studies'],
            ['subject_key' => 'physics', 'subject_name' => 'Physics'],
            ['subject_key' => 'urdu', 'subject_name' => 'Urdu'],
        ];

        DB::table('subjects')->insert($subjects);
    }
}
