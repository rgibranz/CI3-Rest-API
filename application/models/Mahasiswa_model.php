<?php

class Mahasiswa_model extends CI_Model
{
	public function get_all()
	{
		return $this->db->get('mahasiswa');
	}

	public function get_by_id($id)
	{
		return $this->db->get_where('mahasiswa', ['id' => $id]);
	}
}