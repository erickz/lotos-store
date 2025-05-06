<?php

namespace App\Console\Commands;

use Countable;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Repositories\BolaoRepository;

use App\Models\Concurso;
use App\Models\Bolao;
use App\Models\BolaoSuggestion;
use App\Models\Lotery;
use Carbon\Carbon;

class CreateDemoBoloesWeek extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:demo-boloes-for-week';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create bolões for the concursos of the week in order to have the listing of boloes not empty all times';

    public $repo;

    public function __construct(BolaoRepository $repo = null)
    {
        $this->repo = $repo;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now();
        $beginningWeek = Carbon::now()->startOfWeek();
        $endWeek = Carbon::now()->endOfWeek();
        $concursosOfTheWeek = Concurso::where('draw_day', '>=', $beginningWeek)->where('draw_day', '<=', $endWeek)
            ->orderBy('draw_day', 'DESC')->get();

        \Log::info(print_r($concursosOfTheWeek, true));

        $loteriesDone = [];
        foreach($concursosOfTheWeek as $concurso){

            if (in_array($concurso->lotery_id, $loteriesDone)){
                continue;
            }

            $suggestions = BolaoSuggestion::where('lotery_id', $concurso->lotery->id)->get();

            foreach($suggestions as $index => $suggestion){
                $games = $suggestion->generateGames();
                $qtGames = count($games);

                \Log::info(print_r($concurso, true));

                //Register a cheaper basic bolão.
                if($index == 0){
                    $this->registerBolao([
                        'lotery_id' => $concurso->lotery_id,
                        'customer_id' => 13,
                        'concurso_id' => $concurso->id,
                        'name' => $suggestion->buildName(strtoupper($concurso->lotery->initials), $concurso->number),
                        'description' => $suggestion->buildDescription(),
                        'price' => 7.5,
                        'chances' => $concurso->lotery->calculateChances($games, $concurso->lotery->id),
                        'keepCotas' => 1,
                        'cotas' => 21,
                        'cotas_available' => 20,
                        'games' => $games,
                        'quantity_games' => $qtGames,
                        'total_value' => $suggestion->price
                    ]);
                }

                $this->registerBolao([
                    'lotery_id' => $concurso->lotery_id,
                    'customer_id' => 13,
                    'concurso_id' => $concurso->id,
                    'name' => $suggestion->buildName(strtoupper($concurso->lotery->initials), $concurso->number),
                    'description' => $suggestion->buildDescription(),
                    'price' => $suggestion->price,
                    'chances' => $concurso->lotery->calculateChances($games, $concurso->lotery->id),
                    'keepCotas' => 1,
                    'cotas' => 4,
                    'cotas_available' => 3,
                    'games' => $games,
                    'quantity_games' => $qtGames,
                    'total_value' => $suggestion->price
                ]);
            }
        }
        
        return Command::SUCCESS;
    }

    public function registerBolao($bolaoData = [])
    {
        $newBolao = $bolaoData;

        $this->repo->finalizeBolaoCreation($newBolao, false, true);                
    }
}
