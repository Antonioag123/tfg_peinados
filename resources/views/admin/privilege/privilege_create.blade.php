@extends('layouts.app')

@section('content')
<div class="container">

    <div class="col-12" align="center">
        <div class="col-12" align="left">
            <h1>Create user</h1>
        </div>
        <div class="col-12 mb-5 mt-4" align="left">
            <a href="{{route('privilege.index')}}" class="btn btn-outline-danger">Back</a>
        </div>
        <div class="card shadow col-9" align="left">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Create a user</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('privilege.store')}}">
                    @csrf
                    <div class="mb-3">                     
                        <label class="form-label" align="left">
                            Name:
                            <input type="text" class="form-control" name="name" id="name">
                        </label>
                        @error('name')
                            <p>{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3">                     
                        <label class="form-label" align="left">
                            Password:
                        </label>
                        <input type="password" class="form-control" name="password" id="password">    
                    
                    @error('password')
                    <p>{{$message}}</p>
                    @enderror
                    </div>
                    <div class="mb-3"> 

                        <label class="form-label" align="left">
                            Email:
                        </label>
                        <input type="email" class="form-control" name="email" id="email">
                    
                        @error('email')
                        <p>{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3"> 
                        <label class="form-label" align="left">
                            Phone:
                        </label>
                        <input type="text" class="form-control" name="phone" id="phone">                    
                        @error('phone')
                        <p>{{$message}}</p>
                        @enderror
                    </div>
                    <div class="mb-3"> 
                        Role: 
                        <br>
                        <input type="radio" class="form-check-input" name="role" id="admin" value="1" > Admin        
                    </div>
                    <div class="mb-3"> 
                        <input type="radio" class="form-check-input" name="role" id="user" value="2" checked> User       
                    </div>
                                      
                    <div class="mb-3" align="center"> 
                        <input type="submit" class="btn btn-primary w-50" value="Create">
                    </div>
                </form>
            </div>
        </div>
        
    </div>
</div>
@endsection

{{-- 
<x-index>
    <form method="POST" action="{{route('privilege.store')}}">
        @csrf

        <label>
            Name:
            <input type="text" name="name" id="name">
        </label>
        @error('name')
            <p>{{$message}}</p>
        @enderror
        <br/>
        <label>
            Password:
            <input type="password" name="password" id="password">    
        </label>
        @error('password')
        <p>{{$message}}</p>
        @enderror
        <br/>
        <label>
            Email:
            <input type="email" name="email" id="email">
        </label>
        @error('email')
        <p>{{$message}}</p>
        @enderror
        <br/>
        <label>
            Phone:
            <input type="text" name="phone" id="phone">
        </label>
        @error('phone')
        <p>{{$message}}</p>
        @enderror
        <br/>
        <label>
            Role:        
            <input type="radio" name="role" id="admin" value="1" > Admin        
        </label>
        <label>
            <input type="radio" name="role" id="user" value="2"> User       
        </label>
        <br/>   
        <input type="submit" value="Create">
    </form>
</x-index> --}}