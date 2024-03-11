<?php

namespace App\Http\Transformers;

use App\Http\Transformers\BolaoGameTransformer;

class BolaoTransformer
{
    /**
     * @param array $boloes
     * @param boolean $fullData
     * @return array
     */
    public function transform($boloes, $fullData = true)
    {
        if (is_a($boloes, 'Illuminate\Database\Eloquent\Collection') ||
            is_a($boloes, 'Illuminate\Pagination\LengthAwarePaginator'))
        {
            $data = [];

            foreach($boloes as $bolao){
                $data[] = $this->doTransform($bolao);
            }

            return $data;
        }

        return $this->doTransform($boloes);
    }

    private function doTransform($bolao = null)
    {
        return [
            'id' => $bolao->id
            ,'name' => $bolao->name
            ,'lotery' => $bolao->lotery->initials
            ,'concursoNumber' => $bolao->concurso->number
            ,'done' => $bolao->done
            ,'active' => $bolao->active
            ,'name' => $bolao->name
            ,'games' => (new BolaoGameTransformer)->transform($bolao->games)
        ];
    }
}