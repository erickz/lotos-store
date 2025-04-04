<?php

namespace App\Models\Traits;

use Carbon\Carbon;

trait ConcursoTrait
{
    public $safetyTimeForConcurso = 4;

    public function scopeWithBoloesToDo($query)
    {
        return $query->whereHas('boloes', function($q){
            $q->where('done', 0);
        })->withCount('boloes')->where('concursos.checked', 0)->orderBy('draw_datetime', 'ASC')->orderBy('boloes_count', 'DESC');
    }

    /**
     * @param $value
     */
    public function setDrawDayAttribute($value)
    {
        $this->attributes['draw_day'] = Carbon::createFromFormat('d/m/Y', $value)->format('Y-m-d');
    }

    /**
     * @param $value
     */
    public function setNextExpectedPrizeAttribute($value)
    {
        $stringWithoutDots = str_replace('.', '', $value);

        $this->attributes['next_expected_prize'] = str_replace(',', '.', $stringWithoutDots);
    }

    /**
     * @param $value
     */
    public function setValueAccumulatedAttribute($value)
    {
        $stringWithoutDots = str_replace('.', '', $value);

        $this->attributes['value_accumulated'] = str_replace(',', '.', $stringWithoutDots);
    }

    /**
     * @param $value
     */
    public function getResultsAttribute($value)
    {
        return json_decode($value);
    }

    /**
     * @param $value
     */
    public function setResultsAttribute($value)
    {
        $this->attributes['results'] = json_encode($value);
    }

    /**
     * @param $value
     */
    public function getResults2Attribute($value)
    {
        return json_decode($value);
    }


    /**
     * @param $value
     */
    public function setResults2Attribute($value)
    {
        $this->attributes['results_2'] = $value ? json_encode($value) : NULL;
    }

    /**
     * @return string
     */
    public function getDrawDay()
    {
        return Carbon::createFromFormat('Y-m-d', $this->draw_day)->format('d/m/Y');
    }

    public function getArDrawNumbers()
    {
        return explode(' ', $this->draw_numbers);
    }

    public function getArDrawNumbers2()
    {
        return explode(' ', $this->draw_numbers_2);
    }

    /**
     * @return mixed|string
     */
    public function getType()
    {
        $types = [
            1 => 'Normal'
            ,2 => 'Acumulado'
            ,3 => 'Especial'
        ];

        if (isset($types[$this->type])){
            return $types[$this->type];
        }

        return '';
    }

    public function getSpecialName(){
        $lotery = $this->lotery_id;
        
        switch($lotery)
        {
            case 1:
            {
                return 'Mega da Virada';   
                break;
            }
            case 2:
            {
                return 'Quina de São João';
                break;
            }
            case 3:
            {
                return 'Lotofácil da independência';
                break;
            }
            case 4:
            {
                return 'Dupla sena de páscoa';
                break;
            }
        }

        return '';
    }

    public function getNextExpectedPrize($prefix = TRUE)
    {
        if (! $this->next_expected_prize){
            return '<span class="position-relative"> >R$100.000,00 </span>';
        }

        return ($prefix ? 'R$' : '') . number_format($this->next_expected_prize, 2, ',', '.');
    }

    public function getValueAccumulated()
    {
        if (! $this->value_accumulated){
            return '<span class="position-relative"> >R$100.000,00 </span>';
        }

        return 'R$' . number_format($this->value_accumulated, 2, ',', '.');
    }

    public function getFormattedNextExpectedPrize()
    {
        $nextExpectedPrize = $this->next_expected_prize;
        $human_readable = new \NumberFormatter(
            'pt_BR', 
            \NumberFormatter::PADDING_POSITION
        );
        $formattedNumber = (string) $human_readable->format($nextExpectedPrize);

        if ($nextExpectedPrize == '1000000'){
            $formattedNumber = '1 milhão';
        }
        else if ($nextExpectedPrize == '1000000000'){
            $formattedNumber = '1 bilhão';
        }
        else {
            if (strlen($nextExpectedPrize) > 9){
                $formattedNumber = str_replace('bi', 'bilhões', $formattedNumber);
            }
            else if (strlen($nextExpectedPrize) > 6){
                $formattedNumber = str_replace('mi', 'milhões', $formattedNumber);
            } 
        }

        return 'R$' . $formattedNumber;
    }

    public function scopeFollowing($query)
    {
        //12 hours is the safety period to create the games
        $now = Carbon::now()->addHours($this->safetyTimeForConcurso)->format('Y-m-d H:i:s');

        return $query->where('active', 1)->where('checked', 0)->where('draw_datetime', '>', $now);
    }
}