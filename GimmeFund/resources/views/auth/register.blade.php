@extends('layouts.app')

@section('content')
<div class="container responsive"> {{-- aggiunto responsive --}}
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registrati ora a GimmeFund, è facile!</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        {{-- Gestione alert per immissione invalida di dati --}}
                        
                        {{-- Nome --}}
                        
                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">Nome</label>
                            <div class="col-md-6 float-left">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autofocus>

                                @error('first_name')
                                    {{-- <span class="invalid-feedback" role="alert"> --}}
                                        <div class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </div>
                                    {{-- </span> --}}
                                @enderror
                            </div>
                        </div>

                        {{-- Cognome --}}
                        
                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">Cognome</label>
                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autofocus>

                                @error('last_name')
                                    {{-- <span class="invalid-feedback" role="alert"> --}}
                                        <div class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    {{-- </span> --}}
                                @enderror
                            </div>
                        </div>

                        {{-- Data di nascita --}}
                        
                        <div class="form-group row">
                            <label for="birthday" class="col-md-4 col-form-label text-md-right">Data di nascita</label>
                            <div class="col-md-6">
                                <input id="birthday" type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday') }}" required autofocus>

                                @error('birthday')
                                    {{-- <span class="invalid-feedback" role="alert"> --}}
                                        <div class="alert alert-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    {{-- </span> --}}
                                @enderror
                            </div>
                        </div>

                        {{-- Email --}}
                        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Password --}}
                        
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</{{ stro }}ng>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- Conferma password --}}
                        
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Conferma password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        {{-- Conferma --}}
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Registrati
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
