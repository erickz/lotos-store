<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\BolaoSuggestion;
use App\Models\LoteryCosts;

class generateBoloesSuggestionsMg extends Seeder
{
    //This is the general tax of the platform for each cota selled, which is 19% for now
    protected $taxPlatform = 0.19;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'lotery_id' => 1,
                'name' => 'Bolão Básico',
                'bets' => ['6' => 8],
                'qt_bets' => NULL,
                'price' => NULL,
                'chances' => NULL,
                'receipt' => NULL
            ],
            [
                'lotery_id' => 1,
                'name' => 'Bolão Intermediário',
                'bets' => ['7' => 1, '6' => 8],
                'qt_bets' => NULL,
                'price' => NULL,
                'chances' => NULL,
                'receipt' => NULL
            ],
            [
                'lotery_id' => 1,
                'name' => 'Bolão Avançado',
                'bets' => ['7' => 1, '6' => 10],
                'qt_bets' => NULL,
                'price' => NULL,
                'chances' => NULL,
                'receipt' => NULL
            ],
            [
                'lotery_id' => 1,
                'name' => 'Bolão Premium',
                'bets' => ['7' => 2, '6' => 10],
                'qt_bets' => NULL,
                'price' => NULL,
                'chances' => NULL,
                'receipt' => NULL
            ],
            [
                'lotery_id' => 1,
                'name' => 'Bolão Vip',
                'bets' => ['8' => 2, '7' => 2, '6' => 17],
                'qt_bets' => NULL,
                'price' => NULL,
                'chances' => NULL,
                'receipt' => NULL
            ],
            [
                'lotery_id' => 1,
                'name' => 'Bolão Elite',
                'bets' => ['9' => 1, '8' => 2, '7' => 3, '6' => 50],
                'qt_bets' => NULL,
                'price' => NULL,
                'chances' => NULL,
                'receipt' => NULL
            ],
        ];
        
        
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
            $row['cotas'] = $cotas;
            $row['receipt'] = $totalReceipt;

            BolaoSuggestion::create($row);
        }
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
}
