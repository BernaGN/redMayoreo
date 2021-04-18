<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DB;

class UsuarioController extends Controller
{
    public function __construct() {
        $this->middleware('can:usuarios.index')->only('index');
        $this->middleware('can:usuarios.store')->only('store');
        $this->middleware('can:usuarios.update')->only('update');
        $this->middleware('can:usuarios.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sql = trim($request->get('search'));
        return view('sistema.usuarios.index', [
            'usuarios' => User::searchByAndPaginate($sql),
            'roles' => Role::all(),
            'texto' => $sql,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        if($archivo = $request->file('foto'))
        {
            $archivo->move('images/fotos', $archivo->getClientOriginalName());
            $user['foto'] = 'images/fotos/'.$archivo->getClientOriginalName();
        }
        $user->save();
        $user->roles()->sync($request->roles);
        return back()->with('info', 'El registro se guardo correctamente');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update(['name' => $request['name']]);
        $user->roles()->sync($request->roles);
        return back()->with('info', 'El registro se modifico correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('info', 'El registro se elimino correctamente');
    }
}
