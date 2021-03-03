@extends('layouts.app')

@section('content')

    
<div class="container-fluid col-9 py-4">
    <h2>Le mie raccolte fondi</h2>
    <div class="row">
    
    @foreach ($userFundraisers as $uf)
        <div class="col-sm-3 py-4">
            <div class="card-home" style="width: 18rem; height: auto;">
                <img style="height: 200px" src="{{ Storage::url("{$uf->filename}") }}" class="card-img-top" alt="{{ $uf->filename }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $uf->name }}</h5>
                    <p class="card-text">{{ substr($uf->description, 0, 100) }}...</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Obbiettivo: {{ number_format($uf->goal, 2, '.', ' ') }} €</li>
                    <li class="list-group-item">Raccolti: {{ number_format($totDonationsPerFundraiser[$uf->id], 2, '.', ' ') }} €</li>
                    <li class="list-group-item">Numero di donazioni totali: {{ $numberDonationsFundraiser[$uf->id] }}</li>
                    <li class="list-group-item">Termina il: {{ date('d/m/Y', strtotime($uf->ending_date)) }}</li>              
                </ul>
                <div class="card-body bottomfundra">
                    <a href="{{ URL::action('FundraiserController@show', $uf->id) }}" class="btn btn-success align-content-xl-center botton-center m-1">Visualizza</a>
                    <a href="{{ URL::action('FundraiserController@edit', $uf->id) }}" class="btn btn-primary align-content-xl-center botton-center m-1">Modifica</a>
                    
                    <form action="{{ URL::action('FundraiserController@destroy', $uf) }}" method="POST">
                        @csrf
                        {{ method_field('DELETE') }}
                        <button type="submit" class="btn btn-danger align-content-xl-center botton-center m-1" onclick="alert('Attenzione azione irreversibile')">Elimina</button>
                    </form>

                </div>
            </div>
        </div>
    @endforeach  
    </div>
</div>

@endsection

@section('script')
    
@endsection