<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Peliculas extends CI_Controller
{
    /* Inicializar el constructor */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('usuario');
        $this->load->model('pelicula');
        $this->load->model('intermedia');

    }
    /* API REST
        - index(SPA)
        - create (Proceso) || (post)
        - view(?$id) (Vista) || (get)
        - update($id) (Proceso) || (post)
        - delete($id) (Proceso) || (post)
    */
    public function index() // get
    {
        $data = [
            'usuarios' => $this->usuario->list(),
        ];

        $this->load->view('template/header');
        $this->load->view('peliculas/index', $data);
        $this->load->view('template/footer');
        return;
    }

    public function create() // post
    {
        $titulo = $this->input->post('titulo');
        $genero = $this->input->post('genero');
        $anolanzamiento = $this->input->post('anolanzamiento');
        $director = $this->input->post('director');


        $data = [
            'titulo' => $titulo,
            'genero' => $genero,
            'anolanzamiento' => $anolanzamiento,
            'director' => $director,
        ];

        echo $this->pelicula->add($data);
    }

    public function list() // get
    {
        echo json_encode($this->pelicula->listarPeliculasUsuarios());
    }

    public function delete($id) // post
    {
        $this->pelicula->delete($id);
        echo true;
    }

    public function update($id)
    {
        // Recupero informacion
        $titulo = $this->input->post('titulo');
        $genero = $this->input->post('genero');
        $anolanzamiento = $this->input->post('anolanzamiento');
        $director = $this->input->post('director');

        // Armo el array o data
        $data = [
            'titulo' => $titulo,
            'genero' => $genero,
            'anolanzamiento' => $anolanzamiento,
            'director' => $director,

        ];
        // Almaceno
        $this->pelicula->update($id, $data);
        // Envio respuesta
        echo true;
    }

    // Funciones Personalizadas del controlador
    public function gestion($id)
    {
        $pelicula = $this->pelicula->find($id);
        $usuarios = $this->usuario->list();
        $intermedias = $this->intermedia->list();

        $data = [
            'pelicula' => $pelicula,
            // 'intermedias' => $intermedias,
            'usuarios' => $usuarios,
        ];
        $this->load->view('template/header');
        $this->load->view('peliculas/gestion', $data);
        $this->load->view('template/footer');
    }

    public function obtenerTotal($id)
    {
        $pelicula = $this->pelicula->find($id);
        echo $pelicula->total;
    }
}
