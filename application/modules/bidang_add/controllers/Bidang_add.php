<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Bidang_add extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Bidang_add_model', 'bidang/Bidang_model'));
        $this->load->library('form_validation');
    }

    public function index() {

            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));

            if ($q <> '') {
                $config['base_url'] = base_url() . 'bidang_add/index.aspx?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'bidang_add/index.aspx?q=' . urlencode($q);
                } else {
                    $config['base_url'] = base_url() . 'bidang_add/aspx.html';
                    $config['first_url'] = base_url() . 'bidang_add/aspx.html';
                }

                $config['per_page'] = 10;
                $config['page_query_string'] = TRUE;
                $config['total_rows'] = $this->Bidang_add_model->total_rows($q);
                $bidang_add = $this->Bidang_add_model->get_limit_data($config['per_page'], $start, $q);

                $this->load->library('pagination');
                $this->pagination->initialize($config);

                $data = array(
                'bidang_add_data' => $bidang_add,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
                );

                $data['judul'] = 'Data Bidang Lainnya';

                $this->load->view('templates/header', $data);
                $this->load->view('bidang_add/bidang_add_list', $data);
                $this->load->view('templates/footer', $data);
    }

    public function read($id)  {
        
            $row = $this->Bidang_add_model->get_by_id($id);
            if ($row) {
                $data = array(
        		'id_ba' => $row->id_ba,
        		'nama_bidang' => $row->nama_bidang,
        		'kode_bidang' => $row->kode_bidang,
        		'status' => $row->status,
        	    );

                $data['judul'] = 'Detail Bidang_add';

                $this->load->view('templates/header', $data);
                $this->load->view('bidang_add/bidang_add_read', $data);
                $this->load->view('templates/footer', $data);
                } else {
                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                    redirect(site_url('bidang_add'));
                }
            }

            public function create() 
            {
                $data = array(
                    'button' => 'Create',
                    'action' => site_url('bidang_add/create_action'),
            	    'id_ba' => set_value('id_ba'),
            	    'nama_bidang' => set_value('nama_bidang'),
            	    'kode_bidang' => set_value('kode_bidang'),
            	    'status' => set_value('status'),
                    'bidang' => $this->Bidang_model->get_all(),
            	);

                $data['judul'] = 'Tambah Bidang_add';

                $this->load->view('templates/header', $data);
                $this->load->view('bidang_add/bidang_add_form', $data);
                $this->load->view('templates/footer', $data);
            }

            public function create_action() 
            {
                $this->_rules();

                if ($this->form_validation->run() == FALSE) {
                    $this->create();
                    } else {
                        $data = array(
                		'nama_bidang' => $this->input->post('nama_bidang',TRUE),
                		'kode_bidang' => $this->input->post('kode_bidang',TRUE),
                	    );

                        $this->Bidang_add_model->insert($data);
                        $this->session->set_flashdata('success', 'Ditambah');
                        redirect(site_url('bidang_add'));
                    }
                }

                public function update($id) 
                {
                    $row = $this->Bidang_add_model->get_by_id($id);

                    if ($row) {
                        $data = array(
                        'button' => 'Update',
                        'action' => site_url('bidang_add/update_action'),
                		'id_ba' => set_value('id_ba', $row->id_ba),
                		'nama_bidang' => set_value('nama_bidang', $row->nama_bidang),
                		'kode_bidang' => set_value('kode_bidang', $row->kode_bidang),
                		'status' => set_value('status', $row->status),
                	    );

                        $data['judul'] = 'Ubah Bidang_add';

                        $this->load->view('templates/header', $data);
                        $this->load->view('bidang_add/bidang_add_form', $data);
                        $this->load->view('templates/footer', $data);

                        } else {
                            $this->session->set_flashdata('error', 'Data tidak ditemukan');
                            redirect(site_url('bidang_add'));
                        }
                    }

                    public function update_action() 
                    {
                        $this->_rules();

                        if ($this->form_validation->run() == FALSE) {
                            $this->update($this->input->post('id_ba', TRUE));
                            } else {
                                $data = array(
		'nama_bidang' => $this->input->post('nama_bidang',TRUE),
		'kode_bidang' => $this->input->post('kode_bidang',TRUE),
		'status' => $this->input->post('status',TRUE),
	    );

                                $this->Bidang_add_model->update($this->input->post('id_ba', TRUE), $data);
                                $this->session->set_flashdata('success', 'Diubah');
                                redirect(site_url('bidang_add'));
                            }
                        }

                        public function delete($id) 
                        {
                            $row = $this->Bidang_add_model->get_by_id($id);

                            if ($row) {
                                $this->Bidang_add_model->delete($id);
                                $this->session->set_flashdata('success', 'Dihapus');
                                redirect(site_url('bidang_add'));
                                } else {
                                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                                    redirect(site_url('bidang_add'));
                                }
                            }

                            public function _rules() 
                            {
	$this->form_validation->set_rules('nama_bidang', 'nama bidang', 'trim|required');
	$this->form_validation->set_rules('kode_bidang', 'kode bidang', 'trim|required');

	$this->form_validation->set_rules('id_ba', 'id_ba', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
                        }

}

/* End of file Bidang_add.php */
                        /* Location: ./application/controllers/Bidang_add.php */
                        /* Please DO NOT modify this information : */
                        /* Generated by Harviacode Codeigniter CRUD Generator 2024-01-31 14:50:34 */
                        /* http://harviacode.com */