@extends('admin.master')

@section('title', 'Editar Producto')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products/all') }}"><i class="fa fa-boxes"></i>Productos
        </a>
    </li>

    <li class="breadcrumb-item">
        <a href="{{ url('/admin/product/' . $inventory->getProduct->id . '/edit') }}"><i class="fa fa-boxes"></i>
            {{ $inventory->getProduct->name }}
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/product/' . $inventory->getProduct->id . '/inventory') }}"><i class="fa fa-boxes"></i>
            inventario
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/product/inventory/' . $inventory->id . '/edit') }}"><i class="fa fa-boxes"></i>
            {{ $inventory->name }}
        </a>
    </li>
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title">
                            <h2 class="title"><i class="far fa-edit"></i>Editar inventario</h2>
                        </h2>
                        <div class="inside">
                            {!! Form::open(['url' => '/admin/product/inventory/' . $inventory->id . '/edit']) !!}
                            <label for="name">Nombre</label>
                            <div class="input-group">
                                <span class="input-group-text" id=basic-addon1>
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::text('name', $inventory->name, ['class' => 'form-control']) !!}
                            </div>

                            <label class="mt16" for="quantity">Cantidad en Inventario</label>
                            <div class="input-group">
                                <span class="input-group-text" id=basic-addon1>
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::number('quantity', $inventory->quantity, ['class' => 'form-control', 'min' => '1']) !!}
                            </div>

                            <label class="mt16" for="price">Precio</label>
                            <div class="input-group">
                                <span class="input-group-text" id=basic-addon1>
                                    {{ config('tienda.currency') }}
                                </span>
                                {!! Form::number('price', $inventory->price, ['class' => 'form-control', 'min' => '1', 'step' => 'any']) !!}
                            </div>

                            <label class="mt16" for="limited">Stock</label>
                            <div class="input-group">
                                <span class="input-group-text" id=basic-addon1>
                                    {{ config('tienda.currency') }}
                                </span>
                                {!! Form::select('limited', ['0' => 'Limitado', '1' => 'Ilimitado'], $inventory->limited, [
                                    'class' => 'form-select',
                                ]) !!}
                            </div>

                            <label class="mt16" for="minimum">Inventario minimo</label>
                            <div class="input-group">
                                <span class="input-group-text" id=basic-addon1>
                                    {{ config('tienda.currency') }}
                                </span>
                                {!! Form::number('minimum', $inventory->minimum, ['class' => 'form-control', 'min' => '1']) !!}
                            </div>
                            {!! Form::submit('Guardar', ['class' => 'btn btn-success mt16']) !!}
                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title">Variantes</h2>
                    </div>

                    {!! Form::open(['url' => '/admin/product/inventory/' . $inventory->id . '/variant']) !!}
                    <div class="row mt16">
                        <div class="col-md-6 ">
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Nombre de la variante']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}

                    <div class="inside">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Nombre</td>


                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($inventory->getVariants as $variant)
                                    <tr>
                                        <td>{{ $variant->id }}</td>
                                        <td>{{ $variant->name }}</td>
                                        <td>
                                            <div class="options">
                                                @if (is_null($inventory->deleted_at))
                                                    <a href="#" data-path="admin/product/variant" data-action="delete"
                                                        class="btn-deleted" data-object="{{ $variant->id }}"
                                                        data-toggle="tooltip" data-placement="top" title="Eliminar"><i
                                                            class="fas fa-trash-alt"></i>
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
