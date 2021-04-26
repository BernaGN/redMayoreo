<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function __construct() {
        $this->middleware('can:productos.index')->only('index');
        $this->middleware('can:productos.store')->only('store');
        $this->middleware('can:productos.update')->only('update');
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $producto = Producto::findOrFail($request->id);
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
}
