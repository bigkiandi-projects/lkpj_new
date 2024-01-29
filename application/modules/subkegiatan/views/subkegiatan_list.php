
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
                        <a href="<?php echo base_url('subkegiatan/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" width="100%">
                        <tr>
                            <th>No</th>
		<th>KdSubkeg</th>
		<th>NmSubkeg</th>
		<th>Kinerja</th>
		<th>Indikator</th>
		<th>Satuan</th>
		<th>P Id</th>
		<th>Action</th>
                        </tr><?php
                        foreach ($subkegiatan_data as $subkegiatan)
                        {
                            ?>
                            <tr>
			<td><?php echo ++$start ?></td>
			<td><?php echo $subkegiatan->kdSubkeg ?></td>
			<td><?php echo $subkegiatan->nmSubkeg ?></td>
			<td><?php echo $subkegiatan->kinerja ?></td>
			<td><?php echo $subkegiatan->indikator ?></td>
			<td><?php echo $subkegiatan->satuan ?></td>
			<td><?php echo $subkegiatan->p_id ?></td><td>
                        <a href="<?php echo site_url('subkegiatan/read/' . $subkegiatan->idSubkeg ) ?>" class="btn btn-info"><i class="fa fa-eye"></i></a>
                        <a href="<?php echo site_url('subkegiatan/update/' . $subkegiatan->idSubkeg ) ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        <a data-href="<?php echo site_url('subkegiatan/delete/' . $subkegiatan->idSubkeg ) ?>" class="btn btn-danger hapus-data"><i class="fa fa-trash"></i></a>
                     </td>
		</tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
                <div class="row">
                        <div class="col-md-6">
                            <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
		<?php echo anchor(site_url('subkegiatan/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    
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
