<?php

    function cariObjek($array, $string) {
        foreach ($array as $objek) {
            if (strpos($objek->nmOpd, $string) !== false) {
                return $objek;
            }
        }
        return null;
    }

    // String yang ingin dicari
    $cariString = strtoupper($this->session->userdata('nama_user'));

    // Memanggil fungsi untuk mencari objek
    $find = cariObjek($opd, $cariString);

?>

<style type="text/css">
	table.table-bordered > thead > tr > th{
      border:1px solid #c8c8c8;
      text-align: center;
      vertical-align: middle;
  	}
  	table.table-bordered > tbody > tr > td{
    	border:0.5px solid #c8c8c8;
  	}
</style>
<div class="row">
    <div class="col-xs-12">
        <div class="box box-default">
            <div class="box-header with-border">
                <div class="info-card">
                    <h4><i class="fas fa-file-signature"></i> <?php echo $judul ?> Kinerja</h4>
                    <div class="info-app yellow">
                        <i class="fas fa-info-circle"></i>
                        Pilih OPD untuk melihat Data Program/Kegiatan/Sub Kegiatan.
                    </div>
                </div>
            </div>
            <div class="box-body">

                <div class="table-responsive">
                    <table class="table table-bordered" width="100%">
                        <form method="get" action="<?= base_url('capaian/result_form') ?>">
                            <tr>
                                <td width="30" style="background-color:#F5F5DC;"><b>Organisasi Perangkat Daerah</b> <small class="text-red">*</small></td>
                                <td>
                                    <div class="form-group">
                                        <?php if($this->session->userdata('level') == 'Opd') { ?>
                                        <select class="form-control" name="opd" readonly>
                                            <option value="<?= $find->kdOpd ?>"><?= $find->kdOpd." ".$find->nmOpd ?></option>
                                        </select>
                                        <input type="hidden" name="namaOpd" value="<?= $find->nmOpd ?>">
                                        <input type="hidden" name="idOpd" value="<?= $find->idOpd ?>">
                                        <?php } else { ?>
                                        <select class="form-control" name="opd" id="opd">
                                            <option disabled selected>---</option>
                                            <?php foreach($opd as $a) { ?>
                                                <option value="<?= $a->kdOpd ?>" data-nama="<?= $a->nmOpd ?>" data-id="<?= $a->idOpd ?>"><?= $a->kdOpd." ".$a->nmOpd ?></option>
                                            <?php } ?>
                                        </select>
                                        <input type="hidden" name="namaOpd" id="namaOpd">
                                        <input type="hidden" name="idOpd" id="idOpd">
                                        <?php } ?>
                                    </div>
                                </td>
                            </tr>
                        <tr>
                            <td style="background-color:#F5F5DC;"><b>Tahun LKPJ</b> <small class="text-red">*</small></td>
                            <td>
                                <div class="form-group">
                                    <select class="form-control" name="tahun">
                                        <option value="<?= $this->session->userdata('ta') ?>" selected><?= $this->session->userdata('ta') ?></option>
                                    </select>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td style="background-color:#F5F5DC;"><b>Tanggal Mulai</b></td>
                            <td>
                                <?php if(!empty($status_jadwal)) { ?>
                                    <?= $this->jadwal->waktu_indo($status_jadwal->tgl_mulai) ?>
                                <?php } else { ?>
                                    <p class="text-red">-</p>
                                <?php } ?>
                            </td>
                        </tr>

                        <tr>
                            <td style="background-color:#F5F5DC;"><b>Tanggal Selesai</b></td>
                            <td>
                                <?php if(!empty($status_jadwal)) { ?>
                                    <?= $this->jadwal->waktu_indo($status_jadwal->tgl_selesai) ?>
                                <?php } else { ?>
                                    <p class="text-red">-</p>
                                <?php } ?>
                            </td>
                        </tr>

                        <tr>
                            <td style="background-color:#F5F5DC;"><b>Status</b></td>
                            <td>
                                <?php if(!empty($status_jadwal)) { ?>
                                    <?php if($status_jadwal->status_code == 1) { ?>
                                        <p class="label label-success"><?= $status_jadwal->message ?></p>
                                    <?php } else if($status_jadwal->status_code == 0) { ?>
                                        <p class="label label-warning"><?= $status_jadwal->message ?></p>
                                    <?php } else { ?>
                                        <p class="label label-danger"><?= $status_jadwal->message ?></p>
                                    <?php } ?>
                                <?php } else { ?>
                                    <p class="text-red">Jadwal Penyusunan LKPJ Belum Ditetapkan oleh admin Bapeda.</p>
                                <?php } ?>
                            </td>
                        </tr>

                        <tr>
                            <td style="background-color:#F5F5DC;"><b>Mulai Penyusunan</b></td>
                            <td>
                                <?php if(!empty($status_jadwal)) { ?>
                                    <?php if($status_jadwal->status_code == 1) { ?>
                                        <button class="btn btn-primary"><i class="far fa-edit"></i> Klik Untuk Memulai Penyusunan</button>
                                    <?php } ?> 
                                <?php } else { ?>
                                    <p class="text-red">-</p>
                                <?php } ?>  
                            </td>
                        </tr>

                        </form>

                    </table>
                </div>
                 
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $("#opd").change(function(){
        var element = $("option:selected", this);
        var myTag = element.attr("data-nama");
        var myId = element.attr("data-id");

        $('#namaOpd').val(myTag);
        $('#idOpd').val(myId);
    });

</script>
