<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Isian_urusan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Isian_urusan_model', 'Permendagri/Permendagri_model', 'Opd/Opd_model'));
        $this->load->library('form_validation');
    }

    public function index()
        {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));

            if ($q <> '') {
                $config['base_url'] = base_url() . 'isian_urusan/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'isian_urusan/index.html?q=' . urlencode($q);
                } else {
                    $config['base_url'] = base_url() . 'isian_urusan/index.html';
                    $config['first_url'] = base_url() . 'isian_urusan/index.html';
                }

                $config['per_page'] = 10;
                $config['page_query_string'] = TRUE;
                $config['total_rows'] = $this->Isian_urusan_model->total_rows($q);
                $isian_urusan = $this->Isian_urusan_model->get_limit_data($config['per_page'], $start, $q);

                $this->load->library('pagination');
                $this->pagination->initialize($config);

                $data = array(
                    'isian_urusan_data' => $isian_urusan,
                    'ur' => $this->Permendagri_model->get_urusan(),
                    'opd' => $this->Opd_model->get_all(),
                    'q' => $q,
                    'pagination' => $this->pagination->create_links(),
                    'total_rows' => $config['total_rows'],
                    'start' => $start,
                );

                $data['judul'] = 'Data Isian_urusan';

                $this->load->view('templates/header', $data);
                $this->load->view('isian_urusan/isian_urusan_list', $data);
                $this->load->view('templates/footer', $data);
            }

            public function generate_prog() {
                $val = $this->input->get('id_urusan');
                $opd = $this->input->get('opd');
                $tahun = $this->input->get('tahun');
                $data = array(
                                'prog' => $this->Isian_urusan_model->get_program($val),
                                'ur' => $this->Permendagri_model->get_urusan(),
                                'opd' => $this->Opd_model->get_all(),
                                'd_opd' =>  $opd,
                                'd_th' => $tahun,
                            );
                $data['judul'] = 'Data Isian_urusan';
                $this->load->view('templates/header', $data);
                $this->load->view('isian_urusan/isian_urusan_list', $data);
                $this->load->view('templates/footer', $data);
            }

    public function read($id) 
        {
            $row = $this->Isian_urusan_model->get_by_id($id);
            if ($row) {
                $data = array(
		'id_isian_urusan' => $row->id_isian_urusan,
		'kode_urusan' => $row->kode_urusan,
		'opd' => $row->opd,
		'tahun' => $row->tahun,
	    );

                $data['judul'] = 'Detail Isian_urusan';

                $this->load->view('templates/header', $data);
                $this->load->view('isian_urusan/isian_urusan_read', $data);
                $this->load->view('templates/footer', $data);
                } else {
                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                    redirect(site_url('isian_urusan'));
                }
            }

            public function create() 
            {
                $data = array(
                'button' => 'Create',
                'action' => site_url('isian_urusan/create_action'),
	    'id_isian_urusan' => set_value('id_isian_urusan'),
	    'kode_urusan' => set_value('kode_urusan'),
	    'opd' => set_value('opd'),
	    'tahun' => set_value('tahun'),
	);

                $data['judul'] = 'Tambah Isian_urusan';

                $this->load->view('templates/header', $data);
                $this->load->view('isian_urusan/isian_urusan_form', $data);
                $this->load->view('templates/footer', $data);
            }

            public function create_action() 
            {
                $this->_rules();

                if ($this->form_validation->run() == FALSE) {
                    $this->create();
                    } else {
                        $data = array(
		'kode_urusan' => $this->input->post('kode_urusan',TRUE),
		'opd' => $this->input->post('opd',TRUE),
		'tahun' => $this->input->post('tahun',TRUE),
	    );

                        $this->Isian_urusan_model->insert($data);
                        $this->session->set_flashdata('success', 'Ditambah');
                        redirect(site_url('isian_urusan'));
                    }
                }

                public function update($id) 
                {
                    $row = $this->Isian_urusan_model->get_by_id($id);

                    if ($row) {
                        $data = array(
                        'button' => 'Update',
                        'action' => site_url('isian_urusan/update_action'),
		'id_isian_urusan' => set_value('id_isian_urusan', $row->id_isian_urusan),
		'kode_urusan' => set_value('kode_urusan', $row->kode_urusan),
		'opd' => set_value('opd', $row->opd),
		'tahun' => set_value('tahun', $row->tahun),
	    );

                        $data['judul'] = 'Ubah Isian_urusan';

                        $this->load->view('templates/header', $data);
                        $this->load->view('isian_urusan/isian_urusan_form', $data);
                        $this->load->view('templates/footer', $data);

                        } else {
                            $this->session->set_flashdata('error', 'Data tidak ditemukan');
                            redirect(site_url('isian_urusan'));
                        }
                    }

                    public function update_action() 
                    {
                        $this->_rules();

                        if ($this->form_validation->run() == FALSE) {
                            $this->update($this->input->post('id_isian_urusan', TRUE));
                            } else {
                                $data = array(
		'kode_urusan' => $this->input->post('kode_urusan',TRUE),
		'opd' => $this->input->post('opd',TRUE),
		'tahun' => $this->input->post('tahun',TRUE),
	    );

                                $this->Isian_urusan_model->update($this->input->post('id_isian_urusan', TRUE), $data);
                                $this->session->set_flashdata('success', 'Diubah');
                                redirect(site_url('isian_urusan'));
                            }
                        }

                        public function delete($id) 
                        {
                            $row = $this->Isian_urusan_model->get_by_id($id);

                            if ($row) {
                                $this->Isian_urusan_model->delete($id);
                                $this->session->set_flashdata('success', 'Dihapus');
                                redirect(site_url('isian_urusan'));
                                } else {
                                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                                    redirect(site_url('isian_urusan'));
                                }
                            }

                            public function _rules() 
                            {
	$this->form_validation->set_rules('kode_urusan', 'kode urusan', 'trim|required');
	$this->form_validation->set_rules('opd', 'opd', 'trim|required');
	$this->form_validation->set_rules('tahun', 'tahun', 'trim|required');

	$this->form_validation->set_rules('id_isian_urusan', 'id_isian_urusan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
                        }

}

/* End of file Isian_urusan.php */
                        /* Location: ./application/controllers/Isian_urusan.php */
                        /* Please DO NOT modify this information : */
                        /* Generated by Harviacode Codeigniter CRUD Generator 2023-01-31 20:21:25 */
                        /* http://harviacode.com */