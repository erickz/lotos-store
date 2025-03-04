<div class='bolaoSteps d-flex d-flex-responsive'>
    <a href='{{ route("web.boloes.create") }}' class='bolaoStep rounded p-3 me-2 bg-steps col d-flex align-items-center justify-content-between'>
        <span class='titleStep {{ $currentMenu == 1 ? "text-primary" : "" }}'><b>01. Selecione a Loteria</b></span>

        @if ($currentMenu == 1)
            <!-- <i class="fas fa-chevron-right iconHolder" ></i> -->
        @endif
    </a>
    <a {{ isset($lotery) ? 'href=' . route("web.boloes.create", [$lotery->initials]) : "" }} class='bolaoStep rounded p-3 me-2 bg-steps col d-flex align-items-center justify-content-between'>
        <span class='titleStep {{ $currentMenu == 2 ? "text-primary" : "" }}'><b>02. Monte seus jogos</b></span>

        @if ($currentMenu == 2)
            <!-- <i class="fas fa-chevron-right iconHolder" ></i> -->
        @endif
    </a>
    <a {{ isset($lotery) ? "" : "" }} class='bolaoStep stepFinalize rounded p-3 bg-steps col d-flex align-items-center justify-content-between'>
        <span class='titleStep {{ $currentMenu == 3 ? "text-primary" : "" }}'><b>03. Finalize o bolão</b></span>

        @if ($currentMenu == 3)
            <!-- <i class="fas fa-chevron-right iconHolder" ></i> -->
        @endif
    </a>
</div>