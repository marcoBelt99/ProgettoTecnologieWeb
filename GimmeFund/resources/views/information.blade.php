@extends('layouts.app')
{{-- @author Marco --}}
@section('content')

    <div class="container col-8">
        <div class="row">
            <div class="card-group py-4">
                <div class="card border-none">
                    <div class="card-head">
                        <h1 id="titlechisiamo">Cos'è il CrowdFunding?</h1>
                    </div>
                    <div class="bd-callout-info bd-callout">
                        <div class="card-body">
                            <p id="testochisiamo">Grazie al potere dei social network e di Internet, il crowdfunding offre
                                l’opportunità di raccogliere fondi per i propri obiettivi o per aiutare gli altri a superare
                                le difficoltà.
                                Con il crowdfunding puoi aiutare un amico o un’intera comunità.
                                Puoi fare di tutto: pagare per un’operazione chirurgica, realizzare il sogno di uno studente
                                che vuole andare al college e molto altro.
                                Se ti stai domandando “Cos’è il crowdfunding” o “Quali sono i vantaggi del crowdfunding?”,
                                continua a leggere.
                                Risponderemo alle tue domande sul crowdfunding e ti daremo consigli su come raccogliere
                                donazioni.
                            </p>
                        </div>
                        {{-- Controllo login utente/ruolo utente --}}
                        @if (Auth::check() && Auth::user()->hasRole('user'))
                            <a href="{{ URL::action('FundraiserController@create') }}"><button type="button"
                                    class="btn btn-info btn-rounded px-3 my-0 d-none d-lg-inline-block botton-success">Inizia
                                    la tua campagna ora!</button></a>
                        @else

                            {{-- Se l'utente non è loggato nel sito --}}
                            @if (!Auth::check())
                                <div class="text text-center">
                                    <a href="{{ route('login') }}"
                                        class="btn btn-info btn-rounded px-3 my-0 d-none d-lg-inline-block botton-success">Accedi
                                        o registrati per iniziare a donare!</a>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="card border-none">
                    <img src="{{ asset('images/volontario2.jpg') }}" class="d-block img-fluid">
                </div>
            </div>
        </div>
    </div>

@endsection
