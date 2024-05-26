@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-12" align="center">

        <div class="col-12" align="left">
            <h1>Edit user</h1>
        </div>
        <div class="col-12 mb-5 mt-4" align="left">
            <a href="{{route('privilege.index')}}" class="btn btn-outline-danger">Back</a>
        </div>
        <div class="card shadow col-9" align="left">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Edit a user</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('privilege.update',$user->id)}}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3" >
                        <label class="form-label" align="left">
                            Name:
                        </label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$user->name}}" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label">
                            Email:
                        </label>
                        <input type="email" name="email" id="email" class="form-control" value="{{$user->email}}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">
                            Phone:</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{$user->phone}}" required> 
                    </div>
                    <div class="mb-1">
                       
                            Role:    
                          <br/> 
                        <input type="radio" class="form-check-input" name="role" id="admin" value="1" > Admin    
                    </div>
                    <div class="mb-3">                         
                        <input type="radio" class="form-check-input" name="role" id="user" value="2" checked>
                       User 
                    </div>
                    <div class="mb-3" align="center">
                        <input type="submit" class="btn btn-primary w-50"  value="Update">
                    </div>
                    
                    
                    
                    
                    
                    
                    
                     
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

