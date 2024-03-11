$(function(){

    function select2()
    {
        var select2 = $('.select2');

        select2.select2();
    }

    function pwstrength()
    {
        var pwstrength = $('.pwstrength');

        pwstrength.pwstrength({
            label: '.pwdstrength-label'
            ,texts: ['muito fraca', 'fraca', 'média ', 'forte', 'muito forte']
        });
    }

    function masks()
    {
        var cpfMask = $('.maskCpf');
        var cnpjMask = $('.maskCnpj');
        var phoneMask = $('.maskPhone');
        var maskDate = $('.maskDate');
        var maskMoney = $('.maskMoney');

        cpfMask.mask('000.000.000-00');
        cnpjMask.mask('00.000.000/0000-00');
        maskDate.mask('00/00/0000');

        var SPMaskBehavior = function (val) {
                return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
            },
            spOptions = {
                onKeyPress: function(val, e, field, options) {
                    field.mask(SPMaskBehavior.apply({}, arguments), options);
                }
            };

        phoneMask.mask(SPMaskBehavior, spOptions);
        maskMoney.maskMoney({
            decimal: ','
            ,thousands: '.'
        });

        //Trigger mask money from set values
        maskMoney.each(function(){
            var $this = $(this);
            if ($this.val() > 0){
                $this.maskMoney('mask', $this.val());
            }
        });
    }

    function datepicker()
    {
        var datepicker = $('.datepicker');

        datepicker.datepicker({
            format: 'dd/mm/yyyy'
        });
    }

    var handleAlert = function(target, message, type){
        if (type == undefined || ! type ){
            type = 'warning';
        }

        var alert = target.find('.alert');
        alert.removeClass('hide');

        alert.html(message).addClass('alert-' + type);
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
            var numbersToSelectCt = bolaoBuilder.find('.numbersToSelectCt');
            var statsCt = bolaoBuilder.find('.statsCt');
            var dozenNumbers = statsCt.find('.dozensNumber');
            var bolaoSubtotal = statsCt.find('.bolaoSubtotal');
            var costs = bolaoBuilder.data('costs');

            var updateSelectedDozens = function(){
                var numberSelected = numbersToSelectCt.find('.chosen').length;
                var cost = numberSelected < minNumber ? costs[minNumber] : costs[numberSelected];

                dozenNumbers.text(numberSelected);
                bolaoSubtotal.text(cost.toLocaleString().replace(',', '.'));

                measureQuality();
            }

            var measureQuality = function(){
                var gamesList = $('.bolaoBuilder .games-list');
                var bolaoGrade = bolaoBuilder.find('.progress-bar-level');
                var gamesItems = gamesList.find('tbody tr');
                var countGames = gamesItems.length;
                var total = 0;
                var bolaoMessages = {
                    diversifyNumbers: 'Varie suas dezenas, tente encontrar um equilibrio entre números baixos, médios e altos',
                    moreDozens: 'Escolha mais dezenas, quanto mais números você selecionar maior serão suas chances',
                    moreBets: 'Faça mais apostas, aumentando assim a sua probabilidade de ser premiado'
                };
                var textGrade = 'Nível 1 (Regular)';

                gamesItems.each(function(index,value){
                    var $this = $(this);
                    var numbersSelected = $this.find('td').eq(1).text();
                    var countNumbers = numbersSelected.length > 0 ? numbersSelected.split(',').length : null;
                    total += parseInt($this.find('td').eq(3).text());

                    if (bolaoMessages.moreDozens && countNumbers > minNumber){
                        bolaoMessages.moreDozens = null;
                    }
                });

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
                    textGrade = 'Nível 3 (Excelente)';
                    
                    for(var i = 0; i <= 1; i++){
                        bolaoGrade.find('.starsCt').append(iconStar.clone());
                    }

                    bolaoMessages.diversifyNumbers = null;
                    bolaoMessages.moreBets = null;
                }
                else if (total >= 100){
                    bolaoGrade.addClass('level2');
                    textGrade = 'Nível 2 (Ótimo)';

                    bolaoGrade.find('.starsCt').append(iconStar.clone());
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
                removeBolaoTg.on('click', function(){
                    var $this = $(this);
                    var trCt = $this.parents('tr');
                    var csrf = bolaoBuilder.find('input[name="_token"]').val();
                    var formData = { '_token': csrf, numbers: [], removeId: trCt.data('id') };
    
                    $.ajax({
                        url: bolaoBuilder.find('.games-list').data('url'),
                        dataType: 'json',
                        type: 'POST',
                        data: formData,
                        beforeSend: function(e){
                            $this.find('.alert').html('').addClass('hide');
    
                            addBolao.prop("disabled",true);
                            setTimeout(function(){
                                addBolao.prop('disabled', false);
                            }, 1000);
                        }
                    })
                    .done(function(response){
                        if (response.error != undefined && response.error === 0){
                            handleAlert(bolaoBuilder, response.message, 'success');
    
                            trCt.remove();
                            measureQuality();
                        }
                        else {
                            handleAlert(bolaoBuilder, response.message);
                        }
                    })
                    .fail(function(response){
                        response = response.responseJSON;
    
                        handleAlert(bolaoBuilder, response.message);
                    });
                });
            };measureQuality();

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

            //Guess a random number
            guessNumber.on('click', function(){
                var randomN = Math.random() * (bolaoBuilder.data('biggestnumber') - 1) + 1;
                randomN = Math.round(randomN);
                
                var randomSelected = numbersToSelectCt.find('.number_' + randomN);
    
                if (randomSelected.length > 0 && numbersToSelectCt.find('.chosen').length < maxNumber){
                    addNumberFunction(randomSelected);
                }
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

            //Add bolao
            addBolao.on('click', function(){
                var $this = $(this);
                var min = parseInt(Object.keys(costs)[0]);
                var max = parseInt(Object.keys(costs).pop());
                var dozensNumberVal = parseInt(dozenNumbers.text());
                var csrf = bolaoBuilder.find('input[name="_token"]').val();
                var formData = { '_token': csrf, numbers: []};
               
                if (dozensNumberVal >= min && dozensNumberVal <= max){
                    numbersToSelectCt.find('.chosen').each(function(index, value){
                        var $this = $(this);

                        formData.numbers.push($this.data('number'));
                    });

                    $.ajax({
                        url: bolaoBuilder.data('url'),
                        dataType: 'json',
                        type: 'POST',
                        data: formData,
                        beforeSend: function(e){
                            $this.find('.alert').html('').addClass('hide');
    
                            addBolao.prop("disabled",true);
                            setTimeout(function(){
                                addBolao.prop('disabled', false);
                            }, 1000);
                        }
                    })
                    .done(function(response){
                        if (response.error != undefined && response.error === 0){
                            handleAlert(bolaoBuilder, response.message, 'success'); 
                            var gamesList = bolaoBuilder.find('.games-list tbody');
                            var deleteAction = $('<a class="table-link danger removeBolao"><span class="fa-stack"><i class="fa fa-square fa-stack-2x"></i><i class="fas fa-trash fa-stack-1x fa-inverse"></i></span></a>');

                            gamesList.html('');
                            $.each(response.obj, function(index, value){
                                var countNumbers = value.numbers.length > 0 ? value.numbers.split(',').length : null;
                                var deleteActon
                                var $line = $('<tr><td>' + value.id + '</td><td>' + value.numbers + '</td><td>' + countNumbers + '</td><td>' + value.cost + '</td><td>' + deleteAction.clone().prop('outerHTML') + '</tr>')
                                gamesList.append($line);
                            });

                            measureQuality();
                        }
                        else {
                            handleAlert(bolaoBuilder, response.message);
                        }
                    })
                    .fail(function(response){
                        response = response.responseJSON;
    
                        handleAlert(bolaoBuilder, response.message);
                    });
                }
            });
        }
    }

    var ckeditor = $( '.ckeditor' );
    if (ckeditor.length > 0){
        ClassicEditor
            .create( ckeditor[0] )
            .catch( error => {
                console.error( error );
            } );
    }

    select2();
    pwstrength();
    masks();
    datepicker();
    bolaoBuilder();
});