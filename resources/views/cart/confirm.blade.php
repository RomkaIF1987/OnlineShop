@extends('layouts.app')
@section('content')
    <div class="container">
        <table id="cart" class="table table-hover table-condensed">
            <thead>
            <tr>
                <th style="width:22%">Product</th>
                <th style="width:15%">Price</th>
                <th style="width:8%">Quantity</th>
                <th style="width:15%" class="text-center">Subtotal</th>
            </tr>
            </thead>
            <tbody>
            @foreach($orders->orderItems as $orderItem)
                <tr>
                    <td data-th="Product">
                        <div class="row">
                            <div class="col-sm-10">
                                <h4 class="nomargin">{{$orderItem->menuItems->name}}</h4>
                            </div>
                        </div>
                    </td>
                    <td data-th="Price">${{$orderItem->sum}}</td>
                    <td data-th="Quantity">{{$orderItem->quantity}}</td>
                    <td data-th="Subtotal" class="text-center">${{$orderItem->sum}}</td>
                </tr>
            @endforeach
            </tbody>
            <tfoot>
            <tr class="visible-xs">
                <td></td>
                <td></td>
                <td class="text-right"><strong>Total price:
                        ${{$orders->sum}}</strong></td>
                <td></td>
            </tr>
            <tr>
                <td><a href="{{route('home.page')}}" class="btn btn-warning"><i class="fa fa-angle-left"></i>
                        Continue Shopping</a></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            </tfoot>
        </table>
    </div>
@endsection