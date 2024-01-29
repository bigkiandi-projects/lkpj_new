
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
                        <a href="<?php echo base_url('kegiatan/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" width="100%">
                        <tr>
                            <th>No</th>
		<th>KdKeg</th>
		<th>NmKeg</th>
		<th>P Id</th>
		<th>Action</th>
                        </tr><?php
                        foreach ($kegiatan_data as $kegiatan)
                        {
                            ?>
                            <tr>
			<td><?php echo ++$start ?></td>
			<td><?php echo $kegiatan->kdKeg ?></td>
			<td><?php echo $kegiatan->nmKeg ?></td>
			<td><?php echo $kegiatan->p_id ?></td><td>
                        <a href="<?php echo site_url('kegiatan/read/' . $kegiatan->idKeg ) ?>" class="btn btn-info"><i class="fa fa-eye"></i></a>
                        <a href="<?php echo site_url('kegiatan/update/' . $kegiatan->idKeg ) ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        <a data-href="<?php echo site_url('kegiatan/delete/' . $kegiatan->idKeg ) ?>" class="btn btn-danger hapus-data"><i class="fa fa-trash"></i></a>
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
		<?php echo anchor(site_url('kegiatan/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    
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
