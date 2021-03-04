@extends('layouts.app')
{{-- @author Marco --}}
@section('content')
<!--
{{-- ####################################################################################### --}}
{{-- ####################################################################################### --}}
{{-- ####################################################################################### --}}
{{-- ###################################     VECCHIO     ################################### --}}
{{-- ####################################################################################### --}}
{{-- ####################################################################################### --}}
{{-- ####################################################################################### --}}
    <div class="container col-8">
        <div class="row">
            <div class="card-group py-4">
                <div class="card border-none">
                    <div class="card-head">
                        <h1 id="titlechisiamo">Come funziona GimmeFund</h1>
                    </div>
                        <div class="card-body bd-callout-info bd-callout shadow p-3 mb-5 bg-white rounded">
                            <p class="testoinfo textp">
                                {{-- Cos'è il crowdfunding --}}
                                Il crowdfunding offre l’opportunità di raccogliere fondi per i propri obiettivi o per aiutare gli altri a superare
                                le difficoltà.
                            </p>
                            <p class="testoinfo textp">
                                {{-- Cosa fa il crowdfunding? --}}
                                Tramite il portale web “GimmeFund” puoi effettuare finanziamenti-donazioni a favore di progetti, per autare un amico o un'intera comunità.
                                Puoi fare di tutto: pagare per un’operazione chirurgica, realizzare il sogno di uno studente
                                che vuole andare al college e molto altro.
                            </p>
                            <p class="testoinfo">
                                {{-- Che vantaggi hanno i donatori? --}}
                                I donatori sono liberi di scegliere l’entità della donazione al di sopra di una soglia minima.
                                Gli utenti, tramite le donazioni, posso accumulare punti da convertire successivamente in coupons. 
                                I coupons potranno essere così spesi per ottenere sconti nell'acquisto di prodotti Fair Trade.
                            </p>
                                
                            
                        </div>
                        {{-- Controllo login utente/ruolo utente --}}
                        @if (Auth::check() && Auth::user()->hasRole('user'))
                            <a href="{{ URL::action('FundraiserController@create') }}"><button type="button"
                                    class="btn btn-info btn-rounded px-3 my-0 d-none d-lg-inline-block botton-success textp">Inizia
                                    la tua campagna ora!</button></a>
                        @else

                            {{-- Se l'utente non è loggato nel sito --}}
                            @if (!Auth::check())
                                <div class="text text-center">
                                    <a href="{{ route('login') }}"
                                        class="btn btn-info btn-rounded px-3 my-0 d-none d-lg-inline-block botton-success textp">Accedi
                                        o registrati per iniziare a donare!</a>
                                </div>
                            @endif
                        @endif
                </div>
                <div class="card border-none">
                    <img src="{{ asset('images/volontario2.jpg') }}" class="d-block img-fluid">
                </div>
            </div>
        </div>
    </div>

-->

{{-- ####################################################################################### --}}
{{-- ####################################################################################### --}}
{{-- ####################################################################################### --}}
{{-- ###################################     NUOVO     ##################################### --}}
{{-- ####################################################################################### --}}
{{-- ####################################################################################### --}}
{{-- ####################################################################################### --}}
<br>
<br>
<div class="container-fluid content-row">
    <div class="row row-mb-4">
        <div class="col-sm-12 col-lg-6">
            <div class="card h-100 border-none" > {{-- metto tutte le card ad altezza 100 --}}
               
                {{-- Prima colonna --}}
                <div class="card-head">
                    <h1 id="titlechisiamo">Come funziona GimmeFund</h1>
                </div>
                    <div class="bd-callout-info bd-callout shadow p-3 mb-5 bg-white rounded">
                        <p class="testoinfo textp">
                            {{-- Cos'è il crowdfunding --}}
                            Il crowdfunding offre l’opportunità di raccogliere fondi per i propri obiettivi o per aiutare gli altri a superare
                            le difficoltà.
                        </p>
                        <p class="testoinfo textp">
                            {{-- Cosa fa il crowdfunding? --}}
                            Tramite il portale web “GimmeFund” puoi effettuare finanziamenti-donazioni a favore di progetti, per aiutare un amico o un'intera comunità.
                            Puoi fare di tutto: pagare per un’operazione chirurgica, realizzare il sogno di uno studente
                            che vuole andare al college e molto altro.
                        </p>
                        <p class="testoinfo">
                            {{-- Che vantaggi hanno i donatori? --}}
                            I donatori sono liberi di scegliere l’entità della donazione al di sopra di una soglia minima.
                            Gli utenti, tramite le donazioni, accumulano punti da convertire successivamente in buoni sconto. 
                            I coupons potranno essere così spesi per acquistare prodotti FairTrade.
                        </p>
                                               
                       
                    </div> {{-- fine div per classe collout --}}
                    {{-- Controllo login utente/ruolo utente --}}
                    @if (Auth::check() && Auth::user()->hasRole('user'))
                        <a href="{{ URL::action('FundraiserController@create') }}"><button type="button"
                                class="btn btn-info btn-rounded px-3 my-0 d-none d-lg-inline-block botton-success textp">Inizia
                                la tua campagna ora!</button></a>
                    @else

                        {{-- Se l'utente non è loggato nel sito --}}
                        @if (!Auth::check())
                            <div class="text text-center">
                                <a href="{{ route('login') }}"
                                    class="btn btn-info btn-rounded px-3 my-0 d-none d-lg-inline-block botton-success textp">Accedi
                                    o registrati per iniziare a donare!</a>
                            </div>
                        @endif
                    @endif
            </div> {{-- fine card --}}
        </div> {{-- fine col sm-12 --}}
            {{-- Fine prima colonna --}}
            {{-- d-block img-fluid --}}
            {{-- <img src="{{ asset('images/volontario2.jpg') }}" class=""> --}}
            <div class="col-sm-12 col-lg-6">
                <div class="card h-100">
                    <img src="{{ asset('images/volontario2.jpg') }}" class="">
                </div>
            </div>
    </div> {{-- fine row --}}
        
</div>
<br>
<br>

@endsection
