<?php

namespace App\Models\Traits;

use Illuminate\Support\Str;

trait LoteryTrait
{
    public function getSlug()
    {
        return Str::slug($this->name, '');
    }

    /**
     * Format and retrieve the draw days
     *
     * @return string
     */
    public function getFormatedDrawDays()
    {
        $daysWeek = [
            '1' => 'Domingo'
            ,'2' => 'Segunda'
            ,'3' => 'Terça'
            ,'4' => 'Quarta'
            ,'5' => 'Quinta'
            ,'6' => 'Sexta'
            ,'7' => 'Sábado'
        ];


        $arDrawDays = explode(',', $this->draw_days);

        $formatedDrawDays = '';

        foreach ($arDrawDays as $index => $day)
        {
            $formatedDrawDays .= $daysWeek[$day];

            $formatedDrawDays .= $index+1 == count($arDrawDays) ? '' : ', ';
        }

        return $formatedDrawDays;
    }

    public function getCostsJson()
    {
        $costs = $this->costs()->pluck('cost', 'number_matches');

        return json_encode($costs);
    }

    public function getChancesJson()
    {
        $chances = $this->costs()->pluck('chances', 'number_matches');

        return json_encode($chances);
    }

    public function getLabelInitials()
    {
        $color = $this->getColorClass();

        return '<label class="p-2 rounded-circle border border-secondary min-w-35px text-white text-center bg-' . $color . '"><strong>' . $this->initials . '</strong></label>';
    }

    public function getLabelName()
    {
        $color = $this->getColorClass();

        return '<label class="p-2 border-radius border border-secondary min-w-35px text-white text-center bg-' . $color . '"><strong>' . $this->name . '</strong></label>';
    }

    public function getColorClass($withAdditionals = true)
    {
        switch($this->initials){
            case 'MG':
            {
                return 'success';
            }
            case 'QN':
            {
                return 'primary';
            }
            case 'DS':
            {
                return 'danger';
            }
            case 'LF':
            {
                return $withAdditionals ? 'info2' : 'info';
            }
        }

        return '';
    }

    public function scopeGetBySlug($query, $loteryName = 'megasena')
    {
        return $query->whereRAW("REPLACE(LOWER(`loteries`.`name`), ' ', '') = '" . $loteryName . "'");
    }

    // public function calculateChances($games = [])
    // {
    //     $stats = $this->stats;
    //     $minimumStats = $this->stats()->orderBy('number_dozens', 'ASC')->first();

    //     $statsCount = [];
    //     foreach($games as $game){
    //         $arGame = explode(',', $game);
    //         $nDozens = count($arGame);
    //         $odds = NULL;
    //         $stats->contains(function($value, $key) use ($nDozens, &$odds){
    //             if($nDozens == $value->number_dozens){
    //                 $odds = $value->odds;

    //                 return true;
    //             }
    //             else{
    //                 return false;
    //             }  
    //         });

    //         if (! isset($statsCount[$nDozens])){
    //             $statsCount[$nDozens]['count'] = 0;
    //             $statsCount[$nDozens]['odds'] = $odds;
    //         }

    //         $statsCount[$nDozens]['count']++;
    //     }
        
    //     $finalChance = 0;
    //     foreach($statsCount as $stat){
    //         $chances = intval(str_replace('.', '',$minimumStats->odds)) / intval(str_replace('.', '',$stat['odds']));
    //         $chances = $chances * $stat['count'];

    //         $finalChance += $chances;
    //     }

    //     return $finalChance;
    // }
    
    public function calculateChances($games = [], $loteryId = NULL)
    {
        $chances = 0;
        foreach($games as $game){
            $arGame = is_array($game) ? $game : explode(',', $game);
            $dozens = count($arGame);
            $costs = \App\Models\LoteryCosts::where('lotery_id', $loteryId)->where('number_matches', $dozens)->first();
            $chance = $costs->chances;
            
            $chances += $chance;
        }

        return $chances;
    }
}