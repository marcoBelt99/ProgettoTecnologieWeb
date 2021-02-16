{{-- Pagina dei dettagli della raccolta fondi: link:  --}}
@extends('layouts.app')

@section('content')
    
    <div class="container col-7">
        
        <div class="text text-center"><h1>{{ $fundraiser->name }}</h1></div>        
        <div class="card col-12" style="padding: 0px">
            <div class="card-img-top text-center" style="padding: 10px"><img src="{{ $fundraiser->media_url }}" class="img-fluid" alt="Image"></div>
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
        
        <div style="margin-top: 20px">
            {{-- ERRORE da controllare --}}
            @if (Auth::user()->hasRole('user'))
                <a href="{{ URL::action('DonationController@create', $fundraiser->id) }}"><button type="button" class="btn btn-success btn-lg btn-block">Dona ora</button></a>
            @else
                <div class="text text-center">
                    <p>Azione non autorizzata</p>
                </div>
            @endif
        </div>
    </div>
@endsection