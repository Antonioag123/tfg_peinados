@extends('layouts.app')

@section('content')
    <div class="container">

        <a href="{{ route('schedule.index') }}" class="btn btn-outline-danger">Back</a>
        <table class="table table-light table-hover">
            <thead>
                <tr>
                    <th>Event</th>
                    <th>Start_date</th>
                    <th>End_date</th>
                    <th>User</th>
                    <th>Service</th>
                </tr>
            </thead>
            <tbody>
                {{-- Recorro las reservas que han hecho para poder eliminarlas o editarlas --}}
                <?php foreach($bookings as $booking) {  ?>
                <tr>
                    {{--Verifico si el nombre de evento no devuelve null --}}
                    @if ($booking->event)
                        <td>{{ $booking->event->event }}</td>
                        <td>{{ $booking->event->start_date }}</td>
                        <td>{{ $booking->event->end_date }}</td>
                        <td>{{ $booking->user->name }}</td>
                        <td>{{ $booking->service->name }}</td>
                    @else 
                    {{-- Sino devuelve que no existen eventos --}}
                        <td colspan="5">No existe ningún evento</td>
                    @endif
                  

                    {{-- Editar evento --}}
                    <td>
                        <a href="{{route('event.edit',$booking->id)}}" class="btn btn-secondary">Edit</a>
                    </td>

                    {{-- Eliminar evento --}}
                    <td>
                        <form action="{{ route('schedule.destroy', $booking->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete">
                        </form>
                    </td>
                </tr>

                <?php }?>
            </tbody>



        </table>
    </div>
@endsection
