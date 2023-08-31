<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Boleta extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Boletas_pago_model', 'boleta');
        $this->load->model('admin');
    }

    public function index()
	{
		if ($this->admin->logged_id()) {
			
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('boleta/index');
			$this->load->view('template/footer');
		} else {
			redirect('login/index');
		}
	}

    public function ajax_list()
	{
		$list = $this->boleta->get_all_boletas()->result();
		$data = array();
		foreach($list as $boleta)
		{
			$row = array();
			$row[] = '<div align="center">' . $boleta->nombre_documento . '</div>';
			$row[] = '<div align="center">' . $boleta->dni . '</div>';
			$row[] = '<div align="center">' . $boleta->fecha . '</div>';
			$row[] = '<div align="center">' . intval($boleta->horas_trabajadas) . '</div>';
			$row[] = '<div align="center">' . $boleta->monto_total . '</div>';
			$row[] = '<div align="center"><a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Eliminar" onclick="confirmDeleteBoleta('."'".$boleta->id."'".')"><i class="fa fa-trash"></i></a></div>';
			$data[] = $row;
		}

		$output = array(
			"recordsTotal" => $this->boleta->count_all(),
			"recordsFiltered" => $this->boleta->count_all(),
			"data" => $data,
		);
		echo json_encode($output);
	}
	public function delete_boleta()
	{
		$id_boleta = $this->input->post('id_boleta');

		// Llamar al método delete_by_id del modelo Boletas_pago_model
		$this->boleta->delete_by_id($id_boleta);

		// Enviar una respuesta de éxito al cliente
		echo "success";
	}


}
