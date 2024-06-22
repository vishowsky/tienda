@extends('admin.master')

@section('title','Agregar Producto')
@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('/admin/products') }}"><i class="fa fa-boxes"></i>Categorias
    </a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-3">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-plus"></i>Agregar Categoria</h2>
                </div>
                <div class="inside">
                    @if(kvfj(Auth::user()->permissions,'category_add'))
                    {!! Form::open(['url' => '/admin/category/add/'.$module, 'files' => true]) !!}
                    <label for="name">Nombre</label>
                    <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i>
                            </span>

                        {!! Form::text('name',null, ['class'=>'form-control']) !!}
                    </div>

                    <label for="module" class="mt16">Categoria padre</label>
                    <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i>
                            </span>
                            <select name="parent" id="" class="form-select">
                                <option value="0">Sin Categoria</option>
                                @foreach($cats as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name}}</option>
                                @endforeach
                            </select>
                        </div>

                    <label for="module" class="mt16">Modulo</label>
                    <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i>
                            </span>
                        {!! Form::select('module',getModulesArray(), $module, ['class' => 'form-select', 'disabled']) !!}
                    </div>

                    <label for="icon" class="mt16">Icono</label>
                    <div class="form-file">
                        {!! Form::file('icon', ['class' => 'form-control', 'required' ,'id' => 'customFile', 'accept' => 'image/*']) !!}
                    </div>


                    {!! Form::submit('Guardar', ['class' => 'btn btn-success mt16']) !!}
                    {!! Form::close() !!}
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-plus"></i>Categorias</h2>
                </div>
                <div class="inside">
                    <nav class="nav nav-pills nav-fill">
                        @foreach(getModulesArray() as $m =>$k)
                        <a href="{{ url('/admin/categories/'.$m) }}" class="nav-link"> {{ $k }}</a>
                        @endforeach
                    </nav>
                    <table class="table mt16">
                        <thead>
                            <tr>
                                <td width="64px"></td>
                                <td>Nombre</td>
                                <td width="160px"></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cats as $cat)
                            <tr>
                                <td> <img src="{{ url('/uploads/'.$cat->file_path.'/'.$cat->icono) }}" alt="" class="img-fluid"></td>
                                <td>{{ $cat->name }}</td>
                                <td>
                                    <div class="options">
                                        @if(kvfj(Auth::user()->permissions,'category_edit'))
                                        <a href="{{ url('/admin/category/'.$cat->id.'/edit')}}" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                        <a href="{{ url('/admin/category/'.$cat->id.'/subs')}}" data-toggle="tooltip" data-placement="top" title="Subcategorias"><i class="fas fa-list-ul"></i></a>
                                        @endif
                                        @if(kvfj(Auth::user()->permissions,'category_delete'))
                                        <a href="{{ url('/admin/category/'.$cat->id.'/delete')}}" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a>
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
