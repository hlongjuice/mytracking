@extends('site.layouts.master_left_sidebar')
@section('content')
    <div class="row">
        @foreach($products as $product)
        <div class="col-xs-6 col-md-4">
            <div class="product">
                <div class="flip-container">
                    <div class="flipper">
                        <div class="front">
                            <a href="detail.html">
                                <img src="img/product2.jpg" alt="" class="img-responsive">
                            </a>
                        </div>
                        <div class="back">
                            <a href="detail.html">
                                <img src="img/product2_2.jpg" alt="" class="img-responsive">
                            </a>
                        </div>
                    </div>
                </div>
                <a href="detail.html" class="invisible">
                    <img src="img/product2.jpg" alt="" class="img-responsive">
                </a>
                <div class="text">
                    <h3><a href="detail.html">White Blouse Armani</a></h3>
                    <p class="price"><del>$280</del> $143.00</p>
                    <p class="buttons">
                        <a href="detail.html" class="btn btn-default">View detail</a>
                        <a href="basket.html" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                    </p>
                </div>
                <!-- /.text -->

                <div class="ribbon sale">
                    <div class="theribbon">SALE</div>
                    <div class="ribbon-background"></div>
                </div>
                <!-- /.ribbon -->

                <div class="ribbon new">
                    <div class="theribbon">NEW</div>
                    <div class="ribbon-background"></div>
                </div>
                <!-- /.ribbon -->

                <div class="ribbon gift">
                    <div class="theribbon">GIFT</div>
                    <div class="ribbon-background"></div>
                </div>
                <!-- /.ribbon -->
            </div>
        </div>
        @endforeach
    </div>
    @endsection
