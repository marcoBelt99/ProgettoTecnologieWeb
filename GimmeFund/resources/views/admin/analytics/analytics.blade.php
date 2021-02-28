@extends('layouts.app')
{{-- Pagina che serve per inserire le statistiche sull'andamento delle campagne fondi, delle donazioni --}}

@section('content')
    
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading col-2">Chart Demo</div>
                    <div class="col-lg-8">
                        <canvas id="adminChart" width="400" height="400" class="rounded shadow">
                            Il canvas non funziona
                        </canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

@endsection

@section('script')
    
    <script type="text/javascript">
    
    $(document).ready(function () {

        var ctx = $('#adminChart');

        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['{{ key($data) }}'];
                datasets: [{
                    label: '# of votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            option: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
        

    });
    
    </script>

@endsection