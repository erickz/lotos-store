<div class="main-box clearfix">
    <div class="table-responsive">
        <table class="table user-list">
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
            @foreach ($users as $user)
                <tr>
                    <td>
                        @if (auth()->user()->can('update-users'))
                            <a href="{{ route('adm.users.edit', [ $user->id ]) }}" class="user-link">
                                {{ $user->getNameWithUppercase() }}
                            </a>
                        @else
                            {{ $user->getNameWithUppercase() }}
                        @endif
                    </td>
                    <td>
                        @if (auth()->user()->can('update-users'))
                            <a href="{{ route('adm.users.edit', [ $user->id ]) }}" class="user-link">
                                {{ $user->email }}
                            </a>
                        @else
                            {{ $user->email }}
                        @endif
                    </td>
                    <td>
                        {{ $user->getCreatedAtFormatted() }}
                    </td>
                    <td class="text-center">
                        <span class="label {{ $user->getLabelStatus() }}">{{ $user->getActive() }}</span>
                    </td>
                    <td style="width: 20%;">
                        @if (auth()->user()->can('update-users'))
                            <a href="{{ route('adm.users.edit', [$user->id]) }}" class="table-link">
                                <span class="fa-stack">
                                    <i class="fa fa-square fa-stack-2x"></i>
                                    <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        @endif

                        @if (auth()->user()->can('update-users'))
                            <a href="{{ route('adm.users.password', [$user->id]) }}" class="table-link">
                                <span class="fa-stack">
                                    <i class="fa fa-square fa-stack-2x"></i>
                                    <i class="fas fa-key fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        @endif

                        @if (auth()->user()->can('delete-users'))
                            <a href="{{ route('adm.users.destroy', [$user->id]) }}" class="table-link danger">
                                <span class="fa-stack">
                                    <i class="fa fa-square fa-stack-2x"></i>
                                    <i class="fas fa-trash fa-stack-1x fa-inverse"></i>
                                </span>
                            </a>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    {{ $users->links() }}
</div>