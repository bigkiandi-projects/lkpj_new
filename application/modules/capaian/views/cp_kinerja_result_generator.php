<?php

function fetch_bid($prog){

    foreach($prog as $bid){

        echo    "<tr>";
        echo    "<td colspan='7'><b>".$bid->nmBid."</b></td>";
        echo    '<td style="display:none;"></td>
                <td style="display:none;"></td>
                <td style="display:none;"></td>
                <td style="display:none;"></td>
                <td style="display:none;"></td>
                <td style="display:none;"></td>';

        echo "</tr>";

        if(!empty($bid->sub)){

            fetch_prog($bid->sub);
        }

    }

}

function fetch_prog($prog) {

    foreach($prog as $prg) {

        echo    "<tr>";
        echo    "<td><input type='checkbox' name='prog[]' value='".$prg->kdProg."'></td>";
        echo    "<td style='width: 5%;'><b>".$prg->kdProg."</b></td>";
        echo    "<td colspan='5'><b>".$prg->nmProg."</b></td>";
        echo    '<td style="display:none;"></td>
                <td style="display:none;"></td>
                <td style="display:none;"></td>
                <td style="display:none;"></td>';
        echo    "</tr>";

        if(!empty($prg->sub)){

            fetch_keg($prg->sub);
        }

    }

}

function fetch_keg($prog){

    foreach($prog as $kgt){

        echo "<tr>";

        echo    "<td></td>";
        echo    "<td><input type='checkbox' name='keg[]' value='".$kgt->kdKeg."'></td>";

        echo    "<td style='width: 6%;'><b>".$kgt->kdKeg."</b></td>";
        echo    "<td colspan='4'><b>".$kgt->nmKeg."</b></td>";
        echo    '<td style="display:none;"></td>
                <td style="display:none;"></td>
                <td style="display:none;"></td>';

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
        echo    "<td><input type='checkbox' name='subkeg[]' value='".$sk->kdSubkeg."'></td>";

        echo    "<td style='width: 7%;'>".$sk->kdSubkeg."</td>";
        echo    "<td>".$sk->nmSubkeg."</td>";
        echo    "<td>".$sk->indikator."</td>";
        echo    "<td>".$sk->satuan."</td>";

        echo "</tr>";

    }

}

?>



<div class="row">
    <div class="col-xs-12">
        <div class="box box-default">
            <div class="box-header with-border">
                <div class="pull-left">
                    <div class="info-card">
                        <h4><i class="fas fa-file-signature"></i> Form Input Program, Kegiatan, dan Sub Kegiatan</h4>
                    </div>
                </div>
                <div class="pull-right">
                    <div class="box-title">
                        <a href="<?php echo base_url('capaian') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%">

                        <tr>
                            <td width="300" style="background-color:#F5F5DC;"><b>Organisasi Perangkat Daerah</b> <small class="text-red">*</small></td>
                            <td>
                                <b><?= $kd.' - '.$opd ?></b>
                            </td>
                        <tr>
                        <tr>
                            <td style="background-color:#F5F5DC;"><b>Tahun LKPJ</b> <small class="text-red">*</small></td>
                            <td>
                                <?= $th ?>
                            </td>
                        </tr>

                    </table>
                </div>

                <div class="table-responsive" id="sw">
                <?php if(!empty($prog)) { ?>
                <div class="alert bg-gray">
                <h4 class="text-warning">Silahkan Pilih Dan Centang Program/Kegiatan/Sub Kegiatan Terlebih Dahulu Kemudian Klik : <button type="submit" form="myform" class="btn btn-success"><span class="fa fa-save"></span> Simpan</button></h4>
                </div>

                <table id="example" class="table table-bordered" width="100%">
                    <thead>
                        <th bgcolor="#F5F5DC">#</th>
                        <th bgcolor="#F5F5DC" colspan="4">Kode/Urusan/Program/Kegiatan/Sub Kegiatan</th>
                        <th bgcolor="#F5F5DC">Indikator Kinerja</th>
                        <th bgcolor="#F5F5DC">Satuan</th>
                    </thead>
                    <tbody>
                        <form method="get" action="<?= base_url('capaian/save_isian') ?>" id="myform">
                            <?= fetch_bid($prog) ?>
                            <input type="hidden" name="th" value="<?= $th ?>">
                            <input type="hidden" name="idOpd" value="<?= $idOpd ?>">
                        </form>
                    </tbody>
                </table>
                <?php } ?>

                </div>
                 
            </div>
        </div>
    </div>

</div>

<script type="text/javascript">
    $(document).ready(function () {
        $('#example').DataTable({
            "ordering": false,
            "columnDefs" : [{
                "targets": '_all',
                "createdCell": function (td, cellData, rowData, row, col) {
                    $(td).css('padding', '2px');
                }
            }]
        });
    });
</script>

<!-- <script type="text/javascript">
$(document).ready(function() {

    $('#sw').on('change', ':checkbox', function(){
        if ($(this).is(':checked')) {
            id = $(this).closest('tr').find('.nmprog').html();
            ki = $(this).closest('tr').find('.kinerja').html();
            sat = $(this).closest('tr').find('.satuan').html();
        }
    });

});
</script> -->
