@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-12 mb-4 mt-3">
       <h1>User list</h1>
    </div>
    <div class="col-12 mb-4 mt-3">
        <a class="btn btn-outline-primary" href="{{route('privilege.create')}}">Create user</a>
    </div>
   
    <table class="table table-light table-hover">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th>
        </tr>
       
        @foreach ($users as $user)
        {{-- En el caso de que el usuario sea el que está conectado, podrás identificarlo más facil con color --}}
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>   
            @foreach ($user->roles as $role)
                <td>{{$role->name}}</td>    
            @endforeach
            
            <td><a class="btn btn-outline-secondary" href="{{route('privilege.edit',$user->id)}}"><i class="bi bi-pencil-square"></i> EDIT</a></td>
            <td>
                <form action="{{route('privilege.destroy',$user->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger"><i class="bi bi-trash3"></i></button>
                    
                </form>
            </td>
           
        </tr>             
        @endforeach
    
    </table>
</div>
@endsection


{{-- <x-index>
    <a href="{{route('privilege.create')}}">Create user</a>
    <table class="table table-light table-hover">
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Role</th>
        </tr>
       
        @foreach ($users as $user)
        <tr>
            <td>{{$user->name}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->phone}}</td>   
            @foreach ($user->roles as $role)
                <td>{{$role->name}}</td>    
            @endforeach
            
            <td><a href="{{route('privilege.edit',$user->id)}}">EDIT</a></td>
            <td>
                <form action="{{route('privilege.destroy',$user->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="DELETE">
                </form>
            </td>
            <td><a href="{{route('privilege.show',$user->id)}}">Ver</a></td>
        </tr>             
        @endforeach
    
    </table>
</x-index> --}}
