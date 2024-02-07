<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Data_dukung extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Data_dukung_model', 'opd/Opd_model'));
        $this->load->library('form_validation');
    }

    public function index()
        {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));

            if ($q <> '') {
                $config['base_url'] = base_url() . 'data_dukung/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'data_dukung/index.html?q=' . urlencode($q);
                } else {
                    $config['base_url'] = base_url() . 'data_dukung/index.html';
                    $config['first_url'] = base_url() . 'data_dukung/index.html';
                }

                $config['per_page'] = 10;
                $config['page_query_string'] = TRUE;
                $config['total_rows'] = $this->Data_dukung_model->total_rows($q);
                $data_dukung = $this->Data_dukung_model->get_limit_data($config['per_page'], $start, $q);

                $this->load->library('pagination');
                $this->pagination->initialize($config);

                $get_opd = $this->Opd_model->get_by_name($this->session->userdata('nama_user'));

                $data = array(
                'opd' => $get_opd,
                'data_dukung_data' => $data_dukung,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
                );

                $data['judul'] = 'Data Dukung LKPJ';

                $this->load->view('templates/header', $data);
                $this->load->view('data_dukung/data_dukung_list', $data);
                $this->load->view('templates/footer', $data);
            }

    public function read($id) 
        {
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

                $get_opd = $this->Opd_model->get_by_name($this->session->userdata('nama_user'));

                $data = array(
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
                
                $config['upload_path']          = './assets/up/';
                $config['allowed_types']        = 'docx|doc|xls|xlsx|pdf';
                $config['max_size']             = 1000000;
                $config['encrypt_name'] = TRUE;
                $this->load->library('upload');
                $this->upload->initialize($config);

                if (!empty($_FILES['renstra']['name'])) {
                    $this->upload->do_upload('renstra');
                    $upload_data = $this->upload->data();
                    $data['doc_perencanaan'] = $upload_data['file_name'];
                }

                if (!empty($_FILES['lap_evaluasi']['name'])) {
                    $this->upload->do_upload('lap_evaluasi');
                    $upload_data = $this->upload->data();
                    $data['lap_evaluasi'] = $upload_data['file_name'];
                }

                if (!empty($_FILES['lkpj']['name'])) {
                    $this->upload->do_upload('lkpj');
                    $upload_data = $this->upload->data();
                    $data['lap_lkpj'] = $upload_data['file_name'];
                }

                if (!empty($_FILES['sektoral']['name'])) {
                    $this->upload->do_upload('sektoral');
                    $upload_data = $this->upload->data();
                    $data['data_sektoral'] = $upload_data['file_name'];
                }

                $data = array(
        		'triwulan' => $this->input->post('triwulan',TRUE),
        		'tahun' => $this->input->post('tahun',TRUE),
        		'id_opd' => $this->input->post('id_opd',TRUE),
        	    );

                $this->Data_dukung_model->insert($data);
                $this->session->set_flashdata('success', 'Ditambah');
                redirect(site_url('data_dukung'));
            }

                public function update($id) 
                {
                    $row = $this->Data_dukung_model->get_by_id($id);

                    if ($row) {
                        $data = array(
                        'button' => 'Update',
                        'action' => site_url('data_dukung/update_action'),
		'id_data_dukung' => set_value('id_data_dukung', $row->id_data_dukung),
		'triwulan' => set_value('triwulan', $row->triwulan),
		'tahun' => set_value('tahun', $row->tahun),
		'id_opd' => set_value('id_opd', $row->id_opd),
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

                    public function update_action() 
                    {
                        $this->_rules();

                        if ($this->form_validation->run() == FALSE) {
                            $this->update($this->input->post('id_data_dukung', TRUE));
                            } else {
                                $data = array(
		'triwulan' => $this->input->post('triwulan',TRUE),
		'tahun' => $this->input->post('tahun',TRUE),
		'id_opd' => $this->input->post('id_opd',TRUE),
	    );

                                $this->Data_dukung_model->update($this->input->post('id_data_dukung', TRUE), $data);
                                $this->session->set_flashdata('success', 'Diubah');
                                redirect(site_url('data_dukung'));
                            }
                        }

                        public function delete($id) 
                        {
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

/* End of file Data_dukung.php */
                        /* Location: ./application/controllers/Data_dukung.php */
                        /* Please DO NOT modify this information : */
                        /* Generated by Harviacode Codeigniter CRUD Generator 2024-02-06 17:32:27 */
                        /* http://harviacode.com */