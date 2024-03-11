<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\LoteryStats;
use App\Models\LoteryCosts;

class migrateLoteriesStatsToLoteriesCostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $loteryStats = LoteryStats::all();
        
        foreach($loteryStats as $index => $stats){
            $dozens = $stats->number_dozens;
            $odds = intval(str_replace('.', '', $stats->odds));
            $loteryId = $stats->lotery_id;

            $minimumStats = LoteryStats::where('lotery_id', $loteryId)->orderBy('number_dozens', 'ASC')->first();
            $minimumOdds = intval(str_replace('.', '', $minimumStats->odds));

            $costs = LoteryCosts::where('number_matches', $dozens)->where('lotery_id', $loteryId)->first();
            $chances = $minimumOdds / $odds;
            $costs->chances = number_format($chances, 0, '', '');
            $costs->save();
        }
    }
}
