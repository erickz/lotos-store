<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\BaseController;
use App\Models\Concurso;
use Illuminate\Support\Facades\View;

use App\Models\BolaoReserve;

class WebBaseController extends BaseController
{
    public function __construct()
    {
        $allFollowingConcursos = Concurso::following()->get();
        View::share('allFollowingConcursos', $allFollowingConcursos);

        $this->doValidationCartBoloes();
    }

    public function doValidationCartBoloes()
    {
        if (session()->has('cart.boloes')){
            $boloesSess = session()->get('cart.boloes');

            foreach($boloesSess as $index => $reserveId){
                $reserve = BolaoReserve::find($reserveId);

                if (! $reserve || ! $reserve->isReserveActive() ){
                    session()->forget('cart.boloes.' . $index);
                }
            }
        }
    }

    public function calculateTheCreditsDiffToPay($totalToPay = 0, $credits = 0){
        if($totalToPay > $credits){
            $toPayDiff = $totalToPay - $credits;

            //The payment gateways have a minimum value, this ensure this is not broke
            if($toPayDiff < 5){
                session()->put('payment.isMinimum', value: true);
                $toPayDiff = 6;
            }

            return $toPayDiff;
        }

        return $totalToPay;
    }
}
