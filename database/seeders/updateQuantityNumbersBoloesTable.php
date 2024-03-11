<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Bolao;

class updateQuantityNumbersBoloesTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $boloes = Bolao::all();
        
        foreach($boloes as $bolao)
        {
            $bolao->quantity_games = $bolao->games->count();
            $bolao->save();
        }

        $this->command->info('Success!');
    }
}
