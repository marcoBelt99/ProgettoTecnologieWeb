@extends('layouts.app')

@section('style')

<style type="text/css">

    /* Colore di sfondo della barra di navigazione */
    .navbar {
        background-color: #336699;
      }
    
     /* Colori e allineamento del testo */
    .jumbotron {
        color: #868E96;
        background: #CBDFDF;
        text-align: center;
        margin-bottom: -20px;
    }
    
    .jumbotron-fluid {
        background: #336699;
        text-align: center;
        padding: 50px;
    }
</style>

@section('content')

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
            <img class="d-block img-fluid" src="crowdfunding1.jpg" alt="Slide1" width="100%">
            <div class="carousel-caption d-none d-md-block">
            <h3>Caption per la slide 1</h3>
            <p>Descrizione slide 1</p>
        </div>
    </div>
    <div class="carousel-item">
        <img class="d-block img-fluid" src="crowdfunding2.jpg" alt="Slide2" width="100%">
        <div class="carousel-caption d-none d-md-block">
          <h3>Caption per la slide 2</h3>
          <p>Descrizione slide 2</p>
        </div>
    </div>
    <div class="carousel-item">
        <img class="d-block img-fluid" src="crowdfunding3.png" alt="Slide3" width="100%">
        <div class="carousel-caption d-none d-md-block">
          <h3>Caption per la slide 3</h3>
          <p>Descrizione slide 3</p>
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
    <!-- Jumbotron -->
    <div class="jumbotron">
        <h1 class="display-3">GimmeFund</h1>
        <p class="lead">Il tuo gesto, vale doppio!</p>
        <hr>
        {{-- <p>Aggiungi un sottotitolo per spiegare agli utenti cosa offre l'azienda e quali sono i potenziali clienti.</p> --}}
        <a class="btn btn-primary btn-lg btn-spl" href="#" role="button">Cosa offriamo</a>
    </div>
    <!-- Card group -->
    <div class="container text-muted mt-3 mb-3">
        <div class="row">
            <div class="card-group">


            <div class="card">
                <img class="card-img-top img-fluid" src="servizio1.png">
                <div class="card-body">
                    <h4 class="card-title">Cloud</h4>
                    <p class="card-text">Inserisci qui la descrizione del servizio offerto</p>
                    <button class="btn btn-primary btn-spl" href="#" role="button">Scopri</button>
                </div>
                <div class="card-footer">
                    <small class="text-muted">footer della card</small>
                </div>
            </div>


            <div class="card">
                <img class="card-img-top img-fluid" src="servizio2.png">
                <div class="card-body">
                    <h4 class="card-title">Infrastruttura</h4>
                    <p class="card-text">Inserisci qui la descrizione del servizio offerto</p>
                    <button class="btn btn-primary btn-spl" href="#" role="button">Scopri</button>
                </div>
                <div class="card-footer">
                    <small class="text-muted">footer della card</small>
                </div>
            </div>

            <div class="card">
            <img class="card-img-top img-fluid" src="servizio3.png">
                <div class="card-body">
                    <h4 class="card-title">Sicurezza</h4>
                    <p class="card-text">Inserisci qui la descrizione del servizio offerto</p>
                    <button class="btn btn-primary btn-spl" href="#" role="button">Scopri</button>
                </div>
                <div class="card-footer">
                    <small class="text-muted">footer della card</small>
                </div>
            </div>
        </div>
    </div>
    </div>
    <!-- Footer -->
    <div class="jumbotron-fluid">
        <div class="container">
            <h2>Sezione piè di pagina</h2>
            <p class="lead">&copy; All Rights Reserved</p>
        </div>
    </div>
</div>
@endsection

@section('script')
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
    
@endsection