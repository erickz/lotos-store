<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\WebBaseController;
use App\Repositories\Contracts\CustomerRepositoryInterface;

class NewsletterController extends WebBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(CustomerRepositoryInterface $repository)
    {
        $this->repository = $repository;

        parent::__construct();
    }

    public function store()
    {
        try
        {
            $customer = $this->repository->store($request->only(['email']));
        }
        catch (\Exception $e)
        {
            dd($e);

            return back()->withErrors();
        }
    }
}
