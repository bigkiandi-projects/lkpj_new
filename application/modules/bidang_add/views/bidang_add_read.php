
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
                        <a href="<?php echo base_url('bidang_add') ?>" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
                    </div>
                </div>
            </div>
            <div class="box-body">
                 <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
                     <table class="table">
	    <tr><td>Nama Bidang</td><td><?php echo $nama_bidang; ?></td></tr>
	    <tr><td>Kode Bidang</td><td><?php echo $kode_bidang; ?></td></tr>
	    <tr><td>Status</td><td><?php echo $status; ?></td></tr>
	</table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>