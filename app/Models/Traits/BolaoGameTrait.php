<?php

namespace App\Models\Traits;

use App\Models\LoteryCosts;

trait BolaoGameTrait
{
    public static function boot()
    {
        parent::boot();

        static::creating(function($item) {
            $lotery_id = $item->bolao->lotery_id;
            $arNumbers = explode(',', $item->numbers);
            $qtSelected = count($arNumbers);

            $cost = LoteryCosts::where('lotery_id', $lotery_id)->where('number_matches', $qtSelected)->first();

            if (! $cost){
                throw new \Exception("Lotery costs not found");
            }

            $item->cost = $cost->prize;
        });
    }

    public function getLabelChecked()
    {
        $checked = $this->checked;

        return $checked ? "<span class='label label-success'>Sim</span>" : "<span class='label label-warning'>Não</span>";
    }

    public function getLabelPrized()
    {
        $prized = $this->prized;

        return $prized ? "<span class='label label-success'>Sim</span>" : "<span class='label label-danger'>Não</span>";
    }

    public function getFormattedPrize()
    {
        if ($this->prize <= 0){
            return "";
        }
        else {
            if(auth()->guard('web')->check()){
                $totalPrize = $this->prize;
                $valuePerPrize = $totalPrize / $this->bolao->cotas;
                $qtOwnedByUser = $this->bolao->buyers()->get()->sum('cotas');
                $prize = $valuePerPrize * $qtOwnedByUser;
            }
            else {
                $prize = $this->prize;
            }

            return 'R$' . number_format($prize, 2, ',', '.');
        }
    }

    /**
     * The number matches are the number of matches that the game has or a named match like "Sena", "Quadra" or wtv
     * @return string
     */
    public function getNumberMatch()
    {
        $number_match = $this->number_match;

        if (! $number_match){
            return "<span class='label label-warning'>Nenhuma</span>";
        }

        return is_integer($number_match) ? $number_match . ' acertos' : $number_match;
    }

    /**
     * @param $value
     */
    public function setNumbersAttribute($value)
    {
        $this->attributes['numbers'] = is_array($value) ? implode(',', $value) : $value;
    }

    public function getArNumbers($convert = TRUE)
    {
        $arNumbers = explode(',', $this->numbers);

        if ($convert){
            foreach($arNumbers as &$number){
                $number = sprintf("%02d", $number);
            }
        }

        return $arNumbers;
    }

    public function getCountNumbers()
    {
        $arNumbers = $this->getArNumbers();

        return count($arNumbers);        
    }
}