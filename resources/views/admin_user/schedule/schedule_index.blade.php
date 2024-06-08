@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row ">            
            {{-- Boton para reserva --}}
            @can('isAdmin')  
                <div class="card mb-4 col-sm-4" >
                    <div class="card-header" style="background-color:lightgrey; ">
                        Choose a action
                    </div>
                    <div class="card-body">
                        <div class="col-12 mb-2">
                            <a class="btn btn-outline-success w-100" href="{{ route('schedule.create') }}"><i class="bi bi-calendar-plus"></i> Booking</a>
                        </div>
                        <div class="col-12 mb-3 ">
                            <a class="btn btn-outline-secondary w-100" href="{{ route('event.list') }}" ><i class="bi bi-calendar-minus"></i> Edit booking</a>
                        </div>                       
                    </div>                    
                </div>                    
            @endcan
        </div>
        <div class="row justify-content-center">
            <div class="col-md-9">
                <div id="calendar" ></div>
            </div>
        </div>
        <div class="row justify-content-end">
            <div class="col-md-3 mt-5">
                <h5><strong>Phone: 656-765-676</strong> </h5>
            </div>
        </div>
    </div>
{{-- cdn schedule. Podremos cargar FullCalendar y sus dependencias --}}
<script src="
https://cdn.jsdelivr.net/npm/fullcalendar@6.1.13/index.global.min.js
"></script>

<script>
    // Cuando se ejecute el evento nos mostrara el calendario en el id calendar
  document.addEventListener('DOMContentLoaded', function() {
    // Buscamos el id calendar
        var calendarEl = document.getElementById('calendar');
        // Inicializamos el fullcalendar
        var calendar = new FullCalendar.Calendar(calendarEl, {
          themeSystem: 'bootstrap5',
          initialView: 'timeGridWeek', // Por semanas
          slotMinTime: '8:00', // Hora de entrada
          slotMaxTime:'16:00', // Ultima hora de reserva
          events:@json($events),
         
          businessHours: {
            //Dias que se pueden coger cita
            daysOfWeek: [ 1, 2, 3, 4, 5 , 6 ], // De lunes a sabado

            startTime: '8:00', // Empieza a las 
            endTime: '16:00', // Hora a la que termina
            },
            eventColor: '#6DADF2' // Color de los eventos
        });
        calendar.render();
      });
</script>
    
@endsection
