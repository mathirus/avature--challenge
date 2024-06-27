<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JobTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('job_types')->insert([
            ['name' => 'Full-time'],
            ['name' => 'Part-time'],
            ['name' => 'Freelance'],
        ]);
    }
}
