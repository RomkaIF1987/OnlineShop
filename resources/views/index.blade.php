@extends('layouts.app')

@section('content')
    @if(Session::has('cart'))
        <div class="container">
            <div class="shopping-cart" id="shopcart">
                <ul class="shopping-cart-items">
                    @foreach($carts as $cart)
                        <li class="clearfix shopping-cart-itemsli">
                            <img class="shopping-cart-itemsimg" width="40%"
                                 src="{{asset("storage/")}}/{{$cart['item']['image']}}" alt="item1"/>
                            <span class="item-name">{{$cart['item']['name']}}</span>
                            <span class="item-price">Price: ${{$cart['price']}}</span>
                            <span class="item-quantity">Quantity: {{$cart['qty']}}</span><br>
                        </li>
                    @endforeach
                </ul>
                <div class="shopping-cart-header">
                    <div class="shopping-cart-total">
                        <span class="lighter-text">Total:</span>
                        <span class="main-color-text">${{Session::has('cart') ? Session::get('cart')->totalPrice : ''}}</span>
                    </div>
                </div> <!--end shopping-cart-header -->
                <a href="{{route('cartShow')}}" class="button">Checkout</a>
            </div> <!--end shopping-cart -->
        </div> <!--end container -->
    @endif
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                <div id="carouselExampleIndicators" class="carousel slide my-4 align-content-center"
                     data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($products as $product)
                            <li data-target="#carouselExampleIndicators" data-slide-to="{{$product->id}}"
                                class="{{$product->carousel}}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        @foreach($products as $product)
                            <div class="carousel-item {{$product->carousel}}">
                                <img class="d-block img-fluid" src="{{asset("storage/$product->image")}}"
                                     alt="Slide">
                                <div class="mask rgba-black-light"></div>
                            </div>
                        @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>

                <div class="row">
                    @foreach($products as $product)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="card h-100">
                                <a href="{{route('products.show', ['product' => $product->id])}}"><img
                                            class="card-img-top" src="{{asset("storage/$product->image")}}" alt=""></a>
                                <div class="card-body">
                                    <h4 class="card-title">
                                        <a href="{{route('products.show', ['product' => $product->id])}}">{{$product->name}}</a>
                                    </h4>
                                    <h5>{{$product->price}}$/{{$product->unit}}</h5>
                                </div>
                                <div class="card-footer">
                                    <small class="text-muted">&#9733; &#9733; &#9733; &#9733; &#9734;</small>
                                    @auth()
                                        <a href="{{route('addToCart', ['id' => $product->id])}}" type="button"
                                           class="btn btn-primary float-right">Buy</a>
                                    @endauth
                                    @guest()
                                        <a href="{{ route('login') }}" type="button" class="btn
                                            btn-secondary float-right">Buy</a>
                                    @endguest
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
                <!-- /.row -->

            </div>
            <!-- /.col-lg-9 -->

        </div>
        <!-- /.row -->

    </div>
    <!-- /.container -->
@endsection
