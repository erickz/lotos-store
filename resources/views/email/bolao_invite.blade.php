@extends('layouts.email.email-basic')

@section('titleEmail', 'Você ganhou cotas de presente')

@section('content')
    <tr>
        <td align="center" valign="top">
            <!-- BEGIN BODY // -->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody">
                <tr>
                    <td valign="top" class="bodyContent" mc:edit="body_content">
                        <p>
                            <b>Receba suas cotas e concorra a {{ $concursoPrize }}!</b>
                        </p>
                        <p>
                            Olá, você foi presenteado por {{ $ownerName }} com {{ $invite->cotas }} cota{{ $invite->cotas > 1 ? 's' : '' }}
                            para participar do concurso da {{ $lotery->name }},
                        </p>
                        <p>
                            Aqui estão os detalhes do Bolão: <br />

                            <b>Prêmio estimado: <span style='color: #80CB2E !important;'>{{ $concursoPrize }}</span> </b><br />
                            <b>Loteria:</b> {{ $lotery->name }} <br />
                            <b>Concurso:</b> Nº{{ $concurso->number }} - {{ $concursoDate }} <br />
                            <b>Cotas:</b> {{ $invite->cotas }} cota{{ $invite->cotas > 1 ? 's' : '' }} <br />
                        </p>
                        <p>
                            <a href='{{ route("web.customers.receiveInvite", [$invite->token]) }}'>Clique aqui receber suas cotas!</a>
                        </p>
                        <p>
                            Você será redirecionado para confirmar seus dados e receber as cotas. <br />
                            Fique de olho na data do concurso para lembrar de acessar o site da Lotos Fácil e ver se seu Bolão foi premiado!
                        </p>
                        <p>
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