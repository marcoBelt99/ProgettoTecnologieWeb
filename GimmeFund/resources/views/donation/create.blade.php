@extends('layouts.app')

@section('content')

<div class="container card col-md-6">
    <div class="card-header">
        <p class="card-title"><h1>Dona</h1></p>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ URL::action('DonationController@store') }}" method="POST">
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
                </div>
            </div>
            
            <p>Seleziona il metodo di pagamento</p>
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
                
                <div id="payment-method-form"> 
                    {{-- Form di pagamento --}}
                </div>
            
            </div>

            {{-- hidden fields --}}
            
            {{-- _token --}}
            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
            
            {{-- fundraiser id --}}
            <input type="hidden" name="fundraiser_id" id="fundraiser_id" value="{{ $fundraiser_id }}"/>
            
            {{-- user id --}}
            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
            
            {{-- date --}}
            <input type="hidden" name="date" id="date" value="{{ date('Y-m-d') }}">

            <div class="col-md-6" style="margin-top: 10px">
                {{-- <button type="submit" class="btn btn-outline-primary" id="submit-btn">
                    Dona
                </button> --}}
                <a href="" class="btn btn-outline-primary" id="submit-btn">
                    Dona
                </a>
                <a href="{{ URL::action('FundraiserController@index') }}" class="btn btn-outline-secondary">Indietro</a>
            </div>
        </form>
    </div>
</div>
<div class="container col-md-6" style="margin-top: 30px">
<h3>Le donazioni più recenti</h3>
</div>

{{-- Tabella delle donazioni effettuate dagli utenti --}}
<div class="container col-md-6" style="margin-top: 20px">

    <table class="table table-responsive.table-striped.table-bordered.table-hover" id="donations-table">
        {{-- Intestazione tabella --}}
        <thead class="thead-dark">
            <tr>
                <th scope="col">Nominativo</th>
                <th scope="col">Ha donato</th>
                <th scope="col">In data</th>
            </tr>
        </thead>
        {{-- Corpo tabella --}}
        <tbody>
            @foreach ($donations as $donation)
                <tr>
                    <td>{{ $donators[$donation->id]->first_name }} {{ $donators[$donation->id]->last_name }}</td>
                    <td>{{ $donation->amount }} €</td>
                    <td>{{ date('d/m/Y', strtotime($donation->date)) }}</td>
                </tr>
            @endforeach
            
        </tbody>
    </table>

</div>

@endsection

{{-- Gestione di un'entita in J-Query Ajax --}}
@section('script')

<script type="text/javascript">

    // Messaggi inizialmente nascosti
    $('#warning-message').hide();

    $('input[type=radio]').on('click', function() {
        $('#unchosen-payment-method-mess').hide();
    });

    $(document).ready(function() {

        /* All'evento "click sul pulsante": 'Dona', aggiungi nella tabella di id #donations-table i dati */
        /* Per questo stesso evento, avviene la validazioni dei dati inseriti  */
        $('#submit-btn').on('click', function(e) {
            
            e.preventDefault();
            
            /* Controllo che sia stato scelta una delle due opzioni del checkbox */
            if (!($('input[type=radio]').is(':checked'))) {
                $('#unchosen-payment-method-mess').text('Scegli il metodo di pagamento per proseguire');
                return false;
            }
            
            /* Variabili che ci servono */
            var amount = $('#amount').val();
            var _token = $('#_token').val();
            var user_id = $('#user_id').val();
            var fundraiser_id = $('#fundraiser_id').val();
            var date = $('#date').val();
            
            $.ajax({
                url: '/donation', 
                type: 'POST', // (Stiamo facendo la STORE)
                dataType: "json", // Dati da passare in formato json:
                data: { 
                    'amount': amount,
                    '_token': _token,
                    'user_id': user_id,
                    'fundraiser_id': fundraiser_id,
                    'date': date
                },
                // In caso di successo:
                success: function(data) {                        
                    if (data.status === 'success') {
                        var newColDonatorName = $('<td/>', { text: data.donator_first_name + " " + data.donator_last_name});
                        var newColAmount = $('<td/>', { text: data.donation.amount + " €" });
                        var newColDate = $('<td/>', { text: data.date });
                        // Aggiungo la riga ritornata dalla chiamata Ajax
                        var newRow = $('<tr/>').append(newColDonatorName).append(newColAmount).append(newColDate);
                        // Alcune prove su console:
                        $('#donations-table').prepend(newRow); // Ricorda: inserire gli id negli elementi HTML!!
                        //console.log(newRow);
                        //console.log("Hai donato!");
                    }
                }, 
                // In caso di errore
                // xhr è .....
                error: function(xhr) {
                    // 
                    if (xhr.status == 422) {
                        $('#warning-message').text(xhr.responseJSON.errors.amount).show();
                        console.log(xhr.responseJSON.errors.amount);
                        // alert(xhr.responseJSON.errors.amount);
                        //alert(xhr.responseText);
                    }
                }
            });
        }); // fine evento: "click sul pulsante 'Dona' "

        // Quanto l'utente sceglie il metodo di pagamento compare il form per quel dato metodo
        var html = "\
        <div class='container card col-md-10'>\
            <div class='card-header bg-transparent'>\
                <p class='card-title'><h5>Pagamento con Bonifico Bancario</h5></p>\
            </div>\
            <div class='card-body'>\
                <div class='form-group'>\
                    <label for='holder'>Titolare del conto</label>\
                    <input type='text' id='holder' name='holder' class='form-control'>\
                </div>\
                <div class='form-group'>\
                    <label for='bank-account-id'>IBAN</label>\
                    <input type='text' id='bank-account-id' name='bank-account-id' class='form-control'>\
                </div>\
                <div class='form-group'>\
                    <label for='beneficiary-name'>Casuale</label>\
                    <input type='text' id='casual' name='causal' class='form-control' value='Donazione raccolta fondi GimmeFund-Italia {{ $fundraiser_title->name }}' readonly>\
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

        $('input[type=radio][name=payment-method][id=radio-bank-transfer]').on('click', function() {
            $('#payment-method-form').html(html);
        });


    }); // fine document ready function

</script>

@endsection