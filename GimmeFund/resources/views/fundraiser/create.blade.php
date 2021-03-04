@extends('layouts.app')

@section('content')

<div class="container">

    <div class="container-fluid col-10 py-4">
        <div class="card card-home">
            <div class="card-header">
                <p class="card-title"><h1>Crea la tua campagna</h1></p>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="card-body">
                <form style="margin-top: 40px" action="{{ URL::action('FundraiserController@store') }}" method="POST" 
                    enctype="multipart/form-data">
                    {{-- Token per Laravel --}}
                    @csrf
                    {{ method_field('POST') }}

                    {{-- Autore della campagna --}}
                    <div class="form-group">
                        <label for="author">Autore</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}" readonly>
                        <small id="name" class="form-text text-muted">Questo è il nome che comparirà e i donatori vedranno</small>
                    </div>

                    {{-- Titolo della campagna --}}
        
                    <div class="form-group">
                        <label for="name">Titolo della campagna</label>
                        <input type="text" class="form-control" id="name" name="name">
                        <small id="name" class="form-text text-muted">Inserisci il titolo della campagna</small>
                    </div>

                    {{-- Categoria --}}
        
                    <div class="form-group">
                        <label for="category">Categoria</label>
                        <select class="form-control" id="category_id" name="category_id">
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
                        <input type="date" name="ending_date" id="ending_date" class="form-control">
                        <small id="invalid-date-err" class="form-text" style="color: #ff0000"></small>
                    </div>
        
                    {{-- upload immagine --}}

                    <div class="form-group col-6">
                        <label for="author">Carica l'immagine in formato JPG o PNG</label>
                        <input type="file" class="form-control" id="uploadedfile" name="uploadedfile" value="">
                    </div>
        

                    {{-- descrizione --}}
                    <div class="form-group col-6">
                        <label for="description">Descrizione</label>
                        <textarea class="form-control" id="description" name ="description" rows="4"></textarea>
                        <small id="description" class="form-text text-muted">Raccontaci la tua storia</small>
                    </div>

                    {{-- Hidden fields --}}

                    {{-- Data odirena --}}
                    <input type="hidden" name="starting_date" id="starting_date" value="{{ date('Y-m-d') }}">
                    {{-- User id --}}
                    <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">

                    {{-- Bottoni --}}
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success" id="submit-btn">
                            Crea la tua campagna!
                        </button>
                        <a href="{{ URL::action('FundraiserController@index') }}" class="btn btn-secondary">Indietro</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    
    <script type="text/javascript">
        var isDateValid = true;
        $(document).ready(function() {
            $('#ending_date').on('change', function() {
                    
                var today = new Date();
                var endingDate = new Date($('#ending_date').val());

                if (endingDate < today) {
                    isDateValid = false;
                    $('#invalid-date-err').text('Inserire una data successiva a quella odierna').show();
                } else {
                    isDateValid = true;
                    $('#invalid-date-err').hide();
                }    
            });
            
            $('#submit-btn').on('click', function() {
                if (isDateValid == false) {
                    return false;
                }
            })
        });


    </script>

@endsection