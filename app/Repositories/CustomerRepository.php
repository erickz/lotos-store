<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use App\Repositories\Contracts\CustomerRepositoryInterface;
use App\Models\Customer as Model;
use App\Models\CreditRescueHistory;
use Mail;
use App\Mail\CustomerRegisteredMail;

class CustomerRepository implements CustomerRepositoryInterface
{
    private $model;
    private $rowsPerPage = 25;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function get(Array $filters = []): Collection
    {
        return $this->model->get();
    }

    public function paginate(Array $filters = []): LengthAwarePaginator
    {
        return $this->model->orderBy('id', 'DESC')->paginate($this->rowsPerPage);
    }

    public function find($id = 0): Model
    {
        return $this->model->where('id', $id)->first();
    }

    public function store($data = [], $triggerEmail = true): Model
    {
        $data['active'] = 1;
        $user = $this->model->create($data);

        // $user->sendEmailVerificationNotification();

        if ($triggerEmail){
            Mail::to($user->email)->send(new CustomerRegisteredMail($user->getFirstName()));
        }

        return $user;
    }

    public function update($data, $id): Bool
    {
        $user = $this->find($id); 

        if (! $user){
            return false;
        }

        $user->active = isset($data['active']) ? $data['active'] : 1;
        $user->newsletter = isset($data['newsletter']) ? $data['newsletter'] : 0;
        $user->genre = isset($data['genre']) ? $data['genre'] : 0;

        if (isset($data['password']) && $data['password']){
            $user->password = $data['password'];
        }

        $updated = $user->update($data);

        return $updated;
    }

    public function add_rescue($data): CreditRescueHistory
    {
        $rescue = new CreditRescueHistory();
        $rescue->customer_id = $data['customer_id'];
        $rescue->pix_key = $data['pix_key'];
        $rescue->value = $data['value'];
        $rescue->save();

        return $rescue;
    }

    public function delete($ids): Bool
    {
        return $this->model->destroy($ids);
    }
}