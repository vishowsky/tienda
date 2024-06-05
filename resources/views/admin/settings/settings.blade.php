@extends('admin.master')

@section('title', 'Configuraciones')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/settings') }}"><i class="fa fa-boxes"></i>Configuracion
        </a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="panel shadow">
            <div class="header">
                <h2 class="title">Configuracion</h2>
            </div>
            <div class="inside">
                {!! Form::open(['url' => '/admin/settings']) !!}
                <div class="row">
                    <div class="col-md-4">
                        <label for="name">Nombre del sitio</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i>
                            </span>
                            {!! Form::text('name',Config::get('tienda.name'), ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="currency">Moneda: </label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i>
                            </span>
                            {!! Form::text('currency',Config::get('tienda.currency'), ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="store_phone">Telefono: </label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                              +569
                            </span>
                            {!! Form::number('store_phone',Config::get('tienda.store_phone'), ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>

                <div class="row mt16">
                    <div class="col-md-4">
                        <label for="map">Ubicacion: </label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i>
                            </span>
                            {!! Form::text('map',Config::get('tienda.map'), ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-md-4">
                        <label for="maintance_mode">Modo Mantenimiento: </label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i>
                            </span>
                            {!! Form::select('maintance_mode', ['0' => 'Si','1' => 'No'],Config::get('tienda.maintance_mode'), ['class' => 'form-control'] ) !!}
                        </div>
                    </div>
                </div>




                <div class="row mt16">
                    <div class="col-md-4">
                        <label for="products_page">Cantidad de productos para mostrar por pagina</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i>
                            </span>
                            {!! Form::text('products_page',Config::get('tienda.products_page'), ['class' => 'form-control']) !!}
                        </div>
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
@endsection
