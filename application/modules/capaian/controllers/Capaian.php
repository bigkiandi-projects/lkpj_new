<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

require ('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Capaian extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model(array('Capaian_model', 'opd/Opd_model', 'bidang/Bidang_model', 'penjadwalan/Penjadwalan_model'));
        $this->load->library(array('form_validation', 'Jadwal'));
    }

    public function index() {

        $data = array(
        'opd' => $this->Opd_model->get_all(),
        'bidang' => $this->Bidang_model->get_all(),
        );

        $data['judul'] = 'Generator';

        $this->load->view('templates/header', $data);
        $this->load->view('capaian/cp_kinerja_form_generator', $data);
        $this->load->view('templates/footer', $data);
    }

    public function generate() {
        $opd = $this->input->get('opd');
        $tahun = $this->input->get('tahun');
        $ur = $this->input->get('ur');

        $d_opd = $this->input->get('namaOpd');
        $d_idOpd = $this->input->get('idOpd');
        $data = array(
                        'prog' => $this->Capaian_model->get_bidang($opd, $ur),
                        'opd' => $d_opd,
                        'th' => $tahun,
                        'kd' => $opd,
                        'idOpd' => $d_idOpd,
                    );
        $data['judul'] = 'Data Capaian Kinerja Generator';

        $this->load->view('templates/header', $data);
        $this->load->view('capaian/cp_kinerja_result_generator', $data);
        $this->load->view('templates/footer', $data);
    }

    public function save_isian() {
        // substr($a, 0, strrpos($a, "."));
        $id = $this->input->get('idOpd');
        $th = $this->input->get('th');

        $prog = $this->input->get('prog');
        $keg = $this->input->get('keg');
        $subkeg = $this->input->get('subkeg');

        if(!empty($prog)) {
            $p = $this->Capaian_model->passProg($prog);
            foreach($p as $a) {
                if($this->Capaian_model->kd_exist($a->kdProg, $id, $th)) {
                    $ss['idOpd'] = $id;
                    $ss['p_id'] = $a->p_id;
                    $ss['kd'] = $a->kdProg;
                    $ss['program'] = $a->nmProg;
                    $ss['indikator'] = '';
                    $ss['satuan'] = '';
                    $ss['tahun'] = $th;
                    $this->Capaian_model->save_prog($ss);
                }
            }
        }

        if(!empty($keg)) {
            $k = $this->Capaian_model->passKeg($keg);
            foreach($k as $a) {
                if($this->Capaian_model->kd_exist($a->kdKeg, $id, $th)) {
                    $ss['idOpd'] = $id;
                    $ss['p_id'] = $a->p_id;
                    $ss['kd'] = $a->kdKeg;
                    $ss['program'] = $a->nmKeg;
                    $ss['indikator'] = '';
                    $ss['satuan'] = '';
                    $ss['tahun'] = $this->input->get('th');
                    $this->Capaian_model->save_prog($ss);
                }
            }
        }

        if(!empty($subkeg)) {
            $s = $this->Capaian_model->passSubkeg($subkeg);
            foreach($s as $a) {
                if($this->Capaian_model->kd_exist($a->kdSubkeg, $id, $th)) {
                    $ss['idOpd'] = $id;
                    $ss['p_id'] = $a->p_id;
                    $ss['kd'] = $a->kdSubkeg;
                    $ss['program'] = $a->nmSubkeg;
                    $ss['indikator'] = $a->indikator;
                    $ss['satuan'] = $a->satuan;
                    $ss['tahun'] = $this->input->get('th');
                    $this->Capaian_model->save_prog($ss);
                }
            }
        }

        $this->session->set_flashdata('success', 'Ditambah');
        redirect(base_url('capaian'));
    }


    public function form_isian() {
        $data = array('opd' => $this->Opd_model->get_all(),
                       'status_jadwal' => $this->jadwal->check_jadwal(),
                     );

        $data['judul'] = 'Pengisian Capaian';

        $this->load->view('templates/header', $data);
        $this->load->view('capaian/form_isian', $data);
        $this->load->view('templates/footer', $data);
    }

    public function result_form() {
        $status = $this->jadwal->check_jadwal();
        if(isset($status->status_code) == 1) {
            $getkdUr = $this->input->get('opd');
            $getIdOpd = $this->input->get('idOpd');

            $th = $this->input->get('tahun');
            $kdUr = array("X.XX", $getkdUr);

            $data['nmOpd'] = $this->input->get('namaOpd');
            $data['cp'] = $this->Capaian_model->get_view_opd($kdUr, $getIdOpd, $th);

            $data['judul'] = 'Pengisian Capaian';

            $this->load->view('templates/header', $data);
            $this->load->view('capaian/view_result_capaian_v2', $data);
            $this->load->view('templates/footer', $data);
        } else {
            echo "No Data To show. Contact Admin for detail information and give this status code #521";
        }
    }

    // EDIT

    public function edit_cp($id) {
       $get_data = $this->Capaian_model->get_by_id($id);
       if($get_data) {
            $data['result'] = $get_data;
            $data['id'] = $id;
       } else {
            $data['result'] = 'No Data Were Found';
       }

       // Mengembalikan data dalam bentuk view
       $this->load->view('capaian/modal_content', $data);
    }


    public function save_edit_cp($id) {
        $al = str_replace(".", "", $this->input->post('alokasi_ang'));
        $real = str_replace(".", "", $this->input->post('real_ang'));
        $pre = ($al!=0)?($real/$al) * 100:0;
        $data = array(  
                        'target' => $this->input->post('target'),
                        'real_target' => $this->input->post('real_target'),
                        'alokasi_ang' => $al,
                        'real_ang' => $real,
                        'presentasi' => $pre,
                        'permasalahan' => $this->input->post('permasalahan'),
                        'upaya' => $this->input->post('upaya'),
                        'tl' => $this->input->post('tl'),
                        'kebijakan' => $this->input->post('kebijakan'),
                    );
        if($this->Capaian_model->update($id, $data)) {
            $this->session->set_flashdata('success', 'Data Berhasil Disimpan');
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            $this->session->set_flashdata('error', 'Operation TimeOut. Gagal menyimpan Data');
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function hapus_cp($id) {
        $row = $this->Capaian_model->get_by_id($id);

        if ($row) {
            $this->Capaian_model->delete($id);
            $this->session->set_flashdata('success', 'Dihapus');
            redirect($_SERVER['HTTP_REFERER']);
            } else {
                $this->session->set_flashdata('error', 'Data tidak ditemukan');
                redirect($_SERVER['HTTP_REFERER']);
            }
    }

    public function view_result_cp() {

        $data = array('opd' => $this->Opd_model->get_all());

        $data['judul'] = 'Data Capaian Kinerja';

        $this->load->view('templates/header', $data);
        $this->load->view('capaian/view_result_capaian', $data);
        $this->load->view('templates/footer', $data);
    }

    public function view_result_v2() {
        if($this->session->userdata('level') == 'Opd') {
            $data['opdd'] = $this->Opd_model->get_all();
            // String yang ingin dicari
            $cariString = strtoupper($this->session->userdata('nama_user'));

            // Memanggil fungsi untuk mencari objek
            $find = $this->cariObjek($data['opdd'], $cariString);

            $getkdUr = $find->kdOpd;
            $getIdOpd = $find->idOpd;

            $th = $this->session->userdata('ta');
            $kdUr = array("X.XX", $getkdUr);

            $data['cp'] = $this->Capaian_model->get_view_opd($kdUr, $getIdOpd, $th);

        } else {
            if($this->input->get('opd')) {

                $getkdUr = $this->input->get('opd');
                $getIdOpd = $this->input->get('idOpd');

                $th = $this->input->get('ta');
                $kdUr = array("X.XX", $getkdUr);

                $data['cp'] = $this->Capaian_model->get_view_opd($kdUr, $getIdOpd, $th);
                $data['opdd'] = $this->Opd_model->get_all();
            } else {
                $getOpd = $this->Opd_model->get_all();
                foreach($getOpd as $op) {
                    $hsl[] = $op->kdOpd; 
                }

                $non = array("X.XX");
                $kdUr = array_merge($non, $hsl);
                $th = $this->session->userdata('ta');

                $data['cp'] = $this->Capaian_model->get_all_opd($kdUr, $th);
                $data['opdd'] = $this->Opd_model->get_all();
            }
        }

        $data['judul'] = 'Lihat/Cetak Data';

        $this->load->view('templates/header', $data);
        $this->load->view('capaian/view_result_capaian_v2_view', $data);
        $this->load->view('templates/footer', $data);
    }

    // cari padanan OPD
    function cariObjek($array, $string) {
    foreach ($array as $objek) {
        if (strpos($objek->nmOpd, $string) !== false) {
            return $objek;
            }
        }
        return null;
    }

    public function rekapitulasi() {
        $getOpd = $this->Opd_model->get_all();
        foreach($getOpd as $op) {
            $hsl[] = $op->kdOpd; 
        }

        $non = array("X.XX");
        $kdUr = array_merge($non, $hsl);
        $th = $this->session->userdata('ta');

        $data['rk'] = $this->Capaian_model->get_rekap_opd($kdUr, $th);

        $data['judul'] = 'Rekapitulasi';

        $this->load->view('templates/header', $data);
        $this->load->view('capaian/view_rekap', $data);
        $this->load->view('templates/footer', $data);
    }

    // UPLOAD EXCEL
    public function get_excel_import_format($data) {
        // Lokasi file spreadsheet yang sudah ada
        $file_path = './assets/upload/format-lkpj.xlsx';

        // Baca file spreadsheet yang sudah ada
        $spreadsheet = IOFactory::load($file_path);

        // Dapatkan lembar aktif (active sheet)
        $sheet = $spreadsheet->getActiveSheet();

        foreach($data as $row) {
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('C3', $row->idOpd)
            ->setCellValue('C4', $row->nmOpd)
            ->setCellValue('C5', $this->input->get('tahun'));
        }

        // Simpan file spreadsheet dengan perubahan yang baru saja Anda buat
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('./assets/upload/file_spreadsheet_updated.xlsx');
    }





    // DEFAULT FUNCTION


        public function create_action() 
        {
            $this->_rules();

            if ($this->form_validation->run() == FALSE) {
                $this->create();
                } else {
                    $data = array(
                		'idOpd' => $this->input->post('idOpd',TRUE),
                		'kd' => $this->input->post('kd',TRUE),
                		'target' => $this->input->post('target',TRUE),
                		'real_target' => $this->input->post('real_target',TRUE),
                		'alokasi_ang' => $this->input->post('alokasi_ang',TRUE),
                		'real_ang' => $this->input->post('real_ang',TRUE),
                		'presentasi' => $this->input->post('presentasi',TRUE),
                		'permasalahan' => $this->input->post('permasalahan',TRUE),
                		'upaya' => $this->input->post('upaya',TRUE),
                		'tl' => $this->input->post('tl',TRUE),
                		'tahun' => $this->input->post('tahun',TRUE),
                	    );

                    $this->Capaian_model->insert($data);
                    $this->session->set_flashdata('success', 'Ditambah');
                    redirect(site_url('capaian'));
                }
            }

            public function update($id) 
            {
                $row = $this->Capaian_model->get_by_id($id);

                if ($row) {
                    $data = array(
                    'button' => 'Update',
                    'action' => site_url('capaian/update_action'),
	'idCapai' => set_value('idCapai', $row->idCapai),
	'idOpd' => set_value('idOpd', $row->idOpd),
	'kd' => set_value('kd', $row->kd),
	'target' => set_value('target', $row->target),
	'real_target' => set_value('real_target', $row->real_target),
	'alokasi_ang' => set_value('alokasi_ang', $row->alokasi_ang),
	'real_ang' => set_value('real_ang', $row->real_ang),
	'presentasi' => set_value('presentasi', $row->presentasi),
	'permasalahan' => set_value('permasalahan', $row->permasalahan),
	'upaya' => set_value('upaya', $row->upaya),
	'tl' => set_value('tl', $row->tl),
	'tahun' => set_value('tahun', $row->tahun),
    );

                    $data['judul'] = 'Ubah Cp_kinerja';

                    $this->load->view('templates/header', $data);
                    $this->load->view('capaian/cp_kinerja_form', $data);
                    $this->load->view('templates/footer', $data);

                    } else {
                        $this->session->set_flashdata('error', 'Data tidak ditemukan');
                        redirect(site_url('capaian'));
                    }
                }

                    public function update_action() 
                    {
                        $this->_rules();

                        if ($this->form_validation->run() == FALSE) {
                            $this->update($this->input->post('idCapai', TRUE));
                            } else {
                                $data = array(
		'idOpd' => $this->input->post('idOpd',TRUE),
		'kd' => $this->input->post('kd',TRUE),
		'target' => $this->input->post('target',TRUE),
		'real_target' => $this->input->post('real_target',TRUE),
		'alokasi_ang' => $this->input->post('alokasi_ang',TRUE),
		'real_ang' => $this->input->post('real_ang',TRUE),
		'presentasi' => $this->input->post('presentasi',TRUE),
		'permasalahan' => $this->input->post('permasalahan',TRUE),
		'upaya' => $this->input->post('upaya',TRUE),
		'tl' => $this->input->post('tl',TRUE),
		'tahun' => $this->input->post('tahun',TRUE),
	    );

                                $this->Capaian_model->update($this->input->post('idCapai', TRUE), $data);
                                $this->session->set_flashdata('success', 'Diubah');
                                redirect(site_url('capaian'));
                            }
                        }

                        public function delete($id) 
                        {
                            $row = $this->Capaian_model->get_by_id($id);

                            if ($row) {
                                $this->Capaian_model->delete($id);
                                $this->session->set_flashdata('success', 'Dihapus');
                                redirect(site_url('capaian'));
                                } else {
                                    $this->session->set_flashdata('error', 'Data tidak ditemukan');
                                    redirect(site_url('capaian'));
                                }
                            }

                            public function _rules() 
                            {
	$this->form_validation->set_rules('idOpd', 'idopd', 'trim|required');
	$this->form_validation->set_rules('kd', 'kd', 'trim|required');
	$this->form_validation->set_rules('tahun', 'tahun', 'trim|required');

	$this->form_validation->set_rules('idCapai', 'idCapai', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
                        }

}

/* End of file Capaian.php */
                        /* Location: ./application/controllers/Capaian.php */
                        /* Please DO NOT modify this information : */
                        /* Generated by Harviacode Codeigniter CRUD Generator 2023-02-17 21:58:49 */
                        /* http://harviacode.com */