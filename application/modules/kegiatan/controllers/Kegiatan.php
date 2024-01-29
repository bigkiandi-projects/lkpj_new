<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Kegiatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kegiatan_model');
        $this->load->library('form_validation');
    }

    public function index()
        {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));

            if ($q <> '') {
                $config['base_url'] = base_url() . 'kegiatan/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'kegiatan/index.html?q=' . urlencode($q);
                } else {
                    $config['base_url'] = base_url() . 'kegiatan/index.html';
                    $config['first_url'] = base_url() . 'kegiatan/index.html';
                }

                $config['per_page'] = 10;
                $config['page_query_string'] = TRUE;
                $config['total_rows'] = $this->Kegiatan_model->total_rows($q);
                $kegiatan = $this->Kegiatan_model->get_limit_data($config['per_page'], $start, $q);

                $this->load->library('pagination');
                $this->pagination->initialize($config);

                $data = array(
                'kegiatan_data' => $kegiatan,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
                );

                $data['judul'] = 'Data Kegiatan';

                $this->load->view('templates/header', $data);
                $this->load->view('kegiatan/kegiatan_list', $data);
                $this->load->view('templates/footer', $data);
            }

    public function read($id) 
        {
            $row = $this->Kegiatan_model->get_by_id($id);
            if ($row) {
                $data = array(
		'idKeg' => $row->idKeg,
		'kdKeg' => $row->kdKeg,
		'nmKeg' => $row->nmKeg,
		'p_id' => $row->p_id,
	    );

                $data['judul'] = 'Detail Kegiatan';

                $this->load->view('templates/header', $data);
                $this->load->view('kegiatan/kegiatan_read', $data);
                $this->load->view('templates/footer', $data);
                } else {
                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                    redirect(site_url('kegiatan'));
                }
            }

            public function create() 
            {
                $data = array(
                'button' => 'Create',
                'action' => site_url('kegiatan/create_action'),
	    'idKeg' => set_value('idKeg'),
	    'kdKeg' => set_value('kdKeg'),
	    'nmKeg' => set_value('nmKeg'),
	    'p_id' => set_value('p_id'),
	);

                $data['judul'] = 'Tambah Kegiatan';

                $this->load->view('templates/header', $data);
                $this->load->view('kegiatan/kegiatan_form', $data);
                $this->load->view('templates/footer', $data);
            }

            public function create_action() 
            {
                $this->_rules();

                if ($this->form_validation->run() == FALSE) {
                    $this->create();
                    } else {
                        $data = array(
		'kdKeg' => $this->input->post('kdKeg',TRUE),
		'nmKeg' => $this->input->post('nmKeg',TRUE),
		'p_id' => $this->input->post('p_id',TRUE),
	    );

                        $this->Kegiatan_model->insert($data);
                        $this->session->set_flashdata('success', 'Ditambah');
                        redirect(site_url('kegiatan'));
                    }
                }

                public function update($id) 
                {
                    $row = $this->Kegiatan_model->get_by_id($id);

                    if ($row) {
                        $data = array(
                        'button' => 'Update',
                        'action' => site_url('kegiatan/update_action'),
		'idKeg' => set_value('idKeg', $row->idKeg),
		'kdKeg' => set_value('kdKeg', $row->kdKeg),
		'nmKeg' => set_value('nmKeg', $row->nmKeg),
		'p_id' => set_value('p_id', $row->p_id),
	    );

                        $data['judul'] = 'Ubah Kegiatan';

                        $this->load->view('templates/header', $data);
                        $this->load->view('kegiatan/kegiatan_form', $data);
                        $this->load->view('templates/footer', $data);

                        } else {
                            $this->session->set_flashdata('error', 'Data tidak ditemukan');
                            redirect(site_url('kegiatan'));
                        }
                    }

                    public function update_action() 
                    {
                        $this->_rules();

                        if ($this->form_validation->run() == FALSE) {
                            $this->update($this->input->post('idKeg', TRUE));
                            } else {
                                $data = array(
		'kdKeg' => $this->input->post('kdKeg',TRUE),
		'nmKeg' => $this->input->post('nmKeg',TRUE),
		'p_id' => $this->input->post('p_id',TRUE),
	    );

                                $this->Kegiatan_model->update($this->input->post('idKeg', TRUE), $data);
                                $this->session->set_flashdata('success', 'Diubah');
                                redirect(site_url('kegiatan'));
                            }
                        }

                        public function delete($id) 
                        {
                            $row = $this->Kegiatan_model->get_by_id($id);

                            if ($row) {
                                $this->Kegiatan_model->delete($id);
                                $this->session->set_flashdata('success', 'Dihapus');
                                redirect(site_url('kegiatan'));
                                } else {
                                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                                    redirect(site_url('kegiatan'));
                                }
                            }

                            public function _rules() 
                            {
	$this->form_validation->set_rules('kdKeg', 'kdkeg', 'trim|required');
	$this->form_validation->set_rules('nmKeg', 'nmkeg', 'trim|required');
	$this->form_validation->set_rules('p_id', 'p id', 'trim|required');

	$this->form_validation->set_rules('idKeg', 'idKeg', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
                        }

    public function excel()
                            {
                                $this->load->helper('exportexcel');
                                $namaFile = "kegiatan.xls";
                                $judul = "kegiatan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "KdKeg");
	xlsWriteLabel($tablehead, $kolomhead++, "NmKeg");
	xlsWriteLabel($tablehead, $kolomhead++, "P Id");

	foreach ($this->Kegiatan_model->get_all() as $data) {
                                    $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                                    xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kdKeg);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nmKeg);
	    xlsWriteLabel($tablebody, $kolombody++, $data->p_id);

	    $tablebody++;
                                    $nourut++;
                                }

                                xlsEOF();
                                exit();
                            }

}

/* End of file Kegiatan.php */
                        /* Location: ./application/controllers/Kegiatan.php */
                        /* Please DO NOT modify this information : */
                        /* Generated by Harviacode Codeigniter CRUD Generator 2023-02-17 18:29:39 */
                        /* http://harviacode.com */