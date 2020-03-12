@extends('layouts/nav')
@section('css')
<style>
    .product-card {
        width: 606px;
        min-height: 500px;
        box-sizing: border-box;
        padding: 48px 48px 40px;
        margin-bottom: 60px;
        background: #fafafa;
    }

    .product-info {
        border-bottom: 1px solid #eee;
        padding-top: 20px;
        padding-bottom: 20px
    }

    .product-name {
        width: 100%;
        font-size: 40px;
        font-weight: 400;
        line-height: 48px;
        color: #000;
        margin: 0;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .product-title {
        font-size: 20px;
        line-height: 24px;
        color: #757575;

    }

    .product-sub-title {
        color: #ff6700;
        font-weight: 400;
    }

    .product-tip {
        border-bottom: 1px solid #eee;
        padding-top: 20px;
        padding-bottom: 20px;
    }

    .product-capacity .span {
        font-size: 20px;
        line-height: 24px;
        font-weight: 400;
        color: #757575;
        margin-top: 30px;
        margin-bottom: 20px;
    }


    .product-card .color {
        padding: 10px 20px;
        width: 160px;
        min-height: 58px;
        height: 100%;
        font-size: 16px;
        line-height: 20px;
        color: #757575;
        text-align: center;
        border: 1px solid #eee;
        background-color: #fff;
        -webkit-user-select: none;
        -ms-user-select: none;
        user-select: none;
        transition: opacity, border .2s linear;
        cursor: pointer;
    }

    .product-card .active {
        color: #424242;
        border-color: #ff6700;
        transition: opacity, border .2s linear;

    }
</style>
@endsection
@section('content')

<section class="features3 cid-rRF3umTBWU" id="features3-7" style="padding:100px">
    <div class="container">
        <div class="row">
            <div class="col-6"></div>
            <div class="col-6">
                <div class="product-card">
                    <div class="product-info">
                        <div class="product-name">
                            小米9T Pro
                        </div>
                        <div class="product-title">
                            8GB+256GB, 火焰紅
                        </div>
                        <div class="product-sub-title">
                            NT$12,999
                        </div>
                    </div>
                    <div class="product-tip">
                        icon雙倍該商品可享受雙倍積分
                    </div>
                    <div class="product-capacity">
                        <span>容量</span>
                        <div class="color">8GB+256GB</div>
                    </div>
                    <div class="product-color">
                        <span>顏色</span>
                        <div class="row">
                            <div class="col-4">
                                <div class="color active" data-color="紅">紅</div>
                            </div>
                            <div class="col-4">
                                <div class="color" data-color="黃">黃</div>
                            </div>
                            <div class="col-4">
                                <div class="color" data-color="藍">藍</div>
                            </div>
                            <div class="col-4">
                                <div class="color">綠</div>
                            </div>
                        </div>
                    </div>
                    <form action="" method="POST">
                        @csrf
                            <div class="product-qty">
                                數量
                                <a id="minus" href="#">-</a>
                                <input type="number" value="1" id="qty" min>
                                <a id="plus" href="#">+</a>
                            </div>
                            <div class="product-total">
                                <div>
                                    <span>小米9T Pro</span>
                                    <span>火焰紅</span>
                                    <span>8GB+256GB</span>* <span>1</span>
                                    NT$12,999
                                </div>
                            </div>
                            <input type="text" name="capacity" id="capacity">
                            <input type="text" name="color" id="color" value="id"><br>
                            <button>立即購買</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('js')
<script>

    $('.product-card.color').click(function(){

        //改變長相
        $('.product-card .color').removeClass("active");
        $(this),addClass("active");


        var color = $(this).attr("data-color");
        $('#color').val(color);

    });

    $(function(){
        var valueElement = $('#qty');
        function incrementValue(e){
            var now_number = $('#qty').val();
            var new_number = Math.max(e.data.increment + parseInt(now_number) , 0);
            $('#qty').val(new_number);

            return false;
        }

        $('#plus').bind('click', {increment: 1}, incrementValue);
        $('#minus').bind('click', {increment: -1}, incrementValue);

    });

</script>
@endsection
