
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="info-card">
                    <h4><i class="far fa-clock"></i> <?php echo $judul ?> Otomatis</h4>
                    <div class="info-app yellow">
                        <i class="fas fa-info-circle"></i>
                    Pengaturan Range waktu pengisian LKPJ
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <form method="post" action="<?= base_url('penjadwalan/save_jadwal') ?>">
                    <table class="table table-bordered" width="100%">
                        <tr>
                            <td width="90" style="background-color:#F5F5DC;"><b>Tanggal Mulai</b> <small class="text-red">*</small></td>
                            <td>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-md-3 col-xs-6">
                                            <input type="text" class="form-control pull-right datepicker" placeholder="tanggal mulai" name="date_mulai">
                                        </div>
                                        <div class="col-md-2 col-xs-6">
                                            <input type="text" class="form-control pull-right timepicker" name="time_mulai">
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color:#F5F5DC;"><b>Tanggal Selesai</b> <small class="text-red">*</small></td>
                            <td>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <input type="text" class="form-control pull-right datepicker" placeholder="tanggal selesai" name="date_selesai">
                                        </div>
                                        <div class="col-xs-2">
                                            <input type="text" class="form-control pull-right timepicker" name="time_selesai">
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="background-color:#F5F5DC;"><b>Tahun LKPJ</b> <small class="text-red">*</small></td>
                            <td>
                                <div class="form-group">
                                    <input class="form-control" type="text" name="tahun" value="<?= $this->session->userdata('ta') ?>" readOnly>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td style="background-color:#F5F5DC;"><b>Opsi</b> <small class="text-red">*</small></td>
                            <td>
                                <button type="submit" class="btn btn-primary btn-flat">Simpan</button>
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>

                <h4>Data Jadwal Tersimpan</h4>

                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                    <thead>
                        <th>No</th>
                		<th>Tgl Mulai</th>
                		<th>Tgl Selesai</th>
                        <th>Tahun LKPJ</th>
                		<th>Status</th>
                		<th>Action</th>
                    </thead>
                    <tbody>
                        <?php foreach ($penjadwalan_data as $penjadwalan) { ?>
                            <tr>
                    			<td><?php echo ++$start ?></td>
                    			<td><?php echo date('d M Y H:i:s', strtotime($penjadwalan->tgl_mulai)); ?></td>
                    			<td><?php echo date('d M Y H:i:s', strtotime($penjadwalan->tgl_selesai)); ?></td>
                                <td><?= $penjadwalan->tahun ?></td>
                    			<td><?= $penjadwalan->message ?></td>
                                <td>
                                    <a data-href="<?php echo site_url('penjadwalan/delete/' . $penjadwalan->id_jadwal ) ?>" class="btn btn-danger hapus-data"><i class="fa fa-trash"></i></a>
                                </td>
                    		</tr>
                            <?php } ?>
                    </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
    
                    </div>
                    <div class="col-md-6 text-right">
                        <?php echo $pagination ?>
                    </div>
                </div>
                 
            </div>
        </div>
    </div>

    <!-- <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="info-card">
                    <h4><i class="far fa-clock"></i> Set Jadwal Manual / OPD</h4>
                    <div class="info-app yellow">
                        <i class="fas fa-info-circle"></i>
                    Pengaturan Range waktu pengisian LKPJ
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                    <thead>
                        <th>No</th>
                        <th>OPD</th>
                        <th>Status Pengisian</th>
                        <th>Option</th>
                    </thead>
                    <tbody>
                        <?php foreach ($opd as $ab) { ?>
                            <tr>
                                <td><?php echo ++$start ?></td>
                                <td><?= $ab['nama_user'] ?></td>
                                <td>
                                    <?= ($ab['status'] == 1) ? "<label class='label label-success'>Dibuka</label>" : "<label class='label label-danger'>Ditutup</label>";  ?>
                                </td>
                                <td>
                                    <?php if($ab['status'] == 1) { ?>
                                        <a class="btn btn-flat btn-sm btn-danger" href="<?= base_url('penjadwalan/set_status/'.$ab['id_user'].'/0') ?>">Tutup Akses</a>
                                    <?php } else { ?>
                                        <a class="btn btn-flat btn-sm btn-success" href="<?= base_url('penjadwalan/set_status/'.$ab['id_user'].'/1') ?>">Buka Akses</a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> -->

</div>

<script>
    $(document).ready(function() {
       $(document).on("click", ".hapus-data", function () {
          hapus($(this).data("href"));
        });
    });

</script>
