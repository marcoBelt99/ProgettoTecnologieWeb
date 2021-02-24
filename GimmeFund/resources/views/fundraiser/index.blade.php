@extends('layouts.app')


@section('content')
{{-- Prova --}}
<div class="jumbotron card card-image" style="background-image: url(https://mdbootstrap.com/img/Photos/Others/gradient1.jpg);">
    <div class="text-white text-center py-5 px-4">
        <div>
            <h2 class="card-title h1-responsive pt-3 mb-5 font-bold"><strong>Il tuo gesto su GimmeFund vale doppio!</strong></h2>
            <p class="mx-5 mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat fugiat, laboriosam, voluptatem,
            optio vero odio nam sit officia accusamus minus error nisi architecto nulla ipsum dignissimos. Odit sed qui, dolorum!
            </p>
            <a class="btn btn-outline-white btn-md"><i class="fas fa-clone left"></i> View project</a>
        </div>
    </div>
</div>
{{-- Fine prova --}}

{{-- Metto il jumbotron per vedere le raccolte fondi. Scorro ogni raccolta fondi con il foreach  --}}
@foreach ($fundraisers as $fundraiser)
    
      {{--  --}}
    <div class="container">
        <div class="jumbotron-fundraiser">
            <h1 class="display-4">{{ $fundraiser->name }}</h1>
            <p class="lead">{{ substr($fundraiser->description,0 ,300)}}...</p>
                <hr class="my-4">
            {{-- Faccio alcune queries con eloquent  --}}
            <p>Termina il {{ date('d/m/Y', strtotime($fundraiser->ending_date)) }}</p>
            <p>Raccolti: € {{ number_format($donations[$fundraiser->id], 2, ',', '.') }}</p>
            <p>Obiettivo: € {{ number_format($fundraiser->goal, 2, '.', ',') }}</p>
            {{-- <form>
                <input type="number" id="val1">
                <input type="number" id="val2">
                <input type="number" id="val3">
                <input type="button" id="btnOK" value="Crea" onclick="creaAreo()">
            </form> --}}
            {{-- Disegno un cuore per tentare di fare la progress bar --}}
           {{--  <div id="cuore">
                <svg
                  xmlns="http://www.w3.org/2000/svg"
                  version="1.1"
                  x="5px"
                  y="5px"
                  viewBox="0 0 100 100"
                >
                  <path
                    fill-opacity="0"
                    stroke-width="1"
                    stroke="#bbb"
                    d="M81.495,13.923c-11.368-5.261-26.234-0.311-31.489,11.032C44.74,13.612,29.879,8.657,18.511,13.923  C6.402,19.539,0.613,33.883,10.175,50.804c6.792,12.04,18.826,21.111,39.831,37.379c20.993-16.268,33.033-25.344,39.819-37.379  C99.387,33.883,93.598,19.539,81.495,13.923z"
                  />
                  <path
                    id="heart-path"
                    fill-opacity="0"
                    stroke-width="3"
                    stroke="#ED6A5A"
                    d="M81.495,13.923c-11.368-5.261-26.234-0.311-31.489,11.032C44.74,13.612,29.879,8.657,18.511,13.923  C6.402,19.539,0.613,33.883,10.175,50.804c6.792,12.04,18.826,21.111,39.831,37.379c20.993-16.268,33.033-25.344,39.819-37.379  C99.387,33.883,93.598,19.539,81.495,13.923z"
                  />
                  
                </svg>
              </div>
 --}}
    <canvas id="myChart">il canvas non funziona</canvas>

            <p class="lead">
                {{-- Sistemo il bottone, il quale linka ad una pagina di informazioni --}}
                <a href="{{ URL::action('FundraiserController@show', $fundraiser->id) }}">
                    <button type="button" class="btn btn-primary btn-lg">Altre informazioni</button>
                </a>
            </p>
        </div>
    </div>
    @endforeach
    
@endsection

@section('script')
{{-- <script type="text/javascript"> --}}

{{-- /* functionc creaAreo()
    {
        // prende i valori delle caselle di testo 
        valore1 = eval(document.getElementById("val1"));
    } */ --}}
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
        datasets: [{
            label: 'My First dataset',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: [0, 10, 5, 2, 20, 30, 45]
        }]
    },

    // Configuration options go here
    options: {}
});
</script>
@endsection
