<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="text-center">Reportes de Peliculas</h1>
        </div>     
        <div class="col-6 mb-4">
            <div>Gráfico de Barras - Calificaciones de Películas</div>
            <div class="d-flex justify-content-center" style="position: relative; max-height:50vh;">
                <canvas id="graficoBarras"></canvas>
            </div>
        </div>
        <div class="col-6 mb-4">
            <div>Gráfico de pastel - Peliculas mas Vistas</div>
            <div class="d-flex justify-content-center" style="position: relative; max-height:50vh;">
                <canvas id="graficoPastel"></canvas>
            </div>
        </div>
        <div class="col-12 mb-4">
            <div>Tabla</div>
            <table class="table" id="tabla-usuarios">
                <thead>
                    <tr>
                        <th># Generos</th>
                        <th>Genero</th>
                    </tr>
                </thead>
                <tbody>
                 <?php if($generoMasVisto):?>
                    <?php foreach($generoMasVisto as $index => $genero):?>
                        <tr>
                            <td><?php echo $genero->cantidad;?></td>
                            <td><?php echo $genero->genero;?></td>

                        </tr>
                    <?php endforeach;?>
                 <?php endif;?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    function crearGraficoBarra() {
        // Recuperar el elemento
        const ctx = document.getElementById('graficoBarras');
        // Crear el gráfico
        // Crear la data
        let labels = [];
        <?php if ($labelsBarras) : ?>
            <?php foreach ($labelsBarras as $index => $label) : ?>
                labels.push('<?php echo $label; ?>');
            <?php endforeach; ?>
        <?php endif; ?>

        let valuesData = [];
        <?php if ($valuesData) : ?>
            <?php foreach ($valuesData as $index => $valueData) : ?>
                valuesData.push('<?php echo $valueData; ?>');
            <?php endforeach; ?>
        <?php endif; ?>

        let data = {
            labels: labels, // Eje horizontal (EJE X)
            datasets: [{
                label: 'Calificacion Realizada', // Descripcion
                data: valuesData, // Eje vertical (EJE Y)
            }]
        };
        // Crear Opciones
        let options = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };
        // Crear configuracion 
        let config = {
            type: 'bar', // Tipo de grafico
            data: data, // Grupo de informacion
            options: options // Opciones
        };

        let grafico = new Chart(ctx, config);
    }

    function crearGraficoBarraxMes() {
        // Recuperar el elemento
        const ctx = document.getElementById('graficoBarrasxMes');
        // Crear el gráfico
        // Crear la data
        let labels = [];
        <?php if ($labelsBarras) : ?>
            <?php foreach ($labelsBarras as $index => $label) : ?>
                labels.push('<?php echo $label; ?>');
            <?php endforeach; ?>
        <?php endif; ?>

        let valuesData = [];
        <?php if ($valuesData) : ?>
            <?php foreach ($valuesData as $index => $valueData) : ?>
                valuesData.push('<?php echo $valueData; ?>');
            <?php endforeach; ?>
        <?php endif; ?>

        let data = {
            labels: labels, // Eje horizontal (EJE X)
            datasets: [{
                label: 'Calificacion Realizada', // Descripcion
                data: valuesData, // Eje vertical (EJE Y)
            }]
        };
        // Crear Opciones
        let options = {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        };
        // Crear configuracion 
        let config = {
            type: 'bar', // Tipo de grafico
            data: data, // Grupo de informacion
            options: options // Opciones
        };

        let grafico = new Chart(ctx, config);
    }

    
    function crearGraficoPastel() {
        // Recuperar el elemento
        const ctx = document.getElementById('graficoPastel');
        let labels = [];
        <?php if ($labelsPastel) : ?>
            <?php foreach ($labelsPastel as $index => $label) : ?>
                labels.push('<?php echo $label; ?>');
            <?php endforeach; ?>
        <?php endif; ?>

        let valuesData = [];
        <?php if ($valuesPastel) : ?>
            <?php foreach ($valuesPastel as $index => $valueData) : ?>
                valuesData.push('<?php echo $valueData; ?>');
            <?php endforeach; ?>
        <?php endif; ?>
        // Creo la data
        let data = {
            labels:labels,
            datasets: [{
                label: 'Número de peliculas',
                data: valuesData,
            }]
        };
        // Creamos las opciones
        let options = {};
        // Crear el gráfico
        new Chart(ctx, {
            type: 'pie',
            data: data,
            options: options
        });
    }

    function crearTabla() {
        let table = new DataTable('#tabla-usuarios',{
            order:[[0,'desc']]
        });
    }
    $(() => {
        crearGraficoBarra();
        crearGraficoPastel();
        crearTabla();
    })
</script>