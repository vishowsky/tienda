@extends('master')
@section('title', 'Editar mi perfil')
@section('content')
    <div class="row mt32">
        <div class="col-md-4">
            <div class="panel shadow">
                <div class="header">
                    <h2 class="title"><i class="far   fa-user"></i>Editar Avatar</h2>
                </div>
                Lorem ipsum dolor sit amet consectetur, adipisicing elit. Libero ab fugit modi architecto. Qui, cumque
                consequatur quibusdam dolores voluptates reprehenderit laboriosam omnis adipisci repellendus assumenda
                voluptatibus, sequi nobis voluptatum vel.
            </div>

            <div class="panel shadow mt32">
                <div class="header">
                    <h2 class="title"><i class="fas fa-fingerprint"></i>Cambiar Contraseña</h2>
                </div>
                {!! Form::open(['url' => '/account/edit/password']) !!}

                <div class="row">
                    <div class="cold-md-12">
                        <label for="apassword">Contraseña Actual</label>
                        <div class="input-group">
                            <span class="input-group-text" id="basic-addon1">
                                <i class="far fa-keyboard"></i>
                            </span>
                            {!! Form::password('apassword', ['class' => 'form-control']) !!}

                        </div>
                    </div>

                    <div class="row mt16">
                        <div class="cold-md-12">
                            <label for="password"> Nueva Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::password('password', ['class' => 'form-control']) !!}

                            </div>
                        </div>

                        <div class="cold-md-12">
                            <label for="cpassword">Confirmar Contraseña</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1">
                                    <i class="far fa-keyboard"></i>
                                </span>
                                {!! Form::password('cpassword', ['class' => 'form-control']) !!}

                            </div>
                        </div>

                        <div class="row mt16">
                            <div class="cold-md-12">

                                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}

                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>


            <div class="col-md-8">
                <div class="panel shadow ">
                    <div class="header">
                        <h2 class="title"><i class="fas fa-fingerprint"></i>Editar informacion</h2>
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
                                <label for="lastname">Apellido</label>
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
                                <label for="phone">Telefono</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="far fa-keyboard"></i>
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
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label for="gender">Genero</label>
                                <div class="input-group">
                                    <span class="input-group-text" id="basic-addon1">
                                        <i class="far fa-keyboard"></i>
                                    </span>
                                    {!! Form::select(
                                        'gender',
                                        ['0' => 'Sin especificar', '1' => 'masculino', '2' => 'femenino', '3' => 'otro'],
                                        Auth::user()->gender,
                                        ['class' => 'form-control'],
                                    ) !!}
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="vol-md-12">
                                {!! form::submit('guardar', ['class' => 'btn btn-primary']) !!}
                            </div>
                        </div>
                        {!! Form::close() !!}
                </div>
            </div>
        </div>
    @endsection
