<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\RoleRequest;
use Illuminate\Support\Facades\Gate;

class RoleController extends Controller
{
    public function index():View
    {
        $users = User::all();
        return view('admin.privilege.privilege_index', compact('users'));
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create():View
    {
        return view('admin.privilege.privilege_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RoleRequest $request):RedirectResponse
    {   
        $user=new User();
        $user->name=$request->name;
        $user->password=$request->password;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->save();
        // En el caso de que haya un rol
        if ($request->has('role')) {
            // Obtengo el nombre del rol
            $roleID = $request->role;           
            // Encuentro el Role
            $role = Role::find($roleID);
            //Sincronizo las relaciones 
            $user->roles()->sync($role);            
        }
        return redirect()->route('privilege.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user):View
    {
        // Para un futuro. Quiero que desde aquí pueda ver lo que el usuario ha comprado y la información de las citas pedidas 
        return view('admin.privilege.privilege_show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user):View
    {
        
        return view('admin.privilege.privilege_edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user):RedirectResponse
    {

        $user->name=$request->name;
        $user->email=$request->email;
        $user->phone=$request->phone;
        $user->save();

        if ($request->has('role')) {
            // Obtengo el nombre del rol
            $roleID = $request->role;           
            // Encuentro el Role
            $role = Role::find($roleID);
            //Sincronizo las relaciones 
            $user->roles()->sync($role);            
        }

        return redirect()->route('privilege.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user):RedirectResponse
    {   
        $user->delete();

        return redirect()->route('privilege.index');
    }
}
