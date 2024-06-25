@extends('admin.master')

@section('title', 'Agregar Producto')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products') }}"><i class="fa fa-boxes"></i>Productos
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/product/add') }}"><i class="fa fa-boxes"></i>Agregar Producto
        </a>
    </li>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title">
                    <h2 class="title"><i class="fas fa-plus"></i>Agregar producto</h2>
                </h2>
                <div class="inside">
                    {!! Form::open(['url' => '/admin/product/add', 'files' => true]) !!}
                    <div class="row">

                        <!-- Campo nombre del producto -->
                        <div class="col-md-12">
                            <label for="title">Nombre del producto:</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="category">Categoria</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::select('category', $cats, 0, ['class' => 'form-select', 'id' => 'category', 'required']) !!}
                                {!! Form::hidden('subcategory_actual', 0, ['id' => 'subcategory_actual']) !!}

                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="subcategory">Subcategoria</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::select('subcategory', [], null, ['class' => 'form-select', 'id' => 'subcategory', 'required']) !!}
                            </div>
                        </div>

                    </div>

                    <div class="row mt16">


                        <div class="col-md-3">
                            <label for="indiscount">en oferta?</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::select('indiscount', ['0' => 'No', '1' => 'Si'], 0, ['class' => 'form-select']) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="discount">Descuento</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::number('discount', 0, ['class' => 'form-control', 'min' => '0', 'step' => 'any']) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="sku">SKU</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::number('sku', 0, ['class' => 'form-control', 'min' => '0', 'step' => 'any']) !!}
                            </div>
                        </div>

                        <div class="col-md-3">
                            <label for="name">Imagen destacada</label>
                            <div class="form-file">
                                {!! Form::file('img', ['class' => 'form-control', 'id' => 'customFile', 'accept' => 'image/*']) !!}
                            </div>
                        </div>
                    </div>


                    <div class="row mt16">
                        <div class="col-md-12">
                            <label for="content">Descripcion</label>
                            {!! Form::textarea('content', null, ['class' => 'form-control', 'id' => 'editor']) !!}
                        </div>
                    </div>

                    <div class="row mt16">
                        <div class="col-md-12">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
