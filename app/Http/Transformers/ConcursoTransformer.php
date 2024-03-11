<?php

namespace App\Http\Transformers;

class ConcursoTransformer
{
    /**
     * @param array $concursos
     * @param boolean $fullData
     * @return array
     */
    public function transform($concursos, $fullData = true)
    {
        if (is_a($concursos, 'Illuminate\Database\Eloquent\Collection') ||
            is_a($concursos, 'Illuminate\Pagination\LengthAwarePaginator'))
        {
            $data = [];

            foreach($concursos as $concurso){
                $data[] = $this->doTransform($concurso);
            }

            return $data;
        }

        return $this->doTransform($concursos);
    }

    private function doTransform($concurso = null)
    {
        return [
            'id' => $concurso->id,
            'lotery' => $concurso->lotery->initials,
            'number' => $concurso->number,
            'draw_day' => $concurso->draw_day
        ];
    }
}