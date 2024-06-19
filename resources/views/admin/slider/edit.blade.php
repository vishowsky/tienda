@extends('admin.master')

@section('title', 'Modulo de Carrusel')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products') }}"><i class="far fa-images"></i>Carrusel
        </a>
    </li>
    {{-- <li class="breadcrumb-item">
        <a href="{{ url('/admin/product/add') }}"><i class="fa fa-boxes"></i>Agregar Producto
        </a>
    </li> --}}
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                @if (kvfj(Auth::user()->permissions, 'slider_edit'))
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="far fa-edit"></i> Editar Elemento</h2>
                        </div>
                        <div class="inside">
                            {!! Form::open(['url' => '/admin/slider/'.$slider->id.'/edit'])!!}
                            <label for="name">Nombre</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>

                                {!! Form::text('name', $slider->name, ['class' => 'form-control']) !!}
                            </div>

                            <label for="module" class="mt16">Visible</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::select('visible', [0 => 'no', '1' => 'si'], $slider->status, ['class' => 'form-select']) !!}
                            </div>

                            <label for="img" class="mt16">Imagen Destacada</label>
                            <div class="col-md-4">
                                <img  src="{{ url('/uploads/' . $slider->file_path . '/' . $slider->file_name) }}"
                                class="img-fluid" alt="">
                            </div>


                            {{--<div class="form-file">
                                {!! Form::file('img', ['class' => 'form-control', 'id' => 'customFile', 'accept' => 'image/*']) !!}
                            </div>--}}


                            <label for="name" class="mt16">Contendio</label>
                            <div class="input-group">
                                {!! Form::textarea('content', $slider->content, ['class' => 'form-control', 'rows' => '5']) !!}
                            </div>

                            <label for="name" class="mt16">Orden de aparicion</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>

                                {!! Form::number('orden', $slider->orden, ['class' => 'form-control', 'min', 'rows' => '3']) !!}
                            </div>
                            {!! Form::submit('Guardar', ['class' => 'btn btn-success mt16']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                @endif
            </div>

        </div>
    </div>
@endsection
