@extends('layouts.app')

@section('content')

<div class="container-fluid col-8 py-4">
    <div class="card card-home">
        <div class="card-header">
            <p class="card-title"><h1>Sostieni GimmeFund con una donazione</h1></p>
        </div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <small id="important-advice" style='color: #ff0000' id='iban-err-mess'>ATTENZIONE! Le donazioni a GimmeFund-Italia non comportano la generazione di punti</small>
                </div>

                <div class="alert alert-success" role="alert" id="alert-container">
                    <h4 class="alert-heading" id="alert-title">
                        <!-- Il testo va qui -->
                    </h4>
                    <p id="alert-text">
                        <!-- Il testo va qui -->
                    </p>
                </div>

                <div class="form-group">
                    <label for="amount">Importo</label>
                    <div class="input-group col-mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">€</span>
                        </div>
                        <input type="text" class="form-control text-center" name="amount" id="amount" placeholder="1.00">
                    </div>
                    <small style='color: #ff0000' id='amount-err-mex'>  </small>
                </div>
                
                <p>Seleziona il metodo di pagamento:</p>
                <div class="form-check">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="radio-bank-transfer" name="payment-method">
                        <label class="form-check-label">
                            Bonifico bancario
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" id="radio-credit-card" name="payment-method">
                        <label class="form-check-label">
                            Carta di credito
                        </label>
                    </div>
                    <small style="color: #ff0000" id="unchosen-payment-method-mess">
                        {{-- Messaggio per l'utente se non sceglie il metodo di pagamento --}}
                    </small>
                    
                    <div id="payment-method-form" style="margin-top: 50px; margin-bottom: 50px;"> 
                        {{-- Il form di pagamento --}}
                    </div>
                </div>

                {{-- hidden fields --}}

                <div class="col-md-6" style="margin-top: 20px">
                    <a href="" class="btn btn-success btn-rounded px-3 my-0 d-none d-lg-inline-block" id="submit-btn" onclick="jump('alert-container')">
                        Dona
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

{{-- Gestione di un'entita in J-Query Ajax --}}
@section('script')

<script type="text/javascript">

    // Messaggi inizialmente nascosti
    $('#alert-container').toggle(false);
    $('#warning-message').hide();
    $('small').hide();
    $('#important-advice').show();

    $(document).ready(function() {

        $('#amount').on('click', function () {
            $('#amount-err-mex').hide();
        });

        // Quanto l'utente sceglie il metodo di pagamento compare il form per quel dato metodo
        var duration = 300; // Durata animazione toggle
        var chosenMethod;
        var htmlBaMethod = "\
        <div class='container card col-md-10'>\
            <div class='card-header bg-transparent'>\
                <p class='card-title'><h5>Pagamento con Bonifico Bancario</h5></p>\
            </div>\
            <div class='card-body'>\
                <div class='form-group'>\
                    <label for='holder'>Titolare del conto</label>\
                    <input type='text' id='ba-holder' name='ba-holder' class='form-control'>\
                    <small style='color: #ff0000; ' id='ba-holder-err-mess'>  </small>\
                </div>\
                <div class='form-group'>\
                    <label for='bank-account-id'>IBAN</label>\
                    <input type='text' id='bank-account-id' name='bank-account-id' class='form-control'>\
                    <small style='color: #ff0000' id='iban-err-mess'>  </small>\
                </div>\
                <div class='form-group'>\
                    <label for='beneficiary-name'>Causale</label>\
                    <input type='text' id='causal' name='causal' class='form-control' value='Donazione a GimmeFund-Italia' readonly>\
                </div>\
                <div class='form-group'>\
                    <label for='beneficiary-name'>Beneficiario</label>\
                    <input type='text' id='beneficiary-name' name='beneficiary-name' class='form-control' value='GimmeFund-Italy' readonly>\
                </div>\
                <div class='form-group'>\
                    <label for='beneficiary-ba-id'>IBAN Beneficiario</label>\
                    <input type='text' id='beneficiary-ba-id' name='beneficiary-ba-id' class='form-control' value='IT66C010050338 2000000218020' readonly>\
                </div>\
            </div>\
        </div>";

        var htmlCcMethod = "\
        <div class='container card col-md-10'>\
            <div class='card-header bg-transparent'>\
                <p class='card-title'><h5>Pagamento con Carta Prepagata/Carta di Credito</h5></p>\
            </div>\
            <div class='card-body'>\
                <div class='form-group'>\
                    <label for='cc-number'>Numero di carta</label>\
                    <input type='text' id='cc-number' name='cc-number' class='form-control'>\
                    <small style='color: #ff0000' id='ccnum-err-mess'>  </small>\
                </div>\
                <div class='row'>\
                    <div class='form-group col-6'>\
                        <label for='exp-date'>Scadenza</label>\
                        <input type='text' class='form-control' id='exp-cc-date' name='exp-cc-date' maxlength='5' placeholder='mm/aa'>\
                        <small style='color: #ff0000' id='exp-cc-date-err-mess'>  </small>\
                    </div>\
                    <div class='form-group col-6'>\
                        <label for='cvv-code'>CVV</label>\
                        <input type='text' id='cvv-code' name='cvv-code' class='form-control' maxlength='3' placeholder='123'>\
                        <small style='color: #ff0000' id='cvv-err-mess'>  </small>\
                    </div>\
                </div>\
            </div>\
        </div>";    

        // Nasconde l'eventule messaggio se l'utente sceglie il metodo di pagamento
        $('input[type=radio]').click(function() {
            $('#unchosen-payment-method-mess').hide();
        });
        
        /* 
         * slideUp del form di pagamento per bonifico bancario, sostituzione del contenuto e slideDown, 
         * aggiornamento variabile per il metodo di pagamento scelto 
         */
        $('input[type=radio][name=payment-method][id=radio-bank-transfer]').change(function() {
            $('#payment-method-form').slideUp(duration, function() { 
                $('#payment-method-form').slideDown(duration).html(htmlBaMethod);
            });
            chosenMethod = "ba";
        });

        /* 
         * slideUp del form di pagamento per carta di credito, sostituzione del contenuto e slideDown, 
         * aggiornamento variabile per il metodo di pagamento scelto 
         */
        $('input[type=radio][name=payment-method][id=radio-credit-card]').change(function() {
            $('#payment-method-form').slideUp(duration, function() { 
                $('#payment-method-form').slideDown(duration).html(htmlCcMethod);
            });
            chosenMethod = "cc";
        });

        // ======================================= AJAX ======================================= //
        /* All'evento "click sul pulsante": 'Dona', aggiungi nella tabella di id #donations-table i dati */
        /* Per questo stesso evento, avviene la validazioni dei dati inseriti  */
        $('#submit-btn').on('click', function(e) {
            
            e.preventDefault();
            
            var amount = $('#amount').val();
            if (amount <= 0) {
                $('#amount-err-mex').text('Inserisci un importo valido').show();
            }


            /* Controllo che sia stato scelta una delle due opzioni del checkbox */
            if (!($('input[type=radio]').is(':checked'))) {
                $('#unchosen-payment-method-mess').text('Scegli il metodo di pagamento per proseguire').show();
                return false;
            }
            
            /** @author Breg  */
            // +-------------------------------------------------------------------------------------------+
            // |                                                                                           |
            // |                               VALIDAZIONE FORM DI PAGAMENTO                               |
            // |                                                                                           |
            // +-------------------------------------------------------------------------------------------+
            
            // Prendo i dati dei vari campi del form di pagamento e li controllo
            var baHolder = $('#ba-holder').val();
            var baId = $('#bank-account-id').val();
            var ccNumber = $('#cc-number').val();
            var expCcDate = $('#exp-cc-date').val();
            var cvvCode = $('#cvv-code').val();

            // Controllo che tipo di metodo di pagamento sta usando l'utente
            if (chosenMethod == 'ba') { // Bonifico bancario
                if ((baHolder.length == 0) || (baId.length == 0)) { // Errore form di pagamento
                    // Controllo cosa ha causato l'errore
                    if (baHolder.length == 0) {
                        $('#ba-holder-err-mess').text('Manca l\'interstatario del Conto Corrente').show();
                    }
                    if (baId.length == 0) {
                        $('#iban-err-mess').text('Manca l\'IBAN del conto corrente').show();
                    }
                    return false; // Se mi trovo qui vuol dire che avevo trovato un errore
                }
            }

            // Controllo che tipo di metodo di pagamento sta usando l'utente
            if (chosenMethod == 'cc') { // Carta di credito
                if ((ccNumber.length == 0) || (expCcDate.length == 0) || (cvvCode.length == 0)) { // Errore form di pagamento
                    // Controllo cosa ha causato l'errore
                    if (ccNumber.length == 0) {
                        $('#ccnum-err-mess').text('Manca il numero della Carta di Credito').show();
                    }
                    if (expCcDate.length == 0) {
                        $('#exp-cc-date-err-mess').text('Manca la data di scadenza').show();
                    }
                    if (cvvCode.length == 0) {
                        $('#cvv-err-mess').text('Manca il codice CVV/CVC').show();
                    }
                    return false; // Se mi trovo qui vuol dire che avevo trovato un errore
                }
            }

            $('#amount').val('');
            // Avviso l'utente dell'effettiva donazione
            $('#alert-title').text('Grazie per aver donato!');
            $('#alert-text').text('La tua donazione è stata registrata con successo. ');
            $('#alert-text').append('GimmeFund ti ringrazia!');
            $('#alert-container').show();

            // +-------------------------------------------------------------------------------------------+
            // |                                                                                           |
            // |                          FINE VALIDAZIONE FORM DI PAGAMENTO                               |
            // |                                                                                           |
            // +-------------------------------------------------------------------------------------------+
            
        }); // fine evento: "click sul pulsante 'Dona' "

    }); // fine document ready function

   /** 
    *   @author 'Marco' 
    *   @param 'h' id di quanto saltare
    *   Salta all'id 'h' grazie al calcolo di un offset che salvo in 'top'
    *   In questo caso, la userò per saltare all'alter-container per vedere il risultato della donazione.
    *   All'evento click sul bottone (link) di nome 'Dona' sarà attivata questa funzione
    */
    function jump(h){
        var top = document.getElementById(h).offsetTop;
        window.scrollTo(0, top);
    }

</script>

@endsection