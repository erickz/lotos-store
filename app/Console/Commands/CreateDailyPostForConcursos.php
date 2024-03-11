<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Concurso;
use App\Models\Blog;
use Carbon\Carbon;

class CreateDailyPostForConcursos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create_daily_post_for_concursos';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = Carbon::now()->format('Y-m-d');

        $concursosOfTheDay = Concurso::where('active', 1)->where('checked', 0)->where('draw_day', $now)->get();

        if (! $concursosOfTheDay || $concursosOfTheDay->count() <= 0){
            $this->info("There isn't any concursos to create posts");
        }
        else {
            foreach($concursosOfTheDay as $concurso)
            {
                if (! $concurso){
                    continue;
                }

                //It means the post was already created
                if ($concurso->posts && $concurso->posts->count() >= 1){
                    continue;
                }

                $post = new Blog();
                $post->concurso_id = $concurso->id;
                $post->title = $concurso->lotery->name . ' de Hoje! ' . $concurso->getDrawDay() . ' - Confira os números sorteados aqui na ' . env('APP_NAME');
                $post->description = $this->getPostText($concurso);
                $post->save();
            }

            return $this->info(count($concursosOfTheDay) . ' concurso' . ($concursosOfTheDay->count() > 1 ? 's' : '') .  ' created');;
        }
    }

    public function getPostText($concurso = null)
    {
        return "<p>Fique por dentro do resultado do concurso da " . $concurso->lotery->name .  " " . $concurso->number .  " de hoje! ' . $concurso->getDrawDay() . ' - O sorteio ocorrerá hoje no Espaço da Sorte, na Avenida Paulista, 750, São Paulo, Capital, a partir das 20:00 horas. Os resultados serão preenchidos aqui assim que o sorteio ocorrer, trazendo a você a informação mais atualizada e confiável sobre os números sorteados. Mantenha-se atento e cruze os dedos para se tornar o próximo vencedor!</p>";
    }
}
