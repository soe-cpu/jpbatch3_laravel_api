<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Order;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //// dd($request);

        // validation
        $request->validate([
            'ls' => 'required',
            'notes' => 'required',
            'user_id' => 'required'
        ]);

        $lsArr = json_decode($request->ls);

        $total = 0;
        foreach ($lsArr as $row) {
            $total += $row->price*$row->qty;
        }

        // store
        $order = new Order;
        $order->voucherno = uniqid();
        $order->orderdate = date('Y-m-d');
        $order->total = $total;
        $order->notes = $request->notes;
        $order->user_id = $request->user_id; // auth user_id
        $order->save();

        foreach ($lsArr as $row) {
            $order->items()->attach($row->id,['qty'=>$row->qty]);
        }

        // return redirect()->route('mainpage');
        // Alert::success('Complete', 'Your Order Successful');
        return response() ->json([
            'status' => 'Your Order Successful!'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
