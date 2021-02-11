@extends('layouts.app')

@section('content')

    <div class="container">
        <form action="{{ URL::action('UserController@update', Auth::user()) }}" method="POST">
            @csrf
            {{ method_field('PATCH') }}

            <div class="card">
                <div class="card-header">
                    <h3>I miei dati</h3>
                </div>
                <div class="card-body">

                    <p>Modifica e salva i tuoi dati</p>
                    
                    <hr>

                    {{-- Nome - Cognome --}}
                    <div class="form-group row">

                        <div class="col-md-6">
                            <label for="first_name" class="form-check-label">Nome</label>
                            <input type="text" class="form-control" name="first_name" id="first_name" value="{{ Auth::user()->first_name }}">
                        </div>
                        
                        <div class="col-6">
                            <label for="last_name" class="form-check-label">Cognome</label>
                            <input type="text" class="form-control" name="last_name" id="last_name" value="{{ Auth::user()->last_name }}">
                        </div>

                    </div>

                    {{-- Email --}}
                    <div class="form-group row">
                        <label for="email" class="col-form-label col-md-2">Email</label>
                        <div class="col-md-10">
                            <input type="email" name="email" id="email" class="form-control-plaintext col-md-6" value="{{ Auth::user()->email }}" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="phone_number" class="col-form-label col-md-2">Numero di telefono</label>
                        <input type="text" class="form-control col-md-3" name="phone_number" id="phone_number" value="{{ Auth::user()->phone_number }}">
                    </div>
                    
                    {{-- Data di Nascita --}}
                    <div class="form-group row">
                        <label for="birthday" class="col-form-label col-md-2">Data di nascita</label>
                        <input type="date" class="form-control col-md-4" name="birthday" id="birthday" value="{{ Auth::user()->birthday }}">
                    </div>

                    {{-- Indirizzo - Città - CAP --}}
                    <div class="form-group row">
                        <div class="col-md-4">
                            <label for="address" class="form-check-label">Indirizzo</label>
                            <input type="text" class="form-control" name="address" id="address" value="{{ Auth::user()->address }}">
                        </div>

                        <div class="col-md-4">
                            <label for="city" class="form-check-label">Città</label>
                            <input type="text" class="form-control" name="city" id="city" value="{{ Auth::user()->city }}">
                        </div>
                        
                        <div class="col-md-4">
                            <label for="CAP" class="form-check-label">CAP</label>
                            <input type="text" class="form-control" name="CAP" id="CAP" value="{{ Auth::user()->CAP }}">
                        </div>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary col-md-2">Salva</button>
                    </div>
                    
                </div>
            </div>

        </form>
    </div>
    

@endsection
