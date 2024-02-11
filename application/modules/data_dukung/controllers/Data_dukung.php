<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Data_dukung extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Data_dukung_model', 'opd/Opd_model', 'user/User_model'));
        $this->load->library('form_validation');
    }

    public function index() {
        if($this->session->userdata('level') == 'Opd') {
            $id = array($this->session->userdata('id_user'));
        } else {
            $hsl = array();
            $get = $this->Data_dukung_model->get_exist();
            foreach ($get as $a) {
                $hsl[] = $a->id_opd; 
            }
            if(!empty($hsl)) {
                $id = $hsl;
            } else {
                $id = array($this->session->userdata('id_user'));
            }
        }
        
        $data_dukung = $this->Data_dukung_model->get_opd_user($id);

        $data = array(
        'data_dukung_data' => $data_dukung,
        );

        $data['judul'] = 'Data Dukung LKPJ';

        $this->load->view('templates/header', $data);
        $this->load->view('data_dukung/data_dukung_list', $data);
        $this->load->view('templates/footer', $data);
    }

    public function read($id) {

        $row = $this->Data_dukung_model->get_by_id($id);
        if ($row) {
            $data = array(
    		'id_data_dukung' => $row->id_data_dukung,
    		'triwulan' => $row->triwulan,
    		'tahun' => $row->tahun,
    		'id_opd' => $row->id_opd,
    	    );

            $data['judul'] = 'Detail Data_dukung';

            $this->load->view('templates/header', $data);
            $this->load->view('data_dukung/data_dukung_read', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->session->set_flashdata('error', 'Data tidak ditemukan');
            redirect(site_url('data_dukung'));
        }
    }

    public function create() {

        $get_opd = $this->User_model->get_by_id($this->session->userdata('id_user'));
        $get_tri = $this->Data_dukung_model->cek_triwulan($this->session->userdata('id_user'));

        $data = array(
            'trw' => $get_tri,
            'opd' => $get_opd,
            'button' => 'Create',
            'action' => site_url('data_dukung/create_action'),
    	    'id_data_dukung' => set_value('id_data_dukung'),
    	    'triwulan' => set_value('triwulan'),
    	    'tahun' => set_value('tahun'),
    	    'id_opd' => set_value('id_opd'),
        );

        $data['judul'] = 'Tambah Data';

        $this->load->view('templates/header', $data);
        $this->load->view('data_dukung/data_dukung_form', $data);
        $this->load->view('templates/footer', $data);
    }

    public function create_action() {

        $data = array(
            'triwulan' => $this->input->post('triwulan',TRUE),
            'tahun' => $this->input->post('tahun',TRUE),
            'id_opd' => $this->input->post('id_opd',TRUE),
        );
        
        $config['upload_path']          = './assets/upload/dokumen/';
        $config['allowed_types']        = 'docx|doc|xls|xlsx|pdf|csv|ppt|pptx';
        $config['max_size']             = 1000000;
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload');
        $this->upload->initialize($config);

        if (!empty($_FILES['renstra']['name'])) {
            $this->upload->do_upload('renstra');
            $upload_data = $this->upload->data();
            $data_berkas['dok_perencanaan'] = $upload_data['file_name'];
        }

        if (!empty($_FILES['lap_evaluasi']['name'])) {
            $this->upload->do_upload('lap_evaluasi');
            $upload_data = $this->upload->data();
            $data_berkas['lap_evaluasi'] = $upload_data['file_name'];
        }

        if (!empty($_FILES['lkpj']['name'])) {
            $this->upload->do_upload('lkpj');
            $upload_data = $this->upload->data();
            $data_berkas['lap_lkpj'] = $upload_data['file_name'];
        }

        if (!empty($_FILES['sektoral']['name'])) {
            $this->upload->do_upload('sektoral');
            $upload_data = $this->upload->data();
            $data_berkas['data_sektoral'] = $upload_data['file_name'];
        }

        $data_berkas['id_triwulan'] = $this->Data_dukung_model->insert($data);


        if(!empty($data_berkas)) {
            $this->Data_dukung_model->save_berkas($data_berkas);
        }

        $this->session->set_flashdata('success', 'Ditambah');
        redirect(site_url('data_dukung'));
    }

    public function hapus($id) {

        $row = $this->Data_dukung_model->get_by_id($id);
        $berkas = $this->Data_dukung_model->get_by_berkas($id);

        if ($row) {
            $this->Data_dukung_model->delete($id);
                if($berkas) {
                    $this->Data_dukung_model->hapus_berkas($id, $berkas);

                    $this->session->set_flashdata('success', 'Dihapus');
                    redirect(site_url('data_dukung'));
                } else {
                    $this->session->set_flashdata('success', 'Dihapus');
                    redirect(site_url('data_dukung'));
                }
            } else {
                $this->session->set_flashdata('error', 'Data tidak ditemukan');
                redirect(site_url('data_dukung'));
            }
    }

    public function download_zip($id, $nm) {

        $this->load->library('zip');
        $row = $this->Data_dukung_model->get_by_berkas($id);

        $ren = "./assets/upload/dokumen/".$row->dok_perencanaan;
        $ev = "./assets/upload/dokumen/".$row->lap_evaluasi;
        $lkpj = "./assets/upload/dokumen/".$row->lap_lkpj;
        $inf = "./assets/upload/dokumen/".$row->data_sektoral;

        $this->zip->read_file($ren);
        $this->zip->read_file($ev);
        $this->zip->read_file($lkpj);
        $this->zip->read_file($inf);


        $this->zip->compression_level = 5;
        $this->zip->download($nm.".zip");

    }


    public function update($id) {
        $row = $this->Data_dukung_model->get_by_id($id);
        $lamp = $this->Data_dukung_model->get_by_berkas($row->id_data_dukung);
        $get_opd = $this->User_model->get_by_id($this->session->userdata('id_user'));

        if ($row) {
            $data = array(
            'button' => 'Update',
            'action' => site_url('data_dukung/update_action'),
    		'id_data_dukung' => set_value('id_data_dukung', $row->id_data_dukung),
            'data_dkg' => $lamp,
    		'triwulan' => set_value('triwulan', $row->triwulan),
    		'tahun' => set_value('tahun', $row->tahun),
    		'id_opd' => set_value('id_opd', $row->id_opd),
            'opd' => $get_opd
    	    );

            $data['judul'] = 'Ubah Data_dukung';

            $this->load->view('templates/header', $data);
            $this->load->view('data_dukung/data_dukung_form', $data);
            $this->load->view('templates/footer', $data);

            } else {
                $this->session->set_flashdata('error', 'Data tidak ditemukan');
                redirect(site_url('data_dukung'));
            }
    }

    public function update_action() {

        $config['upload_path']          = './assets/upload/dokumen/';
        $config['allowed_types']        = 'docx|doc|xls|xlsx|pdf|csv|ppt|pptx';
        $config['max_size']             = 1000000;
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload');
        $this->upload->initialize($config);

        if (!empty($_FILES['renstra']['name'])) {
            $this->upload->do_upload('renstra');
            $upload_data = $this->upload->data();
            $data_berkas['dok_perencanaan'] = $upload_data['file_name'];
        }

        if (!empty($_FILES['lap_evaluasi']['name'])) {
            $this->upload->do_upload('lap_evaluasi');
            $upload_data = $this->upload->data();
            $data_berkas['lap_evaluasi'] = $upload_data['file_name'];
        }

        if (!empty($_FILES['lkpj']['name'])) {
            $this->upload->do_upload('lkpj');
            $upload_data = $this->upload->data();
            $data_berkas['lap_lkpj'] = $upload_data['file_name'];
        }

        if (!empty($_FILES['sektoral']['name'])) {
            $this->upload->do_upload('sektoral');
            $upload_data = $this->upload->data();
            $data_berkas['data_sektoral'] = $upload_data['file_name'];
        }

        $this->Data_dukung_model->update_berkas($this->input->post('id_data_dkg', TRUE), $data_berkas);
        $this->session->set_flashdata('success', 'Diubah');
        redirect(site_url('data_dukung'));
    }

                        public function delete($id) {
                            $row = $this->Data_dukung_model->get_by_id($id);

                            if ($row) {
                                $this->Data_dukung_model->delete($id);
                                $this->session->set_flashdata('success', 'Dihapus');
                                redirect(site_url('data_dukung'));
                                } else {
                                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                                    redirect(site_url('data_dukung'));
                                }
                        }

                            public function _rules() 
                            {
                            	$this->form_validation->set_rules('triwulan', 'triwulan', 'trim|required');
                            	$this->form_validation->set_rules('tahun', 'tahun', 'trim|required');
                            	$this->form_validation->set_rules('id_opd', 'id opd', 'trim|required|numeric');

                            	$this->form_validation->set_rules('id_data_dukung', 'id_data_dukung', 'trim');
                            	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
                            }

}
