<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Gate;

// use Carbon\Carbon;

class ScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    
////////////////////////////    
//CALENDARIO:
////////////////////////////  
    public function index()
    {
        $events_all = Event::all();

        // Aqui guardamos los eventos pero con los datos que me pide el calendario
        $events = [];

        foreach ($events_all as $event) {
            // Estos son los campos que full calendar espera (title, start, end)
            $events[] = [
                'title' => $event->event,
                'start' => $event->start_date,
                'end' => $event->end_date,
            ];
        }

        return view('admin_user.schedule.schedule_index', compact('events'));
    }
    
////////////////////////////    
//EVENTOS DE RESERVA:
////////////////////////////  

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        $services = Service::all();

        if(Gate::allows('isAdmin')){
            return view('admin_user.schedule.schedule_create', compact('services', 'users'));
        } else{
            return redirect()->route('schedule.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validaciones
        $request->validate([
            'user_id' => 'required',
            'name_book' => 'required',
            'date_book' => 'required'
        ]);

        // Creo nueva reserva
        $booking = new Booking();
        // Asignamos el id del usuario que esta autenticado ahora (en el caso de que el usuario se pueda asignar cita)
        // $booking->user_id = auth()->id();
        $booking->user_id = $request->user_id;
        $booking->service_id = $request->serv_book;
        $booking->save();

        // Creo nuevo evento
        $event = new Event();
        // Nombre de evento 
        $event->event = $request->name_book;
        $event->start_date = $request->date_book;
        // Calculo end_date media hora más tarde que start_date por defecto
        $start_date = new \DateTime($request->date_book);
        // Con clone crea una copia independiente del objeto. Si fuera sin clone apuntarian al mismo dateTime en memoria
        $end_date = clone $start_date;
        $end_date->modify('+30 minutes'); // Agrega 30 minutos a la fecha de inicio
        $event->end_date = $end_date->format('Y-m-d H:i:s');
        // Asigno el id del booking creado al evento
        $event->booking_id = $booking->id;
        $event->save();
        //Redirecciono al index
        return redirect()->route('schedule.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */

    // Aqui voy a eliminar los eventos
    public function destroy(string $id)
    {
        $booking = Booking::findOrFail($id);

        // Elimina el evento asociado
        if ($booking->event) {
            $booking->event->delete();
        }

        // Elimina la reserva
        $booking->delete();


        return redirect()->route('event.list');
    }

    // Nos Muestra las lista de eventos que hay para que el administrador pueda editarlos o eliminarlos
    public function event_list(): View
    {
        // Voy a recoger todas las reservas que hay
        $bookings = Booking::all();
      
        return view('admin_user.schedule.schedule_list_event', compact('bookings'));
    }
    //Para editar reserva
    public function event_edit(string $id):View
    {
        $booking = Booking::findOrFail($id);
        $users = User::all();
        $services = Service::all();
        
        return view('admin_user.schedule.schedule_edit_event',compact('booking','users','services'));
    }

    //Actualizar reserva
    public function event_update(Request $request, string $id):RedirectResponse
    {     
        $booking = Booking::findOrFail($id);

        //Actualizo los datos de la tabla de reservas
        $booking->user_id=$request->user_id;
        $booking->service_id=$request->serv_book;
        $booking->save();
        // Actualizo los datos de la tabla events
        $booking->event->event=$request->name_book;
        $booking->event->start_date=$request->date_book;
        
        $start_date = new \DateTime($request->date_book);
        // Con clone crea una copia independiente del objeto. Si fuera sin clone apuntarian al mismo dateTime en memoria
        $end_date = clone $start_date;
        // Agrega 30 minutos a la fecha de inicio
        $end_date->modify('+30 minutes'); 
        $booking->event->end_date = $end_date->format('Y-m-d H:i:s');
        // Asigno el id del booking creado al evento
        $booking->event->booking_id = $booking->id;
  
        $booking->event->save();

        return redirect()->route('event.list');
    }
}
