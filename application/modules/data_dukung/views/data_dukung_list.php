<?php

function render_usr($data) {

    foreach($data as $user) {
        echo '<tr>';
        echo '<td>'.$user->id_user.'</td>';
        echo '<td width="20%">'.$user->nama_user.'</td>';
        
        if(!empty($user->sub)){
            render_triwulan($user->sub, $user->nama_user);
        }
        
        echo '</tr>';
    }
}

function render_triwulan($data, $nmUser) {
    echo '<td class="data-dukung">';
    echo '<div class="row">';

    foreach ($data as $a) {
        if(!empty($a->sub)){
            render_berkas($a->sub, $a->triwulan, $nmUser);
        }
    }

    echo '</div>';
    echo "</td>";
}

function render_berkas($berkas, $tri, $nmUser) {
    foreach($berkas as $b) {
        echo '<div class="col-md-3">';
        echo '<a class="btn btn-primary btn-sm btn-block trw">'.$tri.'</a>';
        echo '<a href="'.base_url("assets/upload/dokumen/").$b->dok_perencanaan.'" class="btn btn-default btn-sm btn-block doc" data-id="'.$b->dok_perencanaan.'"><i class=""></i> Dokumen Perencanaan</a>';
        echo '<a href="'.base_url("assets/upload/dokumen/").$b->lap_evaluasi.'" class="btn btn-default btn-sm btn-block doc" data-id="'.$b->lap_evaluasi.'"><i class=""></i> Laporan Evaluasi</a>';
        echo '<a href="'.base_url("assets/upload/dokumen/").$b->lap_lkpj.'" class="btn btn-default btn-sm btn-block doc" data-id="'.$b->lap_lkpj.'"><i class=""></i> Laporan LKPJ</a>';
        echo '<a href="'.base_url("assets/upload/dokumen/").$b->data_sektoral.'" class="btn btn-default btn-sm btn-block doc" data-id="'.$b->data_sektoral.'"><i class=""></i> Data Sektoral</a>';

        echo '<br>';
        echo '<div class="info-up">';
        echo '<small class="text-primary">Last Updated : '.date('h-M-Y :h:i', strtotime($b->date)).'</small>';
        echo '<br>';
        echo '<small class="info">Status Data : Lengkap</small>
                <br><br>
                <div class="btn-group btn-group-justified">
                    <a href="'.base_url("data_dukung/download_zip/".$b->id_triwulan).'/'.$nmUser.'" class="btn btn-flat btn-xs btn-primary"><i class="fa fa-download"></i> Unduh</a>
                    <a href="'.base_url("data_dukung/update/".$b->id_triwulan).'" class="btn btn-flat btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>
                    <a href="'.base_url("data_dukung/hapus/".$b->id_triwulan).'" class="btn btn-flat btn-xs btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                </div>
            </div>';
        echo '</div>';

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
                        <a href="<?php echo base_url('data_dukung/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                    </div>
                </div>

                <div class="info-card">
                    <h4><i class="fas fa-database"></i> <?php echo $judul ?></h4>
                    <div class="info-app yellow">
                        <i class="fas fa-info-circle"></i>
                    Form Pelaporan Data Dukung LKPJ. Harap melakukan input data sebagaimana tertera.
                    </div>
                </div>
            </div>
            <div class="box-body">
                
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>OPD</th>
                        		<th>Triwulan</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?= render_usr($data_dukung_data) ?>
                        
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

    // Variabel untuk melacak apakah semua data-id tidak kosong
    var semuaDataLengkap = true;
    
    // Memeriksa setiap tabel
    $('td.data-dukung').each(function() {
        var td = $(this);
        var semuaDataTdLengkap = true; // Inisialisasi untuk setiap TD
        
        // Memeriksa setiap elemen <a> dalam TD
        td.find('a.doc').each(function() {
            // Mendapatkan nilai data-id dari setiap elemen <a>
            var dataId = $(this).attr('data-id');
            
            // Memeriksa apakah data-id kosong
            if (dataId === "") {
                semuaDataLengkap = false;
                semuaDataTdLengkap = false;
                // Jika kosong, tambahkan kelas 'text-red' pada elemen <i>
                $(this).find('i').addClass('fas fa-times-circle text-red');
            } else {
                // Jika tidak kosong, tambahkan kelas 'text-green' pada elemen <i>
                $(this).find('i').addClass('fas fa-check-circle text-green');
            }
        });
        
        // Memeriksa apakah semua data-id dalam TD tidak kosong
        if (semuaDataTdLengkap) {
            // Jika semua data-id tidak kosong, tambahkan elemen <small> dengan pesan "data lengkap"
            td.find('.info').text('Data Lengkap').addClass('text-green');
        } else {
            // Jika ada data-id yang kosong, tambahkan elemen <small> dengan pesan "data tidak lengkap"
            td.find('.info').text('Data Tidak Lengkap').addClass('text-red');
        }
    });

</script>

