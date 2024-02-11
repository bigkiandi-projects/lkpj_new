<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __construct()  {
        parent::__construct();
        $this->load->model(array('capaian/Capaian_model', 'opd/Opd_model', 'bidang_add/Bidang_add_model', 'bidang/Bidang_model', 'penjadwalan/Penjadwalan_model'));
    }

	public function index()
	{
		cek_login();

		$getOpd = $this->Opd_model->get_all();
        foreach($getOpd as $op) {
            $hsl[] = $op->kdOpd; 
        }

        $non = $this->Bidang_add_model->get_bid_ad();
        $kdUr = array_merge($non, $hsl);
        $th = $this->session->userdata('ta');

        $data['rk'] = $this->Capaian_model->get_rekap_opd($kdUr, $th);
		
		$data['judul'] = "Dashboard";

		$this->load->view('templates/header', $data);
		$this->load->view('dashboard', $data);
		$this->load->view('templates/footer', $data);
	}

	public function SetYear() {
		$th = $this->input->post('th');
		$this->session->set_userdata('ta', $th);

		$this->session->set_flashdata('success', 'Di Rubah');
        redirect($_SERVER['HTTP_REFERER']);
	}

}
