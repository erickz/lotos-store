<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\BolaoGame;

class fixQtBoloesGames extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $games = BolaoGame::all();

        foreach($games as $game){
            $game->quantity_numbers = count($game->getArNumbers());
            $game->save();
        }
    }
}
