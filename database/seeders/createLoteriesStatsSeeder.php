<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LoteryStats;

class createLoteriesStatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'lotery_id' => 1,
                'number_dozens' => 6,
                'odds' => '50.063.860'
            ],
            [
                'lotery_id' => 1,
                'number_dozens' => 7,
                'odds' => '7.151.980'
            ],
            [
                'lotery_id' => 1,
                'number_dozens' => 8,
                'odds' => '1.787.995'
            ],
            [
                'lotery_id' => 1,
                'number_dozens' => 9,
                'odds' => '595.998'
            ],
            [
                'lotery_id' => 1,
                'number_dozens' => 10,
                'odds' => '238.399'
            ],
            [
                'lotery_id' => 1,
                'number_dozens' => 11,
                'odds' => '108.363'
            ],
            [
                'lotery_id' => 1,
                'number_dozens' => 12,
                'odds' => '54.182'
            ],
            [
                'lotery_id' => 1,
                'number_dozens' => 13,
                'odds' => '29.175'
            ],
            [
                'lotery_id' => 1,
                'number_dozens' => 14,
                'odds' => '16.671'
            ],
            [
                'lotery_id' => 1,
                'number_dozens' => 15,
                'odds' => '10.003'
            ],
            [
                'lotery_id' => 1,
                'number_dozens' => 16,
                'odds' => '6.252'
            ],
            [
                'lotery_id' => 1,
                'number_dozens' => 17,
                'odds' => '4.045'
            ],
            [
                'lotery_id' => 1,
                'number_dozens' => 18,
                'odds' => '2.697'
            ],
            [
                'lotery_id' => 1,
                'number_dozens' => 19,
                'odds' => '1.845'
            ],
            [
                'lotery_id' => 1,
                'number_dozens' => 20,
                'odds' => '1.292'
            ],
            [
                'lotery_id' => 2,
                'number_dozens' => 5,
                'odds' => '24.040.016'
            ],
            [
                'lotery_id' => 2,
                'number_dozens' => 6,
                'odds' => '4.006.669'
            ],
            [
                'lotery_id' => 2,
                'number_dozens' => 7,
                'odds' => '1.144.762'
            ],
            [
                'lotery_id' => 2,
                'number_dozens' => 8,
                'odds' => '429.286'
            ],
            [
                'lotery_id' => 2,
                'number_dozens' => 9,
                'odds' => '190.794'
            ],
            [
                'lotery_id' => 2,
                'number_dozens' => 10,
                'odds' => '95.396'
            ],
            [
                'lotery_id' => 2,
                'number_dozens' => 11,
                'odds' => '52.035'
            ],
            [
                'lotery_id' => 2,
                'number_dozens' => 12,
                'odds' => '30.354'
            ],
            [
                'lotery_id' => 2,
                'number_dozens' => 13,
                'odds' => '18.679'
            ],
            [
                'lotery_id' => 2,
                'number_dozens' => 14,
                'odds' => '12.008'
            ],
            [
                'lotery_id' => 2,
                'number_dozens' => 15,
                'odds' => '8.005'
            ],
            [
                'lotery_id' => 3,
                'number_dozens' => 15,
                'odds' => '3.268.760'
            ],
            [
                'lotery_id' => 3,
                'number_dozens' => 16,
                'odds' => '204.298'
            ],
            [
                'lotery_id' => 3,
                'number_dozens' => 17,
                'odds' => '24.035'
            ],
            [
                'lotery_id' => 3,
                'number_dozens' => 18,
                'odds' => '4.006'
            ],
            [
                'lotery_id' => 3,
                'number_dozens' => 19,
                'odds' => '843'
            ],
            [
                'lotery_id' => 3,
                'number_dozens' => 20,
                'odds' => '211'
            ],
            [
                'lotery_id' => 4,
                'number_dozens' => 6,
                'odds' => '15.890.700'
            ],
            [
                'lotery_id' => 4,
                'number_dozens' => 7,
                'odds' => '2.270.100'
            ],
            [
                'lotery_id' => 4,
                'number_dozens' => 8,
                'odds' => '567.525'
            ],
            [
                'lotery_id' => 4,
                'number_dozens' => 9,
                'odds' => '189.175'
            ],
            [
                'lotery_id' => 4,
                'number_dozens' => 10,
                'odds' => '75.670'
            ],
            [
                'lotery_id' => 4,
                'number_dozens' => 11,
                'odds' => '34.395'
            ],
            [
                'lotery_id' => 4,
                'number_dozens' => 12,
                'odds' => '17.197'
            ],
            [
                'lotery_id' => 4,
                'number_dozens' => 13,
                'odds' => '9.260'
            ],
            [
                'lotery_id' => 4,
                'number_dozens' => 14,
                'odds' => '5.291'
            ],
            [
                'lotery_id' => 4,
                'number_dozens' => 15,
                'odds' => '3.174'
            ],
        ];

        $statsCount = 0;
        foreach($data as $row){
            $loteryStats = LoteryStats::create($row);
            $statsCount++;
        }

        return $statsCount . ' number of rows created';
    }
}
