<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Editar Usuario</h1>
        </div>
        <div class="col-12">
            <a class="btn btn-link " href="<?php echo site_url('usuarios/index'); ?>" role="button"> <- Regresar</a>
        </div>
        <div class="col-12 col-md-8 mx-auto">
            <form action="<?php echo site_url('usuarios/update/') . $usuario->idusuario; ?>" method="POST">
                <div class="form-group">
                    <label for="nombre">Nombres</label>
                    <input idusuario="nombre" name="nombre" class="form-control" type="text" placeholder="Ingrese el nombre" required value="<?php echo $usuario->nombre; ?>">
                </div>                
                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input idusuario="correo" name="correo" class="form-control" type="email" placeholder="Ingrese el Correo" value="<?php echo $usuario->correo; ?>">
                </div>
                <div class="form-group">
                    <label for="contrasena">Contraseña</label>
                    <input idusuario="contrasena" name="contrasena" class="form-control" type="text" placeholder="Ingrese la Contraseña" value="<?php echo $usuario->contrasena; ?>">
                </div>                
                <div class="form-group text-right">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>