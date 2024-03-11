<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CrudGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:generator 
            {name : Class (singular) for example User}  ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Build the CRUD by generating a set of files';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected function getVarsToReplace($name = '', $file = '')
    {
        return str_replace(
            [
                '{{modelName}}',
                '{{modelNamePlural}}',
                '{{modelNamePluralLowerCase}}',
                '{{modelNameSingularLowerCase}}'
            ],
            [
                $name,
                Str::plural($name),
                strtolower(Str::plural($name)),
                strtolower($name)
            ],
            $this->getStub($file)
        );
    }

    protected function getStub($type)
    {
        return file_get_contents(resource_path('stubs/' . $type . '.stub'));
    }

    protected function model($name)
    {
        $template = $this->getVarsToReplace($name, 'Model');

        file_get_contents(app_path("Models/{$name}.php"), $template);
    }

    protected function controller($name)
    {
        $template = $this->getVarsToReplace($name, 'CrudController');

        file_put_contents(app_path("/Http/Controllers/Adm/" . Str::plural($name) . "Controller.php"), $template);
    }

    /**
     * Repository and contract
     * @param $name
     */
    protected function repository($name)
    {
        $templateInterface = $this->getVarsToReplace($name, 'RepositoryInterface');
        $template = $this->getVarsToReplace($name, 'Repository');

        file_put_contents(app_path("/Repositories/Contracts/{$name}RepositoryInterface.php"), $templateInterface);
        file_put_contents(app_path("/Repositories/{$name}Repository.php"), $template);
    }

    /**
     * Request for Store and Update
     * @param $name
     */
    protected function request($name)
    {
        $template = $this->getVarsToReplace($name, 'Request');

        file_put_contents(app_path("/Http/Requests/Store{$name}.php"), $template);
        file_put_contents(app_path("/Http/Requests/Update{$name}.php"), $template);
    }

    /**
     * The view of the CRUD
     * @param $name
     */
    protected function views($name)
    {
        $templateC = $this->getVarsToReplace($name, 'views/create');
        $templateE = $this->getVarsToReplace($name, 'views/edit');
        $templateI = $this->getVarsToReplace($name, 'views/index');
        $templateL = $this->getVarsToReplace($name, 'views/listing');

        $pluralName = strtolower(Str::plural($name));

        File::makeDirectory(resource_path('views/adm/' . $pluralName));

        file_put_contents(resource_path("views/adm/" . $pluralName . "/create.blade.php"), $templateC);
        file_put_contents(resource_path("views/adm/" . $pluralName . "/edit.blade.php"), $templateE);
        file_put_contents(resource_path("views/adm/" . $pluralName . "/index.blade.php"), $templateI);
        file_put_contents(resource_path("views/adm/" . $pluralName . "/listing.blade.php"), $templateL);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');

//        $this->model($name);
        $this->controller($name);
        $this->request($name);
        $this->repository($name);
        $this->views($name);

        // !IMPORTANT: You must build the ROUTES and bind the REPOSITORY afterwards yourself
        $this->info('CRUD created with success');
        $this->warn('Notice: You must write the routes and bind the repositories yourself');
    }
}
