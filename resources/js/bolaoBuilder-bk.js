$(function(){
    var handleAlert = function(target, message, type, icon){
        var warningIcon = '<svg xmlns="http://www.w3.org/2000/svg" fill="#FFF" viewBox="0 0 16 16" width="16" height="16"><path d="M6.457 1.047c.659-1.234 2.427-1.234 3.086 0l6.082 11.378A1.75 1.75 0 0 1 14.082 15H1.918a1.75 1.75 0 0 1-1.543-2.575Zm1.763.707a.25.25 0 0 0-.44 0L1.698 13.132a.25.25 0 0 0 .22.368h12.164a.25.25 0 0 0 .22-.368Zm.53 3.996v2.5a.75.75 0 0 1-1.5 0v-2.5a.75.75 0 0 1 1.5 0ZM9 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"></path></svg>';
        var successIcon = '<svg xmlns="http://www.w3.org/2000/svg" fill="#FFF" viewBox="0 0 16 16" width="16" height="16"><path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8Zm1.5 0a6.5 6.5 0 1 0 13 0 6.5 6.5 0 0 0-13 0Zm10.28-1.72-4.5 4.5a.75.75 0 0 1-1.06 0l-2-2a.751.751 0 0 1 .018-1.042.751.751 0 0 1 1.042-.018l1.47 1.47 3.97-3.97a.751.751 0 0 1 1.042.018.751.751 0 0 1 .018 1.042Z"></path></svg>';
        var closeBt = '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
        var chosenIcon = (type == 'success' ? successIcon : warningIcon);

        if (type == undefined || ! type ){
            type = 'warning';
        }

        if ( icon != undefined && icon ){
            chosenIcon = (icon == 'success' ? successIcon : warningIcon);;
        }

        target.find('.alert').html( chosenIcon + ' ' + message + '' + closeBt).removeClass('d-none').addClass('alert-' + type);
    }

    var bolaoBuilder = function()
    {
        var bolaoBuilder = $(".bolaoBuilder");

        if (bolaoBuilder.length > 0){
            var minNumber = bolaoBuilder.data('minnumber');
            var maxNumber = bolaoBuilder.data('maxnumber');
            var guessNumber = bolaoBuilder.find(".guessNumber");
            var addBolao = bolaoBuilder.find(".addBolao");
            var cleanBolao = bolaoBuilder.find(".cleanBolao");
            var removeAllBoloes = bolaoBuilder.find(".removeAllBoloes");
            var numbersToSelectCt = bolaoBuilder.find('.numbersToSelectCt');
            var statsCt = bolaoBuilder.find('.statsCt');
            var dozenNumbers = statsCt.find('.dozensNumber');
            var bolaoSubtotal = statsCt.find('.bolaoSubtotal');
            var costs = bolaoBuilder.data('costs');
            var slPrices = bolaoBuilder.find('.slPrices');
            var stepFinalize = $('.stepFinalize');
            var minBoloes = 6;

            var buildGamesList = function(){
                var bettingsSessionData = JSON.parse(sessionStorage.getItem('bettings'));
                var gameList = $('.bolaoBuilder .games-list');
                var gamesListTbody =  gameList.find('tbody');
                var gamesListTfoot = gameList.find('tfoot');
                var total = 0;

                //Build games listing
                gamesListTbody.html('');
                $.each(bettingsSessionData, function(index, value){
                    var deleteAction = $('<a class="table-link cursor-p danger removeBolao" data-id="' + index + '"><span class="fa-stack"><i class="fa fa-square text-danger fa-stack-2x"></i><i class="fas fa-trash fa-stack-1x fa-inverse"></i></span></a>');
                    var costLine = value.cost.toLocaleString('pt-BR');
                    var $line = $('<tr><td>' + index + '</td><td>' + value.numbers + '</td><td>' + value.dozensSelected + '</td><td data-cost="' + value.cost + '">' + 'R$'+ costLine + '</td><td>' + deleteAction.clone().prop('outerHTML') + '</tr>')
                    gamesListTbody.append($line);
                    total += value.cost;
                });
                var $lineTFoot = $('<tr><td colspan="3"><b>TOTAL:</b></td><td colspan="1" class="text-left bolaoTotal" data-cost="' + total + '">R$' + total.toLocaleString('pt-BR') + '</td><td></td></tr>');
                gamesListTfoot.html($lineTFoot);
            }

            var bettingsSessionData = JSON.parse(sessionStorage.getItem('bettings'));
            if (bettingsSessionData !== null && Object.keys(bettingsSessionData).length != undefined && Object.keys(bettingsSessionData).length > 0){

                //If loto was changed, then clean up the stored data
                if (sessionStorage.getItem('lotoAlias') != bolaoBuilder.data('loto-alias') ){
                    sessionStorage.removeItem('bettings');
                    sessionStorage.removeItem('lotoAlias');
                }

                buildGamesList();
            }

            var updateSelectedDozens = function(){
                var numberSelected = numbersToSelectCt.find('.chosen').length;
                var cost = numberSelected < minNumber ? costs[minNumber] : costs[numberSelected];

                dozenNumbers.text(numberSelected);
                bolaoSubtotal.text(numberSelected == 0 ? 0 : cost.toLocaleString('pt-BR'));

                measureQuality();
            }

            var removeBolao = function(target){
                var $this = target;
                var idToRemove = $this.data('id');
                var bettingsSessionData = JSON.parse(sessionStorage.getItem('bettings'));
                var wasRemoved = 0;

                $.each(bettingsSessionData, function(index, value){                        
                    if(index == idToRemove){
                        delete bettingsSessionData[index];
                    }
                });
                
                var bettingsSessionDataNew = {};
                var i = 1;
                //Re-order the array
                $.each(bettingsSessionData, function(index, value){                        
                    bettingsSessionDataNew[i++] = value;
                });

                sessionStorage.setItem('bettings', JSON.stringify(bettingsSessionDataNew));

                buildGamesList();
                handleAlert(bolaoBuilder, "Aposta removida com sucesso", 'default', 'success'); 
                measureQuality();
                calculateProfitAndCotas();
            }

            var measureQuality = function(){
                var bolaoGrade = bolaoBuilder.find('.progress-bar-level');
                var gamesList = $('.bolaoBuilder .games-list');
                var gamesItems = gamesList.find('tbody tr').not('.text-center');
                var countGames = gamesItems.length;
                var total = 0;
                var bolaoMessages = {
                    moreBets: 'Quanto maior o valor da sua aposta maior será a receita e o lucro',
                    diversifyNumbers: 'Varie suas dezenas, tente encontrar um equilibrio entre números baixos, médios e altos',
                    moreDozens: 'Escolha mais dezenas, quanto mais números você selecionar maior serão suas chances',
                };
                var textGrade = 'Nível 1 - (Regular)';

                if (countGames > 0){
                    slPrices.removeAttr('disabled');
                    bolaoBuilder.find('.messageProfit').show();
                }
                else {
                    slPrices.attr('disabled', 'disabled');
                    bolaoBuilder.find('.messageProfit').hide();
                    bolaoBuilder.find('.cotasCt').text("0");
                }

                gamesItems.each(function(index,value){
                    var $this = $(this);
                    if (countGames > 0){
                        var numbersSelected = $this.find('td').eq(1).text();
                        var countNumbers = numbersSelected.length > 0 ? numbersSelected.split(',').length : null;
                    }
                    
                    var cost = $this.find('td').eq(3).data('cost');

                    total += cost;

                    if (bolaoMessages.moreDozens && countNumbers > minNumber){
                        bolaoMessages.moreDozens = null;
                    }
                });

                if (total >= 45.00){
                    bolaoBuilder.find('.finishButton a').removeClass('disabled');
                    stepFinalize.attr('href', stepFinalize.attr('data-href'));
                }
                else {
                    bolaoBuilder.find('.finishButton a').addClass('disabled', 'disabled');
                    stepFinalize.removeAttr('href');
                }

                if (countGames >= 40){
                    bolaoMessages.moreBets = null;
                }

                if(bolaoGrade.is(".level2")){
                    bolaoGrade.removeClass('level2');
                }

                if(bolaoGrade.is(".level3")){
                    bolaoGrade.removeClass('level3');
                }

                bolaoGrade.find('.starsCt').html('');
                bolaoGrade.find('ul').html('');

                var iconStar = $('<i class="fa fa-star"></i>');
                bolaoGrade.find('.starsCt').append(iconStar.clone());

                if(total >= 500){
                    bolaoGrade.addClass('level3');
                    textGrade = 'Nível 3 - (Excelente)';
                    
                    for(var i = 0; i <= 1; i++){
                        bolaoGrade.find('.starsCt').append(iconStar.clone());
                    }

                    bolaoGrade.find('.starsCt .fa-star').each(function(index, value){
                        var $this = $(this);
                        $this.addClass('color-default');
                    });

                    bolaoMessages.diversifyNumbers = null;
                    bolaoMessages.moreBets = null;
                }
                else if (total >= 100){
                    bolaoGrade.addClass('level2');
                    textGrade = 'Nível 2 - (Ótimo)';

                    bolaoGrade.find('.starsCt').append(iconStar.clone());

                    bolaoGrade.find('.starsCt .fa-star').each(function(index, value){
                        var $this = $(this);
                        $this.addClass('text-warning');
                    });

                    bolaoMessages.diversifyNumbers = null;
                }

                bolaoGrade.find('h4').text(textGrade);

                $.each(bolaoMessages, function(index, message){
                    if (message){
                        var $li = $('<li></li>');
                        bolaoGrade.find('ul').append($li.clone().text(message));
                    }
                });

                //Remove bolao
                bolaoBuilder.find(".qtGames").text('(' + countGames + ')');
                var removeBolaoTg = bolaoBuilder.find(".removeBolao");
                removeBolaoTg.off('click').on('click', function(){
                    removeBolao($(this));
                });
            };

            var addNumberFunction = function(target){
                target.addClass('chosen');

                updateSelectedDozens();
            }

            var removeNumberFunction = function(target){
                target.removeClass('chosen');

                updateSelectedDozens();
            }

            var selectNumber = function(event){
                var $this = $(this);

                if ($this.is('.chosen')){
                    removeNumberFunction($this);
                    return;
                }

                if (numbersToSelectCt.find('.chosen').length < maxNumber){
                    if (! $this.is('.chosen')){
                        addNumberFunction($this);
                    }
                }
            }

            bolaoBuilder.find('.numberPicker .number').on('click', selectNumber);

            var calculateProfitAndCotas = function(){
                var profitCt = bolaoBuilder.find('.profitCt');
                var cotasCt = bolaoBuilder.find('.cotasCt');
                var bolaoTotal = bolaoBuilder.find(".bolaoTotal");

                if (bolaoTotal.length > 0){
                    var pricesOptions = slPrices.find('option');
                    var bolaoCostDouble = bolaoTotal.data('cost');

                    if(pricesOptions.filter(':selected').val() > parseFloat(bolaoCostDouble)){
                        pricesOptions.filter(':selected').removeAttr('selected');
                        pricesOptions.first().attr('selected', 'selected');
                    }

                    var priceCota = slPrices.find(':selected').val();
                    var revenue = Math.ceil(bolaoCostDouble * 1.4);
                    var recomendedCotas = Math.round((revenue / priceCota));
                    recomendedCotas = recomendedCotas <= 1 ? 2 : recomendedCotas;
                    //Any change in the formatings will probably break the code
                    var profitBolao = String((priceCota * recomendedCotas) - bolaoCostDouble);
                    var taxPlatform = profitBolao * 0.337;
                    profitBolao = (new Intl.NumberFormat('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2}).format(profitBolao - taxPlatform));

                    cotasCt.text(recomendedCotas);
                    profitCt.text('R$' + (profitBolao));                    

                    if(recomendedCotas <= 3){
                        cotasCt.removeClass('text-danger');
                        cotasCt.removeClass('color-default');
                        cotasCt.addClass('text-warning');
                    }
                    else if(recomendedCotas <= 50){
                        cotasCt.removeClass('text-danger');
                        cotasCt.removeClass('text-warning');
                        cotasCt.addClass('color-default');
                    }
                    else if(recomendedCotas >= 50 && recomendedCotas <= 100){
                        cotasCt.removeClass('text-danger');
                        cotasCt.removeClass('color-default');
                        cotasCt.addClass('text-warning');
                    }
                    else {
                        cotasCt.removeClass('text-danger');
                        cotasCt.removeClass('color-default');
                        cotasCt.addClass('text-danger');
                    }

                    pricesOptions.each(function(index, value){
                        var $this = $(this);
                        var opValue = parseFloat($this.val());

                        if(opValue > parseFloat(bolaoCostDouble)){
                            $this.attr('disabled', 'disabled');
                        }
                        else {
                            $this.removeAttr('disabled');
                        }
                    })

                    var formatedPriceCota = 'R$' + (new Intl.NumberFormat('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2}).format(priceCota));
                    updateConfirmationBolao(formatedPriceCota, bolaoBuilder.find('.games-list tbody tr').length, cotasCt.text(), bolaoBuilder.find('.bolaoTotal').text() );
                }
                else {
                    cotasCt.text(0);
                    profitCt.text('');
                    updateConfirmationBolao(0, 0, 0, 0);
                }
            };

            var updateConfirmationBolao = function(priceCota, numbersBet, numberCotas, total){
                var bolaoConfirmationModal = $('#bolaoConfirmationModal');

                bolaoConfirmationModal.find('.priceCota').text(priceCota);
                bolaoConfirmationModal.find('.numberBets').text(numbersBet);
                bolaoConfirmationModal.find('.numberCotas').text(numberCotas);
                bolaoConfirmationModal.find('.totalBolao').text(total);

                var slKeepCotas = bolaoConfirmationModal.find('.slKeepCotas');

                slKeepCotas.html('');

                slKeepCotas.append('<option value="0">0</option>');
                for(var i = 1; i <= numberCotas; i++){
                    slKeepCotas.append('<option value="' + i + '">' + i + '</option>');
                }

                var bettingsSessionData = JSON.parse(sessionStorage.getItem('bettings'));
                if (bettingsSessionData && bettingsSessionData.length > 0){
                    var bolaoGames = Object.values(bettingsSessionData);

                    bolaoConfirmationModal.find('form .game').each(function(index, value){
                        $(this).remove();
                    });
                    
                    $.each(bolaoGames, function(index, value){
                        var input = $('<input type="hidden" name="games[]" class="game" value="' + value.numbers + '" />');

                        bolaoConfirmationModal.find('form').prepend(input);
                    });
                }
            }

            slPrices.on('change', function(){
                calculateProfitAndCotas();
            });

            //Clean the bolao
            cleanBolao.on('click', function(){
                var selectedNumbers = numbersToSelectCt.find('.chosen');

                if (selectedNumbers.length > 0){
                    selectedNumbers.each(function(index, value){
                        var $this = $(this);
                        removeNumberFunction($this);
                    });
                }
            });

            //Remove All
            removeAllBoloes.on('click', function(){
                var gameList = $('.bolaoBuilder .games-list tbody');

                sessionStorage.setItem('bettings', JSON.stringify({}));

                buildGamesList();
                handleAlert(bolaoBuilder, "Apostas removidas com sucesso", 'default', 'success'); 
                measureQuality();
                calculateProfitAndCotas();
            })

            //Add bolao
            addBolao.on('click', function(){
                var $this = $(this);
                var min = parseInt(Object.keys(costs)[0]);
                var max = parseInt(Object.keys(costs).pop());
                var dozensNumberVal = parseInt(dozenNumbers.text());
                var csrf = bolaoBuilder.find('input[name="_token"]').val();
                var formData = { '_token': csrf, numbers: []};
                var numbersSelected = [];
                var bettingsSessionData = JSON.parse(sessionStorage.getItem('bettings'));
               
                if (dozensNumberVal >= min && dozensNumberVal <= max){
                    numbersToSelectCt.find('.chosen').each(function(index, value){
                        var $this = $(this);

                        numbersSelected.push($this.data('number'));
                    });
                    
                    if (bettingsSessionData == undefined || ! bettingsSessionData){
                        bettingsSessionData = {};
                    }

                    var betsCount = Object.keys(bettingsSessionData).length;

                    var countNumbers = numbersSelected.length;
                    var betCost = costs[countNumbers];
                    var newBet = {numbers: numbersSelected, dozensSelected: countNumbers, cost: betCost};
                    bettingsSessionData[(betsCount + 1)] = newBet;   

                    sessionStorage.setItem('bettings', JSON.stringify(bettingsSessionData));
                    if (sessionStorage.getItem('lotoAlias') == undefined || ! sessionStorage.getItem('lotoAlias')){
                        sessionStorage.setItem('lotoAlias', bolaoBuilder.data('loto-alias'));    
                    }

                    buildGamesList();
                    handleAlert(bolaoBuilder, "Aposta adicionada com sucesso", 'default', 'success'); 
                    measureQuality();
                    calculateProfitAndCotas();
                    cleanBolao.click();
                }
            });

            var setGuessNumbersConfigs = function(){
                var dropdownGuessNumbers = bolaoBuilder.find('.guessNumber .dropdown-menu');
                var costsArray = Object.keys(costs);

                $.each(costsArray, function(index, value){
                    dropdownGuessNumbers.append('<li><a data-value="' + value + '">' + value + ' números</a></li>');
                });

                //Guess a random number
                guessNumber.find('.dropdown-menu li a').on('click', function(){
                    var numbersToGuess = $(this).data('value');

                    $.each(numbersToSelectCt.find('.chosen'), function(){
                        $(this).removeClass('chosen');
                    });

                    var generatedNumbers = [];
                    for(var i = 1; i <= numbersToGuess; i++){
                        var retry = true;

                        while(retry){
                            var randomN = Math.random() * (bolaoBuilder.data('biggestnumber') - 1) + 1;
                            randomN = Math.round(randomN);

                            if ($.inArray(randomN, generatedNumbers) >= 0){
                                retry = true;
                            }
                            else {
                                retry = false
                            }
                        }
                        
                        var randomSelected = numbersToSelectCt.find('.number_' + randomN);
            
                        if (randomSelected.length > 0 && numbersToSelectCt.find('.chosen').length < maxNumber){
                            addNumberFunction(randomSelected);
                            generatedNumbers.push(randomN);
                        }
                    }

                    measureQuality();
                });
            };

            var finalizeBolao = function(){
                var bolaoConfirmationModal = $('#bolaoConfirmationModal');
                var btnFinalize = bolaoConfirmationModal.find(".btn-finalize");
                
                btnFinalize.on('click', function(e){
                    e.preventDefault();
                    
                    var $this = $(this);
                    var concursoId = $('#slConcurso').find('option:selected').val();
                    var bolaoBuilderFinal = $('.bolaoBuilder');
                    var priceCota =  bolaoBuilderFinal.find('.slPrices').find('option:selected').val();
                    var qtCotas =  bolaoBuilderFinal.find('.cotasCt').text();
                    var gamesArray = [];

                    // var formData = $.extend(btnFinalize.parents('form').serializeArray(), [{name: 'concurso_id', value: concursoId}, {name: 'price', value: priceCota}, {name: 'qtCotas', value: qtCotas}]);
                    var baseData = [{name: 'concurso_id', value: concursoId}, {name: 'price', value: priceCota}, {name: 'qtCotas', value: qtCotas}];
                    console.log(bettingsSessionData);
                    $.each(Object.values(bettingsSessionData), function(index,value){
                        baseData.push({name: 'games[]', value: value.numbers.toString()});
                    });
                    var formData = btnFinalize.parents('form').serializeArray();
                    formData = formData.concat(baseData);

                    $.ajax({
                        url: '',
                        dataType: 'json',
                        type: 'POST',
                        data: formData,
                        beforeSend: function(e){
                            var $this = $(this);
                            $this.find('.alert').html('').addClass('d-none');
    
                            btnFinalize.prop("disabled", true);
                            setTimeout(function(){
                                btnFinalize.prop('disabled', false);
                            }, 1000);
                        }
                    })
                    .done(function(response){
                        if (response.error != undefined && response.error === 0){
                            if (response.redirect == 1){
                                window.location = response.message;
                            }
                            else {
                                handleAlert($this.parents('.modal'), response.message, 'success'); 
                            }
                        }
                        else {
                            handleAlert($this.parents('.modal'), response.message);
                        }
                    })
                    .fail(function(json){
                        response = JSON.parse(json.responseText);
    
                        handleAlert($this.parents('.modal'), response.message);
                    });
                });
            };

            var initFunctions = function(){
                $(document).on('ready', function(){
                    measureQuality();
                    calculateProfitAndCotas();
                    setGuessNumbersConfigs();
                    finalizeBolao();
                });
            }();
        }
    }();
});