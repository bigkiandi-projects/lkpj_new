<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Urusan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Urusan_model');
        $this->load->library('form_validation');
    }

    public function index()
        {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));

            if ($q <> '') {
                $config['base_url'] = base_url() . 'urusan/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'urusan/index.html?q=' . urlencode($q);
                } else {
                    $config['base_url'] = base_url() . 'urusan/index.html';
                    $config['first_url'] = base_url() . 'urusan/index.html';
                }

                $config['per_page'] = 10;
                $config['page_query_string'] = TRUE;
                $config['total_rows'] = $this->Urusan_model->total_rows($q);
                $urusan = $this->Urusan_model->get_limit_data($config['per_page'], $start, $q);

                $this->load->library('pagination');
                $this->pagination->initialize($config);

                $data = array(
                'urusan_data' => $urusan,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
                );

                $data['judul'] = 'Data Urusan';

                $this->load->view('templates/header', $data);
                $this->load->view('urusan/urusan_list', $data);
                $this->load->view('templates/footer', $data);
            }

    public function read($id) 
        {
            $row = $this->Urusan_model->get_by_id($id);
            if ($row) {
                $data = array(
		'idUrus' => $row->idUrus,
		'kdUrus' => $row->kdUrus,
		'nmUrus' => $row->nmUrus,
	    );

                $data['judul'] = 'Detail Urusan';

                $this->load->view('templates/header', $data);
                $this->load->view('urusan/urusan_read', $data);
                $this->load->view('templates/footer', $data);
                } else {
                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                    redirect(site_url('urusan'));
                }
            }

            public function create() 
            {
                $data = array(
                'button' => 'Create',
                'action' => site_url('urusan/create_action'),
	    'idUrus' => set_value('idUrus'),
	    'kdUrus' => set_value('kdUrus'),
	    'nmUrus' => set_value('nmUrus'),
	);

                $data['judul'] = 'Tambah Urusan';

                $this->load->view('templates/header', $data);
                $this->load->view('urusan/urusan_form', $data);
                $this->load->view('templates/footer', $data);
            }

            public function create_action() 
            {
                $this->_rules();

                if ($this->form_validation->run() == FALSE) {
                    $this->create();
                    } else {
                        $data = array(
		'kdUrus' => $this->input->post('kdUrus',TRUE),
		'nmUrus' => $this->input->post('nmUrus',TRUE),
	    );

                        $this->Urusan_model->insert($data);
                        $this->session->set_flashdata('success', 'Ditambah');
                        redirect(site_url('urusan'));
                    }
                }

                public function update($id) 
                {
                    $row = $this->Urusan_model->get_by_id($id);

                    if ($row) {
                        $data = array(
                        'button' => 'Update',
                        'action' => site_url('urusan/update_action'),
		'idUrus' => set_value('idUrus', $row->idUrus),
		'kdUrus' => set_value('kdUrus', $row->kdUrus),
		'nmUrus' => set_value('nmUrus', $row->nmUrus),
	    );

                        $data['judul'] = 'Ubah Urusan';

                        $this->load->view('templates/header', $data);
                        $this->load->view('urusan/urusan_form', $data);
                        $this->load->view('templates/footer', $data);

                        } else {
                            $this->session->set_flashdata('error', 'Data tidak ditemukan');
                            redirect(site_url('urusan'));
                        }
                    }

                    public function update_action() 
                    {
                        $this->_rules();

                        if ($this->form_validation->run() == FALSE) {
                            $this->update($this->input->post('idUrus', TRUE));
                            } else {
                                $data = array(
		'kdUrus' => $this->input->post('kdUrus',TRUE),
		'nmUrus' => $this->input->post('nmUrus',TRUE),
	    );

                                $this->Urusan_model->update($this->input->post('idUrus', TRUE), $data);
                                $this->session->set_flashdata('success', 'Diubah');
                                redirect(site_url('urusan'));
                            }
                        }

                        public function delete($id) 
                        {
                            $row = $this->Urusan_model->get_by_id($id);

                            if ($row) {
                                $this->Urusan_model->delete($id);
                                $this->session->set_flashdata('success', 'Dihapus');
                                redirect(site_url('urusan'));
                                } else {
                                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                                    redirect(site_url('urusan'));
                                }
                            }

                            public function _rules() 
                            {
	$this->form_validation->set_rules('kdUrus', 'kdurus', 'trim|required');
	$this->form_validation->set_rules('nmUrus', 'nmurus', 'trim|required');

	$this->form_validation->set_rules('idUrus', 'idUrus', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
                        }

    public function excel()
                            {
                                $this->load->helper('exportexcel');
                                $namaFile = "urusan.xls";
                                $judul = "urusan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "KdUrus");
	xlsWriteLabel($tablehead, $kolomhead++, "NmUrus");

	foreach ($this->Urusan_model->get_all() as $data) {
                                    $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                                    xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kdUrus);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nmUrus);

	    $tablebody++;
                                    $nourut++;
                                }

                                xlsEOF();
                                exit();
                            }

}

/* End of file Urusan.php */
                        /* Location: ./application/controllers/Urusan.php */
                        /* Please DO NOT modify this information : */
                        /* Generated by Harviacode Codeigniter CRUD Generator 2023-02-17 18:29:09 */
                        /* http://harviacode.com */