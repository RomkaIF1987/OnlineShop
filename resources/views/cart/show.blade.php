@extends('layouts.app')
@section('content')
    @if(Session::has('cart'))
        <div class="container">
            <table id="cart" class="table table-hover table-condensed">
                <thead>
                <tr>
                    <th style="width:22%">Product</th>
                    <th style="width:15%">Price</th>
                    <th style="width:8%">Quantity</th>
                    <th style="width:15%" class="text-center">Subtotal</th>
                    <th style="width:9%">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($carts as $cart)
                    <tr>
                        <td data-th="Product">
                            <div class="row">
                                    <h4 class="nomargin">{{$cart['item']['name']}}</h4>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">${{$cart['item']['price']}}</td>
                        <td data-th="Quantity">{{$cart['qty']}}
                            {{--<input type="number" class="form-control text-center" value="1">--}}
                        </td>
                        <td data-th="Subtotal" class="text-center">${{$cart['price']}}</td>
        <td class="actions d-inline-flex" data-th="Action">
                            <a href="{{route('reduceByOneCart', ['id' => $cart['item']['id']])}}"
                               class="btn btn-info btn-sm">Delete One</a>
                            <a href="{{route('removeItemCart', ['id' => $cart['item']['id']])}}"
                               class="btn btn-danger btn-sm">Delete All</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr class="visible-xs">
                    <td></td>
                    <td></td>
                    <td></td>
                    <td class="text-right"><strong>Total price:
                            ${{Session::has('cart') ? Session::get('cart')->totalPrice : ''}}</strong></td>
                    <td></td>
                </tr>
                <tr>
                    <td class="text-center"><strong><h2>Choose delivery method</h2></strong></td>
                    <td></td>
                    <td></td>
                    <td class="text-center"><strong><h2>Your account</h2></strong></td>
                    <td></td>
                    <form action="{{route('orders.store')}}" method="POST">
                @csrf
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input prc" type="radio" name="delivery" id="Radios1" value="0"
                                   required>
                            <label class="form-check-label" for="exampleRadios1">
                                Pick UP (USD 0)
                            </label>
                        </div>
                    </td>
                    <td class="text-left">Product price: <br> Delivery: <br> <strong>Total price: </strong></td>
                    <td>${{Session::has('cart') ? Session::get('cart')->totalPrice : ''}} <br> $0 <br>
                        ${{Session::has('cart') ? Session::get('cart')->totalPrice : ''}} </td>
                    <td class="text-left">Account: <br> Spent: <br> <strong>Balance: </strong></td>
                    <td> ${{$user->money}} <br> -${{Session::has('cart') ? Session::get('cart')->totalPrice : ''}} <br>
                        ${{Session::has('cart') ? $user->money - Session::get('cart')->totalPrice : ''}} </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input prc" type="radio" name="delivery" id="Radios2" value="5"
                                   required>
                            <label class="form-check-label" for="exampleRadios2">
                                UPS (USD 5)
                            </label>
                        </div>
                        <input type="hidden" name="user_id" value="{{$user->id}}">
                        <input type="hidden" name="user_name" value="{{$user->name}}">
                        <input type="hidden" name="sum" value="{{$totalPrice}}">
                        <input type="hidden" name="itemOrders" value="{{json_encode($itemOrders)}}">
                    </td>
                    <td class="text-left">Product price: <br> Delivery: <br> <strong>Total price: </strong></td>
                    <td>${{Session::has('cart') ? Session::get('cart')->totalPrice : ''}} <br> $5 <br>
                        ${{Session::has('cart') ? Session::get('cart')->totalPrice + 5 : ''}} </td>
                    <td class="text-left">Account: <br> Spent: <br> <strong>Balance: </strong></td>
                    <td> ${{$user->money}} <br> -${{Session::has('cart') ? Session::get('cart')->totalPrice + 5 : ''}}
                        <br>
                        ${{Session::has('cart') ? $user->money - Session::get('cart')->totalPrice - 5 : ''}} </td>
                </tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <button type="submit" class="btn btn-success btn-block"><i
                                class="fa fa-angle-right">Accept</i></button>
                </td>
                </form>
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
    @else
        <div class="row ml-5">
            <h2>No Items in a Cart</h2>
        </div>
    @endif
@endsection
