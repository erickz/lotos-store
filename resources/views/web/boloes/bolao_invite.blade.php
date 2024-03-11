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
                <span>Nome do Bolão</span> <br />
                <strong class='font-larger'>{{ $bolao->name }}</strong>
            </div>
            <div class='text-center me-9'>
                <span>Data do concurso</span> <br />
                <strong class='font-larger'>{{ $bolao->concurso->getDrawDay() }}</strong>
            </div>
            <div class='text-center'>
                <span>Quantidade de apostas</span> <br />
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
            
        <div class=''>
            @if($bolao->cotas_available > 0)
                <form id='inviteCotasForm' data-url='{{ route("web.boloes.doInvite", [$bolao->id]) }}' method="POST" class="form">
                    {{ csrf_field() }}

                    <div class="alert d-none mb-5"></div>

                    <div class="form-group row p-1">
                        <div class="col-lg-12">
                            <label><strong>Email:</strong></label>
                            <input type="text" name="email" required class="form-control" value="{{ old('email') }}" />
                        </div>
                    </div>
                    <div class="form-group row p-1">
                        <div class="col-lg-6 mt-2">
                            <label><strong>Cotas:</strong></label>
                            <div class='col-12 position-relative'>
                                <select name='cotas' id='slCotas' class='d-inline form-control select'>
                                    @for($i = 1; $i <= $bolao->cotas_available; $i++)
                                        <option value='{{ $i }}'>{{ $i }} cota{{ $i > 1 ? 's' : '' }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <!-- <div class="col-lg-6 mt-2">
                            <label><strong class='position-relative'>
                                Cobrar por cotas:
                            </strong></label>
                            <div class='col-12 d-flex align-items-center'>
                                <div class='switch switch-outline switch-icon switch-warning h-35px me-2'>
                                    <label>
                                        <input type='checkbox' name='toCharge' class='checkboxToPay' />
                                        <span></span>
                                    </label>
                                </div>
                                <label class='label label-inline label-light lblPrice'><b>{{ $bolao->getFormattedPrice() }}</b></label>
                            </div>
                        </div> -->
                    </div>
                    <div class="form-group row p-1">
                        <div class='col-lg-6'>
                            <button class='btSubmit btn btn-lg btn-success btn-send'>Enviar</button>
                        </div>
                    </div>
                </form>
            @else
                <div class="alert border mb-4 ps-2 pe-3" role="alert">
                    <div class="alert-icon d-inline">
                        <i class="fas fa-info-circle fa-fw fa-lg text-warning"></i>
                    </div>
                    <div class="text-warning d-inline">
                        Este bolão não possui cotas para serem doadas
                    </div>
                </div>
            @endif

            <div class='mt-8'>
                <h5 class='ps-0'><b>Cotas enviadas</b></h5>
                <div class='max-h-150px overflow-auto'>
                    <table id='tableInvites' class='mt-2 table table-white table-bordered table-responsive' data-url='{{ route("web.boloes.getInvites", [$bolao->id]) }}'>
                        <thead>
                            <tr>
                                <th>Email</th>
                                <th>Status</th>
                                <th>Cotas</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div><!--  -->
    </div>
</div>