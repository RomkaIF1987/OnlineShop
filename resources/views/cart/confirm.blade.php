@extends('layouts.app')
@section('content')
    <div class="row ml-5">
        <h2>Your order is successful accepted</h2>
    </div>
    <div class="table">
        <table style="width: 60%;">
            <tr>
                <th>Items</th>
                <th>Product name</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>

            @foreach($orders->orderItems as $orderItem)
                <tr>
                    <td>{{$i++}}</td>
                    <td>{{$orderItem->menuItems->name}}</td>
                    <td>{{$orderItem->quantity}}</td>
                    <td>${{$orderItem->sum}}</td>
                </tr>
            @endforeach
        </table>
    </div>
    <div class="row">
        <div class="col-md-6">
            <strong><h2> Total: {{$orders->sum}}$</h2></strong>
        </div>
    </div>
@endsection