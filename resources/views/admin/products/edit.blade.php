@extends('admin.master')

@section('title', 'Editar Producto')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/products/all') }}"><i class="fa fa-boxes"></i>Productos
        </a>
    </li>
@endsection


@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">


                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title">
                            <h2 class="title"><i class="far fa-edit"></i>Agregar producto</h2>
                        </h2>
                        <div class="inside">
                            {!! Form::open(['url' => '/admin/product/' . $p->id . '/edit', 'files' => true]) !!}
                            <div class="row">

                                <!-- Campo nombre del producto -->
                                <div class="col-md-12">
                                    <label for="title">Nombre del producto:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="far fa-keyboard"></i>
                                            </span>
                                        </div>
                                        {!! Form::text('name', $p->name, ['class' => 'form-control']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="row mt16">
                                <div class="col-md-6">
                                    <label for="category">Categoria</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="far fa-keyboard"></i>
                                        </span>
                                        {!! Form::select('category', $cats, $p->category_id, ['class' => 'form-select', 'id' => 'category']) !!}
                                        {!! Form::hidden('subcategory_actual', $p->subcategory_id, ['id' => 'subcategory_actual']) !!}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="subcategory">Subcategoria</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="far fa-keyboard"></i>
                                        </span>
                                        {!! Form::select('subcategory', [], $p->subcategory_id, ['class' => 'form-select', 'id' => 'subcategory']) !!}
                                    </div>
                                </div>


                            </div>

                            <div class="row mt16">

                                <div class="col-md-3">
                                    <label for="indiscount">en oferta?</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1">
                                                <i class="far fa-keyboard"></i>
                                            </span>
                                        </div>
                                        {!! Form::select('indiscount', ['0' => 'No', '1' => 'Si'], $p->indiscount, ['class' => 'form-select']) !!}
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="discount">Descuento</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="far fa-keyboard"></i>
                                        </span>
                                        {!! Form::number('discount', $p->discount, ['class' => 'form-control', 'min' => '0', 'step' => 'any']) !!}
                                    </div>
                                </div>


                                <div class="col-md-3">
                                    <label for="sku">SKU</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="far fa-keyboard"></i>
                                        </span>
                                        {!! Form::text('sku', $p->sku, ['class' => 'form-control', 'step' => 'any']) !!}
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

                                <div class="col-md-3">
                                    <label for="status">estado</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="basic-addon1">
                                            <i class="far fa-keyboard"></i>
                                        </span>
                                        {!! Form::select('status', ['0' => 'Borrador', '1' => 'publico'], $p->status, ['class' => 'form-select']) !!}
                                    </div>
                                </div>
                            </div>

                            <div class="row mt16">
                                <div class="col-md-12">
                                    <label for="content">Descripcion</label>
                                    {!! Form::textarea('content', $p->content, ['class' => 'form-control', 'id' => 'editor']) !!}
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

            <div class="col-md-3">
                <div class="panel shadow">
                    <div class="header">
                        <h2 class="title"><i class="far fa-image"></i> Imagen Destacada</h2>
                        <div class="inside">
                            <img src="{{ url('/uploads/' . $p->file_path . '/' . $p->image) }}" class="img-fluid">
                        </div>
                    </div>
                </div>

                <div class="panel shadow mt16">
                    <div class="header">
                        <h2 class="title"><i class="far fa-images"></i> Galeria</h2>
                        <div class="inside product_gallery">
                            @if (kvfj(Auth::user()->permissions, 'product_gallery_add'))
                                {!! Form::open([
                                    'url' => '/admin/product/' . $p->id . '/gallery/add',
                                    'files' => true,
                                    'id' => 'form_product_gallery',
                                ]) !!}
                                {!! Form::file('file_image', [
                                    'id' => 'product_file_image',
                                    'accept' => 'image/*',
                                    'style' => 'display: none;',
                                    'required',
                                ]) !!}
                                {!! Form::close() !!}

                                <div class="btn-submit">
                                    <a href="#" id="btn_product_file_image"><i class="fas fa-plus"></i></a>
                                </div>
                            @endif
                            <div class="tumbs">
                                @foreach ($p->getGallery as $img)
                                    <div class="tumb">
                                        @if (kvfj(Auth::user()->permissions, 'product_gallery_delete'))
                                            <a href="{{ url('/admin/product/' . $p->id . '/gallery/' . $img->id . '/delete') }}"
                                                data-toggle="tooltip" data-placement="top" title="Eliminar">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        @endif
                                        <img src="{{ url('/uploads/' . $img->file_path . '/t_' . $img->file_name) }}"
                                            alt="">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
