@extends('layouts.web.web')

@section('titlePage', 'Resgate seus créditos na ' . env('APP_NAME') . '!')
@section('descriptionPage', 'Realize a solicitação de resgate de créditos na ' . env('APP_NAME') . '! Tenha seus ganhos diretamente em sua conta.')

@section('content')

@include('web.customers.register_modal')
@include('web.customers.login_modal')

<!--begin::Entry-->
<div class="d-flex flex-column-fluid mt-5" id='user-profile'>
    <!--begin::Container-->
    <div class="container">
        <div class="col-lg-12">
            <div class="main-box clearfix">
                <h1 class='ps-0 mb-8 text-primary'><b>Comprar créditos</b></h1>
                
                <form id='formCredits' method='POST' action='{{ route("web.credits.index") }}' class='col-lg-12 mt-5 bg-white p-0'>
                    @csrf

                    <div class="alert d-none mb-5 ps-2"></div>
                    
                    <div class='d-flex d-flex-responsive'>
                        <div class='col-md-6 ps-0'>
                            <h3 class='ps-0 mb-0 border-0 mb-4'><b>Digite o valor desejado:</b></h3>
                            <span class='text-gray d-block mt-3'><strong>Mínimo de: R$25,00</strong></span>

                            <div id='customValueCredits' class='d-flex input-group'>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">R$</span>
                                </div>
                                <input type='text' class='form-control maskMoney' />
                                <button type='submit' class='btn btn-primary tgForm' data-value='0'>Comprar</button>
                            </div><!-- / -->
                        </div><!-- /col-md-6 -->
                        <div class='col-md-5 offset-md-1'>
                            <h3 class='ps-0 mb-0 border-0 mb-10'><b>Ou selecione um valor padrão:</b></h3>
                            <table id='listDefaultPrices' class='table w-100'>
                                <tbody>
                                    <tr>
                                        <td class='w-75'><b>R$50,00</b></td>
                                        <td class='w-25 text-center'><button type='submit' class='btn btn-primary tgForm' data-value='50,00'>Comprar</button></td>
                                    </tr>  
                                    <tr>
                                        <td class='w-75'><b>R$100,00</b></td>
                                        <td class='w-25 text-center'><button type='submit' class='btn btn-primary tgForm' data-value='100,00'>Comprar</button></td>
                                    </tr>
                                    <tr>
                                        <td class='w-75'><b>R$150,00</b></td>
                                        <td class='w-25 text-center'><button type='submit' class='btn btn-primary tgForm' data-value='150,00'>Comprar</button></td>
                                    </tr>
                                    <tr>
                                        <td class='w-75'><b>R$200,00</b></td>
                                        <td class='w-25 text-center'><button type='submit' class='btn btn-primary tgForm' data-value='200,00'>Comprar</button></td>
                                    </tr>
                                    <tr>
                                        <td class='w-75'><b>R$300,00</b></td>
                                        <td class='w-25 text-center'><button type='submit' class='btn btn-primary tgForm' data-value='300,00'>Comprar</button></td>
                                    </tr>  
                                </tbody>  
                            </table><!-- / -->
                        </div>
                    </div><!-- /d-flex -->
                </form><!-- /col-lg-12 -->
            </div><!-- /col-lg-12 -->
        </div>

        <div class="col-lg-12">
            <div class="main-box clearfix">
                <h2 class='ps-6 mb-8 text-primary border-0'><b>Resgatar créditos</b></h2>

                {{-- @include('web.customers.menu') --}}
                
                <div class="row profile-user-info mt-4">
                    <div class='col-lg-12 mb-5 border-bottom'>
                        <div class='alert alert-light'><i class='fas fa-info-circle me-2 text-primary'></i>Para solicitar o saque dos seus créditos basta enviar a sua chave pix e o valor desejado no formulário e aguardar até a transação ser realizada</div>

                        <form id='EditForm' data-url="{{ route('web.customers.rescueSave') }}" method="POST" class="form form-ajax pt-2 pb-5" redirect='1'>
                            {{ csrf_field() }}

                            <div class="card-body">
                                <div class="alert d-none mb-2"></div>

                                <div class="form-group row p-1 mb-2">
                                    <div class="col-lg-12">
                                        <label><strong>Você possui:</strong></label>
                                        <b class='text-primary'>{{ $customer->getFormattedCredits() }}</b>
                                    </div>
                                    <div class="col-lg-12">
                                        <label><strong>Valor mínimo para saque:</strong></label>
                                        <u class=''>R$20,00</u>
                                    </div>
                                </div>

                                <div class="form-group row p-1">
                                    <div class="col-lg-6">
                                        <label><strong>Chave Pix:</strong></label>
                                        <input type="text" name="pix_key" class="form-control" value="{{ old('pix_key') }}" />
                                    </div>
                                    <div class="col-lg-6">
                                        <label><strong>Valor:</strong></label>
                                        <input type="text" name="value" class="form-control maskMoney" value="{{ old('value') }}" />
                                    </div>
                                </div>
                                <div class="form-group col-md-3 ps-1 mt-3">
                                    <button class="btn btn-primary mr-2 btn-send"><strong>Criar solicitação</strong></button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class='col-lg-12'>
                        <h4 class='mb-4'>Ultimas solicitações</h4>

                        <table class='table table-light table-striped text-center mt-3'>
                            <thead>
                                <tr>
                                    <td>Chave Pix</td>
                                    <td>Valor</td>
                                    <td>Data de solicitação</td>
                                    <td>Status</td>
                                </tr>
                            </thead>
                            <tbody>
                                @if($customer->creditsRescueHistory->count() <= 0)                        
                                    <tr class='text-center'>
                                        <td colspan='9'>Nenhuma solicitação de crédito registrada</td>
                                    </tr>
                                @else
                                    @foreach($customer->creditsRescueHistory()->limit(5)->orderBy('id', 'DESC')->get() as $history)
                                        <tr>
                                            <td>{{ $history->pix_key }}</td>
                                            <td>{{ "R$" . number_format($history->value, 2, ',', '.') }}</td>
                                            <td>{{ $history->getCreatedAtFormatted() }}</td>
                                            <td>{!! $history->finished == 1 ? '<label class="label label-inline label-success"><b>Finalizado</b></label>' : '<label class="label label-inline label-warning"><b>Em processamento</b></label>' !!}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div><!-- /profile-user-info -->    
            </div><!-- /main-box -->
        </div>
    </div>
    <!--end::Container-->
</div>
<!--end::Entry-->

@endsection