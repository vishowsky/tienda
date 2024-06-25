@extends('admin.master')

@section('title', 'Editar Producto')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products/all') }}"><i class="fa fa-boxes"></i>Productos
        </a>
    </li>

    <li class="breadcrumb-item">
        <a href="{{ url('/admin/product/' . $product->id . '/edit') }}"><i class="fa fa-boxes"></i>{{ $product->name }}
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/product/' . $product->id . '/inventory') }}"><i class="fa fa-boxes"></i>inventario
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
                            <h2 class="title"><i class="far fa-edit"></i>Administrar inventario</h2>
                        </h2>
                        <div class="inside">
                            {!! Form::open(['url' => '/admin/product/' . $product->id . '/inventory']) !!}
                            <label for="name">Nombre</label>
                            <div class="input-group">
                                <span class="input-group-text" id=basic-addon1>
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::text('name', null, ['class' => 'form-control']) !!}
                            </div>

                            <label class="mt16" for="quantity">Inventario</label>
                            <div class="input-group">
                                <span class="input-group-text" id=basic-addon1>
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::number('quantity', 1, ['class' => 'form-control', 'min' => '1']) !!}
                            </div>

                            <label class="mt16" for="price">Precio</label>
                            <div class="input-group">
                                <span class="input-group-text" id=basic-addon1>
                                    {{ config('tienda.currency') }}
                                </span>
                                {!! Form::number('price', 1, ['class' => 'form-control', 'min' => '1', 'step' => 'any']) !!}
                            </div>

                            <label class="mt16" for="limited">Stock</label>
                            <div class="input-group">
                                <span class="input-group-text" id=basic-addon1>
                                    {{ config('tienda.currency') }}
                                </span>
                                {!! Form::select('limited', ['0' => 'Limitado', '1' => 'Ilimitado'], 0, ['class' => 'form-select']) !!}
                            </div>

                            <label class="mt16" for="minimum">Inventario minimo</label>
                            <div class="input-group">
                                <span class="input-group-text" id=basic-addon1>
                                    {{ config('tienda.currency') }}
                                </span>
                                {!! Form::number('minimum', 1, ['class' => 'form-control', 'min' => '1']) !!}
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
                        <h2 class="title">Inventarios</h2>
                    </div>

                    <div class="inside">
                        <table class="table">
                            <thead>
                                <tr>
                                    <td>ID</td>
                                    <td>Nombre</td>
                                    <td>Existencias</td>
                                    <td>Minimo</td>
                                    <td>Precio</td>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($product->getInventory as $inventory)
                                    <tr>
                                        <td>{{ $inventory->id }}</td>
                                        <td>{{ $inventory->name }}</td>
                                        <td>
                                            @if ($inventory->limited == '1')
                                                ilimitado
                                            @else
                                                {{ $inventory->quantity }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($inventory->limited == '1')
                                                ilimitado
                                            @else
                                                {{ $inventory->minimum }}
                                            @endif

                                        </td>
                                        <td>{{ $inventory->price}}</td>
                                        <td>
                                            <div class="options">
                                                @if (kvfj(Auth::user()->permissions, 'product_edit'))
                                                    <a href="{{ url('/admin/product/inventory/' . $inventory->id . '/edit') }}"
                                                        data-toggle="tooltip" data-placement="top" title="Editar"><i
                                                            class="fas fa-edit"></i></a>
                                                @endif
                                                @if (kvfj(Auth::user()->permissions, 'product_inventory'))
                                                    <a href="{{ url('/admin/product/inventory' . $inventory->id . '/variants') }}"
                                                        data-toggle="tooltip" data-placement="top" title="Variantes"><i
                                                            class="fas fa-box"></i></a>
                                                @endif
                                                @if (kvfj(Auth::user()->permissions, 'product_delete'))
                                                    @if (is_null($inventory->deleted_at))
                                                        <a href="#" data-path="admin/product/inventory" data-action="delete"
                                                            class="btn-deleted" data-object="{{ $inventory->id }}"
                                                            data-toggle="tooltip" data-placement="top" title="Eliminar"><i
                                                                class="fas fa-trash-alt"></i>
                                                        </a>
                                                    @else
                                                        <a href="{{ url('/admin/product/inventory/' . $inventory->id . '/restore') }}"
                                                            data-path="admin/product" class="btn-deleted"
                                                            data-action="restore" data-object="{{ $inventory->id }}"
                                                            data-toggle="tooltip" data-placement="top" title="Restaurar"><i
                                                                class="fas fa-trash-restore"></i>
                                                        </a>
                                                    @endif
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
