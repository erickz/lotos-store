<?php

namespace App\Console\Commands;

use Countable;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Repositories\BolaoRepository;

use App\Models\Concurso;
use App\Models\Bolao;
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

            $loteriesDone[] = $concurso->lotery_id;
        }
        
        return Command::SUCCESS;
    }

    public function registerBolao($bolaoData = [])
    {
        $newBolao = $bolaoData;

        $this->repo->finalizeBolaoCreation($newBolao, false, true);                
    }

    public function generateGames($loteryId = 1)
    {
        $games = [];
        if ($loteryId == 1){
            $games = [
                [2,5,6,28,34,56],
                [4,12,20,34,46,52]
            ];
        }
        else if($loteryId == 2){
            $games = [
                [7,16,45,54,64],
                [10,12,23,40,51],
                [7,15,16,37,62],
                [12,15,21,33,52]
            ];
        }
        else if($loteryId == 3){
            $games = [
                [1,2,4,7,9,10,14,15,16,17,18,19,20,21,22],
                [2,4,5,7,9,10,12,16,17,18,19,20,22,23,25],
                [2,4,5,7,9,10,12,16,17,18,19,20,22,23,25],
                [2,4,5,7,9,10,12,16,17,18,19,20,22,23,25]
            ];
        }
        else if($loteryId == 4){
            $games = [
                [2,5,6,28,34,50],
                [4,12,20,34,46,50],
                [10,18,21,29,44,50],
                [12,15,21,33,42,50],
            ];
        }

        return $games;
    }

    /**
     * 
     */
    private function getNewLuckyBird()
    {
        $qualities = [
            "Próspero"
            ,"Vitorioso"
            ,"Triunfante"
            ,"Brilhante"
            ,"Sortudo"
            ,"Realizador"
            ,"Visionário"
            ,"Excelente"
            ,"Poderoso"
            ,"Abençoado"
            ,"Radiante"
            ,"Sucesso"
            ,"Encantador"
            ,"Estrelado"
            ,"Lucrativo"
            ,"Triunfal"
            ,"Inspirador"
            ,"Espetacular"
            ,"Oportunidade"
            ,"Fortunado"
            ,"Misterioso"
            ,"Maravilhoso"
            ,"Genial"
            ,"Fantástico"
            ,"Resiliente"
            ,"Fascinante"
            ,"Próspero"
            ,"Notável"
            ,"Corajoso"
            ,"Aventureiro"
            ,"Sagaz"
            ,"Valente"
            ,"Afortunado"
            ,"Perspicaz"
            ,"Carismático"
            ,"Radiante"
            ,"Surpreendente"
            ,"Estimulante"
            ,"Empreendedor"
            ,"Magnífico"
            ,"Inovador"
            ,"Empolgante"
            ,"Fantasia"
            ,"Invencível"
            ,"Desafiador"
            ,"Atrevido"
            ,"Arrojado"
            ,"Persuasivo"
            ,"Bravio"
            ,'Vital'
        ];

        $birds = [
            "Bem-te-vi"
            ,"Canário"
            ,"Coleiro"
            ,"Pintassilgo"
            ,"Sanhaçu"
            ,"Corrupião"
            ,"Tiê-sangue"
            ,"Cardeal"
            ,"Tico-tico"
            ,"Araponga"
            ,"Uirapuru"
            ,"Tucano"
            ,"Jacu"
            ,"Seriema"
            ,"Anu-branco"
            ,"Beija-flor"
            ,"Papagaio"
            ,"Gavião"
            ,"Falcão"
            ,"Socó"
            ,"Quero-quero"
            ,"João-de-barro"
            ,"Periquito"
            ,"Curicaca"
            ,"Garça"
            ,"Pica-pau"
            // ,"Rolinha"
            ,"Saracura"
            ,"Gaivota"
            ,"Suiriri"
            ,"Martim-pescador"
            ,"Surucuá"
            ,"Saíra"
            ,"Asa-branca"
            ,"Gralha-azul"
            ,"Coruja-buraqueira"
            ,"Andorinha"
            ,"Anumara"
            ,"Curiango"
            ,"Fogo-apagou"
            ,"Maria-preta"
            ,"Sanhaço-cinzento"
            ,"Tico-tico-rei"
        ];

        $generatedName = $birds[rand(0, (count($birds)-1))] . ' ' . $qualities[rand(0, (count($qualities)-1))];

        return $generatedName;
    }
}
