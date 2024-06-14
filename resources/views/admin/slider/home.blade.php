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
            <div class="col-md-4">
                @if (kvfj(Auth::user()->permissions, 'slider_add'))
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title"><i class="fas fa-plus"></i>Agregar Elemento</h2>
                        </div>
                        <div class="inside">
                            {!! Form::open(['url' => '/admin/slider/add', 'files' => true]) !!}
                            <label for="name">Nombre</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>

                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            </div>

                            <label for="module" class="mt16">Visible</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::select('visible', [0 => 'no', '1' => 'si'], 1, ['class' => 'form-select']) !!}
                            </div>

                            <label for="img" class="mt16">Imagen Destacada</label>
                            <div class="form-file">
                                {!! Form::file('img', ['class' => 'form-control', 'id' => 'customFile', 'accept' => 'image/*']) !!}
                            </div>

                            <label for="name" class="mt16">Contendio</label>
                            <div class="input-group">


                                {!! Form::textarea('content', null, ['class' => 'form-control', 'rows' => '5']) !!}
                            </div>

                            <label for="name" class="mt16">Orden de aparicion</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>

                                {!! Form::number('orden', 0, ['class' => 'form-control', 'min', 'rows' => '3']) !!}
                            </div>

                            {!! Form::submit('Guardar', ['class' => 'btn btn-success mt16']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                @endif
            </div>

            <div class="col-md-8">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-plus"></i>Agregar Elemento</h2>
                    </div>
                    <div class="inside">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                    <td>

                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sliders as $slider)
                                    <tr>
                                        <td width="180"><img
                                                src="{{ url('/uploads/' . $slider->file_path . '/' . $slider->file_name) }}"
                                                alt="" class="img-fluid"></td>
                                        <td>{{ $slider->name }}</td>
                                        <td>{{ $slider->content }}</td>
                                        <td>
                                            <div class="opts">
                                                @if (kvfj(Auth::user()->permissions, 'slider_edit'))
                                                    <a href="{{ url('/admin/slider/' . $slider->id . '/edit') }}"
                                                        data-toggle="tooltip" data-placement="top" title="editar">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                @endif
                                                @if (kvfj(Auth::user()->permissions, 'slider_delete'))
                                                    <a href="#" data-path="admin/slider"
                                                        data-action="delete" data-object="{{$slider->id }}"
                                                        class="btn-deleted" data-toggle="tooltip" data-placement="top" title="eliminar">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
