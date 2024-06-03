@extends('admin.master')

@section('title','Usuarios')
@section('breadcrumb')
<li class="breadcrumb-item">
    <a href="{{ url('/admin/users') }}"><i class="fas fa-user-friends"></i>Usuarios
    </a>
</li>
@endsection

@section('content')
<div class="container-fluid">
    <div class="panel shadow">
        <div class="header">
            <h2 class="title">
                <h2 class="title"><i class="fas fa-user-friends"></i>Usuarios</h2>
            </h2>
            <div class="inside">
                <div class="row">
                  <div class="col-md-2 offset-md-10">
                    <div  class="dropdown">
                        <button style="width: 100%;" class="btn btn-outline-danger dropdown-toggle" type="button" id="dropdownMenuButton"
                         data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-filter"></i>Filtro
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a  class="dropdown-item" href="{{ url('/admin/users/all') }}">Todos</a>
                            <a  class="dropdown-item" href="{{url('/admin/users/0')}}" >No Verificados</a>
                            <a  class="dropdown-item" href="{{url('/admin/users/1')}}" >Verificados</a>
                            <a  class="dropdown-item" href="{{url('/admin/users/100')}}" >Suspendidos</a>

                        </div>
                    </div>
                  </div>
                </div>

                <table class="table mt16">
                    <thead>
                        <tr>
                            <td>ID</td>
                            <td>
                                avatar
                            </td>
                            <td>Nombre</td>
                            <td>Correo</td>
                            <td>Rut</td>
                            <td>Estado</td>
                            <td>Rol</td>
                            <td></td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)

                        <tr>
                            <td>{{ $user->id }}</td>
                            <td width="48" >
                                @if (is_null($user->avatar))
                                <img class="img-fluid rounded-circle" src="{{ url('/static/images/default-avatar.png') }}">
                            @else
                                <img class="img-fluid rounded-circle"
                                    src="{{ url('/uploads_users/'.$user->id.'/av_'.$user->avatar) }}" >
                            @endif
                            </td>
                            <td>{{ $user->name }} {{ $user->lastname }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->rut }}</td>
                            <td>{{ getUserStatusArray(null,$user->status )}}</td>
                            <td>{{ getRoleUserArray(null,$user->role )}}</td>

                            <td>
                                <div class="options">
                                    @if(kvfj(Auth::user()->permissions,'user_edit'))
                                    <a href="{{ url('/admin/user/'.$user->id.'/edit')}}" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fas fa-edit"></i></a>
                                    @endif
                                    {{-- <a href="{{ url('/admin/user/'.$user->id.'/delete')}}" data-toggle="tooltip" data-placement="top" title="Eliminar"><i class="fas fa-trash-alt"></i></a> --}}
                                    @if(kvfj(Auth::user()->permissions,'user_permissions'))
                                    <a href="{{ url('/admin/user/'.$user->id.'/permissions')}}" data-toggle="tooltip" data-placement="top" title="Permisos de usuario"><i class="fas fa-cogs"></i></a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="8">
                                {!! $users->render() !!}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
