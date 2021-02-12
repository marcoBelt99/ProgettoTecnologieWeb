@extends('layouts.app')

@section('content')
{{-- Metto il jumbotron per vedere le raccolte fondi. Scorro ogni raccolta fondi con il foreach  --}}
    @foreach ($fundraisers as $fundraiser)
    <div class="container">
        <div class="jumbotron">
             <h1 class="display-4">{{ $fundraiser->name }}</h1>
                <p class="lead">{{ $fundraiser->description }}</p>
                    <hr class="my-4">
                {{-- Faccio alcune queries con eloquent  --}}
                <p>Termina il {{ date('d/m/Y', strtotime($fundraiser->ending_date)) }}</p>
                <p>Raccolti: € {{ number_format($donations[$fundraiser->id], 2, ',', '.') }}</p>
                <p>Obiettivo: € {{ number_format($fundraiser->goal, 2, '.', ',') }}</p>
                <p class="lead">
                    {{-- Sistemo il bottone, il quale linka ad una pagina di informazioni --}}
                    <a href="{{ URL::action('FundraiserController@show', $fundraiser->id) }}"><button type="button" class="btn btn-primary btn-lg">Altre informazioni</button></a>
                </p>
                    
                    {{-- (Marco)Provo ad inserire la progressbar --}}
                    {{-- $contatore = DB::table('') --}}
                    {{-- Fine prova progress bar --}}


        </div>
    </div>
    @endforeach
@endsection
            
@section('script')
    {{-- Primo componente di prova di Vue.js  --}}
    <div class="content" id="app">
        <div class="title m-b-md">
            Laravel
        </div>
        {{-- Richiamo il componente di prova definito nella pagina del template --}}
        <example-component></example-component>
    </div>
    {{-- Includo il file script di prova di Vue.js --}}
    <script src="js/app.js"></script>
@endsection
