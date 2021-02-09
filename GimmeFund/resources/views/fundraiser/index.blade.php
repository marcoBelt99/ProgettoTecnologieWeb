@extends('layouts.app')

@section('content')
{{-- Metto il jumbotron per vedere le raccolte fondi. Scorro ogni raccolta fondi con il foreach  --}}
    @foreach ($fundraisers as $fundraiser)
    <div class="container">
        <div class="jumbotron">
            <h1 class="display-4">{{ $fundraiser->name }}</h1>
                <p class="lead">{{ $fundraiser->description }}</p>
                    <hr class="my-4">
                <p>Scade il: {{ date('d/m/Y', strtotime($fundraiser->ending_date)) }}</p>
                <p>Raccolti: 0/{{ $fundraiser->goal }}</p>
                    <p class="lead">
                <a class="btn btn-primary btn-lg" href="#" role="button">Learn more</a>
            </p>
        </div>
    </div>
    @endforeach

@endsection