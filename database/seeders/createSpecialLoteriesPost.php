<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Blog;

class createSpecialLoteriesPost extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [[
            'title' => 'Mega da Virada'
            ,'slug' => 'mega-da-virada'
            ,'description' => '<p>A Mega da Virada é o evento que marca o encerramento de um ano e o início de outro, 
            repleto de esperanças e sonhos. Milhões de brasileiros aguardam ansiosamente por essa data, não apenas para
            celebrar, mas também na esperança de ter suas vidas transformadas com prêmios incríveis. Vamos explorar o que 
            torna a Mega da Virada tão especial e por que você não pode perder a chance de participar deste
            sorteio.</p>

            <h2>O Que É a Mega da Virada?</h2>
            <p>A Mega da Virada é uma edição especial da Mega-Sena, uma das loterias mais 
            populares do Brasil. O que a diferencia das edições regulares são os prêmios impressionantes que oferece.
            Os valores da Mega da Virada são estratosféricos, frequentemente ultrapassando a marca de centenas de milhões
            de reais. Imagine a possibilidade de começar o ano com uma bolada que pode mudar sua vida e a de seus entes
            queridos para sempre.</p>
            
            <h2>Como Funciona?</h2>
            <p>Participar da Mega da Virada é tão simples quanto jogar na Mega-Sena. Tudo o que você 
            precisa fazer é adquirir um bilhete e escolher seis números da sorte. O sorteio acontece na véspera do Ano Novo,
            tornando-se uma tradição para muitas famílias brasileiras. A emoção de assistir aos números sorteados e a 
            possibilidade de se tornar um milionário imediatamente tornam essa data ainda mais especial.</p>
            
            <h2>Como aumentar suas chances?</h2>
            <p>Muitos jogadores buscam dicas e estratégias para aumentar suas chances de ganhar na 
            Mega da Virada. Embora seja uma loteria de pura sorte, há maneiras inteligentes de jogar. Por exemplo, formar
            um grupo de apostadores e comprar mais bilhetes pode aumentar suas probabilidades. Além disso, vale a pena 
            conhecer histórias inspiradoras de vencedores anteriores para se motivar.</p>
            
            <h2>Realize Seus Sonhos</h2>
            <p>Participar da Mega da Virada é mais do que apenas uma chance de ganhar dinheiro mas também a 
            oportunidade de realizar sonhos. Pode ser viagens pelo mundo, a casa dos seus sonhos,
            ajudar instituições de caridade ou até mesmo se aposentar confortavelmente. Os prêmios enormes da 
            Mega da Virada podem transformar vidas e criar histórias incríveis.</p>
            
            <p>Portanto, não deixe de realizar uma aposta no ' . env('APP_NAME') . ' para a próxima Mega da Virada! A realização dos seus sonhos 
            pode estar apenas a alguns números de distância. É a maneira perfeita de encerrar o ano com esperança e começar
            o próximo com um sorriso de milhões de reais. A sorte está a seu favor, e o próximo milionário do Brasil pode 
            ser você!</p>'
            ,'meta_title' => 'Mega da virada'
            ,'meta_description' => 'A Mega da Virada é o evento mais esperado do ano no mundo das loterias. 
            Com prêmios que podem chegar a valores estratosféricos, esta loteria especial cria milionários a cada ano. 
            Descubra como participar, conheça as regras e aumente suas chances de começar o novo ano com o pé direito. 
            Não perca a oportunidade de se tornar o próximo ganhador da Mega da Virada e realizar todos os seus sonhos. 
            Saiba mais agora!'
        ]
        ,[
            'title' => 'Quina de São João'
            ,'slug' => 'quina-de-sao-joao'
            ,'description' => '<p>A Quina de São João é uma das celebrações mais aguardadas do ano para os amantes de loterias. Neste guia, vamos explorar todos os detalhes dessa festa, desde o que a torna especial até como participar e aumentar suas chances de ganhar!</p>

            <h2>O que é a Quina de São João?</h2>
            <p>A Quina de São João é uma edição especial da loteria Quina, realizada anualmente em comemoração às festividades de São João. O que a torna única é o fato de que seu prêmio principal não acumula, ou seja, alguém sai vencedor a cada edição. É uma das maiores festas das loterias no Brasil.</p>
            
            <h2>Como Funciona a Quina de São João?</h2>
            <p>O funcionamento da Quina de São João é similar ao da Quina convencional. Você escolhe cinco números de 1 a 80 e aguarda o sorteio, que ocorre em junho. O grande diferencial é que o prêmio principal é garantido, ou seja, se ninguém acertar os cinco números, o prêmio é pago para quem fizer a Quadra (acertar quatro números) e assim por diante. Isso a torna uma das loterias mais emocionantes do país.</p>
            
            <h2>Como Aumentar Suas Chances na Quina de São João?</h2>
            <p>Para aumentar suas chances de ganhar na Quina de São João, considere formar grupos para comprar mais bilhetes, o que amplia a probabilidade de pelo menos um deles ser vencedor. Além disso, estudar as estatísticas de números sorteados nas edições anteriores pode ajudar na escolha dos seus números.</p>
            
            <h2>Realize Seus Sonhos com a Quina de São João</h2>
            <p>A Quina de São João é uma das festas mais emocionantes do mundo das loterias. Não deixe de participar dessa celebração e tenha a chance de realizar seus sonhos. Com um pouco de estratégia e muita empolgação, você pode ser o próximo vencedor da Quina de São João!</p>'
            ,'meta_title' => 'Quina de São João'
            ,'meta_description' => 'A Quina de São João é um dos concursos mais esperados do ano, com prêmios extraordinários. Descubra o que torna essa loteria tão especial, conheça suas regras, e saiba como maximizar suas chances de ganhar. Escolha seus números e participe deste emocionante evento na Lotos Online!'
        ]
        ,[
            'title' => 'Lotofácil de independência'
            ,'slug' => 'lotofacil-de-independencia'
            ,'description' => '<p>A Lotofácil da Independência é uma das loterias mais aguardadas no Brasil, celebrando o Dia da Independência com prêmios incríveis. Neste guia, vamos explorar o que torna essa loteria especial, como ela funciona e como você pode aumentar suas chances de ganhar. No final, você estará pronto para tentar a sorte e quem sabe realizar seus sonhos.</p>

            <h2>O que é a Lotofácil da Independência?</h2>
            <p>A Lotofácil da Independência é um concurso anual da Lotofácil, realizada em setembro próximo ao Dia da Independência do Brasil. Ela se destaca por oferecer prêmios substancialmente maiores do que os sorteios regulares da Lotofácil. O concurso comemora este importante evento histórico com oportunidades emocionantes de ganhar.</p>
            
            <h2>Como Funciona a Lotofácil da Independência?</h2>
            <p>O funcionamento da Lotofácil da Independência é similar ao da Lotofácil convencional. Você escolhe 15 números dentre um conjunto de 25. Durante o sorteio, são escolhidos os números vencedores. Acertar os 15 números sorteados garante o prêmio máximo, mas há também prêmios menores para quem acerta 14, 13, 12 e 11 números.</p>
            
            <h2>Como Aumentar Suas Chances de Ganhar?</h2>
            <p>A sorte desempenha um papel importante em loterias, mas você pode aumentar suas chances de ganhar com algumas estratégias inteligentes. Considere a ideia de formar grupos para comprar mais bilhetes e, assim, aumentar as chances de pelo menos uma aposta ser vencedora. Além disso, escolher números com sabedoria e considerar análises estatísticas pode fazer a diferença.</p>

            <h2>Tente Sua Sorte na Lotofácil da Independência </h2>
            <p>Participar da Lotofácil da Independência é mais do que um jogo; é uma celebração da história do Brasil com a chance de realizar seus sonhos. Os prêmios substanciais oferecidos tornam este concurso uma tradição emocionante para milhares de brasileiros a cada ano. Não deixe de tentar a sorte e, quem sabe, realizar seus sonhos na Lotofácil da Independência!</p>'
            ,'meta_title' => 'Lotofácil da Independência'
            ,'meta_description' => 'A Lotofácil da Independência é um concurso especial da Lotofácil realizado anualmente em comemoração à Independência do Brasil. Descubra como participar dessa emocionante loteria, saiba como funciona e aumente suas chances de ganhar grandes prêmios. Jogue na Lotos Online e concorra agora!'
        ]
        ,[
            'title' => 'Dupla sena de páscoa'
            ,'slug' => 'dupla-sena-de-pascoa'
            ,'description' => '<p>A Dupla Sena de Páscoa é um dos eventos mais aguardados pelos apaixonados por loterias no Brasil. Neste guia, vamos explorar todos os detalhes dessa festa, desde o que a torna especial até como participar e aumentar suas chances de ganhar!</p>

            <h2>O que é a Dupla Sena de Páscoa?</h2>
            <p>A Dupla Sena de Páscoa é uma versão especial da loteria Dupla Sena, realizada anualmente em comemoração à Páscoa. O que a diferencia é a premiação maior, com um percentual significativo da arrecadação direcionado ao prêmio principal. Se ninguém acertar os seis números, o prêmio é somado aos ganhadores da Quina, o que a torna ainda mais emocionante.</p>
            
            <h2>Como Funciona a Dupla Sena de Páscoa?</h2>
            <p>O funcionamento da Dupla Sena de Páscoa é similar ao da Dupla Sena convencional. Você escolhe de seis a quinze números e aguarda o sorteio, que ocorre próximo ao domingo de Páscoa. A grande diferença está no prêmio, que pode ser ainda mais substancial, especialmente se acumular ao longo dos concursos regulares durante o ano.</p>
            
            <h2>Como Aumentar Suas Chances</h2>
            <p>Se você busca aumentar suas chances na Dupla Sena de Páscoa, considere formar grupos para comprar mais bilhetes. Quanto mais bilhetes você adquire, maior a probabilidade de pelo menos um deles ser vencedor. Além disso, analisar as estatísticas de números sorteados nas edições anteriores pode ser útil na escolha dos seus números.</p>
            
            <h2>Realize Seus Sonhos</h2>
            <p>A Dupla Sena de Páscoa é uma das festas mais emocionantes do mundo das loterias. Escolha seus números e participe dessa celebração especial. Com um pouco de estratégia e muita empolgação, você pode ser o próximo vencedor da Dupla Sena de Páscoa e realizar seus sonhos. Aproveite essa oportunidade única e aposte na Dupla Sena de Páscoa hoje mesmo!</p>'
            ,'meta_title' => 'Dupla Sena de Páscoa: Dobre Suas Chances de Ganhar'
            ,'meta_description' => 'A Dupla Sena de Páscoa é um concurso especial que ocorre às vésperas da Páscoa, oferecendo prêmios incríveis. Saiba como funciona essa loteria única, conheça suas regras e descubra estratégias para aumentar suas chances de ganhar. Escolha seus números e aposte na Lotos Online para participar deste emocionante sorteio!'
        ]];

        foreach($data as $row){
            $post = new Blog();
            $post->create($row);
        }
    }
}
