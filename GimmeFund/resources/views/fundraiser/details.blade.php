{{-- Pagina dei dettagli della raccolta fondi --}}
@extends('layouts.app')

@section('content')
    <div class="container col-8">
        <img src="{{ $fundraiser->media_url }}" class="img-fluid" alt="Image">
        <h1>{{ $fundraiser->name }}</h1>
        <p>Creata da: {{ $author->first_name }} {{ $author->last_name }}</p>
        <div class="card col-12">
            <div class="card-body">
                <p>Descrizione</p>
              {{ $fundraiser->description }}
            </div>
          </div>
        <a href="{{ URL::action('DonationController@create') }}"><button type="button" class="btn btn-success btn-lg btn-block">Dona ora</button></a>
    </div>
    
@endsection