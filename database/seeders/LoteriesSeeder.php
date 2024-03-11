<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Lotery;

class LoteriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $loteriesToCreate = $this->getLoteriesToCreate();

        foreach ($loteriesToCreate as $lotery)
        {
            $this->command->info('Creating lotery: ' .  $lotery['name']);

            $this->create_lotery($lotery);

            $this->command->info('Success!');
        }
    }

    public function getLoteriesToCreate()
    {
        $loteriesToCreate = [
            [
                'initials' => 'MG'
                ,'active' => 1
                ,'name' => 'Mega Sena'
                ,'biggest_number' => 60
                ,'description' => '<p>
                    A Mega Sena, uma das loterias mais populares do Brasil, foi lançada pela Caixa Econômica Federal em 11 de março de 1996. Seus sorteios acontecem sempre às quartas-feiras e sábados, a partir das 20:00 horas.
                    </p>
                    
                    <p>
                    Com um volante de apostas contendo 60 números, de 01 a 60, os jogadores podem marcar de 6 a 20 números para concorrer aos prêmios. Acertar 4, 5 ou 6 números rende prêmios nas categorias Quadra, Quina e Sena, respectivamente. A probabilidade de acertar a Sena, ou seja, todos os 6 números, é de 1 em 50.063.860.
                    </p>
                    
                    <h2 class="p-0 mt-4">Mega da virada</h2>
                    <p>
                    Um dos momentos mais aguardados é a Mega Sena da Virada, um concurso especial realizado todo dia 31 de dezembro. O nome se deve ao fato de ocorrer na virada do ano. As regras para jogar são as mesmas dos outros concursos, porém, a porcentagem destinada ao prêmio principal é maior, e caso não haja ganhadores com 6 acertos, o prêmio é somado aos ganhadores com 5 acertos (Quina), ou seja, o prêmio não acumula.
                    </p>
                    <p>
                    O prêmio da Mega Sena da Virada é formado pelo acúmulo de parte do valor arrecadado nos concursos realizados durante o ano e somado ao valor arrecadado para o concurso especial. Na semana anterior ao sorteio da Mega Sena da Virada, com o número de concurso terminando em 0 ou 5, não são realizados os sorteios normais da Mega Sena.
                    </p>'
                ,'description2' => "<p>A Mega-Sena, sem dúvida, é um dos jogos mais icônicos e populares do Brasil. Com sorteios regulares e prêmios milionários, essa loteria atrai milhões de pessoas que sonham em mudar de vida da noite para o dia. Neste artigo, mergulharemos nas origens da Mega-Sena, exploraremos suas regras de apostas e faixas de premiação, e descobriremos como essa loteria cria uma mistura emocionante de expectativas e oportunidades.</p>

                <h2 class='ps-0'><b>Regras e Funcionamento:</b></h2>
                
                <p>A dinâmica da Mega-Sena é relativamente simples. Os participantes devem escolher seis números de um conjunto de 60, com a possibilidade de ganhar prêmios em diferentes categorias, dependendo do número de acertos. Se os seis números escolhidos corresponderem aos números sorteados, o jogador ganha o prêmio principal, conhecido como 'Sena'.</p>
                
                <h2 class='ps-0'><b>Faixas de Premiação:</b></h2>
                
                <p>Além da premiação principal, a Mega-Sena oferece outras faixas de premiação, o que aumenta as chances de ganhar para os jogadores. Acertar cinco números corresponde à categoria 'Quina', enquanto acertar quatro números resulta na categoria 'Quadra'. Mesmo acertando menos números, ainda é possível ganhar prêmios substanciais.</p>
                
                <h2 class='ps-0'><b>Estratégias de Apostas:</b></h2>
                
                <p>Embora a Mega-Sena seja, em última instância, um jogo de pura sorte, muitos jogadores gostam de adotar diferentes estratégias na escolha de seus números. Alguns preferem datas de aniversário, números que consideram 'da sorte' ou até mesmo combinações aleatórias. Independentemente da abordagem, a emoção de aguardar os resultados permanece constante.</p>"
                ,'description_stats' => '<p>
                As probabilidades de ganhar na Mega Sena podem parecer desafiadoras, mas entender esses números pode ajudar a tomar decisões informadas ao jogar. Com uma aposta simples de 6 números, suas chances de acertar os 6 números sorteados são de aproximadamente 1 em 50.063.860, o que corresponde a cerca de 0,000002% de probabilidade.
                </p>
                <p>
                Isso acontece porque, dentre os 60 números disponíveis na Mega Sena, há um total de 50.063.860 combinações possíveis de 6 números sem repetir. Se você optar por fazer uma aposta com 2 jogos diferentes, suas chances dobram para cerca de 0,000004%, e com 3 jogos, triplicam para cerca de 0,000006%, e assim por diante. Basta multiplicar 0,000002% pelo número de apostas para estimar suas chances de acertar os 6 números no concurso.
                </p>
                <p>
                Vale ressaltar que, nas faixas de premiação com 5 acertos (Quina) e 4 acertos (Quadra), as probabilidades são maiores. Para 5 acertos, a probabilidade de ganhar com uma aposta de 6 números é de 1 em 154.518, o que equivale a cerca de 0,0006%. Para 4 acertos, a probabilidade é de 1 em 2.332, equivalente a cerca de 0,04%.
                </p>
                <p>
                No entanto, é importante lembrar que a probabilidade matemática não é uma garantia de vitória, mas uma estimativa de chance. Além disso, existem outras variáveis que não são consideradas nos cálculos matemáticos, tornando o resultado dos sorteios imprevisível.
                </p>
                <p>A tabela abaixo apresenta as probabilidades para diferentes quantidades de números jogados e suas respectivas faixas de premiação na Mega Sena:
                </p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Quantidade de nº jogados</th>
                            <th>Sena</th>
                            <th>Quina</th>
                            <th>Quadra</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <tr>
                            <td class="b">6</td>
                            <td>50.063.860</td>
                            <td>154.518</td>
                            <td>2.332</td>
                        </tr>
                        <tr>
                            <td class="b">7</td>
                            <td>7.151.980<br></td>
                            <td>44.981</td>
                            <td>1.038</td>
                        </tr>
                        <tr>
                            <td class="b">8</td>
                            <td>1.787.995</td>
                            <td>17.192</td>
                            <td>539</td>
                        </tr>
                        <tr>
                            <td class="b">9</td>
                            <td>595.998</td>
                            <td>7.791</td>
                            <td>312</td>
                        </tr>
                        <tr>
                            <td class="b">10</td>
                            <td>238.399</td>
                            <td>3.973</td>
                            <td>195</td>
                        </tr>
                        <tr>
                            <td class="b">11</td>
                            <td>108.363</td>
                            <td>2.211</td>
                            <td>129</td>
                        </tr>
                        <tr>
                            <td class="b">12</td>
                            <td>54.182</td>
                            <td>1.317</td>
                            <td>90</td>
                        </tr>
                        <tr>
                            <td class="b">13</td>
                            <td>29.175</td>
                            <td>828</td>
                            <td>65</td>
                        </tr>
                        <tr>
                            <td class="b">14</td>
                            <td>16.671</td>
                            <td>544</td>
                            <td>48</td>
                        </tr>
                        <tr>
                            <td class="b">15</td>
                            <td>10.003</td>
                            <td>370</td>
                            <td>37</td>
                        </tr>
                        <tr>
                            <td class="b">16</td>
                            <td>6.252</td>
                            <td>260</td>
                            <td>29</td>
                        </tr>
                        <tr>
                            <td class="b">17</td>
                            <td>4.045</td>
                            <td>188</td>
                            <td>23</td>
                        </tr>
                        <tr>
                            <td class="b">18</td>
                            <td>2.697</td>
                            <td>139</td>
                            <td>19</td>
                        </tr>
                        <tr>
                            <td class="b">19</td>
                            <td>1.845</td>
                            <td>105</td>
                            <td>16</td>
                        </tr>
                        <tr>
                            <td class="b">20</td>
                            <td>1.292</td>
                            <td>81</td>
                            <td>13</td>
                        </tr>
                    </tbody>
                </table>'
                ,'draw_days' => '2,4,6'
                ,'number_games_payslip' => 3
                ,'min_numbers' => 6
                ,'max_numbers' => 20
                ,'min_match' => 4
                ,'max_match' => 6
            ]
            ,[
                'initials' => 'QN'
                ,'active' => 1
                ,'name' => 'Quina'
                ,'biggest_number' => 80
                ,'description' => "<p>A Quina é uma das loterias mais antigas e populares do Brasil, lançada em 13 de março de 1994 pela Caixa Econômica Federal. Com um volante de apostas que disponibiliza 80 números, do 01 ao 80, você pode selecionar de 5 a 15 números e ganha acertando de 2 (Duque) a 5 (Quina) números. A probabilidade de acertar os 5 números e levar o prêmio máximo é de 1 em 24.040.016, aproximadamente.
                </p>
                
                <h2 class='mt-2 p-0'>QUINA DE SÃO JOÃO</h2>
                <p>
                A Quina de São João é um concurso especial realizado anualmente em junho, em celebração à Festa de São João. O primeiro sorteio da Quina de São João aconteceu em 24 de junho de 2011, no concurso de número 2627. As regras para jogar nesse concurso especial são as mesmas da Quina regular. O valor destinado ao prêmio principal é maior, e se não houver ganhador com 5 acertos, o prêmio é somado e pago aos ganhadores com 4 acertos. Isso significa que o prêmio da Quina de São João não acumula. A premiação é formada pela acumulação de parte do valor arrecadado em concursos regulares da Quina ao longo do ano, somado ao valor arrecadado para esse concurso especial. Na semana anterior ao sorteio da Quina de São João, não são realizados os sorteios normais da Quina.
                </p>"
                ,'description2' => "<p>A Quina é uma das loterias mais tradicionais e emocionantes do Brasil. Com sua combinação única de regras simples e prêmios atrativos, esta loteria tem conquistado o coração de jogadores experientes e novatos. Neste artigo, exploraremos detalhadamente as regras e o funcionamento da Quina, as diferentes faixas de premiação e algumas estratégias inteligentes para aumentar suas chances de levar para casa um prêmio.</p>

                <h2 class='ps-0'><b>Regras e Funcionamento:</b></h2>
                
                <p>A Quina é conhecida por sua simplicidade e facilidade de participação. Os jogadores escolhem cinco números de um conjunto de 80 disponíveis no volante de apostas. O grande diferencial da Quina é que os sorteios acontecem todos os dias da semana, o que significa que há muitas oportunidades de ganhar prêmios em diferentes faixas de premiação.</p>
                
                <h2 class='ps-0'><b>Faixas de Premiação:</b></h2>
                
                <p>A Quina oferece diversas faixas de premiação, o que torna as chances de ganhar ainda mais emocionantes. A maior premiação, é claro, vai para quem acerta os cinco números sorteados. No entanto, mesmo se você não acertar todos os números, ainda tem chances de ganhar prêmios ao acertar quatro, três ou até mesmo dois números. Essa variedade de premiações torna a Quina uma opção interessante para jogadores que buscam diferentes níveis de recompensa.</p>
                
                <h2 class='ps-0'><b>Estratégias e Apostas:</b></h2>
                
                <p>A estratégia na Quina muitas vezes gira em torno da escolha dos números. Enquanto alguns jogadores optam por datas de aniversário ou números significativos, outros preferem uma abordagem mais aleatória. A diversificação de números é uma maneira de evitar padrões previsíveis e aumentar as chances de vitória. Ainda assim, é importante lembrar que a sorte desempenha um papel crucial na determinação dos resultados.</p>"
                ,'description_stats' => '<p>
                A Quina oferece diferentes probabilidades de ganhar, dependendo do número de acertos em sua aposta. Se você optar por uma aposta simples com 5 números, suas chances de ganhar são de 1 em 24.040.016, o que equivale a aproximadamente 0,000004%. Isso ocorre porque há um total de 80 números disponíveis na Quina, e ao escolher apenas 5 deles, você tem um total de 24.040.016 combinações possíveis.
                </p>
                <p>
                Ao aumentar o número de apostas, suas chances também aumentam proporcionalmente. Com duas apostas distintas, suas chances dobram para 0,000008%, e com três apostas, triplicam para 0,000012%. Esse padrão continua, bastando multiplicar 0,000004% pelo número de apostas de 5 números para calcular o percentual de probabilidade.
                </p>
                <p>
                Em outras faixas de premiação, as probabilidades variam. Na Quadra, que requer 4 acertos, a probabilidade de ganhar com uma aposta simples de 5 números é de 1 em 64.106, ou cerca de 0,0016%. Para o Terno, que exige 3 acertos, a probabilidade é de 1 em 866, aproximadamente 0,11%. Já no Duque, que pede 2 acertos, a probabilidade é de 1 em 36, ou cerca de 2,78%. Vale lembrar que a probabilidade é uma ferramenta matemática que oferece possibilidades, não garantias, uma vez que existem outras variáveis que o cálculo não consegue abranger.
                </p>
                <p>
                Confira na tabela abaixo as probabilidades para diferentes modalidades de apostas e faixas de premiação:
                </p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Quantidade de nº jogados</th>
                            <th>Quina</th>
                            <th>Quadra</th>
                            <th>Terno</th>
                            <th>Duque</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="b">5</td>
                            <td>24.040.016</td>
                            <td>64.106</td>
                            <td>866</td>
                            <td>36</td>
                        </tr>
                        <tr>
                            <td class="b">6</td>
                            <td>4.006.669</td>
                            <td>21.658</td>
                            <td>445</td>
                            <td>25</td>
                        </tr>
                        <tr>
                            <td class="b">7</td>
                            <td>1.144.763</td>
                            <td>9.409</td>
                            <td>261</td>
                            <td>18</td>
                        </tr>
                        <tr>
                            <td class="b">8</td>
                            <td>429.286</td>
                            <td>4.770</td>
                            <td>168</td>
                            <td>14</td>
                        </tr>
                        <tr>
                            <td class="b">9</td>
                            <td>190.794</td>
                            <td>2.687</td>
                            <td>115</td>
                            <td>12</td>
                        </tr>
                        <tr>
                            <td class="b">10</td>
                            <td>95.396</td>
                            <td>1.635</td>
                            <td>82</td>
                            <td>9</td>
                        </tr>
                        <tr>
                            <td class="b">11</td>
                            <td>52.035</td>
                            <td>1.056</td>
                            <td>62</td>
                            <td>8</td>
                        </tr>
                        <tr>
                            <td class="b">12</td>
                            <td>30.354</td>
                            <td>714</td>
                            <td>48</td>
                            <td>7</td>
                        </tr>
                        <tr>
                            <td class="b">13</td>
                            <td>18.679</td>
                            <td>502</td>
                            <td>38</td>
                            <td>6</td>
                        </tr>
                        <tr>
                            <td class="b">14</td>
                            <td>12.008</td>
                            <td>364</td>
                            <td>31</td>
                            <td>5,8</td>
                        </tr>
                        <tr>
                            <td class="b">15</td>
                            <td>8.005</td>
                            <td>271</td>
                            <td>25</td>
                            <td>5,2</td>
                        </tr>
                    </tbody>
                </table>'
                ,'draw_days' => '1,2,3,4,5,6'
                ,'number_games_payslip' => 2
                ,'min_numbers' => 5
                ,'max_numbers' => 15
                ,'min_match' => 2
                ,'max_match' => 5
            ]
            ,[
                'initials' => 'LF'
                ,'active' => 1
                ,'name' => 'Lotofácil'
                ,'biggest_number' => 25
                ,'description' => "<p>A Lotofácil foi lançada em 29 de setembro de 2003 pela Caixa Econômica Federal. Os sorteios acontecem de segunda-feira a sábado, a partir das 20:00 horas. Com um volante de apostas contendo 25 números, de 01 a 25, você pode escolher de 15 a 20 números e ganhar acertando 11, 12, 13, 14 ou 15 números. Uma aposta simples, marcando 15 números. Suas chances de acertar os 15 números sorteados na Lotofácil são de 1 em 3.268.760, ou seja, uma probabilidade de aproximadamente 0,00003%.</p>

                <h2 class='ps-0 mt-2'>Lotofácil da Independência:</h2>
                <p>
                Um concurso especial muito aguardado é a Lotofácil da Independência, realizado em setembro de cada ano para celebrar a Independência do Brasil em 7 de setembro. O primeiro sorteio dessa categoria ocorreu em 6 de setembro de 2012, com o concurso número 800.
                </p>
                <p>
                As regras para jogar na Lotofácil da Independência são as mesmas dos outros concursos. No entanto, o prêmio principal recebe uma parcela maior da arrecadação e, caso não haja ganhadores com 15 acertos, ele é dividido entre os ganhadores com 14 acertos. Isso significa que o prêmio do concurso da Lotofácil da Independência não acumula.
                </p>
                <p>
                O prêmio é composto pelo acúmulo de parte do valor arrecadado nos concursos da Lotofácil realizados durante o ano e somado ao valor arrecadado especificamente para o concurso especial. Na semana que antecede o sorteio da Lotofácil da Independência, não são realizados os sorteios normais da Lotofácil, tornando esse concurso ainda mais especial e esperado.
                </p>"
                ,'description2' => "<p>A Lotofácil é uma das loterias mais populares no Brasil, conhecida por suas regras simples e boas chances de premiação. Se você é um entusiasta de jogos de sorte ou está apenas começando a explorar o mundo das loterias, este artigo é o guia perfeito para entender as regras, as faixas de premiação e algumas estratégias inteligentes para aumentar suas chances de ganhar na Lotofácil.</p>

                <h2 class='ps-0'><b>Regras e Funcionamento:</b></h2>
                
                <p>A Lotofácil se destaca por sua abordagem amigável e acessível às regras. Os participantes selecionam um conjunto de números dentre os disponíveis no volante de apostas. Aqui está o diferencial: os jogadores escolhem 15 números de um total de 25. Isso torna a seleção mais simplificada em comparação com outras loterias, enquanto a emoção do sorteio permanece tão intensa quanto sempre. O resultado é uma combinação de números sorteados que determina se você é o sortudo ganhador de prêmios impressionantes.</p>
                
                <h2 class='ps-0'><b>Faixas de Premiação:</b></h2>
                
                <p>Uma das razões pelas quais a Lotofácil é tão adorada é a variedade de faixas de premiação disponíveis. O prêmio principal é concedido àqueles que acertam os 15 números sorteados, mas não para por aí. Você ainda pode ganhar prêmios ao acertar 14, 13, 12 ou 11 números. Essas diferentes categorias de premiação aumentam suas chances de sair vitorioso e dão um toque extra de empolgação ao jogo.</p>
                
                <h2 class='ps-0'><b>Estratégias e Apostas:</b></h2>
                
                <p>Embora a Lotofácil seja, em sua essência, um jogo de sorte, muitos jogadores gostam de explorar estratégias para aumentar suas chances. Alguns preferem escolher números com base em datas significativas, enquanto outros adotam abordagens mais aleatórias. A lógica é simples: diversificar suas escolhas pode evitar padrões previsíveis. É importante lembrar, entretanto, que a sorte ainda desempenha um papel fundamental no resultado final.</p>"
                ,'description_stats' => '<p>A Lotofácil oferece diversas chances de ganhar, e entender as probabilidades por trás dessas oportunidades é essencial para quem gosta de apostar. Com um jogo de 15 números, sua probabilidade de acertar os números sorteados é de 1 em 3.268.760, o que corresponde a cerca de 0,00003%. Essa probabilidade é resultado do universo de 25 números disponíveis para escolha. Ao fazer uma aposta com dois jogos diferentes, suas chances dobram para 0,00006%, e com três jogos diferentes, elas triplicam para 0,00009%. Essa lógica se aplica para qualquer quantidade de jogos que você faça: basta dividir 3.268.760 pelo número de jogos para calcular a probabilidade de acerto.
                </p>
                <p>
                Vale ressaltar que, à medida que você diminui o número de acertos necessários para ganhar em diferentes faixas de premiação, as chances de sucesso aumentam consideravelmente. Por exemplo, na categoria de 11 acertos, que rende um prêmio de R$ 5,00, a probabilidade de ganhar com um único jogo é de 1 em 11, equivalente a 9,09%. No entanto, é importante lembrar que a probabilidade matemática não garante vitórias, mas indica possibilidades, uma vez que há outros fatores que não estão sendo considerados nos cálculos.
                </p>
                <p>
                Para um panorama completo das probabilidades em todas as modalidades de apostas e faixas de premiação da Lotofácil, consulte a tabela abaixo:
                </p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Faixas de Premiação</th>
                            <th>15 números</th>
                            <th>16 números</th>
                            <th>17 números</th>
                            <th>18 números</th>
                            <th>19 números</th>
                            <th>20 números</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="b">15</td>
                            <td>3.268.760</td>
                            <td>204.298</td>
                            <td>24.035</td>
                            <td>4.006</td>
                            <td>843</td>
                            <td>211</td>
                        </tr>
                        <tr>
                            <td class="b">14</td>
                            <td>21.792</td>
                            <td>3.027</td>
                            <td>601</td>
                            <td>153</td>
                            <td>47</td>
                            <td>17</td>
                        </tr>
                        <tr>
                            <td class="b">13</td>
                            <td>692</td>
                            <td>162</td>
                            <td>49</td>
                            <td>18</td>
                            <td>8</td>
                            <td>4,2</td>
                        </tr>
                        <tr>
                            <td class="b">12</td>
                            <td>60</td>
                            <td>21</td>
                            <td>9</td>
                            <td>5</td>
                            <td>3,2</td>
                            <td>2,6</td>
                        </tr>
                        <tr>
                            <td class="b">11</td>
                            <td>11</td>
                            <td>6</td>
                            <td>4</td>
                            <td>3</td>
                            <td>2,9</td>
                            <td>3,9</td>
                        </tr>
                    </tbody>
                </table>'
                ,'draw_days' => '1,2,3,4,5,6'
                ,'number_games_payslip' => 2
                ,'min_numbers' => 15
                ,'max_numbers' => 20
                ,'min_match' => 11
                ,'max_match' => 15
            ]
            ,[
                'initials' => 'DS'
                ,'active' => 1
                ,'name' => 'Dupla Sena'
                ,'biggest_number' => 50
                ,'description' => "<p>Em 06 de novembro de 2001, a Caixa Econômica Federal apresentou ao público a empolgante loteria Dupla Sena. Os sorteios acontecem nos dias de terça, quinta e sábado, se iniciam pontualmente às 20:00 horas.
                </p>
                
                <p>
                Com um volante contendo 50 números, numerados do 01 ao 50, os apostadores têm a liberdade de selecionar de 6 a 15 números em suas apostas. As premiações abrangem acertos de 3 (Terno), 4 (Quadra), 5 (Quina) e 6 (Sena) números. Com a peculiaridade de cada aposta concorrer a dois sorteios no mesmo concurso.A probabilidade de acertar todos os 6 números, que conduzem à almejada Sena, é de 1 em 15.890.700 (quinze milhões e oitocentos e noventa mil e setecentos).
                </p>
                
                <h2 class='p-0 mt-2'>Dupla Sena de Páscoa</h2>
                <p>
                Um dos momentos mais especiais é a Dupla Sena de Páscoa, um concurso exclusivo que ocorre no sábado que antecede o domingo de Páscoa, celebrando essa data festiva. O nome é uma referência à proximidade com a Páscoa. O marco inicial desse sorteio ocorreu no dia 15 de abril de 2017, com o concurso de número 1630.
                </p>
                <p>
                As regras para participar desse evento especial são idênticas às dos outros concursos da modalidade Dupla Sena. Entretanto, merece destaque o percentual da arrecadação destinado ao prêmio principal, que alcança 46% (quarenta e seis por cento). Caso não haja vencedor com 6 (seis) acertos, o prêmio principal do primeiro sorteio é unido e distribuído entre os ganhadores com 5 (cinco) acertos, a QUINA. Isso significa que o prêmio desse concurso especial não acumula. Vale ressaltar que o prêmio principal é destinado exclusivamente aos vencedores do primeiro sorteio. O segundo sorteio só contribui para o prêmio principal se não houver nenhum vencedor em nenhuma das faixas de premiação do primeiro sorteio.
                </p>
                <p>
                O prêmio da Dupla Sena de Páscoa é constituído pela combinação de uma parcela do montante arrecadado nos concursos regulares da Dupla Sena ao longo do ano e o valor acumulado para o concurso especial. Na semana anterior à data do sorteio da Dupla Sena de Páscoa, os sorteios da programação semanal não são realizados.
                </p>"
                ,'description2' => "<p>A Dupla Sena é uma loteria única que oferece uma experiência de jogo empolgante e emocionante. Com sua abordagem inovadora de dois sorteios por concurso, esta loteria cativa a imaginação de jogadores que buscam uma chance de ganhar grandes prêmios. Neste artigo, vamos mergulhar nas regras e no funcionamento da Dupla Sena, explorar as diferentes faixas de premiação e discutir estratégias inteligentes para melhorar suas chances de sair vitorioso.</p>

                <h2 class='ps-0'><b>Regras e Funcionamento:</b></h2>
                
                <p>A Dupla Sena se destaca por sua abordagem única de oferecer não apenas um, mas dois sorteios por concurso. Os jogadores escolhem de 6 a 15 números de um total de 50 disponíveis. Seus números escolhidos serão usados nos dois sorteios, multiplicando as oportunidades de vitória. Isso torna a Dupla Sena uma escolha emocionante para aqueles que buscam mais chances de ganhar.</p>
                
                <h2 class='ps-0'><b>Faixas de Premiação:</b></h2>
                
                <p>A Dupla Sena oferece uma variedade de faixas de premiação, tornando o jogo ainda mais emocionante. O prêmio principal é conquistado por quem acertar todos os números em ambos os sorteios. No entanto, prêmios substanciais também são concedidos para aqueles que acertam cinco, quatro ou até mesmo três números em cada sorteio. Essas diferentes faixas de premiação aumentam a diversidade e o potencial de ganho dos jogadores.</p>
                
                <h2 class='ps-0'><b>Estratégias e Apostas:</b></h2>
                
                <p>Quando se trata de estratégia na Dupla Sena, a diversificação dos números escolhidos é uma abordagem comum. Misturar números altos e baixos, ímpares e pares, pode aumentar suas chances de sucesso. Além disso, considerar a possibilidade de fazer várias apostas com diferentes combinações de números pode ser uma maneira de explorar diferentes caminhos para a vitória. No entanto, lembre-se sempre de que a sorte desempenha um papel crucial no resultado.</p>"
                ,'description_stats' => '<p>Com a Dupla Sena, se você optar por uma aposta simples de 6 (seis) números, suas chances são de 1 em 15.890.700 (quinze milhões, oitocentos e noventa mil e setecentos), aproximadamente representando 0,000006%. Essa probabilidade é calculada considerando os 50 (cinquenta) números disponíveis na Dupla Sena e as 31.781.400 combinações numéricas possíveis ao marcar 6 números. Como são realizados dois sorteios no mesmo concurso, suas chances dobram de 0,000003% para 0,000006%. Se você ousar com duas apostas, suas chances dobram novamente, atingindo 0,000012%. E se decidir apostar com três jogos distintos, suas chances triplicam, elevando-se a 0,000018%. Ao multiplicar 0,000006% pelo número de apostas de 6 (seis) números, você poderá obter o percentual de vitória.
                </p>
                <p>
                Na fascinante faixa de premiação com 5 (cinco) acertos, a QUINA, a probabilidade de ganhar com uma aposta simples de 6 (seis) números é de 1 em 60.192 (sessenta mil e cento e noventa e dois), correspondendo a 0,0017%. Para a faixa de premiação com 4 (quatro) acertos, a QUADRA, a probabilidade de vitória com uma aposta simples de 6 (seis) números é de 1 em 1.120 (um mil e cento e vinte), representando 0,09%. Já na faixa de premiação com 3 (três) acertos, o TERNO, a probabilidade de ganhar com uma aposta simples de 6 (seis) números é de 1 em 60 (sessenta), aproximadamente 1,66%. Vale lembrar que, contudo, ter o mesmo número de jogos não garante sucesso. A probabilidade matemática é uma oportunidade, não uma certeza, já que outras variáveis influenciam o resultado e estão além do alcance dos cálculos.
                </p>
                <p>
                A tabela abaixo detalha as probabilidades para as diferentes modalidades de apostas e faixas de premiação na empolgante Dupla Sena.
                </p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Quantidade de nº jogados</th>
                            <th>Sena</th>
                            <th>Quina</th>
                            <th>Quadra</th>
                            <th>Terno</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="b">6</td>
                            <td>15.890.700</td>
                            <td>60.192</td>
                            <td>1.120</td>
                            <td>60</td>
                        </tr>
                        <tr>
                            <td class="b">7</td>
                            <td>2.270.100</td>
                            <td>17.597</td>
                            <td>502</td>
                            <td>37</td>
                        </tr>
                        <tr>
                            <td class="b">8</td>
                            <td>567.525</td>
                            <td>6.756</td>
                            <td>263</td>
                            <td>25</td>
                        </tr>
                        <tr>
                            <td class="b">9</td>
                            <td>189.175</td>
                            <td>3.076</td>
                            <td>153</td>
                            <td>18</td>
                        </tr>
                        <tr>
                            <td class="b">10</td>
                            <td>75.670</td>
                            <td>1.576</td>
                            <td>97</td>
                            <td>13</td>
                        </tr>
                        <tr>
                            <td class="b">11</td>
                            <td>34.395</td>
                            <td>881</td>
                            <td>64</td>
                            <td>11</td>
                        </tr>
                        <tr>
                            <td class="b">12</td>
                            <td>17.197</td>
                            <td>528</td>
                            <td>45</td>
                            <td>9</td>
                        </tr>
                        <tr>
                            <td class="b">13</td>
                            <td>9.260</td>
                            <td>333</td>
                            <td>33</td>
                            <td>7</td>
                        </tr>
                        <tr>
                            <td class="b">14</td>
                            <td>5.291</td>
                            <td>220</td>
                            <td>25</td>
                            <td>6</td>
                        </tr>
                        <tr>
                            <td class="b">15</td>
                            <td>3.174</td>
                            <td>151</td>
                            <td>19</td>
                            <td>5</td>
                        </tr>
                    </tbody>
                </table>'
                ,'draw_days' => '1,3,5'
                ,'number_games_payslip' => 3
                ,'min_numbers' => 6
                ,'max_numbers' => 15
                ,'min_match' => 3
                ,'max_match' => 6
            ]
            ,[
                'initials' => 'LM'
                ,'active' => 0
                ,'name' => 'Lotomania'
                ,'biggest_number' => 100
                ,'description' => 'A Lotomania é fácil de jogar e de ganhar: basta escolher 50 números e então concorrer a prêmios para acertos de 20, 19, 18, 17, 16, 15 ou nenhum número.'
                ,'draw_days' => '03,06'
                ,'number_games_payslip' => 1
                ,'min_numbers' => 50
                ,'max_numbers' => 50
            ]
            ,[
                'initials' => 'TM'
                ,'active' => 0
                ,'name' => 'Timemania'
                ,'biggest_number' => 80
                ,'description' => 'A Timemania é a loteria para os apaixonados por futebol. Além de o seu palpite valer uma bolada, você ainda ajuda o seu time do coração.'
                ,'draw_days' => '03,05,07'
                ,'number_games_payslip' => 1
                ,'min_numbers' => 10
                ,'max_numbers' => 10
            ]
            ,[
                'initials' => 'LC'
                ,'active' => 0
                ,'name' => 'Loteca'
                ,'biggest_number' => 0
                ,'description' => 'A Loteca é ideal para você que entende de futebol e adora dar palpites sobre os resultados das partidas. Para apostar, basta marcar o seu palpite para cada um dos 14 jogos do concurso, assinalando uma das três colunas, duas delas (duplo) ou três (triplo).'
                ,'draw_days' => '02'
                ,'number_games_payslip' => 1
                ,'min_numbers' => 1
                ,'max_numbers' => 0
            ]
            ,[
                'initials' => 'FD'
                ,'active' => 0
                ,'name' => 'Federal'
                ,'biggest_number' => 0
                ,'description' => 'A Loteria Federal é fácil de ganhar e fácil de apostar!'
                ,'draw_days' => '04,07'
                ,'number_games_payslip' => 1
                ,'min_numbers' => 0
                ,'max_numbers' => 0
            ]
            ,[
                'initials' => 'LG'
                ,'active' => 0
                ,'name' => 'Lotogol'
                ,'biggest_number' => 0
                ,'description' => 'Acerte a quantidade de gols feitas pelos times de futebol na rodada e concorra a uma bolada. Para apostar, basta marcar no volante o número de gols de cada time de futebol participante dos 5 jogos do concurso. Você pode assinalar 0, 1, 2, 3 ou mais gols (opção está representada pelo sinal +).'
                ,'draw_days' => '02'
                ,'number_games_payslip' => 5
                ,'min_numbers' => 3
                ,'max_numbers' => 5
            ]
        ];

        return $loteriesToCreate;
    }

    public function create_lotery($data = [])
    {
        return Lotery::create($data);
    }
}
