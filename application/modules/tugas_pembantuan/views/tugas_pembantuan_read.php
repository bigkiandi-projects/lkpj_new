
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-left">
                    <div class="box-title">
                        <h4><?php echo $judul ?></h4>
                    </div>
                </div>
                <div class="pull-right">
                    <div class="box-title">
                        <a href="<?php echo base_url('tugas_pembantuan') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                 <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                     <table class="table">
	    <tr><td>Instansi Pemberi Tugas</td><td><?php echo $instansi_pemberi_tugas; ?></td></tr>
	    <tr><td>Dasar Hukum</td><td><?php echo $dasar_hukum; ?></td></tr>
	    <tr><td>Program Keg Output</td><td><?php echo $program_keg_output; ?></td></tr>
	    <tr><td>Lokasi</td><td><?php echo $lokasi; ?></td></tr>
	    <tr><td>Skpd Pelaksana</td><td><?php echo $skpd_pelaksana; ?></td></tr>
	    <tr><td>Alokasi Anggaran</td><td><?php echo $alokasi_anggaran; ?></td></tr>
	    <tr><td>Realisasi Anggaran</td><td><?php echo $realisasi_anggaran; ?></td></tr>
	    <tr><td>Persentase</td><td><?php echo $persentase; ?></td></tr>
	    <tr><td>Realisasi Capaian</td><td><?php echo $realisasi_capaian; ?></td></tr>
	    <tr><td>Tahun</td><td><?php echo $tahun; ?></td></tr>
	</table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>