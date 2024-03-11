<div class="main-box clearfix">
    <div class="table-responsive">
        <table class="table customer-list">
            <thead>
            <tr>
                <th><span>Title</span></th>
                <th><span>Created</span></th>
                <th>&nbsp;</th>
            </tr>
            </thead>

            <tbody>
            @foreach ($blogs as $blog)
            <tr>
                <td>
                    <a href="{{ route('adm.blogs.edit', [ $blog->id ]) }}" class="user-link">
                        {{ $blog->title }}
                    </a>
                </td>
                <td>
                    {{ $blog->getCreatedAtFormatted() }}
                </td>
                <td style="width: 20%;">
                    <a href="{{ route('adm.blogs.edit', [$blog->id]) }}" class="table-link">
                        <span class="fa-stack">
                            <i class="fa fa-square fa-stack-2x"></i>
                            <i class="fas fa-pen fa-stack-1x fa-inverse"></i>
                        </span>
                    </a>
                    <a href="{{ route('adm.blogs.destroy', [$blog->id]) }}" class="table-link danger">
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
    {{ $blogs->links() }}
</div>