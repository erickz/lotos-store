<?php

namespace App\Http\Transformers;

class LoteryCostsTransformer
{
    /**
     * @param array $loteryCosts
     * @param boolean $fullData
     * @return array
     */
    public function transform($loteryCosts, $fullData = true)
    {

        if (is_a($loteryCosts, 'Illuminate\Database\Eloquent\Collection') ||
            is_a($loteryCosts, 'Illuminate\Pagination\LengthAwarePaginator'))
        {
            $data = [];

            foreach($loteryCosts as $loteryCost){
                $data[] = $this->doTransform($loteryCost);
            }

            return $data;
        }

        return $this->doTransform($loteryCosts);
    }

    private function doTransform($loteryCost = null)
    {
        $transformed = [
            'number_matches' => $loteryCost->number_matches
            ,'prize' => $loteryCost->prize
        ];

        if ($loteryCost->lotery->initials == 'LC'){
            $transformed['double'] = $loteryCost->double;
            $transformed['triple'] = $loteryCost->triple;
        }

        return $transformed;
    }
}