<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use App\Exports\ProveedoresExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProveedoresImport;

class ProveedorController extends Controller
{
    public function __construct() {
        $this->middleware('can:proveedores.index')->only('index');
        $this->middleware('can:proveedores.store')->only('store');
        $this->middleware('can:proveedores.update')->only('edit', 'update');
        $this->middleware('can:proveedores.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sql = trim($request->get('search'));
        return view('catalogos.proveedores.index', [
            'proveedores' => Proveedor::searchAndPaginate($sql),
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
        Proveedor::create($request->all());
        return back()->with('info', 'El rol se creo con exito');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('catalogos.proveedores.edit', [
            'proveedor' => Proveedor::findOrFail($id),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->update($request->all());
        return back()->with('info', 'Se modifico el proveedor con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Proveedor  $proveedor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Proveedor::findOrFail($id)->delete();
        return back()->with('info', 'Se elimino el proveedor con exito');
    }

    public function import()
    {
        Excel::import(new ProveedoresImport, request()->file('excel'));
        return back()->with('info', 'Se importa la informacion con exito');
    }

    public function export()
    {
        return Excel::download(new ProveedoresExport, 'proveedores.xlsx');
    }
}
