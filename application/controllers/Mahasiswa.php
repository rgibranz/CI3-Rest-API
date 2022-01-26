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
		} else {
			$mahasiswa = $this->mahasiswa->get_by_id($id)->result();
		}

		if ($mahasiswa) {
			$this->response($mahasiswa, 200);
		} else {
			$this->response(['status' => false, 'message' => 'data not found'], 404);
		}
	}

	public function index_delete()
	{
		$id = $this->delete('id');

		if ($id === null) {
			$this->response([
				'status' => false,
				'message' => 'Please provide an id!'
			], 400);
		} else {
			if ($this->mahasiswa->delete_by_id($id) == 0) {
				$this->response([
					'status' => false,
					'message' => "Data By id = $id not Found!"
				], 400);
				
			} else {
				$this->response([
					'status' => true,
					'message' => "Data $id Deleted"
				], 200);
			}
		}
	}

	public function index_post()
	{
		$data = [
			'nrp' => $this->post('nrp'),
			'nama' => $this->post('nama'),
			'email' => $this->post('email'),
			'jurusan' => $this->post('jurusan')
		];

		if($this->mahasiswa->create_data($data) > 0)
		{
			$this->response([
				'status' => true,
				'message' => "New Mahasiswa Has been created"
			], 201);
		}else{
			$this->response([
				'status' => false,
				'message' => 'You\'ve sent bad data!'
			], 400);
		}
	}

	public function index_put()
	{
		$data = [
			'nrp' => $this->put('nrp'),
			'nama' => $this->put('nama'),
			'email' => $this->put('email'),
			'jurusan' => $this->put('jurusan')
		];

		if($this->mahasiswa->update_data($data,$this->put('id')) > 0)
		{
			$this->response([
				'status' => true,
				'message' => "Data Has Been Updated"
			], 201);
		}else{
			$this->response([
				'status' => false,
				'message' => 'You\'ve sent bad data!'
			], 400);
		}
	}
}
