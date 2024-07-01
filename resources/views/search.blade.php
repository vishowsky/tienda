@extends('master')

@section('title', 'Busqueda')

@section('custom_meta')

@section('content')
    <div class="store mt32">
        <div class="row">
            <div class="col-md-3">
                <div class="categories_list shadow">
                    <h2 href="#" class="title"><i class="fas fa-stream"></i>Categorias</h2>

                </div>
            </div>
            <div class="col-md-9">
                <div class="home_action_bar nomargen shadow">
                    <div class="row">

                        <div class="col-md-9">
                            {!! Form::open(['url' => '/search']) !!}
                            <div class="input-group">

                                <i class="fas fa-search"></i>

                                {!! Form::text('search_query', null, ['class' => 'form-control', 'required']) !!}
                                <button class="btn " type="submit" id="button-addon2">Buscar</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
                <div class="store_white mt32">
                    <section>
                        <h2 class="home_title mt32">
                            Resultados para: {{ $query }}
                        </h2>
                        <div class="products_list" id="products_list">
                            @foreach ($products as $product)
                            <div class="product">
                                <div class="image">
                                    <div class="overlay">
                                        <div class="btns">
                                            <a href="{{ url('/product/'.$product->id.'/'.$product->slug) }}"><i class="fas fa-eye"></i></a>
                                            <a href="#" data-bs-title="Agregar al carro"><i class="fa-solid fa-cart-shopping"></i></a>
                                            @if(Auth::check())
                                            <a href="#" id="favorite_1_{{$product->id}}" onclick="add_to_favorites('{{ $product->id}}'); return false;" data-bs-title="Agregar a favoritos"><i class="fa-regular fa-heart"></i></a>"
                                            @else
                                            <a href="#" id="favorite_1_{{$product->id}}" onclick="add_to_favorites('{{ $product->id}}'); return false;" data-bs-title="Agregar a favoritos"><i class="fa-regular fa-heart"></i></a>"
                                            @endif
                                        </div>
                                    </div>
                                    <img src="{{ url('/uploads/' . $product->file_path . '/t_' . $product->image) }}"
                                        alt="">

                                </div>
                                <a href="{{ url('/product/'.$product->id.'/'.$product->slug) }}">
                                    <div class="title">{{ $product->name }}</div>
                                    <div class="price">{{ Config::get('tienda.currency') }} {{ $product->price}}</div>
                                </a>
                            </div>
                        @endforeach

                        </div>


                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
