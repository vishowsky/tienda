@extends('master')

@section('title', $product->name)

@section('content')

<div class="product_single">
    <div class="container">
        <div class="row">
            <div class="col-md-4 pleft0">
                <div class="slick-slider">
                    <a data-fancybox="gallery" href="{{ url('/uploads/'.$product->file_path.'/'.$product->image) }}">
                    <div>
                        <img src="{{ url('/uploads/'.$product->file_path.'/'.$product->image) }}" class="img-fluid">
                    </div>
                </a>
                    @if($product->getGallery->count() > 0)
                        @foreach($product->getGallery as $gallery)
                        <a data-fancybox="gallery" href="src={{ url('/uploads/'.$gallery->file_path.'/t_'.$gallery->file_name) }}" >
                        <div>
                                <img src="{{ url('/uploads/'.$gallery->file_path.'/t_'.$gallery->file_name) }}" class="img-fluid" alt="">
                            </div>
                        </a>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="col-md-8">
                <h2 class="title">
                    {{ $product->name }}
                </h2>
            </div>
        </div>
    </div>
</div>

@endsection
