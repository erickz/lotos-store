$(window).load(function(){
    //AJAX REQUESTS
    let formAjax = $(".form-ajax");
    if (formAjax.length > 0) {

        //To accept multiple ajax form in one page
        formAjax.each(function(index, value){
            let $this = $(this);
            let url = $this.attr('data-url');
            let redirect = $this.attr('redirect') ? $this.attr('redirect') : 0;
            let btnSend = $this.find('.btn-send');
            let clearForm = $this.attr('data-clear') ? $this.attr('data-clear') == 'true' : true;

            if (btnSend.length > 0) {

                btnSend.on("click", function(e){
                    e.preventDefault();

                    var dataForm = $this.serializeArray();
                    dataForm._token = $('meta[name="csrf-token"]').attr('content');

                    $.ajax({
                        url: url,
                        dataType: 'json',
                        type: 'POST',
                        data: dataForm,
                        beforeSend: function(e){
                            $this.find('.alert').html('').addClass('d-none');
                            
                            //clean up messages
                            $this.find('.form-group').each(function(index, value){
                                var thisFormGroup = $(this);
                                var inputCt = thisFormGroup.children(":first");
        
                                inputCt.removeClass('was-validated');
                                thisFormGroup.find('.invalid-feedback').remove();
                            });

                            btnSend.prop("disabled", true);
                        }
                    })
                    .done(function(response){
                        btnSend.prop('disabled', false);

                        if (response.error != undefined && response.error === 0){
                            var inputTxt = $this.find('input,textarea');

                            if (clearForm){
                                inputTxt.each(function(index, value){
                                    var $this2 = $(this);
                                    $this2.val('');
                                    $this2.text('');
                                });
                            }

                            if (redirect == 1){
                                window.location = response.message;
                            }
                            else {
                                handleAlert($this, response.message, 'success'); 
                            }
                        }
                        else {
                            handleAlert($this, response.message);
                        }
                    })
                    .fail(function(response){
                        btnSend.prop("disabled", true);

                        response = response.responseJSON;
                        var errors = response.errors;

                        handleAlert($this, response.message);

                        $.each(response.errors, function(index, value){
                            var inputTarget = $this.find('input[name=' + index + '],textarea[name=' + index + ']');

                            if (inputTarget.length > 0){
                                handleErrorsForm(inputTarget.parent(), value);
                            }
                        });

                        setTimeout(function(){
                            btnSend.prop('disabled', false);
                        }, 1000);
                    });
                })
            }
        });
    }

    var handleErrorsForm = function(ctInput, message){
        ctInput.addClass('was-validated').find('.invalid-feedback').remove();
        var divFeedback = $('<div class="invalid-feedback d-block"></div>');
        var fieldName = ctInput.text().replace(':', '');

        if ( message == undefined ||  ! message || message.length === 0){
            message = 'O campo ' + fieldName + ' é obrigatório'
        }

        divFeedback.text(message);
        ctInput.append(divFeedback);
    }

    var handleAlert = function(target, message, type, disableClose){
        var warningIcon = '<svg xmlns="http://www.w3.org/2000/svg" fill="#FFF" viewBox="0 0 16 16" width="16" height="16"><path d="M6.457 1.047c.659-1.234 2.427-1.234 3.086 0l6.082 11.378A1.75 1.75 0 0 1 14.082 15H1.918a1.75 1.75 0 0 1-1.543-2.575Zm1.763.707a.25.25 0 0 0-.44 0L1.698 13.132a.25.25 0 0 0 .22.368h12.164a.25.25 0 0 0 .22-.368Zm.53 3.996v2.5a.75.75 0 0 1-1.5 0v-2.5a.75.75 0 0 1 1.5 0ZM9 11a1 1 0 1 1-2 0 1 1 0 0 1 2 0Z"></path></svg>';
        var successIcon = '<svg xmlns="http://www.w3.org/2000/svg" fill="#FFF" viewBox="0 0 16 16" width="16" height="16"><path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8Zm1.5 0a6.5 6.5 0 1 0 13 0 6.5 6.5 0 0 0-13 0Zm10.28-1.72-4.5 4.5a.75.75 0 0 1-1.06 0l-2-2a.751.751 0 0 1 .018-1.042.751.751 0 0 1 1.042-.018l1.47 1.47 3.97-3.97a.751.751 0 0 1 1.042.018.751.751 0 0 1 .018 1.042Z"></path></svg>';
        var chosenIcon = (type == 'success' ? successIcon : warningIcon);
        var closeBt = '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';

        if (type == undefined || ! type ){
            type = 'warning';
        }

        if (disableClose != undefined && disableClose ){
            closeBt = '';
        }

        target.find('.alert').html( chosenIcon + ' ' + message + '' + closeBt).removeClass('d-none').removeClass('alert-warning').addClass('alert-' + type);
    }

    var buyHolderEvent = function(){
        var slHolder = $('.slHolder');
        if(slHolder != undefined && slHolder && slHolder.length > 0){
            slHolder.find("select").on('change', function(){
                var $this = $(this);
                var intVal = parseInt($this.val());
                var slHolderParent = $this.parents('tr');

                if (! $this.is('.isFromTable')){
                    slHolderParent = $this.parent().parent().parent();
                }

                var currentBtnBuyCotas = slHolderParent.find('.btnBuyCota');

                if (intVal > 0){
                    currentBtnBuyCotas.removeAttr('data-cotas');
                    currentBtnBuyCotas.data('cotas', intVal);

                    if (currentBtnBuyCotas.hasClass('disabled')){
                        currentBtnBuyCotas.removeClass('disabled');
                    }
                }
                else {
                    if (! currentBtnBuyCotas.hasClass('disabled')){
                        currentBtnBuyCotas.addClass('disabled');
                    }
                }

                var calculateTotal = slHolderParent.find('.calculateTotal');

                if (calculateTotal != undefined && calculateTotal.length > 0){
                    var totalPrice = $this.val() * parseFloat(calculateTotal.data('price'));
                    var creditsUserCt = calculateTotal.parent().parent().find('.creditsUser');
                    var creditsUser = creditsUserCt.data('value');
                    var totalPriceFormatted = (new Intl.NumberFormat('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2}).format(totalPrice));                    
                    var classColorText = '';

                    if (creditsUserCt.length > 0 && creditsUser < totalPrice){
                        classColorText = '';
                    }

                    calculateTotal.html('<span class="' +  classColorText + '">R$' + totalPriceFormatted + '</span>');
                }
            });
        }
    };buyHolderEvent();

    var updateCartTooltip = function(cartItemsQt){
        var cart = $(".cart-section");
        var labelNotification = cart.find('.topbar-item .labelNotifications');
        
        if (labelNotification != undefined && labelNotification.length > 0){
            labelNotification.text(cartItemsQt);
        }
        else {
            labelNotification = $("<label class='label label-danger labelNotifications'>" + cartItemsQt + "</label>");
            cart.find('.topbar-item').prepend(labelNotification);
        }
    };

    var buyBolaoDirect = function(){
        var btnBuyBolao = $('.btnBuyCota');

        btnBuyBolao.on('click', $.debounce(500, true, function(){
            var $this = $(this);
            var csrf = $this.parents('form').find('input[name="_token"]').val();
            var formData = { '_token': csrf, cotas: $this.data('cotas')};
            var bolaoUrl = $this.data('url');


            if (bolaoUrl){
                //Ajax which retrieve the games
                $.ajax({
                    url: bolaoUrl,
                    type: 'POST',
                    data: formData,
                    beforeSend: function(e){}
                })
                .done(function(response){
                    if (response.error == 0){
                        handleAlert($this.parents('.bt-containers'), response.message, 'success', 'success');

                        if (btnBuyBolao.is('.resetBuy')){
                            $this.parent().find('.slChooseCotas option:selected').removeAttr('selected');
                            $this.parent().find('.slChooseCotas').trigger('change');
                        }
                        else {
                            btnBuyBolao.addClass('disabled');
                        }

                        var resetSelect = $('.resetSelect');
                        resetSelect.find('option:selected').removeAttr('selected');

                        updateCartTooltip(response.cartItemsQt);

                        if($this.is('.btnConfirmation')){
                            $this.parent().find('.btn').show();
                            $this.hide();
                        }
                    }
                    else {
                        handleAlert($this.parents('.bt-containers'), response.message, 'warning', 'warning');   
                    }
                })
                .fail(function(response){
                    var response = response.responseJSON;
                    handleAlert($this.parents('.bt-containers'), response.message, 'warning', 'warning');
                });
            }
        }));
    };

    var printBtEvent = function(){
        var printButton = $('.printButton');
        if(printButton != undefined && printButton && printButton.length > 0){
            printButton.on('click',function(){
                $('#bolaoInfosModal').printArea();
            });
        }
    };

    var manageDonateOfCotas = function(){
        var inviteCotasCt = $('#inviteCotasCt');
        var inviteCotasForm = $('#inviteCotasForm');

        if(inviteCotasCt != undefined && inviteCotasCt && inviteCotasCt.length > 0){
            var checkboxToPay = inviteCotasForm.find('.checkboxToPay');
            var lblPrice = inviteCotasForm.find('.lblPrice');
            var tableInvites = $('#tableInvites');

            checkboxToPay.on('change', function(){
                var $this = $(this);
                
                if ($this.is(':checked')){
                    lblPrice.removeClass('label-light');

                    if (! lblPrice.hasClass('label-warning')){
                        lblPrice.addClass('label-warning')
                    }
                }
                else {
                    lblPrice.removeClass('label-warning');

                    if (! lblPrice.hasClass('label-light')){
                        lblPrice.addClass('label-light')
                    }
                }
            });

            var updateTableOfCotas = function(){
                $.ajax({
                    url: tableInvites.data('url'),
                    type: 'GET',
                    beforeSend: function(e){}
                })
                .done(function(response){
                    if(response.data != undefined && response.data.length > 0){
                        tableInvites.find('tbody').text('');

                        $.each(response.data, function(index, val){
                            var tr = "<tr><td>" + val.email + "</td><td>" + val.status + "</td><td>" + val.cotas + "</td></tr>";
                            tableInvites.find('tbody').append(tr);    
                        });
                    }
                    else {
                        tableInvites.find('tbody').append("<tr><td colspan='3'><div class='alert alert-light ms-0 mb-0'><i class='fas fa-info-circle me-2 text-primary'></i> Nenhum convite enviado!</div></td></tr>");
                    }
                })
                .fail(function(response){});
            };updateTableOfCotas();

            let btnSend = inviteCotasForm.find('.btn-send');
            btnSend.on("click", function(e){
                e.preventDefault();
                inviteCotasForm.find('input[name="_token"]').val($('meta[name="csrf-token"]').attr('content'));

                var dataForm = inviteCotasForm.serializeArray();

                $.ajax({
                    url: inviteCotasForm.data('url'),
                    dataType: 'json',
                    type: 'POST',
                    data: dataForm,
                    beforeSend: function(e){
                        btnSend.prop("disabled", true);

                        inviteCotasForm.find('.alert').html('').addClass('d-none');
                        
                        //clean up messages
                        inviteCotasForm.find('.form-group').each(function(index, value){
                            var thisFormGroup = $(this);
                            var inputCt = thisFormGroup.children(":first");
    
                            inputCt.removeClass('was-validated');
                            thisFormGroup.find('.invalid-feedback').remove();
                        });
                    }
                })
                .done(function(response){
                    btnSend.prop('disabled', false);

                    if (response.error != undefined && response.error === 0){
                        handleAlert(inviteCotasForm, response.message, 'success'); 
                    }
                    else {
                        handleAlert(inviteCotasForm, response.message);
                    }

                    var inputTxt = inviteCotasForm.find('input,textarea');

                    inputTxt.each(function(index, value){
                        var inviteCotasForm2 = $(this);
                        inviteCotasForm2.val('');
                        inviteCotasForm2.text('');
                    });

                    updateTableOfCotas();
                })
                .fail(function(response){
                    response = response.responseJSON;
                    var errors = response.errors;

                    handleAlert(inviteCotasForm, response.message);

                    if (response.errors && response.errors.length){
                        $.each(response.errors, function(index, value){
                            var inputTarget = inviteCotasForm.find('input[name=' + index + '],textarea[name=' + index + ']');

                            if (inputTarget && inputTarget.length > 0){
                                handleErrorsForm(inputTarget.parent(), value);
                            }
                        });
                    }

                    setTimeout(function(){
                        btnSend.prop('disabled', false);
                    }, 1000);
                });
            });           
        }
    };

    var getBolaoInfosModalAjax = function(){
        var bolaoInfosModal = $('#bolaoInfosModal');
        bolaoInfosModal.on('show.bs.modal', function(e){

            var buttonEl = $(e.relatedTarget);
            var bolaoUrl = buttonEl.data('gamesurl');

            if (bolaoUrl){
                //Ajax which retrieve the games
                $.ajax({
                    url: bolaoUrl,
                    type: 'GET',
                    beforeSend: function(e){}
                })
                .done(function(response){
                    if (buttonEl.data('id') != undefined && buttonEl.data('id') > 0){
                        //Insert the bolao_id into the query strings
                        var url = new URL(window.location.href);
                        url.searchParams.set('bolao_id', buttonEl.data('id'));
                        window.history.replaceState(null, null, url);   
                    }

                    bolaoInfosModal.find('.ajax-content').html(response);

                    buyHolderEvent();
                    buyBolaoDirect();
                    printBtEvent();
                    manageDonateOfCotas();
                })
                .fail(function(response){});
            }
        });

        bolaoInfosModal.on('hide.bs.modal', function(e){
            setTimeout(function(){
                var defaultModalContent = "<div class='card card-custom gutter-b example example-compact'><div class='container pe-4 ps-4'><div class='mt-8 text-center '><img src='/img/loading.gif') }}' width='30' /></div></div></div>";
                const url = new URL(window.location.href);

                if (url.searchParams.has('bolao_id')){
                    //Clean the bolao_id from the query strings
                    url.searchParams.delete('bolao_id');
                    window.history.replaceState(null, null, url);
                }

                bolaoInfosModal.find('.modal-content').html(defaultModalContent);
            }, 500);
        });
    }();
    
    var openBolaoFromQueryString = function(){
        const url = new URL(window.location.href);
    
        if (url.searchParams.has('bolao_id')){
            $('.gamesTrigger.bolao_' + url.searchParams.get('bolao_id')).click();
        }
    }();

    var tgSellPanel = function(){
        var tgSellPanel = $("#tgOpenSellBolao");

        if(tgSellPanel.length > 0){
            var sellPanel = $('#sellPanel');

            var handleSellPanel = function(){
                if(tgSellPanel.find('input').is(":checked")){
                    sellPanel.show();
                }
                else {
                    sellPanel.hide();
                }
            };
            handleSellPanel();

            tgSellPanel.find('input').on('change', handleSellPanel)
        }
    };

    var getBolaoSuggestionModalAjax = function(){
        var bolaoSuggestionModal = $('#bolaoSuggestionModal');
        bolaoSuggestionModal.on('show.bs.modal', function(e){

            var buttonEl = $(e.relatedTarget);
            var bolaoUrl = buttonEl.data('url');

            if (bolaoUrl){
                //Ajax which retrieve the games
                $.ajax({
                    url: bolaoUrl,
                    type: 'GET',
                    beforeSend: function(e){}
                })
                .done(function(response){
                    if (buttonEl.data('id') != undefined && buttonEl.data('id') > 0){
                        //Insert the suggestion_ into the query strings
                        var url = new URL(window.location.href);
                        url.searchParams.set('suggestion_', buttonEl.data('id'));
                        window.history.replaceState(null, null, url);   
                    }

                    bolaoSuggestionModal.find('.ajax-content').html(response);

                    tgSellPanel();                    
                })
                .fail(function(response){});
            }
        });

        bolaoSuggestionModal.on('hide.bs.modal', function(e){
            setTimeout(function(){
                var defaultModalContent = "<div class='card card-custom gutter-b example example-compact'><div class='container pe-4 ps-4'><div class='mt-8 text-center '><img src='/img/loading.gif') }}' width='30' /></div></div></div>";
                const url = new URL(window.location.href);

                if (url.searchParams.has('suggestion_')){
                    //Clean the suggestion_ from the query strings
                    url.searchParams.delete('suggestion_');
                    window.history.replaceState(null, null, url);
                }

                bolaoSuggestionModal.find('.modal-content').html(defaultModalContent);
            }, 500);
        });
    }();
    
    var openBolaoSuggestionFromQueryString = function(){
        const url = new URL(window.location.href);
    
        if (url.searchParams.has('suggestion_id')){
            $('.gamesTrigger.suggestion_' + url.searchParams.get('suggestion_id')).click();
        }
    }();

    var allowBuyOnlyWhenSelected = function(){
        var slCts = $('.slHolder .slChooseCotas');

        slCts.each(function(index, val){
            var $this = $(this);
            
            $this.find('');
        });
    }();

    var getBolaoBuyConfirmation = function(){
        var buyConfirmation = $('#buyConfirmationModal');
        buyConfirmation.on('show.bs.modal', function(e){
            var buttonEl = $(e.relatedTarget);
            var qtCotasSelected = null;
            
            if (buttonEl.is('.isFromTable')){
                qtCotasSelected = buttonEl.parents("tr").find('.slChooseCotas option:selected').val();
            }
            else {
                qtCotasSelected = buttonEl.parents("div").find('.slChooseCotas option:selected').val();
            }

            var bolaoUrl = buttonEl.data('gamesurl');

            var handleErrorConfirmationBuy = function(message){
                if (message == undefined || ! message){
                    message = "Não foi possível finalizar a compra";
                }

                buyConfirmation.find('.ajax-content').html('<div class="alert mb-5"></div><div class="text-center mb-5"><i class="fas fa-question"></div>');
                handleAlert(buyConfirmation, message, 'warning');
            }

            if (bolaoUrl){
                //Ajax which retrieve the games
                $.ajax({
                    url: bolaoUrl,
                    type: 'GET',
                    data: {
                        cotas: qtCotasSelected
                    },
                    beforeSend: function(e){}
                })
                .done(function(response){
                    buyConfirmation.find('.ajax-content').html(response);

                    buyBolaoDirect();
                })
                .fail(function(response){
                    handleErrorConfirmationBuy();
                });
            }
        });

        buyConfirmation.on('hide.bs.modal', function(e){
            setTimeout(function(){
                var defaultModalContent = "<div class='card card-custom gutter-b example example-compact'><div class='container pe-4 ps-4'><div class='mt-8 text-center '><img src='/img/loading.gif') }}' width='30' /></div></div></div>";

                buyConfirmation.find('.modal-content').html(defaultModalContent);
            }, 500);
        });
    }();

    var formCredits = $("#formCredits");

    if(formCredits.length > 0){
        var customInputCredits = formCredits.find("#customValueCredits");

        customInputCredits.find('input').on('change', function(){
            var $this = $(this);
            var valueSelected = $this.val();

            customInputCredits.find('.tgForm').data('value', valueSelected);            
        });

        formCredits.find(".tgForm").on('click', function(e){
            e.preventDefault();
            var valueSelected = $(this).data('value');

            if (valueSelected.length > 0){
                var convertedValue = valueSelected.replace('.', '').replace(',', '.');

                if (convertedValue !== undefined && convertedValue && convertedValue >= 20){
                    formCredits.prepend('<input type="hidden" name="credits" value="' + valueSelected + '" />')
                    formCredits.trigger('submit');
                }
                else {
                    handleAlert(formCredits, "Selecione um valor válido", 'primary');
                }
            }
            else {
                handleAlert(formCredits, "Selecione um valor válido", 'primary');
            }
        });
    }

    if($('.gamesList .btnBuyCota')){
        buyBolaoDirect();
    }

    var maskMoney = $('.maskMoney');
    if(maskMoney != undefined && maskMoney && maskMoney.length > 0){
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

    var cpfMask = $('.maskCpf');
    if(cpfMask != undefined && cpfMask && cpfMask.length > 0){
        cpfMask.mask('000.000.000-00');
    } 

    var birthdayMask = $('.maskBirthday');
    if(birthdayMask != undefined && birthdayMask && birthdayMask.length > 0){
        birthdayMask.mask('00/00/0000');
    } 

    var tooltips = $('.tooltips')
    if (tooltips != undefined && tooltips.length > 0){
        tooltips.tooltip();
    }

    var menuMobile = $('.menuMobileTrigger');
    if (menuMobile.length > 0){
        var menuMobileCt = $('.menu-mobile');

        var toggleMobileMenu = function(){
            var body = $('body');
            var menuMobileCt = body.find('.menu-mobile');

            body.toggleClass('menu-mobile-active');
            if(body.is('.menu-mobile-active')){
                body.addClass('bodyShadow');
                menuMobileCt.animate({
                    opacity: 1
                }, 100);
                menuMobileCt.css('display', 'block');
            }
            else {
                body.removeClass('bodyShadow');
                menuMobileCt.animate({
                    opacity: 0
                }, 100, function(){
                    menuMobileCt.css('display', 'none');
                });
            }
        };

        menuMobile.on('click touchstart', $.debounce(500, true, toggleMobileMenu));

        // var modal = $('.modal');
        // $(document).on('click', function(e) 
        // {
        //     // if the target of the click isn't the container nor a descendant of the container
        //     if (!menuMobileCt.is(e.target) && menuMobileCt.has(e.target).length === 0 
        //         && !modal.is(e.target) && modal.has(e.target).length === 0) 
        //     {
        //         $('body').removeClass('menu-mobile-active');
        //         menuMobileCt.animate({
        //             opacity: 0
        //         }, 100, function(){
        //             menuMobileCt.css('display', 'none');
        //         });
        //     }
        // });
    }

    var unveil = $('.unveil');
    if (unveil.length > 0){
        unveil.unveil(300);
    }

    tgSellPanel();

    var tgHolder = $('.tgHolder');

    if(tgHolder && tgHolder.length > 0){
        var switchHolder = tgHolder.find('.switchHolder');
        var howItWorks = $('#howItWorks');

        tgHolder.find('.tgBuyCotas').on('mouseenter', () => {
            var $this = $(this);
            switchHolder.addClass('tgDiagonalAfter');
        }).on('mouseleave', () => {
            var $this = $(this);
            switchHolder.removeClass('tgDiagonalAfter'); 
        }).on('click', () => {
            if(howItWorks.find(".container-bolao").is(':visible')){
                switchHolder.find('input').trigger('click');
            }
        });

        tgHolder.find('.tgCreateBolao').on('mouseenter', () => {
            var $this = $(this);
            switchHolder.addClass('tgDiagonalBefore');
        }).on('mouseleave', () => {
            var $this = $(this);
            switchHolder.removeClass('tgDiagonalBefore'); 
        }).on('click', () => {
            if(howItWorks.find(".container-cotas").is(':visible')){
                switchHolder.find('input').trigger('click');
            }
        });

        switchHolder.find('input').on('change', (e) => {
            var $target = $(e.target);

            if($target.is(':checked')){
                switchHolder.find(".switch").removeClass('switch-info').addClass('switch-primary');
                howItWorks.removeClass('bg-info2').addClass('bg-primary');
                
                howItWorks.find(".container-bolao").hide();
                howItWorks.find(".container-cotas").show();
            }
            else {
                switchHolder.find(".switch").removeClass('switch-primary').addClass('switch-info');
                howItWorks.removeClass('bg-primary').addClass('bg-info2');

                howItWorks.find(".container-bolao").show();
                howItWorks.find(".container-cotas").hide();
            }
        });
    }

    var calculatorProfits = $('.calculatorProfits'); 

    if (calculatorProfits.length > 0){
        var slLotery = calculatorProfits.find('.slLotery');
        var slGames = calculatorProfits.find('.slGames');
        var slPrices = calculatorProfits.find('.slPrices');
        var touchSpin = calculatorProfits.find(".bootstrap-touchspin input");
        var btnAddGame = calculatorProfits.find('.btnAddGame');
        var inputNumberGames = calculatorProfits.find('.inputNumberGames');
        var bolaoGamesList = calculatorProfits.find('.bolaoGamesList');
        var bolaoTotalCost = calculatorProfits.find('.totalCost');
        var bolaoTotalProfit = calculatorProfits.find('.totalProfit');
        var bolaoTotalChances = calculatorProfits.find('.totalChances');
        var nBoloesCreated = calculatorProfits.find('.nBoloesCreated');
        var arCosts = slGames.data('costs');
        var arGamesSelected = [];
        var totalCost = 0;
        var totalProfit = 0;
        var totalRevenue = 0;

        touchSpin.TouchSpin({
            min: 1,
            max: 1000,
            step: 1,
            buttondown_class: 'btn btn-secondary',
            buttonup_class: 'btn btn-secondary'
        });

        var calculateTotalCost = () => {
            totalCost = 0;
            totalChances = 0;
            var applyDiscount = 0.40;
            
            $.each(arGamesSelected, (index, value) => {
                totalCost += (value.cost - (value.cost * applyDiscount)) * value.quantity
                totalChances += value.chances * value.quantity;
            });

            totalCost = totalCost * nBoloesCreated.val();

            console.log(totalChances);

            var totalCostFormatted = new Intl.NumberFormat('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2}).format(totalCost);
            bolaoTotalCost.html('R$' + totalCostFormatted);
            bolaoTotalChances.html('<b>' + totalChances + 'x mais chances de ganhar na Loteria' + '</b>');
        };calculateTotalCost();

        var calculateProfit = () => {
            totalRevenue = 0;

            if (totalCost > 0){
                var priceCota = 7.5;
                var revenue = Math.ceil(totalCost * 3);
                var recomendedCotas = Math.round((revenue / priceCota));
                recomendedCotas = recomendedCotas <= 1 ? 2 : recomendedCotas;

                var revenueTotal = String((priceCota * recomendedCotas));
                //19% do preço da cota
                var taxPlatform = (priceCota * 0.19) * recomendedCotas;
                
                totalProfit = String((revenueTotal - totalCost - taxPlatform));
                totalRevenue = (revenueTotal - taxPlatform);
            }

            var profitFormatted = (new Intl.NumberFormat('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2}).format(totalRevenue));
            bolaoTotalProfit.html('<b>R$' + profitFormatted + '</b>');
        };calculateProfit();

        var resetGames = () => {
            bolaoGamesList.html('');
            arGamesSelected = [];

            calculateTotalCost();
            calculateProfit();
            buildGamesList();
        }

        var bindRemoveGameEvent = () => {
            bolaoGamesList.find('.delete').off('click').on('click', (e) => {
                var $this = $(e.target);
                var currentIndex = $this.parents('li').data('index');
                
                var newArGames = [];
                $.each(arGamesSelected, (index, value) => {
                    if(index != currentIndex){
                        newArGames.push(value);
                    }
                });

                arGamesSelected = newArGames;
                buildGamesList();
            });
        }

        var buildGamesList = () => {
            bolaoGamesList.html('');

            if(arGamesSelected.length <= 0){
                bolaoGamesList.prepend('<ul><li class="display-5 text-warning text-center mt-16 d-flex justify-content-center" style="font-size: 28px;"><b><i class="fas fa-info-circle me-1 fa-1x text-warning"></i>Adicione jogos para simular seus lucros</b></li></ul>')
            }
            else {
                $.each(arGamesSelected, (index, val) => {
                    bolaoGamesList.prepend('<li data-index="' + index + '" class="list-group-item list_' + index + ' d-flex justify-content-between align-items-center"><span>' + val.quantity + ' jogo' + (val.quantity > 1 ? 's' : '') + ' de ' + val.dozens + ' dezenas</span><span label="Apagar" class="delete p-1 px-2 mt-1 me-2 cursor-pointer"><i class="fas fa-times text-danger"></i></span></li>');
                });
                
                bindRemoveGameEvent();
            }

            calculateTotalCost();
            calculateProfit();
        }

        slLotery.on('change', (e) => {
            var arCosts = slGames.data('costs');
            var $this = $(e.target);
            var costsSelectedLotery = arCosts[$this.val()];

            var newOptions = '';
            $.each(costsSelectedLotery, (index, val) => {
                newOptions += '<option data-chances="' + val.chances + '" data-cost="' + val.cost + '" value="' + val.number_matches + '" ' + (index == 1 ? 'selected="selected"' : '') + '>Jogo de ' + val.number_matches + ' dezenas</option>';
            });

            slGames.html(newOptions);
            resetGames();
        }).trigger('change');
        //Add a bet by default

        btnAddGame.on('click', (e) => {
            var dozensSelected = slGames.val();
            var numberGamesSelected = inputNumberGames.val();
            var currentCost = slGames.find('option:selected').data('cost');
            var chances = slGames.find('option:selected').data('chances');

            var newGame = { cost: currentCost, dozens: dozensSelected, quantity: numberGamesSelected, chances: chances };
            arGamesSelected.push(newGame);

            buildGamesList();
        }).trigger('click');
        
        nBoloesCreated.on("change", () => {
            calculateTotalCost();
            calculateProfit();
        });

        //Add another set of default games (the first one is done by triggering the chance event)
        var setDefaultGames = function(){
            var newGame = { cost: 7, dozens: 6, quantity: 1, chances: 1 };

            for(var i = 0; i <= 10; i++){
                arGamesSelected.push(newGame);
            }

            buildGamesList();
        }();
    }

    var select2 = $('.select2');

    if (select2.length > 0){
        select2.select2();
    }
});