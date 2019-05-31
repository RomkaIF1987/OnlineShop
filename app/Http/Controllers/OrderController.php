<?php

namespace App\Http\Controllers;

use App\Classes\OrderItems;
use App\Classes\Order;
use App\Http\Requests\OrderTableRequest;
use App\User;
use Illuminate\Support\Facades\Auth;
use Session;
use DB;

class OrderController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param OrderTableRequest $request
     * @param User $user
     * @return void
     */
    public function store(OrderTableRequest $request)
    {

        $params = $request->validated();
        $orderItemsParams['itemOrders'] = $params['itemOrders'];
        $params['sum'] += $params['delivery'];
        unset($params['itemOrders']);

        $order = Order::create($params);

        $orderItemsParams = json_decode($orderItemsParams['itemOrders'], true);

        foreach ($orderItemsParams as $orderItemsParam) {

            $orderItemsParam['order_id'] = $order->id;
            OrderItems::create($orderItemsParam);
        }

        DB::table('users')->where('id', $params['user_id'])->update(['money' => Auth::user()->money - $params['sum']]);

        Session::forget('cart');

        return redirect()->route('cartConfirm', ['order_id' => $order->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('manager.show', [
            'orders' => Order::find($id),
            'i' => 1,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Order $order)
    {
        $order->delete();
        $order->orderItems()->whereIn('order_id', $order)->delete();
        return back();
    }
}
