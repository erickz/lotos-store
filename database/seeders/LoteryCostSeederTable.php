<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\LoteryCosts;

class LoteryCostSeederTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $loteries = LoteryCosts::all();

        //40% its own value and rount It
        foreach($loteries as $index => $lotery){
            // $cost = $lotery->prize + ($lotery->prize * 0.5);
            $cost = $lotery->prize + ($lotery->prize * 0.40);
            $cost = round( $cost / 5, 1) * 5;

            $lotery->cost = $cost;
            $lotery->save();
        }

        $this->command->info('Success');
    }
}
