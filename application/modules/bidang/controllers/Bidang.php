<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Bidang extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Bidang_model');
        $this->load->library('form_validation');
    }

    public function index()
        {
            $q = urldecode($this->input->get('q', TRUE));
            $start = intval($this->input->get('start'));

            if ($q <> '') {
                $config['base_url'] = base_url() . 'bidang/index.html?q=' . urlencode($q);
                $config['first_url'] = base_url() . 'bidang/index.html?q=' . urlencode($q);
                } else {
                    $config['base_url'] = base_url() . 'bidang/index.html';
                    $config['first_url'] = base_url() . 'bidang/index.html';
                }

                $config['per_page'] = 10;
                $config['page_query_string'] = TRUE;
                $config['total_rows'] = $this->Bidang_model->total_rows($q);
                $bidang = $this->Bidang_model->get_limit_data($config['per_page'], $start, $q);

                $this->load->library('pagination');
                $this->pagination->initialize($config);

                $data = array(
                'bidang_data' => $bidang,
                'q' => $q,
                'pagination' => $this->pagination->create_links(),
                'total_rows' => $config['total_rows'],
                'start' => $start,
                );

                $data['judul'] = 'Data Bidang';

                $this->load->view('templates/header', $data);
                $this->load->view('bidang/bidang_list', $data);
                $this->load->view('templates/footer', $data);
            }

    public function read($id) 
        {
            $row = $this->Bidang_model->get_by_id($id);
            if ($row) {
                $data = array(
		'idBid' => $row->idBid,
		'kdBid' => $row->kdBid,
		'nmBid' => $row->nmBid,
		'p_id' => $row->p_id,
	    );

                $data['judul'] = 'Detail Bidang';

                $this->load->view('templates/header', $data);
                $this->load->view('bidang/bidang_read', $data);
                $this->load->view('templates/footer', $data);
                } else {
                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                    redirect(site_url('bidang'));
                }
            }

            public function create() 
            {
                $data = array(
                'button' => 'Create',
                'action' => site_url('bidang/create_action'),
	    'idBid' => set_value('idBid'),
	    'kdBid' => set_value('kdBid'),
	    'nmBid' => set_value('nmBid'),
	    'p_id' => set_value('p_id'),
	);

                $data['judul'] = 'Tambah Bidang';

                $this->load->view('templates/header', $data);
                $this->load->view('bidang/bidang_form', $data);
                $this->load->view('templates/footer', $data);
            }

            public function create_action() 
            {
                $this->_rules();

                if ($this->form_validation->run() == FALSE) {
                    $this->create();
                    } else {
                        $data = array(
		'kdBid' => $this->input->post('kdBid',TRUE),
		'nmBid' => $this->input->post('nmBid',TRUE),
		'p_id' => $this->input->post('p_id',TRUE),
	    );

                        $this->Bidang_model->insert($data);
                        $this->session->set_flashdata('success', 'Ditambah');
                        redirect(site_url('bidang'));
                    }
                }

                public function update($id) 
                {
                    $row = $this->Bidang_model->get_by_id($id);

                    if ($row) {
                        $data = array(
                        'button' => 'Update',
                        'action' => site_url('bidang/update_action'),
		'idBid' => set_value('idBid', $row->idBid),
		'kdBid' => set_value('kdBid', $row->kdBid),
		'nmBid' => set_value('nmBid', $row->nmBid),
		'p_id' => set_value('p_id', $row->p_id),
	    );

                        $data['judul'] = 'Ubah Bidang';

                        $this->load->view('templates/header', $data);
                        $this->load->view('bidang/bidang_form', $data);
                        $this->load->view('templates/footer', $data);

                        } else {
                            $this->session->set_flashdata('error', 'Data tidak ditemukan');
                            redirect(site_url('bidang'));
                        }
                    }

                    public function update_action() 
                    {
                        $this->_rules();

                        if ($this->form_validation->run() == FALSE) {
                            $this->update($this->input->post('idBid', TRUE));
                            } else {
                                $data = array(
		'kdBid' => $this->input->post('kdBid',TRUE),
		'nmBid' => $this->input->post('nmBid',TRUE),
		'p_id' => $this->input->post('p_id',TRUE),
	    );

                                $this->Bidang_model->update($this->input->post('idBid', TRUE), $data);
                                $this->session->set_flashdata('success', 'Diubah');
                                redirect(site_url('bidang'));
                            }
                        }

                        public function delete($id) 
                        {
                            $row = $this->Bidang_model->get_by_id($id);

                            if ($row) {
                                $this->Bidang_model->delete($id);
                                $this->session->set_flashdata('success', 'Dihapus');
                                redirect(site_url('bidang'));
                                } else {
                                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                                    redirect(site_url('bidang'));
                                }
                            }

                            public function _rules() 
                            {
	$this->form_validation->set_rules('kdBid', 'kdbid', 'trim|required');
	$this->form_validation->set_rules('nmBid', 'nmbid', 'trim|required');
	$this->form_validation->set_rules('p_id', 'p id', 'trim|required');

	$this->form_validation->set_rules('idBid', 'idBid', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
                        }

    public function excel()
                            {
                                $this->load->helper('exportexcel');
                                $namaFile = "bidang.xls";
                                $judul = "bidang";
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
	xlsWriteLabel($tablehead, $kolomhead++, "KdBid");
	xlsWriteLabel($tablehead, $kolomhead++, "NmBid");
	xlsWriteLabel($tablehead, $kolomhead++, "P Id");

	foreach ($this->Bidang_model->get_all() as $data) {
                                    $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                                    xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->kdBid);
	    xlsWriteLabel($tablebody, $kolombody++, $data->nmBid);
	    xlsWriteLabel($tablebody, $kolombody++, $data->p_id);

	    $tablebody++;
                                    $nourut++;
                                }

                                xlsEOF();
                                exit();
                            }

}

/* End of file Bidang.php */
                        /* Location: ./application/controllers/Bidang.php */
                        /* Please DO NOT modify this information : */
                        /* Generated by Harviacode Codeigniter CRUD Generator 2023-02-17 18:29:25 */
                        /* http://harviacode.com */