<?php

function fetch_prog($prog){

    foreach($prog as $prg){

        echo "<tr>";
        echo    "<td><input type='checkbox' name='prog[]'></td>";
        echo    "<td style='width: 5%;'><b>".$prg->Kode."</b></td>";
        echo    "<td colspan='3'><b>".$prg->Bidang_Urusan_Program_Kegiatan_Sub_Kegiatan."</b></td>";
        echo    "<td></td>
                <td></td>";

        echo "</tr>";

        if(!empty($prg->sub)){

            fetch_keg($prg->sub);
        }

    }

}

function fetch_keg($prog){

    foreach($prog as $kgt){

        echo "<tr>";

        echo    "<td></td>";
        echo    "<td><input type='checkbox' name='keg[]'></td>";
        echo    "<td style='width: 6%;'><b>".$kgt->Kode."</b></td>";
        echo    "<td colspan='2'><b>".$kgt->Bidang_Urusan_Program_Kegiatan_Sub_Kegiatan."</b></td>";
        echo    "<td></td>
                <td></td>";

        echo "</tr>";

        if(!empty($kgt->sub)){

            fetch_subkeg($kgt->sub);
        }

    }

}

function fetch_subkeg($prog){

    foreach($prog as $sk){

        echo "<tr>";

        echo    "<td></td>
                <td></td>";
        echo    "<td><input type='checkbox' name='subkeg[]'></td>";
        echo    "<td style='width: 7%;'>".$sk->Kode."</td>";
        echo    "<td>".$sk->Bidang_Urusan_Program_Kegiatan_Sub_Kegiatan."</td>";
        echo    "<td>".$sk->Indikator."</td>";
        echo    "<td>".$sk->Satuan."</td>";

        echo "</tr>";

    }

}

?>

<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <div class="pull-left">
                    <div class="box-title">
                        <h4>DATA CAPAIAN KINERJA GENERATOR</h4>
                    </div>
                </div>
                <div class="pull-right">
                    <div class="box-title">
                        <a href="<?php echo base_url('isian_urusan/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="box-form" style="background-color: #fff; padding: 10px;">
                    <div class="alert alert-info">
                        <h4>STEP 1</h4>
                        <p>Silahkan Pilih OPD Terkait dan Tahun LKPJ Kemudian Klik Tombol Cari</p>
                    </div>
                    <div class="row">
                    <form method="get" action="<?= base_url('isian_urusan/generate_prog') ?>">

                        <div class="form-group col-md-6">
                            <label>Pilih OPD</label>
                            <select class="form-control" name="opd">
                                <option disabled selected>Pilih OPD</option>
                                <?php foreach($opd as $a) { ?>
                                    <option value="<?= $a->nmOpd ?>"><?= $a->nmOpd ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Pilih Tahun LKPJ</label>
                            <select class="form-control" name="tahun">
                                <option disabled selected>Pilih Tahun</option>
                                <option value="2021">2021</option>
                                <option value="2022">2022</option>
                                <option value="2023">2023</option>
                                <option value="2024">2024</option>
                                <option value="2025">2025</option>
                            </select>
                        </div>

                        <div class="form-group col-md-12">
                            <label>Pilih Urusan</label>
                            <select class="form-control" name="id_urusan">
                                <option disabled selected>Pilih Urusan</option>
                                <?php foreach($ur as $a) { ?>
                                    <option value="<?= $a->Kode ?>"><?= $a->Bidang_Urusan_Program_Kegiatan_Sub_Kegiatan ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <button class="btn btn-danger">Reset</button>
                            <button class="btn btn-primary">Cari</button>
                        </div>

                    </form>
                    </div>
                </div>

                <div class="box-form" style="background-color: #f4f4f4; padding: 10px; margin-top: 5px;">
                <div class="alert alert-info">
                    <h4>STEP 2</h4>
                    <p>Pilih Nama Program/Kegiatan/Sub Kegiatan Terkait Untuk Instansi Dan Tahun Berkenaan</p>
                </div>
                <div class="table-responsive">

                    <table class="table table-bordered" width="100%">
                        <thead>
                            <th>Nama OPD</th>
                            <th>Tahun LKPJ</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td><input type="text" name="opd" class="form-control" value="<?= $d_opd ?>" readonly></td>
                                <td><input type="text" name="tahun" class="form-control" value="<?= $d_th ?>" readonly></td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered" width="100%">
                        <thead>
                            <th>#</th>
                            <th colspan="4">Kode / Program/Kegiatan/Sub Kegiatan</th>
                            <th>Indikator Kinerja</th>
                            <th>Satuan</th>
                        </thead>
                        <tbody>
                            <?php if(!empty($prog)) {fetch_prog($prog);} ?>
                        </tbody>
                    </table>
                </div>
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

