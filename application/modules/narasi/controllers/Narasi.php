<?php

if (!defined('BASEPATH'))
exit('No direct script access allowed');

require ('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class Narasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Narasi_model', 'rekomendasi/Rekomendasi_model', 'opd/Opd_model'));
        $this->load->library('form_validation');        
	$this->load->library('datatables');
    }

    public function index()
    {
        $data['judul'] = 'Data Narasi Tahun '.$this->session->userdata('ta');

        $this->load->view('templates/header', $data);
        $this->load->view('narasi/narasi_list', $data);
        $this->load->view('templates/footer', $data);
    } 

    public function json() {
        header('Content-Type: application/json');
        echo $this->Narasi_model->json();
    }

    public function read($id) 
    {
        $row = $this->Narasi_model->get_by_id($id);
        if ($row) {
            $data = array(
    		'id_narasi' => $row->id_narasi,
    		'unit_kerja' => $row->unit_kerja,
    		'urusan' => $row->urusan,
    		'uraian_kegiatan' => $row->uraian_kegiatan,
    	    );

            $data['judul'] = 'Detail Narasi';

            $this->load->view('templates/header', $data);
            $this->load->view('narasi/narasi_read', $data);
            $this->load->view('templates/footer', $data);
            } else {
                $this->session->set_flashdata('error', 'Data tidak ditemukan');
                redirect(site_url('narasi'));
            }
        }

    public function create() {
        $opd = $this->Opd_model->get_all();
        
        $data = array(
        'button' => 'Create',
        'action' => site_url('narasi/create_action'),
	    'id_narasi' => set_value('id_narasi'),
	    'unit_kerja' => $this->session->userdata('nama_user'),
	    'urusan' => set_value('urusan'),
	    'uraian_kegiatan' => set_value('uraian_kegiatan'),

        'opd' => $opd,
	    );

        $data['judul'] = 'Tambah Narasi';

        $this->load->view('templates/header', $data);
        $this->load->view('narasi/narasi_form', $data);
        $this->load->view('templates/footer', $data);
    }

    public function create_action() {
        $data = array(
		'unit_kerja' => $this->input->post('opd',TRUE),
		'urusan' => $this->input->post('urusan',TRUE),
		'uraian_kegiatan' => $this->input->post('uraian_kegiatan',TRUE),
        'tahun' => $this->session->userdata('ta'),
	    );

        $this->Narasi_model->insert($data);
        $this->session->set_flashdata('success', 'Ditambah');
        redirect(site_url('narasi'));
    }

    public function update($id) {
        $row = $this->Narasi_model->get_by_id($id);
        $opd = $this->Opd_model->get_all();

        if ($row) {
            $data = array(
            'button' => 'Update',
            'action' => site_url('narasi/update_action'),
    		'id_narasi' => set_value('id_narasi', $row->id_narasi),
    		'unit_kerja' => set_value('unit_kerja', $row->unit_kerja),
    		'urusan' => set_value('urusan', $row->urusan),
    		'uraian_kegiatan' => set_value('uraian_kegiatan', $row->uraian_kegiatan),

            'opd' => $opd,
    	    );

            $data['judul'] = 'Ubah Narasi';

            $this->load->view('templates/header', $data);
            $this->load->view('narasi/narasi_form', $data);
            $this->load->view('templates/footer', $data);

            } else {
                $this->session->set_flashdata('error', 'Data tidak ditemukan');
                redirect(site_url('narasi'));
            }
    }

    public function update_action() {

        $data = array(
		'unit_kerja' => $this->input->post('opd',TRUE),
        'urusan' => $this->input->post('urusan',TRUE),
        'uraian_kegiatan' => $this->input->post('uraian_kegiatan',TRUE),
	    );

        $this->Narasi_model->update($this->input->post('id_narasi', TRUE), $data);
        $this->session->set_flashdata('success', 'Diubah');
        redirect(site_url('narasi'));
    }

    public function delete($id) {
        $row = $this->Narasi_model->get_by_id($id);

        if ($row) {
            $this->Narasi_model->delete($id);
            $this->session->set_flashdata('success', 'Dihapus');
            redirect(site_url('narasi'));
            } else {
                $this->session->set_flashdata('error', 'Data tidak ditemukan');
                redirect(site_url('narasi'));
            }
    }

    public function _rules() {
    	$this->form_validation->set_rules('unit_kerja', 'unit kerja', 'trim|required');
    	$this->form_validation->set_rules('urusan', 'urusan', 'trim|required');
    	$this->form_validation->set_rules('uraian_kegiatan', 'uraian kegiatan', 'trim|required');

    	$this->form_validation->set_rules('id_narasi', 'id_narasi', 'trim');
    	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel() {

        // Get Format
        $file_path = './assets/upload/export/format-narasi.xlsx';
        $filename = 'narasi';

        // Baca file spreadsheet yang sudah ada
        $spreadsheet = IOFactory::load($file_path);
        // Dapatkan lembar aktif (active sheet)
        $sheet = $spreadsheet->getActiveSheet();

        // Data yang ingin Anda tambahkan ke baris tertentu
        $rowIndex = 4;

    	foreach ($this->Narasi_model->get_all() as $a) {
            $sheet->setCellValue('A'.$rowIndex, $a->kdOpd);

            $sheet->setCellValue('B'.$rowIndex, $a->unit_kerja);
            $sheet->getStyle('A'.$rowIndex.':B'.$rowIndex)->getFont()->setBold(true);

            $sheet->setCellValue('C'.$rowIndex, $a->urusan);
            $sheet->setCellValue('D'.$rowIndex, $a->uraian_kegiatan);

            $sheet->getStyle('A'.$rowIndex.':D'.$rowIndex)->getAlignment()->setWrapText(true);

            $sheet->getStyle('A'.$rowIndex.':D'.$rowIndex)->getAlignment()
                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);

            $sheet->getStyle('A'.$rowIndex.':D'.$rowIndex)->getBorders()
                    ->getAllBorders()
                    ->setBorderStyle(Border::BORDER_THIN)
                    ->setColor(new Color('666666'));

            $rowIndex++;
        }

        ob_clean();
        $writer = new Xlsx($spreadsheet);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="'.$filename.'-'.date('d-M-Y hij').'.xlsx"');
        $writer->save('php://output');
        exit();
    }



}

/* End of file Narasi.php */
                        /* Location: ./application/controllers/Narasi.php */
                        /* Please DO NOT modify this information : */
                        /* Generated by Harviacode Codeigniter CRUD Generator 2022-12-04 03:03:58 */
                        /* http://harviacode.com */