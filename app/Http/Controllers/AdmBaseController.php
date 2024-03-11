<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller as Controller;

class AdmBaseController extends Controller
{
    protected $repository = null;

    public function redirectWithMessage($routeInfo = [], $sessionInfo = ['type' => 'warning'])
    {
        switch($sessionInfo['type'])
        {
            case 'warning':
                $sessionInfo['icon'] = 'fa-warning';
                break;

            case 'success':
                $sessionInfo['icon'] = 'fa-check-circle';
                break;

            case 'danger':
                $sessionInfo['icon'] = 'fa-times-circle';
                break;
        }

        $routeInfo['params'] = isset($routeInfo['params']) ? $routeInfo['params'] : '';

        return redirect()->route($routeInfo['name'], $routeInfo['params'])->with($sessionInfo);
    }
}
