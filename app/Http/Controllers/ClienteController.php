<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Exports\ClientesExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ClientesImport;

class ClienteController extends Controller
{
    public function __construct() {
        $this->middleware('can:clientes.index')->only('index');
        $this->middleware('can:clientes.store')->only('store');
        $this->middleware('can:clientes.update')->only('edit', 'update');
        $this->middleware('can:clientes.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sql = trim($request->get('search'));
        return view('catalogos.clientes.index', [
            'clientes' => Cliente::searchAndPaginate($sql),
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
        Cliente::create($request->all());
        return back()->with('info', 'El rol se creo con exito');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('catalogos.clientes.edit', [
            'cliente' => Cliente::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->update($request->all());
        return back()->with('info', 'Se modifico el proveedor con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cliente::findOrFail($id)->delete();
        return back()->with('info', 'Se elimino el proveedor con exito');
    }

    public function import()
    {
        Excel::import(new ClientesImport, request()->file('excel'));
        return back()->with('info', 'Se importa la informacion con exito');
    }

    public function export()
    {
        return Excel::download(new ClientesExport, 'clientes.xlsx');
    }
}
