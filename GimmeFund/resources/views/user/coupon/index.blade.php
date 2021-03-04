@extends('layouts.app')

@section('content')

<div class="container col-md-6 py-4">
    <div class="card card-home">
        <div class="card-header">
            {{-- <pre>Punti accumulati</pre> --}}
            <h2>Punti accumulati</h2>
        </div>
        <div class="card-body">
            <p>Saldo punti: <kbd>{{ $user->points }}</kbd></p>
            {{-- <p>Saldo punti: {{ $user->points }}</p> --}}
            <p>Numero di donazioni effettuate: <kbd>{{ $n_donations }}</kbd></p>
            
            {{-- Criterio per poter accedere alla conversione dei punti in buono sconto --}}
            <div class="row">
                <div class="btn-group" role="group">
                    @if ($user->points > 0)
                        <a href="{{ URL::action('CouponController@create') }}" ><button class="btn btn-success">Converti i punti</button></a>
                    @else
                        <a href="{{ URL::action('CouponController@create') }}" ><button class="btn btn-success" disabled>Converti i punti</button></a>
                        {{-- <p style="color: #ff0000;">Saldo insufficiente per la convesione</p> --}}
                    @endif
                </div>
                <div class="btn-group px-2" role="group">
                    <button class="btn btn-secondary" id="my-coupon-btn">I miei buoni</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container col-6" id="coupon-cont">
    <div class="container col-md-8">
        <h3>I miei Coupons FairTrade</h3>
        @if (count($usrCoupons) == 0)
            <p>Sembra che non ci siano ancora coupon. Converti subito i tuoi punti e fai acquisti equosolidali!</p>
        @else
            <table class="table table-striped">
                <thead class="thead-dark">
                <tr>
                    <th scope="col">Codice Coupon</th>
                    <th scope="col">Sconto di (euro)</th>
                    <th scope="col">Creato il</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($usrCoupons as $usrCoupon)
                    <tr>
                        <td>{{ $usrCoupon->code }}</td>
                        <td>{{ number_format($usrCoupon->amount, 2, ',', '.') }}</td>
                        <td>{{ date('d/m/Y', strtotime($usrCoupon->created_at)) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>    
        @endif
    </div>
</div>


@endsection

@section('script')
    <script type="text/javascript">

        $('#coupon-cont').toggle(false);

        $(document).ready(function() {

            $('#my-coupon-btn').on('click', function() {
                $('#coupon-cont').slideToggle(300);
            });
        });


    </script>
@endsection