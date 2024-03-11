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

    var buildGamesList = function(){
        var bettingsSessionData = JSON.parse(sessionStorage.getItem('bettings'));
        var gameList = $('.games-list');
        var hasDelete = gameList.data('hasdelete');
        var gamesListTbody =  gameList.find('.gamesCt');
        var gamesListTfoot = gameList.find('.gamesListFooter');
        var arChances = gameList.data('chances');
        var loteryColorObj = {
            mg: 'success',
            qn: 'primary',
            ds: 'danger',
            lf: 'info'
        }
        var loteryColor = loteryColorObj[sessionStorage.getItem('lotoAlias')];
        var countGames = Object.keys(bettingsSessionData).length;
        var total = 0;

        //Build games listing
        gamesListTbody.html('');
        var nChances = 0;
        if (bettingsSessionData){

            $.each(bettingsSessionData, function(index, value){
                var deleteAction = $('<a class="table-link cursor-p danger removeBolao d-block" data-id="' + index + '"><span class="fa-stack"><i class="fa fa-square text-danger fa-stack-2x"></i><i class="fas fa-trash fa-stack-1x fa-inverse"></i></span></a>');
                if (hasDelete != undefined && hasDelete == 0){
                    deleteAction = '';
                }
                var costLine = value.cost.toLocaleString('pt-BR', { minimumFractionDigits: 2,maximumFractionDigits: 2 });
                //deleteAction.clone().prop('outerHTML')
                // var $line = $('<tr><td data-label="Id">' + index + '</td><td data-label="Números selecionados">' + value.numbers + '</td><td data-label="Preço" data-cost="' + value.cost + '">' + 'R$'+ costLine + '</td><td data-label="Remover">' + deleteAction.clone().prop('outerHTML') + '</tr>')

                var numbers = '';

                var qtNumbers = value.numbers.length;
                nChances += parseInt(arChances[qtNumbers]);

                $.each(value.numbers, function(index2, val2){
                    numbers += "<div class='number me-1 min-w-25px border border-" + loteryColor + " text-" + loteryColor + " badge badge-pill p-2 rounded-circle'><b>" + (val2.toString().length == 1 ? ("0" + val2) : val2) + "</b></div>";
                });

                var $line = $('<div class="game border-bottom border-secondary pb-4 mb-6"><div class="d-flex text-center align-items-center justify-content-center"><div class="me-2">' + (deleteAction.length > 0 ? deleteAction.clone().prop('outerHTML') : '') + '</div><div class="slNumbers">' + numbers + '</div><div class="costGame text-center ms-2"><span class="pb-2">Aposta de <b data-cost="' + value.cost + '">' + 'R$' + costLine + '</b></span></div></div></div>')
                gamesListTbody.append($line);
                total += value.cost;
            });
            var $lineTFoot = $('<b>TOTAL: </b><span class="bolaoTotal" data-cost="' + total + '">R$' + total.toLocaleString('pt-BR', { minimumFractionDigits: 2,maximumFractionDigits: 2 }) + '</span>');
            gamesListTfoot.html($lineTFoot);
        }
        //Calculate chances
        var chancesTg = $('.chancesTg');
        chancesTg.html('<b>' + (nChances <= 0 ? '' : nChances + 'x') + ' mais chances</b>');

        $(".qtGames").text('(' + countGames + ')');
    }

    var bolaoFinalize = function()
    {
        var bolaoFinalize = $("#bolaoFinalize");

        if (bolaoFinalize.length > 0){
            var slPrices = bolaoFinalize.find('.slPrices');

            var calculateProfitAndCotas = function(){
                var profitCt = bolaoFinalize.find('.profitCt');
                var revenueCt = bolaoFinalize.find('.revenueCt');
                var costCt = bolaoFinalize.find('.costCt');
                var cotasCt = bolaoFinalize.find('.cotasCt');
                var bettingsSessionData = JSON.parse(sessionStorage.getItem('bettings'));
                var bolaoTotal = 0;
                var qtGames = Object.keys(bettingsSessionData).length;

                if (bettingsSessionData.length <= 0){
                    return null;
                }

                $.each(bettingsSessionData, function(index, value){
                    bolaoTotal += value.cost;
                });

                if (bolaoTotal > 0){
                    var pricesOptions = slPrices.find('option');
                    bolaoFinalize.find('.inputHdTotalToPay').val(bolaoTotal);

                    if(pricesOptions.filter(':selected').val() > parseFloat(bolaoTotal)){
                        pricesOptions.filter(':selected').removeAttr('selected');
                        pricesOptions.first().attr('selected', 'selected');
                    }

                    var priceCota = slPrices.length > 0 ? slPrices.find(':selected').val() : $('.priceCotas').val();
                    var revenue = Math.ceil(bolaoTotal * 1.4);
                    var recomendedCotas = Math.round((revenue / priceCota));
                    recomendedCotas = recomendedCotas <= 1 ? 2 : recomendedCotas;

                    //Any change in the formatings will probably break the code
                    var revenueTotal = String((priceCota * recomendedCotas));
                    var taxPlatform = (priceCota * 0.13) * recomendedCotas;
                    var profitBolao = String((revenueTotal - bolaoTotal - taxPlatform));
                    //var taxPlatform = profitBolao * 0.337;
                    //19% do preço da cota
                    profitBolao = (new Intl.NumberFormat('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2}).format(profitBolao));
                    costTotal = (new Intl.NumberFormat('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2}).format(bolaoTotal));
                    revenueTotal = (new Intl.NumberFormat('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2}).format(revenueTotal - taxPlatform));

                    cotasCt.text(recomendedCotas);
                    revenueCt.text('R$' + (revenueTotal));
                    costCt.text('R$' + (costTotal));
                    profitCt.html('R$' + (profitBolao));

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

                        if(opValue > parseFloat(bolaoTotal)){
                            $this.attr('disabled', 'disabled');
                        }
                        else {
                            $this.removeAttr('disabled');
                        }
                    })

                    var formatedPriceCota = 'R$' + (new Intl.NumberFormat('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2}).format(priceCota));
                    var formatedBolaoTotal = 'R$' + (new Intl.NumberFormat('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2}).format(bolaoTotal));
                    updateConfirmationBolao(formatedPriceCota, qtGames, cotasCt.text(), formatedBolaoTotal );
                }
                else {
                    cotasCt.text(0);
                    profitCt.text('');
                    updateConfirmationBolao(0, 0, 0, 0);
                }
            };

            var updateConfirmationBolao = function(priceCota, numbersBet, numberCotas, total){
                bolaoFinalize.find('.priceCota').text(priceCota);
                bolaoFinalize.find('.numberBets').text(numbersBet + ' apostas');
                bolaoFinalize.find('.numberCotas').text(numberCotas);
                bolaoFinalize.find('.totalBolao').text(total);

                var slKeepCotas = bolaoFinalize.find('.slKeepCotas');

                slKeepCotas.html('');

                slKeepCotas.append('<option value="0">Nenhuma cota</option>');
                for(var i = 1; i <= numberCotas; i++){
                    var plural = i > 1 ? 's' : '';
                    slKeepCotas.append('<option value="' + i + '">' + i + ' cota' + plural + '</option>');
                }

                var bettingsSessionData = JSON.parse(sessionStorage.getItem('bettings'));
                if (bettingsSessionData && bettingsSessionData.length > 0){
                    var bolaoGames = Object.values(bettingsSessionData);

                    bolaoFinalize.find('form .game').each(function(index, value){
                        $(this).remove();
                    });
                    
                    $.each(bolaoGames, function(index, value){
                        var input = $('<input type="hidden" name="games[]" class="game" value="' + value.numbers + '" />');

                        bolaoFinalize.find('form').prepend(input);
                    });
                }
            }

            slPrices.on('change', function(){
                calculateProfitAndCotas();
            });

            var finalizeBolao = function(){
                var btnFinalize = bolaoFinalize.find(".btn-finalize");
                
                btnFinalize.on('click', $.debounce(500, true, function(e){
                    e.preventDefault();
                    
                    var $this = $(this);
                    var gamesArray = [];
                    var formFinalize = bolaoFinalize.find('.formFinalize');
                    var bettingsSessionData = JSON.parse(sessionStorage.getItem('bettings'));

                    $.each(Object.values(bettingsSessionData), function(index,value){
                        var inputNew = '<input type="hidden" name="games[]" value="' + value.numbers.toString() + '" />';
                        formFinalize.prepend(inputNew);
                    });

                    formFinalize.prepend("<input type='hidden' name='qtCotas' value='" + formFinalize.find('.cotasCt').text() + "' /> ");

                    formFinalize.trigger('submit');
                }));
            };

            var initFunctions = function(){
                $(document).on('ready', function(){
                    calculateProfitAndCotas();
                    buildGamesList();
                    finalizeBolao();
                });
            }();
        }
    }();

    var bolaoBuilder = function()
    {
        var bolaoBuilder = $(".bolaoBuilder");

        if (bolaoBuilder.length > 0 ){
            var minNumber = bolaoBuilder.data('minnumber');
            var maxNumber = bolaoBuilder.data('maxnumber');
            var loteryColor = bolaoBuilder.data('color');
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
            var generateNumbersCt = bolaoBuilder.find('.generateNumbersCt');
            var minBoloes = 6;

            var bettingsSessionData = JSON.parse(sessionStorage.getItem('bettings'));
            if (bettingsSessionData !== null && Object.keys(bettingsSessionData).length != undefined && Object.keys(bettingsSessionData).length > 0){

                //If loto was changed, then clean up the stored data
                if (sessionStorage.getItem('lotoAlias') != bolaoBuilder.data('loto-alias') ){
                    sessionStorage.setItem('bettings', JSON.stringify({}));
                    sessionStorage.setItem('lotoAlias', bolaoBuilder.data('loto-alias'));    
                }

                buildGamesList();
            }

            var updateSelectedDozens = function(){
                var numberSelected = numbersToSelectCt.find('.chosen');
                var numberSelectedCount = numberSelected.length;
                var cost = numberSelectedCount < minNumber ? costs[minNumber] : costs[numberSelectedCount];

                if (numberSelectedCount <= 0){
                    bolaoBuilder.find('.selectedDozens').val('--');
                }
                else {
                    var textSelectedDozens = '';

                    numberSelected.each(function(index, val){
                        var $this = $(this);
                        textSelectedDozens += $this.data('number') + (numberSelected[index+1] == undefined ? '' : ', ');  
                    });
                    
                    bolaoBuilder.find('.selectedDozens').val(textSelectedDozens);
                }

                dozenNumbers.text(numberSelectedCount);
                bolaoSubtotal.text(numberSelectedCount == 0 ? 0 : cost.toLocaleString('pt-BR'));

                measureQuality();
            }

            var measureQuality = function(){
                var gamesList = $('.bolaoBuilder .games-list');
                var gamesItems = gamesList.find('.game');
                var bettingsSessionData = JSON.parse(sessionStorage.getItem('bettings'));
                var countGames = bettingsSessionData ? Object.keys(bettingsSessionData).length : 0;
                var total = 0;

                if (countGames > 0){
                    bolaoBuilder.find('.messageProfit').show();
                }
                else {
                    bolaoBuilder.find('.messageProfit').hide();
                    bolaoBuilder.find('.cotasCt').text("0");
                }

                gamesItems.each(function(index,value){
                    var $this = $(this);
                    if (countGames > 0){
                        var numbersSelected = $this.find('.costGame b').text();
                        var countNumbers = numbersSelected.length > 0 ? numbersSelected.split(',').length : null;
                    }
                    
                    var cost = $this.find('.costGame b').data('cost');

                    total += cost;
                });

                if (total >= 45.00){
                    bolaoBuilder.find('.finishButton .btn-submit').removeClass('disabled');
                    stepFinalize.attr('href', stepFinalize.attr('data-href'));
                }
                else {
                    bolaoBuilder.find('.finishButton .btn-submit').addClass('disabled', 'disabled');
                    stepFinalize.removeAttr('href');
                }

                //Remove bolao
                bolaoBuilder.find(".qtGames").text('(' + countGames + ')');
                var removeBolaoTg = bolaoBuilder.find(".removeBolao");
                removeBolaoTg.off('click').on('click', function(){
                    removeBolao($(this));
                });
            };

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

                if (Object.keys(bettingsSessionData).length > 0){
                    //Re-order the array
                    $.each(bettingsSessionData, function(index, value){                        
                        bettingsSessionDataNew[i++] = value;
                    });
                }

                sessionStorage.setItem('bettings', JSON.stringify(bettingsSessionDataNew));

                buildGamesList();
                handleAlert(bolaoBuilder.find('.listBets'), "Aposta removida com sucesso", 'default', 'success'); 
                measureQuality();
            }

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
                    if (! $this.hasClass('chosen')){
                        addNumberFunction($this);
                    }
                }
            }

            bolaoBuilder.find('.numberPicker .number').on('click', selectNumber);

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
                    handleAlert(bolaoBuilder.find('.listBets'), "Aposta adicionada com sucesso", 'default', 'success'); 
                    measureQuality();
                    cleanBolao.click();
                }
            });

            //Remove All
            removeAllBoloes.on('click', function(){
                var gameList = $('.bolaoBuilder .games-list tbody');

                sessionStorage.setItem('bettings', JSON.stringify({}));

                buildGamesList();
                handleAlert(bolaoBuilder.find('.listBets'), "Apostas removidas com sucesso", 'default', 'success'); 
                measureQuality();
            })

            var setGuessNumbersConfigs = function(){
                // var dropdownGuessNumbers = bolaoBuilder.find('.guessNumber .dropdown-menu');
                var min = bolaoBuilder.data('minnumber');
                var max = bolaoBuilder.data('maxnumber');

                // for(var i = min; i <= max; i++){
                //     dropdownGuessNumbers.append('<li><a class="dropdown-item px-2 py-2 ps-6" data-value="' + i + '">' + i + ' números</a></li>');
                // };

                var generateNumbers = function(numbersToGuess){
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
                            generatedNumbers.push(randomN);
                        }
                    }

                    return generatedNumbers;
                }

                //Guess a random number
                guessNumber.find('.dropdown-menu li a').on('click', function(){
                    var generatedNumbers = generateNumbers($(this).data('value'));

                    $.each(generatedNumbers, function(index, val){
                        var randomSelected = numbersToSelectCt.find('.number_' + val);
                        addNumberFunction(randomSelected);
                    });


                    measureQuality();
                });
                
                generateNumbersCt.find('.btGenerate').on('click', $.debounce(500, true, function(){
                    var $this = $(this);
                    $this.attr('disabled', 'disabled');
                    var numberDozens = generateNumbersCt.find('.numbersDozens option:selected').val();
                    var qtGames = generateNumbersCt.find('.slQtGames option:selected').val();

                    for(var i = 1; i <= qtGames; i++){
                        var generatedNumbers = generateNumbers(numberDozens);
                        
                        $.each(generatedNumbers, function(index, val){
                            var randomSelected = numbersToSelectCt.find('.number_' + val);
                            addNumberFunction(randomSelected);
                        });
                        
                        addBolao.click();
                    }

                    $([document.documentElement, document.body]).animate({
                        scrollTop: $(".listBets").offset().top
                    }, 200);

                    setTimeout(function(){
                        $this.removeAttr('disabled');
                    }, 500);
                }));
            };

            var initFunctions = function(){
                $(document).on('ready', function(){
                    measureQuality();
                    setGuessNumbersConfigs();
                });
            }();
        }
    }();
});