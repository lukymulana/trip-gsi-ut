<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('M_home');
	}
	
	public function index()
	{
		$data['data'] = $this->M_home->getData();
		$data['driver'] = $this->M_home->getDriver();
		$data['point_start'] = $this->M_home->getPointStart();

		$this->load->view('home', $data);
	}

	public function getPointEnd($point_start) {
		$data = $this->M_home->getPointEnd($point_start);
		echo '
				<select class="form-select" aria-label="Default select example" id="point_end" name="point_end" onchange="getDataCost()">
					<option value="" selected disabled>-- Pilih --</option> 
		';
                    foreach ($data as $d) {
                        echo '
                            <option value="'.$d['point_end'].'">'.$d['point_end'].'</option>
                        ';
                    }					
		echo '
                </select>
             
        ';
	}

	public function getPointEndEdit($point_start) {
		$data = $this->M_home->getPointEnd($point_start);
		echo '
				<select class="form-select" aria-label="Default select example" id="point_end_edit" name="point_end_edit" onchange="getDataCostEdit()">
					<option value="" selected disabled>-- Pilih --</option> 
		';
                    foreach ($data as $d) {
                        echo '
                            <option value="'.$d['point_end'].'">'.$d['point_end'].'</option>
                        ';
                    }					
		echo '
                </select>
             
        ';
	}

	public function getCost($point_start, $point_end) {
		$data = $this->M_home->getDataCost($point_start, $point_end);
		echo json_encode($data);
	}

	public function addTrip() {
		$data = [
			'id_driver' => $this->input->post('driver'),
			'id_cost' => $this->input->post('id_cost'),
			'date_trip' => $this->input->post('date_trip'),
			'actual_time' => $this->input->post('actual_time'),
			'total_cost' => $this->input->post('total_cost')
		];

		$inserData = $this->M_home->addTrip($data);

		if ($inserData > 0) {
			$this->session->set_flashdata('success', 'Trip berhasil ditambahkan');
			redirect('home');
		} else {
			$this->session->set_flashdata('error', 'Trip gagal ditambahkan');
			redirect('home');
		}
	}

	public function getTripById($id) {
		$data = $this->M_home->getTripById($id);
		echo json_encode($data);
	}

	public function editTrip() {
		$data = [
			'nama_project' => $this->input->post('nama_project_edit'),
			'deskripsi' => $this->input->post('deskripsi_edit'),
			'pic' => $this->input->post('pic_edit'),
			'start_date' => $this->input->post('start_date_edit'),
			'due_date' => $this->input->post('due_date_edit'),
			'priority' => $this->input->post('priority_edit'),
			'status' => $this->input->post('status_edit'),
			'task_complexity' => $this->input->post('task_complexity_edit')
		];

		$id = $this->input->post('id_project_edit');
		
		$updateData = $this->M_home->updateProject($data, $id);

		if ($updateData > 0) {
			$this->session->set_flashdata('success', 'Trip berhasil diubah');
			redirect('home');
		} else {
			$this->session->set_flashdata('error', 'Trip gagal diubah');
			redirect('home');
		}
	}

	public function deleteTrip($id) {
		$deleteData = $this->M_home->deleteTrip($id);

		if ($deleteData > 0) {
			$this->session->set_flashdata('success', 'Trip berhasil dihapus');
			redirect('home');
		} else {
			$this->session->set_flashdata('error', 'Trip gagal dihapus');
			redirect('home');
		}
	}
}
