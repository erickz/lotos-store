<template>
    <div>
        <div class="clearfix" v-if="loading">
            <div class="loading col-lg-12 p-0">
                <img src="/img/loading.gif" class="loadingIcon" width="40"/>
            </div>
        </div>
        <div class="clearfix" v-else>
            <div class="alert" :class="'alert-' + alert.type" v-if="alert.message">
                <i class="fas fa-fw fa-lg" :class="alert.icon"></i> {{ alert.message }}
            </div><!-- /alert -->
            <div class="bolaoBuilder col-lg-6 pr-0">
                <div class="clearfix">
                    <h2 class="pull-left"><span class="fas fa-newspaper"></span> Registrar jogos</h2>
                </div><!-- /clearfix -->

                <div class="wrapperSaving" v-if="saving">
                    <img src="/img/loading.gif" alt="Enviando jogo"/> <strong>Salvando</strong>
                    <div class="layer"></div>
                </div>
                <div v-else>
                    <div class="numberPicker">
                        <input type="text" v-if="maxNumbersFromLotery > 0" v-for="i in maxNumbersFromLotery" class="number" v-bind:value='("0" + i).slice(-2)'
                               readonly v-on:click='selectNumber(i)' v-bind:class="[{ 'chosen': chosenNumbers.indexOf(('0' + i).slice(-2)) !== -1 }]" />
                        <strong class="mt-1">Total de números selecionados: {{ chosenNumbers.length }}</strong>
                    </div><!-- /bolaoBuilder -->

                    <div class="chosenNumbersCt mt-3">
                        <strong>Números selecionados:</strong> <br />
                        <input type="text" name="numbers" class="form-control chosenNumbers" v-model="chosenNumbers" />
                    </div><!-- / -->

                    <div class="clearfix mt-3">
                        <div class="pull-left mt-0">
                            <a class="btn btn-primary addBolao pull-left" v-on:click="prepToSaveGame">
                                <i class="fas fa-plus-circle fa-lg"></i> Adicionar jogo
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 ">
                <div class="clearfix">
                    <h2 class="pull-left mt-5 pl-3"><span class="fas fa-newspaper"></span> Jogos registrados</h2>
                </div><!-- /clearfix -->

                <div class="bolaoGameListing main-box clearfix" v-if="games.length > 0">
                    <div class="table-responsive">
                        <table class="table customer-list">
                            <thead>
                            <tr>
                                <th><span>Jogo</span></th>
                                <th><span>Verificado</span></th>
                                <th><span>Premiado</span></th>
                                <th><span>Faixa de acerto</span></th>
                                <th><span>Criado</span></th>
                                <th><span></span></th>
                            </tr>
                            </thead>

                            <tbody name="listing" is="transition-group">
                            <tr v-for="(game, index) in games" class="trGames" v-bind:key='index'>
                                <td>
                                    {{ game.numbers }}
                                </td>
                                <td v-html="game.checked">
                                    {{ game.checked }}
                                </td>
                                <td v-html="game.prized">
                                    {{ game.prized }}
                                </td>
                                <td v-html="game.number_match">
                                    {{ game.number_match }}
                                </td>
                                <td v-html="game.created">
                                    {{ game.created }}
                                </td>
                                <td v-html="">
                                    <a class="table-link danger deleteGame" v-on:click="deleteGame(game.id, index)">
                                            <span class="fa-stack">
                                                <i class="fa fa-square fa-stack-2x"></i>
                                                <i class="fas fa-trash fa-stack-1x fa-inverse"></i>
                                            </span>
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div><!-- /table-responsive -->
                </div><!-- /main-box -->
                <div v-else>
                    <div class="alert alert-warning">
                        <i class="fas fa-fw fa-lg fa-exclamation-triangle"></i> Não há bolões cadastrados, selecione {{ this.loteryData.min_numbers }} números para criar um jogo
                    </div><!-- /alert -->
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                maxNumbersFromLotery: 0
                ,loading: true
                ,saving: false
                ,deleting: false
                ,loteryData: []
                ,chosenNumbers: []
                ,alert: {
                    type: 'warning'
                    ,message: ''
                    ,icon: 'fa-exclamation-triangle'
                }
                ,games: []
            }
        }
        ,props: ['lotery', 'bolaoId']
        ,methods: {
             getLoteryInfo(){
                this.$http.get(this.$apiPrefixVersion + 'loteries/' + this.$props.lotery,{
                  headers: {
                      'Authorization': 'Bearer ' + process.env.MIX_JWT_APP_TOKEN
                  }
                }).then(function(response){

                    this.loteryData = response.body.data
                    this.maxNumbersFromLotery = this.loteryData.biggest_number

                    this.loading = false

                }, function(response){
                    this.alert.message = 'Não foi possível retornar os dados da loteria'
                })
            }
            ,prepToSaveGame(){
                //Check if the chosen numbers are bigger than the maximum allowed by the lotery
                if (this.chosenNumbers.length > this.loteryData.max_numbers){
                    this.alert.message = 'Para jogar na ' + this.loteryData.name + ' é necessário que tenha no máximo ' +
                        this.loteryData.max_numbers + ' números selecionados'
                }
                else {
                    //Check if the chosen numbers are bigger than the minimum allowed by the lotery
                    if (this.chosenNumbers.length < this.loteryData.min_numbers){
                        this.alert.message = 'Para jogar na ' + this.loteryData.name + ' é necessário que tenha ' +
                                this.loteryData.min_numbers + ' números selecionados'
                    }
                    else {
                        this.saveGame()
                    }
                }
            }
            ,getGames(){
                this.$http.get(this.$apiPrefixVersion + 'boloes/' + this.$props.bolaoId + '/games',{
                    headers: {
                        'Authorization': 'Bearer ' + process.env.MIX_JWT_APP_TOKEN
                    }
                }).then(function(response){

                    this.games = response.body.data

                }, function(response){
                    this.alert.message = 'Não foi possível retornar os jogos desse bolão'
                })
            }
            ,deleteGame(gameId, index){
                if( this.deleting ){
                    return;
                }

                this.deleting = true

                this.$http.delete(this.$apiPrefixVersion + 'boloes/' + this.$props.bolaoId + '/games/' + gameId, {
                    headers: {
                        'Authorization': 'Bearer ' + process.env.MIX_JWT_APP_TOKEN
                    }
                }).then(function(response){
                    this.deleting = false

                    this.games.splice(index, 1)

                    // this.games = response.body.data
                    this.successAlertMessage("Jogo apagado com sucesso")

                }, function(response){
                    this.alert.message = 'Não foi possível apagar o jogo selecionado'
                })
            }
            ,saveGame(){
                 if (this.$props.lotery === undefined || ! this.$props.lotery || this.saving ){
                     return
                 }

                 this.saving = true;

                 this.$http.post(this.$apiPrefixVersion + 'boloes/' + this.$props.bolaoId + '/games',{
                        numbers: this.chosenNumbers
                 }, {
                     headers: {
                         'Authorization': 'Bearer ' + process.env.MIX_JWT_APP_TOKEN
                     }
                 }).then(function(response){
                     this.games.unshift(response.body.data)
                     this.chosenNumbers = []

                     this.successAlertMessage(response.body.message)

                     this.saving = false
                 }, function(response){
                     this.alert.message = response.body.message
                     this.saving = false
                 })
            }
            ,selectNumber(value){
                let index = this.chosenNumbers.indexOf(("0" + value).slice(-2))

                 if (index !== -1){
                     if(this.chosenNumbers.length == this.loteryData.max_numbers){
                         this.alert.message = ''
                     }

                     this.chosenNumbers.splice(index, 1)
                 }
                 else {
                     if(this.chosenNumbers.length < this.loteryData.max_numbers){
                         this.chosenNumbers.push(("0" + value).slice(-2))
                         this.chosenNumbers.sort((a, b) => a - b )
                     }
                     else {
                         this.alert.message = 'Limite máximo de números atingido'
                     }
                 }
            }
            ,successAlertMessage(message){
                this.alert.message = message
                this.alert.type = 'success'
                this.alert.icon = 'fa-check-circle'

                this.resetAlertMessage();
            }
            ,resetAlertMessage(){
                setTimeout(() => {
                    this.alert.message = ''
                    this.alert.type = 'warning'
                    this.alert.icon = 'fa-exclamation-triangle'
                }, 3000);
            }
        }
        ,mounted(){
            this.getLoteryInfo()
            this.getGames();
        }
        ,components: {}
    }
</script>

