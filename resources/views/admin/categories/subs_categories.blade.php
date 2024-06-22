@extends('admin.master')

@section('title','Agregar Producto')
@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('/admin/categories/0') }}"><i class="fa fa-boxes"></i>Categorias
    </a>
</li>
<li class="breadcrumb-item">
    <a href="{{ url('/admin/products') }}"><i class="fa fa-boxes"></i>Sub Categorias de {{ $category->name}}
    </a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="fas fa-plus"></i>Sub Categorias de {{ $category->name}}</h2>
                </div>
                <div class="inside">
                   <table class="table mt16">
                        <thead>
                            <tr>
                                <td width="64px"></td>
                                <td>Nombre</td>
                                <td width="140px"></td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($category->getSubCategories as $cat)
                            <tr>
                                <td> <img src="{{ url('/uploads/'.$cat->file_path.'/'.$cat->icono) }}" alt="" class="img-fluid"></td>
                                <td>{{ $cat->name }}</td>
                                <td>
                                    <div class="options">
                                        @if(kvfj(Auth::user()->permissions,'category_edit'))
                                        <a href="{{ url('/admin/category/'.$cat->id.'/edit')}}" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
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
