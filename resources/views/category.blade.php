@extends('master')

@section('title', 'Tienda - '.$category->name)
@section('custom_meta')
<meta name="category_id" content="{{ $category->id }}">
@stop
@section('content')
    <div class="store mt32">
        <div class="row">
            <div class="col-md-3">
                <div class="categories_list shadow">
                    <h2 href="#" class="title"><i class="fas fa-stream"></i>{{ $category->name}}</h2>
                    <ul>
                        @if($category->parent != "0")
                        <li><a href="{{ url('/store/category/'.$category->getParent->id.'/'.$category->getParent->slug) }}">Regresar a {{ $category->getParent->name }}</a></li>
                        @endif
                        @if($category->parent == "0")
                        <li><a href="{{ url('/store/category/'.$category->id.'/'.$category->slug) }}">Regresar a {{ $category->name }}</a></li>
                        @endif
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
                           {{ $category->name }}
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
