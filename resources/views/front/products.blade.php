@extends('layouts/nav')
@section('content')
<section class="services1 cid-rSHipPxh3m" id="services1-5">

    <div class="container">
        <div class="media-container-row">
            @foreach($products_data as $item)
            <div class="card p-3 col-12 col-md-6 col-lg-4">
                <div class="card-wrapper">
                    <div class="card-img">
                        <img src="{{$item->img}}" alt="Mobirise">
                    </div>
                    <div class="card-box">
                        <h4 class="card-title mbr-fonts-style display-7">
                            {{$item->type}}
                        </h4>
                        <p class="mbr-text mbr-fonts-style display-7">
                            {!!$item->content!!}
                        </p>
                    </div>
                    <div class="mbr-section-btn text-center">
                        <a href="/news_detail/{{$item->id}}" class="btn btn-primary display-4">
                            Learn More
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

        </div>
    </div>

</section>
@endsection
