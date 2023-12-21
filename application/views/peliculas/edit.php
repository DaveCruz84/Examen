<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Editar orden</h1>
        </div>
        <div class="col-12">
            <a class="btn btn-link " href="<?php echo site_url('ordenes/index'); ?>" role="button"> <- Regresar</a>
        </div>
        <div class="col-12 col-md-8 mx-auto">
            <form action="<?php echo site_url('ordenes/update/') . $orden->id; ?>" method="POST">          
            <div class="form-group">
                    <label for="fecha">Fecha</label>
                    <input id="fecha" name="fecha" class="form-control" type="date" placeholder="Ingrese la Fecha" required value="<?php echo $orden->fecha; ?>">
                </div>
                <div class="form-group">
                    <label for="cantidad">Cantidad</label>
                    <input id="cantidad" name="cantidad" class="form-control" type="text" placeholder="Ingrese el cantidad" required value="<?php echo $orden->cantidad; ?>">
                </div>                             
                <div class="form-group mb-4">
                    <label for="id_cliente">Cliente</label>
                    <select name="id_cliente" id="id_cliente" class="form-control" required>
                        <option value="">Seleccione un cliente</option>
                        <?php if ($clientes) : ?>
                            <?php foreach ($clientes as $cliente) : ?>
                                <option <?php echo $orden->idcliente == $cliente->id ? 'selected' :''; ?> value="<?php echo $cliente->id; ?>">
                                <?php echo $cliente->nombre; ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group text-right">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>