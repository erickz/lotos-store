<?php

namespace App\Models\Traits;

use App\Models\Concurso;
use Carbon\Carbon;

trait BolaoTrait
{
    /**
     * It's necessary to add safety hours in order to have time to register the games in the official lotery
     * This var is measured by hours and used to that
     */
    protected $safetyTimeForBolao = 2;
    protected $timelimitCart = 15;
    //Equivalent to 13% for each cota
    protected $taxPlatform = 0.13;
    
    public static function boot()
    {
        parent::boot();

        static::saving(function($item) {
            if(strpos($item->price, ',')){
                $item->price = floatval($item->price);
            }
            
            $concurso = Concurso::find($item->concurso_id);

            if (! $concurso)
                $item->lotery_id = null;

            $item->lotery_id = $concurso->lotery_id;
        });
    }

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

    public function getShortGames()
    {
        return $this->games()->select('id', 'numbers', 'cost')->orderBy('id', 'DESC')->get();
    }

    public function getFormattedPrize()
    {
        if ($this->prize <= 0){
            return "";
        }
        else {
            if(auth()->guard('web')->check()){
                $totalPrize = $this->prize;
                $valuePerPrize = $totalPrize / $this->cotas;
                $qtOwnedByUser = $this->buyers()->where('customer_id', auth()->guard('web')->user()->id)->get()->sum('cotas');
                $prize = $valuePerPrize * $qtOwnedByUser;
            }
            else {
                $prize = $this->prize;
            }

            return 'R$' . number_format($prize, 2, ',', '.');
        }
    }

    public function getFormattedPrice()
    {
        return 'R$' . number_format($this->price, 2, ',', '.');
    }

    public function getFormattedTotalWithCotas($cotas = 0)
    {
        if ($cotas > 0){
            return 'R$' . number_format($this->price * $cotas, 2, ',', '.');
        }

        return '';
    }

    public function getFormattedOwnerReceipt()
    {
        if ($this->buyers->count() <= 0){
            return "R$ 0,00";
        }

        $total = 0.00;
        foreach($this->buyers as $buyer){
            $total += $buyer->cotas * $this->price;
        }        

        return 'R$' . number_format($total, 2, ',', '.');
    }

    /**
     * This isn't actually the profit but the receipt with taxes applied, as we would have have to subtract this 
     * value by the cost to match the exact idea of profit.
     *
    */
    public function getProfit()
    {
        if ($this->buyers->count() <= 0){
            return 0;
        }
        
        $selledCotas = $this->buyers()->where('is_owner', 0)->get()->sum('cotas');
        $revenue = $selledCotas * $this->price;

        $platformTax = ($this->price * $this->taxPlatform) * $selledCotas;
        $finalProfitForUser = $revenue - $platformTax;

        return $finalProfitForUser;
    }

    public function getFormattedProfit()
    {
        return 'R$' . number_format($this->getProfit(), 2, ',', '.');
    }

    //Takes the reserves in consideration in order to display the available cotas
    public function getAvailableCotas()
    {
        $availableCotas = $this->cotas_available;
        $queryReserves = $this->reserves();

        if (session()->has('cart.boloes')){
            $excludeIds = session()->get('cart.boloes');

            $queryReserves = $queryReserves->whereNotIn('id', $excludeIds);
        }

        $reservedCotas = $queryReserves->selectRaw('SUM(cotas) as totalCotas')->isActive()->first();

        $availableCotas = ($reservedCotas->totalCotas && $reservedCotas->totalCotas > 0) ? $availableCotas - $reservedCotas->totalCotas : $availableCotas;

        return $availableCotas <= 0 ? 0 : $availableCotas;
    }

    /**
     * 
     */
    public function getBolaoGrade()
    {
        $games = $this->games;
        $totalGames = 0;

        foreach($games as $game){
            $totalGames += $game->cost; 
        }
        
        if ($totalGames >= 500){
            return 'Nível 3';
        }
        else if ($totalGames >= 100){
            return 'Nível 2';
        }
        else {
            return 'Nível 1';
        }
    }

    /**
     * 
     */
    public function getGamesCount()
    {
        return $this->games()->get()->count();
    }

    /**
     * Calculate and retrieve the bolao status
     * return @string
     */
    public function getStatus()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $contestTime = Carbon::createFromFormat("Y-m-d H:i:s",$this->concurso->draw_datetime)->format('Y-m-d H:i:s');

