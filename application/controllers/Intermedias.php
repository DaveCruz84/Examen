<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Intermedias extends CI_Controller
{
    /* Inicializar el constructor */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('pelicula');
        $this->load->model('usuario');
        $this->load->model('intermedia');

    }
    /* API REST 
        - index (spa)
        - create (Proceso) || (post)
        - list() (Vista) || (get)
        - view(?$id) (Vista) || (get)
        - update($id) (Proceso) || (post)
        - delete($id) (Proceso) || (post)
    */
    public function create()
    {
        // Recuperar la informacion
        $idpelicula = $this->input->post('idpelicula');
        $idusuario = $this->input->post('idusuario');
        $fechavisualizacion = $this->input->post('fechavisualizacion');
        $calificacion = $this->input->post('calificacion');
        
        // Crear el objeto
        $data = [
            'idpelicula' => $idpelicula,
            'idusuario' => $idusuario,
            'fechavisualizacion' => $fechavisualizacion,
            'calificacion' => $calificacion,

        ];
        // Guardar el registro
        $id = $this->intermedia->add($data);

        // $this->calcularTotalOrden($idpelicula);
        // Responder
        echo $id;
    }

    public function list($id)
    {
        $intermedias = $this->intermedia->obtenerPorPelicula($id);

        echo json_encode($intermedias);
    }

    public function delete()
    {
        $id = $this->input->post('id');
        $idpelicula = $this->input->post('idpelicula');

        $this->intermedia->delete($id);

        // $this->calcularTotalOrden($idpelicula);

        echo true;
    }

    private function calcularTotalOrden($id)
    {
        $intermedias = $this->intermedia->obtenerPorOrden($id);
        $total = 0;

        if ($intermedias) {
            foreach ($intermedias as $key => $detalle) {
                $total = $total + (float)$detalle->total;
            }
        }

        $this->orden->update($id, [
            'total' => $total,
        ]);

        return $total;
    }
}
