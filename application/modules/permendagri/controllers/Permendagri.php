<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Permendagri extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Permendagri_model');
        $this->load->library('form_validation');
    }

    public function index()
        {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));

            if ($q <> '') {
                $config['base_url'] = base_url() . 'permendagri/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'permendagri/index.html?q=' . urlencode($q);
                } else {
                    $config['base_url'] = base_url() . 'permendagri/index.html';
                    $config['first_url'] = base_url() . 'permendagri/index.html';
                }

                $config['per_page'] = 10;
                $config['page_query_string'] = TRUE;
                $config['total_rows'] = $this->Permendagri_model->total_rows($q);
                $permendagri = $this->Permendagri_model->get_limit_data($config['per_page'], $start, $q);

                $this->load->library('pagination');
                $this->pagination->initialize($config);

                $data = array(
                'permendagri_data' => $permendagri,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
                );

                $data['judul'] = 'Data Permendagri';

                $this->load->view('templates/header', $data);
                $this->load->view('permendagri/permendagri_list', $data);
                $this->load->view('templates/footer', $data);
            }

    public function read($id) 
        {
            $row = $this->Permendagri_model->get_by_id($id);
            if ($row) {
                $data = array(
		'id_nya' => $row->id_nya,
		'Kode' => $row->Kode,
		'Bidang_Urusan_Program_Kegiatan_Sub_Kegiatan' => $row->Bidang_Urusan_Program_Kegiatan_Sub_Kegiatan,
		'Kinerja' => $row->Kinerja,
		'Indikator' => $row->Indikator,
		'Satuan' => $row->Satuan,
		'p_id' => $row->p_id,
	    );

                $data['judul'] = 'Detail Permendagri';

                $this->load->view('templates/header', $data);
                $this->load->view('permendagri/permendagri_read', $data);
                $this->load->view('templates/footer', $data);
                } else {
                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                    redirect(site_url('permendagri'));
                }
            }

            public function create() 
            {
                $data = array(
                'button' => 'Create',
                'action' => site_url('permendagri/create_action'),
	    'id_nya' => set_value('id_nya'),
	    'Kode' => set_value('Kode'),
	    'Bidang_Urusan_Program_Kegiatan_Sub_Kegiatan' => set_value('Bidang_Urusan_Program_Kegiatan_Sub_Kegiatan'),
	    'Kinerja' => set_value('Kinerja'),
	    'Indikator' => set_value('Indikator'),
	    'Satuan' => set_value('Satuan'),
	    'p_id' => set_value('p_id'),
	);

                $data['judul'] = 'Tambah Permendagri';

                $this->load->view('templates/header', $data);
                $this->load->view('permendagri/permendagri_form', $data);
                $this->load->view('templates/footer', $data);
            }

            public function create_action() 
            {
                $this->_rules();

                if ($this->form_validation->run() == FALSE) {
                    $this->create();
                    } else {
                        $data = array(
		'Kode' => $this->input->post('Kode',TRUE),
		'Bidang_Urusan_Program_Kegiatan_Sub_Kegiatan' => $this->input->post('Bidang_Urusan_Program_Kegiatan_Sub_Kegiatan',TRUE),
		'Kinerja' => $this->input->post('Kinerja',TRUE),
		'Indikator' => $this->input->post('Indikator',TRUE),
		'Satuan' => $this->input->post('Satuan',TRUE),
		'p_id' => $this->input->post('p_id',TRUE),
	    );

                        $this->Permendagri_model->insert($data);
                        $this->session->set_flashdata('success', 'Ditambah');
                        redirect(site_url('permendagri'));
                    }
                }

                public function update($id) 
                {
                    $row = $this->Permendagri_model->get_by_id($id);

                    if ($row) {
                        $data = array(
                        'button' => 'Update',
                        'action' => site_url('permendagri/update_action'),
		'id_nya' => set_value('id_nya', $row->id_nya),
		'Kode' => set_value('Kode', $row->Kode),
		'Bidang_Urusan_Program_Kegiatan_Sub_Kegiatan' => set_value('Bidang_Urusan_Program_Kegiatan_Sub_Kegiatan', $row->Bidang_Urusan_Program_Kegiatan_Sub_Kegiatan),
		'Kinerja' => set_value('Kinerja', $row->Kinerja),
		'Indikator' => set_value('Indikator', $row->Indikator),
		'Satuan' => set_value('Satuan', $row->Satuan),
		'p_id' => set_value('p_id', $row->p_id),
	    );

                        $data['judul'] = 'Ubah Permendagri';

                        $this->load->view('templates/header', $data);
                        $this->load->view('permendagri/permendagri_form', $data);
                        $this->load->view('templates/footer', $data);

                        } else {
                            $this->session->set_flashdata('error', 'Data tidak ditemukan');
                            redirect(site_url('permendagri'));
                        }
                    }

                    public function update_action() 
                    {
                        $this->_rules();

                        if ($this->form_validation->run() == FALSE) {
                            $this->update($this->input->post('id_nya', TRUE));
                            } else {
                                $data = array(
		'Kode' => $this->input->post('Kode',TRUE),
		'Bidang_Urusan_Program_Kegiatan_Sub_Kegiatan' => $this->input->post('Bidang_Urusan_Program_Kegiatan_Sub_Kegiatan',TRUE),
		'Kinerja' => $this->input->post('Kinerja',TRUE),
		'Indikator' => $this->input->post('Indikator',TRUE),
		'Satuan' => $this->input->post('Satuan',TRUE),
		'p_id' => $this->input->post('p_id',TRUE),
	    );

                                $this->Permendagri_model->update($this->input->post('id_nya', TRUE), $data);
                                $this->session->set_flashdata('success', 'Diubah');
                                redirect(site_url('permendagri'));
                            }
                        }

                        public function delete($id) 
                        {
                            $row = $this->Permendagri_model->get_by_id($id);

                            if ($row) {
                                $this->Permendagri_model->delete($id);
                                $this->session->set_flashdata('success', 'Dihapus');
                                redirect(site_url('permendagri'));
                                } else {
                                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                                    redirect(site_url('permendagri'));
                                }
                            }

                            public function _rules() 
                            {
	$this->form_validation->set_rules('Kode', 'kode', 'trim|required');
	$this->form_validation->set_rules('Bidang_Urusan_Program_Kegiatan_Sub_Kegiatan', 'bidang urusan program kegiatan sub kegiatan', 'trim|required');
	$this->form_validation->set_rules('Kinerja', 'kinerja', 'trim|required');
	$this->form_validation->set_rules('Indikator', 'indikator', 'trim|required');
	$this->form_validation->set_rules('Satuan', 'satuan', 'trim|required');
	$this->form_validation->set_rules('p_id', 'p id', 'trim|required');

	$this->form_validation->set_rules('id_nya', 'id_nya', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
                        }

    public function excel()
                            {
                                $this->load->helper('exportexcel');
                                $namaFile = "permendagri.xls";
                                $judul = "permendagri";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Kode");
	xlsWriteLabel($tablehead, $kolomhead++, "Bidang Urusan Program Kegiatan Sub Kegiatan");
	xlsWriteLabel($tablehead, $kolomhead++, "Kinerja");
	xlsWriteLabel($tablehead, $kolomhead++, "Indikator");
	xlsWriteLabel($tablehead, $kolomhead++, "Satuan");
	xlsWriteLabel($tablehead, $kolomhead++, "P Id");

	foreach ($this->Permendagri_model->get_all() as $data) {
                                    $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                                    xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Kode);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Bidang_Urusan_Program_Kegiatan_Sub_Kegiatan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Kinerja);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Indikator);
	    xlsWriteLabel($tablebody, $kolombody++, $data->Satuan);
	    xlsWriteLabel($tablebody, $kolombody++, $data->p_id);

	    $tablebody++;
                                    $nourut++;
                                }

                                xlsEOF();
                                exit();
                            }

}

/* End of file Permendagri.php */
                        /* Location: ./application/controllers/Permendagri.php */
                        /* Please DO NOT modify this information : */
                        /* Generated by Harviacode Codeigniter CRUD Generator 2023-01-31 15:43:26 */
                        /* http://harviacode.com */