<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

use App\Models\Concurso;
use App\Models\Lotery;
use Carbon\Carbon;

class CreateConcursosWeek extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:concursos-for-week';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create the weekly concursos';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $urlApi = 'https://loteriascaixa-api.herokuapp.com/api/';
        $loteries = [
            01 => 'megasena',
            02 => 'quina',
            03 => 'lotofacil',
            04 => 'duplasena'
        ];

        foreach($loteries as $loteryId => $loteryAlias){
            $lastConcursos = $response = Http::withHeaders([
                'accept' => 'application/json'
            ])->get($urlApi . $loteryAlias .'/latest', []);

            $concursoDecoded = json_decode($lastConcursos->body());
            $nConcurso = $concursoDecoded->concurso;
            $lotery = Lotery::find($loteryId);

            $concurso = Concurso::where('number', $nConcurso)->where('lotery_id', $lotery->id)->first();

            $arLoteryDays = explode(',', $lotery->draw_days);
            $diffBetweenDays = $arLoteryDays[1] - $arLoteryDays[0];

            $dateOfContest = Carbon::createFromFormat('d/m/Y', $concursoDecoded->data);
            $concursoDayOfWeek = $dateOfContest->dayOfWeek;
            
            if (! $concurso){
                $dataPremiacoes = [];
                $dataPremiacoes2 = [];

                $drawNumbers = implode(' ', $concursoDecoded->dezenas);
                $dataPremiacoes = $this->retrieveConcursosResult($concursoDecoded->premiacoes, $lotery);

                $drawNumbers2 = NULL;
                if ($lotery->initials == 'DS'){
                    $drawNumbers = implode(' ', array_slice($concursoDecoded->dezenas, 0, 6));
                    $drawNumbers2 = implode(' ', array_slice($concursoDecoded->dezenas, 6, 6));

                    $dataPremiacoes2 = $this->retrieveConcursosResult($concursoDecoded->premiacoes, $lotery, true);
                }

                $dataToConcurso = [
                    'lotery_id' => $loteryId, 
                    'active' => 1, 
                    'type' => 1, 
                    'number' => $nConcurso, 
                    'draw_day' => $dateOfContest->format('d/m/Y'), 
                    'draw_datetime' => $dateOfContest->format('Y-m-d') . ' 20:00:00', 
                    'next_expected_prize' => $concursoDecoded->valorEstimadoProximoConcurso, 
                    'value_accumulated' => $concursoDecoded->valorAcumuladoProximoConcurso,
                    'draw_numbers' => $drawNumbers,
                    'draw_numbers_2' => $drawNumbers2,
                    'results' => $dataPremiacoes,
                    'results_2' => $dataPremiacoes2 ? $dataPremiacoes2 : NULL,
                ];

                //Create last concurso
                $concurso = $this->createConcurso($dataToConcurso);
            }

            $now = Carbon::now();
            $nowDayOfWeek = $now->dayOfWeek;

            $nConcurso = $concurso->number + 1;

            if ($nowDayOfWeek < 6){
                //Loop and create the rest of the concursos of the week
                for ($i = $nowDayOfWeek; $i <= last($arLoteryDays); $i++){

                    if (! in_array($now->dayOfWeek, $arLoteryDays)){
                        $now = $now->addDays(1);
                        continue;
                    }

                    $concurso = Concurso::where('number', $nConcurso)->where('lotery_id', $lotery->id)->first();

                    if (! $concurso){
                        $this->createConcurso(['lotery_id' => $loteryId, 'active' => 1, 'type' => 1, 'number' => $nConcurso++, 'draw_day' => $now->format('d/m/Y'), 'draw_datetime' => $now->format('Y-m-d') . ' 20:00:00', 'next_expected_prize' => 0, 'value_accumulated' => 0]);
                    }
                    
                    $now = $now->addDays(1);
                }
            }
        }

        return Command::SUCCESS;
    }

    public function createConcurso($data = [], $withResults = false)
    {
        if ($withResults){
            $data += $withResults;
        }

        $newConcurso = Concurso::create($data);

        return $newConcurso;
    }

    public function retrieveConcursosResult($premiacoes = [], $lotery = NULL, $isDuplaSena = false)
    {
        $dataPremiacoes = [];
        $prizeTypes = [
            6 => 'Sena', 5 => 'Quina', 4 => 'Quadra', 3 => 'Terno', 2 => 'Duque'
        ];

        foreach($premiacoes as $index => $premiacao){
            if (! $isDuplaSena && $index == 5){
                break;
            }
            else if ($isDuplaSena && $index < 4){
                continue;
            }

            if ($lotery->initials == 'LF'){
                $prizeType = $premiacao->descricao;
            }
            else {
                $prizeTypeFromApi = str_replace(' acertos', '', $premiacao->descricao);
                $prizeType = $prizeTypes[$prizeTypeFromApi];
            }

            $newPremiacao = [];
            $newPremiacao['prize_type'] = $prizeType;
            $newPremiacao['value_prize'] = $premiacao->valorPremio;
            $newPremiacao['number_winners'] = $premiacao->ganhadores;

            $dataPremiacoes[] = $newPremiacao;
        }

        return $dataPremiacoes;
    }
}
