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
        <div class="col-md-3">

        </div>
        <div class="col-md-9">

        </div>
    </div>
</div>
@endsection
