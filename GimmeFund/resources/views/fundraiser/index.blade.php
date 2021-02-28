@extends('layouts.app')


@section('content')

<div class="carousel-inner">
    <div class="carousel-item active">
        <img class="d-block img-fluid" src="{{ asset("images/salti2.png") }}" alt="Slide1" width="100%">
        <div class="carousel-caption d-none d-md-block">
            <h2 class="testoOmbreggiato">Su GimmeFund la tua donazione vale il doppio</h2>
        </div>
    </div>
</div>

<div class="text-center py-5">
    <h1>Guarda le raccolte fondi</h1>
    <h3>Persone di tutto il mondo raccolgono fondi per le cause che le appassionano</h3>
</div>
{{-- Metto il jumbotron per vedere le raccolte fondi. Scorro ogni raccolta fondi con il foreach  --}}
@foreach ($fundraisers as $fundraiser)
    
      {{--  --}}
    <div class="container py-2">
        <div class="jumbotron-fundraiser">
            <h1 class="display-4">{{ $fundraiser->name }}</h1>
            <p class="lead">{{ substr($fundraiser->description,0 ,300)}}...</p>
                <hr class="my-4">
            {{-- Faccio alcune queries con eloquent  --}}
            <p>Termina il {{ date('d/m/Y', strtotime($fundraiser->ending_date)) }}</p>
            <p>Raccolti: € {{ number_format($donations[$fundraiser->id], 2, ',', '.') }}</p>
            <p>Obiettivo: € {{ number_format($fundraiser->goal, 2, '.', ',') }}</p>
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