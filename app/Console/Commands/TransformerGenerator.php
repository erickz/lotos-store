<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class TransformerGenerator extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:transformer
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
                '{{classSingular}}',
                '{{classPlural}}',
                '{{classPluralLowerCase}}',
                '{{classSingularLowerCase}}'
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

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->argument('name');

        $template = $this->getVarsToReplace($name, 'Transformer');

        file_put_contents(app_path("/Http/Transformers/" . Str::singular($name) . "Transformer.php"), $template);

        $this->info('Transformer created with success');
    }
}
