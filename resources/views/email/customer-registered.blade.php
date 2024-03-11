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
                            Na plataforma do {{ $siteName }},você pode criar bolões personalizados, compartilhá-los com amigos e concorrer a premiações milionárias.
                        </p>
                        <p>
                            No {{ $siteName}} você pode:
                        </p>
                        <p>
                            <b>✳️ Crie Bolões Personalizados:</b> Escolha suas loterias favoritas, monte suas apostas e personalize o valor por cota. <br />
                            <b>✳️ Apostas lucrativas:</b> Ao vender todas as cotas do seu bolão, o seu jogo sai de graça e você ainda lucra com as vendas. <br />
                            <b>✳️ Compartilhe com amigos e entusiastas:</b> Compartilhe seus bolões com entusiastas e concorram a prêmios incríveis. <br />
                            <b>✳️ Experiência Amigável:</b> Nossa plataforma é projetada para ser fácil de usar e intuitiva. Seja você um veterano das loterias ou um iniciante, você encontrará tudo o que precisa para aproveitar ao máximo a sua experiência. <br />
                            <b>✳️ Suporte ao Cliente:</b> Estamos aqui para ajudar. Se tiver alguma dúvida, preocupação ou simplesmente quiser saber mais sobre como otimizar suas chances, nossa equipe de suporte estará pronta para atender a qualquer necessidade. <br />
                        </p>
                        <p>
                            Agora que você faz parte do {{ $siteName }}, a sorte está a um passo de distância. Comece agora mesmo <a href='{{ route("web.boloes.create") }}'>criando seu primeiro bolão</a>.
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