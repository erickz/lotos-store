@extends('layouts.email.email-basic')

@section('titleEmail', 'Bolão criado com sucesso')

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
                            Parabéns! Seu bolão no {{ $siteName }} foi criado com sucesso!! <br />
                            Aqui estão os detalhes do seu bolão:
                        </p>
                        <p>
                            <b>Loteria Escolhida:</b> {{ $loteryName }} <br />
                            <b>Concurso:</b> {{ $concursoLabel }} <br />
                            <b>Nome do Bolão:</b> {{ $bolaoData['name'] }} <br />
                            <b>Número de Cotas:</b> {{ $bolaoData['cotas'] }} <br />
                            <b>Quantidade de jogos:</b> {{ $bolaoData['cotas'] }} <br />
                            <b>Valor por Cota:</b> R${{ number_format($bolaoData['price'], 2, ',', '.') }}
                        </p>
                        <p>
                            <a href='{{ route("web.customers.bets") }}'>Clique aqui para ver suas apostas</a>
                        </p>
                        <p>
                            Se tiver alguma dúvida, não hesite em entrar em contato com nossa equipe de suporte.
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