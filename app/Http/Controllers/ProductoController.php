<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use App\Exports\ProductosExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductosImport;

class ProductoController extends Controller
{
    public function __construct() {
        $this->middleware('can:productos.index')->only('index');
        $this->middleware('can:productos.store')->only('store');
        $this->middleware('can:productos.update')->only('edit', 'update');
        $this->middleware('can:productos.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function index(Request $request)
    {
        $sql = trim($request->get('search'));
        return view('catalogos.productos.index', [
            'productos' => Producto::searchAndPaginate($sql),
            'proveedores' => Proveedor::select('id', 'nombre')->get(),
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
        Producto::create($request->all());
        return back()->with('info', 'El rol se creo con exito');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('catalogos.productos.edit', [
            'producto' => Producto::findOrFail($id),
            'proveedores' => Proveedor::select('id', 'nombre')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->update($request->all());
        return back()->with('info', 'Se modifico el proveedor con exito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        producto::findOrFail($id)->delete();
        return back()->with('info', 'Se elimino el proveedor con exito');
    }

    public function import()
    {
        Excel::import(new ProductosImport, request()->file('excel'));
        return back()->with('info', 'Se importa la informacion con exito');
    }

    public function export()
    {
        return Excel::download(new ProductosExport, 'productos.xlsx');
    }
}
