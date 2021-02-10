@extends('layouts.app')

@section('content')

<div class="container">
    <form action="{{ URL::action('FundraiserController@store') }}" method="POST">
        {{-- Token per Laravel --}}
        @csrf
        {{ method_field('POST') }}

        {{-- Autore della campagna --}}
        
        <div class="form-group">
            <label for="author">Autore</label>
            <input required type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}" readonly>
            <small id="name" class="form-text text-muted">Questo è il nome che comparirà e i donatori vedranno</small>
        </div>

        {{-- Titolo della campagna --}}
        
        <div class="form-group">
            <label for="name">Titolo della campagna</label>
            <input required type="text" class="form-control" id="name" name="name">
            <small id="name" class="form-text text-muted">Inserisci il titolo della campagna</small>
        </div>

        {{-- Categoria --}}
        
        <div class="form-group">
        <label for="category">Categoria</label>
            <select required class="form-control" id="category" name="category">
                <option selected>--- Seleziona la categoria ---</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- goal - data fine --}}
    
        <div class="row">
            <div class=" form-group col-6">
                <label for="goal">Obiettivo</label>
                <div class="input-group mb-3">
                        <div class="input-group-prepend">
                        <span class="input-group-text" id="goal">€</span>
                    </div>
                    <input type="text" class="form-control" name="goal" id="goal">
                </div>
            </div>
        

            <div class="form-group col-6">
                <label for="category">Data di fine</label>
                <input required type="date" name="ending_date" id="name" class="form-control">
            </div>
        </div>
        
        {{-- link media --}}
        
        <div class="form-group">
            <label for="media_url">Link di una foto per la copertina della campagna</label>
            <input required type="text" class="form-control" id="media_url" name="media_url">
            <small id="media_url" class="form-text text-muted">Copia il link di una immagine che per te ritieni importante</small>
        </div>

        {{-- descrizione --}}
        

        <div class="form-group">
            <label for="description">Descrizione</label>
            <textarea required class="form-control" id="description" name ="description" rows="4"></textarea>
            <small id="description" class="form-text text-muted">Raccontaci la tua storia</small>
        </div>

        <div class="col-md-6" style="margin-top: 10px">
            <button type="submit" class="btn btn-outline-primary">
                Inizia la tua campagna!
            </button>
            <a href="{{ URL::action('FundraiserController@index') }}" class="btn btn-outline-secondary">Indietro</a>
        </div>
    </form>
</div>



@endsection


