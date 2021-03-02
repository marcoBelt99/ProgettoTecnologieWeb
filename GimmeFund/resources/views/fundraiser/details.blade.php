{{-- Pagina dei dettagli della raccolta fondi: link:  --}}
@extends('layouts.app')

@section('content')
    
    <div class="container col-7">
        
        <div class="text text-center py-4">
            <h1>{{ $fundraiser->name }}</h1>
        </div>     
        <div class="card col-12 card-home" style="padding: 0px">
            <div class="card-img-top text-center" style="padding: 10px">
                {{-- Upload immagine da device dell'utente --}}
                <img style="width: 100%" src="{{ Storage::url("{$fundraiser->filename}") }}" alt="{{ $fundraiser->filename }}" />
            </div>
            <div class="card-header" style="height : 62px">
                <p class="card-title" style="font-size: 25px; text-align: center">Descrizione</p>
            </div>
            <div class="card-body">
                {{ $fundraiser->description }}
                <div class="py-4">
                    <p>Termina il {{ date('d/m/Y', strtotime($fundraiser->ending_date)) }}</p>
                    <p>Raccolti: € {{ number_format($donations[$fundraiser->id], 2, ',', '.') }}</p>
                    <p>Obiettivo: € {{ number_format($fundraiser->goal, 2, '.', ',') }}</p>
                </div>
                <div class="blockquote-footer" >
                    <p>Creata da: {{ $author->first_name }} {{ $author->last_name }}</p>
                </div>
            </div> 
        </div>
    
        <div class="py-4">

            {{-- Controllo login utente/ruolo utente --}}
            @if (Auth::check() && Auth::user()->hasRole('user'))
                <a style="text-decoration: none"href="{{ URL::action('DonationController@create', $fundraiser->id) }}"><button type="button" class="btn btn-success btn-lg btn-block">Dona ora</button></a>
            @else
                {{-- Se l'utente è loggato ed è admin --}}
                @if (Auth::check() && Auth::user()->hasRole('admin'))
                    <div class="text-center">
                        <h3 style="color: #FF0000">Donazioni non autorizzate per l'utente Admin</h3>
                    </div>
                @endif

                {{-- Se l'utente non è loggato nel sito --}}
                @if(!Auth::check())
                    <div class="text text-center">
                        <a href="{{ route('login') }}" class="btn btn-info btn-rounded px-3 my-0 d-none d-lg-inline-block botton-success">Accedi per iniziare a donare!</a>
                    </div>
                @endif
            
            @endif
        </div>
    </div>
@endsection