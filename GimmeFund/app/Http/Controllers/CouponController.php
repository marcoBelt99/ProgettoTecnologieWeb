<?php

namespace App\Http\Controllers;

use App\Coupon;
use Illuminate\Http\Request;
use App\Donation;
use App\User;
use Illuminate\Support\Facades\Auth;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        $userData = $user->select('first_name', 'last_name', 'points')->where('id', $user->id)->first();
        $n_donations = Donation::all()->where('user_id', Auth::user()->id)->count();
        $userCoupons = Coupon::all()->where('user_id', Auth::user()->id);

        return view('user.coupon.index')->with([
            'user' => $userData,
            'n_donations' => $n_donations,
            'usrCoupons' => $userCoupons,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // Creo il nuovo codice del coupon creato casualmente
        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $coupon_code = "";
        for ($i = 0; $i < 10; $i++) {
            $coupon_code .= $chars[mt_rand(0, strlen($chars)-1)];
        }

        // Creo il nuovo coupon
        $new_coup = new Coupon();
        $new_coup->code= $coupon_code;
        $new_coup->amount = $request->coupon_amount;
        $new_coup->user_id = $request->user_id;
        $new_coup->save();

        // Aggiorno i punti a disposizione dell'utente
        $user = Auth::user();
        $user->points -= $request->points_amount;
        $user->save();

        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function show(Coupon $coupon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        //
    }
}