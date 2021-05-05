<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\NumSerie;
use App\Models\SerieEntregada;
use App\Models\DetalleSerieEntregada;

class SerieController extends Controller
{
    public function __construct() {
        $this->middleware('can:series.index')->only('index');
        $this->middleware('can:series.store')->only('store');
        $this->middleware('can:series.destroy')->only('destroy');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sql = trim($request->get('search'));
        return view('Procesos.Series.index', [
            'clientes' => Cliente::all(),
            'productos' => Producto::all(),
            'serieEntregadas' => SerieEntregada::searchByAndPaginate($sql),
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
        $series = explode("\r\n", $request->nombre);
        SerieEntregada::create([
            'num_pedido' => $request->num_pedido,
            'cliente_id' => $request->cliente_id,
        ]);
        $serie_id = SerieEntregada::select('id')->latest('id')->first();
        foreach($series as $serie) {
            NumSerie::create(['nombre' => $serie]);
            $num = NumSerie::select('id')->latest('id')->first();
            DetalleSerieEntregada::create([
                'serie_entregada_id' => $serie_id->id,
                'producto_id' => $request->producto_id,
                'serie_id' => $num->id,
            ]);
        }
        return back()->with('info', 'La serie se agrego con exito');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $serieEntregada = SerieEntregada::findOrFail($id);
        return view('Procesos.Series.ver', [
            'clientes' => Cliente::select('id', 'nombre')->get(),
            'productos' => Producto::select('id', 'clave')->get(),
            'series' => DetalleSerieEntregada::where('serie_entregada_id', $serieEntregada->id)->get(),
            'serieEntregada' => $serieEntregada,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SerieEntregada::findOrFail($id)->delete();
        return back()->with('info', 'El registro se elimino correctamente');
    }

}
