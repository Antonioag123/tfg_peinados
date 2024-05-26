@extends('layouts.app')

@section('content')
    <div class="container">
        {{-- Component form --}}
        <x-form :users="$users" title="Booking zone" :services="$services" :route="'schedule.store'">            
        </x-form>    
    </div>
@endsection
