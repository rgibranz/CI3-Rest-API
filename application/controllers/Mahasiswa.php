<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Mahasiswa extends RestController
{

	function __construct()
	{
		parent::__construct();
		$this->load->model('Mahasiswa_model', 'mahasiswa');
	}

	public function index_get()
	{
		$id = $this->get('id');

		if ($id === null) {
			$mahasiswa = $this->mahasiswa->get_all()->result();
			$this->response($mahasiswa, 200);
		} else {
			$mahasiswa = $this->mahasiswa->get_by_id($id)->result();
			$this->response($mahasiswa, 200);
		}
	}
}
