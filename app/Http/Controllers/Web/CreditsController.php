<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\WebBaseController;
use Illuminate\Http\Request;
use App\Models\Concurso;

class CreditsController extends WebBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        if ($request->has('credits')){
            $credits = request()->get('credits');
            $creditsConverted = (float)str_replace(',', '.', str_replace('.', '', $credits));

            if ($creditsConverted < 25){
                return redirect()->back()->with(['message' => 'Valor minímo é de R$25,00', 'error' => 1]);
            }
            session()->put('payment', ['total' => $creditsConverted, 'onlyCredits' => true]);

            return redirect()->route('web.payments.index');
        }
        else {
            return view('web.credits.index');
        }
    }
}
