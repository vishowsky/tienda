@extends('connect.master')

@section('title','Iniciar Sesion')

@section('content')
<div class="box box_login shadow">
    <div class="header">
        <a href="{{ url('/') }}">
            <img src="{{ url('/static/images/logo.png') }}" alt="">
        </a>
    </div>
    <div class="inside">
    {!! Form::open(['url' => '/login']) !!}
    <!-- Campo correo electronico -->

    <label for="email">Correo electronico</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="far fa-envelope"></i></div>
        </div>
        {!! Form::email('email', null, ['class' => 'form-control'])!!}
    </div>

    <!-- Campo contraseña -->
    <label for="email" class="mt16">Contraseña</label>
    <div class="input-group">
        <div class="input-group-prepend">
            <div class="input-group-text"><i class="fa-solid fa-lock"></i></i></i></div>
        </div>
        {!! Form::password('password', ['class' => 'form-control'])!!}

    </div>
    <a href="{{ url('/recover') }}">¿Olvidaste tu contraseña?</a>
    <!-- boton login-->
    {!! Form::submit('Ingresar',['class' => 'btn btn-success mt16']) !!}
    {!! Form::close() !!}

    <div class="mt16 footer">
        <a href="{{ url('/register') }}">Regístrate aquí</a>



    </div>
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

    </div>


</div>
@stop
