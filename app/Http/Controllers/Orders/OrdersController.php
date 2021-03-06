<?php

namespace App\Http\Controllers\Orders;

use App\Orders;
use Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $orders = DB::table('orders')->paginate(10);
        if($request->ajax()){
            return Response::json($orders);
        }
        
        return view('orders.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id, Orders $orders)
    {
        $order = $orders->find($id);

        if($request->ajax()){
            return Response::json($order);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Orders $orders)
    {
        $order = $orders->find($request->id);
        $order->status = $request->status;
        
        $order->save();

        if($request->ajax()){
            return Response::json($order);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id, Orders $orders)
    {
        $order = $orders->find($id);
        $order = $order->delete();

        if($request->ajax()){
            return Response::json($order);
        }
    }
}
