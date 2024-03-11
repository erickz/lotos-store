@extends('layouts.adm.adm')

@section('titlePage', 'Customers - Index')

@section('content')

<div class="col-md-10" id="content-wrapper">
    <div class="row">
        <div class="col-lg-12">

            <div class="clearfix">
                <h1 class="pull-left">Solicitações de resgate de créditos</h1>
            </div>

            @include('adm.elements.alert')

            <div class="row">
                <div class="col-lg-12">
                    @if($rescues->count() <= 0)
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle fa-fw fa-lg"></i> There are no solicitation to display
                        </div>
                    @else
                    <div class="main-box clearfix">
                        <div class="table-responsive">
                            <table class="table customer-list">
                                <thead>
                                    <tr>
                                        <th><span>Customer name</span></th>
                                        <th><span>Pix key</span></th>
                                        <th><span>Value</span></th>
                                        <th><span>Created</span></th>
                                        <th class="text-center"><span>Status</span></th>
                                        <th>&nbsp;</th>
                                    </tr>
                                </thead>

                                <tbody>
                                @foreach ($rescues as $rescue)
                                    <tr>
                                        <td>
                                            {{ $rescue->customer->full_name }}
                                        </td>
                                        <td>
                                            {{ $rescue->pix_key }}
                                        </td>
                                        <td>
                                            {{ $rescue->value }}
                                        </td>
                                        <td>
                                            {{ $rescue->getCreatedAtFormatted() }}
                                        </td>
                                        <td class="text-center">
                                            @if ($rescue->finished)
                                                <i class='fa fa-check text-primary'></i>
                                            @else
                                                <a href='{{ route("adm.customers.markRescued", [$rescue->id]) }}' class='btn btn-primary'>Mark as solved</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        {{ $rescues->links() }}
                    </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>

@endsection