
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                    <div class="pull-right">
                        <div class="box-title">
                            <a href="<?php echo base_url('bidang_add/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                        </div>
                    </div>
                    <div class="info-card">
                        <h4><i class="fas fa-file-signature"></i> <?php echo $judul ?></h4>
                        <div class="info-app yellow">
                            <i class="fas fa-info-circle"></i>
                            Fitur Untuk Menambahkan Bidang Urusan Bagi OPD yang mengambil Program/Kegiatan/ dan Sub Kegiatan Dari Bidang lain. <br>Data pada tabel di bawah akan muncul di Form Generator Secara Otomatis.
                        </div>
                    </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" width="100%">
                        <thead>
                            <th>No</th>
                    		<th>Nama Bidang</th>
                    		<th>Kode Bidang</th>
                    		<th>Status</th>
                    		<th>Action</th>
                        </tthead>
                        <tbody>
                        <?php foreach ($bidang_add_data as $bidang_add) { ?>
                            <tr>
                    			<td><?php echo ++$start ?></td>
                    			<td><?php echo $bidang_add->nama_bidang ?></td>
                    			<td><?php echo $bidang_add->kode_bidang ?></td>
                    			<td><?php echo $bidang_add->status ?></td><td>
                                    <a href="<?php echo site_url('bidang_add/read/' . $bidang_add->id_ba ) ?>" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                    <a href="<?php echo site_url('bidang_add/update/' . $bidang_add->id_ba ) ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    <a data-href="<?php echo site_url('bidang_add/delete/' . $bidang_add->id_ba ) ?>" class="btn btn-danger hapus-data"><i class="fa fa-trash"></i></a>
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
</div>

<script>
    $(document).ready(function() {
       $(document).on("click", ".hapus-data", function () {
          hapus($(this).data("href"));
        });
    });
</script>
