<!-- HTML -->
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Actualizacion de Peliculas</h1>
        </div>
        <div class="col-12">
            <a href="<?php echo site_url('peliculas/index'); ?>">Regresar a Peliculas</a>
        </div>
        <div class="col-12 my-3">
            <div class="row align-items-center">
                <div class="col-6">
                    <div class="form-group">
                        <label for="titulo">Titulo</label>
                        <input id="titulo" name="titulo" class="form-control" type="text" placeholder="Ingrese el Titulo" required value="<?php echo $pelicula->titulo; ?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="genero">Genero</label>
                        <input id="genero" name="genero" class="form-control" type="text" placeholder="Ingrese el Genero" required value="<?php echo $pelicula->genero; ?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Año de Lanzamiento</label>
                        <input id="anolanzamiento" class="form-control" type="date" value="<?php echo $pelicula->anolanzamiento; ?>">
                    </div>
                </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="director">Director</label>
                        <input id="director" name="director" class="form-control" type="text" placeholder="Ingrese el Director" required value="<?php echo $pelicula->director; ?>">
                    </div>
                </div>
                <div class="col-12 text-right">
                    <button type="button" class="btn btn-primary" onclick="actualizarRegistro();">Actualizar pelicula</button>
                </div>
            </div>
        </div>
        <div class="col-12 mb-3">
            <h3>Agregar Calificacion</h3>
            <div class="row align-items-end">
            <div class="col-4">
                    <div class="form-group">
                        <label for="">Usuarios</label>
                        <select name="" id="usuario" class="form-control" required>
                            <option value="">Seleccione un Usuario</option>
                            <?php if ($usuarios) : ?>
                                <?php foreach ($usuarios as $index => $usuario) : ?>
                                    <option value="<?php echo $usuario->idusuario; ?>">
                                        <?php echo $usuario->nombre; ?>
                                    </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Fecha de Visualizacion</label>
                        <input type="date" id="fechavisualizacion" class="form-control">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="">Calificacion</label>
                        <input type="number" id="calificacion" class="form-control" max="5" min="1">
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <button type="button" id="btn-agregarDetalle" onclick="agregarIntermedia();" class="btn btn-warning">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <h3>Lista de usuario</h3>
            </div>
            <div class="col-12">
                <table class="table" id="tabla-intermedia">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Usuario</th>
                            <th>FechaVisualizacion</th>
                            <th>Calificacion</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- HTML -->
<!-- SCRIPT -->
<script>
    function actualizarRegistro() {
        let titulo = $('#titulo').val();
        let genero = $('#genero').val();
        let anolanzamiento = $('#anolanzamiento').val();
        let director = $('#director').val();


        if (!titulo) {
            alert('El titulo es requerido');
            return;
        }
        $.post('<?php echo site_url('peliculas/update/') . $pelicula->idpelicula; ?>', {
            titulo: titulo,
            genero: genero,
            anolanzamiento: anolanzamiento,
            director:director
        }, function(data) {
            console.log(data);
        });
    }

    function agregarIntermedia() {
        // Recupera valores
        let idusuario = $('#usuario option:selected').val();
        let usuarioNombre = $('#usuario option:selected').text();
        // Recuperar metadata
        let fechavisualizacion = $('#fechavisualizacion').val();
        let calificacion = $('#calificacion').val();
        
        // Validacion
        if (!idusuario) {
            alert('usuario requerido');
            return;
        }

        if (!calificacion || parseInt(calificacion) <= 0) {
            alert('calificacion invalida');
            return;
        }
        // Envio de la data
        $.post('<?php echo site_url('intermedias/create'); ?>', {
            fechavisualizacion : fechavisualizacion,
            calificacion: calificacion,
            idpelicula: '<?php echo $pelicula->idpelicula; ?>',
            idusuario: idusuario,
        }, function(data) {
            // Actualizar tabla
            $('#tabla-intermedia tbody').prepend(`
            <tr>
                <td>${data}</td>
                <td>${usuarioNombre}</td>
                <td>${fechavisualizacion}</td>
                <td>${calificacion}</td>
                <td>
                    <button class="btn btn-danger" onclick="eliminarintermedia(this, ${data})">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
            </tr>
            `);
            // obtenerTotal();
        });
    }

    // function obtenerTotal() {
    //     $.get('<?php echo site_url('peliculas/obtenerTotal/') . $pelicula->idpelicula; ?>', {}, function(data) {
    //         $('#total-pelicula').text(data);
    //     });
    // }

    function cargarCalificaciones() {
        $.get('<?php echo site_url('intermedias/list/') . $pelicula->idpelicula; ?>', {}, function(data) {
            let response = JSON.parse(data);
            if (response.length > 0) {
                for (let i = 0; i < response.length; i++) {
                    const element = response[i];
                    $('#tabla-intermedia tbody').prepend(`
                    <tr>
                        <td>${element.idintermedia}</td>
                        <td>${element.nombre}</td>
                        <td>${element.fechavisualizacion}</td>
                        <td>${element.calificacion}</td>
                        <td>
                            <button class="btn btn-danger" onclick="eliminarDetalle(this, ${element.idintermedia})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
                    `);
                }
            }

        });
    }

    function eliminarDetalle(ele, id) {
        // Enviar a eliminar
        $.post('<?php echo site_url('intermedias/delete'); ?>', {
            id: id,
            peliculaid: '<?php echo $pelicula->idpelicula; ?>'
        }, function(data) {
            // Eliminamos la fila
            $(ele).parents('tr').remove();
            obtenerTotal();
        })
    }



    $(() => {
        cargarCalificaciones();
        // obtenerTotal();
    });
</script>