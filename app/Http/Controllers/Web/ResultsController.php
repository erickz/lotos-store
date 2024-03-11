<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\WebBaseController;
use Illuminate\Http\Request;

use App\Models\Concurso;
use App\Models\Lotery;

class ResultsController extends WebBaseController
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

    public function index()
    {
        $now = \Carbon\Carbon::now()->format('Y-m-d H:i:s');

        $concursos = Concurso::where('draw_datetime', '<=', $now)->whereNotNull('draw_numbers')->whereNotNull('results')->orderBy('draw_datetime', 'DESC')->take('15')->paginate(15);

        return view('web.results', ['concursos' => $concursos]);
    }

    public function displayByLotery($loteryName = 'megasena')
    {
        $now = \Carbon\Carbon::now()->format('Y-m-d H:i:s');

        $lotery = Lotery::getBySlug($loteryName)->first();
        $loteries = Lotery::where('active', '1')->whereNot('id', $lotery->id)->get();

        if (! $lotery){
            return redirect()->route('web.home');
        }

        $concursos = Concurso::where('draw_datetime', '<=', $now)->whereNotNull('results')->where('lotery_id', $lotery->id)->orderBy('draw_datetime', 'ASC')->take('15')->paginate(15);

        return view('web.results_lotery', ['concursos' => $concursos, 'lotery' => $lotery, 'loteries' => $loteries]);
    }
}
