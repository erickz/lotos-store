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
                            Os créditos que você comprou foram adicionados com sucesso à sua conta no {{ $siteName }}!
                        </p>
                        <p>
                            Aqui estão os detalhes dos seus créditos: <br />
                            <b>Valor Total:</b> {{ $credits }} <br />
                            <b>Data da Compra:</b> {{ $dataBuy }} <br />
                        </p>
                        <p>
                            <a href='{{ route("web.boloes.listing") }}'>Clique aqui e adquira cotas de Bolões estratégicos</a>!
                        </p>
                        <p>
                            Se tiver alguma dúvida ou precisar de assistência, nossa equipe de suporte está sempre à disposição para ajudar.
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