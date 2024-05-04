@extends('emails.master')
@section('content')
<p>Hola <strong>{{ $name}}</strong></p>
<p> Esta es su nueva contraseña para acceder a su cuenta</p>
<p><h2><strong>{{$password}}</strong></h2></p>
<p>para iniciar sesion haga click en el siguiente boton</p>
<p><a href="{{ url('/login')}}" style="display: inline-block; background-color:red; color: white; padding: 12px; border-radius: 4px;text-decoraticon: none;">Restablecer contraseña</a></p>
<p>Recuerde cambiar la contraseña y nunca entregarsela a naiden!</p>

@stop
