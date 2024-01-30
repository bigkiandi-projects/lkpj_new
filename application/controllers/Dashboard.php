<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()
	{
		cek_login();
		
		$data['judul'] = "Dashboard";

		$this->load->view('templates/header', $data);
		$this->load->view('dashboard', $data);
		$this->load->view('templates/footer', $data);
	}

	public function SetYear() {
		$th = $this->input->post('th');
		$this->session->set_userdata('ta', $th);

		$this->session->set_flashdata('success', 'Di Rubah');
        redirect(base_url('dashboard'));
	}

}
