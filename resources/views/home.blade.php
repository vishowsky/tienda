@extends('master')

@section('title' , 'inicio')

@section('content')
<section >
        <div class="home_action_bar shadow">
        <div class="row">
            <div class="col-md-3">
                <div class="categories" style="z-index: 9999">
                    <a href="">Categorias</a>
                    <ul class="shadow">
                        @foreach ($categories as $category)
                            <li>

                                <a href="{{ url('/store/category/'.$category->id.'/'.$category->slug) }}">
                                    <img src="{{ url('/uploads/'.$category->file_path.'/'.$category->icono) }}" alt="">
                                    {{ $category->name}}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

            </div>
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
</section>
<section>
    @include('components/sliders_home')
</section>
    @endsection

