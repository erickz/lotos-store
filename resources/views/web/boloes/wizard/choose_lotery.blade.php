<div class='mt-5'>

    <?php $j = 1; ?>
    @foreach($loteries as $index => $lotery)
        @if ($j % 2 != 0)
            <div class='d-flex align-items-center'>
        @endif

        <a href='{{ route("web.boloes.create", [$lotery->initials]) }}' class='border loteryChoice col bg-{{ strtolower($lotery->initials) }} px-5 py-10 text-white text-center'>
            <b>{{ $lotery->name }}</b>
        </a>

        @if ($j++ % 2 == 0)
            </div>
        @endif
    @endforeach
</div>

