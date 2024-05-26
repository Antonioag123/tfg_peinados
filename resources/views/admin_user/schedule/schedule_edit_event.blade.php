@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- Component form --}}
        {{-- Lo que hay con ":" quiere decir que le paso lo que hay dentro de la variable --}}
        <x-form :users="$users" title="Edit zone" :services="$services" :route="'event.update'" :booking="$booking">            
        </x-form>    
    </div>
@endsection
