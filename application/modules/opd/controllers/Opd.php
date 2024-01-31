<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Opd extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Opd_model');
        $this->load->library('form_validation');
    }

    public function index()
        {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));

            if ($q <> '') {
                $config['base_url'] = base_url() . 'opd/index.aspx?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'opd/index.aspx?q=' . urlencode($q);
                } else {
                    $config['base_url'] = base_url() . 'opd/index.aspx';
                    $config['first_url'] = base_url() . 'opd/index.aspx';
                }

                $config['per_page'] = 10;
                $config['page_query_string'] = TRUE;
                $config['total_rows'] = $this->Opd_model->total_rows($q);
                $opd = $this->Opd_model->get_limit_data($config['per_page'], $start, $q);

                $this->load->library('pagination');
                $this->pagination->initialize($config);

                $data = array(
                'opd_data' => $opd,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
                );

                $data['judul'] = 'Data Opd';

                $this->load->view('templates/header', $data);
                $this->load->view('opd/opd_list', $data);
                $this->load->view('templates/footer', $data);
            }

    public function read($id) 
        {
            $row = $this->Opd_model->get_by_id($id);
            if ($row) {
                $data = array(
		'idOpd' => $row->idOpd,
		'kdOpd' => $row->kdOpd,
		'nmOpd' => $row->nmOpd,
	    );

                $data['judul'] = 'Detail Opd';

                $this->load->view('templates/header', $data);
                $this->load->view('opd/opd_read', $data);
                $this->load->view('templates/footer', $data);
                } else {
                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                    redirect(site_url('opd'));
                }
            }

            public function create() 
            {
                $data = array(
                'button' => 'Create',
                'action' => site_url('opd/create_action'),
	    'idOpd' => set_value('idOpd'),
	    'kdOpd' => set_value('kdOpd'),
	    'nmOpd' => set_value('nmOpd'),
	);

                $data['judul'] = 'Tambah Opd';

                $this->load->view('templates/header', $data);
                $this->load->view('opd/opd_form', $data);
                $this->load->view('templates/footer', $data);
            }

            public function create_action() 
            {
                $this->_rules();

                if ($this->form_validation->run() == FALSE) {
                    $this->create();
                    } else {
                        $data = array(
		'kdOpd' => $this->input->post('kdOpd',TRUE),
		'nmOpd' => $this->input->post('nmOpd',TRUE),
	    );

                        $this->Opd_model->insert($data);
                        $this->session->set_flashdata('success', 'Ditambah');
                        redirect(site_url('opd'));
                    }
                }

                public function update($id) 
                {
                    $row = $this->Opd_model->get_by_id($id);

                    if ($row) {
                        $data = array(
                        'button' => 'Update',
                        'action' => site_url('opd/update_action'),
		'idOpd' => set_value('idOpd', $row->idOpd),
		'kdOpd' => set_value('kdOpd', $row->kdOpd),
		'nmOpd' => set_value('nmOpd', $row->nmOpd),
	    );

                        $data['judul'] = 'Ubah Opd';

                        $this->load->view('templates/header', $data);
                        $this->load->view('opd/opd_form', $data);
                        $this->load->view('templates/footer', $data);

                        } else {
                            $this->session->set_flashdata('error', 'Data tidak ditemukan');
                            redirect(site_url('opd'));
                        }
                    }

                    public function update_action() 
                    {
                        $this->_rules();

                        if ($this->form_validation->run() == FALSE) {
                            $this->update($this->input->post('idOpd', TRUE));
                            } else {
                                $data = array(
		'kdOpd' => $this->input->post('kdOpd',TRUE),
		'nmOpd' => $this->input->post('nmOpd',TRUE),
	    );

                                $this->Opd_model->update($this->input->post('idOpd', TRUE), $data);
                                $this->session->set_flashdata('success', 'Diubah');
                                redirect(site_url('opd'));
                            }
                        }

                        public function delete($id) 
                        {
                            $row = $this->Opd_model->get_by_id($id);

                            if ($row) {
                                $this->Opd_model->delete($id);
                                $this->session->set_flashdata('success', 'Dihapus');
                                redirect(site_url('opd'));
                                } else {
                                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                                    redirect(site_url('opd'));
                                }
                            }

                            public function _rules() 
                            {
	$this->form_validation->set_rules('kdOpd', 'kdopd', 'trim|required');
	$this->form_validation->set_rules('nmOpd', 'nmopd', 'trim|required');

	$this->form_validation->set_rules('idOpd', 'idOpd', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
                        }

}

/* End of file Opd.php */
                        /* Location: ./application/controllers/Opd.php */
                        /* Please DO NOT modify this information : */
                        /* Generated by Harviacode Codeigniter CRUD Generator 2023-02-17 21:44:52 */
                        /* http://harviacode.com */