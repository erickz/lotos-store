<!-- Modal-->
<div class="modal fade" id="loginModal" data-backdrop="true" tabindex="-1" role="dialog" aria-labelledby="staticBackdrop" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title ps-0"><img src="{{ asset('img/icon-lotos-facil.png') }}" class='me-2 max-h-20px' /><b>Login</b></h3>
                    <button type="button" class="close ms-6 me-2" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                @include('web.includes.alert')

                <!--begin::Form-->
                <form id='loginForm' data-url="{{ route('web.customers.login') }}" method="POST" class="form form-ajax" redirect='1'>
                    {{ csrf_field() }}

                    <div class="card-body">
                    
                        <div class="alert d-none mb-5"></div>

                        <div class="form-group row">
                            <div class="col-lg-12">
                                <label><strong>Email:</strong></label>
                                <input type="email" name="email" required class="form-control" value="{{ old('email') }}" />
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <div class="col-lg-12">
                                <label><strong>Senha:</strong></label>
                                <input type="password" name="password" required class="form-control" />
                                <!-- <a href=''><strong><u>Esqueci a senha:</u></strong></a> -->
                            </div>
                        </div>
                        <div class="form-group row mt-5">
                            <div class="col-lg-12">
                                <button class="btn btn-success mr-2 btn-send"><strong>Entrar</strong></button>
                            </div>
                        </div>
                    </div>
                </form>
                <!--end::Form-->
            </div>
        </div>
    </div>
</div>
