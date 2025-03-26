<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\WebBaseController;
use Illuminate\Http\Request;

use App\Repositories\Contracts\BolaoRepositoryInterface;

use Mail;
use App\Mail\ContactMail;
use App\Mail\PlatformRequestMail;
use App\Models\Lotery;
use App\Models\LoteryCosts;
use App\Models\Blog;
use App\Models\BolaoSuggestion;

use Spatie\Sitemap\SitemapGenerator;

class StaticPagesController extends WebBaseController
{
    public $bolaoRepo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BolaoRepositoryInterface $bolaoRepo)
    {
        parent::__construct();

        $this->bolaoRepo = $bolaoRepo;
    }

    public function about()
    {
        return view('web.about');
    }

    public function terms()
    {
        return view('web.terms');
    }

    public function contact(Request $request)
    {
        return view('web.contact');
    }

    public function contactPost(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
        
        if (! $validated){
            return response()->json(['message' => 'Não foi possível enviar o formulário', 'error' => 1]);
        }

        Mail::to('contato@lotosfacil.com.br')->send(new ContactMail(['name' => $request->get('name'), 'email' => $request->get('email'), 'reason' => $request->get('reason'), 'message' => $request->get('message')]));

        return response()->json(['message' => 'Email enviado com sucesso!', 'error' => 0]);
    }

    public function faq()
    {
        return view('web.faq');
    }

    public function howItWorks()
    {
        return view('web.how_it_works');
    }

    public function loteries(Request $request)
    {
        $loteryNameFromUrl = $request->path();
        $lotery = Lotery::getBySlug($loteryNameFromUrl)->first();

        $mostPopulars = $this->bolaoRepo->getMostPopular([], $lotery->id);

        return view('web.loteries.display', ['lotery' => $lotery, 'mostPopulars' => $mostPopulars]);
    }

    public function loteriesSpecial(Request $request)
    {
        $slug = $request->path();
        $post = Blog::where('slug', $slug)->first();

        if (! $post){
            return redirect()->route('web.home');
        }

        $specialBoloes = $this->bolaoRepo->getSpecialBoloes();

        $suggestions = BolaoSuggestion::where('lotery_id', 1)->get();

        return view('web.loteries.display_special', ['post' => $post, 'specialBoloes' => $specialBoloes, 'suggestions' => $suggestions]);
    }

    public function sitemap(Request $request)
    {
        $filePath = resource_path('sitemap.xml');
        SitemapGenerator::create(secure_url('/'))->writeToFile($filePath);

        return response()->download($filePath);
    }

    public function platform()
    {
        return view('web.platform');
    }

    public function partners()
    {
        $loteries = Lotery::where('active', 1)->get();
        $costs = LoteryCosts::select(['lotery_id', 'number_matches', 'cost', 'chances'])->whereIn('lotery_id', [1,2,3,4])->get();
        $arCosts = [];

        foreach($costs as $cost){
            if(! isset($arCosts[$cost->lotery_id])){
                $arCosts[$cost->lotery_id] = [];
            }

            $arCosts[$cost->lotery_id][] = $cost;
        }

        return view('web.partners', ['loteries' => $loteries, 'costs' => $arCosts]);
    }

    public function sendEmailPlatform(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);
        
        if (! $validated){
            return response()->json(['message' => 'Não foi possível enviar o formulário', 'error' => 1]);
        }

        Mail::to('erickcmiguel@gmail.com')->send(new PlatformRequestMail(['name' => $request->get('name'), 'email' => $request->get('email'), 'message' => $request->get('message')]));

        return response()->json(['message' => 'Email enviado com sucesso!', 'error' => 0]);
    }
}
