@extends('layouts.app')

@section('content')

<div class="container card col-md-6">
    <div class="card-header">
        <h1>Dona</h1>
    </div>
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ URL::action('DonationController@store') }}" method="POST">
            {{ method_field('POST') }}


            <div class=" form-group">
                <label for="amount">Importo</label>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="amount">€</span>
                    </div>
                    <input type="text" class="form-control" name="amount" id="amount">
                </div>
            </div>
            
            <p>Seleziona il metodo di pagamento</p>
            <div class="form-check">
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="radio-bank-transfer" name="payment_method">
                    <label class="form-check-label">
                        Bonifico bancario
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" id="radio-credit-card" name="payment_method">
                    <label class="form-check-label">
                        Carta di credito
                    </label>
                </div>
                <div id="payment-method-form"> </div>
            </div>

            {{-- hidden fields --}}
            
            {{-- _token --}}
            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
            {{-- fundraiser id --}}
            <input type="hidden" name="fundraiser_id" id="fundraiser_id" value="{{ $fundraiser_id }}"/>
            
            {{-- user id --}}
            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
            
            {{-- date --}}
            <input type="hidden" name="date" id="date" value="{{ date('Y-m-d') }}">

            <div class="col-md-6" style="margin-top: 10px">
                <button type="submit" class="btn btn-outline-primary" id="submit-btn">
                    Dona
                </button>
                <a href="{{ URL::action('FundraiserController@index') }}" class="btn btn-outline-secondary">Indietro</a>
            </div>
        </form>
    </div>
</div>

@endsection