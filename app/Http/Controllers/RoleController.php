<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{

    public function index()
    {
        return view('admin.roles.index', [
            'roles' => Role::all()
        ]);
    }

    public function edit(Role $role)
    {
       return view('admin.roles.edit', ['role'=>$role]);
    }

    public function store()
    {
        request()->validate([
            'name' => ['required']
        ]);

        Role::create([
            'name' => Str::ucfirst(request('name')),
            'slug' => Str::of(Str::lower(request('name')))->slug('_')
        ]);

        return back();
    }

    public function update(Role $role)
    {
//        request()->validate([
//            'name' => ['required']
//        ]);

        $role->name = Str::ucfirst(request('name'));
        $role->slug = Str::of(request('name'))->slug('_');



        if($role->isDirty('name'))
        {
            session()->flash('role-updated', 'The Role '. $role->name. ' has been successfully updated!');
            $role->save();
        }
        else{
            session()->flash('role-updated', 'Nothing has been updated');
        }


        return back();
    }

    public function destroy(Role $role)
    {
        $role->delete();

        session()->flash('role-delete', 'The Role '. $role->name. ' has been successfully deleted!');
        return back();
    }

}
