<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Usuarios extends CI_Controller
{
    /* Inicializar el constructor */
    public function __construct()
    {
        parent::__construct();
        $this->load->model('usuario');
    }
    /* API REST FULL
        - index
        - add (Vista) || (get)
        - create (Proceso) || (post)
        - edit($id) (Vista) || (get)
        - update($id) (Proceso) || (post)
        - delete($id) (Proceso) || (post)
    */
    public function index() // get
    {
        $usuarios = $this->usuario->list();
        $data = [
            'usuarios' => $usuarios,
        ];

        // Header
        $this->load->view('template/header');
        // Main
        $this->load->view('usuarios/index', $data);
        // Footer
        $this->load->view('template/footer');
        return;
    }
    public function add() // get
    {
        $data = [];
        $this->load->view('template/header');
        $this->load->view('usuarios/add', $data);
        $this->load->view('template/footer');
        return;
    }
    public function create() // post
    {
        $nombre = $this->input->post('nombre');
        $correo = $this->input->post('correo');
        $contrasena = $this->input->post('contrasena');
        $data = [
            'nombre' => $nombre,
            'correo' => $correo,
            'contrasena' => $contrasena,
        ];

        $this->usuario->add($data);

        redirect('usuarios/index');
        return;
    }
    public function edit($id) // get
    {
        // Recuperar el registro
        $usuario = $this->usuario->find($id);
        $data = [
            'usuario' => $usuario
        ];

        $this->load->view('template/header');
        $this->load->view('usuarios/edit', $data);
        $this->load->view('template/footer');
    }
    public function update($id) // post
    {
        $nombre = $this->input->post('nombre');
        $correo = $this->input->post('correo');
        $contrasena = $this->input->post('contrasena');

        $data = [
            'nombre' => $nombre,
            'correo' => $correo,
            'contrasena' => $contrasena,
        ];

        $this->usuario->update($id, $data);
        redirect('usuarios/index');

        return;
    }
    public function delete($id) // post
    {
        $this->usuario->delete($id);
        redirect('usuarios/index');
        return;
    }
}
