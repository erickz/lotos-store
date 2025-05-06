<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

use App\Repositories\Contracts\ConcursoRepositoryInterface;

use App\Models\BolaoSuggestion;
use App\Models\LoteryCosts;
use Carbon\Carbon;

class CreateBoloesSuggestions extends Command
{
    //This is the general tax of the platform for each cota selled, which is 19% for now
    protected $taxPlatform = 0.19
    ;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:boloes-suggestions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create suggestions models and register them';

    public $repository = NULL;

    public function __construct(ConcursoRepositoryInterface $repository)
    {
        $this->repository = $repository;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $data = $this->getModels();
            
            foreach($data as $row){
                $row['qt_bets'] = array_sum($row['bets']);
    
                $totalPrice = 0;
                $totalChances = 0;
                foreach($row['bets'] as $dozens => $qt){
                    $costs = LoteryCosts::where('lotery_id', $row['lotery_id'])->where('number_matches', $dozens)->first();
                    
                    $totalPrice += $costs->cost * $qt;
                    $totalChances += $costs->chances * $qt;
                }
    
                $baseNumForCotas = $totalPrice * 1.4;
                $priceCota = $this->selectBestPrice($totalPrice);
                $cotas = $baseNumForCotas / $priceCota;
                $cotas = round($cotas) == 1 ? 2 : round($cotas);
                $revenue = $priceCota * $cotas;
                $taxPlatform = ($priceCota * $this->taxPlatform) * $cotas;
                $totalReceipt = ($revenue - $taxPlatform);
                                
                $row['price'] = $totalPrice;
                $row['price_cota'] = $priceCota;
                $row['bets'] = json_encode($row['bets']);
                $row['chances'] = $totalChances;
                $row['cotas'] = $cotas * 4;
                $row['receipt'] = $totalReceipt;
    
                $suggestion = BolaoSuggestion::create($row);
            }
        }
        catch(\Exception $e){
            Log::error('Something went wrong when checking the boloes');
        }

        return Command::SUCCESS;
    }


    public function selectBestPrice($totalPrice = [])
    {
        $arrayPrices = ['7.5', '15', '25', '35', '45', '75', '100', '150', '300', '600', '800', '1000'];
        $bestPrice = null;

        $selectedIndex = 0;
        foreach($arrayPrices as $index => $price)
        {
            if ($price > $totalPrice){
                break;
            }

            $selectedIndex = $index;
        }

        if (isset($arrayPrices[$selectedIndex / 2])){
            $selectedIndex = $selectedIndex / 2;
        }

        $bestPrice = $arrayPrices[$selectedIndex];

        return $bestPrice;
    }

    public function getModels()
    {
        return [
            //Megasena
            [
                'lotery_id' => 1,
                'name' => 'Bolão Básico',
                'bets' => ['6' => 2],
                'qt_bets' => NULL,
                'price' => NULL,
                'chances' => NULL,
                'receipt' => NULL
            ],
            [
                'lotery_id' => 1,
                'name' => 'Bolão Avançado',
                'bets' => ['6' => 6],
                'qt_bets' => NULL,
                'price' => NULL,
                'chances' => NULL,
                'receipt' => NULL
            ],
            [
                'lotery_id' => 1,
                'name' => 'Bolão Master',
                'bets' => ['7' => 2, '6' => 4],
                'qt_bets' => NULL,
                'price' => NULL,
                'chances' => NULL,
                'receipt' => NULL
            ],
            [
                'lotery_id' => 1,
                'name' => 'Bolão Supremo',
                'bets' => ['8' => 1, '7' => 1, '6' => 5],
                'qt_bets' => NULL,
                'price' => NULL,
                'chances' => NULL,
                'receipt' => NULL
            ],
            //Quina
            [
                'lotery_id' => 2,
                'name' => 'Bolão Básico',
                'bets' => ['5' => 4],
                'qt_bets' => NULL,
                'price' => NULL,
                'chances' => NULL,
                'receipt' => NULL
            ],
            [
                'lotery_id' => 2,
                'name' => 'Bolão Avançado',
                'bets' => ['6' => 1, '5' => 7],
                'qt_bets' => NULL,
                'price' => NULL,
                'chances' => NULL,
                'receipt' => NULL
            ],
            [
                'lotery_id' => 2,
                'name' => 'Bolão Master',
                'bets' => ['7' => 1, '6' => 1, '5' => 10],
                'qt_bets' => NULL,
                'price' => NULL,
                'chances' => NULL,
                'receipt' => NULL
            ],
            [
                'lotery_id' => 2,
                'name' => 'Bolão Supremo',
                'bets' => ['8' => 1, '7' => 1, '5' => 3],
                'qt_bets' => NULL,
                'price' => NULL,
                'chances' => NULL,
                'receipt' => NULL
            ],
            //Lotofacil
            [
                'lotery_id' => 3,
                'name' => 'Bolão Básico',
                'bets' => ['15' => 3],
                'qt_bets' => NULL,
                'price' => NULL,
                'chances' => NULL,
                'receipt' => NULL
            ],
            [
                'lotery_id' => 3,
                'name' => 'Bolão Avançado',
                'bets' => ['15' => 12],
                'qt_bets' => NULL,
                'price' => NULL,
                'chances' => NULL,
                'receipt' => NULL
            ],
            [
                'lotery_id' => 3,
                'name' => 'Bolão Master',
                'bets' => ['16' => 1, '15' => 15],
                'qt_bets' => NULL,
                'price' => NULL,
                'chances' => NULL,
                'receipt' => NULL
            ],
            [
                'lotery_id' => 3,
                'name' => 'Bolão Supremo',
                'bets' => ['16' => 3, '15' => 19],
                'qt_bets' => NULL,
                'price' => NULL,
                'chances' => NULL,
                'receipt' => NULL
            ],
            //Duplasena
            [
                'lotery_id' => 4,
                'name' => 'Bolão Básico',
                'bets' => ['6' => 4],
                'qt_bets' => NULL,
                'price' => NULL,
                'chances' => NULL,
                'receipt' => NULL
            ],
            [
                'lotery_id' => 4,
                'name' => 'Bolão Avançado',
                'bets' => ['7' => 1, '6' => 6],
                'qt_bets' => NULL,
                'price' => NULL,
                'chances' => NULL,
                'receipt' => NULL
            ],
            [
                'lotery_id' => 4,
                'name' => 'Bolão Master',
                'bets' => ['8' => 1,'7' => 1, '6' => 2],
                'qt_bets' => NULL,
                'price' => NULL,
                'chances' => NULL,
                'receipt' => NULL
            ],
            [
                'lotery_id' => 4,
                'name' => 'Bolão Supremo',
                'bets' => ['8' => 2, '7' => 1, '6' => 17],
                'qt_bets' => NULL,
                'price' => NULL,
                'chances' => NULL,
                'receipt' => NULL
            ],
        ];
    }
}
