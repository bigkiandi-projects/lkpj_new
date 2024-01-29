<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Subkegiatan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Subkegiatan_model');
        $this->load->library('form_validation');
    }

    public function index()
        {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));

            if ($q <> '') {
                $config['base_url'] = base_url() . 'subkegiatan/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'subkegiatan/index.html?q=' . urlencode($q);
                } else {
                    $config['base_url'] = base_url() . 'subkegiatan/index.html';
                    $config['first_url'] = base_url() . 'subkegiatan/index.html';
                }

                $config['per_page'] = 30;
                $config['page_query_string'] = TRUE;
                $config['total_rows'] = $this->Subkegiatan_model->total_rows($q);
                $subkegiatan = $this->Subkegiatan_model->get_limit_data($config['per_page'], $start, $q);

                $this->load->library('pagination');
                $this->pagination->initialize($config);

                $data = array(
                'subkegiatan_data' => $subkegiatan,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
                );

                $data['judul'] = 'Data Subkegiatan';

                $this->load->view('templates/header', $data);
                $this->load->view('subkegiatan/subkegiatan_list', $data);
                $this->load->view('templates/footer', $data);
            }

    public function read($id) 
        {
            $row = $this->Subkegiatan_model->get_by_id($id);
            if ($row) {
                $data = array(
		'idSubkeg' => $row->idSubkeg,
		'kdSubkeg' => $row->kdSubkeg,
		'nmSubkeg' => $row->nmSubkeg,
		'kinerja' => $row->kinerja,
		'indikator' => $row->indikator,
		'satuan' => $row->satuan,
		'p_id' => $row->p_id,
	    );

                $data['judul'] = 'Detail Subkegiatan';

                $this->load->view('templates/header', $data);
                $this->load->view('subkegiatan/subkegiatan_read', $data);
                $this->load->view('templates/footer', $data);
                } else {
                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                    redirect(site_url('subkegiatan'));
                }
            }

            public function create() 
            {
                $data = array(
                'button' => 'Create',
                'action' => site_url('subkegiatan/create_action'),
	    'idSubkeg' => set_value('idSubkeg'),
	    'kdSubkeg' => set_value('kdSubkeg'),
	    'nmSubkeg' => set_value('nmSubkeg'),
	    'kinerja' => set_value('kinerja'),
	    'indikator' => set_value('indikator'),
	    'satuan' => set_value('satuan'),
	    'p_id' => set_value('p_id'),
	);

                $data['judul'] = 'Tambah Subkegiatan';

                $this->load->view('templates/header', $data);
                $this->load->view('subkegiatan/subkegiatan_form', $data);
                $this->load->view('templates/footer', $data);
            }

            public function create_action() 
            {
                $this->_rules();

                if ($this->form_validation->run() == FALSE) {
                    $this->create();
                    } else {
                        $data = array(
		'kdSubkeg' => $this->input->post('kdSubkeg',TRUE),
		'nmSubkeg' => $this->input->post('nmSubkeg',TRUE),
		'kinerja' => $this->input->post('kinerja',TRUE),
		'indikator' => $this->input->post('indikator',TRUE),
		'satuan' => $this->input->post('satuan',TRUE),
		'p_id' => $this->input->post('p_id',TRUE),
	    );

                        $this->Subkegiatan_model->insert($data);
                        $this->session->set_flashdata('success', 'Ditambah');
                        redirect(site_url('subkegiatan'));
                    }
                }

                public function update($id) 
                {
                    $row = $this->Subkegiatan_model->get_by_id($id);

                    if ($row) {
                        $data = array(
                        'button' => 'Update',
                        'action' => site_url('subkegiatan/update_action'),
		'idSubkeg' => set_value('idSubkeg', $row->idSubkeg),
		'kdSubkeg' => set_value('kdSubkeg', $row->kdSubkeg),
		'nmSubkeg' => set_value('nmSubkeg', $row->nmSubkeg),
		'kinerja' => set_value('kinerja', $row->kinerja),
		'indikator' => set_value('indikator', $row->indikator),
		'satuan' => set_value('satuan', $row->satuan),
		'p_id' => set_value('p_id', $row->p_id),
	    );

                        $data['judul'] = 'Ubah Subkegiatan';

                        $this->load->view('templates/header', $data);
                        $this->load->view('subkegiatan/subkegiatan_form', $data);
                        $this->load->view('templates/footer', $data);

                        } else {
                            $this->session->set_flashdata('error', 'Data tidak ditemukan');
                            redirect(site_url('subkegiatan'));
                        }
                    }

                    public function update_action() 
                    {
                        $this->_rules();

                        if ($this->form_validation->run() == FALSE) {
                            $this->update($this->input->post('idSubkeg', TRUE));
                            } else {
                                $data = array(
		'kdSubkeg' => $this->input->post('kdSubkeg',TRUE),
		'nmSubkeg' => $this->input->post('nmSubkeg',TRUE),
		'kinerja' => $this->input->post('kinerja',TRUE),
		'indikator' => $this->input->post('indikator',TRUE),
		'satuan' => $this->input->post('satuan',TRUE),
		'p_id' => $this->input->post('p_id',TRUE),
	    );

                                $this->Subkegiatan_model->update($this->input->post('idSubkeg', TRUE), $data);
                                $this->session->set_flashdata('success', 'Diubah');
                                redirect(site_url('subkegiatan'));
                            }
                        }

                        public function delete($id) 
                        {
                            $row = $this->Subkegiatan_model->get_by_id($id);

                            if ($row) {
                                $this->Subkegiatan_model->delete($id);
                                $this->session->set_flashdata('success', 'Dihapus');
                                redirect(site_url('subkegiatan'));
                                } else {
                                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                                    redirect(site_url('subkegiatan'));
                                }
                            }

                            public function _rules() 
                            {
	$this->form_validation->set_rules('kdSubkeg', 'kdsubkeg', 'trim|required');
	$this->form_validation->set_rules('nmSubkeg', 'nmsubkeg', 'trim|required');
	$this->form_validation->set_rules('kinerja', 'kinerja', 'trim|required');
	$this->form_validation->set_rules('indikator', 'indikator', 'trim|required');
	$this->form_validation->set_rules('satuan', 'satuan', 'trim|required');
	$this->form_validation->set_rules('p_id', 'p id', 'trim|required');

	$this->form_validation->set_rules('idSubkeg', 'idSubkeg', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
                        }

    public function excel()
                            {
                                $this->load->helper('exportexcel');
                                $namaFile = "subkegiatan.xls";
                                $judul = "subkegiatan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "KdSubkeg");
	xlsWriteLabel($tablehead, $kolomhead++, "NmSubkeg");
	xlsWriteLabel($tablehead, $kolomhead++, "Kinerja");
	xlsWriteLabel($tablehead, $kolomhead++, "Indikator");
	xlsWriteLabel($tablehead, $kolomhead++, "Satuan");
	xlsWriteLabel($tablehead, $kolomhead++, "P Id");

	foreach ($this->Subkegiatan_model->get_all() as $data) {
                                    $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                                    xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kdSubkeg);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nmSubkeg);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kinerja);
	    xlsWriteLabel($tablebody, $kolombody++, $data->indikator);
	    xlsWriteLabel($tablebody, $kolombody++, $data->satuan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->p_id);

	    $tablebody++;
                                    $nourut++;
                                }

                                xlsEOF();
                                exit();
                            }

}

/* End of file Subkegiatan.php */
                        /* Location: ./application/controllers/Subkegiatan.php */
                        /* Please DO NOT modify this information : */
                        /* Generated by Harviacode Codeigniter CRUD Generator 2023-02-17 18:29:45 */
                        /* http://harviacode.com */