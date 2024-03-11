<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoriesProvider extends ServiceProvider
{
    private $basePath = '';
    private $modules = '';

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->basePath = "App\Repositories\\";
        $this->modules = [
            'User'
            ,'Permission'
            ,'Customer'
            ,'CustomerBank'
            ,'Lotery'
            ,'Concurso'
            ,'Bolao'
            ,'Payment'
            ,'Pagseguro'
            ,'Blog'
        ];

        foreach ($this->modules as $module)
        {
            $this->bindRepositories(
                $module . 'RepositoryInterface'
                , $module . 'Repository'
            );
        }
    }

    /**
     *
     * @param string $interface
     * @param $repository
     */
    public function bindRepositories($interface = '', $repository = '')
    {
        $contract = $this->basePath . 'Contracts\\' . $interface;
        $repository = $this->basePath . $repository;

        $this->app->bind($contract, $repository);
    }
}
