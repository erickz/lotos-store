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
        // $urlApi = 'https://loteriascaixa-api.herokuapp.com/api/';
        $loteries = [
            01 => 'megasena',
            02 => 'quina',
            03 => 'lotofacil',
            04 => 'duplasena'
        ];

        foreach($loteries as $loteryId => $loteryAlias){
            $lotery = Lotery::find($loteryId);
            $now = Carbon::now();
            // $arLoteryDays = explode(',', $lotery->draw_days);
            $urlApi = 'https://apiloterias.com.br/app/v2/resultado';

            // if (! in_array($now->dayOfWeek, $arLoteryDays)){
            //     continue;
            // }

            $lastConcursos = $response = Http::withHeaders([
                'accept' => 'application/json'
            ])->get($urlApi, [
                'loteria' => $loteryAlias,
                'token' => env("API_RESULTS_TOKEN")
            ]);

            $concursoDecoded = json_decode($lastConcursos->body());

            \Log::info(print_r($concursoDecoded, true));

            $nConcurso = $concursoDecoded->numero_concurso;

            $dateOfContest = Carbon::createFromFormat('d/m/Y', $concursoDecoded->data_concurso);

            // if($dateOfContest->format('d/m/Y') != $now->format('d/m/Y')){
            //     continue;
            // }

            $concurso = Concurso::where('number', $nConcurso)->where('draw_day', $dateOfContest->format('Y-m-d'))->where('lotery_id', $lotery->id)->first();

            \Log::info(print_r($concurso, true));

            if (! $concurso){
                Log::error('Concurso not found: N:' . json_encode($concurso) . ' - ' . ' Date:' . $dateOfContest->format('Y-m-d'));
                continue;
            }

            $dataPremiacoes = [];
            $dataPremiacoes2 = [];

            $drawNumbers = implode(' ', $concursoDecoded->dezenas);
            $dataPremiacoes = $this->retrieveConcursosResult($concursoDecoded->premiacao, $lotery);

            $drawNumbers2 = NULL;
            if ($lotery->initials == 'DS'){
                $drawNumbers = implode(' ', $concursoDecoded->dezenas);
                $drawNumbers2 = implode(' ', $concursoDecoded->dezenas_2);

                $dataPremiacoes2 = $this->retrieveConcursosResult($concursoDecoded->premiacao, $lotery, true);
            }

            $concurso->next_expected_prize = $concursoDecoded->valor_estimado_proximo_concurso;
            $concurso->value_accumulated = $concursoDecoded->valor_acumulado_especial;
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
                $prizeType = $premiacao->quantidade_acertos;
            }
            else {
                $prizeTypeFromApi = str_replace(' acertos', '', $premiacao->quantidade_acertos);
                $prizeType = $prizeTypes[$prizeTypeFromApi];
            }

            $newPremiacao = [];
            $newPremiacao['prize_type'] = $prizeType;
            $newPremiacao['value_prize'] = $premiacao->valor_premio;
            $newPremiacao['number_winners'] = $premiacao->numero_ganhadores;

            $dataPremiacoes[] = $newPremiacao;
        }

        return $dataPremiacoes;
    }
}
