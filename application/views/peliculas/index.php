<!-- HTML -->
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1>Administración de Peliculas</h1>
        </div>        
        <div class="col-12 my-3">
            <div class="row align-items-center">
               <div class="col-6">
                <div class="form-group">
                    <div class="label">Titulo
                        <input type="text" id="titulo" class="form-control" required>
                    </div>
                </div>
               </div>
               <div class="col-6">
                <div class="form-group">
                    <div class="label">Genero
                        <input type="text" id="genero" class="form-control" required>
                    </div>
                </div>
               </div>
                <div class="col-6">
                    <div class="form-group">
                        <label for="">Año de Lanzamiento</label>
                        <input type="date" id="anolanzamiento" class="form-control" value="<?php echo date('Y-m-d'); ?>">
                    </div>
                </div>
                <div class="col-6">
                <div class="form-group">
                    <div class="label">Director
                        <input type="text" id="director" class="form-control" required>
                    </div>
                </div>
               </div>

                <div class="col-12 text-right">
                    <button type="button" id="btn-agregar" onclick="agregarRegistro();" class="btn btn-primary">Nueva Pelicula</button>
                </div>
            </div>
        </div>
        <div class="col-12 mb-3">
            <table class="table" id="tabla-peliculas">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>titulo</th>
                        <th>genero</th>
                        <th>lanzamiento</th>
                        <th>director</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</div>
<!-- HTML -->
<!-- SCRIPT -->
<script>
    async function cargarTabla() {
        table.destroy();

        await $.get('<?php echo site_url('peliculas/list'); ?>', {}, function(data) {
            let result = JSON.parse(data);
            if (result.length > 0) {
                for (let i = 0; i < result.length; i++) {
                    const pelicula = result[i];
                    let row = `
                    <tr>
                        <td>${pelicula.idpelicula}</td>
                        <td>${pelicula.titulo}</td>
                        <td>${pelicula.genero}</td>
                        <td>${pelicula.anolanzamiento}</td>
                        <td>${pelicula.director}</td>
                        <td>
                        <a href="<?php echo site_url('peliculas/gestion/'); ?>${pelicula.idpelicula}" class="btn btn-info">
                            <i class="fa-regular fa-file-lines"></i>
                        </a>
                        <button type="button" class="btn btn-danger" onclick="eliminarRegistro(this, ${pelicula.idpelicula})">
                            <i class="fas fa-trash"></i>
                        </button>
                        </td>
                    </tr>
                    `;
                    $('#tabla-peliculas tbody').prepend(row);
                }
            }
        });
        table = $('#tabla-peliculas').DataTable();
    }

    async function agregarRegistro() {
        table.destroy();
        // Recuperar datos
        let titulo = $('#titulo').val();
        let genero = $('#genero').val();
        let anolanzamiento = $('#anolanzamiento').val();
        let director = $('#director').val();

        // Validar
        if (titulo == '' ) {
            alert('titulo requerido');
            return;
        }


        // Almacenar
        await $.post('<?php echo site_url('peliculas/create'); ?>', {
            titulo: titulo,
            genero: genero,
            anolanzamiento: anolanzamiento,
            director:director
        }, function(data) {
            let row = `
                    <tr>
                        <td>${data}</td>
                        <td>${titulo}</td>
                        <td>${genero}</td>
                        <td>${anolanzamiento}</td>
                        <td>${director}</td>
                        <td>
                        <a href="<?php echo site_url('peliculas/gestion/'); ?>${data}" class="btn btn-info">
                            <i class="fa-regular fa-file-lines"></i>
                        </a>
                        <button type="button" class="btn btn-danger" onclick="eliminarRegistro(this, ${data})">
                            <i class="fas fa-trash"></i>
                        </button>
                        </td>
                    </tr>
                    `;
            $('#tabla-peliculas tbody').prepend(row);
        });
        table = $('#tabla-peliculas').DataTable();
    }

    async function eliminarRegistro(element, id) {
        table.destroy();
        // Envio a eliminar
        await $.post(`<?php echo site_url('peliculas/delete/'); ?>${id}`, {}, function(data) {
            // Si se pudo eliminar
            if (data) {
                // Elimina del front
                $(element).parents('tr').remove();
            }
        });
        table = $('#tabla-peliculas').DataTable();
    }
    
    let table = null;
    // Globales
    $(async () => {
        table = $('#tabla-peliculas').DataTable()
        await cargarTabla();

    });
</script>
<!-- SCRIPT -->