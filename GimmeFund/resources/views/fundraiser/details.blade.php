{{-- Pagina dei dettagli della raccolta fondi: link:  --}}
@extends('layouts.app')

@section('content')
    
    <div class="container col-7">
        
        <div class="text text-center py-4">
            <h1>{{ $fundraiser->name }}</h1>
        </div>        
        <div class="card col-12" style="padding: 0px">
            <div class="card-img-top text-center" style="padding: 10px">
                <img src="{{ $fundraiser->media_url }}" class="img-fluid" alt="Image">
            </div>
            <div class="card-header" style="height : 62px">
                <p class="card-title" style="font-size: 25px; text-align: center">Descrizione</p>
            </div>
            <div class="card-body">
                {{ $fundraiser->description }}
                <div class="blockquote-footer" >
                    <p>Creata da: {{ $author->first_name }} {{ $author->last_name }}</p>
            </div>
            </div>
            
        </div>
        
        <div class="py-4">

            {{-- Controllo login utente/ruolo utente --}}
            @if (Auth::check() && Auth::user()->hasRole('user'))
                <a href="{{ URL::action('DonationController@create', $fundraiser->id) }}"><button type="button" class="btn btn-success btn-lg btn-block">Dona ora</button></a>
            @else
                {{-- Se l'utente è loggato ed è admin --}}
                @if (Auth::check() && Auth::user()->hasRole('admin'))
                    <div class="text-center">
                        <p class="">Donazione non autorizzata per l'utente Admin</p>
                    </div>
                @endif

                {{-- Se l'utente non è loggato nel sito --}}
                @if(!Auth::check())
                    <div class="text text-center">
                        <a href="{{ route('login') }}" class=""><p>Accedi o registrati per iniziare a donare!</p></a>
                    </div>
                @endif
            
            @endif
        </div>
    </div>
@endsection