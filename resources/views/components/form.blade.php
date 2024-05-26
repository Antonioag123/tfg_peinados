<div class="row">

    <h1><strong>{{$title}}</strong></h1>
    
        <div class="col-12 mb-5 mt-4">
            <a href="{{route('schedule.index')}}" class="btn btn-outline-danger">Back</a>
        </div>
        <div class="col-12" align="center" >
            <div class="card shadow col-9">
                <div class="card-header bg-secondary text-white">
                    <h5 class="mb-0">Book a service</h5>
                </div>
                <div class="card-body">
 
                    {{-- En el caso de que sea formulario de creacion --}}
                    @if ($booking=="")
                        <form action="{{route($route)}}" method="POST">
                        @csrf
                    @else {{-- En el caso de que sea formulario de editar--}}
                        <form action="{{route($route,$booking->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                    @endif

                        {{-- Con este nombres podras saber tu cita sin tener
                            que introducir tus datos en el calendario --}}
                        <div class="mb-3" style="text-align:left;">
                            <label for="user_id" class="form-label">User:</label>
                        <select name="user_id" id="user_id" class="form-select">
                        <?php
                        // Voy poniendo el nombre de cada servicio
                         foreach($users as $user){   
                            // En el caso de que sea administrador no puede reservar
                            if($user->id!=1 || $user->id!='1'){
                                ?>         
                                 {{--En el caso de que entre es porque va a crear el evento  --}}
                                @if ($booking=="") 
                                    <option value="{{$user->id}}">{{$user->name}}</option>                  
                                @else  
                                {{--Cuando no entre es porque va a editar el evento (por booking->id).--}}
                                    @if($booking->user->id==$user->id)
                                        {{-- En el caso de que el usuario sea el mismo que el que quiere editar estara seleccionado --}}
                                        <option value="{{$user->id}}" selected>{{$user->name}}</option>   
                                    @else  
                                        <option value="{{$user->id}}">{{$user->name}}</option>   
                                    @endif
                                @endif                                               
                               
                                <?php
                            }
                         }
                         ?>
                         </select>
                        </div>
                        <div class="mb-3" style="text-align:left;">
                            <label for="name_book" class="form-label">Name of booking:</label>
                            @if ($booking=="") 
                                <input type="text" name="name_book" id="name_book" class="form-control" placeholder="Name booking" required>    
                            @else 
                                <input type="text" name="name_book" id="name_book" class="form-control" value="{{$booking->event->event}}" required>    
                            @endif
                          
                        </div>
                        <div class="mb-3" style="text-align:left;">
                            <label for="date_book" class="form-label">Date:</label>
                        {{-- Datetime-local incluye fecha y hora  --}}
                        {{-- Datetime incluye fecha, hora y zona horaria  --}}
                        <input type="datetime-local" name="date_book" id="date_book" class="form-control" required>
                        </div>
                        
                        <div class="mb-4" style="text-align:left;">
                            <label for="serv_book" class="form-label">Choose a service:</label>
                        <select name="serv_book" id="serv_book" class="form-select">
                           <?php
                           // Voy poniendo el nombre de cada servicio
                            foreach($services as $service){                            
                                ?>
                                @if ($booking=="") 
                                    <option value="{{$service->id}}">{{$service->name}} - {{$service->price}} $</option>                
                                @else 
                                    {{-- Muestro seleccionado ppor defecto --}}
                                    @if($booking->service->id==$service->id)
                                        <option value="{{$service->id}}" selected>{{$service->name}} - {{$service->price}} $</option>                
                                    @else
                                        <option value="{{$service->id}}" >{{$service->name}} - {{$service->price}} $</option>                
                                    @endif
                                @endif
                                
                                <?php
                            }
                            ?>
                        </select>
                        </div>

                        <div align="center">
                            <button type="submit" class="btn btn-secondary w-50" >Send</button>
                        </div>
                     
                    </form>
                </div>
                
            </div>  
        </div>                                            
</div>