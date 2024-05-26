@extends('layouts.app')

{{-- AQUI QUIERO PONER LA INFORMACION DE LAS CITAS QUE HA PEDIDO Y LAS COMPRAS QUE HA REALIZADO EL CLIENTE --}}
@section('content')
<div class="container">
    <h3>
        {{$user->name}}
    </h3>
    <p>
        {{$user->email}}
    </p>
    <p>
        {{$user->phone}}
    </p>
</div>
@endsection

{{-- <x-index>
    Aqui tendré que mostrar además de la información y rol de usuario, las compras y el calendario registrado 
    <h3>
        {{$user->name}}
    </h3>
    <p>
        {{$user->email}}
    </p>
    <p>
        {{$user->phone}}
    </p>
</x-index> --}}