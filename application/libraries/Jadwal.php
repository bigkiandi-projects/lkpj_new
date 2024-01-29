<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
 
class Jadwal {

	private $ci;
    /**
    * Copies an instance of CI
    */
    public function __construct()
    {
      $this->ci =& get_instance();
      $this->ci->load->model(array('Penjadwalan_model', 'user/User_model'));
    }
 
    function check_jadwal() {
    	$th = $this->ci->session->userdata('ta');
    	$data_jadwal = $this->ci->Penjadwalan_model->get_by_year($th);

    	if(isset($data_jadwal)) {

	        $start_date = $data_jadwal->tgl_mulai; // Assuming start date and time
			$end_date = $data_jadwal->tgl_selesai;   // Assuming end date and time
			$id = $data_jadwal->id_jadwal;

			// Get the current date and time in timestamp format
			$current_timestamp = time();

			// Convert start and end date strings to timestamps
			$start_timestamp = strtotime($start_date);
			$end_timestamp = strtotime($end_date);

			if ($current_timestamp >= $start_timestamp && $current_timestamp <= $end_timestamp) {
				$result = ['status_code' => 1, 'message' => 'Penyusunan LPKJ Dibuka!'];
				$this->ci->Penjadwalan_model->update($id, $result);
				$get_last = $this->ci->Penjadwalan_model->get_by_year($th);
				return $get_last;
			} else if ($current_timestamp > $start_timestamp) {
				$result = ['status_code' => 2, 'message' => 'Penyusunan LPKJ Telah Berakhir.'];
				$this->ci->Penjadwalan_model->update($id, $result);
				$get_last = $this->ci->Penjadwalan_model->get_by_year($th);
				return $get_last;
			} else {
				$result = ['status_code' => 0, 'message' => 'Penyusunan LPKJ Belum Dibuka.'];
				$this->ci->Penjadwalan_model->update($id, $result);
				$get_last = $this->ci->Penjadwalan_model->get_by_year($th);
				return $get_last;
			}

		} else {
			return false;
		}
    }

    function waktu_indo($tanggalWaktu) {
	    // Set time zone ke Asia/Jakarta (Waktu Indonesia Barat)
	    date_default_timezone_set('Asia/Jakarta');

	    // Array nama hari dan bulan dalam bahasa Indonesia
	    $hariIndonesia = array('Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
	    $bulanIndonesia = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');

	    // Ubah format tanggal dan waktu ke format Indonesia
	    $tanggalWaktuIndonesia = $hariIndonesia[date('w', strtotime($tanggalWaktu))] . ', '  // Hari
	                          . date("d ", strtotime($tanggalWaktu))
	                          . $bulanIndonesia[date("n", strtotime($tanggalWaktu)) - 1]  // Bulan
	                          . date(" Y H:i:s", strtotime($tanggalWaktu));  // Tahun, Jam, Menit, Detik

	    return $tanggalWaktuIndonesia;
	}


}
?>