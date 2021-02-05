@extends('layouts.app')

@section('content')
{{-- ( Mi trovo in:  )
    Metto la tabella applicandole gli stili con bootstrap 4.6 --}}
<div class="container">
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
                        @foreach ($roles as $role) 
                            <div class="form-check">
                                <input type="checkbox" name="roles[]" value="{{ $role->id }}">
                                <label> {{ $role->name }}</label>
                            </div>
                        @endforeach
                        <button type="submit" class="btn btn-primary">
                            Salva
                        </button>
                    </form>
                        
                </div>
            </div>
        </div>
    </div>
</div>
@endsection



