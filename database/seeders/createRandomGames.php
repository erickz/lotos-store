<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\BolaoGame;
use App\Models\Bolao;

class createRandomGames extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bolao = Bolao::find(99);
        $games = BolaoGame::where('bolao_id', 99)->get();

        $bolao->concurso_id = 7;
        $bolao->id = NULL;
        $duplicatedBolao = $bolao;

        $newBolao = Bolao::create($duplicatedBolao->toArray());

        foreach($games as $index => $game){

            $duplicated = $game;

            $newNumbers = [];
            for($i = 0; $i < $duplicated->quantity_numbers; $i++){

                $w = true;
                while($w){
                    $generated = rand(1, 60);

                    if (! in_array($generated, $newNumbers)){
                        $w = false;
                    }
                }
                $newNumbers[] = $generated;

                // if ($i+1 < $duplicated->quantity_numbers){
                //     $newNumbers .= ',';
                // }
            }
            sort($newNumbers);
            $newNumbers = implode(',', $newNumbers);
            
            $duplicated->numbers = $newNumbers;
            $duplicated->id = NULL;
            $duplicated->bolao_id = $newBolao->id;

            $new = BolaoGame::create($duplicated->toArray());
        }
    }
}
