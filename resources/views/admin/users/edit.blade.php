@extends('admin.master')

@section('title', 'Usuarios')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/users') }}"><i class="fas fa-user-friends"></i>Usuarios
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/users') }}"><i class="fas fa-cogs"></i>{{ $u->name }} ID {{ $u->id }}
        </a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="page_user">
            <div class="row">

                <div class="col-md-4">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title">
                                <h2 class="title"><i class="fas fa-user"></i>Informacion</h2>
                            </h2>
                            <div class="inside">
                                <div class="mini_profile">
                                    @if (is_null($u->avatar))
                                        <img class="avatar" src="{{ url('/static/images/default-avatar.png') }}">
                                    @else
                                        <img class="avatar"
                                            src="{{ url('/uploads/user/' . $u->id . '/' . $user->avatar) }}">
                                    @endif
                                    <div class="info">
                                        <span class="title"><i class="far fa-address-card"></i>Nombre</span>
                                        <span class="text"></i>{{ $u->name }} {{ $u->lastname }} </span>
                                        <span class="title"><i class="fas fa-user-tie"></i>Email</span>
                                        <span class="text">{{ $u->email }} </span>
                                        <span class="title"><i class="fa-solid fa-passport"></i>Rut</span>
                                        <span class="text">{{ $u->rut }} </span>
                                        <span class="title"><i class="far fa-calendar-alt"></i>Estado del usuario</span>
                                        <span class="text">{{ getUserStatusArray(null, $u->status) }} </span>
                                        <span class="title"><i class="far fa-calendar-alt"></i>Fecha de registro</span>
                                        <span class="text">{{ $u->created_at }} </span>
                                        <span class="title"><i class="fas fa-user-shield"></i>Rol</span>
                                        <span class="text">{{ getRoleUserArray(null, $u->role) }} </span>

                                    </div>
                                    @if (kvfj(Auth::user()->permissions, 'user_banned'))
                                        @if ($u->status == '100')
                                            <a href="{{ url('/admin/user/' . $u->id . '/banned') }}"
                                                class="btn btn-success mt16">Activar cuenta</a>
                                        @else
                                            <a href="{{ url('/admin/user/' . $u->id . '/banned') }}"
                                                class="btn btn-danger mt16">Suspender cuenta</a>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title">
                                <h2 class="title"><i class="fas fa-user-edit"></i>Editar Informacion</h2>
                            </h2>
                            <div class="inside">
                                @if (kvfj(Auth::user()->permissions, 'user_edit'))
                                    {!! Form::open(['url' => '/admin/user/' . $u->id . '/edit']) !!}
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="module">Tipo de usuario</label>
                                            <div class="input-group">
                                                    <span class="input-group-text" id="basic-addon1">
                                                        <i class="far fa-keyboard"></i>
                                                    </span>
                                                {!! Form::select('user_type', getRoleUserArray('list', null), $u->role, ['class' => 'form-select']) !!}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt16">
                                        <div class="col-md-12">
                                            {!! Form::submit('Guardar', ['class' => 'btn btn-success']) !!}
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>


    </div>
@endsection
