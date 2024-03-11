<?php

namespace App\Http\Transformers;

class BolaoGameTransformer
{
    /**
     * @param array $bolaoGames
     * @param boolean $fullData
     * @return array
     */
    public function transform($bolaoGames, $fullData = true)
    {

        if (is_a($bolaoGames, 'Illuminate\Database\Eloquent\Collection') ||
            is_a($bolaoGames, 'Illuminate\Pagination\LengthAwarePaginator'))
        {
            $data = [];

            foreach($bolaoGames as $bolaoGame){
                $data[] = $this->doTransform($bolaoGame);
            }

            return $data;
        }

        return $this->doTransform($bolaoGames);
    }

    private function doTransform($bolaoGame = null)
    {
        $transformed = [
            'id' => $bolaoGame->id
            ,'bolao_id' => $bolaoGame->bolao_id
            ,'bolao' => $bolaoGame->bolao->name
            ,'checked' => $bolaoGame->getLabelChecked()
            ,'prized' => $bolaoGame->getLabelPrized()
            ,'number_match' => $bolaoGame->getNumberMatch()
            ,'qtGames' => $bolaoGame->quantity_numbers
            ,'minLoteryNum' => $bolaoGame->bolao->lotery->min_numbers
            ,'numbers' => $bolaoGame->numbers
            ,'created' => $bolaoGame->getCreatedAtFormatted(false)
        ];

        return $transformed;
    }
}