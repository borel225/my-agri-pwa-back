<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DelegationRegionaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DelegationRegionale::create([
            'code_dr' => 'DR001',
            'nom' => 'Abidjan Sud',
        ]);

        DelegationRegionale::create([
            'code_dr' => 'DR002',
            'nom' => 'Abidjan Nord',
        ]);

        DelegationRegionale::create([
            'code_dr' => 'DR003',
            'nom' => 'Yamoussoukro',
        ]);
    }
}
