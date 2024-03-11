<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use App\Models\Concurso;
use App\Models\Lotery;
use Carbon\Carbon;

class CheckLatestConcursos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:concursos-of-day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Loop the active loteries and insert the daily drawn informations of the concursos';

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
            $lotery = Lotery::find($loteryId);
            $now = Carbon::now();
            $arLoteryDays = explode(',', $lotery->draw_days);

            if (! in_array($now->dayOfWeek, $arLoteryDays)){
                continue;
            }

            $lastConcursos = $response = Http::withHeaders([
                'accept' => 'application/json'
            ])->get($urlApi . $loteryAlias .'/latest', []);

            $concursoDecoded = json_decode($lastConcursos->body());
            $nConcurso = $concursoDecoded->concurso;

            $dateOfContest = Carbon::createFromFormat('d/m/Y', $concursoDecoded->data);

            // if($dateOfContest->format('d/m/Y') != $now->format('d/m/Y')){
            //     continue;
            // }

            $concurso = Concurso::where('number', $nConcurso)->where('draw_day', $dateOfContest->format('Y-m-d'))->where('lotery_id', $lotery->id)->first();

            if (! $concurso){
                Log::error('Concurso not found: N:' . json_encode($concurso) . ' - ' . ' Date:' . $concursoDecoded->format('Y-m-d'));
                continue;
            }

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

            $concurso->next_expected_prize = $concursoDecoded->valorEstimadoProximoConcurso;
            $concurso->value_accumulated = $concursoDecoded->valorAcumuladoProximoConcurso;
            $concurso->draw_numbers = $drawNumbers;
            $concurso->draw_numbers_2 = $drawNumbers2;
            $concurso->results = $dataPremiacoes;
            $concurso->results_2 = $dataPremiacoes2 && !empty($dataPremiacoes2) ? $dataPremiacoes2 : NULL;

            $concurso->save();
        }

        return Command::SUCCESS;
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
