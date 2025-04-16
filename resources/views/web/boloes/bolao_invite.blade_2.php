<div class="card card-custom pb-8">
    <div class="card-header ps-0 pe-0">
        <div class="card-title d-flex w-100">
            <div class='mt-3 ms-5'>
                <h4 class=''><b><i class='fa fa-envelope-open-text color-default'></i> Enviar cotas</b></h4>
            </div> 
            <button type="button" class="close ms-auto me-2" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>

    <div class='container pe-4 ps-4 mt-4 mb-2' id='inviteCotasCt'>
        <div class='alert alert-secondary d-flex justify-content-center'>
            <div class='text-center me-9'>
                <span>Premiação</span> <br />
                <strong class='font-larger'>{{ $bolao->concurso->getFormattedNextExpectedPrize() }}</strong>
            </div>
            <div class='text-center me-9'>
                <span>Data do concurso</span> <br />
                <strong class='font-larger'>{{ $bolao->concurso->getDrawDay() }}</strong>
            </div>
            <div class='text-center'>
                <span>Quantidade de jogos</span> <br />
                <strong class='font-larger'>{{ $bolao->getQtGames() }}</strong>
            </div>
        </div><!-- /alert -->

        @if($bolao->cotas_available > 0)
            <div class="alert border mb-4 ps-2 pe-3" role="alert">
                <div class="alert-icon d-inline">
                    <i class="fas fa-info-circle fa-fw fa-lg text-primary"></i>
                </div>
                <div class="text-primary d-inline">
                    Presenteie seus amigos com cotas! A pessoa convidada tem 24h para receber a(s) cota(s) no link enviado por email.
                </div>
            </div>
        @endif
            
        <div class='text-center'>
            <button class='btn btn-primary' id="copyPixCode" data-code=""><i class='fas fa-gift'></i><b>Copiar link de convite</b></button>
        </div><!--  -->
    </div>
</div>