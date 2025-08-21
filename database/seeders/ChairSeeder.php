<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChairSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('chairs')->insert([
            [
                'chair_number' => 'Chair 1',
                'chair_owner'  => 'Salon',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'chair_number' => 'Chair 2',
                'chair_owner'  => 'Salon',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'chair_number' => 'Chair 3',
                'chair_owner'  => 'Salon',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}
