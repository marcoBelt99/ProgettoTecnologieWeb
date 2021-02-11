@extends('layouts.app')

@section('content')
{{-- <div class="container"> --}} {{-- Aggiunto --}}
    <card title="Titolo della card con Vue.js" background="primary"> {{-- Aggiunto --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            {{-- <div class="card">
                <div class="card-header">{{ __('Dashboard') }}
                </div>
                <div class="card-body"> --}}
                    {{-- Aggiungo questo componente Vue.js --}}
                        <p>Testo all'interno della card con Vue.js!</p>
                    </card>
                    {{-- Fine aggiunta componente Vue.js --}}
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <a href="{{ URL::action('FundraiserController@create') }}"><button type="button" class="btn btn-success">
                        Crea la tua campagna ora!
                    </button></a>

                    {{-- Aggiungo delle cose: --}}
                    {{-- .... --}}
                    {{-- Fine aggiunta di cose --}}
                    {{-- </div>
                        </div> 
                    --}} {{-- Aggiunto --}}
        </div>
    </div>
{{-- </div> --}} {{-- Aggiunto --}}
@endsection