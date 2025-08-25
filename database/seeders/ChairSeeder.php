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
                'chair_owner'  => 'Belle ',
                'chair_owner_number' => '+255719189546',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'chair_number' => 'Chair 2',
                'chair_owner'  => 'Mudy Baro',
                'chair_owner_number' => '+255676629883',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'chair_number' => 'Chair 3',
                'chair_owner'  => 'Loy',
                'chair_owner_number' => '+255716108522',
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}
