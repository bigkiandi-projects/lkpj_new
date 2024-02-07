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
                                <th rowspan="2">No</th>
                                <th rowspan="2">OPD</th>
                        		<th colspan="4">Triwulan</th>
                        		<th rowspan="2">Tahun</th>
                        		<th rowspan="2">Action</th>
                            </tr>
                            <tr>
                                <th>I</th>
                                <th>II</th>
                                <th>III</th>
                                <th>IV</th>
                            </tr>
                        </thead>
                        <tbody>
                            <td>1</td>
                            <td>DINAS KEPENDUDUKAN DAN PENCATATAN SIPIL</td>
                            <td>
                                <a class="btn btn-default btn-xs"><i class="far fa-file"></i> Dokumen Perencanaan</a>
                                <a class="btn btn-default btn-xs"><i class="far fa-file"></i> Laporan Evaluasi</a>
                                <a class="btn btn-default btn-xs"><i class="far fa-file"></i> Laporan LKPJ</a>
                                <a class="btn btn-default btn-xs"><i class="far fa-file"></i> Data Sektoral</a>
                                <br><br>
                                <small class="bg-green" style="padding: 2px;">Data Lengkap</small>
                            </td>
                            <td>
                                <a class="btn btn-default btn-xs"><i class="far fa-file"></i> Dokumen Perencanaan</a>
                                <a class="btn btn-default btn-xs"><i class="far fa-file"></i> Laporan Evaluasi</a>
                                <a class="btn btn-default btn-xs"><i class="far fa-file"></i> Laporan LKPJ</a>
                                <a class="btn btn-default btn-xs"><i class="far fa-file"></i> Data Sektoral</a>
                                <br><br>
                                <small class="bg-yellow" style="padding: 2px;">Data Belum Lengkap</small>
                            </td>
                            <td>
                                <a class="btn btn-default btn-xs"><i class="far fa-file"></i> Dokumen Perencanaan</a>
                                <a class="btn btn-default btn-xs"><i class="far fa-file"></i> Laporan Evaluasi</a>
                                <a class="btn btn-default btn-xs"><i class="far fa-file"></i> Laporan LKPJ</a>
                                <a class="btn btn-default btn-xs"><i class="far fa-file"></i> Data Sektoral</a>
                            </td>
                            <td>
                                <small class="bg-red" style="padding: 2px;">X</small>
                            </td>
                            <td>2023</td>
                            <td>action</td>
                        
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
</div>

<script>
    $(document).ready(function() {
       $(document).on("click", ".hapus-data", function () {
          hapus($(this).data("href"));
        });
    });
</script>
