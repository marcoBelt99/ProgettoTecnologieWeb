@extends('layouts.app')
{{-- Pagina che serve per inserire le statistiche sull'andamento delle campagne fondi, delle donazioni --}}

@section('content')
    
    <div class="container py-4">
        <div class="row">

            <div class="container-fluid col-3" style="margin-top: 120px; position: absolute; left: 10px;">
                <h5><a name="fast-nav" style="color: #000000">Menù dei grafici</h5>
                <ul style="list-style-type: none;">
                    <li>
                        <a href="#donations-per-date">Donazioni per intervallo di date</a>
                    </li>
                    <li>
                        <a href="#three-categories-chart">Raccolte fondi per categoria</a>
                    </li>
                </ul>
            </div>

            <div class="container col-11">
                <h1 class="font-bold p-3 mb-5">Analytics</h1>
                <div class="card shadow p-3 mb-5 bg-white rounded">
                    <div class="card-body">
                        <h4><a name="donations-per-date" style="color: #0B7CDE" href="#fast-nav">#</a> Donazioni per intervallo di date</h4>
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
                            {{-- HIDDEN FORM FIELD --}}
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
                        <div class="card border-none">
                            <div class="row py-4">
                                <canvas id="totDonPerDate" class="col-md-12">
                                    <!-- GRAPH GOES HERE -->
                                </canvas>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Grafico delle tre categorie --}}
                <div class="card shadow p-3 mb-5 bg-white rounded">
                    <div class="card-body">
                        <h4><a name="three-categories-chart" style="color: #0B7CDE" href="#fast-nav">#</a> Raccolte Fondi per categorie</h4>
                        <form action="" method="POST" id="category-form">
                            <p class="text">Seleziona tre categorie</p>
                            <div class="row">
                                <div class="form-group col">
                                    <p>1° Categoria</p>
                                    <select class="form-control" id="first-category-id" name="first-category-id">
                                        <option selected>--- Seleziona la categoria ---</option>
                                        @foreach ($donationCategories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <p>2° Categoria</p>
                                    <select class="form-control" id="second-category-id" name="second-category-id">
                                        <option selected>--- Seleziona la categoria ---</option>
                                        @foreach ($donationCategories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col">
                                    <p>3° Categoria</p>
                                    <select class="form-control" id="third-category-id" name="third-category-id">
                                        <option selected>--- Seleziona la categoria ---</option>
                                        @foreach ($donationCategories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group text-right" style="margin-top: 40px;">
                                    <button class="btn btn-primary" id="form-update-btn" name="form-update-btn" type="button">AGGIORNA</button>
                                </div>
                            </div>

                            {{-- token --}}
                            <input type="hidden" name="_token_3cat_form" id="_token_3cat_form" value="{{ csrf_token() }}">
                        </form>

                        <canvas id="threeCategoriesCharts">
                            <!-- GRAPH GOES HERE -->
                        </canvas>

                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    
    <script type="text/javascript">
        
        /**
         * @author @EnricoBreg
         */
        $(document).ready(function() {

            var ctx1 = $('#donAmountPerDate');
            var ctx2 = $('#totDonPerDate');
            var ctx3 = $('#threeCategoriesCharts');

            var chart1, chart2, chart3;
            
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
                            },
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            }
                        }
                    });
                },
                // Error on AJAX request
                error: function (xhr) {
                    console.log("ERRORE");
                    /* console.log(xhr); */
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
                        // Only for debugging purposes
                        /* console.log(status); */
                        /* console.log(newChartsData); */

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
                        /* console.log(newChartsData); */

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

            // CHIAMATA AJAX PER POPOLARE IL GRAFICO DELLE TRE CATEGORIE
            var first_category_id, second_category_id, third_category_id;
            var _token_3cat_form = $('#_token_3cat_form').val();

            $.ajax({
                url: '/admin/analytics/getThreeCatChartsData',
                method: 'POST',
                dataType: 'json',
                data: {
                    '_token': _token_3cat_form
                },
                success: function(chartData, status) {
                    // Only for debugging purposes
                    console.log(status);
                    console.log(chartData);

                    // Aggiornamento valori select boxes
                    $('#first-category-id').val(chartData.secondCategory.id).change();
                    $('#second-category-id').val(chartData.secondCategory.id).change();
                    $('#third-category-id').val(chartData.thirdCategory.id).change();

                    // Drawing new chart (pie chart)
                    chart3 = new Chart(ctx3, {
                        // chart type
                        type: 'pie',
                        // chart data
                        data: {
                            labels: [
                                chartData.firstCategory.name.name, 
                                chartData.secondCategory.name.name, 
                                chartData.thirdCategory.name.name,
                                chartData.remaingCatFund.name
                            ],    
                            datasets: [{
                                label: 'Numero di campagne fondi per categoria',
                                
                                backgroundColor: [
                                    'rgba(13, 250, 167, 0.5)', 
                                    'rgba(11, 222, 208, 0.5)', 
                                    'rgba(00, 198, 245, 0.5)',
                                    'rbga(255, 255, 255, 0.5)'
                                ],
                                borderColor: [
                                    'rgba(13, 250, 167, 0.5)', 
                                    'rgba(11, 222, 208, 0.5)', 
                                    'rgba(0, 198, 245, 0.5)',
                                    'rbga(255, 255, 255, 0.5)'
                                ],
                                hoverBackgroundColor: [
                                    'rgba(13.0, 250.0, 167.0, 1.0)', 
                                    'rgba(11, 222, 208, 1.0)', 
                                    'rgba(0, 198, 245, 1.0)',
                                    'rbga(255, 255, 255, 1.0)'
                                ],    
                                data: [
                                    chartData.firstCategory.fundNumber, 
                                    chartData.secondCategory.fundNumber, 
                                    chartData.thirdCategory.fundNumber,
                                    chartData.remaingCatFund.fundNumber]
                            }]
                        },
                        // chart options
                        options: {
                            // Legenda
                            legend: {
                                display: true,
                                position: 'right',
                                labels: {
                                    fontColor: '#222222'
                                }
                            },
                            // Responsive
                            responsive: true,
                            // Titolo
                            title: {
                                display: true,
                                fontSize: 26,
                                position: 'top',
                                text: 'Numeri di raccolte fondi per categoria'
                            }
                        }

                    });
                },
                error: function (xhr) {
                    /* console.log(xhr); */
                    alert("Error on AJAX POST request");
                }
            });
            
            var first_category_id, second_category_id, third_category_id;

            first_category_id  = $('#first-category-id').val();
            second_category_id = $('#second-category-id').val();
            third_category_id  = $('#third-category-id').val();

            /* console.log(first_category_id);
            console.log(second_category_id);
            console.log(third_category_id); */


            // Inizio evento on click per le cateorie
            $('#form-update-btn').on('click', function(e) {
                e.preventDefault();

                first_category_id  = $('#first-category-id').val();
                second_category_id = $('#second-category-id').val();
                third_category_id  = $('#third-category-id').val();
                /* _token_3cat_form = $('#_token_3cat_form').val(); */
                
                // Only for debugging purposes
                /* console.log(first_category_id);
                console.log(second_category_id);
                console.log(third_category_id); */

                $.ajax({
                    url: '/admin/analytics/getThreeCatChartsData',
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        'first_category_id': first_category_id,
                        'second_category_id': second_category_id,
                        'third_category_id': third_category_id,
                        '_token': _token_3cat_form
                    },
                    success: function(newChartData, status) {

                        // Only for debugging purposes
                        /* console.log(newChartData);
                        console.log(newChartData.firstCategory);
                        console.log(newChartData.secondCategory);
                        console.log(newChartData.thirdCategory); */

                        // Aggiornamento labels
                        chart3.data.labels[0] = newChartData.firstCategory.name.name;
                        chart3.data.labels[1] = newChartData.secondCategory.name.name;
                        chart3.data.labels[2] = newChartData.thirdCategory.name.name;
                        chart3.data.labels[3] = newChartData.remaingCatFund.name;

                        // Aggiornamento asseY
                        chart3.data.datasets[0].data[0] = newChartData.firstCategory.fundNumber;
                        chart3.data.datasets[0].data[1] = newChartData.secondCategory.fundNumber;
                        chart3.data.datasets[0].data[2] = newChartData.thirdCategory.fundNumber;
                        chart3.data.datasets[0].data[3] = newChartData.remaingCatFund.fundNumber;

                        chart3.update();
                    },
                    error: function (xhr) {
                        console.log(xhr);
                    }
                });
            });
        }); // FINE EVENTO DOCUMENT READY
        
    </script>

@endsection