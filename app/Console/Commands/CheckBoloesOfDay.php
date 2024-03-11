<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

use App\Repositories\Contracts\ConcursoRepositoryInterface;

use App\Models\Concurso;
use Carbon\Carbon;

class CheckBoloesOfDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:boloes-of-day';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and verify of the boloes according the concursos';

    public $repository = NULL;

    public function __construct(ConcursoRepositoryInterface $repository)
    {
        $this->repository = $repository;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $now = Carbon::now();

            $concursosOfDay = Concurso::where('draw_day', $now->format('Y-m-d'))->get();

            foreach($concursosOfDay as $concurso){
                if ($concurso->checked || $concurso->prized || ! $concurso->draw_numbers ){
                    continue;
                }

                $id = $concurso->id;

                $this->repository->checkGames($id);
                $this->repository->rewardGames($id);      
                $this->repository->rollRevenue($id);
            }
        }
        catch(\Exception $e){
            Log::error('Something went wrong when checking the boloes');
        }

        return Command::SUCCESS;
    }
}
