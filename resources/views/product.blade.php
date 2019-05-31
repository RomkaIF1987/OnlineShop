@extends('layouts.app')

@section('content')
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <div class="col-lg-12">

                <div class="card mt-4">
                    <img class="card-img-top img-fluid" src="{{asset("storage/$product->image")}}"
                         alt="{{$product->name}}">
                    <div class="card-body">
                        <h3 class="card-title">{{$product->name}}</h3>
                        <h4>{{$product->price}}$/{{$product->unit}}</h4>
                        <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente dicta
                            fugit fugiat hic aliquam itaque facere, soluta. Totam id dolores, sint aperiam sequi
                            pariatur praesentium animi perspiciatis molestias iure, ducimus!</p>
                        <div class="col-sm-3">
                            <div class="rating-block">
                                <h4>Average user rating</h4>
                                <h2 class="bold padding-bottom-7">4.3
                                    <small>/ 5</small>
                                </h2>
                                <form class="form-group" action="rating/{{$product->id}}" method="post">
                                    @csrf
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="star-rating">
                                                    <span class="fa fa-star-o" data-rating="1"></span>
                                                    <span class="fa fa-star-o" data-rating="2"></span>
                                                    <span class="fa fa-star-o" data-rating="3"></span>
                                                    <span class="fa fa-star-o" data-rating="4"></span>
                                                    <span class="fa fa-star-o" data-rating="5"></span>
                                                    <input type="hidden" onChange="this.form.submit()" name="whatever1"
                                                           class="rating-value" value="data-rating">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        {{$product->stars}}.0 stars
                    </div>
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col-lg-9 -->

        </div>

    </div>
    <!-- /.container -->
@endsection
@section('script')
    <script src="../js/star-rating.js"></script>
@endsection

