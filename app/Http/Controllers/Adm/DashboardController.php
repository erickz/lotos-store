<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\AdmBaseController;
use Illuminate\Support\Facades\Auth;

use App\Models\Customer;
use App\Models\Bolao;

class DashboardController extends AdmBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function index()
    {
        $startOfWeek = \Carbon\Carbon::now()->startOfWeek()->format('Y-m-d');
        $endOfWeek = \Carbon\Carbon::now()->endOfWeek()->format('Y-m-d');
        
        $newCustomers = Customer::select('id')->where('created_at', '>=', $startOfWeek . ' 00:00:00')->where('created_at', '<=', $endOfWeek . ' 23:59:59')->get()->count();
        $newBoloes = Bolao::select('id')->where('created_at', '>=', $startOfWeek . ' 00:00:00')->where('created_at', '<=', $endOfWeek . ' 23:59:59')->get()->count();
        $profit = Bolao::select('id', 'total_value')->where('created_at', '>=', $startOfWeek . ' 00:00:00')->where('created_at', '<=', $endOfWeek . ' 23:59:59')->get()->sum("total_value");
        $views = Bolao::select('id', 'visits')->where('created_at', '>=', $startOfWeek . ' 00:00:00')->where('created_at', '<=', $endOfWeek . ' 23:59:59')->get()->sum("visits");

        return view('adm.dashboard', compact('newCustomers', 'newBoloes', 'profit',  'views'));
    }
}
