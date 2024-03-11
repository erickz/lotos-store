<?php

namespace App\Http\Transformers;

use App\Http\Transformers\LoteryCostsTransformer;

class LoteryTransformer
{
    /**
     * @param array $loteries
     * @param boolean $fullData
     * @return array
     */
    public function transform($loteries, $fullData = true)
    {
        if (is_a($loteries, 'Illuminate\Database\Eloquent\Collection') ||
            is_a($loteries, 'Illuminate\Pagination\LengthAwarePaginator'))
        {
            $data = [];

            foreach($loteries as $lotery){
                $data[] = $this->doTransform($lotery);
            }

            return $data;
        }

        return $this->doTransform($loteries);
    }

    private function doTransform($lotery = null)
    {
        return [
            'initials' => $lotery->initials
            ,'active' => $lotery->active
            ,'name' => $lotery->name
            ,'biggest_number' => $lotery->biggest_number
            ,'description' => $lotery->description
            ,'draw_days' => $lotery->draw_days
            ,'number_games_payslip' => $lotery->number_games_payslip
            ,'min_numbers' => $lotery->min_numbers
            ,'max_numbers' => $lotery->max_numbers
            ,'created' => $lotery->getCreatedAtFormatted()
            ,'costs' => (new LoteryCostsTransformer)->transform($lotery->costs)
        ];
    }
}