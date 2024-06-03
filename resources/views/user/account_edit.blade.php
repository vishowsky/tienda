@extends('master')
@section('title', 'Editar mi perfil')

@section('content')
    <div class="row mt32">
        <div class="col-md-4">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title">
                        Editar Avatar
                    </h2>
                </div>
                <div class="inside">
                    <div class="edit_avatar">
                        {!! Form::open(['url' => 'account/edit/avatar', 'id' => 'form_avatar_change' ,'files' => true]) !!}
                        <a href="#" id="btn_avatar_edit">
                            <div class="overlay" id="avatar_change_overlay">
                                <i class="fas fa-camera"></i>
                            </div>
                            @if (is_null(Auth::user()->avatar))
                                <img src="{{ url('/static/images/default-avatar.png') }}">
                            @else
                                <img src="{{ url('/uploads_users/'.Auth::id().'/av_'.Auth::user()->avatar) }}">
                            @endif
                        </a>
                        {!! Form::file('avatar',['id' => 'input_file_avatar','accept' => 'image/*',
                        'class' => 'form-control']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>

            </div>


            <div class="panel shadow mt32">
                <div class="header">
                    <h2 class="title">
                        Cambiar contraseña
                    </h2>
                </div>
                <div class="inside">
                    {!! Form::open(['url' => '/account/edit/password']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <label for="apassword">Contraseña Actual</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::password('apassword', ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row mt16">
                        <div class="col-md-12">
                            <label for="password">Nueva Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::password('password', ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row mt16">
                        <div class="col-md-12">
                            <label for="cpassword">Repetir contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::password('cpassword', ['class' => 'form-control']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row mt16">
                        <div class="col-md-12">
                            {!! Form::submit('Actualizar contraseña', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title">
                        Editar Informacion
                    </h2>
                </div>

                <div class="inside">
                    {!! Form::open(['url' => '/account/edit/info']) !!}
                    <div class="row">
                        <div class="col-md-4">
                            <label for="name">Nombre</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::text('name', Auth::user()->name, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="lastame">Apellido</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::text('lastname', Auth::user()->lastname, ['class' => 'form-control']) !!}
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="email">Correo Electronico</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::email('email', Auth::user()->email, ['class' => 'form-control', 'disabled']) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row mt16">
                        <div class="col-md-4">
                            <label for="phone">telefono</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i> +569
                                </span>
                                {!! Form::number('phone', Auth::user()->phone, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="birthday">Fecha de nacimiento</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::date('birthday', Auth::user()->birthday, ['class' => 'form-control']) !!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="gender">Genero</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::select('gender', ['0' => 'Sin Especificar', '1' => 'Hombre', '2' => 'Mujer', '3' => 'Otro'], null, [
                                    'class' => 'form-control',
                                ]) !!}
                            </div>
                        </div>

                    </div>

                    <div class="row mt16">
                        <div class="col-md-12">

                            {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}

                        </div>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>

        </div>
    </div>

    </div>

@endsection
