<!-- Modal-->
<div class="modal fade" id="bolaoConfirmationModal" data-backdrop="true" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header ps-0 pe-0">
                    <h4 class="card-title ms-5"><img src="{{ asset('img/lotos-online-icon.png') }}" class='me-2' />Resumo do Bolão</h4>
                    <button type="button" class="close ms-auto me-4" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <!--begin::Form-->
                <form method='POST' action='{{ route("web.boloes.store", strtolower($lotery->initials)) }}'>
                    @csrf
                    <div class='container pe-4 ps-4'>
                        <div class='mt-3'>
                            <div class="alert border mb-4 ps-2 pe-3" role="alert">
                                <div class="alert-icon d-inline">
                                    <i class="fas fa-info-circle fa-fw fa-lg text-primary"></i>
                                </div>
                                <div class="text-primary d-inline">Confirme seus jogos e finalize o bolão</div>
                            </div>
                            {{--<div class='d-flex mb-2'>
                                <div class='col-4'>
                                    <strong>Seu pássaro da sorte:</strong> 
                                </div>
                                <div class='col-6'>
                                    <span class='label p-1 bg-success text-white luckyBird'><b>{{ $luckBird }}</b></span>
                                    <input type='hidden' name='luckBird' value='{{ $luckBird }}' />
                                </div>
                            </div>--}}
                            <div class='d-flex mb-2'>
                                <div class='col-4'>
                                    <strong>Número de jogos:</strong>
                                </div>    
                                <div class='col-6'>
                                    <span class='numberBets'>0</span>
                                </div>    
                            </div>
                            <div class='d-flex mb-2'>
                                <div class='col-4'>
                                    <strong>Preço das cotas:</strong> 
                                </div>
                                <div class='col-6'>
                                    <span class='priceCota'>0</span>
                                </div>
                            </div>
                            <div class='d-flex'>
                                <div class='col-4'>
                                    <strong>Quantidade de cotas:</strong> 
                                </div>
                                <div class='col-6'>
                                    <span class='numberCotas'>0</span>
                                </div>
                            </div>
                            ---
                            <div class='d-flex mb-2'>
                                <div class='col-4 mt-3'>
                                    <strong>Minhas cotas:</strong>
                                </div>    
                                <div class='col-7'>
                                    <div class='col-3'>
                                        <select name='keepCotas' class='form-control slKeepCotas'>
                                            <option value='0'>0</option>
                                        </select>
                                    </div>
                                    <small>Selecione a quantidade que deseja manter</small>
                                </div>    
                            </div>
                            <div class='d-flex'>
                                <div class='col-4'>
                                    <strong>Total:</strong>
                                </div>    
                                <div class='col-6'>
                                    <span class='totalBolao'>R$36,00</span>
                                </div>    
                            </div>
                        </div>
                    </div>
                    <div class='col-md-12 p-4 mt-3'>
                        <button type="submit" class="btn-finalize btn btn-success ml-2" >
                            <i class="fas fa-check fa-lg"></i> Finalizar
                        </button>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
</div>
