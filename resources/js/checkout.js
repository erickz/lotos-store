$(window).load(function(){
    var paymentForm = $('#paymentForm');
    if (paymentForm.length > 0){
        var card = new Card({
            // a selector or DOM element for the form where users will
            // be entering their information
            form: '#paymentForm', // *required*
            // a selector or DOM element for the container
            // where you want the card to appear
            container: '.card-wrapper', // *required*
        
            formSelectors: {
                // numberInput: 'input#number', // optional — default input[name="number"]
                // expiryInput: 'input#expiry', // optional — default input[name="expiry"]
                // cvcInput: 'input#cvc', // optional — default input[name="cvc"]
                // nameInput: 'input#name' // optional - defaults input[name="name"]
            },
        
            width: 250,
            formatting: true, // optional - default true
        
            // Strings for translation - optional
            messages: {
                validDate: 'valid\ndate', // optional - default 'valid\nthru'
                monthYear: 'mês/ano', // optional - default 'month/year'
            },
        
            // Default placeholders for rendered fields - optional
            placeholders: {
                number: '•••• •••• •••• ••••',
                name: 'Nome Sobrenome',
                expiry: '••/••',
                cvc: '•••'
            },
        
            masks: {
                cardNumber: '•' // optional - mask card number
            },
        
            // if true, will log helpful messages for setting up Card
            debug: false // optional - default false
        });

        var publicKey = null;
        if (checkoutSessionId !== undefined && checkoutSessionId){
            var publicKey = checkoutSessionId;
        }

        paymentForm.find('.cardNumber').on('blur', function(){
            var $this = $(this);

            if ($this.is('.mastercard')){
                $this.data('cardBrand', 'mastercard');
            }
            else if ($this.is('.visa')){
                $this.data('cardBrand', 'visa');
            }
            else if ($this.is('.visaelectron')){
                $this.data('cardBrand', 'visaelectron');
            }
            else if ($this.is('.elo')){
                $this.data('cardBrand', 'elo');
            }
            else if ($this.is('.maestro')){
                $this.data('cardBrand', 'maestro');
            }
            else if ($this.is('.amex')){
                $this.data('cardBrand', 'amex');
            }
            else if ($this.is('.discover')){
                $this.data('cardBrand', 'discover');
            }
            else if ($this.is('.unionpay')){
                $this.data('cardBrand', 'unionpay');
            }
            else if ($this.is('.dinersclub')){
                $this.data('cardBrand', 'dinersclub');
            }
            else if ($this.is('.hipercard')){
                $this.data('cardBrand', 'hipercard');
            }
            else if ($this.is('.troy')){
                $this.data('cardBrand', 'troy');
            }
            else if ($this.is('.dankort')){
                $this.data('cardBrand', 'dankort');
            }
            else if ($this.is('.jcb')){
                $this.data('cardBrand', 'jcb');
            }

            var brandName = $this.data('cardBrand');
            var activeLogo = paymentForm.find('.jp-card-front .jp-card-logo.active');
            if (activeLogo.length > 0){
                activeLogo.removeClass('active');
            }

            if ($this.is('.jp-card-valid')){
                paymentForm.find('.jp-card-front').addClass('active');
                paymentForm.find('.jp-card-back').addClass('active');
            }
            else {
                paymentForm.find('.jp-card-front').removeClass('active');
                paymentForm.find('.jp-card-back').removeClass('active');
            }

            var targetBrand = paymentForm.find('.jp-card-front .jp-card-' + brandName);
            if (! targetBrand.is('active')){
                targetBrand.addClass('active');
            }
        });

        paymentForm.find('.btnSubmitForm').on('click', function(e){
            e.preventDefault();

            var cardNumber = paymentForm.find('.cardNumber').val().replace(/\s+/g, '');
            var cardBrand = paymentForm.find('.cardNumber').data('cardBrand');
            var cardCcv = paymentForm.find(".cardCcv").val();
            var cardHolder = paymentForm.find(".cardFullname").val();
            var cardExpiration = paymentForm.find('.cardExpiration').val();
            var cardExpAr = cardExpiration.split('/');

            var alert = paymentForm.find('.alert');

            alert.html('');
            // if (! cardBrand){
            //     if(! alert.is('.alert-info')){
            //         alert.addClass('alert-info');
            //     }

            //     alert.html('<i class="fa fa-exclamation-triangle text-white me-2"></i> Cartão de crédito não identificado.');
            // }
            if (cardCcv && cardExpiration && publicKey){

                var encryptedCard = PagSeguro.encryptCard({
                    publicKey: publicKey,
                    holder: cardHolder,
                    number: cardNumber,
                    expMonth: cardExpAr[0].replace(' ', ''),
                    expYear: cardExpAr[1].replace(' ', ''),
                    securityCode: cardCcv
                });

                if(encryptedCard.hasErrors){
                    if(! alert.is('.alert-warning')){
                        alert.addClass('alert-warning');
                    }
    
                    alert.html('<i class="fa fa-exclamation-triangle text-white me-2"></i> Os dados do cartão são inválidos.');
                }
                else {
                    var inputCardToken = "<input type='hidden' name='cardToken' value='" + encryptedCard.encryptedCard + "' />";
                    paymentForm.prepend(inputCardToken);

                    paymentForm.trigger('submit');
                }
            }
            else {                        
                if(! alert.is('.alert-warning')){
                    alert.addClass('alert-warning');
                }

                alert.html('<i class="fa fa-exclamation-triangle text-white me-2"></i> Preencha todos os campos.');
            }
        });
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

        target.find('.alert').html( chosenIcon + ' ' + message + '' + closeBt).removeClass('d-none').addClass('alert-' + type);
    }

    var bolaoCart = $('.bolaoCart');
    var cartListing = $(".cartListing");
    if (bolaoCart.length > 0){
        bolaoCart.find('.removeFromCart').on('click', function(){
            var token = bolaoCart.data('token');
            var $this = $(this);

            $.ajax({
                url: $this.data('url'),
                type: 'POST',
                data: {
                    _token: token,
                    reserveId: $this.data('id')
                },
                beforeSend: function(e){}
            })
            .done(function(response){
                if (response.error == 0){
                    handleAlert($this.parents('.cartListing'), response.message, 'success');
                }
                else {
                    handleAlert($this.parents('.cartListing'), response.message, 'warning');   
                }

                $this.parents('tr').remove();
            })
            .fail(function(response){
                handleAlert($this.parents('.cartListing'), response.message, 'warning');
            });
        });

        bolaoCart.find('.updateBolaoQuantity').on('change', function(){
            var token = bolaoCart.data('token');
            var $this = $(this);
            var selectedVal = $this.find('option:selected').val();

            $.ajax({
                url: $this.data('url'),
                type: 'POST',
                data: {
                    _token: token,
                    reserveId: $this.data('id'),
                    selectedVal: selectedVal
                },
                beforeSend: function(e){}
            })
            .done(function(response){
                if (response.error == 0){
                    handleAlert($this.parents('.cartListing'), response.message, 'success');
                }
                else {
                    handleAlert($this.parents('.cartListing'), response.message, 'warning');   
                }

                var priceCart = $this.parents('tr').find('.priceCart');
                var pricePerCota = priceCart.data('price');
                var newTotal = pricePerCota * selectedVal;
                var oldTotal = priceCart.data('total');
                var totalToPayCt = cartListing.find('.totalToPay');

                priceCart.html("<b>R$" + (new Intl.NumberFormat('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2}).format(newTotal)) + "</b>");

                if (oldTotal > newTotal){
                    var diffTotal = oldTotal - newTotal;
                    var orderTotal = totalToPayCt.data('total') - diffTotal;
                    totalToPayCt.html("<b>R$" + (new Intl.NumberFormat('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2}).format(orderTotal)) + "</b>");
                }
                else {
                    var diffTotal = newTotal - oldTotal;
                    var orderTotal = totalToPayCt.data('total') + diffTotal;
                    totalToPayCt.html("<b>R$" + (new Intl.NumberFormat('pt-BR', {minimumFractionDigits: 2, maximumFractionDigits: 2}).format(orderTotal)) + "</b>");
                }

                priceCart.data('total', newTotal);
                totalToPayCt.data('total', orderTotal);
            })
            .fail(function(response){
                handleAlert($this.parents('.cartListing'), response.message, 'warning');
            });
        });
    }

    var tgPaymentWay = $('#tgPaymentWay');
    if(tgPaymentWay.length > 0){
        tgPaymentWay.find('.togglePaymentMethod').on('click', function(index, val){
            var $this = $(this);
            var target = $this.data('target');

            // tgPaymentWay.find('.chosePaymentWay').animate({opacity: '0'}, 100);
            // tgPaymentWay.find('.chosePaymentWay').hide(200);
            
            tgPaymentWay.find('.showPayment').fadeOut(100);

            //tgPaymentWay.find('.' + target).animate({opacity: '1 !important'}, 100);
            tgPaymentWay.find('.' + target).addClass('showPayment').fadeIn(300);

            tgPaymentWay.find('.btn.active').removeClass('active');

            if(target == 'tgCreditCard'){
                $([document.documentElement, document.body]).animate({
                    scrollTop: tgPaymentWay.find('.' + target).offset().top - 100,
                }, 200);
            }

            $this.addClass("active");
        });
    }

    var copyPixCode = $('#copyPixCode');
    const unsecuredCopyToClipboard = (text) => { const textArea = document.createElement("textarea"); textArea.value=text; document.body.appendChild(textArea); textArea.select(); try{document.execCommand('copy')}catch(err){console.error('Unable to copy to clipboard',err)}document.body.removeChild(textArea);alert('Código PIX copiado!');};

    if (copyPixCode.length > 0){
        copyPixCode.on('click', function(){
            if (window.isSecureContext && navigator.clipboard) {
                navigator.clipboard.writeText(copyPixCode.data('code')).then(function () {
                    alert('Código PIX copiado!')
                });
            } 
            else {
                unsecuredCopyToClipboard(copyPixCode.data('code'));
            }
        });
    }
});