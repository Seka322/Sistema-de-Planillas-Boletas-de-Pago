<?php 
class Usuario_model extends CI_Model
{
    public function get_id_user()
    {
       $info_usuario = $this->session->userdata;
       return $info_usuario['user_id'];
    }
    public function get_full_name($id_user)
    {
    	$nombres = '';
    	$apellidos = '';
    	$query = $this->db->query("SELECT p.nombres, p.apellidos FROM tbl_persona as p LEFT JOIN tbl_users as u ON u.id_persona=p.id_persona WHERE u.id_user='$id_user'");
    	foreach ($query->result() as $row)
    	{
    		$nombres = $row->nombres;
    		$apellidos = $row->apellidos;
    	}
    	return $nombres.' '.$apellidos;
	}
	public function get_username($id_user)
	{
		$username = "";
		$query = $this->db->query("SELECT username FROM tbl_users WHERE id_user='$id_user'");
		foreach ($query->result() as $row)
    	{
			$username = $row->username;
		}
		return $username;
	}
}
?>