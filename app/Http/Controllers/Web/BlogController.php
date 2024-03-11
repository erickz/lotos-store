<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\WebBaseController;
use Illuminate\Http\Request;

use App\Repositories\Contracts\BolaoRepositoryInterface;
use App\Models\Blog;

class BlogController extends WebBaseController
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

    public function index()
    {
        $blog = Blog::paginate(5);

        return view('web.blog.index', ['blog' => $blog]);
    }

    public function show(Request $request, $slug)
    {
        if (! $slug){
            return redirect()->route('web.home');
        }

        $boloes = null;
        try {
            $blog = Blog::where('slug', $slug)->first();

            $related = Blog::whereNot('id', $blog->id)->orderBy('created_at', 'DESC')->get();

            if ($blog->concurso_id){
                $boloes = $this->bolaoRepo->getToListing(['concurso_id' => $blog->concurso_id]);
            }
        }   
        catch(\Exception $e){
            return redirect()->route('web.home');
        }

        return view('web.blog.show', ['blog' => $blog, 'related' => $related, 'boloes' => $boloes]);
    }
}
