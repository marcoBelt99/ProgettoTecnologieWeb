{{-- Pagina dei buoni sconto --}}
@extends('layouts.app')

@section('content')

<div class="container col-md-6 py-4">
    <div class="card card-home">
        <div class="card-header">
            <h2>Genera un nuovo Coupon</h2>
        </div>
        <div class="card-text ml-2 mt-3">
            <p> I buoni generati verranno salvati nella sezione "I miei Buoni"<br>
                I Coupons generati sono spendibili presso punti vendita di prodotti FairTrade
            </p>
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

        <form action="{{ URL::action('CouponController@store') }}" method="POST">
            {{-- Token per Laravel --}}
            @csrf
            {{ method_field('POST') }}
            <div class="form-group row">
                <label class="col-sm-3 col-form-label" for="user-points">Punti disponibili:</label>
                <input type="text" id="user-points" class="form-control-plaintext col-sm-2" value="{{ Auth::user()->points }}" readonly>
            </div>
        

            <div class="form-group">
                <label for="points-amount">Punti</label>
                <div class="input-group mb-3">
                    <input type="number" class="form-control text-center" name="points_amount" id="points-amount" value="0" max="{{ Auth::user()->points }}" min="2" step="1">
                </div>
            </div>

            {{-- hidden fields --}}
            
            <div class="form-group">
                <label for="coupon-amount">Importo del coupon da generare: </label>
                <div class="input-group mb-3">
                    <input type="text" class="form-control text-center" name="coupon_amount" id="coupon-amount" value="0" readonly>
                    <div class="input-group-append">
                        <span class="input-group-text"><b>€</b></span>
                    </div>
                </div>
            </div>

            {{-- user id --}}
            <input type="hidden" name="user_id" id="user_id" value="{{ Auth::user()->id }}">
            
            <div class="row">
                <div class="btn-group px-2">
                    <button type="submit" class="btn btn-success">Genera Buono</button>
                </div>
                <div class="btn-group">
                    <a href="{{ URL::action('CouponController@index', Auth::user()->id) }}" class="btn btn-secondary">Indietro</a>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@section('script')
    
    <script type="text/javascript">

        $(document).ready(function() {
            var moltiplicatore = 1.5 // Eventuale moltiplicatore dei punti
            var divisore = 20; // Punti necessari per generare € 2 

            $('#points-amount').on("change", function() {
                
                let curr_value = new Number($('#points-amount').val());
                console.log(curr_value);
                var result = Math.floor(moltiplicatore * (curr_value / divisore));
                $('#coupon-amount').val(result);
            });
        });
    
    </script>

@endsection