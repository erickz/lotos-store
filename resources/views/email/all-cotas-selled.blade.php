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
                            É com grande satisfação que informamos que todas as cotas do seu bolão no {{ $siteName }} foram vendidas com sucesso! 
                        </p>
                        <p>
                            Aqui estão os detalhes do seu bolão:
                        </p>
                        <p>
                            <b>Valor à receber: {{  }}</b>
                            <b>Loteria Escolhida:</b> {{ $loteryName }} <br />
                            <b>Concurso:</b> {{ $concursoLabel }} <br />
                            <b>Nome do Bolão:</b> {{ $bolaoData['name'] }} <br />
                            <b>Número de Cotas:</b> {{ $bolaoData['cotas'] }} <br />
                            <b>Quantidade de jogos:</b> {{ $bolaoData['cotas'] }} <br />
                            <b>Valor por Cota:</b> R${{ number_format($bolaoData['price'], 2, ',', '.') }}
                        </p>
                        <p>
                            Se tiver alguma dúvida ou precisar de assistência, não hesite em entrar em contato com nossa equipe de suporte. Estamos aqui para ajudar a garantir que sua jornada no mundo das loterias seja emocionante e repleta de vitórias.
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