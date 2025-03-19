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


    /**
     * Process credit card payments
     * @param mixed $paymentData
     * @throws \Exception
     * @return Array
     */
    public function creditCardPayment($paymentData = []){
        $chargeData = [
            'reference_id'  => $paymentData['referenceId'],
            'description'   => $paymentData['descriptionBuy'],
            'amount'        => [ 
                'value'     => $paymentData['amountValue'],
                'currency'  => "BRL"
            ],
            'payment_method' => [
                'type'      => "CREDIT_CARD",
                'installments' => 1,
                'capture'   => true,
                'soft_descriptor' =>  'LotosOnline',
                'card'          => [
                    "encrypted" => $paymentData['cardToken']
                ]
            ],
            "notification_urls" => [
                route('web.payments.notifications')
            ],
            "metadata" => [
                "customerId" => $paymentData['customerId']
            ]
        ];

        //CPF
        $documentData = str_replace(['.', '-', '/'], "", $paymentData['cpf']);

        $response = \Http::withHeaders([
            'accept' => 'application/json',
            'Authorization' => 'Bearer ' . env('PAGSEGURO_TOKEN'),
            'x-api-version' => '4.0',
        ])->post(env("PAGSEGURO_HOST") . 'orders', [
            'reference_id'  => $paymentData['referenceId'],
            'customer'        => [ 
                'name'      => $paymentData['customerFullName'],
                'email'     => $paymentData['customerEmail'],
                'tax_id'     => $documentData
            ],
            "items" => [
                [
                    'reference_id' => $paymentData['referenceId'],
                    'name' => $paymentData['descriptionBuy'],
                    'quantity' => 1,
                    'unit_amount' => $paymentData['amountValue']
                ]
            ],
            "charges" => [
                $chargeData
            ],
            "notification_urls" => [
                route('web.payments.notifications')
            ]
        ]);

        $body = $response->body();
        $jsonDecoded = json_decode($body, TRUE);

        if (! $jsonDecoded || isset($jsonDecoded['error_messages'])){

            $msg = 'Ocorreu um erro durante o pagamento';

            if(isset($jsonDecoded['error_messages'][0]['code'])){
                $msg = ($jsonDecoded['error_messages'][0]['code'] == '40002' ? 'Digite um CPF válido' : $msg);
            }

            throw new \Exception($msg);
        }

        return $jsonDecoded;
    }

    /**
     * Process credit card payments
     * @param mixed $paymentData
     * @throws \Exception
     * @return Array
     */
    public function pixPayment($paymentData = []){
        $chargeData = [
            'amount' => ['value' => $paymentData['amountValue']]
        ];

        //CPF
        $documentData = str_replace(['.', '-', '/'], "", $paymentData['cpf']);

        $response = \Http::withHeaders([
            'accept' => 'application/json',
            'Authorization' => 'Bearer ' . env('PAGSEGURO_TOKEN'),
            'x-api-version' => '4.0',
        ])->post(env("PAGSEGURO_HOST") . 'orders', [
            'reference_id'  => $paymentData['referenceId'],
            'customer'        => [ 
                'name'      => $paymentData['customerFullName'],
                'email'     => $paymentData['customerEmail'],
                'tax_id'     => $documentData
            ],
            "items" => [
                [
                    'reference_id' => $paymentData['referenceId'],
                    'name' => $paymentData['descriptionBuy'],
                    'quantity' => 1,
                    'unit_amount' => $paymentData['amountValue']
                ]
            ],
            "qr_codes" => [
                $chargeData
            ],
            "notification_urls" => [
                route('web.payments.notifications')
            ]
        ]);

        $body = $response->body();
        $jsonDecoded = json_decode($body, TRUE);

        if (! $jsonDecoded || isset($jsonDecoded['error_messages'])){
            dd($jsonDecoded);
            throw new \Exception('Ocorreu um erro durante o pagamento');
        }

        return $jsonDecoded;
    }
}