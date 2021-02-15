@extends('layouts.app')

@section('content')
    <div class="container col-8">
        <div class="card">
            <div class="card-header">
                {{-- <pre>Punti accumulati</pre> --}}
                <h4>Punti accumulati</h4>
            </div>
            <div class="card-body">
                <p>Saldo punti: <kbd>{{ $user->points }}</kbd></p>
                {{-- <p>Saldo punti: {{ $user->points }}</p> --}}
                <p>Numero di donazioni effettuate: <kbd>{{ $n_donations }}</kbd></p>
                {{-- <p>Numero di donazioni effettuate: {{ $n_donations }}</p> --}}
                
                {{-- Criterio per poter accedere alla conversione dei punti in buono sconto --}}
                @if ($user->points > 0)
                    <a href="{{ URL::action('CouponController@create') }}"><button class="btn btn-primary"> Converti i tuoi punti</button></a>
                @else
                    <a href="{{ URL::action('CouponController@create') }}"><button class="btn btn-primary" disabled>Converti i tuoi punti</button></a>
                    <small>Saldo insufficiente per la convesione</small>
                @endif
            </div>
        </div>
    </div>
@endsection