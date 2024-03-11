<div class="main-box clearfix">
    <div class="table-responsive">
        <table class="table customer-list">
            <thead>
            <tr>
                <th><span>Bank</span></th>
                <th><span>Bearer</span></th>
                <th><span>Agency</span></th>
                <th><span>Type</span></th>
                <th>&nbsp;</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($customer->bankAccounts as $bank)
                <tr>
                    <td>
                        <a href="{{ route('adm.customers.bank.edit', [ $customer->id, $bank->id ]) }}" class="user-link">
                            {{ $bank->bank }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('adm.customers.bank.edit', [ $customer->id, $bank->id ]) }}" class="user-link">
                            {{ $bank->bearer }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('adm.customers.bank.edit', [ $customer->id, $bank->id ]) }}" class="user-link">
                            {{ $bank->agency }}
                        </a>
                    </td>
                    <td>
                        {{ $bank->getType() }}
                    </td>
                    <td style="width: 20%;">
                        <a href="{{ route('adm.customers.bank.edit', [$customer->id, $bank->id ]) }}" class="table-link">
                            <span class="fa-stack">
                                <i class="fa fa-square fa-stack-2x"></i>
                                <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>

                        <a href="{{ route('adm.customers.bank.destroy', [$customer->id, $bank->id ]) }}" class="table-link danger">
                            <span class="fa-stack">
                                <i class="fa fa-square fa-stack-2x"></i>
                                <i class="fas fa-trash fa-stack-1x fa-inverse"></i>
                            </span>
                        </a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div><!-- /main-box -->