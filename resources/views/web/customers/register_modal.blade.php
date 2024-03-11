<!-- Modal-->
<div class="modal fade" id="registerModal" data-backdrop="true" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title ps-0"><img src="{{ asset('img/icon-lotos-facil.png') }}" class='me-2 max-h-20px' /> Crie sua conta</h3>
                    <div class="card-toolbar">
                        <button type="button" class="close ms-6 me-2" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>

                @include('web.includes.alert')

                <!--begin::Form-->
                <form id='RegisterForm' data-url="{{ route('web.customers.store') }}" method="POST" class="form form-ajax" redirect='1'>
                    {{ csrf_field() }}

                    <div class="card-body">

                        <div class="alert d-none mb-5"></div>

                        <div class="form-group row p-1">
                            <div class="col-lg-12">
                                <label><strong>Nome Completo*:</strong></label>
                                <input type="text" name="full_name" class="form-control" value="{{ old('full_name') }}" />
                            </div>
                        </div>
                        <div class="form-group row p-1">
                            <div class="col-lg-6">
                                <label><strong>Email*:</strong></label>
                                <input type="email" name="email" class="form-control" value="{{ old('email') }}" />
                            </div>
                            <div class="col-lg-6">
                                <label><strong>Data de nascimento*:</strong></label>
                                <input type="text" name="birthday_date" class="form-control maskBirthday" value="{{ old('birthday_date') }}" />
                            </div>
                        </div>
                        <div class="form-group row p-1">
                            <div class="col-lg-6">
                                <label><strong>Senha*:</strong></label>
                                <input type="password" name="password" class="form-control" />
                            </div>
                            <div class="col-lg-6">
                                <label><strong>Confirmar Senha*:</strong></label>
                                <input type="password" name="password_confirmation" class="form-control" />
                            </div>
                        </div>
                        <div class="form-group row p-1">
                            <div class="col-lg-12">
                                <div class="checkbox-single">
                                    <label class="checkbox">
                                        <input type="checkbox" name="terms" checked="checked" value='1'>Concordo com os <a href='{{ route("web.staticPages.terms") }}' target='_blank'><u><b>termos de uso</b></u></a>
                                        <span></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row p-5">
                            <button class="btn btn-success mr-2 btn-send"><strong>Criar Conta</strong></button>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
</div>
