@extends('layouts.app')
{{-- @author Davide --}}
@section('content')

<div class="container-fluid formsostienici col-md-7 py-5">
    <div class="card card-home">
        <div class="card-header">
            <p class="card-title"><h1>Sostieni GimmeFund con una piccola donazione</h1></p>
        </div>
        <div class="card-body">

            <form>
                {{ method_field('POST') }}

                <div id="warning-container col-md-12">
                    <div class="alert alert-danger text-center" id="warning-message">
                    </div>
                </div>

                <div class="form-group">
                    <label for="amount">Importo</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">€</span>
                        </div>
                        <input type="text" class="form-control text-center" name="amount" id="amount">
                        <small style='color: #ff0000' id='amount-err-mex'>  </small>
                    </div>
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
                        {{-- Form di pagamento --}}
                    </div>
                
                </div>
                {{-- bottone dona --}}
                <div class="col-md-6" style="margin-top: 20px">
                    <a href="#" class="btn btn-outline-primary" id="submit-btn">
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
    $('#warning-message').hide();
    $('small').hide();

    $(document).ready(function() {

        // Quanto l'utente sceglie il metodo di pagamento compare il form per quel dato metodo
        var duration = 300; // Durata animazione toggle
        var chosen_method = '';
        var html_ba_method = "\
        <div class='container card col-md-10'>\
            <div class='card-header bg-transparent'>\
                <p class='card-title'><h5>Pagamento con Bonifico Bancario</h5></p>\
            </div>\
            <div class='card-body'>\
                <div class='form-group'>\
                    <label for='holder'>Titolare del conto</label>\
                    <input type='text' class='form-control'>\
                    <small style='color: #ff0000; ' id='holder-err-mex'>  </small>\
                </div>\
                <div class='form-group'>\
                    <label for='bank-account-id'>IBAN</label>\
                    <input type='text' class='form-control'>\
                    <small style='color: #ff0000' id='iban-err-mex'>  </small>\
                </div>\
                <div class='form-group'>\
                    <label for='beneficiary-name'>Causale</label>\
                    <input type='text' id='' name='' class='form-control' value='Donazione a GimmeFund-Italia' readonly>\
                </div>\
                <div class='form-group'>\
                    <label for='beneficiary-name'>Beneficiario</label>\
                    <input type='text' id='' name='' class='form-control' value='GimmeFund-Italy' readonly>\
                </div>\
                <div class='form-group'>\
                    <label for='beneficiary-ba-id'>IBAN Beneficiario</label>\
                    <input type='text' id='' name='' class='form-control' value='IT66C010050338 2000000218020' readonly>\
                </div>\
            </div>\
        </div>";

        var html_cc_method = 
        "<div class='container card col-md-10'>\
            <div class='card-header bg-transparent'>\
                <p class='card-title'><h5>Pagamento con Carta Prepagata/Carta di Credito</h5></p>\
            </div>\
            <div class='card-body'>\
                <div class='form-group'>\
                    <label for='cc-number'>Numero di carta</label>\
                    <input type='text' class='form-control'>\
                    <small style='color: #ff0000' id='ccnum-err-mex'>  </small>\
                </div>\
                <div class='row'>\
                    <div class='form-group col-6'>\
                        <label for='exp-date'>Scadenza</label>\
                        <input type='text' class='form-control'>\
                        <small style='color: #ff0000' id='expdate-err-mex'>  </small>\
                    </div>\
                    <div class='form-group col-6'>\
                        <label for='cvv-code'>CVV</label>\
                        <input type='text' class='form-control'>\
                        <small style='color: #ff0000' id='cvv-err-mex'>  </small>\
                    </div>\
                </div>\
            </div>\
        </div>";    

        // Nasconde l'eventule messaggio se l'utente sceglie il metodo di pagamento
        $('input[type=radio]').click(function() {
            $('#unchosen-payment-method-mess').hide();
        });
        
        $('input[type=radio][name=payment-method][id=radio-bank-transfer]').change(function() {
            $('#payment-method-form').slideUp(duration, function() { 
                $('#payment-method-form').slideDown(duration).html(html_ba_method);
            });
            chosen_method = "ba";
        });
        
        $('input[type=radio][name=payment-method][id=radio-credit-card]').change(function() {
            $('#payment-method-form').slideUp(duration, function() { 
                $('#payment-method-form').slideDown(duration).html(html_cc_method);
            });
            chosen_method = "cc";
        });
    
    });

    $('#submit-btn').on('click', function(e) {
            
        e.preventDefault();
        
        /* Controllo che sia stato scelta una delle due opzioni del checkbox */
        var amount = $('#amount').val();
        
        if (amount.length <= 0) {
            $('#amount-err-mex').text('Errore').show();
            return false;
        }
        
        
        if (!($('input[type=radio]').is(':checked'))) {
            $('#unchosen-payment-method-mess').text('Scegli il metodo di pagamento per proseguire').show();
            return false;
        }
    });


</script>

@endsection

