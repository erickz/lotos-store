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
                            Aqui estão os detalhes da sua participação no bolão:
                        </p>
                        <p>
                            <b>Nome do Bolão:</b> {{ $bolaoName }} <br />
                            <b>Número de Cotas que possue:</b> {{ $cotasBought }} <br />
                        </p>
                        <p>

                        </p>
                        <p>
                            Se tiver alguma dúvida ou precisar de assistência, nossa equipe de suporte está à disposição para ajudar. 
                        </p>
                        <p>
                            Aguarde a conferência do concurso e Boa sorte!
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