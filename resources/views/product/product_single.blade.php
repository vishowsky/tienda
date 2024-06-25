@extends('master')

@section('title', $product->name)

@section('custom_meta')
<meta name="product_id" content="{{ $product->id }}">
@stop
@section('content')

<div class="product_single shadow-lg">
    <div class="inside">
        <div class="container">
            <div class="row">
                <div class="col-md-4 pleft0">
                    <div class="slick-slider">
                        <a data-fancybox="gallery" href="{{ url('/uploads/'.$product->file_path.'/'.$product->image) }}">
                        <div>
                            <img style="width: 100%" src="{{ url('/uploads/'.$product->file_path.'/'.$product->image) }}" class="img-fluid">
                        </div>
                    </a>
                        @if($product->getGallery->count() > 0)
                            @foreach($product->getGallery as $gallery)
                            <a data-fancybox="gallery" href="src={{ url('/uploads/'.$gallery->file_path.'/t_'.$gallery->file_name) }}" >
                            <div>
                                    <img style="width: 100%" src="{{ url('/uploads/'.$gallery->file_path.'/t_'.$gallery->file_name) }}" class="img-fluid" alt="">
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
                    <div class="category">
                        <ul>
                            <li>
                                <a href="{{ url('/')}}"><i class="fas fa-house-user">Inicio</i></a>
                            </li>
                            <li>
                                <span class="next"><i class="fas fa-chevron-right"></i></span>
                            </li>
                            <li>
                                <a href="{{ url('/store')}}"><i class="fas fa-store">Tienda</i></a>
                            </li>
                            <li>
                                <span class="next"><i class="fas fa-chevron-right"></i></span>
                            </li>
                            <li>
                                <a href="{{ url('/store')}}"><i class="fas fa-folder">@if($product->cat)
                                    {{ $product->cat->name }}
                                @else
                                    Sin categoría
                                @endif</i></a>
                            </li>
                            <li>
                                <span class="next"><i class="fas fa-chevron-right"></i></span>
                            </li>
                            <li>
                                <a href="{{ url('/store')}}"><i class="fas fa-store">@if($product->subcategory_id)
                                    {{ $product->getSubcategory->name }}
                                @else
                                    Sin subcategoría
                                @endif</i></a>
                            </li>
                        </ul>
                    </div>
                    <div class="add_cart">
                        {!! Form::open(['url' => '/cart/add']) !!}
                        {!! Form::hidden('inventory', null,['id' => 'field_inventory'])!!}
                        {!! Form::hidden('variant', null,['id' => 'field_variant']) !!}

                        <div class="row">
                        <div class="col-md-12">
                            <div  class="variants">
                                <ul id="inventory">
                                    @foreach($product->getInventory as $inventory)
                                    <li><a href="#" class="inventory" id="inventory_{{ $inventory->id }}" data-inventory-id="{{ $inventory->id }}">
                                        {{ $inventory->name }} {{ Config::get('tienda.currency') }} {{ number_format($inventory->price, 0, ',', '.') }}
                                    </a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <hr>
                            <div id="variants_div"class="variants hidden pt16 bt1 mt16">
                                <ul id="variants" >

                                </ul>
                            </div>

                            <hr>
                        </div>
                        </div>
                        <div class="before_quantity">
                        <h5 class="title">
                            cantidad
                        </h5>
                        <div class="row mt24">
                            <div class="col-md-4">
                                <div class="quantity">

                                 <a href="#" class="amount_action" data-action="minus"><i class="fas fa-minus"></i></a>
                                 {{ Form::number('quantity', 1, ['class' => 'form-control','min' => '1', 'id' => 'ad_to_cart_quantity']) }}

                                 <a href="#" class="amount_action" data-action="plus"><i class="fas fa-plus" ></i></a>
                                </div>
                            </div>
                            <div class="col-md-3">
                            <button type="submit" class="btn btn-success"><i class="fas fa-cart-plus"></i> Agregar al carro</button>
                            </div>
                        </div>
                        </div>
                        {!! Form::close()!!}
                    </div>
                    <div class="content">
                        {!! Parsedown::instance()->text($product->content) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

