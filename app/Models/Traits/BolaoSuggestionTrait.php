<?php

namespace App\Models\Traits;

trait BolaoSuggestionTrait
{
    public function getPrice()
    {
        return 'R$' . number_format($this->price, 2, ',', '.');
    }

    public function getReceipt()
    {
        return 'R$' . number_format($this->receipt, 2, ',', '.');
    }

    public function generateGames()
    {
        $games = [];
        $bets = json_decode($this->bets, true);

        foreach($bets as $dozens => $qtBet){
            for($i = 0; $i < $qtBet; $i++){
                $game = $this->generateGame($dozens, $this->lotery->biggest_number);
                $games[] = $game;
            }
        }

        usort($games, function($a, $b){
            return count($b) - count($a);
        });

        return $games;
    }

    public function generateGame($numbersToGenerate = 6, $maxNumbers = 60)
    {
        $arNumbers = [];
        for($i = 0; $i < $numbersToGenerate; $i++){
            
            $repeat = 1;
            $generatedN = 0;
            while($repeat == 1)
            {
                $generatedN = random_int(1, $maxNumbers);

                if (! isset($arNumbers[$generatedN])){
                    $repeat = 0;
                }
            }

            $arNumbers[$generatedN] = $generatedN;
        }

        sort($arNumbers);

        return $arNumbers;
    }

    public function getBets()
    {
        $arBets = json_decode($this->bets, true);

        krsort($arBets);

        return $arBets;
    }

    public function buildDescription()
    {
        $html = '';
        foreach( $this->getBets() as $index => $bet ){
            $html .= "<li class='w-75 m-auto d-flex justify-content-center'><span><b>" . $bet . "</b> aposta" . ($bet > 1 ? 's ' : ' ') . "de </span>  <b class='ms-1'>" . $index . " dezenas</b></li>";
        }

        return $html;
    }

    public function buildName($loteryAlias = 'MG', $concursoNumber = '1')
    {
        return $this->name . ' - ' . strtoupper($loteryAlias) . $concursoNumber . rand(1,9999);
    }
}