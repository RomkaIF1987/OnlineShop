@extends('layouts.app')
@section('content')
    @if(Session::has('cart'))
        <div class="container">
            <table id="cart" class="table table-hover table-condensed">
                <thead>
                <tr>
                    <th style="width:30%">Product</th>
                    <th style="width:8%">Price</th>
                    <th style="width:6%">Quantity</th>
                    <th style="width:18%" class="text-center">Subtotal</th>
                    <th style="width:7%">Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($carts as $cart)
                    <tr>
                        <td data-th="Product">
                            <div class="row">
                                <div class="col-sm-2 hidden-xs"><img
                                            src={{asset("storage/")}}/{{$cart['item']['image']}} alt="..."
                                            class="img-responsive"/></div>
                                <div class="col-sm-10">
                                    <h4 class="nomargin">{{$cart['item']['name']}}</h4>
                                    <p>Quis aute iure reprehenderit in voluptate velit esse cillum dolore eu fugiat
                                        nulla
                                        pariatur. Lorem ipsum dolor sit amet.</p>
                                </div>
                            </div>
                        </td>
                        <td data-th="Price">${{$cart['item']['price']}}</td>
                        <td data-th="Quantity">{{$cart['qty']}}
                            {{--<input type="number" class="form-control text-center" value="1">--}}
                        </td>
                        <td data-th="Subtotal" class="text-center">${{$cart['price']}}</td>
                        <td class="actions d-inline-flex" data-th="">
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
                    <td class="text-center"><strong>Total
                            ${{Session::has('cart') ? Session::get('cart')->totalPrice : ''}}</strong></td>
                </tr>
                <tr>
                    <td class="text-center"><strong>Delivery method</strong></td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input prc" type="radio" name="exampleRadios" id="Radios1" value="0"
                                   required>
                            <label class="form-check-label" for="exampleRadios1">
                                Pick UP (0 USD)
                            </label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input prc" type="radio" name="exampleRadios" id="Radios2" value="5"
                                   required>
                            <label class="form-check-label" for="exampleRadios2">
                                UPS (USD 5)
                            </label>
                        </div>
                    </td>

                </tr>
                <tr>
                    <td><a href="{{route('home.page')}}" class="btn btn-warning"><i class="fa fa-angle-left"></i>
                            Continue Shopping</a></td>
                    <td colspan="2" class="hidden-xs"></td>
                    <td class="hidden-xs text-center"><strong>
                            <output id="total" data-f>Total</output>
                        </strong></td>
                    <td>
                        <form action="{{route('orders.store')}}" method="POST">
                            @csrf
                            <input type="hidden" name="user_id" value="{{$user->id}}">
                            <input type="hidden" name="user_name" value="{{$user->name}}">
                            <input type="hidden" name="sum" value="{{$totalPrice}}">
                            <input type="hidden" name="itemOrders" value="{{json_encode($itemOrders)}}">
                            <button type="submit" class="btn btn-success btn-block">Checkout <i
                                        class="fa fa-angle-right"></i></button>
                        </form>
                    </td>
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

@section('script')
    <script>
        $('#form-check').on('input', '.prc', function () {
            var totalSum = 0;
            $('.form-check .prc').each(function () {
                var inputVal = $(this).val();
                if ($.isNumeric(inputVal)) {
                    totalSum += parseFloat(inputVal);
                }
            });
            $('#result').text(totalSum);
        })
    </script>
@endsection