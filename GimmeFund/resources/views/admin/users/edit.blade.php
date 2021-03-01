@extends('layouts.app')

@section('content')
{{-- ( Mi trovo in: http://localhost:8000/admin/users/1/edit , dove 1 è l'id dell'utente 1)
    Metto la tabella applicandole gli stili con bootstrap 4.6 --}}
<div class="container py-5">
    <div class="row justify-content-center">
    <div class="col-md-8">
            <div class="card">
                <div class="card-header">Modifica utente {{ $user->name }}</div>
                <div class="card-body">
                    
                    {{-- Creo il form per la modifica dell'utente. Richiamo il metod update dello UsersController--}}
                    <form action="{{ URL::action('Admin\UsersController@update', $user) }}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        {{-- Piccolo form per cambiare il ruolo ad un utente --}}
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="first_name">Nome</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" aria-describedby="" value="{{ $user->first_name }}">
                                <small id="text" class="form-text text-muted">Modifica il nome dell'utente</small>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="last_name">Cognome</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" aria-describedby="" value="{{ $user->last_name }}">
                                <small id="text" class="form-text text-muted">Modifica il cognome dell'utente</small>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" aria-describedby="" value="{{ $user->email }}">
                                <small id="text" class="form-text text-muted">Modifica l'email dell'utente</small>
                            </div>
                        </div>

                        
                        @foreach ($roles as $role) 
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="roles[]" value="{{ $role->id }}" 
                                    {{-- Check del ruolo --}}
                                    @if ($user->roles->pluck('id')->contains($role->id)) checked @endif>
                                    <label class="form-check-label"> {{ $role->name }}</label>
                                </div>
                            </div>
                        @endforeach
                        
                        <div class="col-md-6" style="margin-top: 10px">
                            <button type="submit" class="btn btn-outline-primary">
                                Salva
                            </button>
                            <a href="{{ URL::action('Admin\UsersController@index') }}"><button type="submit" class="btn btn-outline-secondary"></a>
                                Indietro
                            </button>
                        </div>
                    </form>
                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection