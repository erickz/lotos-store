<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\WebBaseController;
use App\Repositories\Contracts\BolaoRepositoryInterface;
use Illuminate\Http\Request;

class HomeController extends WebBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BolaoRepositoryInterface $repository)
    {
        $this->repository = $repository;

        parent::__construct();
    }

    public function index()
    {
        if (auth()->guard('web')->check()){
            return redirect()->route('web.customers.profile');
        }
        
        $boloesSelected = collect();

        $mainListingBoloes = $this->repository->getSpecialBoloes($boloesSelected->pluck('id')->toArray());
        $boloesSelected = $boloesSelected->merge($mainListingBoloes);

        $biggestChances = $this->repository->getMainListing($boloesSelected->pluck('id')->toArray());
        $boloesSelected = $boloesSelected->merge($biggestChances);

        // $mostEconomics = $this->repository->getMostEconomics($boloesSelected); 

        return view('web.home.index', ['boloes' => $boloesSelected]);
    }

    public function notfound()
    {
        return view('web.404');
    }
}
