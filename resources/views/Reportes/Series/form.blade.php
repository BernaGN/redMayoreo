<div class="form-group">
    <form action="{{ route('reporte-series-pdf') }}" method="GET">
        <p>
            <input type="radio" name="interesado" value="num_pedido" id="pedido" checked> Numero de
            Pedido
            <input type="radio" name="interesado" value="fecha" id="fecha"> Fechas
        </p>
        <label class="h5">Numero de Pedido</label>
        <input class="form-control" name="id" id="num_pedido" type="text">
        <hr>
        <label class="h5">Fecha Inicio</label>
        <input class="form-control" name="desde" id="desde" type="datetime-local"
            value="<?php echo date('d/m/Y H:i:s'); ?>">
        <label class="h5">Fecha fin</label>
        <input class="form-control" name="hasta" id="hasta" type="datetime-local"
            value="<?php echo date('d/m/Y H:i:s'); ?>">

        <button type="submit" class="btn btn-primary mt-2">Buscar</button>
        @csrf
    </form>
</div>
