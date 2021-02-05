@extends('layouts.app')

@section('content')
{{-- ( Mi trovo in http://localhost:8000/admin/users )

Metto la tabella applicandole gli stili con bootstrap 4.6 --}}
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Utenti</div>

                <div class="card-body">
                    <table class="table table-responsive table-striped table-bordered table-hover">
                        {{-- Intestazionetabella --}}
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Cognome</th>
                            <th scope="col">Email</th>
                            <th scope="col">Telefono</th>
                            <th scope="col">Ruolo</th>
                            <th scope="col">Azioni</th>
                          </tr>
                        </thead>
                        {{-- Corpo tabella --}}
                        <tbody>
                            @foreach ($users as $u)
                            <tr>
                                <th scope="row">{{ $u->id }}</th>
                                <td>{{ $u->first_name }}</td>
                                <td>{{ $u->last_name }}</td>
                                <td>{{ $u->email }}</td>
                                <td>{{ $u->phone_number }}</td>
                                {{-- Separo i ruoli degli utenti, che sono restituiti dalla catena di chiamate di funzioni, sulla base del separatore ',' --}}
                                <td>{{ implode(', ', $u->roles()->get()->pluck('name')->toArray()) }}</td>
                                <td>
                                    {{-- Metto i bottoni per la Modifica e l'Eliminazione di un Utente. (Premendo su tali bottoni, ovviamente accedo alle rispettive pagine) --}}
                                    <a href="{{ URL::action('Admin\UsersController@edit', $u->id) }}"><button type="button" class="btn btn-secondary float-left">Modifica</button></a>
                                    {{-- Preparo un form (con metodo POST) per l'eliminazione dell'utente --}}
                                    <form action="{{ URL::action('Admin\UsersController@destroy', $u->id)}}" method="POST" class="float-left">
                                        @csrf
                                        {{ method_field('DELETE') }}
                                        <button type="submit" class="btn btn-danger">Elimina</button>
                                    </form>
                                    
                                </td>
                              </tr>
                            @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
