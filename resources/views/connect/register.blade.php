@extends('connect.master')

@section('title','Registro')

@section('content')
<div class="box box_register shadow">
    <div class="header">
        <a href="{{ url('/') }}">
            <img src="{{ url('/static/images/logo.png') }}" alt="">
        </a>
    </div>
    <div class="inside">
    {!! Form::open(['url' => '/register']) !!}

    <!-- Campo nombre -->
    <label for="name">Nombre</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa-regular fa-user"></i></div>
        </div>
        {!! Form::text('name', null, ['class' => 'form-control' ,'required'])!!}
    </div>

    <!-- Campo apellido -->
    <label for="lastname" class="mt16">Apellido</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa-solid fa-user-tag"></i></div>
        </div>
        {!! Form::text('lastname', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su apellido','required']) !!}
    </div>

    <!-- Campo rut -->
    <label for="rut" class="mt16">Rut</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa-solid fa-user-tag"></i></div>
        </div>
        {!! Form::text('rut', null, ['class' => 'form-control', 'placeholder' => 'Ingrese su rut','required']) !!}
    </div>

    <!-- Campo correo electronico -->
    <label for="email" class="mt16">Correo electronico</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="far fa-envelope"></i></div>
        </div>
        {!! Form::email('email', null, ['class' => 'form-control','required'])!!}
    </div>

    <!-- Campo contraseña -->
    <label for="password" class="mt16">Contraseña</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa-solid fa-lock"></i></i></i></div>
        </div>
        {!! Form::password('password', ['class' => 'form-control','required' ])!!}

    </div>

    <!-- Campo repetir contraseña -->
    <label for="cpassword" class="mt16">Confirmar Contraseña</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa-solid fa-lock"></i></i></i></div>
        </div>
        {!! Form::password('cpassword', ['class' => 'form-control', 'required'])!!}

    </div>

    <!-- boton login-->
    {!! Form::submit('Ingresar',['class' => 'btn btn-success mt16']) !!}
    {!! Form::close() !!}


     <!-- Alerta para mostrar los errores -->
     @if(Session::has('message'))
     <div class="container">
         <div class="mt16 alert alert-{{ Session::get('typealert') }}" style="display:none;">
             {{ Session::get('message') }}
             @if ($errors -> any())
             <ul>
                 @foreach($errors->all() as $error)
                 <li>{{ $error}}</li>
                 @endforeach
             </ul>
             @endif
             <script>
                 //script para la animacion
                 $('.alert').slideDown();
                 setTimeout(function(){$('.alert').slideUp(); },10000 )
             </script>
         </div>
     </div>
     @endif



    <div class="mt16 footer">
        <a href="{{ url('/register') }}">Ingresar a surcursal virtual</a>
    </div>
    </div>


</div>
@stop
