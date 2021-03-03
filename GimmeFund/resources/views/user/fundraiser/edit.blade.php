@extends('layouts.app')

@section('content')
    
<div class="container-fluid col-10 py-4">
    <div class="card card-home">
        <div class="card-header">
            <p class="card-title"><h2>Modfica la tua campagna: {{ $fundraiser->name }}</h2></p>
        </div>
        <div class="card-body">
            <form style="margin-top: 20px" action="{{ URL::action('FundraiserController@update', $fundraiser) }}" method="POST" 
                enctype="multipart/form-data">
                
                {{-- Token per Laravel --}}
                {{ method_field('PUT') }}
                <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">

                {{-- Hidden fields --}}
                {{-- User id --}}
                <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
                {{-- Fundraiser id --}}
                <input type="hidden" name="fundraiser_id" id="fundraiser_id" value="{{ $fundraiser->id }}">

                
                {{-- Allert per mancato inserimento di campi in input --}}
                
                @isset($message)
                <div class="alert alert-success" role="alert" id="success-alert-container">
                    {{ $message }}
                </div>
                @endisset

                <div class="form-group">
                    <label for="name">Titolo della campagna</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $fundraiser->name }}">
                    <small id="name" class="form-text text-muted">Modifica il titolo della tua campagna</small>
                </div>

                {{-- Categoria --}}
                <div class="form-group">
                    <label for="category">Categoria</label>
                    <select class="form-control" id="category_id" name="category_id">
                        <option value="{{ $fundraiser->category_id }}" selected>{{ $categories[($fundraiser->category_id - 1)]->name }} (Attualmente selezionata)</option>
                        @foreach ($categories as $category)
                            @if ($category->id != $fundraiser->category_id)
                                {{-- Vengono elencate tutte le categorie tranne quella attualmente selezionata --}}
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>

                {{-- goal - data fine --}}

                <div class="row">
                    <div class=" form-group col-6">
                        <label for="goal">Obiettivo</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="goal-span">€</span>
                            </div>
                        <input type="text" class="form-control" name="goal" id="goal" value="{{ $fundraiser->goal }}">
                    </div>
                    <small id="name" class="form-text text-muted">Obiettivo attuale: {{ number_format($fundraiser->goal, 2, '.',' ') }} €</small>
                </div>
    
                {{-- upload immagine --}}

                <div class="form-group col-6">
                    <label for="author">Carica l'immagine in formato JPG o PNG</label>
                    <input type="file" class="form-control" id="uploadedfile" name="uploadedfile">
                    <small class="form-text text-muted">Foto attuale: {{ substr($fundraiser->filename, 11, 255) }}</small>
                </div>
    

                {{-- descrizione --}}
                <div class="form-group col-12">
                    <label for="description">Descrizione</label>
                    <textarea class="form-control" id="description" name ="description" rows="6">{{ $fundraiser->description }}</textarea>
                    <small id="description" class="form-text text-muted">Modifica la descrizione</small>
                </div>

                {{-- Bottoni --}}
                <div class="col-md-6">
                    <button type="submit" class="btn btn-success" id="submit-btn">
                        Salva modifiche
                    </button>
                    <a href="{{ URL::action('FundraiserController@getUserFundraisers', Auth::user()->id) }}" class="btn btn-secondary">Indietro</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
</script>
@endsection