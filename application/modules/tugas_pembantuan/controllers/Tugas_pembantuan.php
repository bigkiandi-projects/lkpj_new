<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

class Tugas_pembantuan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Tugas_pembantuan_model');
        $this->load->library('form_validation');
    }

    public function index()
        {
            $tugas_pembantuan = $this->Tugas_pembantuan_model->get_data();

            $data = array(
            'tugas_pembantuan_data' => $tugas_pembantuan,
            'start' => 0,
            );

            $data['judul'] = 'Data Tugas Pembantuan';

            $this->load->view('templates/header', $data);
            $this->load->view('tugas_pembantuan/tugas_pembantuan_list', $data);
            $this->load->view('templates/footer', $data);
            }

    public function read($id) 
    {
            $row = $this->Tugas_pembantuan_model->get_by_id($id);
            if ($row) {
                $data = array(
        		'id' => $row->id,
        		'instansi_pemberi_tugas' => $row->instansi_pemberi_tugas,
        		'dasar_hukum' => $row->dasar_hukum,
        		'program_keg_output' => $row->program_keg_output,
        		'lokasi' => $row->lokasi,
        		'skpd_pelaksana' => $row->skpd_pelaksana,
        		'alokasi_anggaran' => $row->alokasi_anggaran,
        		'realisasi_anggaran' => $row->realisasi_anggaran,
        		'persentase' => $row->persentase,
        		'realisasi_capaian' => $row->realisasi_capaian,
        		'tahun' => $row->tahun,
        	    );

                $data['judul'] = 'Detail Tugas_pembantuan';

                $this->load->view('templates/header', $data);
                $this->load->view('tugas_pembantuan/tugas_pembantuan_read', $data);
                $this->load->view('templates/footer', $data);
                } else {
                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                    redirect(site_url('tugas_pembantuan'));
                }
    }

    public function create() {
        $data = array(
        'button' => 'Create',
        'action' => site_url('tugas_pembantuan/create_action'),
	    'id' => set_value('id'),
	    'instansi_pemberi_tugas' => set_value('instansi_pemberi_tugas'),
	    'dasar_hukum' => set_value('dasar_hukum'),
	    'program_keg_output' => set_value('program_keg_output'),
	    'lokasi' => set_value('lokasi'),
	    'skpd_pelaksana' => set_value('skpd_pelaksana', $this->session->userdata('nama_user')),
	    'alokasi_anggaran' => set_value('alokasi_anggaran'),
	    'realisasi_anggaran' => set_value('realisasi_anggaran'),
	    'persentase' => set_value('persentase'),
	    'realisasi_capaian' => set_value('realisasi_capaian'),
	    'tahun' => set_value('tahun'),
	   );

        $data['judul'] = 'Tambah Tugas Pembantuan';

        $this->load->view('templates/header', $data);
        $this->load->view('tugas_pembantuan/tugas_pembantuan_form', $data);
        $this->load->view('templates/footer', $data);
    }

    public function create_action() 
    {
        $this->_rules();

        $al = preg_replace('/\./', '', $this->input->post('alokasi_anggaran'));
        $real = preg_replace('/\./', '', $this->input->post('realisasi_anggaran'));

        if ($this->form_validation->run() == FALSE) {
            $this->create();
            } else {
                $data = array(
        		'instansi_pemberi_tugas' => $this->input->post('instansi_pemberi_tugas',TRUE),
        		'dasar_hukum' => $this->input->post('dasar_hukum',TRUE),
        		'program_keg_output' => $this->input->post('program_keg_output',TRUE),
        		'lokasi' => $this->input->post('lokasi',TRUE),
        		'skpd_pelaksana' => $this->input->post('skpd_pelaksana',TRUE),
        		'alokasi_anggaran' => $al,
        		'realisasi_anggaran' => $real,
        		'persentase' => $this->input->post('persentase',TRUE),
        		'realisasi_capaian' => $this->input->post('realisasi_capaian',TRUE),
        		'tahun' => $this->session->userdata('ta'),
        	    );

                $this->Tugas_pembantuan_model->insert($data);
                $this->session->set_flashdata('success', 'Ditambah');
                redirect(site_url('tugas_pembantuan'));
            }
        }

    public function update($id) 
    {
        $row = $this->Tugas_pembantuan_model->get_by_id($id);

        if ($row) {
            $data = array(
            'button' => 'Update',
            'action' => site_url('tugas_pembantuan/update_action'),
    		'id' => set_value('id', $row->id),
    		'instansi_pemberi_tugas' => set_value('instansi_pemberi_tugas', $row->instansi_pemberi_tugas),
    		'dasar_hukum' => set_value('dasar_hukum', $row->dasar_hukum),
    		'program_keg_output' => set_value('program_keg_output', $row->program_keg_output),
    		'lokasi' => set_value('lokasi', $row->lokasi),
    		'skpd_pelaksana' => set_value('skpd_pelaksana', $row->skpd_pelaksana),
    		'alokasi_anggaran' => set_value('alokasi_anggaran', $row->alokasi_anggaran),
    		'realisasi_anggaran' => set_value('realisasi_anggaran', $row->realisasi_anggaran),
    		'persentase' => set_value('persentase', $row->persentase),
    		'realisasi_capaian' => set_value('realisasi_capaian', $row->realisasi_capaian),
    		'tahun' => set_value('tahun', $row->tahun),
    	    );

            $data['judul'] = 'Ubah/Lihat Tugas Pembantuan';

            $this->load->view('templates/header', $data);
            $this->load->view('tugas_pembantuan/tugas_pembantuan_form', $data);
            $this->load->view('templates/footer', $data);

            } else {
                $this->session->set_flashdata('error', 'Data tidak ditemukan');
                redirect(site_url('tugas_pembantuan'));
            }
    }

    public function update_action() 
    {
        $this->_rules();

        $al = preg_replace('/\./', '', $this->input->post('alokasi_anggaran'));
        $real = preg_replace('/\./', '', $this->input->post('realisasi_anggaran'));

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
            } else {
                $data = array(
        		'instansi_pemberi_tugas' => $this->input->post('instansi_pemberi_tugas',TRUE),
        		'dasar_hukum' => $this->input->post('dasar_hukum',TRUE),
        		'program_keg_output' => $this->input->post('program_keg_output',TRUE),
        		'lokasi' => $this->input->post('lokasi',TRUE),
        		'skpd_pelaksana' => $this->input->post('skpd_pelaksana',TRUE),
        		'alokasi_anggaran' => $al,
        		'realisasi_anggaran' => $real,
        		'persentase' => $this->input->post('persentase',TRUE),
        		'realisasi_capaian' => $this->input->post('realisasi_capaian',TRUE),
        	    );

                $this->Tugas_pembantuan_model->update($this->input->post('id', TRUE), $data);
                $this->session->set_flashdata('success', 'Diubah');
                redirect(site_url('tugas_pembantuan'));
            }
    }

    public function delete($id) 
    {
        $row = $this->Tugas_pembantuan_model->get_by_id($id);

        if ($row) {
            $this->Tugas_pembantuan_model->delete($id);
            $this->session->set_flashdata('success', 'Dihapus');
            redirect(site_url('tugas_pembantuan'));
            } else {
                $this->session->set_flashdata('error', 'Data tidak ditemukan');
                redirect(site_url('tugas_pembantuan'));
            }
    }

                            public function _rules() 
                            {
	$this->form_validation->set_rules('instansi_pemberi_tugas', 'instansi pemberi tugas', 'trim|required');
	$this->form_validation->set_rules('dasar_hukum', 'dasar hukum', 'trim|required');
	$this->form_validation->set_rules('program_keg_output', 'program keg output', 'trim|required');
	$this->form_validation->set_rules('lokasi', 'lokasi', 'trim|required');
	$this->form_validation->set_rules('skpd_pelaksana', 'skpd pelaksana', 'trim|required');
	$this->form_validation->set_rules('alokasi_anggaran', 'alokasi anggaran', 'trim|required');
	$this->form_validation->set_rules('realisasi_anggaran', 'realisasi anggaran', 'trim|required');
	$this->form_validation->set_rules('persentase', 'persentase', 'trim|required');
	$this->form_validation->set_rules('realisasi_capaian', 'realisasi capaian', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
                        }

    public function excel()
                            {
                                $this->load->helper('exportexcel');
                                $namaFile = "tugas_pembantuan.xls";
                                $judul = "tugas_pembantuan";
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
	xlsWriteLabel($tablehead, $kolomhead++, "Instansi Pemberi Tugas");
	xlsWriteLabel($tablehead, $kolomhead++, "Dasar Hukum");
	xlsWriteLabel($tablehead, $kolomhead++, "Program Keg Output");
	xlsWriteLabel($tablehead, $kolomhead++, "Lokasi");
	xlsWriteLabel($tablehead, $kolomhead++, "Skpd Pelaksana");
	xlsWriteLabel($tablehead, $kolomhead++, "Alokasi Anggaran");
	xlsWriteLabel($tablehead, $kolomhead++, "Realisasi Anggaran");
	xlsWriteLabel($tablehead, $kolomhead++, "Persentase");
	xlsWriteLabel($tablehead, $kolomhead++, "Realisasi Capaian");
	xlsWriteLabel($tablehead, $kolomhead++, "Tahun");

	foreach ($this->Tugas_pembantuan_model->get_all() as $data) {
                                    $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
                                    xlsWriteNumber($tablebody, $kolombody++, $nourut);
	    xlsWriteLabel($tablebody, $kolombody++, $data->instansi_pemberi_tugas);
	    xlsWriteLabel($tablebody, $kolombody++, $data->dasar_hukum);
	    xlsWriteLabel($tablebody, $kolombody++, $data->program_keg_output);
	    xlsWriteLabel($tablebody, $kolombody++, $data->lokasi);
	    xlsWriteLabel($tablebody, $kolombody++, $data->skpd_pelaksana);
	    xlsWriteNumber($tablebody, $kolombody++, $data->alokasi_anggaran);
	    xlsWriteNumber($tablebody, $kolombody++, $data->realisasi_anggaran);
	    xlsWriteNumber($tablebody, $kolombody++, $data->persentase);
	    xlsWriteLabel($tablebody, $kolombody++, $data->realisasi_capaian);
	    xlsWriteNumber($tablebody, $kolombody++, $data->tahun);

	    $tablebody++;
                                    $nourut++;
                                }

                                xlsEOF();
                                exit();
                            }

}

/* End of file Tugas_pembantuan.php */
                        /* Location: ./application/controllers/Tugas_pembantuan.php */
                        /* Please DO NOT modify this information : */
                        /* Generated by Harviacode Codeigniter CRUD Generator 2024-02-12 19:11:57 */
                        /* http://harviacode.com */