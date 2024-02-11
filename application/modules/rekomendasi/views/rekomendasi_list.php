<?php

function render_urusan($data) {

    foreach($data as $ur) {
        echo '<tr>';
        echo '<td><b>'.$ur->kode.'</b></td>';
        echo '<td colspan="6"><b>'.$ur->urusan.'</b></td>';
        
        
        if(!empty($ur->sub)){
            render_opd($ur->sub);
        }
        
        echo '</tr>';
    }
}

function render_opd($data) {

    foreach($data as $op) {
        echo '<tr>';
        echo '<td><b>'.$op->kode.'</b></td>';
        echo '<td colspan="6"><b>'.$op->nama_user.'</b></td>';
        
        if(!empty($op->sub)){
            render_rekomendasi($op->sub, $op->id_user, $op->kode, $op->nama_user);
        }
        
        echo '</tr>';
    }
}


function render_rekomendasi($data, $idOpd, $kdOpd, $nmOpd) {
    $nm = 'a';
    foreach($data as $rek) {
        echo '<tr>';
        
        echo '<td></td>';
        echo '<td>'.$nm++.'. </td>';
        echo '<td>'.$rek->rekomendasi.'</td>';
        echo '<td>'.$rek->tindak_lanjut.'</td>';
        echo '<td>'.$rek->tujuan.'</td>';
        echo '  <td>
                    <div class="btn">
                        <a href="'.base_url("rekomendasi/update/").$rek->id_rek.'/'.$idOpd.'/'.$kdOpd.'/'.$nmOpd.'" class="btn btn-flat btn-primary"><i class="fa fa-edit"></i></a>
                        <a href="'.base_url('rekomendasi/delete/').$rek->id_rek.'" class="btn btn-flat btn-danger"><i class="fa fa-trash"></i></a>
                    </div>
                </td>';
        
        if(!empty($op->sub)){
            render_rekomendasi($op->sub);
        }
        
        echo '</tr>';
    }
}


?>

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
                        <a href="<?php echo base_url('rekomendasi/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                    </div>
                </div>
                <div class="info-card">
                    <h4><i class="fas fa-clipboard-list"></i> <?php echo $judul ?></h4>
                    <div class="info-app yellow">
                        <i class="fas fa-info-circle"></i>
                    Data Rekomendasi DPRD 
                    </div>
                </div>

            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" width="100%">
                        <thead>
                            <th>Kode</th>
                    		<th colspan="2">Urusan / OPD / Rekomendasi DPRD</th>
                    		<th>Tindak Lanjut</th>
                    		<th>Tujuan</th>
                    		<th>Action</th>
                        </thead>
                        <tbody>
                            <?= render_urusan($get_urusan) ?>
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
