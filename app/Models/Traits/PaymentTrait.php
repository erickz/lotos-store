<?php

namespace App\Models\Traits;

use App\Models\Concurso;

trait PaymentTrait
{
    public function getLabelChecked()
    {
        $checked = $this->checked;

        return $checked ? "<span class='label label-success'>Sim</span>" : "<span class='label label-warning'>Não</span>";
    }

    public function getLabelActive()
    {
        $prized = $this->prized;

        return $prized ? "<span class='label label-success'>Sim</span>" : "<span class='label label-danger'>Não</span>";
    }

    public function getQtGames($forDisplay = false)
    {
        if ($this->games){
            $qtGames = $this->games->count();

            if ($forDisplay){
                $qtGames = $qtGames . ' jogo' . (($qtGames > 1) ? 's' : '');
            }

            return $qtGames;
        }

        return 0;
    }
}