<?php
defined('BASEPATH') || exit('No direct script access allowed');

class Metricas extends CI_Controller
{
	/* Inicializar el constructor */
	public function __construct()
	{
		parent::__construct();
		$this->load->model('pelicula');
	}

	public function ordenes()
	{
		// Gráfico de Barras
		// Eje X
		$labelsBarras =  [];
		// Eje Y
		$valuesData = [];

		$registros2 =$this->pelicula->DistribucionCalificaciones();
		if ($registros2) {
			foreach ($registros2 as $key => $registro) {
				array_push($labelsBarras,$registro->titulo);
				array_push($valuesData,$registro->calificaciones);

			}
		}

		// Gráfico de pastel
		// Eje X
		$labelsPastel =  [];
		// Eje Y
		$valuesPastel = [];

		$registros =$this->pelicula->PeliculasmasVistas();
		if ($registros) {
			foreach ($registros as $key => $registro) {
				array_push($labelsPastel,$registro->nombre);
				array_push($valuesPastel,$registro->cantidad);

			}
		}

			
	     $generoMasVisto= $this->pelicula->generoMasVisto();

		$data = [
			'labelsBarras' => $labelsBarras,
			'valuesData' => $valuesData,
			'labelsPastel' => $labelsPastel,
			'valuesPastel' => $valuesPastel,
			'generoMasVisto' => $generoMasVisto,

		];
		$this->load->view('template/header');
		$this->load->view('metricas/ordenes', $data);
		$this->load->view('template/footer');
	}
}
