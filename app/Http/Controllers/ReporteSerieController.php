<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use App\Models\Cliente;
use App\Models\Producto;
use App\Models\NumSerie;
use App\Models\SerieEntregada;
use App\Models\DetalleSerieEntregada;

class ReporteSerieController extends Controller
{

    public function pdf(Request $request)
    {
        if(SerieEntregada::count() == 0)
            return redirect()->route('series.index');
        if($request->interesado == 'fecha') {
            $deste = date("Y/d/m H:i", strtotime($request->desde));
            $hasta = date("Y/d/m H:i", strtotime($request->hasta));
            $pdf = \PDF::loadView('pdf.series.reporteFechas', [
                'serieEntregada' => SerieEntregada::whereBetween('created_at', [$deste, $hasta])->get(),
                'clientes' => Cliente::select('id', 'nombre')->get(),
                'productos' => Producto::select('id', 'clave')->get(),
                'series' => DetalleSerieEntregada::whereBetween('created_at', [$deste, $hasta])->get(),
            ]);
            return $pdf->download('Series-'.$serieEntregada->num_pedido.'.pdf');
        }
        else {
            $serieEntregada = SerieEntregada::where('num_pedido', $request->id)->first();
            $pdf = \PDF::loadView('pdf.series.reportePedido', [
                'clientes' => Cliente::select('id', 'nombre')->get(),
                'productos' => Producto::select('id', 'clave')->get(),
                'series' => DetalleSerieEntregada::where('serie_entregada_id', $serieEntregada->id)->get(),
                'serieEntregada' => $serieEntregada,
            ]);
            return $pdf->download('Series-'.$serieEntregada->num_pedido.'.pdf');
        }
    }
}
