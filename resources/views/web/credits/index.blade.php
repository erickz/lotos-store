@extends('layouts.web.web')

@section('titlePage', 'Compre créditos e faça jogos nas suas Loterias online favoritas, aqui na ' . env('APP_NAME') . '!')
@section('descriptionPage', 'Adquira créditos e faça já seus bolões na loteria online!')

@section('content')

<!--begin::Entry-->
<div class="d-flex flex-column-fluid mt-5">
    <!--begin::Container-->
    <div class="container">
        <div class="row boloesListing">
            <div class='col-lg-12'>
                <h1 class='ps-0 mb-0 text-secondary'>Comprar créditos</h1>
                
                <form id='formCredits' method='post' action='{{ route("web.credits.index") }}' class='col-lg-12 mt-5 bg-white p-5'>
                    <div class="alert d-none mb-5 ps-2"></div>
                    
                    <div class='d-flex d-flex-responsive'>
                        <div class='col-md-6 ps-0'>
                            <h3 class='ps-0 mb-0'>Digite o valor desejado:</h3>
                            <span class='text-gray d-block mt-3'><strong>Mínimo de: R$50,00</strong></span>

                            <div id='customValueCredits' class='d-flex input-group'>
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1">R$</span>
                                </div>
                                <input type='text' class='form-control maskMoney' />
                                <button type='submit' class='btn btn-primary tgForm' data-value='0'>Comprar</button>
                            </div><!-- / -->
                        </div><!-- /col-md-6 -->
                        <div class='col-md-5 offset-md-1 mt-5'>
                            <h3 class='ps-0'>Ou selecione um valor padrão:</h3>
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
        </div><!-- /boloesListing -->
    </div><!--end::Container-->
</div><!--end::Entry-->

@endsection