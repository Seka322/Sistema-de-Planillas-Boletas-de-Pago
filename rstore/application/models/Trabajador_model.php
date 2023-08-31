<?php
class Trabajador_model extends CI_Model
{
    var $table = 'trabajadores';

	public function get_all_trabajadores()
	{
		$this->db->select('*')
		->from($this->table);
		$result = $this->db->get();
		return $result;
	}

	public function count_all()
    {
		$query = $this->get_all_trabajadores();
        return $query->num_rows();
    }

    public function get_by_id($id)
	{
		$this->db->where('id', $id);
		$query = $this->db->get('trabajadores');
		return $query->row();
	}


	public function trabajador_exists($data)
    {
        $dni = $data['dni'];
        $exists = false;
        $query = $this->db->query("SELECT * FROM $this->table WHERE dni = '$dni'");
        $rows = $query->num_rows();
        if ($rows > 0)
        {
            $exists = true;
        }
        return $exists;
    }

	public function duplicate_dni($data)
    {
        $dni = $data['dni'];
        $error = '';
        $query = $this->db->query("SELECT * FROM $this->table WHERE dni = '$dni'");
        $rows = $query->num_rows();
        if ($rows > 0)
        {
            $error = 'Ya existe un Trabajador Registrado con el DNI: '. $dni;
        }
        return $error;
    }

    public function save($data)
    {
		// Establecer la zona horaria a PET
		date_default_timezone_set('America/Lima');
        $this->db->insert('trabajadores', array(
            'correo' => $data['correo'],
            'direccion' => $data['direccion'],
            'dni' => $data['dni'],
            'nombre' => $data['nombre'],
            'telefono' => $data['telefono']
		));
		// Obtener el ID del trabajador insertado
		$id_trabajador = $this->db->insert_id();

		// Insertar los detalles del trabajador
		$this->db->insert('detalles_trabajadores', array(
			'id_trabajador' => $id_trabajador,
			'fecha_inicio' => date('Y-m-d'),  // Fecha de hoy
			'salario' => 1400  // Salario por defecto
		));
    }

	public function update($id, $data)
	{
		$this->db->where('id', $id);
		$this->db->update('trabajadores', $data);
		return $this->db->affected_rows();
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

}
