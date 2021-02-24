@extends('layouts.app')

{{-- Sezione dello stile: lo stile è stato spostato in .../stili.css --}}
@section('style')
@endsection
{{-- Sezione del contenuto --}}
@section('content')



{{-- <p> {{ count($visual) }}</p> --}}
{{-- <p>{{ $visual[0][0]['media_url']}}</p> --}}

<!-- Carousel -->
<div id="slider_business" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        <li data-target="#slider_business" data-slide-to="0" class="active">
            
        </li>
        <li data-target="#slider_business" data-slide-to="1" class="active">

        </li>
        <li data-target="#slider_business" data-slide-to="2" class="active">

        </li>
    </ol>
    <div class="carousel-inner">
        <div class="carousel-item active">
            {{-- Inserisco un'immagine: crowdfunding1 --}}
            {{-- {{ asset('img/crowdfunding1.jpg') }} --}}
            {{-- {{ HTML::image('img/crowdfunding1.jpg', 'alt text', array('class' => 'css-class')) }} --}}
            {{-- src="{{URL::asset('/image/crowdfunding1.jpg')}}" --}}
            {{-- {{ asset('/crowdfunding1.jpg') }} --}}
            {{-- <img src="{{ $fundraiser->media_url }}" class="img-fluid" alt="Image"> --}}

            <img class="d-block img-fluid" src="{{ asset("images/photo-8.jpg") }}" alt="Slide1" width="100%">
            {{-- <img class="d-block img-fluid" src="{{ $visual[0]->media_url }}" alt="Slide1" width="100%">  --}}
            <div class="carousel-caption d-none d-md-block">
                <h2>Solidarietà e unione</h2>
                <h5>Siamo pronti a collaborare per dare un futuro migliore a tutti!</h5>
            </div>
        </div>
        <div class="carousel-item">
            {{-- <img class="d-block img-fluid" src="{{ }}" alt="Slide2" width="100%"> --}}
            <img class="d-block img-fluid" src="{{ asset("images/photo-7.jpg") }}" alt="Slide2" width="100%">
            <div class="carousel-caption d-none d-md-block">
                <h2>Donare</h2>
                <h5>Racogliamo fondi per le persone e le cause che ti stanno a cuore</h5>
            </div>
        </div>
        <div class="carousel-item">
            
            <img class="d-block img-fluid" src="{{ asset("images/photo-6.jpg") }}">
            <div class="carousel-caption d-none d-md-block">
                <h2>Collaboratori</h2>
                <h5>Un gruppo di nostri volontari al lavoro per aiutare le persone in difficoltà</h5>
            </div>
        </div>
        <div class="carousel-item">
            
            <img class="d-block img-fluid" src="{{ asset("images/photo-9.jpg") }}">
            <div class="carousel-caption d-none d-md-block">
                <h2>Entra a far parte di GimmeFund!</h2>
                <h5>Il tuo gesto vale doppio!</h5>
            </div>
        </div>
    </div>
    <a class="carousel-control-prev" href="#slider_business" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#slider_business" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>



<div class="container mt-3 mb-3 py-5">
    <h1 class="display-3 titolo-card">GimmeFund</h1>
    <div class="row">
        <div class="card-group">
            <div class="card">
                
                <div class="card-body">
                    <h2 class="card-title card-center">Crea una raccolta fondi</h2>
                    <p class="card-text">Crea una raccolta fondi in pochi minuti. È una procedura facile e veloce</p>              
                    <a href="{{ URL::action('FundraiserController@create') }}" class="btn btn-info btn-rounded px-3 my-0 d-none d-lg-inline-block" style="background-color: #54be90 !important;">
                        Inizia la tua campagna ora!
                    </a>
                </div>
                
            </div>
            <div class="card">
                
                <div class="card-body">
                    <h2 class="card-title card-center">Effettua donazioni</h2>
                    <p class="card-text">Dona in modo da dare un futuro a persone che hanno bisogno di un aiuto economico</p>                            
                    <a href="{{ URL::action('FundraiserController@index') }}" class="btn btn-info btn-rounded px-3 my-0 d-none d-lg-inline-block" style="background-color: #54be90 !important;">
                        Visulizza le raccolte fondi!
                    </a>
                </div>
                
            </div>
            <div class="card">
                
                <div class="card-body">
                    <h2 class="card-title card-center">Ottieni coupons</h2>
                    <p class="card-text">Trasforma i punti in coupons utilizzabili in molti negozi e supermercati per prodotti Fairtrade</p>                            
                </div>
                
            </div>
        </div>
    </div>
</div>




<!-- Card group -->
<div class="container text-muted mt-3 mb-3">
    <div class="row">
        <div class="card-group">
            
            @foreach ($visual as $v)
            <div class="card">
                <img class="card-img-top img-fluid" src="{{ $v->media_url }}">
                <div class="card-body">
                    <h4 class="card-title card-center">{{ $v->name }}</h4>                    
                    <p class="card-text">{{ substr($v->description, 0, 100) }}...</p>
                    <p>Iniziata il: {{ date('d/m/Y', strtotime($v->starting_date)) }}</p>
                    <a href="{{ URL::action('FundraiserController@show', $v->id) }}"><button class="btn btn-primary btn-spl" type="button">Scopri di più</button></a>
                </div>
                <div class="card-footer">
                    <small>Creata da</small>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection



{{-- @section('script')
    <!-- Al termine della pagina, prima della chiusura del tag body, si inseriscono i link alle librerie software di:  jQuery, -->
    <script
    src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
    integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
    crossorigin="anonymous"></script>

    <!-- Popper (per la gestione dei popup) -->
    <script
    src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>

    <!-- e di Javascript-->
    <script
    src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>

@endsection --}}