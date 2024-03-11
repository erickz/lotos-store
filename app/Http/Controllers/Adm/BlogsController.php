<?php

namespace App\Http\Controllers\Adm;

use App\Http\Controllers\AdmBaseController;
use App\Http\Requests\Adm\StoreBlog;
use App\Http\Requests\Adm\UpdateBlog;
use App\Repositories\Contracts\BlogRepositoryInterface;
use Illuminate\Http\Request;

class BlogsController extends AdmBaseController
{

    /**
     * Where to redirect blogs after login.
     *
     * @var string
     */
    protected $redirectTo = '/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BlogRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $blogs = $this->repository->paginate($request->all());

        return view('adm.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('adm.blogs.create');
    }

    public function store(StoreBlog $request)
    {
        if (! $request->validated()){
            return back()->withErrors();
        }

        $blog = $this->repository->store($request->except('csrf'));

        return $this->redirectWithMessage(
            ['name' => 'adm.blogs.edit', 'params' => [$blog->id]]
            ,['message' => 'Blog created with success', 'type' => 'success']
        );
    }

    public function edit($id = null)
    {
        $blog = $this->repository->find($id);

        return view('adm.blogs.edit')->with(compact('blog'));
    }

    public function update(UpdateBlog $request, $id)
    {
        if (! $request->validated()){
            return back()->withErrors();
        }

        $this->repository->update($id, $request->except(['_token', '_method']));

        return $this->redirectWithMessage(
            ['name' => 'adm.blogs.edit', 'params' => [$id]]
            ,['message' => 'Blog edited with success', 'type' => 'success']
        );
    }

    public function delete($id = null)
    {
        $sessionMessage = [];

        if ($id){
            $deleted = $this->repository->delete([$id]);

            $sessionMessage = [
                'message' => 'Register deleted with success'
                ,'type' => 'success'
            ];

            if (! $deleted){
                $sessionMessage = [
                    'message' => 'It wasn`t possible to delete the register'
                    ,'type' => 'danger'
                ];
            }
        }

        return redirect()->route('adm.blogs.index')->with($sessionMessage);
    }
}
