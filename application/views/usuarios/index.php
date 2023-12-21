<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Administración de Usuarios</h1>
        </div>        
        <div class="col-12 col-md-8 mx-auto">
            <form action="<?php echo site_url('usuarios/create');?>" method="POST">
                <div class="form-group">
                    <label for="nombre">Nombres</label>
                    <input id="nombre" name="nombre" class="form-control" type="text" placeholder="Ingrese el Nombre" required>
                </div>              
                <div class="form-group">
                    <label for="correo">Correo</label>
                    <input id="correo" name="correo" class="form-control" type="email" placeholder="Ingrese el Correo ">
                </div>
                <div class="form-group">
                    <label for="contrasena">Contraseña</label>
                    <input id="contrasena" name="contrasena" class="form-control" type="password" placeholder="Ingrese su Contraseña">
                </div>
               
                <div class="form-group text-center">
                    <button class="btn btn-primary" type="submit">Guardar</button>
                </div>
            </form>
        </div>       
        <div class="col-12 mt-4">
            <div class="table-responsive">
                <table class="table" id="tabla-usuarios">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Correo</th>
                            <th scope="col">Contraseña</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($usuarios) : ?>
                            <?php foreach ($usuarios as $index => $usuario) : ?>
                                <tr>
                                    <td><?php echo $usuario->idusuario; ?></td>
                                    <td><?php echo $usuario->nombre; ?></td>
                                    <td><?php echo $usuario->correo; ?></td>
                                    <td><?php echo $usuario->contrasena; ?></td>
                                    <td>
                                        <a class="btn btn-info" 
                                            href="<?php echo site_url('usuarios/edit/') . $usuario->idusuario; ?>">
                                            Editar
                                        </a>
                                        <a class="btn btn-danger" 
                                            href="<?php echo site_url('usuarios/delete/') . $usuario->idusuario; ?>">
                                            Eliminar
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<script>
     function crearTabla() {
        let table = new DataTable('#tabla-usuarios',{
            order:[[0,'asc']]
        });
    }

    $(() => {
        crearTabla();
    });
</script>