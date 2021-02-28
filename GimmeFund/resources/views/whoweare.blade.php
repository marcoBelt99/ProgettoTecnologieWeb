@extends('layouts.app')

{{-- @author Davide --}}
@section('content')

<h1 class="py-5 text-center">Il nostro team</h1>

<div class="container-fluid row">
  <div class="col-sm-3 py-3">
    <div class="card-home">
      <img class="card-img-top img-fluid" src="{{ asset("images/marco.jpg") }}">
      <div class="card-body">
        <h2 class="card-title card-center">Marco</h2>                    
        <p class="card-text card-center" style="font-size: 20px">Soprannominato "Bootstrap Man"</p>
      </div>
    </div>
  </div>
  <div class="col-sm-3 py-3">
    <div class="card-home">
      <img class="card-img-top img-fluid" src="{{ asset("images/davide.jpg") }}">
      <div class="card-body">
        <h2 class="card-title card-center">Davide</h2>                    
        <p class="card-text card-center" style="font-size: 20px">Conosciuto come "Css God"</p>
      </div>
    </div>
  </div>
  <div class="col-sm-3 py-3">
    <div class="card-home">
      <img class="card-img-top img-fluid" style="height: 40%" src="{{ asset("images/francesco.jpg") }}">
      <div class="card-body">
        <h2 class="card-title card-center">Francesco</h2>                    
        <p class="card-text card-center" style="font-size: 20px">Colui che seleziona compulsivamente le immagini</p>
      </div>
    </div>
  </div>
  <div class="col-sm-3 py-3">
    <div class="card-home">
      <img class="card-img-top img-fluid" style="height: 40%" src="{{ asset("images/enrico.jpg") }}">
      <div class="card-body">
        <h2 class="card-title card-center">Enrico</h2>                    
        <p class="card-text card-center" style="font-size: 20px">Il collezionista di errori Javascript</p>
      </div>
    </div>
  </div>
</div>

@endsection
