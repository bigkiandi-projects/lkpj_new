<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Rekomendasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Rekomendasi_model', 'opd/Opd_model', 'urusan/Urusan_model'));
        $this->load->library('form_validation');
    }

    public function index() {

        $get_urusan = $this->Rekomendasi_model->get_urusan($id_user = '');

        $data = array(
        'get_urusan' => $get_urusan,
        );

        $data['judul'] = 'Data Rekomendasi DPRD';

        $this->load->view('templates/header', $data);
        $this->load->view('rekomendasi/rekomendasi_list', $data);
        $this->load->view('templates/footer', $data);
    }

    public function create() {

        $data = array(
        'button' => 'Create',
        'action' => site_url('rekomendasi/create_action'),

        'id_rek' => set_value('id_rek'),
        'opd' => set_value('opd'),
        'urusan' => set_value('urusan'),
        'rekomendasi' => set_value('rekomendasi'),
        'tindak_lanjut' => set_value('tindak_lanjut'),
        'tujuan' => set_value('tujuan'),

        'd_opd' => $this->Opd_model->get_opd_join(),
        'd_urusan' => $this->Urusan_model->get_all(),
        );

        $data['judul'] = 'Tambah Rekomendasi DPRD';

        $this->load->view('templates/header', $data);
        $this->load->view('rekomendasi/rekomendasi_form', $data);
        $this->load->view('templates/footer', $data);
    }

    public function check_ur() {
        $opd = $this->input->get('opd');
        $result = $this->Rekomendasi_model->check_urusan($opd);
        echo json_encode($result);
    }

    public function create_action() {

        $data_ur = array(
            'kode' => $this->input->post('kode_urusan'),
            'urusan' => $this->input->post('urusan_name'),
            'tahun' => $this->session->userdata('ta'),
        );

        $get_last_id_ur = $this->Rekomendasi_model->save_rekomendasi_urusan($data_ur);
        if(isset($get_last_id_ur)) {

            $data_ur_opd = array (
            'opd' => $this->input->post('opd'),
            'kode' => $this->input->post('kode_opd'),
            'p_id' => $get_last_id_ur,
            'tahun' => $this->session->userdata('ta'),
            );

        }

        $get_last_id_ur_opd = $this->Rekomendasi_model->save_rekomendasi_opd($data_ur_opd);
        if (isset($get_last_id_ur_opd)) {
            $data_rek = array(
        		'rekomendasi' => $this->input->post('rekomendasi',TRUE),
        		'tindak_lanjut' => $this->input->post('tindak_lanjut',TRUE),
        		'tujuan' => $this->input->post('tujuan',TRUE),
        		'p_id' => $get_last_id_ur_opd,
    	    );
        }

        $this->Rekomendasi_model->insert($data_rek);

        $this->session->set_flashdata('success', 'Ditambah');
        redirect(site_url('rekomendasi'));

    }

    public function update($id) {
        $row = $this->Rekomendasi_model->get_by_id($id);

        if ($row) {
            $data = array(
            'button' => 'Update',
            'action' => site_url('rekomendasi/update_action'),
    		'id_rek' => set_value('id_rek', $row->id_rek),
    		'rekomendasi' => set_value('rekomendasi', $row->rekomendasi),
    		'tindak_lanjut' => set_value('tindak_lanjut', $row->tindak_lanjut),
    		'tujuan' => set_value('tujuan', $row->tujuan),
    		'p_id' => set_value('p_id', $row->p_id),

            'd_opd' => $this->Opd_model->get_opd_join(),
            'd_urusan' => $this->Urusan_model->get_all(),
    	    );

            $data['judul'] = 'Ubah Rekomendasi';

            $this->load->view('templates/header', $data);
            $this->load->view('rekomendasi/rekomendasi_form', $data);
            $this->load->view('templates/footer', $data);

            } else {
                $this->session->set_flashdata('error', 'Data tidak ditemukan');
                redirect(site_url('rekomendasi'));
            }
    }

    public function update_action() {

        $data = array(
		'rekomendasi' => $this->input->post('rekomendasi',TRUE),
		'tindak_lanjut' => $this->input->post('tindak_lanjut',TRUE),
		'tujuan' => $this->input->post('tujuan',TRUE),
	    );

        $this->Rekomendasi_model->update($this->input->post('id_rek', TRUE), $data);
        $this->session->set_flashdata('success', 'Diubah');
        redirect(site_url('rekomendasi'));
    }

    public function delete($id) {
        $row = $this->Rekomendasi_model->get_by_id($id);

        if ($row) {
            $this->Rekomendasi_model->delete($id);
            $this->session->set_flashdata('success', 'Dihapus');
            redirect(site_url('rekomendasi'));
            } else {
                $this->session->set_flashdata('error', 'Data tidak ditemukan');
                redirect(site_url('rekomendasi'));
            }
    }

                            public function _rules() 
                            {
	$this->form_validation->set_rules('rekomendasi', 'rekomendasi', 'trim|required');
	$this->form_validation->set_rules('tindak_lanjut', 'tindak lanjut', 'trim|required');
	$this->form_validation->set_rules('tujuan', 'tujuan', 'trim|required');
	$this->form_validation->set_rules('parent_id', 'parent id', 'trim|required|numeric');

	$this->form_validation->set_rules('id_rek', 'id_rek', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
                        }

    public function excel()
                            {
                                $this->load->helper('exportexcel');
                                $namaFile = "rekomendasi.xls";
                                $judul = "rekomendasi";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Rekomendasi");
	xlsWriteLabel($tablehead, $kolomhead++, "Tindak Lanjut");
	xlsWriteLabel($tablehead, $kolomhead++, "Tujuan");
	xlsWriteLabel($tablehead, $kolomhead++, "Parent Id");

	foreach ($this->Rekomendasi_model->get_all() as $data) {
                                    $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                                    xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->rekomendasi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tindak_lanjut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->tujuan);
	    xlsWriteNumber($tablebody, $kolombody++, $data->parent_id);

	    $tablebody++;
                                    $nourut++;
                                }

                                xlsEOF();
                                exit();
                            }

}

/* End of file Rekomendasi.php */
                        /* Location: ./application/controllers/Rekomendasi.php */
                        /* Please DO NOT modify this information : */
                        /* Generated by Harviacode Codeigniter CRUD Generator 2024-02-10 23:32:32 */
                        /* http://harviacode.com */