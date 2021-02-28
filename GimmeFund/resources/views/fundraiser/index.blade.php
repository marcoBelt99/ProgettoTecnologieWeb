@extends('layouts.app')


@section('content')
{{-- Prova --}}
<div class="jumbotron card card-image" style="background-image: url(https://mdbootstrap.com/img/Photos/Others/gradient1.jpg);">
    <div class="text-white text-center py-5 px-4">
        <div>
            <h2 class="card-title h1-responsive pt-3 mb-5 font-bold"><strong>Il tuo gesto su GimmeFund vale doppio!</strong></h2>
            <p class="mx-5 mb-5">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellat fugiat, laboriosam, voluptatem,
            optio vero odio nam sit officia accusamus minus error nisi architecto nulla ipsum dignissimos. Odit sed qui, dolorum!
            </p>
            <a class="btn btn-outline-white btn-md"><i class="fas fa-clone left"></i> View project</a>
        </div>
    </div>
</div>
{{-- Fine prova --}}

{{-- Metto il jumbotron per vedere le raccolte fondi. Scorro ogni raccolta fondi con il foreach  --}}
@foreach ($fundraisers as $fundraiser)
    
      {{--  --}}
    <div class="container">
        <div class="jumbotron-fundraiser">
            <h1 class="display-4">{{ $fundraiser->name }}</h1>
            <p class="lead">{{ substr($fundraiser->description,0 ,300)}}...</p>
                <hr class="my-4">
            {{-- Faccio alcune queries con eloquent  --}}
            <p>Termina il {{ date('d/m/Y', strtotime($fundraiser->ending_date)) }}</p>
            <p>Raccolti: € {{ number_format($donations[$fundraiser->id], 2, ',', '.') }}</p>
            <p>Obiettivo: € {{ number_format($fundraiser->goal, 2, '.', ',') }}</p>
            <p class="lead">
                {{-- Sistemo il bottone, il quale linka ad una pagina di informazioni --}}
                <a href="{{ URL::action('FundraiserController@show', $fundraiser->id) }}">
                    <button type="button" class="btn btn-primary btn-lg">Altre informazioni</button>
                </a>
            </p>
        </div>
    </div>
    @endforeach  
@endsection