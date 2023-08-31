<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Trabajador extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Trabajador_model', 'trabajador');
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
            $this->load->view('trabajador/index', $data);
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
            $row[] = '<a class="btn btn-sm btn-primary" href="javascript:void(0)" title="Editar" onclick="edit_worker('."'".$trabajador->id."'".')"><i class="fa fa-pencil-alt"></i></a>
                  <a class="btn btn-sm btn-danger" href="javascript:void(0)" title="Eliminar" onclick="confirmDeleteWorker('."'".$trabajador->id."'".')"><i class="fa fa-trash"></i></a>';
            $data[] = $row;
        }

        $output = array(
            "recordsTotal" => $this->trabajador->count_all(),
            "recordsFiltered" => $this->trabajador->count_all(),
            "data" => $data,
        );
        echo json_encode($output);
    }
	public function get_json_trabajador_by_id()
	{
		$id = $this->input->post('id');
		if (!empty($id)) {
			$trabajador = $this->trabajador->get_by_id($id);
			if (!empty($trabajador)) {
				$data = array(
					'id' => $trabajador->id,
					'correo' => $trabajador->correo,
					'direccion' => $trabajador->direccion,
					'dni' => $trabajador->dni,
					'nombre' => $trabajador->nombre,
					'telefono' => $trabajador->telefono
				);
				echo json_encode($data);
			}
		}
	}
	public function create_trabajador() 
	{
		// Comprobar si la solicitud es una solicitud POST
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			// Recoge los datos de la petición
			$data = array(
				'correo' => $this->input->post('correo'),
				'direccion' => $this->input->post('direccion'),
				'dni' => $this->input->post('dni'),
				'nombre' => $this->input->post('nombre'),
				'telefono' => $this->input->post('telefono'),
			);
	
			// Validar los datos aquí
	
			// Insertar los datos en la base de datos utilizando el modelo
			$this->trabajador->save($data);
	
			// Enviar una respuesta al cliente
			$this->output
				->set_content_type('application/json')
				->set_output(json_encode(array('message' => 'Trabajador creado con éxito')));
		} else {
			// Enviar un error si la solicitud no es una solicitud POST
			show_error('Este método solo acepta peticiones POST.', 405);
		}
	}
	public function update_trabajador()
	{
		// Comprobar si la solicitud es una solicitud POST
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			// Recoge los datos de la petición
			$data = array(
				'correo' => $this->input->post('correo'),
				'direccion' => $this->input->post('direccion'),
				'dni' => $this->input->post('dni'),
				'nombre' => $this->input->post('nombre'),
				'telefono' => $this->input->post('telefono')
			);

			// Validar los datos aquí

			// Actualizar los datos en la base de datos utilizando el modelo
			$affected_rows = $this->trabajador->update($this->input->post('id'), $data);

			// Comprobar si la actualización fue exitosa
			if ($affected_rows > 0) {
				// Enviar una respuesta al cliente
				$this->output
					->set_content_type('application/json')
					->set_output(json_encode(array('message' => 'Trabajador actualizado con éxito')));
			} else {
				// Enviar un error si la actualización falló
				$this->output
					->set_content_type('application/json')
					->set_output(json_encode(array('error' => 'No se pudo actualizar el trabajador')));
			}
		} 
		else 
		{
			// Enviar un error si la solicitud no es una solicitud POST
			show_error('Este método solo acepta peticiones POST.', 405);
		}
	}
	public function delete_by_id($id_trabajador)
	{
		// Verificar si existen registros de boletas asociados al trabajador
		$this->db->where('id_trabajador', $id_trabajador);
		$boletas_count = $this->db->count_all_results('boletas_pago');

		// Si hay registros de boletas asociados, mostrar una alerta y no realizar la eliminación
		if ($boletas_count > 0) {
			echo "No se puede eliminar al trabajador porque existen boletas asociadas.";
			return;
		}

		// Eliminar los detalles del trabajador de la tabla detalles_trabajadores
		$this->db->where('id_trabajador', $id_trabajador);
		$this->db->delete('detalles_trabajadores');

		// Eliminar al trabajador de la tabla trabajadores
		$this->db->where('id', $id_trabajador);
		$this->db->delete($this->table);
	}
	public function delete_trabajador()
    {
        $id_trabajador = $this->input->post('id_trabajador');

        // Verificar si el ID del trabajador es válido
        if (!empty($id_trabajador)) {
            // Llamar al método delete_by_id del modelo Trabajador_model
            $this->trabajador->delete_by_id($id_trabajador);
            echo "";
        } else {
            echo "error";
        }
    }
}
