@extends('layouts.checkout.checkout')

@section('titlePage', 'Carrinho ' . env('APP_NAME') . ' | Pagamento seguro em poucos passos')
@section('descriptionPage',  'Finalize suas compras com Pix ou Cartão de crédito. Ambiente prático e seguro!')

@section('content')

<!--begin::Entry-->
<div class="d-flex flex-column-fluid mt-5">
    <!--begin::Container-->
    <div class="container">
        <div class="row cartListing">
            <div class='col-lg-12'>
                <h1 class='ps-0 mb-0 text-secondary'>Meu Carrinho</h1>

                <div class="border mt-5 mb-4 ps-0 pe-3" role="alert">
                    <div class="alert-icon d-inline">
                        <i class="fas fa-info-circle fa-fw fa-lg text-primary"></i>
                    </div>
                    <div class="text-secondary2 d-inline">OBS: As cotas selecionadas ficam disponíveis por 15 minutos. Se não completar a compra a tempo elas serão removidas do carrinho.</div>
                </div>

                @include('web.includes.alert')
                
                @if (count($reserves) > 0)
                    <div class='d-flex mt-5 d-flex-responsive'>
                        <div class='col mt-5'>
                            <table class='bolaoCart w-100 text-center' data-token='{{ csrf_token() }}'>
                                <thead class='bolaoHeader p-4 border-bottom border-secondary'>
                                    <tr>
                                        <th class='p-2 rounded-top-left'>
                                            
                                        </th>
                                        <th class='p-2'>
                                            Loteria
                                        </th>
                                        <th class='p-2'>
                                            Concurso
                                        </th>
                                        <th class='p-2'>
                                            Por
                                        </th>
                                        <th class='p-2'>
                                            Cotas
                                        </th>
                                        <th class='p-2 rounded-top-right'>
                                            Preço
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class=''>
                                    @foreach($reserves as $reserve)
                                        <tr>
                                            <td class='p-2 align-middle'>
                                                <i class='fa fa-times cursor-p text-danger removeFromCart' data-url='{{ route("web.cart.removeItem") }}' data-id='{{ $reserve->id }}'></i>
                                            </td>
                                            <td class='p-2 align-middle'>
                                                <b>{{ $reserve->bolao->lotery->name }}</b>
                                            </td>
                                            <td class='p-2 align-middle'>
                                                <b>Nº{{ $reserve->bolao->concurso->number }}</b> <br />
                                                {{ $reserve->bolao->concurso->getDrawDay() }}
                                            </td>
                                            <td class='p-2 align-middle'>
                                                <b>{{ $reserve->bolao->customer->getProfileName() }}</b>
                                            </td>
                                            <td class='p-2 d-flex align-items-center justify-content-center'>
                                                <div class='slHolder min-w-60px'>
                                                    <select name='cotas' class='form-control slChooseCotas updateBolaoQuantity' data-url='{{ route("web.cart.updateItem") }}' data-id='{{ $reserve->id }}'>
                                                        @for($i = 1; $i <= $reserve->bolao->getAvailableCotas(); $i++)
                                                            <option value='{{ $i }}' {{ $reserve->cotas == $i ? 'selected="selected"' : '' }}>{{ $i }}</option>
                                                        @endfor
                                                    </select>
                                                </div>
                                            </td>
                                            <td class='p-2 priceCart' data-price='{{ $reserve->bolao->price }}' data-total='{{ $reserve->bolao->price * $reserve->cotas }}'>
                                                <b>{{ 'R$' . number_format($reserve->bolao->price * $reserve->cotas, 2, ',', '.') }}</b>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table><!-- /bolaoCart -->
                        </div>
                        <div class='bg-white shadow-sm p-4 rounded-bottom mt-5'>
                            <h3 class='ps-0 pt-0'>Resumo do pedido</h3>

                            <div class='d-flex flex-column'>
                                <table class='bolaoResume w-100'>
                                    <tbody>
                                        @if(auth()->guard('web')->check())
                                            <tr class='customerCredit'>
                                                <td class='pe-5'>
                                                    Seu crédito atual
                                                </td>
                                                <th>
                                                    <b>{{ auth()->guard('web')->user()->getFormattedCredits() }}</b>
                                                </th>
                                            </tr>
                                        @endif
                                        {{--<tr class='totalResume border-bottom border-secondary'>
                                            <td class='pb-2'>
                                                Sua compra
                                            </td>
                                            <th class='totalToPay' data-total='{{ session()->get("payment.total") }}'>
                                                <b>{{ 'R$' . number_format(session()->get("payment.total"), 2, ',', '.') }}</b>
                                            </th>
                                        </tr>--}}
                                        <tr class='totalResume'>
                                            <td class='pt-2 pe-1'>
                                                Total a pagar
                                            </td>
                                            <th class='totalToPay' data-total='{{ session()->get("payment.toPay") }}'>
                                                @if(session()->has('payment.isMinimum'))
                                                    <strong class='position-relative'>
                                                        R${{ number_format(session()->get('payment.toPay'), 2, ',', '.') }} 
                                                        <i class='fa fa-question-circle font-smaller position-absolute top-0 start-100 translate-middle tooltips' data-toggle="tooltip" data-placement="top" data-html="true" title="Valor arredondado para o pagamento mínimo aceito"></i>
                                                    </strong>
                                                @else
                                                    <strong>R${{ number_format(session()->get('payment.toPay'), 2, ',', '.') }} </strong> 
                                                @endif
                                            </th>
                                        </tr>
                                        <tr>
                                            <td colspan='2' class='text-center'>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class='text-center'>
                                    <a href='{{ route("web.cart.screening") }}' class='btn btn-success mt-5' >
                                        @if(! auth()->guard('web')->check())
                                            <b>Ir para Pagamento</b>
                                        @elseif( auth()->guard('web')->user()->credits >= session()->get("payment.total") )
                                            <b>Finalizar compra</b>
                                        @else
                                            <b>Ir para Pagamento</b>
                                        @endif
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div><!-- /col-lg-12 -->
                @endif
            </div><!-- /col-lg-12 -->
        </div><!-- /boloesListing -->
    </div><!--end::Container-->
</div><!--end::Entry-->

@endsection