<style type="text/css">
    table.table-bordered > thead > tr > th{
      border:0.5px solid #c8c8c8;
      text-align: center;
      vertical-align: middle;
      background-color: #605ca8;
      color: #fff;
    }
    table.table-bordered > tbody > tr > td{
        border:0.5px solid #c8c8c8;
    }
    table.dataTable th {
        font-size: 0.9em;
    }
    table.dataTable td {
        font-size: 0.9em;
    }
    table.dataTable tr.opede {
        background-color: #9f9dca;
        font-weight: bold;
    }
    table.dataTable tr.prog {
        background-color: #bfbddc;
        font-weight: bold;
    }
    table.dataTable tr.keg {
        background-color: #dfdeed;
        font-weight: bold;
    }
    .info-card h4 {
        font-weight: bold;
        font-size: 30px;
    }
    
</style>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-right">
                    <div class="box-title">
                        <a href="<?php echo base_url('tugas_pembantuan/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                    </div>
                </div>

                <div class="info-card pull-left">
                    <h4><i class="fas fa-briefcase"></i> <?php echo $judul ?></h4>
                    <div class="info-app yellow">
                        <i class="fas fa-info-circle"></i>
                        Data Tugas Pembantuan Tahun <?= $this->session->userdata('ta') ?>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" width="100%">
                        <thead>
                            <th>No</th>
                    		<th>Instansi Pemberi Tugas</th>
                    		<th>Dasar Hukum</th>
                    		<th>Program Keg Output</th>
                    		<th>Lokasi</th>
                    		<th>Skpd Pelaksana</th>
                    		<th>Alokasi Anggaran</th>
                    		<th>Realisasi Anggaran</th>
                    		<th>Persentase</th>
                    		<th>Realisasi Capaian</th>
                    		<th>Action</th>
                        </thead>
                        <tbody>
                            <?php foreach ($tugas_pembantuan_data as $tugas_pembantuan) { ?>
                            <tr>
                    			<td><?php echo ++$start ?></td>
                    			<td><?php echo $tugas_pembantuan->instansi_pemberi_tugas ?></td>
                    			<td><?php echo $tugas_pembantuan->dasar_hukum ?></td>
                    			<td><?php echo $tugas_pembantuan->program_keg_output ?></td>
                    			<td><?php echo $tugas_pembantuan->lokasi ?></td>
                    			<td><?php echo $tugas_pembantuan->skpd_pelaksana ?></td>
                    			<td><?php echo number_format($tugas_pembantuan->alokasi_anggaran, 2) ?></td>
                    			<td><?php echo number_format($tugas_pembantuan->realisasi_anggaran, 2) ?></td>
                    			<td><?php echo $tugas_pembantuan->persentase ?></td>
                    			<td><?php echo $tugas_pembantuan->realisasi_capaian ?></td>
                                <td width="90">
                                    <a href="<?php echo site_url('tugas_pembantuan/update/' . $tugas_pembantuan->id ) ?>" class="btn btn-primary btn-sm btn-flat"><i class="fa fa-edit"></i></a>
                                    <a data-href="<?php echo site_url('tugas_pembantuan/delete/' . $tugas_pembantuan->id ) ?>" class="btn btn-danger btn-sm btn-flat hapus-data"><i class="fa fa-trash"></i></a>
                                 </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                 
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
       $(document).on("click", ".hapus-data", function () {
          hapus($(this).data("href"));
        });
    });
</script>
