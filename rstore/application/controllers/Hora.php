<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Hora extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Trabajador_model', 'trabajador');
		$this->load->model('Boletas_pago_model', 'boleta');
        $this->load->model('admin');
    }

    public function index($mensaje = null)
    {
        if($this->admin->logged_id())
        {
            $data = array();
            // Si se pasa un mensaje, agregarlo al array de datos
            if($mensaje !== null) 
            {
                $data['mensaje'] = $mensaje;
            }
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('horas_trabajadas/index', $data);
            $this->load->view('template/footer');
        }
        else
        {
            redirect('login/index');
        }
    }
	public function ajax_list()
    {
        $list = $this->trabajador->get_all_trabajadores()->result();
        $data = array();
        foreach($list as $trabajador)
        {
            $row = array();
            $row[] = $trabajador->nombre;
            $row[] = $trabajador->correo;
            $row[] = $trabajador->direccion;
            $row[] = $trabajador->dni;
            $row[] = $trabajador->telefono;
            $row[] = '<a class="btn btn-sm btn-primary" href="'.base_url('hora/calcular_boleta_pago/'.$trabajador->id).'">Calcular Pago</a>';
            $data[] = $row;
        }

        $output = array(
            "recordsTotal" => $this->trabajador->count_all(),
            "recordsFiltered" => $this->trabajador->count_all(),
            "data" => $data,
        );
        echo json_encode($output);
    }
	public function calcular_boleta_pago($id_trabajador)
	{
		if($this->admin->logged_id())
        {
            $data['id_trabajador'] = $id_trabajador;
            $this->load->view('template/header');
            $this->load->view('template/sidebar');
            $this->load->view('horas_trabajadas/calcular_pago', $data);
            $this->load->view('template/footer');
        }
        else
        {
            redirect('login/index');
        }

	}
	public function crear_registro_boleta_pago()
	{
		$data = array(
            'id_trabajador' => $this->input->post('id_trabajador'),
            'horas_trabajadas' => $this->input->post('horas_trabajadas'),
            'sueldo' => $this->input->post('sueldo')
        );
		$this->boleta->save($data);
		$data["mensaje"] = 'Boleta de pago agregada';
		$this->load->view('template/header');
		$this->load->view('template/sidebar');
		$this->load->view('boleta/index', $data);
		$this->load->view('template/footer');
	}
}
