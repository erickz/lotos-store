@extends('layouts.email.email-basic')

@section('titleEmail', 'Todas as cotas foram vendidas')

@section('content')
    <tr>
        <td align="center" valign="top">
            <!-- BEGIN BODY // -->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody">
                <tr>
                    <td valign="top" class="bodyContent" mc:edit="body_content">
                        <p>
                            Olá {{ $customerName }},
                        </p>
                        <p>
                            É com imensa alegria que informamos que o bolão que você participou no {{ $siteName }} foi premiado! 
                        </p>
                        <p>
                            Aqui estão os detalhes do seu bolão premiado: <br />

                            <b>Loteria Escolhida:</b> {{ $loteryName }} <br />
                            <b>Concurso:</b> {{ $concursoLabel }} <br />
                            <b>Nome do Bolão:</b> {{ $bolaoName }} <br />
                            <b>Número de Cotas:</b> {{ $cotasBought }} <br />
                            <span style='color: #80CB2E;'><b>Valor premiado:</b> R${{ number_format($prized, 2, ',', '.') }}</span>
                        </p>
                        <p>
                            <a href='{{ route("web.home") }}'>Clique aqui para ver mais!</a>
                        </p>
                        <p>
                            Agradecemos por escolher o {{ $siteName }} como seu parceiro de loteria. <br />
                            Se tiver alguma dúvida, não hesite em entrar em contato com nossa equipe de suporte. 
                        </p>
                        <p>
                            Atenciosamente, <br />
                            Equipe {{ $siteName }}
                        </p>
                    </td>
                </tr>
                <tr>
                    <td align="center" valign="top" style="padding-top:0;">
                        <table border="0" cellpadding="15" cellspacing="0" class="templateButton">
                            <tbody>
                            <tr>
                                <td valign="middle" class="templateButtonContent">
                                    <div mc:edit="std_content02">
                                        
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                <!-- <tr>
                    <td valign="top" class="bodyContent" mc:edit="body_content">
                        <h4>If you did not create an account, no further action is required.</h4>
                    </td>
                </tr> -->
            </table>
            <!-- // END BODY -->
        </td>
    </tr>
@endsection