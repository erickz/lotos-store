<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Web\WebBaseController;
use Illuminate\Http\Request;
use App\Repositories\Contracts\BolaoRepositoryInterface;

use App\Models\BolaoReserve;

class CartController extends WebBaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(BolaoRepositoryInterface $repository)
    {
        $this->repository = $repository;

        parent::__construct();
    }

    public function index()
    {
        $reserves = [];
        session()->put('payment.total', 0);
        if (session()->has('cart.boloes')){
            $reserves = $this->repository->getReservesByIds(session()->get('cart.boloes'));

            $total = 0;
            foreach($reserves as $reserve){
                $total += $reserve->bolao->price * $reserve->cotas;
            }

            session()->put('payment.total', $total);
            session()->put('payment.toPay', $total);
            session()->forget('payment.onlyCredits');

            $this->calculateTheCreditsDiffToPay();
        }

        return view('checkout.cart', ['reserves' => $reserves]);
    }

    public function screening()
    {
        // if (! auth()->guard('web')->check()){
        //     return redirect()->route('web.cart.customer');
        // }
        if (auth()->guard('web')->check() && auth()->guard('web')->user()->credits >= session()->get("payment.total")){
            return redirect()->route('web.payments.pay');
        }
        else {
            return redirect()->route('web.payments.index');
        }
    }

    public function customerManagement()
    {
        $reserves = [];
        if (session()->has('cart.boloes')){
            $reserves = $this->repository->getReservesByIds(session()->get('cart.boloes'));
        }

        return view('checkout.customer', compact('reserves'));
    }

    public function removeItem(Request $request)
    {
        if (! session()->has('cart.boloes')){
            return response()->json(['message' => 'Seu carrinho foi expirado, favor selecionar as cotas desejadas novamente', 'error' => 1]);
        }

        $cartReserves = session()->get('cart.boloes');
        $idToRemove = $request->get('reserveId');

        //Loop and remove the item by id
        foreach($cartReserves as $index => $reserveId){
            if ($reserveId == $idToRemove){
                BolaoReserve::find($idToRemove)->delete();
                session()->forget('cart.boloes.' . $index);
            }
        }

        return response()->json(['message' => 'Item removido com sucesso', 'error' => 0]);
    }

    public function updateItem(Request $request)
    {
        if (! session()->has('cart.boloes')){
            return response()->json(['message' => 'Seu carrinho foi expirado, favor selecionar as cotas desejadas novamente', 'error' => 1]);
        }

        $reserveId = $request->get('reserveId');
        $reserve = BolaoReserve::find($reserveId);

        if (! $reserve){
            return response()->json(['message' => 'Item não encontrado no carrinho', 'error' => 1]);
        }

        if (! $reserve->isReserveActive()){
            return response()->json(['message' => 'Seu item no carrinho foi expirado, favor atualizar a página', 'error' => 1]);
        }

        if ( ! $request->has('selectedVal')){
            return response()->json(['message' => 'Nenhum item selecionado', 'error' => 1]);
        }

        $selectedVal = $request->get('selectedVal');
        
        if ( $selectedVal > $reserve->bolao->getAvailableCotas() ){
            return response()->json(['message' => 'A quantidade selecionada não está disponível, caso o problema persista atualize a página.', 'error' => 1]);
        }
        
        $reserve->cotas = $selectedVal;
        $reserve->save();

        return response()->json(['message' => 'Cotas atualizadas com sucesso', 'error' => 0]);
    }

    public function finishCart()
    {
        $bolao = $this->repository->finishBolaoBuy($bolaoId, $cotasSelected, $customer);

        $buyTotalPrice = $bolao->price * $cotasSelected;

        $customer->remove_credits($buyTotalPrice);
    }
}
