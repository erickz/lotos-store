<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

use MundiAPILib\MundiAPIClient;
use App\Repositories\Contracts\PaymentRepositoryInterface;
use App\Models\Payment as Model;

class PaymentRepository implements PaymentRepositoryInterface
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
        return $this->model->paginate($this->rowsPerPage);
    }

    public function find($id = 0): Model
    {
        return $this->model->find($id);
    }

    public function store($data = []): Model
    {
        $user = $this->model->create($data);

        return $user;
    }

    public function update($id, $data): Bool
    {
        $user = $this->find($id);

        if (! $user){
            return false;
        }

        $updated = $user->update($data);

        return $updated;
    }

    public function delete($ids): Bool
    {
        return $this->model->destroy($ids);
    }

    /**
     * Get the payment's informations from the MUNDIPAGG API
     * @param $paymentId
     * @throws \MundiAPILib\APIException
     */
    public function getPayment($paymentId = null)
    {
        $authUserName = env('MUNDIPAGG_USER');
        $authPassword = env('MUNDIPAGG_PASS');

        try {
            $client = new MundiAPIClient($authUserName, $authPassword);

            $order = $client->getOrders()->getOrder($paymentId);
        }
        catch( \Exception $e){
            return false;
        }

        return $order;
    }

    public function chargePayment($paymentData = [])
    {
        $charge = null;



        return $charge;
    }
}