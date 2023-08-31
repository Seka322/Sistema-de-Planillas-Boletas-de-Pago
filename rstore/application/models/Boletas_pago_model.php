<?php
class Boletas_pago_model extends CI_Model
{
    var $table = 'boletas_pago';

	public function get_all_boletas()
	{
		$this->db->select('boletas_pago.*, trabajadores.dni, tipo_documento.nombre_documento')
			->from($this->table)
			->join('trabajadores', 'boletas_pago.id_trabajador = trabajadores.id')
			->join('tipo_documento', 'boletas_pago.id_tipo_documento = tipo_documento.id');
		$result = $this->db->get();
		return $result;
	}



	public function count_all()
    {
		$query = $this->get_all_boletas();
        return $query->num_rows();
    }

    public function boleta_data_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query;
    }

    public function boleta_exists($data)
    {
        $id_trabajador = $data['id_trabajador'];
        $exists = false;
        $query = $this->db->query("SELECT * FROM $this->table WHERE id_trabajador = '$id_trabajador'");
        $rows = $query->num_rows();
        if ($rows > 0)
        {
            $exists = true;
        }
        return $exists;
    }

	public function duplicate_trabajador($data)
    {
        $id_trabajador = $data['id_trabajador'];
        $error = '';
        $query = $this->db->query("SELECT * FROM $this->table WHERE id_trabajador = '$id_trabajador'");
        $rows = $query->num_rows();
        if ($rows > 0)
        {
            $error = 'Ya existe un registro con el Trabajador: '. $id_trabajador;
        }
        return $error;
    }
    public function save($data)
    {
        date_default_timezone_set('America/Lima');
        $fecha_actual = date('Y-m-d');
        $horas_trabajadas = $data['horas_trabajadas'];
        $sueldo = $data['sueldo']; // Sueldo base para 160 horas

        // Calculando el porcentaje de horas trabajadas
        $porcentaje_horas_trabajadas = ($horas_trabajadas / 160) * 100;

        // Calculando el monto total
        $monto_total = ($porcentaje_horas_trabajadas * $sueldo) / 100;

        $this->db->insert('boletas_pago', array(
            'id_trabajador' => $data['id_trabajador'],
            'fecha' => $fecha_actual,
            'horas_trabajadas' => $horas_trabajadas,
            'monto_total' => $monto_total,
			'id_tipo_documento' => 1
        ));
    }
    public function delete_by_id($id_boleta)
    {
        $this->db->where('id', $id_boleta);
		$this->db->delete($this->table);
    }
}
