@extends('emails.master')
@section('content')
<p>Hola <strong>{{ $name}}</strong></p>
<p> Este correo electronico le ayudara a reestablecer su contraseña</p>
<p>para continuar haga click en el siguiente boton e ingrese el siguiente codigo</p>
<h2><strong>{{$code}}</strong></h2>
<p><a href="{{ url('/reset?email='.$email)}}" style="display: inline-block; background-color:red; color: white; padding: 12px; border-radius: 4px;text-decoraticon: none;">Restablecer contraseña</a></p>

<P>si el boton no funciona, ingrese a esta url</P>
<p>{{ url('/reset?email='.$email)}}</p>
@stop
