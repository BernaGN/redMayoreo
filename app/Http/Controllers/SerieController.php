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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('Procesos.Series.index', [
            'clientes' => Cliente::all(),
            'productos' => Producto::all(),
            'serieEntregadas' => SerieEntregada::paginate(),
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
    public function edit($id)
    {
        $serieEntregada = SerieEntregada::findOrFail($id);
        return view('Procesos.Series.edit', [
            'clientes' => Cliente::select('id', 'nombre')->get(),
            'productos' => Producto::select('id', 'clave')->get(),
            'series' => DetalleSerieEntregada::where('serie_entregada_id', $serieEntregada->id)->get(),
            'serieEntregada' => $serieEntregada,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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

    public function pdf(Request $request, $id)
    {
        $serieEntregada = SerieEntregada::where('num_pedido', $id)->first();
        $pdf = \PDF::loadView('pdf.series.index', [
            'clientes' => Cliente::select('id', 'nombre')->get(),
            'productos' => Producto::select('id', 'clave')->get(),
            'series' => DetalleSerieEntregada::where('serie_entregada_id', $serieEntregada->id)->get(),
            'serieEntregada' => $serieEntregada,
        ]);
        return $pdf->download('Series-'.$serieEntregada->num_pedido.'.pdf');
    }

}
