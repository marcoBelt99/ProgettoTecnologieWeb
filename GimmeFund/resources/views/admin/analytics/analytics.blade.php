@extends('layouts.app')
{{-- Pagina che serve per inserire le statistiche sull'andamento delle campagne fondi, delle donazioni --}}

@section('content')
    
    <div class="container py-4">

        <h1 class="font-bold">Statistiche</h1>

        <div class="container">
            <div class="card">
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
            </div>
        </div>


        <div class="row py-4">
            <canvas id="donAmountPerDate" class="col-md-12">
                <!-- GRAPH GOES HERE -->
            </canvas>
        </div>

        <div class="row py-4">
            <canvas id="totDonPerDate" class="col-md-12">
                <!-- GRAPH GOES HERE -->
            </canvas>
        </div>

    </div>

@endsection

@section('script')
    
    <script type="text/javascript">
        
        $(document).ready(function() {

            var ctx1 = $('#donAmountPerDate');
            var ctx2 = $('#totDonPerDate');
            
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

                    var chart1 = new Chart(ctx1, {
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

                    var chart2 = new Chart(ctx2, {
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
                    success: function (newChartData, status) {
                        /* console.log(status);
                        console.log(newChartData); */
                        // MANCA L'AGGIORNAMENTO DEI DATIIIIIIIIIII
                    },
                    error: function (xhr) {
                        console.log(xhr);
                    }
                });

            });
            

            // CHIAMATA AJAX UGUALE A QUELLA SOPRA
            $('#end-date').on('change', function() {
                var startDate = $('#start-date').val();
                var endDate = $('#end-date').val();
                
                if (startDate > endDate) {
                    $('#err-date-selection').text('Intervallo non valido.');
                    return false;
                }

              /*   console.log(startDate);
                console.log(endDate); */
            });


        }); // FINE EVENTO DOCUMENT READY
    
    </script>

@endsection


{{-- <script>
    $(document).ready(function() {
    //chiamate a funzioni
        showGraph1();
        showGraph2();
        showGraph3();
    });
    //definzione del grafico lingue utilizzando dati presi da lingue.php
    function showGraph1() {
        {
            $.post("lingue.php",function(data) {
                console.log(data);
                var LINGUA = [];
                var QUANTITA = [];
                for (var i in data) {
                    LINGUA.push(data[i].LINGUA);
                    QUANTITA.push(data[i].QUANTITA);
                    }
                var chartdata = {
                    labels: LINGUA,
                    datasets: [{
                    backgroundColor:["#FF6384",
                                     "#63FF84",
                                     "#84FF63",
                                     "#8463FF",
                                     "#6384FF",
                                     'rgba(255, 99, 132)',
                                     'rgba(54, 162, 235)',
                                     'rgba(255, 206, 86)',
                                     'rgba(75, 192, 192, 1)',
                                     'rgba(153, 102, 255, 1)'
                                    ],
                    borderColor: 'black',
                    borderWidth: 2,
                    hoverBorderColor: '#666666',
                    data: QUANTITA
                        }]
                    };


                var graphTarget = $("#graphCanvas");

                var barGraph = new Chart(graphTarget, {
                    type: 'pie',
                    data: chartdata
                });
            });
        }
    }
    //definzione del grafico autori utilizzando dati presi da autori.php
    function showGraph2() {
        {
            $.post("autori.php",function(data) {
                    console.log(data);
                    var NOMINATIVO = [];
                    var QUANTITA = [];

                    for (var i in data) {
                        NOMINATIVO.push(data[i].NOMINATIVO);
                        QUANTITA.push(data[i].QUANTITA);
                    }

                    var chartdata2 = {
                        labels: NOMINATIVO,
                        datasets: [{
                            backgroundColor:['rgba(255, 99, 132)',
                                             'rgba(54, 162, 235)',
                                             'rgba(255, 206, 86)',
                                             'rgba(75, 192, 192, 1)',
                                             'rgba(153, 102, 255, 1)',
                                             "#FF6384",
                                             "#63FF84",
                                             "#84FF63",
                                             "#8463FF",
                                             "#6384FF"
                                            ],
                            borderColor: 'black',
                            borderWidth: 2,
                            hoverBorderColor: '##666666',
                            data: QUANTITA
                        }]
                    };

                var graph = $("#Canvas");

                var pieChart = new Chart(graph, {
                    type: 'pie',
                    data: chartdata2
                });
            });
        }
    }


    //definzione del grafico editori utilizzando dati presi da editori.php
    function showGraph3() {
        {
            $.post("editori.php",function(data) {
                console.log(data);
                var NOME_E = [];
                var QUANTITA = [];

                for (var i in data) {
                    NOME_E.push(data[i].NOME_E);
                    QUANTITA.push(data[i].QUANTITA);
                    }

                var chartdata2 = {
                    labels: NOME_E,
                    datasets: [{
                        backgroundColor: [  "#FF6384",
                                            "#63FF84",
                                            "rgba(54, 162, 235)",
                                            "#8463FF",
                                            "#6384FF",
                                            'rgba(255, 99, 132)',
                                            'rgba(255, 206, 86)',
                                            'rgba(75, 192, 192, 1)',
                                            'rgba(153, 102, 255, 1)',
                                            "#84FF63"         
                                        ],
                        borderColor: 'black',
                        borderWidth: 2,
                        hoverBorderColor: 'black',
                        data: QUANTITA
                        }]
                    };

                var graph = $("#GraphCanv");

                var pieChart = new Chart(graph, {
                    type: 'doughnut',
                    data: chartdata2
                    });
            });
        }
    }
</script> --}}