@extends('master')

@section('title', 'Tienda')

@section('custom_meta')

@section('content')
    <div class="store mt32">
        <div class="row">
            <div class="col-md-3">
                <div class="categories_list shadow">
                    <h2 href="#" class="title"><i class="fas fa-stream"></i>Categorias</h2>
                    <ul>
                        @foreach ($categories as $category)
                            <li>

                                <a href="{{ url('/store/category/'.$category->id.'/'.$category->slug) }}"> <img
                                        src="{{ url('/uploads/' . $category->file_path . '/' . $category->icono) }}"
                                        alt=""> {{ $category->name }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-9">
                <div class="store_white">
                    <section>
                        <h2 class="home_title mt32">
                            Ultimos productos
                        </h2>
                        <div class="products_list" id="products_list"></div>

                        <div class="load_more_products">
                            <a href="#" id="load_more_products">Cargar mas productos</a>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
@endsection