        if ($this->repayed){
            return '<label class="position-relative"><b class="text-danger">Reembolsado</b><i class="cursor-pointer fa fa-question-circle position-absolute 
            top-0 start-100 translate-middle tooltips font-smaller" data-toggle="tooltip" data-placement="top" 
            data-html="true" title="<b>NOTA:</b> Este bolão foi cancelado devido a circunstâncias imprevistas que impossibilitaram a realização do jogo. Lamentamos qualquer inconveniente e estamos à disposição para auxiliá-lo em qualquer dúvida ou problema. Seus créditos foram devidamente reembolsados de acordo com nossa política de reembolso."></i></label>';
        }
        else if (! $this->active){
            return '<label><b class="text-warning">Aguardando pagamento</b></label>';
        }
        else if ($now <= $contestTime){
            return '<label><b class="text-success">Ativo</b></label>';
        }
        else {
            if ($this->checked && $this->prize > 0){
                if (! $this->concurso->prized){
                    return '<label class="position-relative"><b class="text-success"><i class="fas fa-star text-success"></i> Premiado</b><i class="cursor-pointer fa fa-question-circle position-absolute 
                    top-0 start-100 translate-middle tooltips font-smaller" data-toggle="tooltip" data-placement="top" 
                    data-html="true" title="Em instantes será creditado em sua conta o valor do prêmio proporcional a suas cotas!"></i></label>';
                }
                else {
                    return '<label class="position-relative"><b class="text-success"><i class="fas fa-star text-success"></i> Premiado</b></label>';
                }
            }
            else if($this->checked) {
                return '<label><b class="text-success">Verificado</b></label>';
            }

            return '<label><b class="text-primary">Aguardando conferência</b></label>';
        }
    }

    public function isValidToBuy()
    {
        $now = Carbon::now()->format('Y-m-d H:i:s');
        $baseForValidTime = Carbon::createFromFormat("Y-m-d H:i:s",$this->concurso->draw_datetime)->subHours($this->safetyTimeForBolao)->format('Y-m-d H:i:s');

        if ($now >= $baseForValidTime || ! $this->display_for_selling){
            return false;
        }
        else {
            return true;
        }
    }

    public function scopeIsValidToDisplay($query)
    {
        return $query
        ->whereHas('reserves', function($reserve){
            $reserve->select(\DB::raw('IF(SUM(cotas) IS NULL, 0, SUM(cotas)) as totalCotas'))->where('expiration_date', '>', \Carbon\Carbon::now()->format('Y-m-d H:i:s'))->where('processed', 0)
                ->havingRaw('boloes.cotas_available > totalCotas');
        })
        ->where('boloes.active', 1)->where('boloes.display_for_selling', 1)->where('cotas_available', '>', 0)->where('boloes.repayed', 0)->where('boloes.checked', 0)->IsValidDateToPlay();
    }

    public function scopeIsValidDateToPlay($query)
    {
        return $query->whereHas('concurso', function($concurso){
            $concurso->whereRaw('(draw_datetime - INTERVAL ' . $this->safetyTimeForBolao . ' HOUR) >= "' . \Carbon\Carbon::now()->format('Y-m-d H:i:s') . '"');
        });
    }

    public function buildShareButtons()
    {
        $url = url()->current() . '?bolao_id=' . $this->id;
        $shareButtons = \Share::page($url, '🎉🏆 Junte-se a Bolões vencedores e receba prêmios imperdíveis! 🏆

        🔥 Confira os jogos do Bolão "' . $this->name . '", da ' . $this->lotery->name . '. Participe e ganhe até ' . $this->concurso->getNextExpectedPrize() . '! 💰🚀
        
        👉 ' . $url)
            ->facebook()
            ->twitter()
            ->telegram()
            ->whatsapp()
        ;

        return $shareButtons;
    }

    //Verify wheter It can transaction cotas
    public function canTransactionCotas()
    {
        if ($this->checked){
            return false;
        }

        if ($this->repayed){
            return false;
        }

        if (! $this->active){
            return false;
        }

        $concursoDatetime = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->concurso->draw_datetime)->subHours(3)->format('Y-m-d H:i');
        $now = \Carbon\Carbon::now()->format('Y-m-d H:i');
        
        //Verify if It has at least 3 hours before the concurso happens
        if ($now >= $concursoDatetime ){
            return false;
        }

        return true;
    }

    public function getFormattedInvites()
    {
        $arInvites = [];

        foreach($this->invites()->orderBy('id', 'DESC')->get() as $invite){
            $newInvite = [];

            if($invite->claimed){
                $status = '<label class="label-inline label label-success">Recebido</label>';
            }
            else {
                $status = '<label class="label-inline label label-warning">Aguardando recebimento</label>';
                $now = \Carbon\Carbon::now()->format('Y-m-d H:i:s');

                if ($now >= $invite->expire_at){
                    $status = '<label class="label-inline label label-danger">Convite Expirado</label>';
                }
            }

            $newInvite['email'] = $invite->email;
            $newInvite['status'] = $status;
            $newInvite['cotas'] = $invite->cotas;

            $arInvites[] = $newInvite;            
        }

        return $arInvites;
    }

    public function getLblChances($short = false)
    {
        $labelType = 'label-primary';
        if($this->chances){
            if ($this->chances >= 50){
                $labelType = 'label-danger';
            }
            else if ($this->chance >= 100){
                $labelType = 'label-dark';
            }
            return '<label class="label label-inline ' . $labelType .  ' label-lg font-larger"><b>' . $this->chances . 'x MAIS CHANCES ' . ($short ? '' : 'DE GANHAR') . '</b></label>';
        }
        else {
            return '';
        }
    }
}