@extends('admin.master')

@section('title', 'Permisos de Usuarios')
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/users/all') }}"><i class="fas fa-user-friends"></i>Usuarios
        </a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ url('/admin/users') }}"><i class="fas fa-cogs"></i>Permisos de {{$u->name}} (ID {{$u->id}})
        </a>
    </li>
@endsection

@section('content')
    <div class="container-fluid">
        <div class="page_user">
            <form action="{{ url('/admin/user/'.$u->id.'/permissions') }}" method="POST">
            @csrf

            {{-- <div class="row">
                @foreach(user_permissions() as $key => $value))
                <div class="col-md-4 d-flex">
                    <div class="panel shadow">
                        <div class="header">
                            <h2 class="title">
                                <h2 class="title">{!! $value['icon'] !!} {!! $value['title'] !!}</h2>
                            </h2>

                            <div class="inside">
                                @foreach($value['keys'] as $k => $v)
                                <div class="form-check">
                                    <input type="checkbox" value ="true" name="{{ $k }}}}"@if(kvfj($u->permissions, $k )) checked @endif>
                                    <label for="dashboard"> {{$v}}
                                    </label>
                                </div>
                                @endforeach
                            </div>


                        </div>
                    </div>
                </div>

                @endforeach
            </div> --}}

            <div class="row">
                @include('admin.users.permissions.module_dashboard')
                @include('admin.users.permissions.module_products')
                @include('admin.users.permissions.module_categories')
            </div>
            <div class="row mt16">
                @include('admin.users.permissions.module_users')
            </div>

            <div class="row mt16">
                <div class="col-md-12">
                    <div class="panel shadow">
                        <input type="submit"  value="guardar" class="btn btn-primary">
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
