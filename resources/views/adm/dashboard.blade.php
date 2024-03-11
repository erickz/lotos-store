@extends('layouts.adm.adm')

@section('titlePage', 'Dashboard')

@section('content')
    <div class="col-md-10" id="content-wrapper">
        <div class="row">
            <div class="col-lg-12">

                <div class="row">
                    <div class="col-lg-3 col-sm-6 col-xs-12">
                        <div class="main-box infographic-box">
                            <i class="fa fa-user red"></i>
                            <span class="headline">Clientes novos</span>
                            <span class="value">{{ $newCustomers }}</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-xs-12">
                        <div class="main-box infographic-box">
                            <i class="fa fa-shopping-cart emerald"></i>
                            <span class="headline">Bolões criados</span>
                            <span class="value">{{ $newBoloes }}</span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-xs-12">
                        <div class="main-box infographic-box">
                            <i class="fa fa-money-bill-alt green"></i>
                            <span class="headline">Valor gasto na plataforma</span>
                            <span class="value"><small>{{ 'R$' . number_format($profit, 2, ',', '.') }}</small></span>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6 col-xs-12">
                        <div class="main-box infographic-box">
                            <i class="fa fa-eye yellow"></i>
                            <span class="headline">Visualizações totais de bolões</span>
                            <span class="value">{{ $views }}</span>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection