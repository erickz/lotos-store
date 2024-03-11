<div class="main-box clearfix">
    <div class="table-responsive">
        <table class="table customer-list">
            <thead>
                <tr>
                    <th><span>Name</span></th>
                    <th><span>Email</span></th>
                    <th><span>Created</span></th>
                    <th class="text-center"><span>Status</span></th>
                    <th>&nbsp;</th>
                </tr>
            </thead>

            <tbody>
            @foreach ($customers as $customer)
                <tr>
                    <td>
                        <a href="{{ route('adm.customers.edit', [ $customer->id ]) }}" class="user-link">
                            {{ $customer->getFullName() }}
                        </a>
                    </td>
                    <td>
                        <a href="{{ route('adm.customers.edit', [ $customer->id ]) }}" class="user-link">
                            {{ $customer->email }}
                        </a>
                    </td>
                    <td>
                        {{ $customer->getCreatedAtFormatted() }}
                    </td>
                    <td class="text-center">
                        <span class="label {{ $customer->getLabelStatus() }}">{{ $customer->getActive() }}</span>
                    </td>
                    <td style="width: 20%;">
                        <a href="{{ route('adm.customers.edit', [$customer->id]) }}" class="table-link">
                                                    <span class="fa-stack">
                                                        <i class="fa fa-square fa-stack-2x"></i>
                                                        <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
                                                    </span>
                        </a>

                        <a href="{{ route('adm.customers.destroy', [$customer->id]) }}" class="table-link danger">
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
    {{ $customers->links() }}
</div>