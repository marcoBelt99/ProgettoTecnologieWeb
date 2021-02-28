@extends('layouts.app')
{{-- Pagina che serve per inserire le statistiche sull'andamento delle campagne fondi, delle donazioni --}}

@section('content')
    
    <div class="container py-4">

        <h1 class="font-bold">Statistiche</h1>

        <div class="container">
            <div class="card shadow p-3 mb-5 bg-white rounded">
                <div class="card-body">
                    <form action="" method="POST">
                        <p class="text">
                            Seleziona un intervallo temporale per la visualizzazione dei dati
                        </p>

                        <div class="row">
                            <div class="form-group col">
                                <label for="start-date">Data di inizio</label>
                                <input id="start-date" type="date" class="form-control form-control-sm">                        
                            </div>
                            <div class="form-group col">
                                <label for="end-date">Data di fine</label>
                                <input id="end-date" type="date" class="form-control form-control-sm">                        
                            </div>
                        </div>
                        <small style="color: #ff0000;" id="err-date-selection"> </small>
                        {{-- HIDDEN FORM --}}
                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                    </form>
                </div>
                <div class="container">
                    <div class="row py-4">
                        <canvas id="donAmountPerDate" class="col-md-12">
                            <!-- GRAPH GOES HERE -->
                        </canvas>
                    </div>
                </div>

                <div class="container">
                    <div class="card">
                        <div class="row py-4">
                            <canvas id="totDonPerDate" class="col-md-12">
                                <!-- GRAPH GOES HERE -->
                            </canvas>
                        </div>
                    </div>
                </div>  

            </div>
        </div>
        
    </div>

@endsection

@section('script')
    
    <script type="text/javascript">
        
        $(document).ready(function() {

            var ctx1 = $('#donAmountPerDate');
            var ctx2 = $('#totDonPerDate');

            var chart1, chart2;
            
            $.ajax( {

                url: '/admin/analytics/chartData',
                type: 'GET',
                dataType: 'json',
                // Success on AJAX request
                success: function(data, status) {                    
                    //console.log(data);
                    var dates = [];
                    for(var i = 0; i < data.axisX.length; i++) {
                        dates.push(data.axisX[i].date);
                    }

                    // Cambio valori campi input intervallo predefinito
                    $('#start-date').val(dates[0]); // Prima data
                    $('#end-date').val(dates[dates.length-1]); // Ultima data

                    chart1 = new Chart(ctx1, {
                        // The type of chart we want to create
                        type: 'bar',

                        // The data for our dataset
                        data: {
                            
                            labels: dates,

                            datasets: [{
                                // Per importo di donazioni 
                                label: 'Totale importi in €',
                                backgroundColor: 'rgba(13.0, 250.0, 167.0, 0.4)',
                                borderWidth: 1,
                                borderColor: '#0b7cde',
                                hoverBackgroundColor: '#0b7cde',
                                data: data.axisY,
                            }]
                        },

                        // Configuration options go here
                        options: {
                            title: {
                                display: true,
                                fontSize: 20,
                                text: 'Totale Donazioni per giornate'
                            }
                        }
                    });

                    chart2 = new Chart(ctx2, {
                        // Tipo di grafico
                        type: 'line',

                        // asse X
                        data: {

                            labels: dates, // Asse X
                            datasets: [{
                                label: 'Numero di donazioni per data',
                                backgroundColor: 'rgba(13.0, 250.0, 167.0, 0.4)',
                                borderWidth: 3,
                                borderColor: '#00c6f5',
                                pointBackgroundColor: '#0b7cde',
                                pointBorderWidth: 5,
                                pointBorderColor: '#0b7cde',
                                pointHoverBorderWidth: 20,

                                hoverBackgroundColor: '#0b7cde',


                                pointHoverBorderWidth: 40,
                                data: data.numDonations
                            }]
                        },
                        // Opzioni per il grafico
                        options: {
                            // Configuration options go here
                            responsive: true,
                            title: {
                                display: true,
                                fontSize: 20,
                                text: 'Numero totale di donazioni per giornate'
                            }
                        }
                    });
                },
                // Error on AJAX request
                error: function (xhr) {
                    console.log("ERRORE");
                    console.log(xhr);
                }

            }); // FINE CHIAMATA AJAX
            
            // UPDATE CHARTS DATA
            $('#start-date').on('change', function() {
                var startDate = $('#start-date').val();
                var endDate = $('#end-date').val();
                var _token = $('#_token').val();

                if (startDate > endDate) {
                    $('#err-date-selection').text('Intervallo non valido.');
                    return false;
                }
                
                // console.log('ciao');
                
                $.ajax({
                    url: '/admin/analytics/updateChartsData',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'start_date': startDate,
                        'end_date': endDate,
                        '_token': _token
                    },
                    success: function (newChartsData, status) {
                        /* console.log(status); */
                        console.log(newChartsData);
                        // MANCA L'AGGIORNAMENTO DEI DATIIIIIIIIIII

                        var newDates = [];
                        for(var i = 0; i < newChartsData.axisX.length; i++) {
                            newDates.push(newChartsData.axisX[i].date);
                        }

                        // updating chart 1
                        chart1.data.labels = newDates;
                        chart1.data.datasets[0].data = newChartsData.axisY;
                        chart1.update();
                        // updating chart 2
                        chart2.data.labels = newDates;
                        chart1.data.datasets[0].data = newChartsData.numDonations;
                        chart2.update();
                    },
                    error: function (xhr) {
                        console.log(xhr);
                    }
                });
            }); // FINE UPDATE ON START_DATE CHANGE
            

            // CHIAMATA AJAX UGUALE A QUELLA SOPRA
            $('#end-date').on('change', function() {
                var startDate = $('#start-date').val();
                var endDate = $('#end-date').val();
                var _token = $('#_token').val();

                if (startDate > endDate) {
                    $('#err-date-selection').text('Intervallo non valido. Seleziona un intervallo valido.').show();
                    return false;
                }

                $.ajax({
                    url: '/admin/analytics/updateChartsData',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'start_date': startDate,
                        'end_date': endDate,
                        '_token': _token
                    },
                    success: function (newChartsData, status) {
                        /* console.log(status); */
                        console.log(newChartsData);
                        // MANCA L'AGGIORNAMENTO DEI DATIIIIIIIIIII

                        var newDates = [];
                        for(var i = 0; i < newChartsData.axisX.length; i++) {
                            newDates.push(newChartsData.axisX[i].date);
                        }

                        // updating chart 1
                        chart1.data.labels = newDates;
                        chart1.data.datasets[0].data = newChartsData.axisY;
                        chart1.update();
                        // updating chart 2
                        chart2.data.labels = newDates;
                        chart1.data.datasets[0].data = newChartsData.numDonations;
                        chart2.update();
                    },
                    error: function (xhr) {
                        console.log(xhr);
                    }
                });
            });// FINE UPDATE ON START_DATE CHANGE

            // EVENTI PER NASCONDERE IL MESSAGGIO DI ERRORE
            $('#start-date').on('click', function () {
                $('#err-date-selection').hide();
            });

            $('#end-date').on('click', function () {
                $('#err-date-selection').hide();
                
            });

        }); // FINE EVENTO DOCUMENT READY
    
    </script>

@endsection