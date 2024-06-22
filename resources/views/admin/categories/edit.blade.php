@extends('admin.master')

@section('title', 'Agregar Producto')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/categories/0') }}"><i class="fa fa-boxes"></i>Categorias
        </a>
    </li>
@if($cat->parent != "0")
<li class="breadcrumb-item">
    <a href="{{ url('/admin/category/'.$cat->parent.'/subs') }}"><i class="fa fa-folder-open"></i>{{ $cat->getParent->name }}
    </a>
</li>

@else
@endif

<li class="breadcrumb-item">
    <a href="{{ url('/admin/category/'.$cat->id.'/edit') }}"><i class="fa fa-folder-open"></i>{{ $cat->name }}
    </a>
</li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-plus"></i>Editar Categoria</h2>
                    </div>
                    <div class="inside">
                        {!! Form::open(['url' => '/admin/category/' . $cat->id . '/edit', 'files' => true]) !!}
                        <label for="name">Nombre</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i>
                            </span>
                            {!! Form::text('name', $cat->name, ['class' => 'form-control']) !!}
                        </div>

                        {{-- <label for="module" class="mt16">Modulo</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i>
                            </span>
                            {!! Form::select('module', getModulesArray(), $cat->module, ['class' => 'form-select']) !!}
                        </div> --}}

                        <label for="icon" class="mt16">Icono</label>
                        <div class="form-file">
                            {!! Form::file('icon', ['class' => 'form-control' ,'id' => 'customFile', 'accept' => 'image/*']) !!}
                        </div>

                        <label for="name" class="mt16">Orden</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i>
                            </span>
                            {!! Form::number('order', $cat->order, ['class' => 'form-control']) !!}
                        </div>

                        {!! Form::submit('Guardar', ['class' => 'btn btn-success mt16']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            @if(!is_null($cat->icono))
            <div class="col-md-3">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-plus"></i>Previsualizacion</h2>
                    </div>
                    <div class="inside">
                        <img src="{{ url('/uploads/'.$cat->file_path.'/'.$cat->icono) }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection
