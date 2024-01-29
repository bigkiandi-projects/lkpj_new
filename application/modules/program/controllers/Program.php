<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Program extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Program_model');
        $this->load->library('form_validation');
    }

    public function index()
        {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));

            if ($q <> '') {
                $config['base_url'] = base_url() . 'program/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'program/index.html?q=' . urlencode($q);
                } else {
                    $config['base_url'] = base_url() . 'program/index.html';
                    $config['first_url'] = base_url() . 'program/index.html';
                }

                $config['per_page'] = 10;
                $config['page_query_string'] = TRUE;
                $config['total_rows'] = $this->Program_model->total_rows($q);
                $program = $this->Program_model->get_limit_data($config['per_page'], $start, $q);

                $this->load->library('pagination');
                $this->pagination->initialize($config);

                $data = array(
                'program_data' => $program,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
                );

                $data['judul'] = 'Data Program';

                $this->load->view('templates/header', $data);
                $this->load->view('program/program_list', $data);
                $this->load->view('templates/footer', $data);
            }

    public function read($id) 
        {
            $row = $this->Program_model->get_by_id($id);
            if ($row) {
                $data = array(
		'idProg' => $row->idProg,
		'kdProg' => $row->kdProg,
		'nmProg' => $row->nmProg,
		'p_id' => $row->p_id,
	    );

                $data['judul'] = 'Detail Program';

                $this->load->view('templates/header', $data);
                $this->load->view('program/program_read', $data);
                $this->load->view('templates/footer', $data);
                } else {
                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                    redirect(site_url('program'));
                }
            }

            public function create() 
            {
                $data = array(
                'button' => 'Create',
                'action' => site_url('program/create_action'),
	    'idProg' => set_value('idProg'),
	    'kdProg' => set_value('kdProg'),
	    'nmProg' => set_value('nmProg'),
	    'p_id' => set_value('p_id'),
	);

                $data['judul'] = 'Tambah Program';

                $this->load->view('templates/header', $data);
                $this->load->view('program/program_form', $data);
                $this->load->view('templates/footer', $data);
            }

            public function create_action() 
            {
                $this->_rules();

                if ($this->form_validation->run() == FALSE) {
                    $this->create();
                    } else {
                        $data = array(
		'kdProg' => $this->input->post('kdProg',TRUE),
		'nmProg' => $this->input->post('nmProg',TRUE),
		'p_id' => $this->input->post('p_id',TRUE),
	    );

                        $this->Program_model->insert($data);
                        $this->session->set_flashdata('success', 'Ditambah');
                        redirect(site_url('program'));
                    }
                }

                public function update($id) 
                {
                    $row = $this->Program_model->get_by_id($id);

                    if ($row) {
                        $data = array(
                        'button' => 'Update',
                        'action' => site_url('program/update_action'),
		'idProg' => set_value('idProg', $row->idProg),
		'kdProg' => set_value('kdProg', $row->kdProg),
		'nmProg' => set_value('nmProg', $row->nmProg),
		'p_id' => set_value('p_id', $row->p_id),
	    );

                        $data['judul'] = 'Ubah Program';

                        $this->load->view('templates/header', $data);
                        $this->load->view('program/program_form', $data);
                        $this->load->view('templates/footer', $data);

                        } else {
                            $this->session->set_flashdata('error', 'Data tidak ditemukan');
                            redirect(site_url('program'));
                        }
                    }

                    public function update_action() 
                    {
                        $this->_rules();

                        if ($this->form_validation->run() == FALSE) {
                            $this->update($this->input->post('idProg', TRUE));
                            } else {
                                $data = array(
		'kdProg' => $this->input->post('kdProg',TRUE),
		'nmProg' => $this->input->post('nmProg',TRUE),
		'p_id' => $this->input->post('p_id',TRUE),
	    );

                                $this->Program_model->update($this->input->post('idProg', TRUE), $data);
                                $this->session->set_flashdata('success', 'Diubah');
                                redirect(site_url('program'));
                            }
                        }

                        public function delete($id) 
                        {
                            $row = $this->Program_model->get_by_id($id);

                            if ($row) {
                                $this->Program_model->delete($id);
                                $this->session->set_flashdata('success', 'Dihapus');
                                redirect(site_url('program'));
                                } else {
                                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                                    redirect(site_url('program'));
                                }
                            }

                            public function _rules() 
                            {
	$this->form_validation->set_rules('kdProg', 'kdprog', 'trim|required');
	$this->form_validation->set_rules('nmProg', 'nmprog', 'trim|required');
	$this->form_validation->set_rules('p_id', 'p id', 'trim|required');

	$this->form_validation->set_rules('idProg', 'idProg', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
                        }

    public function excel()
                            {
                                $this->load->helper('exportexcel');
                                $namaFile = "program.xls";
                                $judul = "program";
                                $tablehead = 0;
                                $tablebody = 1;
                                $nourut = 1;
        //penulisan header
                                header("Pragma: public");
                                header("Expires: 0");
                                header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
                                header("Content-Type: application/force-download");
                                header("Content-Type: application/octet-stream");
                                header("Content-Type: application/download");
                                header("Content-Disposition: attachment;filename=" . $namaFile . "");
                                header("Content-Transfer-Encoding: binary ");

                                xlsBOF();

                                $kolomhead = 0;
                                xlsWriteLabel($tablehead, $kolomhead++, "No");
	xlsWriteLabel($tablehead, $kolomhead++, "KdProg");
	xlsWriteLabel($tablehead, $kolomhead++, "NmProg");
	xlsWriteLabel($tablehead, $kolomhead++, "P Id");

	foreach ($this->Program_model->get_all() as $data) {
                                    $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                                    xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kdProg);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nmProg);
	    xlsWriteLabel($tablebody, $kolombody++, $data->p_id);

	    $tablebody++;
                                    $nourut++;
                                }

                                xlsEOF();
                                exit();
                            }

}

/* End of file Program.php */
                        /* Location: ./application/controllers/Program.php */
                        /* Please DO NOT modify this information : */
                        /* Generated by Harviacode Codeigniter CRUD Generator 2023-02-17 18:29:33 */
                        /* http://harviacode.com */