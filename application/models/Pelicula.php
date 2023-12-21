<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Pelicula extends CI_Model
{
    private $nombreTabla;
    private $idTabla;

    public function __construct()
    {
        parent::__construct();
        $this->nombreTabla = 'pelicula';
        $this->idTabla = 'idpelicula';
    }
    /* CRUD */
    // CREATE
    public function add($data)
    {
        $this->db->insert($this->nombreTabla, $data);
        return $this->db->insert_id();
    }
    // READ
    public function list($params = []) // Entrega todos los resultados
    {
        $query = $this->db->get($this->nombreTabla);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function get($params = array(), $order_by = array(), $limit = '') // Entrega resultados condicionados
    {
        if (!empty($params)) {
            foreach ($params as $field => $value) {
                $this->db->where($field, $value);
            }
        }

        if (!empty($order_by)) {
            foreach ($order_by as $field => $direction) {
                $this->db->order_by($field, $direction);
            }
        }

        if (!empty($limit)) {
            $this->db->limit($limit);
        }

        $query = $this->db->get($this->nombreTabla);

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function find($id) // Entrega un unico registro por ID
    {
        $this->db->where($this->idTabla, $id);

        $query = $this->db->get($this->nombreTabla);

        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return false;
        }
    }
    // UPDATE
    public function update($id, $data) // Actualizacion
    {
        $this->db->where($this->idTabla, $id);
        return $this->db->update($this->nombreTabla, $data);
    }
    // DELETE
    public function delete($id) // Eliminar registro
    {
        $this->db->where($this->idTabla, $id);
        return $this->db->delete($this->nombreTabla);
    }

    // Fucnciones personalizadas
    public function listarPeliculasUsuarios()
    {
        $this->db->select('pelicula.*');
        $query = $this->db->get($this->nombreTabla);
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }


    public function PeliculasmasVistas()
    {
        $this->db->select('COUNT(pelicula.idpelicula) AS cantidad,usuario.nombre');
        $this->db->join('intermedia', 'pelicula.idpelicula=intermedia.idpelicula');
        $this->db->join('usuario', 'usuario.idusuario=intermedia.idusuario');
        $this->db->group_by('usuario.idusuario');

        $query = $this->db->get($this->nombreTabla);

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function PeliculasmasVistasxMes($mes)
    {
        $this->db->select('COUNT(pelicula.idpelicula) AS cantidad,pelicula.titulo');
        $this->db->join('intermedia','pelicula.idpelicula=intermedia.idpelicula');
        $this->db->join('usuario','usuario.idusuario=intermedia.idusuario');
        $this->db->where('MONTH(intermedia.fechavizualizacion)',$mes);
        $this->db->group_by('pelicula.titulo');
        
        $query= $this->db->get($this->nombreTabla);
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function DistribucionCalificaciones()
    {
        $this->db->select('count(intermedia.calificacion) AS calificaciones,pelicula.titulo');
        $this->db->join('intermedia', 'pelicula.idpelicula=intermedia.idpelicula');
        $this->db->group_by('pelicula.titulo');

        $query = $this->db->get($this->nombreTabla);

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function generoMasVisto()
    {
        $this->db->select('COUNT(*) AS cantidad,pelicula.genero');
        $this->db->join('intermedia','pelicula.idpelicula=intermedia.idpelicula');
        $this->db->group_by('pelicula.genero');

        $query= $this->db->get($this->nombreTabla);
            
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function UsuariosVieronMasPeliculas()
    {
        $this->db->select('COUNT(usuario.idusuario) AS cantidad,usuario.nombre');
        $this->db->join('intermedia','pelicula.idpelicula=intermedia.idpelicula');
        $this->db->join('usuario','usuario.idusuario=intermedia.idusuario');
        $this->db->group_by('usuario.nombre');
        
        $query= $this->db->get($this->nombreTabla);
        
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return false;
        }
    }





}
