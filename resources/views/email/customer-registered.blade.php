@extends('layouts.email.email-basic')

@section('titleEmail', 'Cliente cadastrado com sucesso')

@section('content')
    <tr>
        <td align="center" valign="top">
            <!-- BEGIN BODY // -->
            <table border="0" cellpadding="0" cellspacing="0" width="100%" id="templateBody">
                <tr>
                    <td valign="top" class="bodyContent" mc:edit="body_content">
                        <h1>Olá {{ $customerName }}, </h1>
                        <p>
                            Seja bem-vindo ao {{ $siteName }}, estamos empolgados em tê-lo como parte da nossa comunidade de jogadores!
                        </p>
                        <p>
                            Agora que você faz parte do {{ $siteName }}, a sorte está a um passo de distância. Não perca tempo e <a href='{{ route("web.boloes.listing") }}'>adquire cotas de Bolões</a> agora mesmo!
                        </p>
                        <p>
                            Boa sorte!
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