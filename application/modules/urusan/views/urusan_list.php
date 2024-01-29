
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
                        <a href="<?php echo base_url('urusan/create') ?>" class="btn btn-primary"><i class="fa fa-plus"></i> Tambah Data</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" width="100%">
                        <tr>
                            <th>No</th>
		<th>KdUrus</th>
		<th>NmUrus</th>
		<th>Action</th>
                        </tr><?php
                        foreach ($urusan_data as $urusan)
                        {
                            ?>
                            <tr>
			<td><?php echo ++$start ?></td>
			<td><?php echo $urusan->kdUrus ?></td>
			<td><?php echo $urusan->nmUrus ?></td><td>
                        <a href="<?php echo site_url('urusan/read/' . $urusan->idUrus ) ?>" class="btn btn-info"><i class="fa fa-eye"></i></a>
                        <a href="<?php echo site_url('urusan/update/' . $urusan->idUrus ) ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                        <a data-href="<?php echo site_url('urusan/delete/' . $urusan->idUrus ) ?>" class="btn btn-danger hapus-data"><i class="fa fa-trash"></i></a>
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
		<?php echo anchor(site_url('urusan/excel'), 'Excel', 'class="btn btn-primary"'); ?>
	    
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
