@extends('layouts.app')

@section('content')
    <div class="container">
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

                <a href="{{ URL::action('CouponController@create') }}" class="btn btn-primary">Converti i tuoi punti</a>
                
            </div>
        </div>
    </div>
@endsection